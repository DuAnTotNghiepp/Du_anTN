<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Order::query()->latest('id')->get();
        return view('admin.order.index', compact('data'));
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
    public function store(Request $request) {}



    /**
     * Display the specified resource.
     */
    public function show($id) {}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        //
        $orde = Order::find($id);
        return view('admin.order.edit', compact('orde'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
{
    // Kiểm tra xem user_id có tồn tại trong đơn hàng hay không
    if (is_null($order->user_id)) {
        return redirect()->back()->with('error', 'Không tìm thấy user_id cho đơn hàng.');
    }

    $validatedData = $request->validate([
        'status' => 'required|in:pending,completed,canceled',
        'user_note' => 'nullable|string',
    ]);

    // Cập nhật thông tin đơn hàng
    $order->status = $validatedData['status'];
    $order->user_note = $validatedData['user_note'];

    // Lưu thay đổi vào cơ sở dữ liệu
    if ($order->save()) {
        return redirect()->back()->with('success', 'Trạng thái đơn hàng đã được cập nhật thành công');
    } else {
        return redirect()->back()->with('error', 'Cập nhật trạng thái đơn hàng không thành công');
    }
}





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
