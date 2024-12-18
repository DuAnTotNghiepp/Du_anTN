<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MaterialRequest;
use App\Http\Requests\UpdateMaterialRequest;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    // Hiển thị danh sách vật liệu
    public function index()
    {
        $listMaterials = Material::all(); // Lấy tất cả chất liệu
        return view('admin.materials.index', compact('listMaterials'));
    }

    // Hiển thị form tạo vật liệu mới
    public function create()
    {
        return view('admin.materials.create');
    }

    // Lưu vật liệu mới
    public function store(MaterialRequest $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',  // Yêu cầu trường name
        ]);

        Material::create($validated);

        return redirect()->route('materials.index')->with('success', 'Chất liệu đã được thêm mới.');
    }

    // Hiển thị form chỉnh sửa vật liệu
    public function edit($id)
    {
        $material = Material::findOrFail($id); // Tìm vật liệu theo ID hoặc trả về lỗi 404
        return view('admin.materials.edit', compact('material'));
    }

    // Cập nhật vật liệu
    public function update(UpdateMaterialRequest $request, $id)
    {
        $material = Material::findOrFail($id); // Tìm vật liệu theo ID

        // Dữ liệu đã được validate qua UpdateMaterialRequest
        $material->update($request->validated());

        return redirect()->route('materials.index')->with('success', 'Chất liệu đã được cập nhật.');
    }


    // Xóa vật liệu
    public function destroy($id)
    {
        // Tìm chất liệu theo ID
        $material = Material::find($id);

        // Kiểm tra nếu không tìm thấy chất liệu
        if (!$material) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy chất liệu.',
            ]);
        }

        // Xóa mềm chất liệu
        $material->delete();

        return response()->json([
            'success' => true,
            'message' => 'Chất liệu đã được xóa (soft delete) thành công.',
        ]);
    }


}
