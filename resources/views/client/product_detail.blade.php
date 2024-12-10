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
                                    <li><i class="bi bi-star-fill"></i></li>
                                    <li><i class="bi bi-star-fill"></i></li>
                                    <li><i class="bi bi-star-fill"></i></li>
                                    <li><i class="bi bi-star-fill"></i></li>
                                    <li><i class="bi bi-star"></i></li>
                                </ul>
                                <h1>{{ $product->name }}</h1>
                                <p><strong>Giá cũ:</strong> <span class="price-regular">{{ $product->price_regular }}</span>
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
                                                        value="{{ $variant->value }}" {{ $loop->first ? 'checked' : '' }}>
                                                    <label for="color{{ $variant->id }}"><span class="p-color"
                                                            style="background-color: {{ $variant->value }}"></span></label>
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
                                                        value="{{ $variant->value }}" {{ $loop->first ? 'checked' : '' }}>
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
                                            <input type="number" min="1" max="{{ $product->quantity }}"
                                                step="1" value="1" id="quantity-input"
                                                data-available="{{ $product->quantity }}">
                                        </div>
                                        <button type="button" class="pd-add-cart" id="buy-now-btn">
                                            <a href="{{ route('checkout') }}" style="color:white">Mua Ngay</a>
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
                                    <li class="pd-type">Danh mục sản phẩm: <span>{{ $product->catelogues->name }}</span>
                                    </li>
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
                            <div class="tab-pane fade " id="pd-discription-pill1" role="tabpanel"
                                aria-labelledby="pd-discription1">
                                <div class="discription-review">
                                    <div class="clients-review-cards">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="client-review-card">
                                                    <div class="review-card-head">
                                                        <div class="client-img">
                                                            <img src="assets/images/shapes/reviewer1.png" alt>
                                                        </div>
                                                        <div class="client-info">
                                                            <h5 class="client-name">Jenny Wilson <span
                                                                    class="review-date">- 8th Jan 2021</span></h5>
                                                            <ul class="review-rating d-flex">
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <p class="review-text">
                                                        Aenean dolor massa, rhoncus ut tortor in, pretium tempus neque.
                                                        Vestibulum venenatis leo et dictum finibus. Nulla vulputate
                                                        dolor sit amet tristique dapibus.
                                                    </p>
                                                    <ul class="review-actions d-flex align-items-center">
                                                        <li><a href="#"><i class="flaticon-like"></i></a></li>
                                                        <li><a href="#"><i class="flaticon-heart"></i></a></li>
                                                        <li><a href="#">Reply</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="client-review-card">
                                                    <div class="review-card-head">
                                                        <div class="client-img">
                                                            <img src="assets/images/shapes/reviewer2.png" alt>
                                                        </div>
                                                        <div class="client-info">
                                                            <h5 class="client-name">Jenny Wilson <span
                                                                    class="review-date">- 8th Jan 2021</span></h5>
                                                            <ul class="review-rating d-flex">
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <p class="review-text">
                                                        Aenean dolor massa, rhoncus ut tortor in, pretium tempus neque.
                                                        Vestibulum venenatis leo et dictum finibus. Nulla vulputate
                                                        dolor sit amet tristique dapibus.
                                                    </p>
                                                    <ul class="review-actions d-flex align-items-center">
                                                        <li><a href="#"><i class="flaticon-like"></i></a></li>
                                                        <li><a href="#"><i class="flaticon-heart"></i></a></li>
                                                        <li><a href="#">Reply</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="review-form-wrap">
                                        <h5>Write a Review</h5>
                                        <h3>Leave A Comment</h3>
                                        <p>Your email address will not be published. Required fields are marked *</p>
                                        <form action="#" method="POST" class="review-form">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="review-input-group">
                                                        <label for="fname">First Name</label>
                                                        <input type="text" name="fname" id="fname"
                                                            placeholder="Your first name">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="review-input-group">
                                                        <label for="lname">Last Name</label>
                                                        <input type="text" name="lname" id="lname"
                                                            placeholder="Your last name ">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="review-input-group">
                                                        <textarea name="review-area" id="review-area" cols="30" rows="7" placeholder="Your message"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="review-rating">
                                                        <p>Your Rating</p>
                                                        <ul class="d-flex">
                                                            <li><i class="bi bi-star-fill"></i></li>
                                                            <li><i class="bi bi-star-fill"></i></li>
                                                            <li><i class="bi bi-star-fill"></i></li>
                                                            <li><i class="bi bi-star-fill"></i></li>
                                                            <li><i class="bi bi-star-fill"></i></li>
                                                        </ul>
                                                    </div>
                                                    <div class="submit-btn">
                                                        <input type="submit" value="Post Comment">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
