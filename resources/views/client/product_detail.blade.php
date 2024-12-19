@extends('client.layouts.app')

@section('content')
    <style>
        .color-radio {
            display: none;
            /* Ẩn radio button mặc định */
        }

        .color-radio+label {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 1px solid #ccc;
            border-radius: 50%;
            margin: 5px;
            cursor: pointer;
        }

        .color-radio:checked+label {
            border: 5px solid #000;
            /* Đổi viền khi được chọn */
        }

        .size-radio {
            display: none;
            /* Ẩn radio button mặc định */
        }

        .size-radio+label {
            display: inline-block;
            padding: 5px 10px;
            border: 1px solid #ccc;
            margin: 5px;
            cursor: pointer;
        }

        .size-radio:checked+label {
            background-color: #000;
            color: #fff;
            /* Đổi màu nền và chữ khi được chọn */
        }
    </style>
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
            -moz-appearance: textfield;
            /* Firefox */
            appearance: none;
            /* Cho trình duyệt hiện đại */
        }

        /* Đảm bảo input không hiển thị dấu cộng và trừ */
        .quantity1 input {
            -webkit-appearance: none;
            -moz-appearance: textfield;
            appearance: none;
        }

        /* Phong cách chung cho alert */
        .alert {
            padding: 15px 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 500;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Thành công */
        .custom-alert-success {
            background-color: #e6f7e9;
            border: 1px solid #28a745;
            color: #155724;
        }

        .custom-alert-success i {
            color: #28a745;
            margin-right: 10px;
            font-size: 20px;
        }

        /* Lỗi */
        .custom-alert-error {
            background-color: #fcebea;
            border: 1px solid #dc3545;
            color: #721c24;
        }

        .custom-alert-error i {
            color: #dc3545;
            margin-right: 10px;
            font-size: 20px;
        }

        /* Lỗi từ validation */
        .custom-alert-validation {
            background-color: #fff3cd;
            border: 1px solid #ffcc00;
            color: #856404;
        }

        .custom-alert-validation i {
            color: #ffcc00;
            margin-right: 10px;
            font-size: 20px;
        }

        /* Kiểu danh sách lỗi */
        .custom-alert-validation ul {
            margin: 0;
            padding-left: 20px;
        }

        .custom-alert-validation li {
            list-style: disc;
        }

        .custom-alert-validation ul {
            margin: 0;
            padding-left: 20px;
            color: #721c24;
            font-size: 16px;
        }

        .custom-alert-validation li {
            list-style: disc;
        }
    </style>


    <div class="product-details-area mt-100 ml-110">
        <div class="container">
            <div class="product-details-wrapper">
                <div class="row">

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
                                        <img id="main-product-image" src="{{ Storage::url($product->img_thumbnail) }}"  alt="Main Product Image" class="img-fluid">
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
                                <p><strong>Giá cũ:</strong> <span class="price-regular">{{ $product->price_regular }}</span>
                                </p>
                                <p><strong>Giá khuyến mãi:</strong> <span
                                        class="price-sale">{{ $product->price_sale }}</span></p>

                            </div>

                            <div class="pd-quick-discription">
                                <ul>
                                    @if (session('success'))
                                        <div class="alert alert-success custom-alert-success">
                                            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                                        </div>
                                    @endif

                                    @if (session('error'))
                                        <div class="alert alert-danger custom-alert-error">
                                            <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
                                        </div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger custom-alert-validation">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <li class="d-flex align-items-center">
                                        <span>Color :</span>
                                        <div class="color-option d-flex align-items-center">
                                            @foreach ($colors as $color)
                                                <div class="color-item" data-color="{{ $color }}">
                                                    <div class="color-options">
                                                        <input type="radio" id="color-{{ $color }}"
                                                            name="color" value="{{ $color }}"
                                                            data-color="{{ $color }}"
                                                            class="color-radio color-option-input">
                                                        <label for="color-{{ $color }}"
                                                            style="background-color: {{ $color }}; width: 20px; height: 20px; display: inline-block; cursor: pointer;"></label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <span>Size :</span>
                                        <div class="size-option d-flex align-items-center">
                                            @foreach ($sizes as $size)
                                                <div class="size-item" data-size="{{ $size }}">
                                                    <div class="size-options">
                                                        <input type="radio" id="size-{{ $size }}"
                                                            name="size" value="{{ $size }}"
                                                            data-size="{{ $size }}"
                                                            class="size-radio size-option-input">
                                                        <label for="size-{{ $size }}"
                                                            style="cursor: pointer;">{{ $size }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </li>
                                    <!-- Số lượng -->
                                    <li class="d-flex align-items-center pd-cart-btns">
                                        <div class="quantity1">
                                            <button type="button" id="decrease-btn">-</button>
                                            <input name="quantity" type="number" min="1"
                                                max="{{ $productVariant->stock }}" step="1" value="1"
                                                id="quantity-input">
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
                                    </li>
                                    <li class="pd-type">Danh mục sản phẩm: <span>{{ $product->catelogues->name }}</span>
                                    </li>
                                    <li class="pd-type">Mã sản phẩm: <span>{{ $product->sku }}</span></li>
                                    <!-- Số lượng tồn kho -->
                                    <li class="pd-type">Số lượng tồn kho:<span id="selected-quantity">Số lượng</span>

                                    </li>
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
        <script>
            // Khai báo các biến cần thiết
            const colors = @json($colors);
            const sizes = @json($sizes);
            const variantQuantities = @json($variantQuantities);
            let selectedColor = null;
            let selectedSize = null;

            document.querySelectorAll('.color-radio').forEach(item => {
                item.addEventListener('change', function() {
                    selectedColor = this.value;
                    updateStockAndQuantity();
                });
            });

            document.querySelectorAll('.size-radio').forEach(item => {
                item.addEventListener('change', function() {
                    selectedSize = this.value;
                    updateStockAndQuantity();
                });
            });

            function updateStockAndQuantity() {
                const quantityInput = document.getElementById('quantity-input');
                const stockDisplay = document.getElementById('selected-quantity');

                if (selectedColor && selectedSize) {
                    const key = `${selectedColor}-${selectedSize}`;
                    const stock = variantQuantities[key] || 0;

                    // Cập nhật giá trị tối đa cho input số lượng
                    quantityInput.max = stock;

                    // Hiển thị số lượng tồn kho
                    if (stock > 0) {
                        stockDisplay.innerText = `Còn ${stock} sản phẩm`;
                    } else {
                        stockDisplay.innerText = 'Sản phẩm không có sẵn';
                    }

                    // Nếu số lượng hiện tại vượt quá tồn kho, đặt lại số lượng về tồn kho tối đa
                    if (parseInt(quantityInput.value) > stock) {
                        quantityInput.value = stock;
                    }
                } else {
                    // Nếu chưa chọn đủ màu và size, đặt tồn kho về mặc định
                    stockDisplay.innerText = 'Chọn màu và kích thước để xem số lượng';
                    quantityInput.max = 0;
                    quantityInput.value = 1;
                }
            }
            // Giả sử bạn có các dropdown hoặc lựa chọn màu sắc và kích thước
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
            document.addEventListener('DOMContentLoaded', function() {
                const quantityInput = document.getElementById('quantity-input');
                const hiddenQuantity = document.getElementById('quantity');
                const decreaseBtn = document.getElementById('decrease-btn');
                const increaseBtn = document.getElementById('increase-btn');

                // Đồng bộ giá trị khi số lượng thay đổi
                quantityInput.addEventListener('input', function() {
                    hiddenQuantity.value = quantityInput.value;
                });

                // Giảm số lượng
                decreaseBtn.addEventListener('click', function() {
                    let currentValue = parseInt(quantityInput.value);
                    if (currentValue > parseInt(quantityInput.min)) {
                        quantityInput.value = currentValue - 0;
                        hiddenQuantity.value = quantityInput.value; // Cập nhật ô hidden
                    }
                });

                // Tăng số lượng
                increaseBtn.addEventListener('click', function() {
                    let currentValue = parseInt(quantityInput.value);
                    if (currentValue < parseInt(quantityInput.max)) {
                        quantityInput.value = currentValue + 0;
                        hiddenQuantity.value = quantityInput.value; // Cập nhật ô hidden
                    }
                });

                // Đồng bộ giá trị trước khi form được gửi
                const addToCartForm = document.getElementById('add-to-cart-form');
                addToCartForm.addEventListener('submit', function() {
                    hiddenQuantity.value = quantityInput.value;
                });
            });
        </script>
        <script>
            document.getElementById('decrease-btn').addEventListener('click', function() {
                const quantityInput = document.getElementById('quantity-input');
                const currentQuantity = parseInt(quantityInput.value) || 1;

                if (currentQuantity > 1) {
                    quantityInput.value = currentQuantity - 1;
                }
            });

            document.getElementById('increase-btn').addEventListener('click', function() {
                const quantityInput = document.getElementById('quantity-input');
                const currentQuantity = parseInt(quantityInput.value) || 1;
                const maxQuantity = parseInt(quantityInput.max) || 0;

                if (currentQuantity < maxQuantity) {
                    quantityInput.value = currentQuantity + 1;
                }
            });

            // Đảm bảo giá trị nhập tay không vượt quá max
            document.getElementById('quantity-input').addEventListener('input', function() {
                const maxQuantity = parseInt(this.max) || 0;

                if (parseInt(this.value) > maxQuantity) {
                    this.value = maxQuantity;
                }

                if (parseInt(this.value) < 1) {
                    this.value = 1;
                }
            });
            document.getElementById('add-to-cart-form').addEventListener('submit', function(event) {
                const quantityInput = document.getElementById('quantity-input');
                const maxQuantity = parseInt(quantityInput.max) || 0;

                if (parseInt(quantityInput.value) > maxQuantity) {
                    alert('Số lượng vượt quá tồn kho!');
                    event.preventDefault(); // Ngăn form gửi đi
                }
            });
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
