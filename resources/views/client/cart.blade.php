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
                    @if($cartItems->count() > 0)
                        <table class="table cart-table">
                            <thead>
                                <tr>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Giá Sản Phẩm</th>
                                    <th scope="col">Màu</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Tổng giá sản phẩm</th>
                                    <th scope="col">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)

                                    <tr data-product-id="{{ $item->product->id }}">
                                        <td>
                                            <img src="{{ asset('storage/' . $item->product->img_thumbnail) }}" alt="{{ $item->product->name }}" width="100">
                                        </td>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ number_format($item->product->price_sale) }} VND</td>
                                        <td>
                                            @if($item->color)
                                                <span style="display:inline-block; width: 30px; height: 30px; border-radius: 20px; background-color: {{ $item->color }}; border: 1px solid #ddd;"></span>
                                            @else
                                                Không có màu
                                            @endif
                                        </td>

                                        <td>
                                            {{ $item->size ?? 'Không có kích thước' }}
                                        </td>
                                        <td class="quantity">
                                            <input type="number" class="quantity-input" value="{{ $item->quantity }}" min="1">
                                        </td>
                                        <td>{{ number_format($item->price * $item->quantity) }} VND</td>
                                        <td>
                                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-primary" style="color: black" type="submit">Xóa</button>
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
                <div class="col-xxl-8 col-lg-8">
                    <table class="table total-table">
                        <tbody>
                            <tr>
                                <td class="tt-left">Tổng Giá Giỏ Hàng</td>
                                <td class="tt-right">
                                    {{-- Hiển thị tổng giá toàn bộ đơn hàng --}}
                                    <span id="total-price" data-initial="{{ $total }}">{{ number_format($total) }} VND</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="cart-proceed-btns">
                        <form method="POST" id="checkout-form" action="{{ route('checkout1') }}">
                            @csrf
                            <input type="hidden" name="selected_products" id="selected_products" value="{{ json_encode($cartItems) }}">
                            <button type="submit" class="btn btn-primary cart-proceed">Mua ngay</button>
                        </form>
                        <a href="/" class="continue-shop">Tìm Kiếm Sản Phẩm Khác</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkoutForm = document.getElementById('checkout-form');
        const selectedProductsInput = document.getElementById('selected_products');

        // Tự động thêm tất cả các sản phẩm vào input hidden khi trang được tải
        checkoutForm.addEventListener('submit', function () {
            const cartItems = [];

            document.querySelectorAll('.cart-table tbody tr').forEach(function (row) {
                const productId = row.getAttribute('data-product-id');
                const quantity = row.querySelector('.quantity-input').value;
                cartItems.push({ product_id: productId, quantity: quantity });
            });

            selectedProductsInput.value = JSON.stringify(cartItems);
        });
    });

    </script>
@endsection
