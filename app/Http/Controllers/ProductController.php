<?php

namespace App\Http\Controllers;

use App\Models\BinhLuan;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function detail($slug)
{
    // Lấy sản phẩm theo slug
    $product = Product::where('slug', $slug)->firstOrFail();

    // Lấy bình luận cho sản phẩm với phân trang
    $comments = BinhLuan::where('product_id', $product->id)->orderBy('created_at', 'desc')->paginate(6); // Hiển thị 6 bình luận mỗi trang

    // Tính toán điểm đánh giá trung bình
    $averageRating = $comments->count() > 0 ? $comments->avg('rating') : 0; // Nếu không có bình luận thì cho trung bình là 0

    return view('product-detail', compact('product', 'comments', 'averageRating'));
}


    public function indexWithComments()
    {
        // Lấy danh sách sản phẩm cùng với số bình luận và điểm đánh giá trung bình hùng..
        $listPro = Product::with(['binh_luans' => function ($query) {
            $query->select('product_id', DB::raw('avg(rating) as average_rating'))
                  ->groupBy('product_id');
        }])->latest('id')->get();

        return view('admin.comment.index', compact('listPro'));
    }
}
