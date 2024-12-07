<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Vouchers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $orderTotal = session('order_total', 0);
        $cartItems = session()->get('carts', []);
        // Kiểm tra nếu thiếu bất kỳ dữ liệu nào
        if (!$color || !$size || !$quantity || !$image || !$productName || !$productPrice) {
            return redirect()->back()->withErrors(['message' => 'Dữ liệu không đầy đủ']);
        }

        $product = Product::where('name', $productName)->first();

        return view('client.checkout', compact('color', 'size', 'quantity', 'image', 'productName', 'productPrice', 'product','orderTotal','cartItems'));
    }


    public function show($id)
    {    
      
        $productchekout = Product::findOrFail($id);
        return view('client.checkout', compact('productchekout'));
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
