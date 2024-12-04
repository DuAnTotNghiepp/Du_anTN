@extends('client.layouts.app')

@section('content')


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="hero-area ml-110">
        <div class="row">
            <div class="col-xxl-10 col-xl-9 col-lg-9 p-0">
                <div class="row">
                    <div class="swiper-container hero-swiper-container">

                        <div class="swiper-wrapper">
                            <div
                                class="swiper-slide hero-slider-item slider-item1 d-flex justify-content-center align-items-center position-relative">
                                <div class="slidear-image-layer">
                                </div>
                                <div class="slider-content position-relative text-center">
                                    <h5 class="slider-sub-title">Trending Product</h5>
                                    <h2 class="slider-main-title">Awesome Collection for
                                        your Fashion</h2>
                                    <div class="banner-btn">
                                        <a href="product.html" class="eg-btn-xl"> View All Collection</a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="swiper-slide hero-slider-item slider-item2 d-flex justify-content-center align-items-center position-relative">
                                <div class="slider-image-layer">
                                </div>
                                <div class="slider-content position-relative text-center">
                                    <h5 class="slider-sub-title">Trending Product</h5>
                                    <h2 class="slider-main-title">Awesome Collection for
                                        your Fashion</h2>
                                    <div class="banner-btn">
                                        <a href="product.html" class="eg-btn-xl-v2"> View All Collection</a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="swiper-slide hero-slider-item slider-item3 d-flex justify-content-center align-items-center position-relative">
                                <div class="slider-image-layer">
                                </div>
                                <div class="slider-content position-relative text-center">
                                    <h5 class="slider-sub-title">Trending Product</h5>
                                    <h2 class="slider-main-title">Awesome Collection for
                                        your Fashion</h2>
                                    <div class="banner-btn">
                                        <a href="product.html" class="eg-btn-xl-v2"> View All Collection</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="swiper-button-next"><i class="flaticon-arrow-pointing-to-right"></i></div>
                        <div class="swiper-button-prev"><i class="flaticon-arrow-pointing-to-left"></i></div>




                    </div>
                </div>
            </div>
            <div class="col-xxl-2 col-xl-3 col-lg-3 p-0 d-flex justify-content-between feature-banner-col">
                <div class="banner-feature-item position-relative">
                    <div class="b-feature-shape">
                        <img src="assets/images/shapes/banner-feature-shape.png" alt class="position-absolute">
                    </div>
                    <div class="feature-head d-flex align-items-center position-relative">
                        <div class="feature-icon">
                            <i class="flaticon-shipping"></i>
                        </div>
                        <p>Our Quality</p>
                    </div>
                    <h5>Most Advanced Features</h5>
                </div>
                <div class="banner-feature-item position-relative">
                    <div class="b-feature-shape">
                        <img src="assets/images/shapes/banner-feature-shape.png" alt class="position-absolute">
                    </div>
                    <div class="feature-head d-flex align-items-center position-relative">
                        <div class="feature-icon">
                            <i class="flaticon-price-tag"></i>
                        </div>
                        <p>Price System</p>
                    </div>
                    <h5>Very Reasonable Price</h5>
                </div>
                <div class="banner-feature-item position-relative">
                    <div class="b-feature-shape">
                        <img src="assets/images/shapes/banner-feature-shape.png" alt class="position-absolute">
                    </div>
                    <div class="feature-head d-flex align-items-center position-relative">
                        <div class="feature-icon">
                            <i class="flaticon-puzzle"></i>
                        </div>
                        <p>Delivery System</p>
                    </div>
                    <h5>Product Frist Delivery</h5>
                </div>
                <div class="banner-feature-item position-relative">
                    <div class="b-feature-shape">
                        <img src="assets/images/shapes/banner-feature-shape.png" alt class="position-absolute">
                    </div>
                    <div class="feature-head d-flex align-items-center position-relative">
                        <div class="feature-icon">
                            <i class="flaticon-headphones"></i>
                        </div>
                        <p>Customer Support</p>
                    </div>
                    <h5>24/7 Live Support</h5>
                </div>
            </div>
        </div>
    </div>


    <div class="searchbar-area ml-110">
        <div class="container-fluid">
            <form action="#" method="POST" class="main-searchbar-form">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4">
                        <div class="custom-select product-filter-options">
                            <select>
                                <option value="0">Select your choose</option>
                                <option value="1"> Men’s Collection</option>
                                <option value="1">Women Collection</option>
                                <option value="2">Kids Collection</option>
                                <option value="3">Summer Collection</option>
                                <option value="3">Winter Collection</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8">
                        <div class="searchbar-input">
                            <input type="text" placeholder="Search Your Products">
                            <button type="submit">SEARCH</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="banner-md-area ml-110">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="banner-md banner-md1 position-relative">
                        <div class="banner-img">
                            <img src="assets/images/banner/banner-md1.png" alt="banner" class="img-fluid">
                        </div>
                        <div class="banner-md-content position-absolute">
                            <div class="banner-md-content-wrap">
                                <div class="banner-lavel">New Arrivals</div>
                                <h3 class="banner-title">
                                    Woman’s Winter Sale 2021
                                </h3>
                                <div class="banner-btn">
                                    <a href="product.html">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="banner-md banner-md2 position-relative">
                        <div class="banner-img">
                            <img src="assets/images/banner/banner-md2.png" alt="banner" class="img-fluid">
                        </div>
                        <div class="banner-md-content position-absolute text-end">
                            <div class="banner-md-content-wrap">
                                <span>Featured Product Shoes</span>
                                <h3 class="banner-title">
                                    Ultimate Booster
                                    Blows you
                                </h3>
                                <div class="banner-btn">
                                    <a href="product.html">Shop Now</a>
                                </div>
                                <div class="discount-lavel">
                                    <span> 15% <br>
                                        OFF</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="banner-md banner-md3 position-relative">
                        <div class="banner-img">
                            <img src="assets/images/banner/banner-md3.png" alt="banner" class="img-fluid">
                        </div>
                        <div class="banner-md-content position-absolute">
                            <div class="banner-md-content-wrap">
                                <div class="banner-lavel">New Arrivals</div>
                                <h3 class="banner-title">
                                    Men’s Casul Summer 2021
                                </h3>
                                <div class="banner-btn">
                                    <a href="product.html">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <div class="tranding-product-wrapper ml-110 mt-70 position-relative">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mb-50">
                    <div class="section-head">
                        <h2 class="section-title">Tất Cả Sản Phẩm</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="swiper-tranding-container overflow-hidden pb-30">
                    <div class="swiper-wrapper">
                        @foreach ($listSp as $item)
                            <div class="swiper-slide">
                                <div class="product-card-xl">
                                    <div class="product-img-xl">
                                        <a href="{{ route('product.product_detail', ['id' => $item->id]) }}">

                                            <img src="{{ Storage::url($item->img_thumbnail) }}" alt class="img-fluid"
                                                style="width: 375.15px; height: 332.87px"></a>
                                        <div class="product-actions-xl">
                                            <button class="favorite-btn" style="background: none; border: none" data-product-id="{{ $item->id }}">
                                                <i class="flaticon-heart"></i>
                                            </button>



                                            <a href="product-details.html"><i class="flaticon-search"></i></a>
                                            <a href="cart.html"><i class="flaticon-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-content-xl text-center">
                                        <ul class="d-flex product-rating-xl">
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star"></i></li>
                                        </ul>
                                        <a href="product-details.html" class="product-title">{{ $item->name }}</a>
                                        <div class="product-price">
                                            <del class="old-price">{{ $item->price_sale }}</del>
                                            <ins class="new-price">{{ $item->price_regular }}</ins>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"><i class="flaticon-arrow-pointing-to-right"></i></div>
                    <div class="swiper-button-prev"><i class="flaticon-arrow-pointing-to-left"></i></div>



                </div>
            </div>
        </div>

    </div>

    <div class="tranding-product-wrapper ml-110 mt-70 position-relative">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mb-50">
                    <div class="section-head">
                        <h2 class="section-title">Tất Các Sản Phẩm Hot</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="swiper-tranding-container overflow-hidden pb-30">
                    <div class="swiper-wrapper">
                        @foreach ($listHot as $item)
                            <div class="swiper-slide">
                                <div class="product-card-xl">
                                    <div class="product-img-xl">
                                        <a href="{{ route('product.product_detail', $item->id) }}"><img
                                                style="width: 375.15px; height: 332.87px"
                                                src="{{ Storage::url($item->img_thumbnail) }}" alt
                                                class="img-fluid"></a>
                                        <div class="product-actions-xl">
                                            <a href="#"><i class="flaticon-heart"></i></a>
                                            <a href="product-details.html"><i class="flaticon-search"></i></a>
                                            <a href="cart.html"><i class="flaticon-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-content-xl text-center">
                                        <ul class="d-flex product-rating-xl">
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star"></i></li>
                                        </ul>
                                        <a href="product-details.html" class="product-title">{{ $item->name }}</a>
                                        <div class="product-price">
                                            <del class="old-price">{{ $item->price_sale }}</del>
                                            <ins class="new-price">{{ $item->price_regular }}</ins>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"><i class="flaticon-arrow-pointing-to-right"></i></div>
                    <div class="swiper-button-prev"><i class="flaticon-arrow-pointing-to-left"></i></div>

                </div>
            </div>
        </div>
    </div>


    <div class="banner-xl-area ml-110 mt-100">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-xl-bg d-flex align-items-center position-relative">
                        <div class="banner-shapes">
                            <img src="assets/images/shapes/b-xl-right.png" alt class="position-absolute top-0 end-0">
                            <img src="assets/images/shapes/b-xl-left.png" alt class="position-absolute top0 bottom-0">
                        </div>
                        <div class="banner-content-wrap">
                            <h5 class="banner-xl-subtitle">Today Top Offer</h5>
                            <h2 class="banner-xl-title">Lining Casual Winter Sale Only 250$</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipiscing elitsed do eiusmod tempor incididunt
                                utlabore et dolore magna aliqua. Utenim ad minim veniam quis nostrud exercitation
                                ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            <div class="banner-xl-btns">
                                <a href="product.html" class="eg-btn-md">Shop Now</a>
                                <a href="product-details.html" class="eg-btn-md v2">About Product</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="recent-product-wrapper ml-110 mt-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mb-25">
                    <div class="section-head">
                        <h2 class="section-title">Recently Stock</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-3 col-xl-3 col-lg-4">
                    <div class="nav flex-column category-tabs">
                        <button class="nav-link active category-tab" data-category="all">All Collection</button>
                        <button class="nav-link category-tab" data-category="winter">Bộ Sưu Tập Áo Cho Mùa Đông</button>
                        <button class="nav-link category-tab" data-category="summer">Bộ Sưu Tập Áo Cho Mùa Hè</button>
                        <button class="nav-link category-tab" data-category="new-male">Bộ Sưu Tập Áo Thời Trang Nam Mới
                            Nhất</button>
                        <button class="nav-link category-tab" data-category="new-female">Bộ Sưu Tập Áo Thời Trang Nữ Mới
                            Nhất</button>
                        <button class="nav-link category-tab" data-category="autumn">Bộ Sưu Tập Áo Cho Mùa Thu</button>
                    </div>

                </div>
                <div class="col-xxl-9 col-xl-9 col-lg-8">
                    <div class="row product-list" id="product-container">
                        <!-- Sản phẩm sẽ được chèn vào đây -->
                    </div>

                </div>
            </div>

        </div>
    </div>


    <div class="blog-area ml-110 mt-100 position-relative">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mb-25">
                    <div class="section-head">
                        <h2 class="section-title">Our Latest Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="swiper-blog-container overflow-hidden">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="blog-card-m">
                                <div class="blog-img-m">
                                    <a href="blog-details.html"><img src="assets/images/blog/bm-1.png" alt></a>
                                    <div class="blog-actions">
                                        <a href="#"><i class="flaticon-share"></i></a>
                                    </div>
                                </div>
                                <div class="blog-content-m">
                                    <ul class="blog-info d-flex">
                                        <li class="blog-author">
                                            <img src="assets/images/blog/blog-author1.png" alt class="author-img">
                                            <a href="#">Alex Avater</a>
                                        </li>
                                        <li class="blog-date">
                                            <i class="flaticon-time"></i>
                                            4th Jan 2021
                                        </li>
                                    </ul>
                                    <div class="blog-bottom">
                                        <h4 class="blog-title"><a href="blog-details.html">How can have anything you
                                                want in life if
                                                you dress for it.</a></h4>
                                        <div class="blog-link-btn">
                                            <a href="blog-details.html">View This Story <i
                                                    class="flaticon-arrow-pointing-to-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="blog-card-m">
                                <div class="blog-img-m">
                                    <a href="blog-details.html"><img src="assets/images/blog/bm-2.png" alt></a>
                                    <div class="blog-actions">
                                        <a href="#"><i class="flaticon-share"></i></a>
                                    </div>
                                </div>
                                <div class="blog-content-m">
                                    <ul class="blog-info d-flex">
                                        <li class="blog-author">
                                            <img src="assets/images/blog/blog-author1.png" alt class="author-img">
                                            <a href="#">Alex Avater</a>
                                        </li>
                                        <li class="blog-date">
                                            <i class="flaticon-time"></i>
                                            4th Jan 2021
                                        </li>
                                    </ul>
                                    <div class="blog-bottom">
                                        <h4 class="blog-title"><a href="blog-details.html">The Coolest Fashion People to
                                                Follow in Every Age Group</a></h4>
                                        <div class="blog-link-btn">
                                            <a href="blog-details.html">View This Story <i
                                                    class="flaticon-arrow-pointing-to-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="blog-card-m">
                                <div class="blog-img-m">
                                    <a href="blog-details.html"><img src="assets/images/blog/bm-3.png" alt></a>
                                    <div class="blog-actions">
                                        <a href="#"><i class="flaticon-share"></i></a>
                                    </div>
                                </div>
                                <div class="blog-content-m">
                                    <ul class="blog-info d-flex">
                                        <li class="blog-author">
                                            <img src="assets/images/blog/blog-author1.png" alt class="author-img">
                                            <a href="#">Alex Avater</a>
                                        </li>
                                        <li class="blog-date">
                                            <i class="flaticon-time"></i>
                                            4th Jan 2021
                                        </li>
                                    </ul>
                                    <div class="blog-bottom">
                                        <h4 class="blog-title"><a href="blog-details.html">Let us know your thoughts in
                                                this
                                                is comments below</a></h4>
                                        <div class="blog-link-btn">
                                            <a href="blog-details.html">View This Story <i
                                                    class="flaticon-arrow-pointing-to-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="blog-card-m">
                                <div class="blog-img-m">
                                    <a href="blog-details.html"><img src="assets/images/blog/bm-4.png" alt></a>
                                    <div class="blog-actions">
                                        <a href="#"><i class="flaticon-share"></i></a>
                                    </div>
                                </div>
                                <div class="blog-content-m">
                                    <ul class="blog-info d-flex">
                                        <li class="blog-author">
                                            <img src="assets/images/blog/blog-author1.png" alt class="author-img">
                                            <a href="#">Alex Avater</a>
                                        </li>
                                        <li class="blog-date">
                                            <i class="flaticon-time"></i>
                                            4th Jan 2021
                                        </li>
                                    </ul>
                                    <div class="blog-bottom">
                                        <h4 class="blog-title"><a href="blog-details.html">How to come up with a good
                                                name
                                                for your fashion blog?</a></h4>
                                        <div class="blog-link-btn">
                                            <a href="blog-details.html">View This Story <i
                                                    class="flaticon-arrow-pointing-to-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-button-next"><i class="flaticon-arrow-pointing-to-right"></i></div>
                    <div class="swiper-button-prev"><i class="flaticon-arrow-pointing-to-left"></i></div>

            </div>
        </div>
    </div>
