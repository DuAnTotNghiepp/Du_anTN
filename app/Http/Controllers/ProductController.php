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
    $product = Product::where('slug', $slug)->firstOrFail();
    
    $comments = BinhLuan::where('product_id', $product->id)->orderBy('created_at', 'desc')->paginate(6); 

    $averageRating = $comments->count() > 0 ? $comments->avg('rating') : 0; 

    return view('product-detail', compact('product', 'comments', 'averageRating'));
}


    
    public function indexWithComments()
    {
        $listPro = Product::with(['binh_luans' => function ($query) {
            $query->select('product_id', DB::raw('avg(rating) as average_rating'))
                  ->groupBy('product_id');
        }])->latest('id')->get();

        return view('admin.comment.index', compact('listPro'));
    }
}
