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
                                        <img
                                                src="{{ Storage::url($product->img_thumbnail) }}"  alt
                                                class="img-fluid">
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                     aria-labelledby="v-pills-profile-tab">
                                    <div class="pd-preview-img">
                                        <img
                                                src="{{ Storage::url($product->img_thumbnail) }}"  alt
                                                class="img-fluid">
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                     aria-labelledby="v-pills-messages-tab">
                                    <div class="pd-preview-img">
                                        <img
                                                src="{{ Storage::url($product->img_thumbnail) }}"  alt
                                                class="img-fluid">
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                                     aria-labelledby="v-pills-settings-tab">
                                    <div class="pd-preview-img">
                                         <img
                                                src="{{ Storage::url($product->img_thumbnail) }}"  alt
                                                class="img-fluid">
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
                                <p><strong>Giá cũ:</strong> <span class="price-regular">{{ $product->price_regular }}</span></p>
                                <p><strong>Giá khuyến mãi:</strong> <span class="price-sale">{{ $product->price_sale }}</span></p>

                            </div>

                            <div class="pd-quick-discription">
                                <ul>
                                    <li class="d-flex align-items-center">
                                        <span>Color :</span>
                                        <div class="color-option d-flex align-items-center">
                                            @foreach ($product->variants as $variant)
                                                @if ($variant->name === 'Color') <!-- Giả sử bạn có biến thể màu sắc -->
                                                    <input type="radio" name="color" id="color{{ $variant->id }}" value="{{ $variant->value }}" {{ $loop->first ? 'checked' : '' }}>
                                                    <label for="color{{ $variant->id }}"><span class="p-color" style="background-color: {{ $variant->value }}"></span></label>
                                                @endif
                                            @endforeach
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <span>Size :</span>
                                        <div class="size-option d-flex align-items-center">
                                            @foreach ($product->variants as $variant)
                                                @if ($variant->name === 'Size') <!-- Giả sử bạn có biến thể kích thước -->
                                                    <input type="radio" name="size" id="size{{ $variant->id }}" value="{{ $variant->value }}" {{ $loop->first ? 'checked' : '' }}>
                                                    <label for="size{{ $variant->id }}">
                                                        <span class="p-size">{{ $variant->value }}</span>
                                                    </label>
                                                @endif
                                            @endforeach
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-center pd-cart-btns">
                                        <div class="quantity">
                                            <input type="number" min="1" max="90" step="1" value="1">
                                        </div>
                                        <button type="submit" class="pd-add-cart"><a href="cart" style="color:white">Add to cart</a></button>
                                    </li>
                                    <li class="pd-type">Danh mục sản phẩm: <span>{{ $product->catelogues->name }}</span></li>
                                    <li class="pd-type">Mã sản phẩm: <span>{{ $product->sku }}</span></li>
                                    <li class="pd-type">Số lượng: <span>{{ $product->quantity }}</span></li>
                                    {{-- <li class="pd-type">Categories: <span>{{ $product->quantity }}</span></li> --}}
                                    {{-- <li class="pd-type">Available: <span>{{ $product->available }}</span></li> --}}
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
                                            {{-- <h5 class="additition-name">Material</h5>
                                            <div class="additition-variant"><span>:</span>100% Cotton, Jens</div> --}}
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
                                                        <textarea name="review-area" id="review-area" cols="30" rows="7"
                                                                  placeholder="Your message"></textarea>
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

@endsection
