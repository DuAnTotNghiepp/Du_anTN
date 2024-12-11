<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Product;
use App\Models\Variants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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
        $quantity = (int)$request->query('quantity');
        $image = $request->query('image');
        $productName = $request->query('name');
        $productPrice = $request->query('price');
        $orderTotal = session('order_total', 0);
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

        return view('client.checkout', compact( 'quantity',  'productPrice', 'product', 'checkoutData', 'addresses', 'user', 'orderTotal'));
    }


    public function applyVoucher(Request $request)
    {
        $quantity = session('quantity', 1);
        $productPrice = session('product_price', 100000);
        $tax = 5000;
        $orderTotal = $request->total_price;

        $voucherCode = $request->voucher_code;
        Log::info('Current Time', ['current_time' => now()->toDateTimeString()]);

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

        // Kiểm tra điều kiện áp dụng mã giảm giá
        if ($voucher->minimum_order_value > $orderTotal) {
            return response([
                'result' => false,
                'message' => 'Giá trị đơn hàng không đủ để áp dụng mã giảm giá này.'
            ]);

        }


        // Tính giá trị giảm giá
        $discount = ($voucher->type === 'percent')
            ? ($voucher->value / 100) * $orderTotal
            : $voucher->value;


        $discount = min($discount, $orderTotal);


        $data = [
            'voucher' => $voucher,                    // Thông tin mã giảm giá
            'voucher_discount' => intval($discount),          // Giá trị giảm
            'final_total' => $orderTotal - $discount,
        ];
        return response([
            'result' => true,
            'data' => $data
        ]);

    }

}
