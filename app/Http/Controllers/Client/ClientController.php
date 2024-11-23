<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Catalogues;
use App\Models\BinhLuan;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Models\Variants;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = Catalogues::query()->get();
        $products = Product::query()->get();

        // Lấy tất cả sản phẩm
        $listSp = Product::where('is_active', 1)->get(); // Hiển thị tất cả sản phẩm

        // Lấy sản phẩm hot
        $listHot = Product::where('is_hot_deal', 1)->get();

        return view('client.home', compact(['listSp', 'listHot', 'data', 'products']));
    }
    public function getProductsByCategory(Request $request)
    {
        $category = $request->input('category'); // Lấy danh mục từ request

        Log::info('Category được gửi:', ['category' => $category]);

        if ($category === 'all') {
            $products = Product::where('is_active', 1)->get();
        } else {
            $catalogue = Catalogues::where('name', $category)->first();

            if ($catalogue) {
                $products = $catalogue->products()->where('is_active', 1)->get();
                Log::info('Sản phẩm trong danh mục:', $products->toArray());
            } else {
                $products = collect();
                Log::warning('Không tìm thấy danh mục:', ['category' => $category]);
            }
        }

        return response()->json(['products' => $products]);
    }





    public function shop(Request $request)
    {
        $data = Catalogues::query()->get();

    // Lấy tất cả sản phẩm
    $listSp = Product::where('is_active', 1)->get(); // Hiển thị tất cả sản phẩm

    // Lấy sản phẩm hot
    $listHot = Product::where('is_hot_deal', 1)->get();
    //list sp moi
    $products = Product::orderBy('created_at', 'desc')->paginate(12);

    return view('client.shop', compact(['listSp', 'listHot', 'data','products']));
    }
    //tim kiem
    public function search(Request $request)
{
    $searchTerm = $request->input('sidebar-search-input');
    $minPrice = $request->input('price_min');
    $maxPrice = $request->input('price_max');
    $luachon = $request->input('category-sort', 'default');
    // tại ra quẻyy tìm kiếm
    $query = Product::query();

    if ($searchTerm) {
        $query->where('name', 'like', '%' . $searchTerm . '%');
    }

    if (is_numeric($minPrice) && is_numeric($maxPrice)) {
        $query->whereBetween('price_regular', [$minPrice, $maxPrice]);
    }
    if ($luachon == 'price_asc') {
        $query->orderBy('price_regular', 'asc'); // Sắp xếp theo giá từ thấp đến cao
    } elseif ($luachon == 'price_desc') {
        $query->orderBy('price_regular', 'desc'); // Sắp xếp theo giá từ cao đến thấp
    }

    $products = $query->get();

    return view('client.shop', compact('products'));
}




    // public function show($id)
    // {
    //     // Tìm sản phẩm theo ID
    //     $product = Product::findOrFail($id);

    //     // Trả về view chi tiết sản phẩm cùng với dữ liệu của sản phẩm
    //     return view('client.product_detail', compact('product'));
    // }
    public function checkout()
    {
        return view('client.checkout');
    }

    // public function show_variants($id)
    // {
    //     // Lấy sản phẩm và các biến thể của sản phẩm
    // $product = Product::with('variants')->findOrFail($id);

    // // Lọc biến thể theo `color` và `size`
    // $colors = $product->variants->where('name', 'color')->pluck('value')->unique();
    // $sizes = $product->variants->where('name', 'size')->pluck('value')->unique();

    //    // Kiểm tra dữ liệu
    //   dd($product, $colors, $sizes);
    // // Trả về view với dữ liệu
    // return view('client.product_detail', compact('product', 'colors', 'sizes'));
    // }

    public function show_variants($id)
    {
        // Lấy sản phẩm kèm các biến thể
        $product = Product::with('variants')->findOrFail($id);

        // Kiểm tra nếu có biến thể thì lọc theo `color` và `size`
        $colors = $product->variants->where('name', 'color')->pluck('value')->unique();
        $sizes = $product->variants->where('name', 'size')->pluck('value')->unique();

        // Truyền biến `product`, `colors` và `sizes` vào view
        return view('client.product_detail', compact('product', 'colors', 'sizes'));
    }

    public function show($id)
    {
        $product = Product::with('variants')->findOrFail($id);
        $comments = BinhLuan::where('product_id', $product->id)->orderBy('created_at', 'desc')->paginate(6); // Hiển thị 6 bình luận mỗi trang

        // Tính toán điểm đánh giá trung bình
        $averageRating = $comments->count() > 0 ? $comments->avg('rating') : 0;
        return view('client.product_detail', compact('product', 'comments', 'averageRating'));
    }

    public function warranty()
    {
        return view('client.warranty');
    }

    public function buying_guide()
    {
        return view('client.buying_guide');
    }
    public function searchWarranty(Request $request)
    {
        $sku = $request->input('sku');

        $product = Product::where('sku', $sku)->with(['orders'])->first();
        // dd($product);

        if ($product) {
            // Nếu tìm thấy sản phẩm, trả về view với thông tin sản phẩm
            return view('client.warranty', compact('product'));
        } else {
            // Nếu không tìm thấy sản phẩm, trả về view với thông báo lỗi
            $message = 'Không tìm thấy sản phẩm với mã SKU này.';
            return view('client.warranty', compact('message'));
        }
    }



}
