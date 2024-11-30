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
