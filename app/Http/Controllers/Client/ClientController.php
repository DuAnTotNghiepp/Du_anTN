<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Catalogues;
use App\Models\BinhLuan;
use App\Models\User;
use App\Models\Product;
use App\Models\Variants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function checkout(){
        return view('client.checkout');
    }

    public function show_variants($id)
{
    // Lấy sản phẩm kèm các biến thể
    // $product = Product::with('variants')->findOrFail($id);
    // $product1 = Product::with('ProductGallerie')->findOrFail($id);
    // // Kiểm tra nếu có biến thể thì lọc theo `color` và `size`
    // $colors = $product->variants->where('name', 'color')->pluck('value')->unique();
    // $sizes = $product->variants->where('name', 'size')->pluck('value')->unique();

    // // Truyền biến `product`, `colors` và `sizes` vào view
    // return view('client.product_detail', compact('product', 'product1','colors', 'sizes'));


    $product = Product::with(['variants', 'galleries'])->findOrFail($id);

    // Lọc color và size từ variants
    $colors = $product->variants->where('name', 'color')->pluck('value')->unique();
    $sizes = $product->variants->where('name', 'size')->pluck('value')->unique();

    // Truyền dữ liệu vào view
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

public function show_profile($id)
{
    // Lấy thông tin người dùng theo id
    // $user = User::with('addresses')->findOrFail($id);
    $user = User::find($id);
    $addresses = $user->addresses;

    // Kiểm tra nếu người dùng không tồn tại
    if (!$user) {
        return redirect()->back()->with('error', 'Người dùng không tồn tại');
    }

    // Truyền dữ liệu người dùng vào view 'client.profile'
    return view('client.profile', compact('user','addresses'));
}

public function storeAddress(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email',
        'contact_number' => 'required|string|max:15',
        'city' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'commune' => 'required|string|max:255',
        'address' => 'required|string|max:255',
    ]);

    Address::create([
        'user_id' => auth()->id(),
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'contact_number' => $request->contact_number,
        'city' => $request->city,
        'state' => $request->state,
        'commune' => $request->commune,
        'address' => $request->address,
    ]);

    return redirect()->route('profile', ['id' => auth()->user()->id])->with('success', 'Địa chỉ đã được lưu thành công!');
}


}
