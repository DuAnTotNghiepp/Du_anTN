@extends('client.layouts.app')

@section('content')
    div class="breadcrumb-area ml-110">
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



    <div class="product-details-area mt-100 ml-110">
        <div class="container">
            <div class="product-details-wrapper">
                <div class="row">
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-8">
                        <div class="product-switcher-wrap">
                            <div class="nav product-tab" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <div class="product-variation active" id="v-pills-home-tab" data-bs-toggle="pill"
                                     data-bs-target="#v-pills-home" role="tab" aria-controls="v-pills-home">
                                    <div class="pd-showcase-img">
                                        <img src="assets/images/product/pd-sm1.png" alt>
                                    </div>
                                </div>
                                <div class="product-variation" id="v-pills-profile-tab" data-bs-toggle="pill"
                                     data-bs-target="#v-pills-profile" role="tab" aria-controls="v-pills-profile">
                                    <div class="pd-showcase-img">
                                        <img src="assets/images/product/pd-sm2.png" alt>
                                    </div>
                                </div>
                                <div class="product-variation" id="v-pills-messages-tab" data-bs-toggle="pill"
                                     data-bs-target="#v-pills-messages" role="tab" aria-controls="v-pills-messages">
                                    <div class="pd-showcase-img">
                                        <img src="assets/images/product/pd-sm3.png" alt>
                                    </div>
                                </div>
                                <div class="product-variation" id="v-pills-settings-tab" data-bs-toggle="pill"
                                     data-bs-target="#v-pills-settings" role="tab" aria-controls="v-pills-settings">
                                    <div class="pd-showcase-img">
                                        <img src="assets/images/product/pd-sm4.png" alt>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                     aria-labelledby="v-pills-home-tab">
                                    <div class="pd-preview-img">
                                        <img src="{{ Storage::url($product->img_thumbnail) }}" alt class="img-fluid">
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                     aria-labelledby="v-pills-profile-tab">
                                    <div class="pd-preview-img">
                                        <img src="{{ Storage::url($product->img_thumbnail) }}" alt class="img-fluid">
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                     aria-labelledby="v-pills-messages-tab">
                                    <div class="pd-preview-img">
                                        <img src="{{ Storage::url($product->img_thumbnail) }}" alt class="img-fluid">
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                                     aria-labelledby="v-pills-settings-tab">
                                    <div class="pd-preview-img">
                                        <img src="{{ Storage::url($product->img_thumbnail) }}" alt class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xxl-6 col-xl-6 col-lg-6">
                        <div class="product-details-wrap">
                            <div class="pd-top">
                                <ul class="product-rating d-flex align-items-center">
                                    <li><i class="bi bi-star-fill"></i></li>
                                    <li><i class="bi bi-star-fill"></i></li>
                                    <li><i class="bi bi-star-fill"></i></li>
                                    <li><i class="bi bi-star-fill"></i></li>
                                    <li><i class="bi bi-star"></i></li>
                                    {{-- <li class="count-review">(<span>23</span> Review)</li> --}}
                                </ul>
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
                                                    <input type="radio" name="color" id="color{{ $variant->id }}" value="{{ $variant->id }}"
                                                           {{ $loop->first ? 'checked' : '' }} class="color-option-input">
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
                                                    <input type="radio" name="size" id="size{{ $variant->id }}" value="{{ $variant->id }}"
                                                           {{ $loop->first ? 'checked' : '' }} class="size-option-input">
                                                    <label for="size{{ $variant->id }}">
                                                        <span class="p-size">{{ $variant->value }}</span>
                                                    </label>
                                                @endif
                                            @endforeach
                                        </div>
                                    </li>

                                    <!-- Số lượng -->
                                    <li class="d-flex align-items-center pd-cart-btns">
                                        <div class="quantity">
                                            <input type="number" min="1" max="{{ $product->quantity }}" step="1" value="1" id="quantity-input"
                                                   data-available="{{ $product->quantity }}">
                                        </div>

                                        <button type="button" class="pd-add-cart" id="buy-now-btn">
                                            <a href="{{ route('checkout') }}" style="color:white">Mua Ngay</a>
                                        </button>

                                        <!-- Form Thêm vào Giỏ Hàng -->
                                        <form action="{{ route('cart.store') }}" method="POST" id="add-to-cart-form">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="variant_id" id="variant_id"> <!-- variant_id ẩn -->
                                            <input type="hidden" name="quantity" id="quantity"> <!-- quantity ẩn -->
                                            <button type="submit" class="pd-add-cart">Thêm vào giỏ hàng</button>
                                        </form>
                                    </li>
                                    <li id="quantity-warning" style="color: red; display: none;">
                                        Số lượng sản phẩm đã đạt tối đa!
                                    </li>
                                    <li class="pd-type">Danh mục sản phẩm: <span>{{ $product->catelogues->name }}</span>

                                    <li id="quantity-warning" style="color: red; display: none;">
                                        Số lượng sản phẩm đã đạt tối đa!
                                    </li>
                                    <li class="pd-type">Danh mục sản phẩm: <span>{{ $product->catelogues->name }}</span></li>
                                    <li class="pd-type">Mã sản phẩm: <span>{{ $product->sku }}</span></li>
                                    <li class="pd-type">Số lượng: <span>{{ $product->quantity }}</span></li>
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
                                    <p class="mt-4">Vui lòng <a href="#">đăng nhập</a> để gửi bình luận.</p>
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
            document.getElementById('buy-now-btn').addEventListener('click', function (event) {
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


document.getElementById('quantity-input').addEventListener('input', function() {
        const quantityInput = this;
        const maxQuantity = parseInt(quantityInput.getAttribute('max'));
        const warningMessage = document.getElementById('quantity-warning');




            document.addEventListener('DOMContentLoaded', function () {
                // Lấy các radio button cho màu sắc và kích thước
                const colorRadios = document.querySelectorAll('input[name="color"]');
                const sizeRadios = document.querySelectorAll('input[name="size"]');

                // Lấy trường input ẩn trong form
                const variantInput = document.getElementById('variant_id');
                const quantityInput = document.getElementById('quantity-input');
                const quantityHiddenInput = document.getElementById('quantity');

                // Lắng nghe sự thay đổi trên màu sắc
                colorRadios.forEach(function (radio) {
                    radio.addEventListener('change', function () {
                        // Cập nhật variant_id khi người dùng chọn màu
                        variantInput.value = this.value;
                    });
                });

                // Lắng nghe sự thay đổi trên kích thước
                sizeRadios.forEach(function (radio) {
                    radio.addEventListener('change', function () {
                        // Cập nhật variant_id khi người dùng chọn kích thước
                        variantInput.value = this.value;
                    });
                });

                // Lắng nghe sự thay đổi trên số lượng
                quantityInput.addEventListener('input', function () {
                    // Cập nhật số lượng trong input ẩn
                    quantityHiddenInput.value = this.value;
                });

                // Thiết lập mặc định cho variant_id và quantity khi load trang
                if (colorRadios.length > 0 && !variantInput.value) {
                    variantInput.value = colorRadios[0].value; // Mặc định chọn màu đầu tiên nếu chưa có giá trị
                }

                if (sizeRadios.length > 0 && !variantInput.value) {
                    variantInput.value = sizeRadios[0].value; // Mặc định chọn size đầu tiên nếu chưa có giá trị
                }

                // Đảm bảo quantity cũng có giá trị mặc định
                if (!quantityHiddenInput.value) {
                    quantityHiddenInput.value = quantityInput.value; // Mặc định số lượng
                }
            });



            document.getElementById('quantity-input').addEventListener('input', function() {
                const quantityInput = this;
                const maxQuantity = parseInt(quantityInput.getAttribute('max'));
                const warningMessage = document.getElementById('quantity-warning');

                if (parseInt(quantityInput.value) > maxQuantity) {
                    quantityInput.value = maxQuantity;
                    warningMessage.style.display = 'block';
                } else {
                    warningMessage.style.display = 'none';
                }
            });

        if (parseInt(quantityInput.value) > maxQuantity) {
            quantityInput.value = maxQuantity;
            warningMessage.style.display = 'block';
        } else {
            warningMessage.style.display = 'none';
        }
    });
    </script>
@endsection
