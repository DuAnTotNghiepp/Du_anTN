<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Product;
use Exception;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(OrderRequest $request)
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

        $validatedData['user_id'] = auth()->id();

        $validatedData['status'] = $request->payment_method === 'vnpay' ? 'err' : 'unpaid';
    

        $order = Order::create($validatedData);

        if ($request->payment_method === 'vnpay') {
            return $this->vnpayPayment($order, $request);
        }

    
        return redirect()->route('index')->with('success', 'Order placed successfully with cash on delivery.');
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
                        $order->status = 'paid'; 
                        $order->save();
                    }

                    DB::commit();
                    return redirect()->route('index')->with('success', 'Payment successful. Order status updated.');
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


//     public function vnpayReturn(Request $request)
// {
//     $vnp_HashSecret = "3W5U0M95R09Y84G2TXKGZZEI32AJLF2Z"; // Chuỗi bí mật của bạn
//     $vnp_SecureHash = $request->get('vnp_SecureHash');
//     $inputData = $request->except('vnp_SecureHash', 'vnp_SecureHashType');

//     // Sắp xếp các tham số theo thứ tự A-Z
//     ksort($inputData);
//     $hashdata = "";
//     foreach ($inputData as $key => $value) {
//         $hashdata .= $key . '=' . $value . '&';
//     }
//     $hashdata = rtrim($hashdata, '&');

//     // Tạo chữ ký
//     $calculatedHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);

//     // Kiểm tra chữ ký
//     if ($calculatedHash === $vnp_SecureHash) {
//         // Chữ ký hợp lệ, xử lý tiếp
//         return response()->json(['message' => 'Thanh toán thành công']);
//     } else {
//         // Chữ ký không hợp lệ
//         return response()->json(['message' => 'Sai chữ ký'], 400);
//     }
// }








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
