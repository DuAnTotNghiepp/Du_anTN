<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Catalogues;
use App\Models\Product;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = Catalogues::query()->get();

    // Lấy tất cả sản phẩm
    $listSp = Product::where('is_active', 1)->paginate(5);

    // Lấy sản phẩm hot
    $listHot = Product::where('is_hot_deal', 1)->get();

    return view('client.home', compact(['listSp', 'listHot', 'data']));
    }

    public function product(){
        return view('client.product_detail');
    }

}
