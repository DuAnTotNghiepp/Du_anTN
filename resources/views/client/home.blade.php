@extends('client.layouts.app')


@section('content')

    <head>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    </head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .fixed-image {
    width: 300px;
    height: 200px;
    object-fit: cover;
    display: block;
    margin: 0 auto;
}

        .copy-icon {
            color: #070c10;
            cursor: pointer;
            font-size: 18px;
            margin-left: 10px;


            transition: color 0.3s ease, transform 0.2s ease;
        }
        .copy-icon:hover {
            color: #01070e;
            transform: scale(1.2);
        }


        .copy-notification {
            font-size: 12px;
            color: rgb(16, 1, 1);
            margin-left: 10px;
            animation: fadeInOut 2s ease forwards;
        }

        @keyframes fadeInOut {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }

            10% {
                opacity: 1;
                transform: translateY(0);
            }

            90% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                transform: translateY(-10px);
            }
        }

        .custom-alert {
            display: flex;
            align-items: center;
            justify-content: center;
            /* Căn giữa nội dung */

            padding: 15px;
            border-radius: 8px;
            margin-top: 10px;
            font-size: 40px;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            /* Đảm bảo text được căn giữa */
        }

        .alert-success {
            background-color: #e9f7e9;
            color: rgb(24, 79, 23);
            border: none;
        }

        .alert-danger {
            background-color: #fbeaea;
            color: #dc3545;
            border: 1px solid #dc3545;
        }

        .custom-alert .icon {
            margin-right: 10px;
            font-size: 40px;
        }
    </style>
    <div class="hero-area ml-110">
        <div class="row">
            @if (session('success'))
                <div class="alert alert-success custom-alert">
                    <span class="icon">&#128512;</span> <!-- Biểu tượng mặt cười -->
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger custom-alert">
                    <span class="icon">&#128543;</span> <!-- Biểu tượng buồn -->
                    {{ session('error') }}
                </div>
            @endif

            <div class="col-xxl-12 col-xl-9 col-lg-9 p-0">
                <div class="row">
                    <div class="swiper-container hero-swiper-container">

                        <div class="swiper-wrapper">
                            <div
                                class="swiper-slide hero-slider-item slider-item1 d-flex justify-content-center align-items-center position-relative">
                                <div class="slidear-image-layer">

                                </div>
                                <div class="slider-content position-relative text-center">
                                    <h5 class="slider-sub-title">Xu hướng thời trang</h5>
                                    <h2 class="slider-main-title">Bộ sưu tập tuyệt vời dành cho thời trang của bạn</h2>
                                    <div class="banner-btn">
                                        <a href="product.html" class="eg-btn-xl"> View All Collection</a>
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
    </div>


    <div class="banner-md-area ml-110">
        <div class="container-fluid">
            <div class="row">
                @forelse ($vouchers as $voucher)
                    <div class="col-lg-4 col-md-6">
                        <div class="banner-md banner-md1 position-relative">
                            <div class="banner-img">
                                <img src="assets/images/banner/image.png" alt="banner" class="img-fluid">
                            </div>
                            <div class="banner-md-content position-absolute">
                                <div class="banner-md-content-wrap">
                                    <div class="banner-lavel">Giảm Giá Đặc Biệt</div>
                                    <h3 class="banner-title">
                                        Mã Code:
                                <span id="voucher-code-{{ $voucher->id }}">{{ $voucher->code }}</span>


                                <i id="icon-{{ $voucher->id }}" class="fas fa-copy copy-icon"
                                    onclick="copyToClipboard('voucher-code-{{ $voucher->id }}', 'icon-{{ $voucher->id }}')"
                                    title="Copy to clipboard">
                                </i>
                                    </h3>
                                    <div class="banner-btn">
                                        <p>
                                            @if ($voucher->minimum_order_value)
                                                Giá Trị Đơn Hàng Tối Thiểu: {{ number_format($voucher->minimum_order_value, 0) }} VNĐ
                                            @else
                                                Không yêu cầu giá trị đơn hàng tối thiểu
                                            @endif
                                        </p>
                                    </div>
                                    <div class="banner-btn">
                                        <p>Áp Dụng Cho Mọi Sản Phẩm</p>
                                    </div>
                                    <div class="banner-btn">
                                        <p>Áp Dụng Đến Ngày: {{ date('d/m/Y', strtotime($voucher->end_date)) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Hiện không có voucher nào được hiển thị!</p>
                @endforelse
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
                                            style="width: 375.15px; height: 332.87px">
                                    </a>
                                    <div class="product-actions-xl">
                                        <button class="favorite-btn" style="background: none; border: none" data-product-id="{{ $item->id }}">
                                            <i class="flaticon-heart"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="product-content-xl text-center">
                                    <ul class="d-flex product-rating-xl">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= round($item->average_rating))
                                                <li><i class="bi bi-star-fill" style="color: gold;"></i></li>
                                            @else
                                                <li><i class="bi bi-star"></i></li>
                                            @endif
                                        @endfor
                                    </ul>
                                    <a href="product-details.html" class="product-title">{{ $item->name }}</a>
                                    <div class="product-price">
                                        <del class="old-price">{{ $item->price_regular }}</del>
                                        <ins class="new-price">{{ $item->price_sale }}</ins>
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
                        <h2 class="section-title">Sản Phẩm Nổi Bật</h2>
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
                                                src="{{ Storage::url($item->img_thumbnail) }}" alt class="img-fluid"></a>
                                        <div class="product-actions-xl">
                                            <button class="favorite-btn" style="background: none; border: none"
                                                data-product-id="{{ $item->id }}">
                                                <i class="flaticon-heart"></i>
                                            </button>

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
                                            <del class="old-price">{{ $item->price_regular }}</del>
                                            <ins class="new-price">{{ $item->price_sale }}</ins>
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


{{--    <div class="banner-xl-area ml-110 mt-100">--}}
{{--        <div class="container-fluid p-0">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-12">--}}
{{--                    <div class="banner-xl-bg d-flex align-items-center position-relative">--}}
{{--                        <div class="banner-shapes">--}}
{{--                            <img src="" alt class="position-absolute top-0 end-0">--}}
{{--                            <img src="" alt class="position-absolute top0 bottom-0">--}}
{{--                        </div>--}}
{{--                        <div class="banner-content-wrap">--}}
{{--                            <h5 class="banner-xl-subtitle">Today Top Offer</h5>--}}
{{--                            <h2 class="banner-xl-title">Lining Casual Winter Sale Only 250$</h2>--}}
{{--                            <p>Lorem ipsum dolor sit amet consectetur adipiscing elitsed do eiusmod tempor incididunt--}}
{{--                                utlabore et dolore magna aliqua. Utenim ad minim veniam quis nostrud exercitation--}}
{{--                                ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>--}}
{{--                            <div class="banner-xl-btns">--}}
{{--                                <a href="product.html" class="eg-btn-md">Shop Now</a>--}}
{{--                                <a href="product-details.html" class="eg-btn-md v2">About Product</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


    <div class="recent-product-wrapper ml-110 mt-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mb-25">
                    <div class="section-head">
                        <h2 class="section-title">Bộ sưu tập</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-3 col-xl-3 col-lg-4">
                    <div class="nav flex-column category-tabs">
                        <button class="nav-link active category-tab" data-category="all">Tất Cả Bộ Sưu Tập</button>
                        <button class="nav-link category-tab" data-category="Mùa đông">Mùa Đông</button>
                        <button class="nav-link category-tab" data-category="Mùa hè">Mùa Hè</button>
                        <button class="nav-link category-tab" data-category="Mùa thu">Mùa Thu</button>
                        <button class="nav-link category-tab" data-category="Bộ sưu tập Nam mới">Bộ Sưu Tập Cho Nam</button>
                        <button class="nav-link category-tab" data-category="Bộ sưu tập Nữ mới">Bộ Sưu Tập Cho Nữ</button>
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
                        <h2 class="section-title">Các Bài Viết</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="swiper-blog-container overflow-hidden">
                    <div class="swiper-wrapper">
                        @foreach ($blogs as $post)
                            <div class="swiper-slide">
                                <div class="blog-card-m">
                                    <div class="blog-img-m">
                                        <a href="{{ route('blog.detail', $post->id) }}">
                                            <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="fixed-image">
                                        </a>
                                        <div class="blog-actions">
                                            <a href="#"><i class="flaticon-share"></i></a>
                                        </div>
                                    </div>
                                    <div class="blog-content-m">
                                        <ul class="blog-info d-flex">
                                            <li class="blog-author">
                                                <img src="assets/images/blog/blog-author1.png" alt="Author" class="author-img">
                                                <a href="{{ route('blog.detail', $post->id) }}">Alex Avater</a>
                                            </li>

                                        </ul>
                                        <div class="blog-bottom">
                                            <h4 class="blog-title">
                                                <a href="{{ route('blog.detail', $post->id) }}">{{ $post->title }}</a>
                                            </h4>
                                            <div class="blog-link-btn">
                                                <a href="{{ route('blog.detail', $post->id) }}">
                                                    View This Story <i class="flaticon-arrow-pointing-to-right"></i>
                                                </a>
                                            </div>
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
            button.addEventListener('click', function() {
                const productId = this.dataset.productId;

                fetch('{{ route('favorites.toggle') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            product_id: productId
                        }),
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
    <script>
        function copyToClipboard(voucherId, iconId) {
            // Lấy nội dung mã voucher
            const voucherCode = document.getElementById(voucherId).textContent;

            // Tạo input tạm thời để sao chép
            const tempInput = document.createElement("input");
            document.body.appendChild(tempInput);
            tempInput.value = voucherCode;
            tempInput.select();

            // Sao chép nội dung vào clipboard
            const isCopied = document.execCommand("copy");

            // Xóa input tạm thời
            document.body.removeChild(tempInput);

            if (isCopied) {
                // Thay đổi icon
                const iconElement = document.getElementById(iconId);
                iconElement.classList.remove("fa-copy");
                iconElement.classList.add("fa-check");
                iconElement.style.color = "green";

                // Tạo thông báo nhỏ
                let notification = document.createElement("span");
                notification.classList.add("copy-notification");
                notification.textContent = "Đã sao chép!";
                iconElement.parentElement.appendChild(notification);

                // Ẩn thông báo sau 2 giây
                setTimeout(() => {
                    iconElement.classList.remove("fa-check");
                    iconElement.classList.add("fa-copy");
                    iconElement.style.color = "#007bff";

                    notification.remove();
                }, 300);
            } else {
                alert("Không thể sao chép mã, vui lòng thử lại!");
            }
        }
    </script>
@endsection
