<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Catalogues;
use App\Models\BinhLuan;
use App\Models\Product_Variant;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\User;
use App\Models\Address;
use App\Models\Blog;
use App\Models\Cart;
use App\Models\ProductFavorite;
use App\Models\Vouchers;

class ClientController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = Catalogues::query()->get();
        $products = Product::query()->get();
        // Giỏ hàng chỉ hiển thị sản phẩm đang hoạt động
        $cartItems = Cart::where('user_id', auth()->id())
        ->whereHas('product', function ($query) {
            $query->where('is_active', 1);
        })->get();

        // Danh sách sản phẩm yêu thích chỉ hiển thị sản phẩm đang hoạt động
        $favouriteItems = ProductFavorite::where('user_id', auth()->id())
        ->whereHas('product', function ($query) {
            $query->where('is_active', 1);
        })->get();
        $listSp = Product::where('is_active', 1)
        ->get()
        ->map(function ($product) {
            $averageRating = BinhLuan::where('product_id', $product->id)
                ->avg('rating') ?? 0;
            $product->average_rating = round($averageRating, 1);
            return $product;
        });

        // Lấy sản phẩm hot
        $listHot = Product::where('is_hot_deal', 1)
        ->where('is_active', 1) // Kiểm tra sản phẩm còn hoạt động
        ->get();

        $vouchers = Vouchers::where('is_visible', 1) // Hiển thị các voucher đang được bật
        ->where('status', 1) // Chỉ lấy voucher hoạt động
        ->get(['id', 'code',
        'value',
        'minimum_order_value',
        'end_date',
        'status'

        ]);
        $blogs = Blog::all();


        return view('client.home', compact(['listSp', 'listHot', 'data', 'products','vouchers', 'blogs', 'cartItems']));
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
        $product = Product::with(['productVariants.color', 'productVariants.size'])->findOrFail($id);
        $productVariant = Product_Variant::where('product_id', $product->id)->first();
        $cartItems = Cart::where('user_id', auth()->id())->get();

        // Lấy danh sách màu sắc và kích thước
        $colors = $product->productVariants->pluck('color.value')->unique(); // ['#ffdd00', '#000000']
        $sizes = $product->productVariants->pluck('size.value')->unique();   // ['M', 'L']

        // Tạo dữ liệu số lượng theo kết hợp màu và kích thước
        $variantQuantities = $product->productVariants->mapWithKeys(function ($variant) {
            return [
                $variant->color->value . '-' . $variant->size->value => $variant->stock
            ];
        });
        // dd($colors, $sizes, $variantQuantities);

        $comments = BinhLuan::where('product_id', $product->id)->orderBy('created_at', 'desc')->paginate(6); // Hiển thị 6 bình luận mỗi trang
        // Tính toán điểm đánh giá trung bình
        $averageRating = $comments->count() > 0 ? $comments->avg('rating') : 0;
        return view('client.product_detail', compact('product', 'variantQuantities', 'comments', 'averageRating', 'colors', 'sizes', 'productVariant', 'cartItems'));
    }
    public function getVariantStock(Request $request)
    {
        $productId = $request->input('product_id');
        $variantId = $request->input('variant_id');

        // Lấy số lượng tồn kho từ bảng product__variants
        $productVariant = Product_Variant::where('product_id', $productId)
                                          ->where('variants_id', $variantId)
                                          ->first();

        // Trả về số lượng tồn kho dưới dạng JSON
        return response()->json([
            'quantity' => $productVariant->quantity ?? 0
        ]);
    }



    public function warranty()
    {
        return view('client.warranty');
    }

    public function buying_guide()
    {
        return view('client.buying_guide');
    }

