<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Catalogues;
use Illuminate\Http\Request;

class ProductCatalogueController extends Controller
{
    public function index(Request $request)
    {
        // Lấy ID của danh mục từ query string
        $catalogueId = $request->query('catalogue_id');


        // Lấy danh sách danh mục để hiển thị lên menu
        $data = Catalogues::all();

        // Nếu có ID danh mục thì lọc sản phẩm theo danh mục đó
        $products = Product::when($catalogueId, function($query, $catalogueId) {
            return $query->where('catalogues_id', $catalogueId);
        })->get();

        // Trả dữ liệu về view
        return view('client.shop', compact('products', 'data'));
    }
}
