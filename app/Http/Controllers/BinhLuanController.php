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
            return response()->json(['success' => false, 'message' => 'Bạn cần phải đăng nhập để thêm bình luận.']);
        }
    
        try {
            // Xác thực dữ liệu yêu cầu
            $validatedData = $request->validate([
                'noidung' => 'required|string|max:1000',
                'rating' => 'required|integer|between:1,5',
            ]);
    
            // Tạo bình luận
            $comment = BinhLuan::create([
                'product_id' => $productId,
                'user_id' => Auth::id(),
                'noidung' => $validatedData['noidung'],
                'rating' => $validatedData['rating'],
            ]);
    
            // Trả về thông tin bình luận mới
            return response()->json([
                'success' => true,
                'comment' => [
                    'user_name' => Auth::user()->name, // Lấy tên người dùng
                    'noidung' => $comment->noidung,
                    'rating' => $comment->rating,
                ]
            ]);
    
        } catch (\Exception $e) {
            Log::error('General Exception: ', ['message' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Đã xảy ra lỗi: ' . $e->getMessage()]);
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
    public function show(BinhLuan $binhLuan)
    {
        // Logic to show a specific comment (if needed)
    }

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
