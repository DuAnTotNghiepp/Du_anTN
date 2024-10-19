<?php

namespace App\Http\Controllers;

use App\Models\BinhLuan;
use App\Models\Product;


use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail($slug)
    {
        $product=Product::query()->where('slug',$slug)->firstOrFail();
        $comments = BinhLuan::where('product_id', $product->id)->get();

        return view('product-detail',compact('product', 'comments'));
    }
}
