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
                            <h2 class="page-title">Checkout</h2>
                            <ul class="page-switcher d-flex ">
                                <li><a href="index.html">Home</a> <i class="flaticon-arrow-pointing-to-right"></i></li>
                                <li>Checkout</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="checkout-area ml-110 mt-100">
        <div class="container">
            <div class="row">
                <form action="{{ route('orders.store') }}" method="POST" class="row">
                    @csrf <!-- Thêm dòng này để bảo vệ CSRF -->
                    <div class="col-xxl-8">
                        <div class="billing-from">
                            <h5 class="checkout-title">Billing Details</h5>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="eg-input-group">
                                        <label for="first-name1">Tên</label>
                                        <input type="text" id="first-name1" name="user_name" value="{{ Auth::check() ? Auth::user()->name : '' }}" placeholder="Your first name" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="eg-input-group">
                                        <label>Email</label>
                                        <input type="email" name="user_email" value="{{ Auth::check() ? Auth::user()->email : '' }}" placeholder="Your Email" required>
                                    </div>
                                    <div class="eg-input-group">
                                        <label>Địa chỉ cụ thể</label>
                                        <input type="text" name="user_address" value="{{ Auth::check() ? Auth::user()->address : '' }}" placeholder="Your Address">
                                    </div>
                                    <div class="eg-input-group">
                                        <label>Số Điện Thoại</label>
                                        <input type="number" name="user_phone" value="{{ Auth::check() ? Auth::user()->phone : '' }}" placeholder="Your Phone" required>
                                    </div>
                                    <div class="eg-input-group mb-0">
                                        <textarea cols="30" rows="7" name="user_note" placeholder="Order Notes (Optional)"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4">
                        <div class="order-summary">
                            <div class="added-product-summary">
                                <h5 class="checkout-title">Order Summary</h5>
                                <ul class="added-products">
                                    <li class="single-product">
                                        <div class="product-img">
                                            <img src="{{ $image }}" alt="{{ $productName }}">
                                        </div>
                                        <div class="product-info">
                                            <h5 class="product-title"><a href="product.html">{{ $productName }}</a></h5>
                                            <div class="product-total">
                                                <div class="quantity">
                                                    <span class="product-quantity">{{ $quantity }}</span>
                                                </div>
                                                <strong><i class="bi bi-x-lg"></i> <span class="product-price">{{ $productPrice }}</span> VND</strong>
                                            </div>
                                            <p><strong>Màu sắc:</strong>
                                                <span class="color-box" style="display: inline-block; width: 20px; height: 20px; background-color: {{ $color }}; border: 1px solid #ddd;"></span>
                                            </p>
                                            <p><strong>Kích thước:</strong> {{ $size }}</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="total-cost-summary">
                                <ul>
                                    <li class="subtotal">Tổng Giá <span id="subtotal">{{ number_format($quantity * $productPrice) }} VND</span></li>
                                    <li>Thuế <span id="tax">5000 VND</span></li>
                                    <li>Tổng Đơn Hàng (Bao gồm cả thuế) <span id="total">{{ number_format($quantity * $productPrice + 5000) }} VND</span></li>
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="total_price" value="{{ $quantity * $productPrice + 5000 }}">
                                </ul>
                            </div>
                            <div class="payment-form">
                                <div class="payment-methods">
                                    <div class="form-check payment-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="payment_cash" checked>
                                        <label class="form-check-label" for="payment_cash">Cash on delivery</label>
                                        <p>Pay with cash upon delivery.</p>
                                    </div>
                                    <div class="form-check payment-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="payment_card">
                                        <label class="form-check-label" for="payment_card">Credit / Debit Card</label>
                                        <p>
                                            <div class="row gy-3">
                                                <div class="col-md-12">
                                                    <label for="cc-name" class="form-label">Name on card</label>
                                                    <input type="text" class="form-control" id="cc-name" placeholder="Enter name">
                                                    <small class="text-muted">Full name as displayed on card</small>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="cc-number" class="form-label">Credit card number</label>
                                                    <input type="text" class="form-control" id="cc-number" placeholder="xxxx xxxx xxxx xxxx">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="cc-expiration" class="form-label">Expiration</label>
                                                    <input type="text" class="form-control" id="cc-expiration" placeholder="MM/YY">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="cc-cvv" class="form-label">CVV</label>
                                                    <input type="text" class="form-control" id="cc-cvv" placeholder="xxx">
                                                </div>
                                            </div>
                                        </p>
                                    </div>
                                </div>
                                <div class="place-order-btn">
                                    <button type="submit">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <script>

            document.addEventListener('DOMContentLoaded', function() {
                const quantityInput = document.querySelector('.quantity-input');
                const productPrice = parseFloat(document.querySelector('.product-price').textContent.replace(/,/g, ''));
                const subtotalElement = document.getElementById('subtotal');
                const totalElement = document.getElementById('total');
                const tax = 50000;

                function updateTotal() {
                    const quantity = parseInt(quantityInput.value);

                    if (isNaN(quantity) || quantity <= 0) {
                        subtotalElement.textContent = '0 VND';
                        totalElement.textContent = (tax).toLocaleString('vi-VN') + ' VND'; // Chỉ tính thuế
                        return;
                    }

                    const subtotal = quantity * productPrice; // Tính subtotal
                    const total = subtotal + tax; // Tính tổng

                    subtotalElement.textContent = subtotal.toLocaleString('vi-VN') + ' VND';
                    totalElement.textContent = total.toLocaleString('vi-VN') + ' VND';
                }

                // Lắng nghe sự kiện thay đổi số lượng
                quantityInput.addEventListener('input', updateTotal);
            });


    </script>
@endsection
