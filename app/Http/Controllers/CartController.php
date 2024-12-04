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

        // Kiểm tra xem sản phẩm có trong giỏ hàng chưa (kiểm tra cả product_id và variant_id)
        $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->where('variant_id', $request->variant_id)
            ->first();

        // Số lượng sản phẩm
        $quantity = $request->quantity ?? 1;

        if ($cartItem) {
            // Nếu sản phẩm đã có trong giỏ, cập nhật số lượng
            $cartItem->update(['quantity' => $cartItem->quantity + $quantity]);
        } else {
            // Nếu sản phẩm chưa có trong giỏ, tạo mục giỏ hàng mới
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

