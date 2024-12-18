<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Order_Items;
use App\Models\Product;
use App\Models\Product_Variant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Order1Controller extends Controller
{
    //
    public function store1(Request $request)
    {
        // Validate input
        $validatedData = $request->validate([
            'user_address' => 'required|exists:addresses,id',
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|max:255',
            'user_phone' => 'required|string|max:20',
            'payment_method' => 'required|in:cash,vnpay',
            'total_price' => 'required|numeric',
            'quantity' => 'required|array',
            'color' => 'required|array',
            'size' => 'required|array',
            'voucher_code' => 'nullable|string',
        ]);
        // dd($request->all());
        // Create a new order
        $order = Order::create([
            'user_id' => Auth::id(),
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'user_phone' => $request->user_phone,
            'user_address' => $request->user_address,
            'user_note' => $request->user_note ?? '',
            'payment_method' => $request->payment_method,
            'status' => 'pending', // Set default status as pending
            'total_price' => $request->total_price,
        ]);
        $orderItems = [];
        foreach ($request->quantity as $key => $quantity) {
            $productId = $request->product_id[$key];
            $size = $request->size[$key] ?? null; // Lấy kích thước tương ứng từ request
            $color = $request->color[$key] ?? null; // Lấy màu tương ứng từ request

            if (!$size || !$color) {
                return redirect()->back()->withErrors(['message' => 'Dữ liệu size hoặc color không hợp lệ']);
            }

            // Tìm product và variant
            $product = Product::find($productId);
            $variant = Product_Variant::where('product_id', $productId)
                ->whereHas('color', fn($query) => $query->where('value', $color))
                ->whereHas('size', fn($query) => $query->where('value', $size))
                ->first();

            if (!$variant) {
                return redirect()->back()->withErrors(['message' => 'Không tìm thấy biến thể phù hợp cho sản phẩm: ' . $product->name]);
            }

            Order_Items::create([
                'order_id' => $order->id,
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'product_variant_id' => $variant->id, // Đảm bảo truyền đúng variant ID
                'quantity' => $quantity,
                'product_name' => $product->name,
                'product_sku' => $product->sku,
                'product_img_thumbnail' => $product->img_thumbnail,
                'product_price_regular' => $product->price_regular,
                'product_price_sale' => $product->price_sale,
                'size' => $size,  // Đảm bảo truyền đúng size
                'color' => $color, // Đảm bảo truyền đúng color
            ]);
            // Cập nhật tồn kho sau khi đặt hàng
            $variant->stock -= $quantity;
            $variant->save();
        }
            // dd($request->all());
            // Delete the items from the cart after creating order
            Cart::where('user_id', Auth::id())->delete();

            $validatedData['status'] = $request->payment_method === 'vnpay' ? 'err' : 'pending';
            if ($request->payment_method === 'vnpay') {
                return $this->vnpayPayment($order, $request);
            }


        // Redirect to order confirmation page
        return redirect()->route('index')->with('success', 'Cảm Ơn Bạn Đã Đặt Hàng Của Chúng Tôi!');
    }
    public function vnpayPayment($order, Request $request)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.callback');
        $vnp_TmnCode = "UQXJ6R9J";
        $vnp_HashSecret = "3W5U0M95R09Y84G2TXKGZZEI32AJLF2Z";

        $vnp_TxnRef = $order->id;
        $vnp_OrderInfo = "Payment for order: #" . $order->id;
        $vnp_Amount = $order->total_price * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = $request->input('bank_code', 'NCB');
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => 'billpayment',
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if ($vnp_BankCode) {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect($vnp_Url);
    }

    public function vnpayCallback(Request $request)
    {
        $vnp_HashSecret = "3W5U0M95R09Y84G2TXKGZZEI32AJLF2Z";
        $inputData = [];
        foreach ($request->all() as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $hashData = "";
        foreach ($inputData as $key => $value) {
            $hashData .= urlencode($key) . '=' . urlencode($value) . '&';
        }
        $hashData = rtrim($hashData, '&');
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash === $vnp_SecureHash) {
            if ($inputData['vnp_ResponseCode'] == '00') {
                try {
                    DB::beginTransaction();

                    $order = Order::find($inputData['vnp_TxnRef']);

                    if ($order && $order->status === 'err') {
                        $order->status = 'completed';
                        $order->save();
                    }

                    DB::commit();
                    return redirect()->route('index')->with('success', 'Đặt Hàng Thành Công. Thanh Toán Thành Công.');
                } catch (Exception $e) {
                    DB::rollBack();
                    return redirect()->route('index')->with('error', 'Error processing payment: ' . $e->getMessage());
                }
            } else {
                return redirect()->route('index')->with('error', 'Transaction failed.');
            }
        } else {
            return redirect()->route('index')->with('error', 'Invalid signature.');
        }
    }
}
