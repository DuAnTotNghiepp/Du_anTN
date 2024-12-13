<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Blog::all(); // Lấy danh sách blog
        return view('admin.blog.index', compact('posts')); // Gửi dữ liệu đến view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        // Kiểm tra phương thức POST
        if ($request->isMethod('post')) {
            // Lấy tất cả dữ liệu từ request ngoại trừ token
            $params = $request->except('_token');

            // Xác thực dữ liệu đầu vào
            $request->validate([
                'title' => 'required|string|max:255|unique:title',
                'content' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra định dạng và kích thước file
            ]);

            // Kiểm tra và lưu hình ảnh
            if ($request->hasFile('image')) {
                // Lưu file hình ảnh vào thư mục public/images
                $params['image'] = $request->file('image')->store('images', 'public');
            } else {
                $params['image'] = null; // Nếu không có hình ảnh, gán null
            }

            // Tạo mới bài viết
            $blogPost = Blog::create([
                'title' => $params['title'],
                'content' => $params['content'],
                'image' => $params['image'], // Lưu đường dẫn hình ảnh vào database
            ]);

            // Kiểm tra kết quả tạo bài viết
            if ($blogPost) {
                return redirect()->route('blog.index')->with('success', 'Bài viết đã được thêm mới thành công');
            } else {
                return redirect()->back()->with('error', 'Bài viết không thể được thêm mới');
            }
        };
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Blog::findOrFail($id);
        $post->delete();

        return redirect()->route('blog.index')->with('success', 'Voucher deleted successfully!');
    }
    public function show($id)
    {
        // Lấy bài viết từ cơ sở dữ liệu
        $blog = Blog::findOrFail($id);

        // Trả về view kèm dữ liệu
        return view('client.blog', compact('blog'));
    }
}
