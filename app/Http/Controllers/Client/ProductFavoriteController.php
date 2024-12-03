<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ProductFavorite;
use Illuminate\Http\Request;

class ProductFavoriteController extends Controller
{
    public function favoriteProducts()
    {
        $favorites = ProductFavorite::with('product')->where('user_id', auth()->id())->get();
        return view('client.product_heart', compact('favorites'));
    }
    public function toggleFavorite(Request $request)
    {
        $user = auth()->user();
        $productId = $request->input('product_id');

        $favorite = ProductFavorite::where('user_id', $user->id)->where('product_id', $productId)->first();

        if ($favorite) {
            $favorite->delete(); // Nếu đã yêu thích thì xóa
            return response()->json(['status' => 'removed']);
        } else {
            ProductFavorite::create([
                'user_id' => $user->id,
                'product_id' => $productId,
            ]); // Nếu chưa yêu thích thì thêm
            return response()->json(['status' => 'added']);
        }
    }
    



}
