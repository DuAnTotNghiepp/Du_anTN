<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\BinhLuan;
use App\Models\Catalogues;
use App\Models\Product;
use App\Models\Product_Variant;
use App\Models\ProductGallerie;
use App\Models\Variants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
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
        $materials = \App\Models\Material::all();
        $Color = Variants::where('name', 'Color')->get();
        $Size = Variants::where('name', 'Size')->get();
        return view('admin.product.create', compact('listCate', 'Color', 'Size', 'materials'));
    }

    public function store(Request $request)
    {
        try {
            // Validate trực tiếp các input với custom messages
            $validated = $request->validate([
                'name' => 'required|string|min:3|max:255',
                'img_thumbnail' => 'required|image|mimes:jpeg,png,gif,jpg|max:2048',
                'price_regular' => 'required|numeric|min:0',
                'price_sale' => 'required|numeric|min:0|lt:price_regular',
                'quantity' => 'required|integer|min:0',
                'description' => 'required|string|min:3|max:2000',
                'user_manual' => 'required|string|min:3|max:2000',
                'content' => 'required|string|min:3|max:5000',
                'sku' => 'required|unique:products,sku|max:255',
                'image' => 'required|array',
                'image.*' => 'required|image|mimes:jpeg,png,gif,jpg|max:2048',
                // 'category_id' => 'required|exists:categories,id',
            ], [
                'name.required' => 'Tên sản phẩm là trường bắt buộc.',
                'name.string' => 'Tên sản phẩm phải là một chuỗi ký tự.',
                'name.min' => 'Tên sản phẩm không được dưới 3 ký tự.',
                'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',

                'img_thumbnail.required' => 'Ảnh sản phẩm là trường bắt buộc.',
                'img_thumbnail.image' => 'Ảnh sản phẩm phải là tệp hình ảnh hợp lệ.',
                'img_thumbnail.mimes' => 'Ảnh sản phẩm chỉ hỗ trợ các định dạng: jpeg, png, gif, jpg.',
                'img_thumbnail.max' => 'Ảnh sản phẩm không được vượt quá 2048 KB.',

                'price_regular.required' => 'Giá thường là trường bắt buộc.',
                'price_regular.numeric' => 'Giá thường phải là một số.',
                'price_regular.min' => 'Giá thường phải lớn hơn hoặc bằng 0.',

                'price_sale.required' => 'Giá khuyến mãi là trường bắt buộc.',
                'price_sale.min' => 'Giá khuyến mãi không được âm.',
                'price_sale.numeric' => 'Giá khuyến mãi phải là một số.',
                'price_sale.lt' => 'Giá khuyến mãi phải nhỏ hơn giá thường.',

                'quantity.required' => 'Số lượng là trường bắt buộc.',
                'quantity.integer' => 'Số lượng phải là một số nguyên.',
                'quantity.min' => 'Số lượng phải lớn hơn hoặc bằng 0.',

                'description.required' => 'Mô tả là trường bắt buộc.',
                'description.min' => 'Mô tả không được dưới 3 ký tự.',
                'description.max' => 'Mô tả không được vượt quá 2000 ký tự.',

                'sku.required' => 'Mã sản phẩm (SKU) là trường bắt buộc.',
                'sku.unique' => 'Mã sản phẩm (SKU) phải là duy nhất.',
                'sku.max' => 'Mã sản phẩm (SKU) không được vượt quá 255 ký tự.',

                'user_manual.required' => 'Hướng dẫn sử dụng là trường bắt buộc.',
                'user_manual.min' => 'Hướng dẫn sử dụng không được dưới 3 ký tự.',
                'user_manual.max' => 'Hướng dẫn sử dụng không được vượt quá 2000 ký tự.',

                'content.required' => 'Nội dung chi tiết là trường bắt buộc.',
                'content.min' => 'Nội dung chi tiết không được dưới 3 ký tự.',
                'content.max' => 'Nội dung chi tiết không được vượt quá 5000 ký tự.',

                // 'category_id.required' => 'Danh mục là trường bắt buộc.',
                // 'category_id.exists' => 'Danh mục không tồn tại.',

                'image.required' => 'Ảnh liên quan là trường bắt buộc.',
                'image.array' => 'Ảnh liên quan phải là một mảng.',
                'image.*.image' => 'Mỗi tệp trong danh sách ảnh phải là tệp hình ảnh.',
                'image.*.mimes' => 'Mỗi ảnh liên quan chỉ hỗ trợ các định dạng: jpeg, png, gif, jpg.',
                'image.*.max' => 'Mỗi ảnh liên quan không được vượt quá 2048 KB.',
            ]);

             $params = $request->except('_token');

        // Lấy material_id từ request và thêm vào params
        $params['material_id'] = $request->input('material_id'); // Thêm material_id

        // Các thuộc tính boolean
        $params['is_active'] = $request->has('is_active') ? 1 : 0;
        $params['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;
        $params['is_good_deal'] = $request->has('is_good_deal') ? 1 : 0;
        $params['is_new'] = $request->has('is_new') ? 1 : 0;
        $params['is_show_home'] = $request->has('is_show_home') ? 1 : 0;

        // Xử lý hình ảnh thumbnail
        if ($request->hasFile('img_thumbnail')) {
            $params['img_thumbnail'] = $request->file('img_thumbnail')->store('products', 'public');
        } else {
            $params['img_thumbnail'] = null;
        }

        // Tạo sản phẩm mới
        $res = Product::query()->create($params);

        // Thêm thông tin sản phẩm variant nếu có
        if ($request->has('id_variant')) {
            foreach ($request->id_variant as $value) {
                Product_Variant::create([
                    'product_id' => $res->id,
                    'variants_id' => $value
                ]);
            }
        }

        // Thêm hình ảnh liên quan nếu có
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $path = $image->store('product_galleries', 'public');
                ProductGallerie::create([
                    'product_id' => $res->id,
                    'image' => $path
                ]);
            }
        }

        // Kiểm tra kết quả và trả về thông báo thành công
        return redirect()->back()->with('success', 'Sản phẩm đã được thêm mới thành công');
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Nếu xảy ra lỗi validate, chuyển hướng lại với các thông báo lỗi
        return redirect()->back()->withErrors($e->validator)->withInput();
    } catch (\Exception $e) {
        // Nếu xảy ra lỗi khác, trả về thông báo lỗi tổng quát
        return redirect()->back()->with('error', 'Đã có lỗi xảy ra: ' . $e->getMessage());
    }
}





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
        $materials = \App\Models\Material::all();
        // dd($listPro->material_id);


        $listImg = ProductGallerie::where('product_id', $id)->get();
        $Color = Variants::where('name', 'Color')->get();
        $Size = Variants::where('name', 'Size')->get();
        $vari_id = DB::table('product__variants')->where('product_id', $id)->pluck('variants_id')->toArray();
        return view('admin.product.edit', compact('listPro', 'listCate', 'Color', 'Size', 'vari_id', 'listImg', 'materials'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        // Debug dữ liệu nhận được từ form
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'img_thumbnail' => 'nullable|image|mimes:jpeg,png,gif,jpg|max:2048',  // img_thumbnail không bắt buộc trong update
            'price_regular' => 'required|numeric|min:0',
            'price_sale' => 'required|numeric|lt:price_regular',
            'quantity' => 'required|integer|min:0',
            'sku' => 'required|max:255|unique:products,sku,' . $id,
            'description' => 'required|string|max:2000',
            'user_manual' => 'required|string|max:2000',
            'content' => 'required|string|max:5000',
            'image' => 'nullable|array',  // ảnh liên quan có thể không có khi update
            'image.*' => 'nullable|image|mimes:jpeg,png,gif,jpg|max:2048',  // ảnh liên quan không bắt buộc trong update
        ], [
            'name.required' => 'Tên sản phẩm là trường bắt buộc.',
            'name.string' => 'Tên sản phẩm phải là một chuỗi ký tự.',
            'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',
            'img_thumbnail.image' => 'Ảnh sản phẩm phải là tệp hình ảnh hợp lệ.',
            'img_thumbnail.mimes' => 'Ảnh sản phẩm chỉ hỗ trợ các định dạng: jpeg, png, gif, jpg.',
            'img_thumbnail.max' => 'Ảnh sản phẩm không được vượt quá 2048 KB.',
            'price_regular.required' => 'Giá thường là trường bắt buộc.',
            'price_regular.numeric' => 'Giá thường phải là một số.',
            'price_regular.min' => 'Giá thường phải lớn hơn hoặc bằng 0.',
            'price_sale.required' => 'Giá khuyến mãi là trường bắt buộc.',
            'price_sale.numeric' => 'Giá khuyến mãi phải là một số.',
            'price_sale.lt' => 'Giá khuyến mãi phải nhỏ hơn giá thường.',
            'quantity.required' => 'Số lượng là trường bắt buộc.',
            'quantity.integer' => 'Số lượng phải là một số nguyên.',
            'quantity.min' => 'Số lượng phải lớn hơn hoặc bằng 0.',
            'description.required' => 'Mô tả là trường bắt buộc.',
            'description.max' => 'Mô tả không được vượt quá 2000 ký tự.',

            'sku.required' => 'Mã sản phẩm (SKU) là trường bắt buộc.',
            // 'sku.unique' => 'Mã sản phẩm (SKU) phải là duy nhất.',
            'sku.max' => 'Mã sản phẩm (SKU) không được vượt quá 255 ký tự.',

            'user_manual.required' => 'Hướng dẫn sử dụng là trường bắt buộc.',
            'user_manual.max' => 'Hướng dẫn sử dụng không được vượt quá 2000 ký tự.',
            'content.required' => 'Nội dung chi tiết là trường bắt buộc.',
            'content.max' => 'Nội dung chi tiết không được vượt quá 5000 ký tự.',
            'image.required' => 'Ảnh liên quan là trường bắt buộc.',
            'image.array' => 'Ảnh liên quan phải là một mảng.',
            'image.*.image' => 'Mỗi tệp trong danh sách ảnh phải là tệp hình ảnh.',
            'image.*.mimes' => 'Mỗi ảnh liên quan chỉ hỗ trợ các định dạng: jpeg, png, gif, jpg.',
            'image.*.max' => 'Mỗi ảnh liên quan không được vượt quá 2048 KB.',
        ]);

        // Lấy thông tin sản phẩm cần cập nhật
        $product = Product::find($id);

        if ($product) {
            $imageOld = $product->img_thumbnail;

            // Lấy dữ liệu từ request
            $params = $request->except('_token');

            // Cập nhật trạng thái các trường khác
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

            $selectedVariants = $request->input('id_variant', []);

            // Lấy các variants_id hiện tại từ cơ sở dữ liệu
            $currentVariants = DB::table('product__variants')
                ->where('product_id', $id)
                ->pluck('variants_id')
                ->toArray();

            // Xác định các thuộc tính cần thêm và cần xóa
            $variantsToAdd = array_diff($selectedVariants, $currentVariants);
            $variantsToRemove = array_diff($currentVariants, $selectedVariants);

            // Xóa các thuộc tính không còn chọn
            if (!empty($variantsToRemove)) {
                DB::table('product__variants')
                    ->where('product_id', $id)
                    ->whereIn('variants_id', $variantsToRemove)
                    ->delete();
            }

            // Thêm các thuộc tính mới vào bảng product__variants
            foreach ($variantsToAdd as $variantId) {
                DB::table('product__variants')->insert([
                    'product_id' => $id,
                    'variants_id' => $variantId,
                ]);
            }

            // Kiểm tra ảnh liên quan và xử lý
            if ($request->hasFile('image')) {
                // Xóa các ảnh liên quan cũ
                $oldImages = ProductGallerie::where('product_id', $id)->get();
                foreach ($oldImages as $image) {
                    if (Storage::disk('public')->exists($image->image)) {
                        Storage::disk('public')->delete($image->image);
                    }
                    $image->delete();
                }

                // Thêm các ảnh liên quan mới
                foreach ($request->file('image') as $file) {
                    $path = $file->store('product_galleries', 'public');
                    ProductGallerie::create([
                        'product_id' => $id,
                        'image' => $path,
                    ]);
                }
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
            return redirect()->back()->with('error', 'ID sản phẩm không phù hợp');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $totalQuantity = Product::sum('quantity');
        $product = Product::find($id);

        if ($product) {
            if ($totalQuantity <= 5) {
                return response()->json(['success' => false, 'message' => 'Sản phẩm không được dưới 5']);
            } else {
                $product->delete();
                return response()->json(['success' => true, 'message' => 'Sản phẩm đã được xóa thành công']);
            }
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


    public function getVariants($id)
    {
        $product = Product::with('variants')->find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Trả về các biến thể của sản phẩm
        return response()->json($product->variants);
    }
}
