<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use App\Models\Vouchers;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
  
    public function index()
    {
        $vouchers = Vouchers::all(); // Lấy danh sách voucher
        return view('admin.vouchers.index', compact('vouchers')); // Gửi dữ liệu đến view
    }

    
    public function create()
    {
        return view('admin.vouchers.create');
    }

   
    public function store(Request $request)
    {
        // Validate dữ liệu
        $validated = $request->validate([
            'code' => 'required|string|unique:vouchers',
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric|min:0',
            'minimum_order_value' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:active,expired,disabled',
        ]);

        // Tạo voucher
        Vouchers::create($validated);

        return redirect()->route('vouchers.index')->with('success', 'Voucher created successfully!');
    }

    /**
     * Hiển thị form chỉnh sửa voucher.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $voucher = Vouchers::findOrFail($id); // Lấy voucher theo id
        return view('admin.vouchers.edit', compact('voucher'));
    }

    /**
     * Cập nhật voucher trong cơ sở dữ liệu.
     *

     */
    public function update(Request $request, $id)
    {
        $voucher = Vouchers::findOrFail($id);

        // Validate dữ liệu
        $validated = $request->validate([
            'code' => 'required|string|unique:vouchers,code,' . $voucher->id,
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric|min:0',
            'minimum_order_value' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:active,expired,disabled',
        ]);

        // Cập nhật dữ liệu
        $voucher->update($validated);

        return redirect()->route('vouchers.index')->with('success', 'Voucher updated successfully!');
    }

    public function destroy($id)
    {
        $voucher = Vouchers::findOrFail($id);
        $voucher->delete();

        return redirect()->route('vouchers.index')->with('success', 'Voucher deleted successfully!');
    }
    
}
