<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Variants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())->get();
        $selectedProducts = []; // Mảng các sản phẩm được chọn
        // Logic để lấy selectedProducts nếu có

        $total = $cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });

        return view('client.cart', compact('cartItems', 'selectedProducts', 'total'));
    }



    public function store(Request $request)
    {
        // Kiểm tra dữ liệu nhận được từ request
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'color' => 'required|string',
            'size' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $validatedData['user_id'] = Auth::id();

        // Lấy sản phẩm và kiểm tra sự tồn tại
        $product = Product::find($validatedData['product_id']);
        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại.');
        }

        // Tìm biến thể màu
        $colorVariant = Variants::where('name', 'color')
            ->where('value', $validatedData['color'])
            ->first();

        // Tìm biến thể kích thước
        $sizeVariant = Variants::where('name', 'size')
            ->where('value', $validatedData['size'])
            ->first();

        // Kiểm tra xem cả hai biến thể có tồn tại hay không
        if (!$colorVariant || !$sizeVariant) {
            return redirect()->back()->withErrors(['variant' => 'Biến thể màu hoặc kích thước không tồn tại.']);
        }

        // Kiểm tra nếu sản phẩm đã có trong giỏ hàng của người dùng
        $cartItem = Cart::where('product_id', $validatedData['product_id'])
            ->where('color', $validatedData['color'])
            ->where('size', $validatedData['size'])
            ->where('user_id', $validatedData['user_id'])
            ->first();

        if ($cartItem) {
            // Cập nhật số lượng và tổng giá
            $cartItem->quantity += $validatedData['quantity'];
            $cartItem->total_price = $cartItem->quantity * $cartItem->price;
            $cartItem->save();
        } else {
            // Thêm mới sản phẩm vào giỏ hàng
            $validatedData['total_price'] = $validatedData['quantity'] * $validatedData['price'];
            Cart::create($validatedData);
        }

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
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
    public function calculateTotal(Request $request)
    {
        $request->validate([
            'selected' => 'array', // Nhận một mảng ID của sản phẩm đã chọn
            'selected.*' => 'exists:carts,id', // Kiểm tra từng ID có tồn tại không
        ]);

        $cartItems = Cart::with('product')
            ->whereIn('id', $request->selected)
            ->get();

        // Tính tổng cho các sản phẩm đã chọn
        $total = $cartItems->sum(function($item) {
            return $item->product->price_sale * $item->quantity;
        });

        return response()->json(['total' => $total]);
    }
}

