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
        Vouchers::where('end_date', '<', now())
        ->where('status', 'active')
        ->update(['status' => 'expired']);

        Vouchers::where('end_date', '>=', now())
        ->where('status', '!=', 'active')
        ->update(['status' => 'active']);

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
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after_or_equal:start_date',
        'status' => 'required|in:active,expired,disabled',
    ]);
        // Tạo voucher
        Vouchers::create($validated);

        return redirect()->route('vouchers.index')->with('success', 'Voucher created successfully!');
    }
    public function toggleVisibility($id)
{
    $voucher = Vouchers::findOrFail($id);

    // Đổi trạng thái hiển thị
    $voucher->is_visible = !$voucher->is_visible; 
    $voucher->save();

    return redirect()->route('vouchers.index')->with('success', 'Cập nhật trạng thái hiển thị thành công!');
}


    /**
     * Hiển thị form chỉnh sửa voucher.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $voucher = Vouchers::findOrFail($id);
        return view('admin.vouchers.edit', compact('voucher'));
    }

    /**
     * Cập nhật voucher trong cơ sở dữ liệu.
     *

     */
    public function update(Request $request, $id)
    {
        $voucher = Vouchers::findOrFail($id);
    
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

    // Kiểm tra ngày kết thúc
    $currentDate = now(); // Lấy ngày hiện tại
    if (strtotime($validated['end_date']) > strtotime($currentDate)) {
        $validated['status'] = 'active'; // Cập nhật trạng thái về hoạt động nếu ngày kết thúc còn hiệu lực
    } else {
        $validated['status'] = 'expired'; // Đảm bảo trạng thái là hết hạn nếu ngày kết thúc đã qua
    }
    
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
