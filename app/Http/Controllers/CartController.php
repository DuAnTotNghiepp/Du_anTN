<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Variants;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with(['product', 'variant'])
            ->where('user_id', auth()->id())
            ->get();

        $total = $cartItems->sum(function($item) {
            return $item->product->price_sale * $item->quantity;
        });

        return view('client.cart', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'required|exists:variants,id',
            'quantity' => 'integer|min:1|max:100'
        ]);

        // Lấy sản phẩm và variant
        $product = Product::findOrFail($request->product_id);
        $variant = Variants::findOrFail($request->variant_id);

        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng');
        }

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->where('variant_id', $request->variant_id)
            ->first();

        // Số lượng sản phẩm
        $quantity = $request->quantity ?? 1;

        if ($cartItem) {
            // Cập nhật số lượng giỏ hàng nếu sản phẩm đã có
            $cartItem->update(['quantity' => $cartItem->quantity + $quantity]);
        } else {
            // Tạo mới giỏ hàng nếu chưa có
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'variant_id' => $request->variant_id,
                'quantity' => $quantity
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
    }


    public function update(Request $request, $cartId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:100'
        ]);

        $cartItem = Cart::findOrFail($cartId);
        $cartItem->update(['quantity' => $request->quantity]);

        return redirect()->route('cart.index')
            ->with('success', 'Cập nhật số lượng thành công');
    }

    public function destroy($cartId)
    {
        $cartItem = Cart::findOrFail($cartId);
        $cartItem->delete();

        return redirect()->route('cart.index')
            ->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
    }
}

