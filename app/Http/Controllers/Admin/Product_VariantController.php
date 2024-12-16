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
        $listPro = Product_Variant::with(['product', 'color', 'size'])->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.product_variant.index', compact('listPro'));
    }
    public function updateStock(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:product_variants,id',
            'stock' => 'required|integer|min:0',
        ]);

        $productVariant = Product_Variant::find($validated['id']);
        $productVariant->stock = $validated['stock'];
        $productVariant->save();

        return response()->json([
            'success' => true,
            'message' => 'Stock updated successfully!',
            'stock' => $productVariant->stock,
        ]);
    }
    public function destroy($id)
    {
        // Tìm biến thể theo ID
        $productVariant = Product_Variant::find($id);

        // Kiểm tra nếu biến thể không tồn tại
        if (!$productVariant) {
            return response()->json([
                'success' => false,
                'message' => 'Biến thể không tồn tại!',
            ], 404);
        }

        // Xóa biến thể
        $productVariant->delete();

        return response()->json([
            'success' => true,
            'message' => 'Xóa biến thể thành công!',
        ]);
    }

}
