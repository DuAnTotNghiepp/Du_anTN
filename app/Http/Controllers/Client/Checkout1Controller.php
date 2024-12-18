<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Vouchers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Checkout1Controller extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $user = Auth::user();
        $addresses = Address::where('user_id', $user->id)->get();

        return view('client.checkout', compact('product', 'addresses', 'user'));
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
        foreach ($selectedProducts as $item) {
            if (isset($item['product_id'])) {
                $product = Product::find($item['product_id']);

                // Kiểm tra sản phẩm có khả dụng hay không
                if ($product && $product->is_active) {
                    $products[] = [
                        'product' => $product,
                        'quantity' => $item['quantity'],
                        'total_price' => $product->price_sale * $item['quantity'],
                    ];
                    $total += $product->price_sale * $item['quantity'];
                } else {
                    // Thêm sản phẩm không khả dụng vào danh sách để xử lý
                    $inactiveProducts[] = $item['product_id'];
                }
            }
        }
        if (!empty($inactiveProducts)) {
            Cart::where('user_id', auth()->id())
                ->whereIn('product_id', $inactiveProducts)
                ->delete();

            return redirect()->route('cart.index')->with('error', 'Một số sản phẩm không khả dụng đã bị xóa khỏi giỏ hàng.');
        }

        $tax = 5000;  // Or calculate dynamically
        $totalWithTax = $total + $tax;
        return view('client.checkout1', compact('products', 'user', 'addresses', 'cartItems', 'tax', 'totalWithTax', 'total'));
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
