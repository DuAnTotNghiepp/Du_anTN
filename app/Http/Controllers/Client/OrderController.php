<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Order_Items;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function vnpay_ment(Request $request)
{
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = "http://du_antn-main.test/shop"; // Đường dẫn sau khi thanh toán thành công
    $vnp_TmnCode = "UQXJ6R9J"; // Mã website tại VNPAY
    $vnp_HashSecret = "3W5U0M95R09Y84G2TXKGZZEI32AJLF2Z"; // Chuỗi bí mật

    $vnp_TxnRef = time(); // Mã đơn hàng duy nhất
    $vnp_OrderInfo = 'Thanh toán đơn hàng';
    $vnp_OrderType = 'billpayment';
    $vnp_Amount = 222222 * 100; // Số tiền (nhân 100 vì VNPAY tính theo đơn vị nhỏ nhất)
    $vnp_Locale = 'vn';
    $vnp_BankCode = 'NCB';
    $vnp_IpAddr = $request->ip();

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
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
    );

    ksort($inputData);
    $query = "";
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        $hashdata .= urlencode($key) . "=" . urlencode($value) . '&';
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $hashdata = rtrim($hashdata, '&');
    $query = rtrim($query, '&');

    if (isset($vnp_HashSecret)) {
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $query .= '&vnp_SecureHash=' . $vnpSecureHash;
    }

    $vnp_Url .= "?" . $query;

    // Chuyển hướng đến URL của VNPay
    return redirect($vnp_Url);
}
    public function store(Request $request)
    {
        // Xác thực dữ liệu
        $validatedData = $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|max:255',
            'user_phone' => 'required|string|max:20',
            'user_address' => 'nullable|string|max:255',
            'user_note' => 'nullable|string',
            'payment_method' => 'required|in:cash,online',
            'product_id' => 'required|exists:products,id',
            'total_price' => 'required|numeric',
            'quantity' => 'integer|min:1',
            'size' => 'required|string',
            'color' => 'required|string',
        ]);

        // Thêm user_id từ phiên đăng nhập
        $validatedData['user_id'] = auth()->id();

        if (!$validatedData['user_id']) {
            return redirect()->back()->with('error', 'Bạn cần đăng nhập để đặt hàng.');
        }
        $product = Product::findOrFail($validatedData['product_id']);
        $variant = $product->variants()->first();

        $quantity = $validatedData['quantity'];
        if ($product->quantity < $quantity) {
            return redirect()->back()->withErrors(['message' => 'Số lượng sản phẩm không đủ trong kho.']);
        }

        $order = Order::create($validatedData);

        $size = $request->input('size');
        $color = $request->input('color');
        Order_Items::create([
            'cart_id' => null,
            'product_variant_id' => $variant ? $variant->id : null,
            'quantity' => $quantity,
            'product_name' => $product->name,
            'product_sku' => $product->sku,
            'product_img_thumbnail' => $product->img_thumbnail,
            'product_price_regular' => $product->price_regular,
            'product_price_sale' => $product->price_sale,
            'size' => $size,
            'color' => $color,
            'order_id' => $order->id,
        ]);
        $product->quantity -= $quantity;
        $product->save();
        if ($request->input('payment_method') === 'online') {
            // Xử lý thanh toán online qua VNPay
            return redirect()->route('orders.vnpay_ment');
        }
        // Chuyển hướng hoặc trả về thông báo thành công
        return redirect()->route('index')->with('success', '......................Đơn hàng đã được thêm thành công.');
    }
}
