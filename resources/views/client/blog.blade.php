@extends('client.layouts.app')

@section('content')
<head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<style>
  body {
    background-color: #f4f6f9;
    line-height: 1.7;
    font-family: 'Roboto', sans-serif; /* Change to desired font */
    font-size: 16px; /* Set base font size */
    color: #333; /* Default text color */
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
    font-size: 14px; /* Font size for author bio */
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
    font-family: monospace; /* Use a monospace font for preformatted text */
}




</style>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4 " >
    <div class="container ">
        <a class="navbar-brand fw-bold " href="#">MyBlog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
       
    </div>
</nav>
<div class="blog-content container">
    <div class="row align-items-start">
        <!-- Nội dung bài viết (bên trái) -->
        <div class="col-md-8 d-flex flex-column">
            <div class="text-center mb-4">
                <span class="badge bg-primary mb-2">Thời Trang</span>
                <h1 class="display-5 mb-3">{{ $blog->title }}</h1>
            </div>
            <main>
                <h3 class="lead">{{ $blog->content }}</h3>
            </main>
        </div>

        <!-- Hình ảnh bài viết (bên phải) -->
        <div class="col-md-4 d-flex align-items-center justify-content-center">
            <img src="{{ Storage::url($blog->image) }}" alt="Xu Hướng Thời Trang" class="img-fluid mb-4 rounded">
        </div>
    </div>
</div>

    
    
    
  
@endsection
