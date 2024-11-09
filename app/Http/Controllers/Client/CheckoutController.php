<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function form(Request $request)
    {
        $color = $request->query('color');
        $size = $request->query('size');
        $quantity = $request->query('quantity');
        $image = $request->query('image');
        $productName = $request->query('name');
        $productPrice = $request->query('price');

        // Kiểm tra nếu thiếu bất kỳ dữ liệu nào
        if (!$color || !$size || !$quantity || !$image || !$productName || !$productPrice) {
            return redirect()->back()->withErrors(['message' => 'Dữ liệu không đầy đủ']);
        }

        $product = Product::where('name', $productName)->first();
        
        return view('client.checkout', compact('color', 'size', 'quantity', 'image', 'productName', 'productPrice', 'product'));
    }


    public function show($id)
    {
        $productchekout = Product::findOrFail($id);
        return view('client.checkout', compact('productchekout'));
    }
}
