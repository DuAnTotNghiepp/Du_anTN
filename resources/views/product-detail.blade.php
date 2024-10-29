@extends('client.layouts.app')

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
                                    <img src="{{$product->img_thumbnail}}" alt>
                                </div>
                            </div>
                            <div class="product-variation" id="v-pills-profile-tab" data-bs-toggle="pill"
                                 data-bs-target="#v-pills-profile" role="tab" aria-controls="v-pills-profile">
                                <div class="pd-showcase-img">
                                    <img src="{{$product->img_thumbnail}}" alt>
                                </div>
                            </div>
                            <div class="product-variation" id="v-pills-messages-tab" data-bs-toggle="pill"
                                 data-bs-target="#v-pills-messages" role="tab" aria-controls="v-pills-messages">
                                <div class="pd-showcase-img">
                                    <img src="{{$product->img_thumbnail}}" alt>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                 aria-labelledby="v-pills-home-tab">
                                <div class="pd-preview-img">
                                    <img src="{{$product->img_thumbnail}}" alt>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6">
                    <div class="product-details-wrap">
                        <div class="pd-top">
                            <ul class="product-rating d-flex align-items-center">
                                @php
                                    // Tính điểm trung bình từ các bình luận
                                    $averageRating = $comments->avg('rating'); // Điểm trung bình
                                    $totalReviews = $comments->count(); // Tổng số bình luận
                                @endphp
                                @for ($i = 1; $i <= 5; $i++)
                                    <li><i class="bi bi-star{{ $i <= floor($averageRating) ? '-fill' : '' }}"></i></li>
                                @endfor
                                <li class="count-review">(<span>{{ $totalReviews }}</span> Review)</li>
                            </ul>
                            <h3 class="pd-title">{{$product->name}}</h3>
                            <h5 class="pd-price">{{$product->price_sale}}</h5>

                            <p class="pd-small-info">
                                {{$product->description}}
                            </p>
                        </div>
                        <div class="pd-quick-discription">
                            <ul>
                                <form action="#" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product->id}}">

                                    <li class="d-flex align-items-center">
                                        <span>Color :</span>
                                    </li>

                                    <li class="d-flex align-items-center">
                                        <span>Size :</span>
                                    </li>

                                    <li class="d-flex align-items-center pd-cart-btns">
                                        <div class="quantity">
                                            <label for="quantity"></label>
                                            <input id="quantity" name="quantity" type="number" min="1" max="100" value="1">
                                        </div>
                                        <button type="submit" class="pd-add-cart">Add to cart</button>
                                    </li>
                                </form>

                                <li class="pd-type">Product Type: <span>Woman Winter Dress</span></li>
                                <li class="pd-type">Categories: <span> {{$product->catelogues->name }}</span></li>
                                <li class="pd-type">Material : <span>{{$product->material}}</span></li>
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
                                aria-controls="pd-discription-pill2">Additional Information
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
                                <p>
                                    Dễ dàng phối với những trang phục và phù hợp với mọi cuộc picnic, đi biển hay hòa mình vào những lễ hội âm nhạc sôi động đậm chất mùa hè. Bấy nhiêu đây, áo khoác bohemian đã đủ chinh phục bạn chưa?
                                </p>
                                {{$product->content}}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pd-discription-pill2" role="tabpanel"
                             aria-labelledby="pd-discription2">
                            <div class="additional-discription">
                                <ul>
                                    <li>
                                        <h5 class="additition-name">Color</h5>
                                        <div class="additition-variant"><span>:</span>Red, Green, Blue, Yellow,
                                            Pink,
                                        </div>
                                    </li>
                                    <li>
                                        <h5 class="additition-name">Size</h5>
                                        <div class="additition-variant"><span>:</span>S, M, L, XL, XXL</div>
                                    </li>
                                    <li>
                                        <h5 class="additition-name">Material</h5>
                                        <div class="additition-variant"><span>:</span>100% Cotton, Jeans</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pd-discription-pill1" role="tabpanel" aria-labelledby="pd-discription1">
                            <div class="discription-review">
                                <h4 class="mb-4">Đánh giá của khách hàng</h4>
                                <div class="clients-review-cards">
                                    <div class="row" id="comments-list">
                                        @foreach($comments as $comment)
                                            <div class="col-lg-6 mb-3">
                                                <div class="card client-review-card">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center mb-3">
                                                            <div class="client-review-img me-3">
                                                                <img src="assets/images/blog/author.png" alt="Client Image" class="rounded-circle" width="50" height="50">
                                                            </div>
                                                            <div class="client-review-info">
                                                                <h5 class="client-name mb-1">{{ $comment->user->name }}</h5>
                                                                <ul class="product-rating d-flex align-items-center list-unstyled mb-0">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        <li class="me-1">
                                                                            <i class="bi bi-star{{ $i <= $comment->rating ? '-fill' : '' }}" style="color: gold;"></i>
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
                                <input type="hidden" name="product_id" value="{{ $product->id }}"> <!-- Thêm product_id -->
                                <div class="form-group">
                                    <label for="content">Nội dung bình luận:</label>
                                    <textarea id="content" name="noidung" class="form-control" required></textarea>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="rating">Đánh giá:</label>
                                    <div class="d-flex">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" name="rating" value="{{ $i }}" id="rating{{ $i }}" style="display: none;">
                                                <label class="form-check-label" for="rating{{ $i }}" style="cursor: pointer;">
                                                    <i class="bi bi-star-fill star" data-value="{{ $i }}" style="font-size: 24px; color: gray;"></i>
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
                                                                    <ul class="product-rating d-flex align-items-center list-unstyled mb-0">
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
                                            document.getElementById('response-message').innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                        document.getElementById('response-message').innerHTML = `<div class="alert alert-danger">Đã xảy ra lỗi, vui lòng thử lại.</div>`;
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

@endsection


{{--  <form action="{{ route('comment.store', $product->id) }}" method="POST" class="review-form mt-4">
    @csrf
    <div class="form-group">
        <label for="content">Nội dung bình luận:</label>
        <textarea id="content" name="noidung" class="form-control" required></textarea>
    </div>
    <div class="form-group">
        <label for="rating">Đánh giá:</label>
        <div class="d-flex">
            @for ($i = 1; $i <= 5; $i++)
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="rating" value="{{ $i }}" id="rating{{ $i }}">
                    <label class="form-check-label" for="rating{{ $i }}">{{ $i }} <i class="bi bi-star-fill"></i></label>
                </div>
            @endfor
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Gửi bình luận</button>  --}}