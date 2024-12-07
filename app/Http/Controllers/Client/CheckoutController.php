<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Product;
use App\Models\Variants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function show($id)
{
    $product = Product::findOrFail($id);
    $user = Auth::user();
    $addresses = Address::where('user_id', $user->id)->get();

    return view('client.checkout', compact('product', 'addresses', 'user'));
}

    public function form(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['message' => 'Bạn cần đăng nhập để tiếp tục']);
        }
        $colorId = $request->query('color');
        $sizeId = $request->query('size');
        $quantity = (int)$request->query('quantity');
        $image = $request->query('image');
        $productName = $request->query('name');
        $productPrice = $request->query('price');

        // Kiểm tra nếu thiếu bất kỳ dữ liệu nào
        if (!$colorId || !$sizeId || !$quantity || !$image || !$productName || !$productPrice) {
            return redirect()->back()->withErrors(['message' => 'Dữ liệu không đầy đủ']);
        }
        $color = Variants::where('id', $colorId)->first();
        $size = Variants::where('id', $sizeId)->first();

        $product = Product::where('name', $productName)->first();
        if (!$product) {
            return redirect()->back()->withErrors(['message' => 'Sản phẩm không tồn tại']);
        }
        if ($product->quantity < $quantity) {
            return redirect()->back()->withErrors(['message' => 'Sản phẩm không đủ số lượng trong kho']);
        }
        $user = Auth::user();
        $addresses = Address::where('user_id', $user->id)->get();
        $checkoutData = [
            'color' => $color ? $color->value : '',
            'size' => $size ? $size->value : '',
            'quantity' => $quantity,
            'image' => $image,
            'productName' => $productName,
            'productPrice' => $productPrice,
            'productId' => $product->id,
        ];
        session()->put('productcheckout', $checkoutData);

        return view('client.checkout', compact( 'quantity',  'productPrice', 'product', 'checkoutData', 'addresses', 'user'));
    }

}
