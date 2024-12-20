<?php

namespace App\Http\Controllers;

use App\Models\BinhLuan;
use App\Http\Requests\StoreBinhLuanRequest;
use App\Http\Requests\UpdateBinhLuanRequest;
use App\Models\Order_Items;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class BinhLuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showProductReviews($productId)
    {
        $comments = BinhLuan::where('product_id', $productId)->get();

        $averageRating = $comments->avg('rating');

        return view('product.show', [
            'comments' => $comments,
            'averageRating' => round($averageRating, 1) // Làm tròn kết quả
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $productId)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Bạn cần phải đăng nhập để thêm bình luận.']);
        }

        try {
            $userId = Auth::id();

            // Kiểm tra xem người dùng đã mua sản phẩm này chưa
            $hasPurchased = Order_Items::where('user_id', $userId)
                ->where('product_id', $productId)
                ->exists();

            if (!$hasPurchased) {
                return response()->json(['success' => false, 'message' => 'Bạn phải mua sản phẩm này mới được phép bình luận.']);
            }

            $hasCommented = BinhLuan::where('user_id', $userId)
                ->where('product_id', $productId)
                ->exists();

            if ($hasCommented) {
                return response()->json(['success' => false, 'message' => 'Bạn đã bình luận cho sản phẩm này trước đó.']);
            }

            $validatedData = $request->validate([
                'noidung' => 'required|string|max:1000',
                'rating' => 'required|integer|between:1,5',
            ]);

            $comment = BinhLuan::create([
                'product_id' => $productId,
                'user_id' => $userId,
                'noidung' => $validatedData['noidung'],
                'rating' => $validatedData['rating'],
            ]);

            return response()->json([
                'success' => true,
                'comment' => [
                    'user_name' => Auth::user()->name,
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
