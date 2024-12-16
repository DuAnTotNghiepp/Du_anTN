<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Product_Variant;
use App\Models\Variant;
use App\Models\Variants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())->get();
        $selectedProducts = []; // Mảng các sản phẩm được chọn

        $total = $cartItems->sum(function ($item) {
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
        // dd($validatedData);
        $validatedData['user_id'] = Auth::id(); // Lấy user_id từ session

        // Lấy sản phẩm và kiểm tra sự tồn tại
        $productVariant = Product_Variant::where('product_id', $validatedData['product_id'])
            ->whereHas('color', function ($query) use ($validatedData) {
                $query->where('value', $validatedData['color']);
            })
            ->whereHas('size', function ($query) use ($validatedData) {
                $query->where('value', $validatedData['size']);
            })
            ->first();

        if (!$productVariant) {
            return redirect()->back()->withErrors(['variant' => 'Không tìm thấy biến thể sản phẩm phù hợp.']);
        }

        // Kiểm tra tồn kho
        if ($validatedData['quantity'] > $productVariant->stock) {
            return redirect()->back()->withErrors(['quantity' => 'Số lượng sản phẩm không đủ trong kho.']);
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

            // Kiểm tra lại tồn kho khi cập nhật số lượng
            if ($cartItem->quantity > $productVariant->stock) {
                return redirect()->back()->withErrors(['quantity' => 'Số lượng sản phẩm trong giỏ hàng vượt quá tồn kho.']);
            }

            $cartItem->total_price = $cartItem->quantity * $productVariant->price;
            $cartItem->save();
        } else {
            // Thêm mới sản phẩm vào giỏ hàng
            $validatedData['total_price'] = $validatedData['quantity'] * $productVariant->price;
            Cart::create($validatedData);
        }

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }


    public function updateQuantity(Request $request, $id)
    {
        // Lấy dữ liệu từ request
        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Lấy cart item từ database
        $cartItem = Cart::findOrFail($id);

        // Tìm variant theo màu sắc và kích thước
        $colorVariant = Variant::colors()->where('value', $cartItem->color)->first();
        $sizeVariant = Variant::sizes()->where('value', $cartItem->size)->first();

        // Kiểm tra nếu không tìm thấy màu sắc hoặc kích thước
        if (!$colorVariant || !$sizeVariant) {
            return redirect()->back()->withErrors(['variant' => 'Không tìm thấy màu sắc hoặc kích thước.']);
        }

        $colorId = $colorVariant->id;
        $sizeId = $sizeVariant->id;

        // Tìm biến thể sản phẩm để kiểm tra tồn kho
        $productVariant = Product_Variant::where('product_id', $cartItem->product_id)
            ->where('color_variant_id', $colorId)
            ->where('size_variant_id', $sizeId)
            ->first();

        // Kiểm tra nếu không tìm thấy biến thể sản phẩm
        if (!$productVariant) {
            return redirect()->back()->withErrors(['variant' => 'Không tìm thấy biến thể sản phẩm.']);
        }

        // Kiểm tra tồn kho
        $quantity = $validatedData['quantity'];
        if ($quantity > $productVariant->stock) {
            return redirect()->back()->withErrors(['quantity' => 'Số lượng vượt quá tồn kho.']);
        }

        // Cập nhật số lượng và tổng giá
        $cartItem->quantity = $quantity;
        $cartItem->total_price = $quantity * $cartItem->price;
        $cartItem->save();

        // Tính lại tổng giá cho toàn bộ giỏ hàng của người dùng hiện tại
        $total = Cart::where('user_id', Auth::id())->sum('total_price');

        return redirect()->route('cart.index')->with('success', 'Cập nhật số lượng thành công!')->with('total', $total);
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
        $total = $cartItems->sum(function ($item) {
            return $item->product->price_sale * $item->quantity;
        });

        return response()->json(['total' => $total]);
    }
}
