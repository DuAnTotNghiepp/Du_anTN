@extends('client.layouts.app')

@section('content')
<style>
  
/* Reset CSS */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
    line-height: 1.6;
}
/* Container chính */
.container {
    display: flex;
    justify-content: space-between;
    max-width: 1200px;
    margin: 20px auto;
    gap: 20px;
    border: 2px solid #ddd; /* Thêm viền ngoài */
    padding: 20px; /* Khoảng cách bên trong viền */
    border-radius: 10px; /* Bo tròn các góc */
    background-color: #fff; /* Nền trắng để nội dung nổi bật */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Đổ bóng nhẹ */
}


/* Cột Nội Dung Chính */
.main-content {
    flex: 3;
}

.breadcrumb {
    color: #888;
    font-size: 14px;
}

.main-title {
    font-size: 28px;
    font-weight: bold;
    margin: 10px 0;
}

.intro .highlight {
    color: red;
    font-weight: bold;
}

.contact, .address {
    font-size: 16px;
    margin: 10px 0;
}

.section-title {
    font-size: 24px;
    margin: 15px 0;
    font-weight: bold;
}

.content-image {
    width: 100%;
    margin-top: 10px;
    border-radius: 5px;
}

/* Sidebar */
.sidebar {
    flex: 1;
}

.box {
    background-color: #f8f8f8;
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
}

.box h3 {
    background-color: red;
    color: #fff;
    padding: 10px;
    font-size: 18px;
    margin: -15px -15px 10px -15px;
}

.post-list {
    list-style: none;
}

.post-list li {
    margin: 8px 0;
}

.post-list a {
    text-decoration: none;
    color: #333;
    transition: color 0.3s;
}

.post-list a:hover {
    color: red;
}

.more img {
    width: 100%;
    height: auto;
    margin-bottom: 10px;
    border-radius: 5px;
}

.view-more a {
    display: block;
    text-decoration: none;
    color: #333;
    font-weight: bold;
    transition: color 0.3s;
}

.view-more a:hover {
    color: red;
}
.post-list {
    list-style: none; /* Xóa dấu chấm mặc định */
    padding: 0;
    margin: 0;
}

.post-list li {
    margin-bottom: 10px; 
}

.post-item {
    display: flex; 
    align-items: center; 
    text-decoration: none; 
    color: #333; 
    transition: color 0.3s ease; 
}

.post-item:hover {
    color: red; 
}

.post-image {
    width: 100px; 
    height: 100px;
    object-fit: cover; 
    border-radius: 5px; 
    margin-right: 10px; 
}

.post-title {
    font-size: 16px; 
    font-weight: bold;
    line-height: 1.2;
}

</style>



<div class="container">
    <div class="main-content">
        <p class="breadcrumb">Trang chủ &raquo; Bài viết</p>
        <h1 class="main-title">{{ $blog->title }}</h1>
        <p class="intro">
            <strong class="highlight">{{ $blog->title }}</strong> {{ $blog->content }}
        </p>
        <img src="{{ Storage::url($blog->image) }}" alt="{{ $blog->title }}" class="content-image">
        <p>Khách hàng có nhu cầu tư vấn thiết kế, báo giá dịch vụ, xin vui lòng liên hệ:</p>
        <p class="contact"><strong>Hotline:</strong> 098 6789 034 – 098.6789.304</p>
        <p class="address"><strong>Địa chỉ:</strong> 188A Cầu Diễn, Phường Minh Khai, Quận Bắc Từ Liêm, Hà Nội.</p>      
    </div>

  
    <div class="sidebar">
        <div class="box">
            <h3>BÀI VIẾT KHÁC</h3>
            <ul class="post-list">
                @foreach ($blogs as $item)
                    <li>
                        <a href="{{ route('blog.detail', $item->id) }}" class="post-item">
                            <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" class="post-image">
                            <span class="post-title">{{ $item->title }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
            
            
        </div>
        
        <div class="box more">
            <h3>XEM NHIỀU</h3>
            <div class="view-more">
                <img src="{{ Storage::url($blog->image) }}" alt="Xu hướng thời trang" >
                <a href="#">{{ $blog->title }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
