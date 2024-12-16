@extends('client.layouts.app')
<style>
    .scrollable-gallery {
    display: flex;
    overflow-x: auto; /* Cuộn ngang */
    overflow-y: hidden; /* Ẩn cuộn dọc */
    max-width: 100%; /* Giới hạn chiều ngang */
    gap: 10px; /* Khoảng cách giữa các ảnh */
}

.product-variation {
    flex: 0 0 auto; /* Bảo đảm các ảnh không co dãn */
    width: 80px; /* Chiều rộng cố định cho ảnh */
    height: 80px; /* Chiều cao cố định cho ảnh */
    cursor: pointer;
    border: 1px solid transparent;
}

.product-variation.active {
    border-color: #007bff; /* Viền xanh khi được chọn */
}

.product-variation img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Đảm bảo ảnh cân đối */
    border-radius: 5px; /* Bo tròn nhẹ */
}

</style>
@section('content')
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
                        <h2 class="page-title">Shop Details</h2>
                        <ul class="page-switcher d-flex ">
                            <li><a href="index.html">Home</a> <i class="flaticon-arrow-pointing-to-right"></i></li>
                            <li>Shop Details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        /* Container cho nút cộng, trừ và input */
        .quantity1 {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 16px;
        }

        /* Nút cộng và trừ */
        .quantity1 button {
            width: 35px;
            height: 35px;
            background-color: #f4f4f4;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s ease;
        }

        .quantity1 button:hover {
            background-color: #ddd;
        }

        .quantity1 button:disabled {
            background-color: #f1f1f1;
            cursor: not-allowed;
        }

        /* Input số lượng */
        .quantity1 input {
            width: 60px;
            height: 35px;
            text-align: center;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 5px;
            margin: 0;
            outline: none;
        }

        .quantity1 input:focus {
            border-color: #007bff;
        }

            /* Ẩn dấu cộng và trừ mặc định cho tất cả trình duyệt */
        .quantity1 input[type="number"]::-webkit-outer-spin-button,
        .quantity1 input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .quantity1 input[type="number"] {
            -moz-appearance: textfield; /* Firefox */
            appearance: none; /* Cho trình duyệt hiện đại */
        }

        /* Đảm bảo input không hiển thị dấu cộng và trừ */
        .quantity1 input {
            -webkit-appearance: none;
            -moz-appearance: textfield;
            appearance: none;
        }

    </style>

    <div class="product-details-area mt-100 ml-110">
        <div class="container">
            <div class="product-details-wrapper">
                <div class="row">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-8">
                        <div class="product-switcher-wrap">
                            <!-- Danh sách ảnh liên quan -->
                            <div class="nav product-tab scrollable-gallery" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <div class="product-variations">
                                    <div class="product-variation" data-image="{{ Storage::url($product->img_thumbnail) }}">
                                        <div class="pd-showcase-img">
                                            <img src="{{ Storage::url($product->img_thumbnail) }}" alt="Product Image">
                                        </div>
                                    </div>
                                    @foreach ($product->galleries as $image)
                                        <div class="product-variation {{ $loop->first ? 'active' : '' }}" data-image="{{ Storage::url($image->image) }}">
                                            <div class="pd-showcase-img">
                                                <img src="{{ Storage::url($image->image) }}" alt="Product Image {{ $loop->iteration }}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Ảnh chính -->
                            <div class="tab-content">
                                <div class="tab-pane fade show active">
                                    <div class="pd-preview-img">
                                        <img id="main-product-image" src="{{ Storage::url($product->img_thumbnail) }}" alt="Main Product Image" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <!-- Cửa sổ ảnh tạm thời (hover preview) -->
                            <div id="hover-preview" style="display: none; position: absolute; z-index: 1000;">
                                <img id="hover-preview-image" src="" alt="Preview" style="max-width: 300px; border: 1px solid #ccc;">
                            </div>
                        </div>
                       <script>
                         document.querySelectorAll('.product-variation').forEach((element) => {
                            element.addEventListener('click', function () {
                                // Đổi ảnh chính
                                const mainImage = document.getElementById('main-product-image');
                                mainImage.src = this.dataset.image;
                        
                                // Cập nhật trạng thái active
                                document.querySelectorAll('.product-variation').forEach((el) => el.classList.remove('active'));
                                this.classList.add('active');
                            });
                        });
                       </script>
                        
                    </div>


                    <div class="col-xxl-6 col-xl-6 col-lg-6">
                        <div class="product-details-wrap">
                            <div class="pd-top">
                                <ul class="product-rating d-flex align-items-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <li>
                                            @if ($i <= $averageRating)
                                                <i class="bi bi-star-fill" style="color: gold;"></i>
                                            @else
                                                <i class="bi bi-star"></i>
                                            @endif
                                        </li>
                                    @endfor
                                </ul>
                                <span>(Trung bình: {{ $averageRating }} sao)</span>
                                <h1>{{ $product->name }}</h1>
                                <p><strong>Giá cũ:</strong> <span
                                        class="price-regular">{{ $product->price_regular }}</span>
                                </p>
                                <p><strong>Giá khuyến mãi:</strong> <span
                                        class="price-sale">{{ $product->price_sale }}</span></p>

                            </div>

                            <div class="pd-quick-discription">
                                <ul>
                                  <!-- Màu sắc -->
                                    <li class="d-flex align-items-center">
                                        <span>Color :</span>
                                        <div class="color-option d-flex align-items-center">
                                            @foreach ($product->variants as $variant)
                                                @if ($variant->name === 'Color')
                                                    <input type="radio" name="color" id="color{{ $variant->id }}"
                                                        value="{{ $variant->value }}"
                                                        data-product-id="{{ $product->id }}"
                                                        data-variant-id="{{ $variant->id }}"
                                                        {{ $loop->first ? 'checked' : '' }}
                                                        class="color-option-input">
                                                    <label for="color{{ $variant->id }}">
                                                        <span class="p-color" style="background-color: {{ $variant->value }}"></span>
                                                    </label>
                                                @endif
                                            @endforeach
                                        </div>
                                    </li>

                                    <!-- Kích thước -->
                                    <li class="d-flex align-items-center">
                                        <span>Size :</span>
                                        <div class="size-option d-flex align-items-center">
                                            @foreach ($product->variants as $variant)
                                                @if ($variant->name === 'Size')
                                                    <input type="radio" name="size" id="size{{ $variant->id }}"

                                                        {{-- value="{{ $variant->value }}" {{ $loop->first ? 'checked' : '' }}> --}}

                                                        value="{{ $variant->value }}"
                                                        data-product-id="{{ $product->id }}"
                                                        data-variant-id="{{ $variant->id }}"
                                                        {{ $loop->first ? 'checked' : '' }}
                                                        class="size-option-input">

                                                    <label for="size{{ $variant->id }}">
                                                        <span class="p-size">{{ $variant->value }}</span>
                                                    </label>
                                                @endif
                                            @endforeach
                                        </div>
                                    </li>


                                    <!-- Số lượng -->
                                    <li class="d-flex align-items-center pd-cart-btns">
                                        <div class="quantity1">
                                            <button type="button" id="decrease-btn">-</button>
                                            <input name="quantity" type="number" min="1" max="{{ $product->variants->first()->pivot->quantity ?? 0 }}"
                                                   step="1" value="1" id="quantity-input">
                                            <button type="button" id="increase-btn">+</button>
                                        </div>
                                        @if (Auth::check())
                                            <button type="button" class="pd-add-cart" id="buy-now-btn">
                                                <a href="{{ route('checkout') }}" style="color:white">Mua Ngay</a>
                                            </button>
                                        @else
                                            <a href="{{ route('login') }}"
                                                onclick="event.preventDefault(); document.getElementById('login-form').submit();"
                                                class="pd-add-cart">Mua Ngay</a>

                                            <form id="login-form" action="{{ route('login') }}" method="GET"
                                                style="display: none;">
                                                <input type="hidden" name="redirect_url"
                                                    value="{{ url()->current() }}">
                                            </form>
                                        @endif
                                        {{-- Form Thêm vào Giỏ Hàng --}}
                                        <form action="{{ route('cart.store') }}" method="POST" id="add-to-cart-form">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="variant_id" id="variant_id">
                                            <input type="hidden" name="color" id="selected-color" value="">
                                            <input type="hidden" name="size" id="selected-size" value="">
                                            <input type="hidden" name="quantity" id="quantity" value="1">
                                            <input type="hidden" name="price" id="selected-price"
                                                value="{{ $product->price_sale }}">
                                            <button type="submit" class="pd-add-cart">Thêm vào giỏ hàng</button>
                                        </form>
                                        <button class="pd-add-cart"
                                            style="background: none; border: none; background-color: red"
                                            id="favorite-btn" data-product-id="{{ $product->id }}">
                                            <i class="flaticon-heart"></i>
                                        </button>

                                        <form action="{{ route('cart.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="color"
                                                value="{{ $product->variants->firstWhere('name', 'Color')->value }}">
                                            <input type="hidden" name="size"
                                                value="{{ $product->variants->firstWhere('name', 'Size')->value }}">
                                            <input type="hidden" name="quantity" value="1" id="cart-quantity">

                                            <button type="submit" class="pd-add-cart">Thêm vào giỏ hàng</button>
                                        </form>

                                    </li>

                                    {{-- <li id="quantity-warning" style="color: red; display: none;">
                                        Số lượng sản phẩm đã đạt tối đa!
                                    <li id="quantity-warning" style="color: red; display: none;">
                                        Số lượng sản phẩm đã đạt tối đa!
                                    </li> --}}
                                    <li class="pd-type">Danh mục sản phẩm: <span>{{ $product->catelogues->name }}</span>
                                    </li>
                                    <li class="pd-type">Mã sản phẩm: <span>{{ $product->sku }}</span></li>
                                    <!-- Số lượng tồn kho -->
                                    <li class="pd-type">Số lượng tồn kho: <span id="stock-quantity">{{ $product->variants->first()->pivot->quantity ?? 0 }}</span></li>
                                    <li class="pd-type">Chất liệu: <span>{{ $product->material }}</span></li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-discription-wrapper mt-100">
                <div class="row">
                    <div class="col-xxl-3 col-xl-3">
                        <div class="nav flex-column nav-pills discription-bar" id="v-pills-tab2" role="tablist"
                            aria-orientation="vertical">
                            <button class="nav-link active" id="pd-discription3" data-bs-toggle="pill"
                                data-bs-target="#pd-discription-pill3" role="tab"
                                aria-controls="pd-discription-pill3"> Discription
                            </button>
                            <button class="nav-link" id="pd-discription2" data-bs-toggle="pill"
                                data-bs-target="#pd-discription-pill2" role="tab"
                                aria-controls="pd-discription-pill2">Additional
                                Information
                            </button>
                            <button class="nav-link" id="pd-discription1" data-bs-toggle="pill"
                                data-bs-target="#pd-discription-pill1" role="tab"
                                aria-controls="pd-discription-pill1">Our Review (2)
                            </button>
                        </div>
                    </div>

                    <div class="col-xxl-9 col-xl-9">
                        <div class="tab-content discribtion-tab-content" id="v-pills-tabContent2">
                            <div class="tab-pane fade show active" id="pd-discription-pill3" role="tabpanel"
                                aria-labelledby="pd-discription3">
                                <div class="discription-texts">
                                    <p><strong>Mô tả:</strong> {{ $product->description }}</p>
                                </div>
                                <div class="discription-texts">
                                    <p><strong>Hướng dẫn sử dụng:</strong> {{ $product->user_manual }}</p>
                                </div>
                                <div class="discription-texts">
                                    <p><strong>Nội dung:</strong> {{ $product->content }}</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pd-discription-pill2" role="tabpanel"
                                aria-labelledby="pd-discription2">
                                <div class="additional-discription">
                                    <ul>
                                        <li>
                                            <h5 class="additition-name">Color</h5>
                                            <div class="additition-variant"><span>:</span>Red, Green, Blue, Yellow,
                                                pink,
                                            </div>
                                        </li>
                                        <li>
                                            <h5 class="additition-name">Size</h5>
                                            <div class="additition-variant"><span>:</span>S, M, L, Xl, XXL</div>
                                        </li>
                                        <li>
                                            <p><strong>Chất liệu:</strong> {{ $product->material }}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pd-discription-pill1" role="tabpanel"
                                aria-labelledby="pd-discription1">
                                <div class="discription-review">
                                    <h4 class="mb-4">Đánh giá của khách hàng</h4>
                                    <div class="clients-review-cards">
                                        <div class="row" id="comments-list">
                                            @foreach ($comments as $comment)
                                                <div class="col-lg-6 mb-3">
                                                    <div class="card client-review-card">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center mb-3">
                                                                <div class="client-review-img me-3">
                                                                    <img src="assets/images/blog/author.png"
                                                                        alt="Client Image" class="rounded-circle"
                                                                        width="50" height="50">
                                                                </div>
                                                                <div class="client-review-info">
                                                                    <h5 class="client-name mb-1">
                                                                        {{ $comment->user->name }}</h5>
                                                                    <ul
                                                                        class="product-rating d-flex align-items-center list-unstyled mb-0">
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            <li class="me-1">
                                                                                <i class="bi bi-star{{ $i <= $comment->rating ? '-fill' : '' }}"
                                                                                    style="color: gold;"></i>
                                                                            </li>
                                                                        @endfor
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="client-review-text">
                                                                <p class="mb-0">{{ $comment->noidung }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger mt-4">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @auth
                                    <form id="comment-form" class="review-form mt-4">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <!-- Thêm product_id -->
                                        <div class="form-group">
                                            <label for="content">Nội dung bình luận:</label>
                                            <textarea id="content" name="noidung" class="form-control" required></textarea>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="rating">Đánh giá:</label>
                                            <div class="d-flex">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" name="rating"
                                                            value="{{ $i }}" id="rating{{ $i }}"
                                                            style="display: none;">
                                                        <label class="form-check-label" for="rating{{ $i }}"
                                                            style="cursor: pointer;">
                                                            <i class="bi bi-star-fill star" data-value="{{ $i }}"
                                                                style="font-size: 24px; color: gray;"></i>
                                                        </label>
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-3">Gửi bình luận</button>
                                    </form>
                                    <div id="response-message"></div> <!-- Nơi hiển thị phản hồi -->
                                @else
                                    <p class="mt-4">Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để gửi bình luận.
                                    </p>
                                @endauth

                                <script>
                                    document.getElementById('comment-form').addEventListener('submit', function(event) {
                                        event.preventDefault(); // Ngăn chặn hành động mặc định của form

                                        const formData = new FormData(this); // Lấy dữ liệu từ form

                                        fetch("{{ route('comment.store', $product->id) }}", {
                                                method: 'POST',
                                                body: formData,
                                                headers: {
                                                    'X-Requested-With': 'XMLHttpRequest',
                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // Thêm token CSRF
                                                },
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                if (data.success) {
                                                    // Thêm bình luận mới vào danh sách
                                                    const commentsList = document.getElementById('comments-list');
                                                    commentsList.insertAdjacentHTML('afterbegin', `
                                                <div class="col-lg-6 mb-3">
                                                    <div class="card client-review-card">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center mb-3">
                                                                <div class="client-review-img me-3">
                                                                    <img src="assets/images/blog/author.png" alt="Client Image" class="rounded-circle" width="50" height="50">
                                                                </div>
                                                                <div class="client-review-info">
                                                                    <h5 class="client-name mb-1">${data.comment.user_name}</h5>
                                                                   <ul class="product-rating d-flex align-items-center list-unstyled mb-0" style="font-size: 24px; color: gold;">
    ${'★'.repeat(data.comment.rating)}${'☆'.repeat(5 - data.comment.rating)}
</ul>
                                                                </div>
                                                            </div>
                                                            <div class="client-review-text">
                                                                <p class="mb-0">${data.comment.noidung}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            `);
                                                    // Xóa nội dung form
                                                    document.getElementById('content').value = '';
                                                    document.querySelector('input[name="rating"]:checked').checked = false;
                                                } else {
                                                    document.getElementById('response-message').innerHTML =
                                                        `<div class="alert alert-danger">${data.message}</div>`;
                                                }
                                            })
                                            .catch(error => {
                                                console.error('Error:', error);
                                                document.getElementById('response-message').innerHTML =
                                                    `<div class="alert alert-danger">Đã xảy ra lỗi, vui lòng thử lại.</div>`;
                                            });
                                    });

                                    // JavaScript to handle star rating
                                    const stars = document.querySelectorAll('.star');
                                    stars.forEach(star => {
                                        star.addEventListener('click', function() {
                                            const ratingValue = this.getAttribute('data-value');

                                            // Update the radio button selection
                                            document.querySelector(`input[name="rating"][value="${ratingValue}"]`).checked = true;

                                            // Set the color of the stars
                                            stars.forEach((s, index) => {
                                                s.style.color = index < ratingValue ? 'gold' : 'gray'; // Cập nhật màu sắc
                                            });
                                        });
                                    });
                                </script>

                                <style>
                                    /* Optional: Add some margin around stars */
                                    .star {
                                        margin-right: 5px;
                                    }
                                </style>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('buy-now-btn').addEventListener('click', function(event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định nếu nút nằm trong một form
            // Lấy thông tin người dùng đã chọn
            const color = document.querySelector('input[name="color"]:checked').value;
            const size = document.querySelector('input[name="size"]:checked').value;
            const quantity = document.getElementById('quantity-input').value;
            const productImage = "{{ Storage::url($product->img_thumbnail) }}";
            const productName = "{{ $product->name }}";
            const productPrice = "{{ $product->price_sale }}";
            // Tạo URL đến trang checkout
            const checkoutUrl =
                `{{ route('checkout') }}?color=${encodeURIComponent(color)}&size=${encodeURIComponent(size)}&quantity=${encodeURIComponent(quantity)}&image=${encodeURIComponent(productImage)}&name=${encodeURIComponent(productName)}&price=${encodeURIComponent(productPrice)}`;
            // Chuyển hướng đến trang checkout
            window.location.href = checkoutUrl;
        });
        document.addEventListener('DOMContentLoaded', function() {
            const productVariations = document.querySelectorAll('.product-variation');
            const mainProductImage = document.getElementById('main-product-image');
            const hoverPreview = document.getElementById('hover-preview');
            const hoverPreviewImage = document.getElementById('hover-preview-image');
            // Hover: Hiển thị cửa sổ ảnh liên quan
            productVariations.forEach(variation => {
                variation.addEventListener('mouseover', function(event) {
                    const imageUrl = this.dataset.image;
                    if (imageUrl) {
                        hoverPreviewImage.src = imageUrl;
                        hoverPreview.style.display = 'block';
                        hoverPreview.style.top = event.pageY + 10 + 'px';
                        hoverPreview.style.left = event.pageX + 10 + 'px';
                    }
                });
                variation.addEventListener('mousemove', function(event) {
                    hoverPreview.style.top = event.pageY + 10 + 'px';
                    hoverPreview.style.left = event.pageX + 10 + 'px';
                });
                variation.addEventListener('mouseout', function() {
                    hoverPreview.style.display = 'none';
                });
                // Click: Cập nhật ảnh chính
                variation.addEventListener('click', function() {
                    const imageUrl = this.dataset.image;
                    if (imageUrl) {
                        mainProductImage.src = imageUrl;
                        // Xóa class active khỏi tất cả các ảnh
                        productVariations.forEach(v => v.classList.remove('active'));
                        // Thêm class active vào ảnh đã click
                        this.classList.add('active');
                    }
                });
            });
        });
    </script>
@endsection
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const variantInputs = document.querySelectorAll('input[name="color"], input[name="size"]');
                const stockQuantityElement = document.getElementById('stock-quantity');

                // Cập nhật số lượng tồn kho khi thay đổi biến thể
                function updateStockQuantity(productId, variantId) {
                    fetch(`/api/variant-stock?product_id=${productId}&variant_id=${variantId}`)
                        .then(response => response.json())
                        .then(data => {
                            // Cập nhật số lượng tồn kho
                            stockQuantityElement.textContent = data.quantity;
                        })
                        .catch(error => {
                            console.error('Error fetching stock quantity:', error);
                        });
                }

                // Lắng nghe sự thay đổi trên các input màu sắc và kích thước
                variantInputs.forEach(input => {
                    input.addEventListener('change', function () {
                        const productId = this.dataset.productId;
                        const variantId = this.dataset.variantId;

                        // Cập nhật số lượng tồn kho cho biến thể đã chọn
                        updateStockQuantity(productId, variantId);
                    });
                });
            });

        </script>
        <script>
            // Lắng nghe sự kiện khi người dùng chọn màu
            document.querySelectorAll('.color-option-input').forEach(input => {
                input.addEventListener('change', function() {
                    var selectedColor = this.value;
                    document.getElementById('selected-color').value = selectedColor;
                });
            });

            document.querySelectorAll('.size-option-input').forEach(input => {
                input.addEventListener('change', function() {
                    var selectedSize = this.value;
                    document.getElementById('selected-size').value = selectedSize;
                });
            });

            // Lắng nghe sự kiện khi người dùng thay đổi số lượng
            document.addEventListener('DOMContentLoaded', function () {
                const quantityInput = document.getElementById('quantity-input');
                const increaseBtn = document.getElementById('increase-btn');
                const decreaseBtn = document.getElementById('decrease-btn');
                const stockQuantityElement = document.getElementById('stock-quantity');

                // Cập nhật số lượng tồn kho khi thay đổi biến thể
                function updateMaxQuantity(productId, variantId) {
                    fetch(`/api/variant-stock?product_id=${productId}&variant_id=${variantId}`)
                        .then(response => response.json())
                        .then(data => {
                            const stockQuantity = data.quantity;
                            // Cập nhật giá trị max của input số lượng
                            quantityInput.max = stockQuantity;

                            // Nếu số lượng người dùng nhập vượt quá max, cập nhật lại giá trị
                            if (parseInt(quantityInput.value) > stockQuantity) {
                                quantityInput.value = stockQuantity;
                            }

                            // Cập nhật hiển thị số lượng tồn kho
                            stockQuantityElement.textContent = stockQuantity;

                            // Kiểm tra và vô hiệu hóa nút tăng giảm
                            toggleQuantityButtons(stockQuantity);
                        })
                        .catch(error => {
                            console.error('Error fetching stock quantity:', error);
                        });
                }

                // Vô hiệu hóa nút tăng/giảm nếu đạt giới hạn
                function toggleQuantityButtons(stockQuantity) {
                    const currentQuantity = parseInt(quantityInput.value);

                    // Nếu số lượng đã đạt tối đa, vô hiệu hóa nút cộng
                    if (currentQuantity >= stockQuantity) {
                        increaseBtn.disabled = true;
                    } else {
                        increaseBtn.disabled = false;
                    }

                    // Nếu số lượng bằng 1, vô hiệu hóa nút trừ
                    if (currentQuantity <= 1) {
                        decreaseBtn.disabled = true;
                    } else {
                        decreaseBtn.disabled = false;
                    }
                }

                // Lắng nghe sự thay đổi trên các input màu sắc và kích thước
                const variantInputs = document.querySelectorAll('input[name="color"], input[name="size"]');
                variantInputs.forEach(input => {
                    input.addEventListener('change', function () {
                        const productId = this.dataset.productId;
                        const variantId = this.dataset.variantId;

                        // Cập nhật max quantity và stock quantity cho biến thể đã chọn
                        updateMaxQuantity(productId, variantId);
                    });
                });

                // Lắng nghe sự thay đổi của input số lượng
                quantityInput.addEventListener('input', function () {
                    // Nếu giá trị nhập vào vượt quá số lượng tồn kho, tự động chỉnh lại
                    if (parseInt(quantityInput.value) > parseInt(quantityInput.max)) {
                        quantityInput.value = quantityInput.max;
                    }

                    // Kiểm tra và vô hiệu hóa nút tăng/giảm
                    toggleQuantityButtons(parseInt(quantityInput.max));
                });

                // Lắng nghe sự kiện click vào nút tăng số lượng
                increaseBtn.addEventListener('click', function () {
                    let currentQuantity = parseInt(quantityInput.value);
                    if (currentQuantity < parseInt(quantityInput.max)) {
                        quantityInput.value = currentQuantity + 1;
                    }

                    // Kiểm tra và vô hiệu hóa nút tăng/giảm
                    toggleQuantityButtons(parseInt(quantityInput.max));
                });

                // Lắng nghe sự kiện click vào nút giảm số lượng
                decreaseBtn.addEventListener('click', function () {
                    let currentQuantity = parseInt(quantityInput.value);
                    if (currentQuantity > 1) {
                        quantityInput.value = currentQuantity - 1;
                    }

                    // Kiểm tra và vô hiệu hóa nút tăng/giảm
                    toggleQuantityButtons(parseInt(quantityInput.max));
                });
            });

            function updatePrice() {
                // Cập nhật lại giá dựa trên lựa chọn màu sắc và kích thước
                var price = {{ $product->price_sale }};
                // Nếu cần, thay đổi giá dựa trên lựa chọn (ví dụ, theo kích thước hoặc màu)
                // Cập nhật lại giá hiển thị
                document.getElementById('selected-price').value = price;
            }
        </script>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const colorRadios = document.querySelectorAll('input[name="color"]');
                const sizeRadios = document.querySelectorAll('input[name="size"]');
                const variantInput = document.getElementById('variant_id');
                const quantityInput = document.getElementById('quantity-input');
                const quantityHiddenInput = document.getElementById('quantity');
                const buyNowBtn = document.getElementById('buy-now-btn');
                const warningMessage = document.getElementById('quantity-warning');
                const favoriteBtn = document.getElementById('favorite-btn');

                // Xử lý chọn màu và size
                function updateVariant(radio) {
                    variantInput.value = radio.value;
                }

                colorRadios.forEach(radio => radio.addEventListener('change', () => updateVariant(radio)));
                sizeRadios.forEach(radio => radio.addEventListener('change', () => updateVariant(radio)));

                // Xử lý số lượng
                function handleQuantityInput() {
                    const maxQuantity = parseInt(quantityInput.getAttribute('max'));

                    quantityHiddenInput.value = quantityInput.value;

                    if (parseInt(quantityInput.value) > maxQuantity) {
                        quantityInput.value = maxQuantity;
                        warningMessage.style.display = 'block';
                    } else {
                        warningMessage.style.display = 'none';
                    }
                }

                quantityInput.addEventListener('input', handleQuantityInput);

                // Thiết lập mặc định
                if (colorRadios.length > 0 && !variantInput.value) {
                    variantInput.value = colorRadios[0].value;
                }

                if (sizeRadios.length > 0 && !variantInput.value) {
                    variantInput.value = sizeRadios[0].value;
                }

                if (!quantityHiddenInput.value) {
                    quantityHiddenInput.value = quantityInput.value;
                }

                // Xử lý mua ngay
                buyNowBtn.addEventListener('click', function(event) {
                    event.preventDefault();

                    const color = document.querySelector('input[name="color"]:checked');
                    const size = document.querySelector('input[name="size"]:checked');
                    const quantity = quantityInput.value;

                    if (!color || !size || !quantity) {
                        alert("Vui lòng chọn màu sắc, kích thước và số lượng.");
                        return;
                    }

                    const productImage = "{{ Storage::url($product->img_thumbnail) }}";
                    const productName = "{{ $product->name }}";
                    const productPrice = "{{ $product->price_sale }}";

                    console.log("Color:", color.value);
                    console.log("Size:", size.value);
                    console.log("Quantity:", quantity);
                    console.log("Product Image:", productImage);
                    console.log("Product Name:", productName);
                    console.log("Product Price:", productPrice);

                    const checkoutUrl =
                        `{{ route('checkout') }}?color=${encodeURIComponent(color.value)}&size=${encodeURIComponent(size.value)}&quantity=${encodeURIComponent(quantity)}&image=${encodeURIComponent(productImage)}&name=${encodeURIComponent(productName)}&price=${encodeURIComponent(productPrice)}`;

                    window.location.href = checkoutUrl;
                });


                // Xử lý yêu thích
                favoriteBtn.addEventListener('click', function() {
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
    @endsection
