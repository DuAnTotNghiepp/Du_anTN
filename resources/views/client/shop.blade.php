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
                            <ul class="page-switcher d-flex">
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

                            {{-- Lọc theo giá --}}
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
                                        start: [0, 1000000],
                                        connect: true,  
                                        range: {
                                            'min': 0,
                                            'max': 1000000
                                        },
                                        step: 1000, 
                                        format: {
                                            to: function (value) {
                                                return '$' + value.toFixed(0); 
                                            },
                                            from: function (value) {
                                                return value.replace('$', '');
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

                            {{-- TOP SALE PRODUCTS --}}
                            <div class="col-lg-12">
                                <div class="top-sell-cards">
                                    <h5 class="sb-title">Những sản phẩm bán chạy</h5>
                                    <div class="row" id="top-sale-products">
                                        <!-- Sản phẩm sẽ được thêm vào đây thông qua JS hoặc API -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-9 col-xl-8 col-lg-8">
                    <div class="product-sorting d-flex justify-content-between align-items-center">
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
                        <!-- Hiển thị danh sách sản phẩm -->

                        @foreach ($products as $lsp)
                            <div class="col-xxl-3 col-xl-4 col-lg-4 col-sm-4 mb-4">
                                <div class="product-card-l">
                                    <div class="product-img">
                                        <a href="{{ route('product.product_detail', $lsp->id) }}">
                                            <img src="{{ Storage::url($lsp->img_thumbnail) }}" alt class="img-fluid" style="max-height: 200px;">
                                        </a>
                                        <div class="product-actions">
                                            <a href="{{ route('product.product_detail', $lsp->id) }}"><i class="flaticon-search"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-body">
                                       
                                        <h3 class="product-title">
                                            <a href="{{ route('product.product_detail', $lsp->id) }}">{{ $lsp->name }}</a>
                                        </h3>
                                        <div class="product-price">
                                            <del class="old-price">${{ $lsp->price_regular }}</del>
                                            <ins class="new-price">${{ $lsp->price_sale }}</ins>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    {{--  
                    <div class="col-lg-12 mt-50">
                        <div class="custom-pagination d-flex justify-content-center">
                            {{ $products->links() }}
                        </div>
                    </div>
                      --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/api/top-sales')
                .then(response => response.json())
                .then(data => {
                    const topSaleProductsContainer = document.getElementById('top-sale-products');
                    topSaleProductsContainer.innerHTML = ''; // Clear previous content
                    data.forEach(product => {
                        topSaleProductsContainer.innerHTML += `
                            <div class="">
                                <div class="product-card-l">
                                    <div class="product-img">
                                        <a href="{{ route('product.product_detail', '') }}/${product.product_id}">
                                            <img src="{{ Storage::url('${product.product_img_thumbnail}') }}" alt="${product.product_name}" class="img-fluid" style="max-height: 200px;">
                                        </a>
                                        
                                    </div>
                                    <div class="product-body">
                                       
                                        <h3 class="product-title">
                                            <a href="{{ route('product.product_detail', '') }}/${product.product_id}">${product.product_name}</a>
                                        </h3>
                                        <div class="product-price">
                                            <del class="old-price">${product.product_price_regular}</del>
                                            <ins class="new-price">${product.product_price_sale}</ins>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                });
        });
    </script>
@endsection