public function show_profile($id)
{
    // Lấy sản phẩm kèm các biến thể
    // $product = Product::with('variants')->findOrFail($id);
    // $product1 = Product::with('ProductGallerie')->findOrFail($id);
    // // Kiểm tra nếu có biến thể thì lọc theo `color` và `size`
    // $colors = $product->variants->where('name', 'color')->pluck('value')->unique();
    // $sizes = $product->variants->where('name', 'size')->pluck('value')->unique();

    // // Truyền biến `product`, `colors` và `sizes` vào view
    // return view('client.product_detail', compact('product', 'product1','colors', 'sizes'));


    // $product = Product::with(['variants', 'galleries'])->findOrFail($id);

    // // Lọc color và size từ variants
    // $colors = $product->variants->where('name', 'color')->pluck('value')->unique();
    // $sizes = $product->variants->where('name', 'size')->pluck('value')->unique();

    // // Truyền dữ liệu vào view
    // return view('client.product_detail', compact('product', 'colors', 'sizes'));
    // Lấy thông tin người dùng theo id
   
    $user = User::find($id);
    $addresses = $user->addresses;

    // Kiểm tra nếu người dùng không tồn tại
    if (!$user) {
        return redirect()->back()->with('error', 'Người dùng không tồn tại');
    }

    // Truyền dữ liệu người dùng vào view 'client.profile'
    return view('client.my_profile', compact('user','addresses'));
}
public function show_my_order()
{
    // Lấy danh sách đơn hàng của người dùng hiện tại
    $orders = Order::where('user_id', Auth::id())
        ->with(['product', 'user.addresses']) // Lấy thông tin sản phẩm và địa chỉ thông qua user
        ->orderBy('created_at', 'desc')
        ->get();

    return view('client.my_order', compact('orders'));
}

// public function show_profile($id)
// {
//     // Lấy thông tin người dùng theo id
//     $user = User::find($id);
//     $addresses = $user->addresses;

//     // Kiểm tra nếu người dùng không tồn tại
//     if (!$user) {
//         return redirect()->back()->with('error', 'Người dùng không tồn tại');
//     }

//     // Truyền dữ liệu người dùng vào view 'client.profile'
//     return view('client.my_profile', compact('user','addresses'));
// }
// public function show_my_order()
// {
//     // Lấy danh sách đơn hàng của người dùng hiện tại
//     $orders = Order::where('user_id', Auth::id())
//         ->with(['product', 'user.addresses']) // Lấy thông tin sản phẩm và địa chỉ thông qua user
//         ->orderBy('created_at', 'desc')
//         ->get();

//     return view('client.my_order', compact('orders'));
// }



public function storeAddress(Request $request)
{
    
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'contact_number' => 'required|string|max:15',
        'city' => 'required|string',  // Lưu tên tỉnh
        'state' => 'required|string', // Lưu tên huyện
        'commune' => 'required|string', // Lưu tên xã
        'address' => 'required|string',
    ]);

    Address::create([
        'user_id' => auth()->id(),
        'first_name' => $validated['first_name'],
        'last_name' => $validated['last_name'],
        'email' => $validated['email'],
        'contact_number' => $validated['contact_number'],
        'city' => $validated['city'],   // Lưu tên tỉnh
        'state' => $validated['state'], // Lưu tên huyện
        'commune' => $validated['commune'], // Lưu tên xã
        'address' => $validated['address'],
    ]);

    return redirect()->back()->with('success', 'Address added successfully!');
}
public function updateAddress(Request $request, $id)
{
    // Lấy địa chỉ từ ID
    $address = Address::findOrFail($id);

    // Cập nhật thông tin địa chỉ
    $address->update($request->all());

    // Redirect hoặc trả về thông báo
    return redirect()->back()->with('success', 'Địa chỉ đã được cập nhật.');
}

public function exportInvoice($id)
{
    // Lấy thông tin chi tiết đơn hàng
    $order = Order::with('product')->findOrFail($id);

    // Sử dụng Facade PDF để render view và tạo file PDF
    $pdf = Pdf::loadView('client.invoice', compact('order'));

    // Trả file PDF về cho người dùng tải xuống
    return $pdf->download('invoice-' . $order->id . '.pdf');
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
