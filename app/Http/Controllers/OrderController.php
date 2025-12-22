<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'notes' => 'nullable|string',
            'pickup_method' => 'required|in:takeaway,dine_in',
            'payment_method' => 'required|in:cash,transfer,ewallet,midtrans',
        ]);

        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        DB::beginTransaction();
        
        try {
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            // Create order
            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'user_id' => auth()->id(),
                'customer_name' => $validated['customer_name'],
                'customer_phone' => $validated['customer_phone'],
                'notes' => $validated['notes'],
                'pickup_method' => $validated['pickup_method'],
                'total_amount' => $total,
                'status' => 'pending',
            ]);

            // Create order items
            foreach ($cart as $productId => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);

                // Update stock
                $product = Product::find($productId);
                $product->stock -= $item['quantity'];
                $product->save();
            }

            // Create payment
            $payment = Payment::create([
                'order_id' => $order->id,
                'payment_method' => $validated['payment_method'],
                'amount' => $total,
                'status' => 'pending',
            ]);

            DB::commit();

            // Clear cart
            session()->forget('cart');

            // If payment method is Midtrans, create Snap Token
            if ($validated['payment_method'] === 'midtrans') {
                return redirect()->route('order.payment', $order->id);
            }

            return redirect()->route('order.success', $order->id)->with('success', 'Pesanan berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membuat pesanan: ' . $e->getMessage());
        }
    }

    public function payment($id)
    {
        $order = Order::with(['orderItems.product', 'payment'])->findOrFail($id);

        // Configure Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // Prepare transaction details
        $transactionDetails = [
            'order_id' => $order->order_number,
            'gross_amount' => (int) $order->total_amount,
        ];

        // Prepare item details
        $itemDetails = [];
        foreach ($order->orderItems as $item) {
            $itemDetails[] = [
                'id' => $item->product_id,
                'price' => (int) $item->price,
                'quantity' => $item->quantity,
                'name' => $item->product->name,
            ];
        }

        // Prepare customer details
        $customerDetails = [
            'first_name' => $order->customer_name,
            'phone' => $order->customer_phone,
        ];

        // Prepare transaction
        $transaction = [
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
        ];

        try {
            $snapToken = Snap::getSnapToken($transaction);
            return view('payment', compact('order', 'snapToken'));
        } catch (\Exception $e) {
            return redirect()->route('order.success', $order->id)
                ->with('error', 'Gagal membuat pembayaran: ' . $e->getMessage());
        }
    }

    public function success($id)
    {
        $order = Order::with(['orderItems.product', 'payment'])->findOrFail($id);
        return view('order-success', compact('order'));
    }

    public function myOrders()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with(['orderItems.product', 'payment'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('my-orders', compact('orders'));
    }
}
