@extends('client.layouts.app')

@section('content')
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
                                <li>Products</li>
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
                <div class="col-xxl-3 col-xl-4 col-lg-4">
                    <div class="product-sidebar">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="sidebar-searchbar-wrap">
                                    <form action="{{ route('product.search') }}" method="POST" class="sidebar-searchbar-form">
                                        @csrf <!-- Đảm bảo bảo mật -->
                                        <input type="text" name="sidebar-search-input" id="sidebar-search-input" placeholder="What are you looking for?">
                                        <button type="submit"><i class="bi bi-search"></i></button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="sidebar-category">
                                    <h5 class="sb-title">SHOP BY CATAGORY</h5>
                                    <div class="sb-category-dropdown">
                                        <div class="accordion" id="accordionExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                        aria-expanded="true" aria-controls="collapseOne">
                                                        Woman Collection
                                                    </button>
                                                </h2>
                                                <div id="collapseOne" class="accordion-collapse collapse show"
                                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <ul class="sb-category-list">
                                                            <li><a href="product.html">Man Casual Silk Shirt</a> <span
                                                                    class="product-amount">(10)</span></li>
                                                            <li><a href="product.html">Man Orange Shorts</a> <span
                                                                    class="product-amount">(22)</span></li>
                                                            <li><a href="product.html">Party Dress</a> <span
                                                                    class="product-amount">(08)</span></li>
                                                            <li><a href="#">T-Shirt</a> <span
                                                                    class="product-amount">(41)</span></li>
                                                            <li><a href="product.html">Ghost Mannequin Black Hoodie</a>
                                                                <span class="product-amount">(15)</span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                        aria-expanded="false" aria-controls="collapseTwo">
                                                        Kid’s Collection
                                                    </button>
                                                </h2>
                                                <div id="collapseTwo" class="accordion-collapse collapse"
                                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <ul class="sb-category-list">
                                                            <li><a href="#">Man Casual Silk Shirt</a> <span
                                                                    class="product-amount">(10)</span></li>
                                                            <li><a href="#">Man Orange Shorts</a> <span
                                                                    class="product-amount">(22)</span></li>
                                                            <li><a href="#">Party Dress</a> <span
                                                                    class="product-amount">(08)</span></li>
                                                            <li><a href="#">T-Shirt</a> <span
                                                                    class="product-amount">(41)</span></li>
                                                            <li><a href="#">Ghost Mannequin Black Hoodie</a> <span
                                                                    class="product-amount">(15)</span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingThree">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                        aria-expanded="false" aria-controls="collapseThree">
                                                        Man Collection
                                                    </button>
                                                </h2>
                                                <div id="collapseThree" class="accordion-collapse collapse"
                                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <ul class="sb-category-list">
                                                            <li><a href="#">Man Casual Silk Shirt</a> <span
                                                                    class="product-amount">(10)</span></li>
                                                            <li><a href="#">Man Orange Shorts</a> <span
                                                                    class="product-amount">(22)</span></li>
                                                            <li><a href="#">Party Dress</a> <span
                                                                    class="product-amount">(08)</span></li>
                                                            <li><a href="#">T-Shirt</a> <span
                                                                    class="product-amount">(41)</span></li>
                                                            <li><a href="#">Ghost Mannequin Black Hoodie</a> <span
                                                                    class="product-amount">(15)</span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingFour">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                        aria-expanded="false" aria-controls="collapseFour">
                                                        Health & Beauty
                                                    </button>
                                                </h2>
                                                <div id="collapseFour" class="accordion-collapse collapse"
                                                    aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <ul class="sb-category-list">
                                                            <li><a href="#">Man Casual Silk Shirt</a> <span
                                                                    class="product-amount">(10)</span></li>
                                                            <li><a href="#">Man Orange Shorts</a> <span
                                                                    class="product-amount">(22)</span></li>
                                                            <li><a href="#">Party Dress</a> <span
                                                                    class="product-amount">(08)</span></li>
                                                            <li><a href="#">T-Shirt</a> <span
                                                                    class="product-amount">(41)</span></li>
                                                            <li><a href="#">Ghost Mannequin Black Hoodie</a> <span
                                                                    class="product-amount">(15)</span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingFive">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                                        aria-expanded="false" aria-controls="collapseFive">
                                                        Jewellery & Daimond
                                                    </button>
                                                </h2>
                                                <div id="collapseFive" class="accordion-collapse collapse"
                                                    aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <ul class="sb-category-list">
                                                            <li><a href="#">Man Casual Silk Shirt</a> <span
                                                                    class="product-amount">(10)</span></li>
                                                            <li><a href="#">Man Orange Shorts</a> <span
                                                                    class="product-amount">(22)</span></li>
                                                            <li><a href="#">Party Dress</a> <span
                                                                    class="product-amount">(08)</span></li>
                                                            <li><a href="#">T-Shirt</a> <span
                                                                    class="product-amount">(41)</span></li>
                                                            <li><a href="#">Ghost Mannequin Black Hoodie</a> <span
                                                                    class="product-amount">(15)</span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--  loc theo gia  --}}
                          
                            <div class="col-lg-12">
                                <div class="sb-pricing-range">
                                    <h5 class="sb-title">LỌC THEO GIÁ VÀ TÊN</h5>
                                    <form action="{{ route('product.search') }}" method="POST">
                                        @csrf
                                        <div class="price-range-slider">
                                            <div id="price_range_slider"></div>
                                            
                                            <div class="pricing-range-buttom d-flex align-items-center justify-content-between">
                                               
                                                <div class="price-filter-btn">
                                                    <button type="submit">Filter</button>
                                                </div>
                                                
                                                <div class="pricing-value">
                                                    <span>Price: </span>
                                                    <span id="price_range_value">$0 - $1000000</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Lưu trữ giá trị min và max -->
                                        <input type="hidden" name="price_min" id="price_min" value="0">
                                        <input type="hidden" name="price_max" id="price_max" value="1000000">
                                        <!-- Nếu có tìm kiếm theo tên -->
                                        <input type="text" name="sidebar-search-input" placeholder="Tìm kiếm tên">
                                    </form>
                                </div>
                            </div>
                            
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    var slider = document.getElementById('price_range_slider');
                                    var priceRangeValue = document.getElementById('price_range_value');
                                    var priceMin = document.getElementById('price_min');
                                    var priceMax = document.getElementById('price_max');
                                
                                    noUiSlider.create(slider, {
                                        start: [0, 0], 
                                        connect: true,  // Kết nối giữa 2 tay cầm
                                        range: {
                                            'min': 0,   
                                            'max': 1000000 
                                        },
                                        step: 1000, // Bước nhảy
                                        format: {
                                            to: function (value) {
                                                return '$' + value.toFixed(0); // Hiển thị giá trị dưới dạng tiền tệ
                                            },
                                            from: function (value) {
                                                return value.replace('$', ''); // Chuyển giá trị thành số
                                            }
                                        }
                                    });
                                
                                    slider.noUiSlider.on('update', function(values, handle) {
                                        priceRangeValue.textContent = values.join(' - '); 
                                
                                        priceMin.value = values[0].replace('$', '');
                                        priceMax.value = values[1].replace('$', '');
                                    });
                                });
                            </script>
                            
                            
                            
                            
                            
                            <div class="col-lg-12">
                                <div class="top-sell-cards">
                                    <h5 class="sb-title">TOP SALE THIS WEEK</h5>
                                    <div class="row">
                                        <div class="co-lg-12">
                                            <div class="product-card-m d-flex align-content-center">
                                                <div class="product-img-m">
                                                    <a href="product-details.html"><img
                                                            src="assets/images/product/pm1.png" alt></a>
                                                    <div class="product-cart-icon"><a href="#"><i
                                                                class="flaticon-shopping-cart"></i></a></div>
                                                </div>
                                                <div class="product-details-m">
                                                    <a class="product-title-m" href="product-details.html">Men Casual
                                                        Summer Sale</a>
                                                    <ul class="d-flex product-rating-m">
                                                        <li><i class="bi bi-star-fill"></i></li>
                                                        <li><i class="bi bi-star-fill"></i></li>
                                                        <li><i class="bi bi-star-fill"></i></li>
                                                        <li><i class="bi bi-star-fill"></i></li>
                                                        <li><i class="bi bi-star"></i></li>
                                                    </ul>
                                                    <div class="product-price">
                                                        <del class="old-price">$302.74</del><ins
                                                            class="new-price">$290.05</ins>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="product-card-m d-flex align-items-center">
                                                <div class="product-img-m">
                                                    <a href="product-details.html"><img
                                                            src="assets/images/product/pm-4.png" alt></a>
                                                    <div class="product-cart-icon"><a href="#"><i
                                                                class="flaticon-shopping-cart"></i></a></div>
                                                </div>
                                                <div class="product-details-m">
                                                    <a class="product-title-m" href="product-details.html">Men Casual
                                                        Summer Sale</a>
                                                    <ul class="d-flex product-rating-m">
                                                        <li><i class="bi bi-star-fill"></i></li>
                                                        <li><i class="bi bi-star-fill"></i></li>
                                                        <li><i class="bi bi-star-fill"></i></li>
                                                        <li><i class="bi bi-star-fill"></i></li>
                                                        <li><i class="bi bi-star"></i></li>
                                                    </ul>
                                                    <div class="product-price">
                                                        <del class="old-price">$302.74</del><ins
                                                            class="new-price">$290.05</ins>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="product-card-m d-flex align-items-center">
                                                <div class="product-img-m">
                                                    <a href="product-details.html"><img
                                                            src="assets/images/product/pm-5.png" alt></a>
                                                    <div class="product-cart-icon"><a href="#"><i
                                                                class="flaticon-shopping-cart"></i></a></div>
                                                </div>
                                                <div class="product-details-m">
                                                    <a class="product-title-m" href="product-details.html">Men Casual
                                                        Summer Sale</a>
                                                    <ul class="d-flex product-rating-m">
                                                        <li><i class="bi bi-star-fill"></i></li>
                                                        <li><i class="bi bi-star-fill"></i></li>
                                                        <li><i class="bi bi-star-fill"></i></li>
                                                        <li><i class="bi bi-star-fill"></i></li>
                                                        <li><i class="bi bi-star"></i></li>
                                                    </ul>
                                                    <div class="product-price">
                                                        <del class="old-price">$302.74</del><ins
                                                            class="new-price">$290.05</ins>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="product-card-m d-flex align-items-center">
                                                <div class="product-img-m">
                                                    <a href="product-details.html"><img
                                                            src="assets/images/product/pm-6.png" alt></a>
                                                    <div class="product-cart-icon"><a href="#"><i
                                                                class="flaticon-shopping-cart"></i></a></div>
                                                </div>
                                                <div class="product-details-m">
                                                    <a class="product-title-m" href="product-details.html">Men Casual
                                                        Summer Sale</a>
                                                    <ul class="d-flex product-rating-m">
                                                        <li><i class="bi bi-star-fill"></i></li>
                                                        <li><i class="bi bi-star-fill"></i></li>
                                                        <li><i class="bi bi-star-fill"></i></li>
                                                        <li><i class="bi bi-star-fill"></i></li>
                                                        <li><i class="bi bi-star"></i></li>
                                                    </ul>
                                                    <div class="product-price">
                                                        <del class="old-price">$302.74</del><ins
                                                            class="new-price">$290.05</ins>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="sb-tags">
                                    <h5 class="sb-title">PRODUCT TAG</h5>
                                    <ul class="sb-tag-list">
                                        <li><a href="#">Casual</a></li>
                                        <li><a href="#">Kurtas & Kurtis</a></li>
                                        <li><a href="#">Summer</a></li>
                                        <li><a href="#">Spring</a></li>
                                        <li><a href="#">Winter</a></li>
                                        <li><a href="#">Baby</a></li>
                                        <li><a href="#">Man</a></li>
                                        <li><a href="#">Coot</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-sidebar-banner">
                        <a href="#"><img src="assets/images/banner/sb-banner1.png" alt></a>
                    </div>
                </div>
                <div class="col-xxl-9 col-xl-8 col-lg-8">
                    <div class="product-sorting d-flex justify-content-between align-items-center">
                        <div class="show-text"><span>Showing 1-9 of 18 Result</span></div>
                        <div class="category-sort">
                            <form action="{{ route('product.search') }}" method="POST">
                                @csrf
                                <select name="category-sort" id="category-sort" onchange="this.form.submit()">
                                    <option value="default" selected>Sắp xếp theo</option>
                                    <option value="price_asc">Sắp xếp theo giá thấp đến cao</option>
                                    <option value="price_desc">Sắp xếp theo giá cao đến thấp</option>
                                </select>
                                <!-- Hidden inputs for price filters -->
                                <input type="hidden" name="price_min" id="price_min" value="{{ request('price_min', 0) }}">
                                <input type="hidden" name="price_max" id="price_max" value="{{ request('price_max', 10000000000) }}">
                            </form>
                        </div>
                    </div>
                    
                    <div class="row">
                        
                        
                    @foreach ($products as $lsp)
                    <div class="col-xxl-3 col-xl-4 col-lg-4 col-sm-4">
                        <div class="product-card-l">
                            <div class="product-img">
                                {{--  <a href="product-details.html">
                                    <img src="assets/images/product/p-dbl1.png" alt>
                                    <img src="assets/images/product/p-dbl2.png" alt class="hover-img">
                                </a>  --}}
                                <a href="{{route('product.product_detail',$lsp->id)}}"><img
                                    src="{{ Storage::url($lsp->img_thumbnail) }} "  alt
                                    class="img-fluid" style="max-height: 200px;"></a>
                                <div class="product-lavels">
                                </div>
                                <div class="product-actions">
                                    <a href="#"><i class="flaticon-heart"></i></a>
                                    <a href="{{route('product.product_detail',$lsp->id)}}"><i class="flaticon-search"></i></a>
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
                                <h3 class="product-title"><a href="product-details.html">{{ $lsp->name }}</a></h3>
                                <div class="product-price">
                                    <del class="old-price">{{ $lsp->price_sale}}</del><ins class="new-price">{{ $lsp->price_regular}}</ins>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                   
                    
                       
                        <div class="col-lg-12 mt-50">
                            <div class="custom-pagination d-flex justify-content-center">
                                <ul class="d-flex pagination-links">
                                    <li><a href="#" class="has-arrow"><i
                                                class="flaticon-arrow-pointing-to-left"></i></a></li>
                                    <li><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#" class="has-arrow"><i
                                                class="flaticon-arrow-pointing-to-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
