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
                            <h2 class="page-title">Cart</h2>
                            <ul class="page-switcher d-flex ">
                                <li><a href="index.html">Home</a> <i class="flaticon-arrow-pointing-to-right"></i></li>
                                <li>Cart</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="cart-area mt-100 ml-110">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-12 col-xl-12 col-md-12 col-sm-8">
                    @if(count($cartItems) > 0)
                        <table class="table cart-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá thường</th>
                                <th scope="col">Giá Sale</th>
                                <th scope="col">Màu</th>
                                <th scope="col">Size</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Xóa</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cartItems as $item)
                                <tr>
                                    <td></td>
                                    <td><img src="{{ asset('storage/' . $item->product->img_thumbnail) }}" alt="{{ $item->product->name }}" width="100"></td>
                                    <td>{{ $item->product->name }}</td>
                                    <td><del>{{ number_format($item->product->price_regular) }} VND</del></td>
                                    <td>{{ number_format($item->product->price_sale) }} VND</td>


                                    <td>
                                        @php

                                            $colorVariant = $item->product->variants->firstWhere('name', 'Color');
                                        @endphp
                                        @if($colorVariant)
                                            <!-- Hiển thị ô màu sắc thực tế -->
                                            <span style="display:inline-block; width: 30px; height: 30px;border-radius: 20px; background-color: {{ $colorVariant->value }}; border: 1px solid #ddd;"></span>

                                        @else
                                            Không có màu
                                        @endif
                                    </td>

                                    <td>
                                        @php

                                            $sizeVariant = $item->product->variants->firstWhere('name', 'Size');
                                        @endphp
                                        @if($sizeVariant)
                                            {{ $sizeVariant->value }}
                                        @else
                                            Không có kích thước
                                        @endif
                                    </td>


                                    <td>
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                            @csrf
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="90">
                                            <button type="submit">Cập nhật</button>
                                        </form>
                                    </td>


                                    <td>
                                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Giỏ hàng của bạn trống.</p>
                    @endif
                </div>
            </div>
            <div class="row mt-60">
                <div class="col-xxl-4 col-lg-4">
                    <div class="cart-coupon-input">
                        <h5 class="coupon-title">Coupon Code</h5>
                        <form class="coupon-input d-flex align-items-center">
                            <input type="text" placeholder="Coupon Code">
                            <button type="submit">Apply Code</button>
                        </form>
                    </div>
                </div>
                <div class="col-xxl-8 col-lg-8">
                    <table class="table total-table">
                        <tbody>
                        <tr>
                            <td class="tt-left">Tổng giá</td>
                            <td></td>
                            <td class="tt-right"></td>
                        </tr>
                        <tr>
                            <td class="tt-left">Shipping</td>
                            <td>
                                <ul class="cart-cost-list">

                                </ul>
                            </td>
                            <td class="tt-right cost-info-td">
                                <ul class="cart-cost">
                                    <li>Free</li>
                                    <li>$15</li>
                                    <li>$15</li>
                                    <li>$5</li>
                                    <li></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td class="tt-left">Giá: </td>
                            <td>
                            </td>
                            <td class="tt-right"></td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="cart-proceed-btns">
                        <a href="checkout" class="cart-proceed">Mua ngay</a>
                        <a href="/" class="continue-shop">Continue to shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="newslatter-area ml-110 mt-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="newslatter-wrap text-center">
                        <h5>Connect To EG</h5>
                        <h2 class="newslatter-title">Join Our Newsletter</h2>
                        <p>Hey you, sign up it only, Get this limited-edition T-shirt Free!</p>
                        <form action="#" method="POST">
                            <div class="newslatter-form">
                                <input type="text" placeholder="Type Your Email">
                                <button type="submit">Send <i class="bi bi-envelope-fill"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
