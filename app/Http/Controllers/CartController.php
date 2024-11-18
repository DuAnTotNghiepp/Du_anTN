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
        // Nạp quan hệ product và variant
        $cartItems = Cart::with(['product', 'variant'])  // Nạp các mối quan hệ product và variant
        ->where('user_id', auth()->id())
            ->get();

        return view('client.cart', compact('cartItems'));
    }

    // Thêm sản phẩm vào giỏ hàng
    public function store(Request $request, $productId, $variantId)
    {
        // Kiểm tra nếu sản phẩm và variant tồn tại
        $product = Product::find($productId);
        $variant = Variants::find($variantId);  // Đảm bảo sử dụng đúng mô hình Variant

        if (!$product || !$variant) {
            return response()->json(['message' => 'Sản phẩm hoặc biến thể không hợp lệ'], 404);
        }

        // Kiểm tra nếu người dùng đã đăng nhập
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng');
        }

        // Lấy số lượng từ request, mặc định là 1 nếu không có
        $quantity = $request->input('quantity', 1);

        // Kiểm tra nếu sản phẩm đã có trong giỏ hàng của người dùng chưa
        $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->where('variant_id', $variantId) // Kiểm tra theo cả màu sắc và kích thước
            ->first();

        if ($cartItem) {
            // Nếu sản phẩm đã có trong giỏ hàng và cùng biến thể, tăng số lượng lên
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Nếu chưa có, tạo mới sản phẩm trong giỏ hàng
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $productId,
                'variant_id' => $variantId,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }


    public function update(Request $request, $cartItemId)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:90', // Giới hạn số lượng từ 1 đến 90
        ]);

        // Cập nhật số lượng sản phẩm trong giỏ hàng
        $cartItem = Cart::findOrFail($cartItemId);
        $cartItem->quantity = $validated['quantity'];
        $cartItem->save();

        return redirect()->route('cart.index')->with('success', 'Số lượng sản phẩm đã được cập nhật.');
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function destroy($cartItemId)
    {
        // Xóa sản phẩm trong giỏ hàng
        $cartItem = Cart::findOrFail($cartItemId);
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
    }
}
