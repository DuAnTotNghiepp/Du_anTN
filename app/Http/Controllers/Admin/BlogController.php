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
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Tạo bài viết mới
        Blog::create($request->all());

        return redirect()->route('blog.index')->with('success', 'Bài viết đã được tạo thành công!');
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
