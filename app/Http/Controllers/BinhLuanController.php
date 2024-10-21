<?php

namespace App\Http\Controllers;

use App\Models\BinhLuan;
use App\Http\Requests\StoreBinhLuanRequest;
use App\Http\Requests\UpdateBinhLuanRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class BinhLuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Logic to display comments (if needed)
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $productId)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Bạn cần phải đăng nhập để thêm bình luận.');
        }

        try {
            // Xác thực dữ liệu yêu cầu
            $validatedData = $request->validate([
                'noidung' => 'required|string|max:1000',
                'rating' => 'required|integer|between:1,5',
            ]);

            // Ghi nhận dữ liệu đã xác thực
            Log::info('Validated Data: ', $validatedData);

            // Tạo bình luận
            $comment = BinhLuan::create([
                'product_id' => $productId,
                'user_id' => Auth::id(),
                'noidung' => $validatedData['noidung'],
                'rating' => $validatedData['rating'],
            ]);

            // Redirect về với thông báo thành công
            return redirect()->back()->with('success', 'Bình luận đã được thêm thành công.');

        } catch (\Illuminate\Database\QueryException $e) {
            // Ghi nhận lỗi SQL
            Log::error('Query Exception: ', ['message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Không thể thêm bình luận: ' . $e->getMessage());

        } catch (\Exception $e) {
            // Ghi nhận lỗi chung
            Log::error('General Exception: ', ['message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Đã xảy ra lỗi: ' . $e->getMessage());
        }
    }

    


    /**
     * Show comments for a product.
     */
    public function showComments($id)
    {
        // Fetch product with comments and related users
        $product = Product::with('binh_luans.user')->findOrFail($id);

        return view('admin.comment.show', compact('product'));
    }
    public function show($id)
{
    $product = Product::findOrFail($id);
    
    // Lấy tất cả các bình luận cho sản phẩm
    $comments = $product->comments()->with('user')->get();

    // Tính toán rating trung bình
    $averageRating = $comments->count() > 0 ? $comments->avg('rating') : 0; // Nếu không có bình luận thì cho trung bình là 0

    return view('client.product.show', compact('product', 'comments', 'averageRating'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Logic to create a comment (if needed)
    }

    /**
     * Display the specified resource.
     */
   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BinhLuan $binhLuan)
    {
        // Logic to edit a comment (if needed)
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBinhLuanRequest $request, BinhLuan $binhLuan)
    {
        // Logic to update a comment (if needed)
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BinhLuan $binhLuan)
    {
        // Logic to delete a comment (if needed)
    }
}