</div>

<div class="newslatter-area ml-110 mt-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="newslatter-wrap text-center">
                    <h5>Connect To Mai Lan</h5>
                    <h2 class="newslatter-title">Join Our Newsletter</h2>
                    <p>Hey you, sign up it only, Get this limited-edition T-shirt Free!</p>
                    <form action="#" method="POST">
                        <div class="newslatter-form">
                            <input type="text" placeholder="Type Your Email">
                            <button type="submit">Send <i class="bi bi-envelope-fill"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




    <script>
        const productDetailUrl = "{{ route('product.product_detail', ['id' => 'ID_PLACEHOLDER']) }}";
        // Mặc định hiển thị tất cả sản phẩm khi load trang
        document.addEventListener('DOMContentLoaded', function() {
            const allButton = document.querySelector('.category-tab[data-category="all"]');
            allButton.click();
        });
        const container = document.getElementById('product-container');
        document.querySelectorAll('.category-tab').forEach(button => {
            button.addEventListener('click', function() {
                const category = this.dataset.category; // Lấy danh mục từ nút được click

                // Highlight nút đang được chọn
                document.querySelectorAll('.category-tab').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                // Gửi AJAX request
                fetch('/api/get-products-by-category', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            category: category
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        const container = document.getElementById('product-container');
                        container.innerHTML = ''; // Xóa các sản phẩm hiện tại

                        // Kiểm tra nếu không có sản phẩm
                        if (data.products.length === 0) {
                            container.innerHTML = '<p>Không có sản phẩm nào phù hợp.</p>';
                        } else {
                            // Hiển thị danh sách sản phẩm
                            data.products.forEach(product => {
                                const productUrl = productDetailUrl.replace('ID_PLACEHOLDER',
                                    product.id);
                                container.innerHTML += `
                                    <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-sm-6 product-item" data-category="${product.category}">
                                        <div class="product-card-l">
                                            <div class="product-img">
                                                <a href="${productUrl}">
                                                    <img width="375.15px" height="332.87px"
                                                        src="storage/${product.img_thumbnail}">
                                                </a>
                                                <div class="product-lavels">
                                                    <span class="new">New</span>
                                                </div>
                                                <div class="product-actions">
                                                    <a href="#"><i class="flaticon-heart"></i></a>
                                                    <a href="product-details.html"><i class="flaticon-search"></i></a>
                                                    <a href="cart.html"><i class="flaticon-shopping-cart"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-title"><a href="product-details.html">${product.name}</a></h3>
                                                <div class="product-price">
                                                    <del class="old-price">${product.price_regular}</del>
                                                    <ins class="new-price">${product.price_sale}</ins>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                            });
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });

        document.querySelectorAll('.favorite-btn').forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.dataset.productId;

                fetch('{{ route("favorites.toggle") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ product_id: productId }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'added') {
                        alert('Sản phẩm đã được thêm vào yêu thích.');
                    } else if (data.status === 'removed') {
                        alert('Sản phẩm đã được xóa khỏi yêu thích.');
                    }
                });
            });
        });









    </script>
@endsection
