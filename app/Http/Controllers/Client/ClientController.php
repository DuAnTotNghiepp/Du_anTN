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
use Carbon\Carbon;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $data = Catalogues::query()->get();
        $products = Product::query()->get();

        $cartItems = Cart::where('user_id', auth()->id())
            ->whereHas('product', function ($query) {
                $query->where('is_active', 1);
            })->get();

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

        $listHot = Product::where('is_hot_deal', 1)
            ->where('is_active', 1)
            ->get();

        $vouchers = Vouchers::where('is_visible', 1)
            ->where('status', 1)
            ->get([
                'id', 'code', 'value', 'minimum_order_value', 'end_date', 'status'
            ]);

        $blogs = Blog::all();

        return view('client.home', compact('listSp', 'listHot', 'data', 'products', 'vouchers', 'blogs', 'cartItems'));
    }

    public function getProductsByCategory(Request $request)
    {
        $category = $request->input('category');

        Log::info('Category received:', ['category' => $category]);

        if ($category === 'all') {
            $products = Product::where('is_active', 1)->get();
        } else {
            $catalogue = Catalogues::where('name', $category)->first();

            if ($catalogue) {
                $products = $catalogue->products()->where('is_active', 1)->get();
                Log::info('Products in category:', $products->toArray());
            } else {
                $products = collect();
                Log::warning('Category not found:', ['category' => $category]);
            }
        }

        return response()->json(['products' => $products]);
    }

    public function shop(Request $request)
    {
        $data = Catalogues::query()->get();
        $listSp = Product::where('is_active', 1)->get();
        $listHot = Product::where('is_hot_deal', 1)->get();
        $products = Product::orderBy('created_at', 'desc')->paginate(12);

        return view('client.shop', compact('listSp', 'listHot', 'data', 'products'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('sidebar-search-input');
        $minPrice = $request->input('price_min');
        $maxPrice = $request->input('price_max');
        $luachon = $request->input('category-sort', 'default');

        $query = Product::query();

        if ($searchTerm) {
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }

        if (is_numeric($minPrice) && is_numeric($maxPrice)) {
            $query->where(function ($query) use ($minPrice, $maxPrice) {
                $query->where(function ($subQuery) use ($minPrice, $maxPrice) {
                    $subQuery->whereNotNull('price_sale')
                        ->whereBetween('price_sale', [$minPrice, $maxPrice]);
                })->orWhere(function ($subQuery) use ($minPrice, $maxPrice) {
                    $subQuery->whereNull('price_sale')
                        ->whereBetween('price_regular', [$minPrice, $maxPrice]);
                });
            });
        }

        if ($luachon == 'price_asc') {
            $query->orderByRaw('COALESCE(price_sale, price_regular) ASC');
        } elseif ($luachon == 'price_desc') {
            $query->orderByRaw('COALESCE(price_sale, price_regular) DESC');
        }

        $products = $query->get();

        return view('client.shop', compact('products'));
    }

    public function blog($id)
    {
        $blog = Blog::findOrFail($id);
        $blogs = Blog::where('id', '!=', $id)
            ->select('id', 'title', 'image')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('client.blog', compact('blog', 'blogs'));
    }

    public function checkout()
    {
        return view('client.checkout');
    }

    public function show_variants($id)
    {
        $product = Product::with('variants')->findOrFail($id);
        $colors = $product->variants->where('name', 'color')->pluck('value')->unique();
        $sizes = $product->variants->where('name', 'size')->pluck('value')->unique();

        return view('client.product_detail', compact('product', 'colors', 'sizes'));
    }

    public function show($id)
    {
        $product = Product::with(['productVariants.color', 'productVariants.size'])->findOrFail($id);
        $productVariant = Product_Variant::where('product_id', $product->id)->first();
        $cartItems = Cart::where('user_id', auth()->id())->get();

        $colors = $product->productVariants->pluck('color.value')->unique();
        $sizes = $product->productVariants->pluck('size.value')->unique();

        $variantQuantities = $product->productVariants->mapWithKeys(function ($variant) {
            return [
                $variant->color->value . '-' . $variant->size->value => $variant->stock
            ];
        });

        $comments = BinhLuan::where('product_id', $product->id)->orderBy('created_at', 'desc')->paginate(6);
        $averageRating = $comments->count() > 0 ? $comments->avg('rating') : 0;

        return view('client.product_detail', compact('product', 'variantQuantities', 'comments', 'averageRating', 'colors', 'sizes', 'productVariant', 'cartItems'));
    }

    public function getVariantStock(Request $request)
    {
        $productId = $request->input('product_id');
        $variantId = $request->input('variant_id');

        $productVariant = Product_Variant::where('product_id', $productId)
            ->where('variants_id', $variantId)
            ->first();

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
        $user = User::find($id);
        $addresses = $user->addresses;

        if (!$user) {
            return redirect()->back()->with('error', 'Người dùng không tồn tại');
        }

        return view('client.my_profile', compact('user', 'addresses'));
    }

    public function show_my_order()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with(['product', 'user.addresses'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('client.my_order', compact('orders'));
    }

    public function storeAddress(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact_number' => 'required|string|max:15',
            'city' => 'required|string',
            'state' => 'required|string',
            'commune' => 'required|string',
            'address' => 'required|string',
        ]);

        Address::create([
            'user_id' => auth()->id(),
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'contact_number' => $validated['contact_number'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'commune' => $validated['commune'],
            'address' => $validated['address'],
        ]);

        return redirect()->back()->with('success', 'Address added successfully!');
    }

    public function updateAddress(Request $request, $id)
    {
        $address = Address::findOrFail($id);
        $address->update($request->all());

        return redirect()->back()->with('success', 'Địa chỉ đã được cập nhật.');
    }

    public function exportInvoice($id)
    {
        $order = Order::with('product')->findOrFail($id);
        $pdf = Pdf::loadView('client.invoice', compact('order'));

        return $pdf->download('invoice-' . $order->id . '.pdf');
    }

    public function searchWarranty(Request $request)
    {
        $sku = $request->input('sku');
        $product = Product::where('sku', $sku)->with(['orders'])->first();

        if ($product) {
            return view('client.warranty', compact('product'));
        } else {
            $message = 'Không tìm thấy sản phẩm với mã SKU này.';
            return view('client.warranty', compact('message'));
        }
    }
}
