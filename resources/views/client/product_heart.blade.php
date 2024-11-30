@extends('client.layouts.app')

@section('content')
<style>
    .product-img img {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }
</style>

    <div class="breadcrumb-area ml-110">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-bg d-flex justify-content-center align-items-center">
                        <div class="breadcrumb-shape1 position-absolute top-0 end-0">
                            <img src="assets/images/shapes/bs-right.png" alt>
                        </div>
                        <div class="breadcrumb-shape2 position-absolute bottom-0 start-0">
                            <img src="assets/images/shapes/bs-left.png" alt>
                        </div>
                        <div class="breadcrumb-content text-center">
                            <h2 class="page-title">Our All Products</h2>
                            <ul class="page-switcher d-flex ">
                                <li><a href="index.html">Home</a> <i class="flaticon-arrow-pointing-to-right"></i></li>
                                <li>Sản Phẩm Yêu Thích Của Bạn</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="product-area ml-110 mt-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-12 col-xl-8 col-lg-8">
                    <div class="row">

                        @foreach ($favorites as $favorite)
                        <div class="col-xxl-3 col-xl-4 col-lg-4 col-sm-4">
                            <div class="product-card-l">
                                <div class="product-img">
                                    <a href="{{ route('product.product_detail', $favorite->product->id) }}">
                                        <img
                                            src="{{ Storage::url($favorite->product->img_thumbnail) }}"
                                            alt="{{ $favorite->product->name }}"
                                            class="img-fluid"
                                            width="375.15px" height="332.87px">
                                    </a>
                                    <div class="product-lavels"></div>
                                    <div class="product-actions">
                                        <a href="{{ route('product.product_detail', $favorite->product->id) }}"><i class="flaticon-search"></i></a>
                                        <a href="#"><i class="flaticon-shopping-cart"></i></a>
                                    </div>
                                </div>
                                <div class="product-body">
                                    <ul class="d-flex product-rating">
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star"></i></li>
                                        <li>(<span>8</span> Review)</li>
                                    </ul>
                                    <h3 class="product-title">
                                        <a href="{{ route('product.product_detail', $favorite->product->id) }}">
                                            {{ $favorite->product->name }}
                                        </a>
                                    </h3>
                                    <div class="product-price">
                                        <del class="old-price">{{ number_format($favorite->product->price_regular, 0, ',', '.') }} VND</del>
                                        <ins class="new-price">{{ number_format($favorite->product->price_sale, 0, ',', '.') }} VND</ins>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
