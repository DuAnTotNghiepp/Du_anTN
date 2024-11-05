<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Catalogues;
use App\Models\BinhLuan;

use App\Models\Product;
use App\Models\Variants;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = Catalogues::query()->get();

    // Lấy tất cả sản phẩm
    $listSp = Product::where('is_active', 1)->get(); // Hiển thị tất cả sản phẩm

    // Lấy sản phẩm hot
    $listHot = Product::where('is_hot_deal', 1)->get();

    return view('client.home', compact(['listSp', 'listHot', 'data']));
    }

    // public function show($id)
    // {
    //     // Tìm sản phẩm theo ID
    //     $product = Product::findOrFail($id);

    //     // Trả về view chi tiết sản phẩm cùng với dữ liệu của sản phẩm
    //     return view('client.product_detail', compact('product'));
    // }
    public function checkout(){
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

}
