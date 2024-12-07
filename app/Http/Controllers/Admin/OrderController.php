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
        $data = Order::with('address')->latest('id')->get();
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
            'status' => 'required|in:pending,completed,canceled',
            'user_note' => 'nullable|string',
        ]);

        $allowedStatusTransitions = [
            'pending' => ['completed', 'canceled'],
            'completed' => [],
            'canceled' => [],
            'unpaid' => ['pending'],
        ];

        $currentStatus = $order->status;
        $newStatus = $validatedData['status'];

        if (!array_key_exists($currentStatus, $allowedStatusTransitions)) {
            return redirect()->back()->with('error', 'Trạng thái hiện tại không hợp lệ.');
        }

        if (!in_array($newStatus, $allowedStatusTransitions[$currentStatus])) {
            return redirect()->back()->with('error', 'Không thể thay đổi trạng thái này.');
        }
        $order->update([
            'status' => $validatedData['status'],
            'user_note' => $validatedData['user_note'] ?? null,
        ]);

        return redirect()->route('order.edit', $id)->with('success', 'Cập nhật trạng thái thành công.');
    }
}
