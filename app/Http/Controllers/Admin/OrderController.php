<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
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
        $data = Order::with('address')->latest('id')->orderBy('created_at', 'desc')->paginate(10);
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
    public function show($id)
    {
        $order = Order::with('items')->findOrFail($id);
        $address = Address::find($order->user_address);
        // if ($order->items->isEmpty()) {
        //     dd('No items found for this order.'); // In ra thông báo nếu không có sản phẩm
        // }
        return view('admin.order.show', compact('order','address'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        //
        $orde = Order::with('address')->find($id);
        $address = Address::find($orde->user_address);
        return view('admin.order.edit', compact('orde','address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn hàng.');
        }

        if (!$order->user_id) {
            return redirect()->back()->with('error', 'Không tìm thấy user_id cho đơn hàng.');
        }

        $validatedData = $request->validate([
            'status' => 'required|in:pending,completed,canceled,delivery,delivered,confirmed',  // Thêm 'confirmed' nếu trạng thái của bạn là 'đã xác nhận'
            'user_note' => 'nullable|string',
        ]);

        // Mảng trạng thái hợp lệ
        $allowedStatusTransitions = [
            'pending' => ['completed', 'canceled'],
            'completed' => ['delivery'],
            'delivery' => ['delivered'],
            'delivered' => [],
            'canceled' => [],
        ];

        $currentStatus = $order->status;
        $newStatus = $validatedData['status'];

        // Kiểm tra xem trạng thái hiện tại có hợp lệ không
        if (!array_key_exists($currentStatus, $allowedStatusTransitions)) {
            return redirect()->back()->with('error', 'Trạng thái hiện tại không hợp lệ.');
        }

        // Kiểm tra xem trạng thái mới có thể chuyển từ trạng thái hiện tại không
        if (!in_array($newStatus, $allowedStatusTransitions[$currentStatus])) {
            return redirect()->back()->with('error', 'Không thể thay đổi trạng thái này.');
        }

        // Cập nhật đơn hàng với trạng thái mới và ghi chú của người dùng
        $order->update([
            'status' => $validatedData['status'],
            'user_note' => $validatedData['user_note'] ?? '',
        ]);

        return redirect()->route('order.edit', $id)->with('success', 'Cập nhật trạng thái thành công.');
    }


}
