<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Variants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Variant;
use App\Models\Vouchers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


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
        $quantity = $request->query('quantity');
        $image = $request->query('image');
        $productName = $request->query('name');
        $productPrice = $request->query('price');
        $orderTotal = session('order_total', 0);
        // Kiểm tra nếu thiếu bất kỳ dữ liệu nào
        if (!$colorId || !$sizeId || !$quantity || !$image || !$productName || !$productPrice) {
            return redirect()->back()->withErrors(['message' => 'Dữ liệu không đầy đủ']);
        }
        $color = Variant::where('id', $colorId)->first();
        $size = Variant::where('id', $sizeId)->first();

        $product = Product::where('name', $productName)->first();
        if (!$product) {
            return redirect()->back()->withErrors(['message' => 'Sản phẩm không tồn tại']);
        }
        $user = Auth::user();
        $addresses = Address::where('user_id', $user->id)->get();
        $checkoutData = [
            'color' => $colorId,  // Lưu giá trị màu sắc từ URL
            'size' => $sizeId,    // Lưu giá trị kích thước từ URL
            'quantity' => $quantity,
            'image' => $image,
            'productName' => $productName,
            'productPrice' => $productPrice,
            'productId' => $product->id,
        ];
        session()->put('productcheckout', $checkoutData);

        return view('client.checkout', compact('quantity',  'productPrice', 'product', 'checkoutData', 'addresses', 'user', 'orderTotal'));
    }
    public function checkout1(Request $request)
    {
        $user = Auth::user();
        $addresses = Address::where('user_id', $user->id)->get();
        // Lấy dữ liệu các sản phẩm đã chọn
        $cartItems = Cart::where('user_id', auth()->id())->get();
        $selectedProducts = json_decode($request->input('selected_products'), true);
       

        if (!$selectedProducts || count($selectedProducts) == 0) {
            return redirect()->back()->with('error', 'Bạn chưa chọn sản phẩm nào.');
        }
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->product->price_sale * $item->quantity;
        }
        $tax = 5000;  // Or calculate dynamically
        $totalWithTax = $total + $tax;
        if ($selectedProducts) {
            $products = [];
            foreach ($selectedProducts as $item) {
                // Kiểm tra nếu 'product_id' tồn tại trong item
                if (isset($item['product_id'])) {
                    $product = Product::find($item['product_id']);
                    if ($product) {
                        $products[] = [
                            'product' => $product,
                            'quantity' => $item['quantity'],
                            'total_price' => $product->price_sale * $item['quantity'],
                        ];
                    }
                } else {
                    // Xử lý nếu không có product_id
                    // Có thể thêm thông báo lỗi hoặc bỏ qua sản phẩm đó
                }
            }
            return view('client.checkout1', compact('products','user', 'addresses', 'cartItems', 'tax', 'totalWithTax', 'total'));
        }

        // Nếu không có sản phẩm nào được chọn
        return redirect()->route('cart')->with('error', 'Vui lòng chọn ít nhất một sản phẩm.');
    }



    public function applyVoucher(Request $request)
    {
        $orderTotal = $request->total_price;
        $voucherCode = $request->voucher_code;
        $appliedVouchers = []; // Tạo một mảng để lưu trữ mã giảm giá đã áp dụng tạm thời trong hàm



        // Kiểm tra nếu mã đã được áp dụng
        if (in_array($voucherCode, $appliedVouchers)) {
            return response([
                'result' => false,
                'message' => 'Mã giảm giá đã được áp dụng!'
            ]);
        }
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $voucher = Vouchers::where('code', $voucherCode)
            ->where('start_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->where('status', 'active')
            ->first();

        if (!$voucher) {
            return response([
                'result' => false,
                'message' => 'Mã giảm giá không hợp lệ hoặc đã hết hạn'
            ]);
        }

        if ($voucher->minimum_order_value > $orderTotal) {
            return response([
                'result' => false,
                'message' => 'Giá trị đơn hàng không đủ để áp dụng mã giảm giá này.'
            ]);
        }

    
        $discount = ($voucher->type === 'percent')
            ? ($voucher->value / 100) * $orderTotal
            : $voucher->value;
    
        $discount = min($discount, $orderTotal);
    
        // Thay vì lưu vào session, chúng ta chỉ cần không cho phép áp dụng lại
        $appliedVouchers[] = $voucherCode; // Lưu mã đã áp dụng vào mảng
    


        $discount = ($voucher->type === 'percent')
            ? ($voucher->value / 100) * $orderTotal
            : $voucher->value;

        $discount = min($discount, $orderTotal);

        // Thay vì lưu vào session, chúng ta chỉ cần không cho phép áp dụng lại
        $appliedVouchers[] = $voucherCode; // Lưu mã đã áp dụng vào mảng

        $data = [
            'voucher_discount' => intval($discount),
            'final_total' => $orderTotal - $discount,
        ];


        return response([
            'result' => true,
            'data' => $data,
            'message' => 'Mã giảm giá đã được áp dụng thành công!' // Thêm thông báo thành công
        ]);
    }

    
    


}
