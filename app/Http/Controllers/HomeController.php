<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('is_available', true)
            ->where('stock', '>', 0)
            ->get();

        return view('home', compact('products'));
    }
}
