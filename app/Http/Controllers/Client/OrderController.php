<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function store(OrderRequest $request)

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
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


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        // Xác thực dữ liệu
        $validatedData = $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|max:255',
            'user_phone' => 'required|string|max:20',
            'user_address' => 'nullable|string|max:255',
            'user_note' => 'nullable|string',
            'product_id' => 'required|exists:products,id',
            'total_price' => 'required|numeric',
        ]);
        // Thêm user_id từ phiên đăng nhập
        $validatedData['user_id'] = auth()->id();

        if (!$validatedData['user_id']) {
            return redirect()->back()->with('error', 'Bạn cần đăng nhập để đặt hàng.');
        }
        // Thêm đơn hàng vào cơ sở dữ liệu
        Order::create($validatedData);

        // Chuyển hướng hoặc trả về thông báo thành công
        return redirect()->route('index')->with('success', '......................Đơn hàng đã được thêm thành công.');
    }



    /**
     * Display the specified resource.
     */
    public function show($id) {}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
