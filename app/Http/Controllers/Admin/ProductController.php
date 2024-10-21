<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\BinhLuan;
use App\Models\Catalogues;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $view;
    public function __construct()
    {
        $this->view = [];
    }
    public function index()
    {
        $listPro = Product::query()->latest('id')->get();
        return view('admin.product.index', compact('listPro'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $listCate = Catalogues::all();
        return view('admin.product.create', compact('listCate'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        if ($request->isMethod('post')) {
            $params = $request->except('_token');
            $params['is_active'] = $request->has('is_active') ? 1 : 0;
            $params['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;
            $params['is_good_deal'] = $request->has('is_good_deal') ? 1 : 0;
            $params['is_new'] = $request->has('is_new') ? 1 : 0;
            $params['is_show_home'] = $request->has('is_show_home') ? 1 : 0;
            if ($request->hasFile('img_thumbnail')) {
                $flag = true;
                $params['img_thumbnail'] = $request->file('img_thumbnail')->store('products', 'public');
            } else {
                $params['img_thumbnail'] = null;
            }
        }
        $res = Product::query()->create($params);


        if ($res) {
            return redirect()->back()->with('success', 'Sản phẩm đã được thêm mới thành công');
        } else {
            return redirect()->back()->with('error', 'Sản phẩm đã được thêm mới không thành công');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {

        $listCate = Catalogues::all();
        // Lấy thông tin sản phẩm
        $listPro = Product::find($id);

        // Trả về view với dữ liệu danh mục và sản phẩm
        return view('admin.product.edit', compact('listPro', 'listCate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, int $id)
    {
        //
        // Lấy thông tin sản phẩm cần cập nhật
        $product = Product::find($id);

        if ($product) {
            $imageOld = $product->img_thumbnail;

            // Lấy dữ liệu từ request
            $params = $request->except('_token');
            $params['is_active'] = $request->has('is_active') ? 1 : 0;
            $params['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;
            $params['is_good_deal'] = $request->has('is_good_deal') ? 1 : 0;
            $params['is_new'] = $request->has('is_new') ? 1 : 0;
            $params['is_show_home'] = $request->has('is_show_home') ? 1 : 0;

            // Kiểm tra xem có ảnh mới được tải lên không
            if ($request->hasFile('img_thumbnail') && $request->file('img_thumbnail')->isValid()) {
                // Lưu ảnh mới vào thư mục 'products' trên disk 'public'
                $params['img_thumbnail'] = $request->file('img_thumbnail')->store('products', 'public');

                // Xóa ảnh cũ nếu tồn tại
                if ($imageOld && Storage::disk('public')->exists($imageOld)) {
                    Storage::disk('public')->delete($imageOld);
                }
            } else {
                // Không có ảnh mới thì giữ nguyên ảnh cũ
                $params['img_thumbnail'] = $imageOld;
            }

            // Cập nhật dữ liệu sản phẩm
            $res = $product->update($params);

            // Kiểm tra kết quả
            if ($res) {
                return redirect()->back()->with('success', 'Sản phẩm đã được chỉnh sửa thành công');
            } else {
                return redirect()->back()->with('error', 'Sản phẩm đã được chỉnh sửa không thành công');
            }
        } else {
            // Không tìm thấy sản phẩm
            return redirect()->back()->with('error', 'ID sản phẩm không phù hợp');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return response()->json(['success' => true, 'message' => 'Sản phẩm đã được xóa thành công']);
        } else {
            return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại']);
        }
    }


    //binh luan
    public function indexWithComments()
    {
        $listPro = Product::withCount('binh_luans')->latest('id')->get();
        return view('admin.comment.index', compact('listPro'));
    }

}
