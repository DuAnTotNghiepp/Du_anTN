<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SanPhamRequest;
use App\Models\BinhLuan;
use App\Models\Catalogues;
use App\Models\Product;
use App\Models\Product_Variant;
use App\Models\ProductGallerie;
use App\Models\Variant;
use App\Models\Variants;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

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
        $listPro = Product::query()->latest('id')->paginate(10);
        return view('admin.product.index', compact('listPro'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $listCate = Catalogues::where('is_active', true)->get();

        $materials = \App\Models\Material::all();
        $Color = Variant::where('name', 'Color')->get();
        $Size = Variant::where('name', 'Size')->get();
        return view('admin.product.create', compact('listCate', 'Color', 'Size', 'materials'));


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SanPhamRequest $request)
    {
        if ($request->isMethod('post')) {
            $params = $request->except('_token');
            $params['is_active'] = $request->has('is_active') ? 1 : 0;
            $params['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;

            // Kiểm tra danh mục hoạt động
            $catalogue = Catalogues::find($params['catalogues_id']);
            if (!$catalogue || !$catalogue->is_active) {
                return redirect()->back()->with('error', 'Không thể thêm sản phẩm vào danh mục không hoạt động.');
            }

            if ($request->hasFile('img_thumbnail')) {
                $params['img_thumbnail'] = $request->file('img_thumbnail')->store('products', 'public');
            } else {
                $params['img_thumbnail'] = null;
            }

            $res = Product::query()->create($params);

            if ($request->has('selected_variants') && is_array($request->selected_variants)) {
                foreach ($request->selected_variants as $colorId => $sizes) {
                    foreach ($sizes as $sizeId => $selected) {
                        // Kiểm tra checkbox và số lượng nhập vào
                        if ($selected && isset($request->stock[$colorId][$sizeId]) && $request->stock[$colorId][$sizeId] > 0) {
                            $stock = $request->stock[$colorId][$sizeId];

                            // Lưu thông tin variant
                            Product_Variant::create([
                                'product_id' => $res->id,
                                'color_variant_id' => $colorId,
                                'size_variant_id' => $sizeId,
                                'stock' => $stock,
                            ]);
                        }
                    }
                }
            }

            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $path = $image->store('product_galleries', 'public');
                    ProductGallerie::create([
                        'product_id' => $res->id,
                        'image' => $path
                    ]);
                }
            }

            if ($res) {
                return redirect()->back()->with('success', 'Sản phẩm đã được thêm mới thành công');
            } else {
                return redirect()->back()->with('error', 'Sản phẩm đã được thêm mới không thành công');
            }
        }
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {

        $listCate = Catalogues::where('is_active', true)->get();;
        // Lấy thông tin sản phẩm
        $listPro = Product::find($id);

        $materials = \App\Models\Material::all();
        // dd($listPro->material_id);


        $listImg = ProductGallerie::where('product_id', $id)->get();
        $Color = Variant::where('name', 'Color')->get();
        $Size = Variant::where('name', 'Size')->get();
        $vari_id = DB::table('product__variants')->where('product_id', $id)->pluck('variants_id')->toArray();
        return view('admin.product.edit', compact('listPro', 'listCate', 'Color', 'Size', 'vari_id', 'listImg', 'materials'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        // Lấy thông tin sản phẩm cần cập nhật
        $product = Product::find($id);

        if ($product) {
            $imageOld = $product->img_thumbnail;

            // Lấy dữ liệu từ request
            $params = $request->except('_token');

            // Cập nhật trạng thái các trường khác
            $params['is_active'] = $request->has('is_active') ? 1 : 0;
            $params['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;

            // Kiểm tra xem danh mục có hoạt động không
            $catalogue = Catalogues::find($params['catalogues_id']);
            if (!$catalogue || !$catalogue->is_active) {
                return redirect()->back()->with('error', 'Danh mục được chọn không hoạt động. Vui lòng chọn danh mục khác.');
            }

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
    public function updateQuantity($id)
    {
        // Lấy sản phẩm theo ID
        $product = Product::with('productVariants')->find($id);

        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Sản phẩm không tồn tại!');
        }

        // Tính tổng số lượng từ các biến thể (từ bảng product_variants)
        $totalQuantity = $product->productVariants->sum('stock'); // Cộng dồn số lượng tồn kho

        // Cập nhật số lượng vào bảng product
        $product->quantity = $totalQuantity;
        $product->save();

        return redirect()->route('product.index')->with('success', 'Số lượng sản phẩm đã được cập nhật!');
    }
    }

    public function bestSellingProducts(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $products = DB::table('order_items')
            ->select(
                'products.id as product_id',
                'products.name as product_name',
                'products.sku as product_sku',
                'products.img_thumbnail as product_img_thumbnail',
                'products.price_regular as product_price',
                DB::raw('SUM(order_items.quantity) as total_orders')
            )
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'hoanthanh')
            ->when($startDate, function ($query, $startDate) {
                return $query->whereDate('orders.created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query, $endDate) {
                return $query->whereDate('orders.created_at', '<=', $endDate);
            })
            ->groupBy('products.id')
            ->orderBy('total_orders', 'DESC')
            ->limit(5)
            ->get();

        $users = DB::table('orders')
            ->select(
                'user_email',
                DB::raw('SUM(total_price) as total_price'),
                DB::raw('COUNT(id) as total_orders')
            )
            ->where('status', 'hoanthanh')
            ->when($startDate, function ($query, $startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query, $endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->groupBy('user_email')
            ->orderBy('total_price', 'DESC')
            ->limit(5)
            ->get();

        return view('admin.statistical.index', compact('products', 'users'));
    }


}
