<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product_Variant;
use Illuminate\Http\Request;

class Product_VariantController extends Controller
{
    //
    public function index()
    {
        $listPro = Product_Variant::query()->latest('id')->get();
        return view('admin.product_variant.index', compact('listPro'));
    }
    public function edit(int $id)
    {
        $listPro = Product_Variant::find($id);
        return view('admin.product_variant.edit', compact('listPro'));
    }
    public function update(Request $request, $id)
    {
        $productVariant = Product_Variant::find($id);

        if (!$productVariant) {
            return redirect()->route('product_variant.index')->with('error', 'Biến thể sản phẩm không tồn tại!');
        }

        // Xử lý validation và cập nhật thông tin
        $validated = $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        // Cập nhật biến thể
        $productVariant->update([
            'quantity' => $validated['quantity'],
        ]);

        // Chuyển hướng về danh sách biến thể sản phẩm với thông báo thành công
        return redirect()->route('product_variant.index')->with('success', 'Cập nhật biến thể sản phẩm thành công!');
    }




}
