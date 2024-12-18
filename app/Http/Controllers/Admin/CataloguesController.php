<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalogues;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CataloguesController extends Controller
{


    public function index()
    {
        $categories = Catalogues::withCount('products')->orderBy('id', 'desc')->get();

        return view('admin.catalogue.index', compact('categories'));
    }

    // Store new category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Catalogues::create([
            'name' => $request->name,
            'is_active' => $request->is_active ? true : false,
        ]);

        return redirect()->route('admin.index')->with('success', 'Danh mục được thêm thành công!');
    }

    public function update(Request $request, $id)
    {
        $catalogue = Catalogues::findOrFail($id);

        // Nếu trạng thái muốn chuyển sang "không hoạt động"
        if (!$request->is_active && $catalogue->hasProducts()) {
            return redirect()->back()->withErrors(['message' => 'Không thể tắt hoạt động danh mục khi còn sản phẩm liên kết.']);
        }

        // Cập nhật thông tin danh mục
        $catalogue->update([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.index')->with('success', 'Danh mục đã được cập nhật.');
    }


        public function destroy($id)
    {
        $catalogue = Catalogues::findOrFail($id);

        // Kiểm tra xem danh mục có sản phẩm liên kết không
        if ($catalogue->products()->count() > 0) {
            return redirect()->route('admin.index')->withErrors('Danh mục này đang có sản phẩm liên kết và không thể xóa.');
        }

        // Thực hiện xóa mềm
        $catalogue->delete();

        return redirect()->route('admin.index')->with('success', 'Danh mục đã được xóa.');
    }
}

