<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
   
    public function index()
    {
        $posts = Blog::all(); 
        return view('admin.blog.index', compact('posts')); 
    }

    public function create()
    {
        return view('admin.blog.create');
    }


    public function store(Request $request)
    {
        // Kiểm tra phương thức POST
        if ($request->isMethod('post')) {
            // Lấy tất cả dữ liệu từ request ngoại trừ token
            $params = $request->except('_token');

            // Xác thực dữ liệu đầu vào
            $request->validate([
                'title' => 'required|string|max:255',
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

  
    public function edit(string $id)
    {
        $listBl = Blog::find($id);
        return view('admin.blog.edit', compact('listBl'));
    }

  
    public function update(Request $request, int $id)
    {
        // Tìm bài viết theo ID
        $blogPost = Blog::findOrFail($id);
    
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // File ảnh không bắt buộc
        ]);
    
        // Lấy tất cả dữ liệu từ request ngoại trừ token
        $params = $request->except('_token');
    
        // Kiểm tra và xử lý hình ảnh
        if ($request->hasFile('image')) {
            // Lưu file hình ảnh mới vào thư mục public/images
            $params['image'] = $request->file('image')->store('images', 'public');
    
            // Xóa file hình ảnh cũ nếu tồn tại
            if ($blogPost->image && Storage::disk('public')->exists($blogPost->image)) {
                Storage::disk('public')->delete($blogPost->image);
            }
        } else {
            // Giữ nguyên hình ảnh cũ nếu không tải lên ảnh mới
            $params['image'] = $blogPost->image;
        }
    
        // Cập nhật dữ liệu bài viết
        $res = $blogPost->update([
            'title' => $params['title'],
            'content' => $params['content'],
            'image' => $params['image'],
        ]);
    
        // Kiểm tra kết quả cập nhật
        if ($res) {
            return redirect()->route('blog.index')->with('success', 'Bài viết đã được cập nhật thành công');
        } else {
            return redirect()->back()->with('error', 'Bài viết không thể được cập nhật');
        }
    }
    

    

   
    public function destroy(string $id)
    {
        $post = Blog::findOrFail($id);
        $post->delete();

        return redirect()->route('blog.index')->with('success', 'Voucher deleted successfully!');
    }
    
}
