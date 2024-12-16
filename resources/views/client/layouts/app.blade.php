<!doctype html>
<html lang="en">

<!-- Mirrored from demo-egenslab.b-cdn.net/html/eg-shop-fashion/v1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 14 Jul 2024 08:23:41 GMT -->

<head>
    <title>EG Shop Fashion - Multipurpose e-Commerce HTML Template</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png" sizes="20x20">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/font/flaticon.css') }}">

    <link rel="stylesheet" href="{{ asset('assegit ts/css/bootstrap-icons.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <style>
        .price-regular {
            text-decoration: line-through;
            /* Gạch ngang giá cũ */
            color: gray;
            /* Màu xám cho giá cũ */
        }

        .price-sale {
            color: red;
            /* Màu đỏ cho giá khuyến mãi */
            font-weight: bold;
            /* In đậm giá khuyến mãi */
            font-size: 1.2em;
            /* Kích thước chữ lớn hơn */
        }

        .product-variation {
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .product-variation:hover {
            transform: scale(1.1);
            /* Phóng to nhẹ khi hover */
        }

        .pd-showcase-img img {
            max-width: 90%;
            transition: opacity 0.3s ease;
        }

        #hover-preview {
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 5px;
            border-radius: 5px;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

</head>

<body>

    <div class="main-sidebar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-1 col-1">
                    <div class="sidebar-wrap d-flex justify-content-between flex-column">
                        <div class="sidebar-top d-flex flex-column align-items-center">
                        </div>
                        <div class="sidebar-bottom">
                            <ul class="sidebar-icons">
                                <li>
                                    @if (auth()->check())
                                        <!-- Hiển thị tên người dùng với liên kết đến trang profile -->
                                        <a href="{{ route('profile', ['id' => auth()->user()->id]) }}">
                                            <i class="flaticon-user">
                                        </a></i>
                                    @else
                                        <!-- Hiển thị liên kết đăng nhập và đăng ký nếu người dùng chưa đăng nhập -->
                                        <a style="color: black" href="{{ route('login') }}">Đăng nhập</a>
                                        <a style="color: black" href="{{ route('register') }}">Đăng ký</a>
                                    @endif
                                </li>
                                <li><a href="{{ route('favorites.index') }}"><i class="flaticon-heart"></i></a></li>
                                <li class="cart-icon">
                                    <i class="flaticon-shopping-cart"></i>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="cart-sidebar-wrappper">
        <div class="main-cart-sidebar">
            <div class="cart-top">
                <div class="cart-close-icon">
                    <i class="flaticon-letter-x"></i>
                </div>
                <ul class="cart-product-grid">
                    @php
                        $totalPrice = 0; // Khởi tạo biến tính tổng giá
                    @endphp

                    @foreach($cartItems->take(5) as $item)
                        @php
                            $totalPrice += $item->quantity * ($item->product->price_sale ?? 0); // Cộng dồn giá của từng sản phẩm
                        @endphp
                        <li class="single-cart-product">
                            <div class="cart-product-info d-flex align-items-center">
                                <div class="product-img">
                                    <img src="{{ asset('storage/' . $item->product->img_thumbnail) }}" alt="{{ $item->product->name }}" class="img-fluid">
                                </div>
                                <div class="product-info">
                                        <h5 class="product-title">{{ $item->product->name }}</h5>
                                    </a>
                                    <ul class="product-rating d-flex">
                                        @for($i = 0; $i < 5; $i++)
                                            <li><i class="bi bi-star{{ $i < ($item->product->rating ?? 0) ? '-fill' : '' }}"></i></li>
                                        @endfor
                                    </ul>
                                    <p class="product-price">
                                        <span>{{ $item->quantity }}</span>x
                                        <span class="p-price">{{ number_format($item->product->price_sale ?? 0, 2) }} VND</span>
                                    </p>
                                </div>
                            </div>
                            <div class="cart-product-delete-btn">
                                <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="flaticon-letter-x"></i></button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>


            </div>
            <div class="cart-bottom">
                <div class="cart-total d-flex justify-content-between">
                    <label>Tổng Giá :</label>
                    <span>{{ number_format($totalPrice, 2) }} VND</span>
                </div>
                <div class="cart-btns">
                    <a href="{{ route('cart.index') }}" class="cart-btn cart">VIEW CART</a>
                </div>
            </div>
        </div>
    </div>
    <div class="topbar-area">
        <div class="container-fluid p-0">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="topbar-contact d-flex justify-content-center align-items-center">
                        <div class="topbar-mail">
                            <i class="flaticon-envelope"></i>
                            <a href="mail.html"><span class="__cf_email__"
                                    data-cfemail="a7cec9c1c8d4d2d7d7c8d5d3e7c2dfc6cad7cbc289c4c8ca">[email&#160;:
                                    @if (auth()->check())
                                        <!-- Hiển thị email người dùng với liên kết đến trang profile -->
                                        {{ Auth::user()->email }}
                                    @else
                                        <!-- Hiển thị liên kết đăng nhập và đăng ký nếu người dùng chưa đăng nhập -->
                                        <a style="color: black" href="{{ route('login') }}">Đăng nhập</a> |
                                        <a style="color: black" href="{{ route('register') }}">Đăng ký</a>
                                    @endif

                                    ]
                                </span></a>
                        </div>
                        <div class="topbar-social-icons">
                            <ul class="d-flex align-items-center">
                                <li class="text">Follow Us</li>
                                <li><a href="#"><i class="flaticon-facebook"></i></a></li>
                                <li><a href="#"><i class="flaticon-twitter"></i></a></li>
                                <li><a href="#"><i class="flaticon-pinterest"></i></a></li>
                                <li><a href="#"><i class="flaticon-instagram-1"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="topbar-sittings d-flex justify-content-center">
                        <ul class="d-flex">
                            <li><a href="#"><i class="flaticon-translate"></i> Language</a></li>
                            <li><a href="#"><i class="flaticon-exchange"></i> Currency</a></li>
                            <li><a href="#"><i class="flaticon-placeholder"></i> Track Order</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <header>
        <div class="header-area">
            <div class="container-fluid">
                <div class="row">
                    <div
                        class="col-xl-2 col-lg-12 col-md-12 col-sm-12 col-xs-12 d-xl-flex align-items-center justify-content-center">
                        <div class="main-logo d-flex justify-content-between align-items-center">
                            <a href="/">
                                <img src="{{ asset('assets/images/Logo.png') }}" alt>
                            </a>
                            <div class="mobile-menu d-flex ">
                                <a href="javascript:void(0)" class="hamburger d-block d-xl-none">
                                    <span class="h-top"></span>
                                    <span class="h-middle"></span>
                                    <span class="h-bottom"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 d-flex justify-content-center">
                        <nav class="main-nav">
                            <div class="inner-logo">
                                <a href="/"><img src="{{ asset('assets/images/logo-w.png') }}" alt></a>
                            </div>
                            <ul class="nav-item-list">
                                <li><a href="/">Trang Chủ</a></li>

                                <li class="has-child-menu">
                                    <a href="javascript:void(0)">Danh Mục Sản Phẩm</a>
                                    <i class="fl flaticon-plus">+</i>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('productcatalogue') }}">Tất cả sản phẩm</a></li>
                                        @foreach ($data as $cate)
                                            <li><a
                                                    href="{{ route('productcatalogue', ['catalogue_id' => $cate->id]) }}">{{ $cate->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="{{ route('warranty') }}">Bảo Hành</a></li>
                                <li><a href="{{ route('buying_guide') }}">Hướng Dẫn Mua Hàng</a></li>
                            </ul>
                            </li>
                            </ul>
                            <div class="inner-top">
                                <div class="inner-mail">
                                    <i class="flaticon-envelope"></i>
                                    <a href="mail.html"><span class="__cf_email__"
                                            data-cfemail="2d44434b425e585d5d425f596d48554c405d4148034e4240">[email&#160;protected]</span></a>
                                </div>
                                <div class="inner-tel">
                                    <i class="flaticon-support"></i>
                                    <a href="tel:+008-12124354">+008-12124354</a>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <div class="col-xl-2 col-2 d-none d-xl-flex p-0 justify-content-end">
                        <div class="nav-contact-no">
                            <div class="contact-icon">
                                <i class="flaticon-phone-call"></i>
                            </div>
                            <div class="contact-info">
                                <p>Hot Line Number</p>
                                <a href="tel:+8801761111456">+880 176 1111 456</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-2 d-none d-xl-flex p-0  align-items-center justify-content-center">
                        <div class="nav-right text-center">
                            <p class="text-uppercase">BLACK FRIDAY</p>
                            <h5>All Item up to 20% Off!</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    @yield('content')

    <div class="newslatter-area ml-110 mt-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="newslatter-wrap text-center">
                        <h5>Connect To  Nguyên</h5>
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


    <div class="footer-area ml-110">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer-widget footer-about">

                        <h5 class="footer-widget-title">About EG Store</h5>
                        <p class="about-company">EG STORE - We sell over 200+ branded products on our
                            web-site. </p>
                        <div class="footer-contact-actions">
                            <div class="footer-action"><a href="#">168/170, Avenue 01, Mirpur DOHS,
                                    Bangladesh</a></div>
                            <div class="footer-action"><span>Email : </span><a href="#"> <span
                                        class="__cf_email__"
                                        data-cfemail="563f38303916332e373b263a337835393b">[email&#160;protected]</span></a>
                            </div>
                        </div>
                        <ul class="footer-social-links d-flex">
                            <li><a href="#"><i class="flaticon-facebook"></i></a></li>
                            <li><a href="#"><i class="flaticon-twitter"></i></a></li>
                            <li><a href="#"><i class="flaticon-pinterest"></i></a></li>
                            <li><a href="#"><i class="flaticon-instagram-1"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 ">
                    <div class="row">

                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="footer-widget">
                                <h5 class="footer-widget-title">Company</h5>
                                <ul class="footer-links">
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Returns </a></li>
                                    <li><a href="#">Terms & Conditions</a></li>
                                    <li><a href="#">Our Support</a></li>
                                    <li><a href="#">Terms & Service</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="footer-widget">
                                <h5 class="footer-widget-title">Quick Links</h5>
                                <ul class="footer-links">
                                    <li><a href="about.html">About EG STORE</a></li>
                                    <li><a href="product.html">New Collection</a></li>
                                    <li><a href="product.html">Woman Dress</a></li>
                                    <li><a href="product.html">Man Dress</a></li>
                                    <li><a href="blog-grid.html">Our Latest News</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="footer-widget">
                                <h5 class="footer-widget-title">Our Brands</h5>
                                <ul class="footer-links">
                                    <li><a href="#">Louis Vuitton</a></li>
                                    <li><a href="#">Polo Ralph Lauren</a></li>
                                    <li><a href="#">Dresses Tranding CO</a></li>
                                    <li><a href="#">Aeropostale </a></li>
                                    <li><a href="#">Consistent Manner Collective</a></li>
                                    <li><a href="#">Fashionable Houses</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="footer-widget">
                                <h5 class="footer-widget-title">Our Stores</h5>
                                <ul class="footer-links">
                                    <li><a href="#">las Vegas</a></li>
                                    <li><a href="#">Returns New London N</a></li>
                                    <li><a href="#">USA, Wall Street</a></li>
                                    <li><a href="#">Mirpur, Bangladesh </a></li>
                                    <li><a href="#">los Angeles</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-5">
                        <div class="footer-copyright">
                            <p>Copyright 2021 EG Shop Fashion | Design By Egens Lab</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-7">
                        <div
                            class="footer-bottom-paymant-option d-flex align-items-center justify-content-end flex-wrap">
                            <p>We Using Safe Payment For:</p>
                            <ul class="payment-options d-flex">
                                <li><img src="{{ asset('assets/images/payment/payment-1.png') }}" alt></li>
                                <li><img src="{{ asset('assets/images/payment/payment-2.png') }}" alt></li>
                                <li><img src="{{ asset('assets/images/payment/payment-3.png') }}" alt></li>
                                <li><img src="{{ asset('assets/images/payment/payment-2.png') }}" alt></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiper.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.fancybox.min.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

<!-- Mirrored from demo-egenslab.b-cdn.net/html/eg-shop-fashion/v1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 14 Jul 2024 08:24:04 GMT -->

</html>
