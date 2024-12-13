<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Variants;
use App\Http\Requests\StoreVariantsRequest;
use App\Http\Requests\UpdateVariantsRequest;
use Illuminate\Http\Request;

class VariantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $listVari = Variants::query()->latest('id')->get();
        return view('admin.variant.index', compact('listVari'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVariantsRequest $request)
    {
        // $validateData = $request->validated([

        // ])
        // Khởi tạo một instance mới của Variants
        $variant = new Variants();

        // Gán giá trị "thuoctinh" (Color hoặc Size) vào trường "name"
        $variant->name = $request->input('thuoctinh');

        // Gán giá trị cho trường "value" (nếu có)
        if ($request->input('thuoctinh') === 'Color') {
            $variant->value = $request->input('color_value'); // Giá trị từ input color
        } elseif ($request->input('thuoctinh') === 'Size') {
            $variant->value = $request->input('size_value'); // Giá trị từ input size
        }

        // Kiểm tra giá trị của value trước khi lưu
        if (is_null($variant->value)) {
            return redirect()->back()->withErrors(['msg' => 'Vui lòng nhập giá trị cho thuộc tính.']);
        }

        // Lưu vào cơ sở dữ liệu
        $variant->save();

        return redirect()->route('variant.index')->with('success', 'Thêm thuộc tính thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Variants $variants)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Variants $variants)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVariantsRequest $request, Variants $variants)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $variant = Variants::find($id);

        if (!$variant) {
            return response()->json(['success' => false, 'message' => 'Biến thể không tồn tại.'], 404);
        }

        $variant->delete();

        return response()->json(['success' => true, 'message' => 'Biến thể đã được xóa thành công.']);
    }
}
