<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;

class PaymentController extends Controller
{
    public function notification(Request $request)
    {
        // Configure Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        try {
            $notification = new Notification();

            $transactionStatus = $notification->transaction_status;
            $fraudStatus = $notification->fraud_status;
            $orderNumber = $notification->order_id;

            // Find order by order_number
            $order = Order::where('order_number', $orderNumber)->first();

            if (!$order) {
                return response()->json(['message' => 'Order not found'], 404);
            }

            $payment = $order->payment;

            // Handle transaction status
            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'accept') {
                    $order->update(['status' => 'paid']);
                    $payment->update([
                        'status' => 'paid',
                        'paid_at' => now(),
                    ]);
                }
            } elseif ($transactionStatus == 'settlement') {
                $order->update(['status' => 'paid']);
                $payment->update([
                    'status' => 'paid',
                    'paid_at' => now(),
                ]);
            } elseif ($transactionStatus == 'pending') {
                $order->update(['status' => 'pending']);
                $payment->update(['status' => 'pending']);
            } elseif ($transactionStatus == 'deny') {
                $payment->update(['status' => 'failed']);
            } elseif ($transactionStatus == 'expire') {
                $payment->update(['status' => 'failed']);
            } elseif ($transactionStatus == 'cancel') {
                $order->update(['status' => 'cancelled']);
                $payment->update(['status' => 'failed']);
            }

            return response()->json(['message' => 'Notification handled']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function finish(Request $request)
    {
        $orderNumber = $request->order_id;
        $order = Order::where('order_number', $orderNumber)->first();

        if ($order) {
            return redirect()->route('order.success', $order->id)
                ->with('success', 'Pembayaran berhasil diproses!');
        }

        return redirect()->route('home')->with('error', 'Pesanan tidak ditemukan.');
    }

    public function unfinish(Request $request)
    {
        $orderNumber = $request->order_id;
        $order = Order::where('order_number', $orderNumber)->first();

        if ($order) {
            return redirect()->route('order.success', $order->id)
                ->with('info', 'Pembayaran belum selesai. Silakan lanjutkan pembayaran Anda.');
        }

        return redirect()->route('home');
    }

    public function error(Request $request)
    {
        $orderNumber = $request->order_id;
        $order = Order::where('order_number', $orderNumber)->first();

        if ($order) {
            return redirect()->route('order.success', $order->id)
                ->with('error', 'Terjadi kesalahan dalam pembayaran. Silakan coba lagi.');
        }

        return redirect()->route('home');
    }
}
