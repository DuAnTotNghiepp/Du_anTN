@extends('client.layouts.app')

@section('content')
<style>
    body {
            background-color: #f4f6f9;
            line-height: 1.7;
        }
        .blog-content {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 40px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .blog-header-image {
            max-height: 500px;
            width: 100%;
            object-fit: cover;
        }
        .author-bio {
            background-color: #f8f9fa;
            border-left: 4px solid #007bff;
            padding: 20px;
            margin: 30px 0;
        }
        .related-post-card {
            transition: transform 0.3s ease;
        }
        .related-post-card:hover {
            transform: translateY(-10px);
        }
        .content-divider {
            border-top: 2px solid #007bff;
            width: 100px;
            margin: 20px auto;
        }
        pre {
            background-color: #f4f4f4;
            padding: 15px;
            border-radius: 5px;
        }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
    <div class="container ">
        <a class="navbar-brand fw-bold " href="#">MyBlog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
       
    </div>
</nav>
 <div class="container">
        <div class="blog-content">
            <!-- Hình ảnh bài viết -->
            <img src="{{ Storage::url($blog->image) }}" alt="Xu Hướng Thời Trang" class="blog-header-image mb-4 rounded">
            
            <!-- Thông tin bài viết -->
            <div class="text-center mb-4">
                <span class="badge bg-primary mb-2">Thời Trang</span>
                <h1 class="display-5 mb-3">{{ $blog->title }}</h1>

            </div>

            <!-- Nội dung chính -->
            <article>
                <h3 class="lead">{{ $blog->content }} </h3>

                
            </article>

          
            

            <!-- Bài viết liên quan -->
        <div class="related-posts">
                <h3 class="text-center mb-4">Bài Viết Liên Quan</h3>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card related-post-card h-100">
                            <img src="{{ Storage::url($blog->image) }}" class="card-img-top" alt="Bài viết liên quan 1">
                            <div class="card-body">
                                <h5 class="card-title">AI Trong Kinh Doanh</h5>
                                <p class="card-text text-muted">Cách AI đang cách mạng hóa các mô hình kinh doanh</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card related-post-card h-100">
                            <img src="{{ Storage::url($blog->image) }}" class="card-img-top" alt="Bài viết liên quan 2">
                            <div class="card-body">
                                <h5 class="card-title">Blockchain Thực Tế</h5>
                                <p class="card-text text-muted">Ứng dụng thực tế của blockchain ngoài tiền điện tử</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card related-post-card h-100">
                            <img src="{{ Storage::url($blog->image) }}" class="card-img-top" alt="Bài viết liên quan 3">
                            <div class="card-body">
                                <h5 class="card-title">Tương Lai Công Nghệ</h5>
                                <p class="card-text text-muted">Dự báo xu hướng công nghệ trong thập kỷ tới</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

         
        </div>
        </div>
    </div>  
    
    
    
  
@endsection
