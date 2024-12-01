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
                        <h2 class="page-title">Blog</h2>
                        <ul class="page-switcher d-flex ">
                            <li><a href="index.html">Home</a> <i class="flaticon-arrow-pointing-to-right"></i></li>
                            <li>Blog</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    
    
    <div>
        <div class="product-details-area mt-100 ml-110">
            <div class="d-flex justify-content-center align-items-center">
            <div class="product-details-wrapper text-center">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="blog-content">
                            <h1 class="text-center">{{ $blog->title }}</h1>
                            <p class="blog-text text-center mt-50">
                                {{ $blog->content }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        </div>  
                    <div class="col-xxl-9 col-xl-9">
                        <div class="tab-content discribtion-tab-content" id="v-pills-tabContent2">
                           
                            
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
  
@endsection
