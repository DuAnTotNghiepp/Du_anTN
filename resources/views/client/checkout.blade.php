@extends('client.layouts.app')

@section('content')
@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>..........................{{ $error }}</li>
        @endforeach
    </ul>
@endif

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
                    @csrf
                    <div class="col-xxl-8">
                        <div class="billing-from">
                            <h5 class="checkout-title">Billing Details</h5>
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Select Address -->
                                    <div class="eg-input-group">
                                        <label for="address-selection">Chọn Địa chỉ nhận</label><a href="{{ route('profile', ['id' => auth()->user()->id]) }}">
                                            Thêm Địa Chỉ Khác
                                        </a>
                                        <select id="address-selection" name="user_address" class="form-control" required>
                                            <option value="">-- Chọn Địa chỉ --</option>
                                            @foreach ($addresses as $address)
                                                <option value="{{ $address->id }}">
                                                    {{ $address->address }}, {{ $address->commune }}, {{ $address->city }}, {{ $address->state }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- Display Selected Address Info -->
                                    <div id="selected-address-info">
                                        <div class="eg-input-group">
                                            <label for="selected-first-name">Tên</label>
                                            <input type="text" id="selected-first-name" name="user_name" value="" readonly placeholder="Your first name">
                                        </div>
                                        <div class="eg-input-group">
                                            <label for="selected-email">Email</label>
                                            <input type="email" id="selected-email" name="user_email" value="" readonly placeholder="Your Email">
                                        </div>
                                        <div class="eg-input-group">
                                            <label for="selected-contact-number">Số Điện Thoại</label>
                                            <input type="text" id="selected-contact-number" name="user_phone" value="" readonly placeholder="Your Phone">
                                        </div>
                                    </div>
                                </div>

                                <div class="eg-input-group mb-0">
                                    <textarea cols="30" rows="7" name="user_note" placeholder="Order Notes (Optional)"></textarea>
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
                                                <img src="{{ $checkoutData['image'] }}" alt="{{ $checkoutData['productName'] }}" style="max-width: 100px; border-radius: 5px;">
                                            </div>
                                            <div class="product-info">
                                                <h5 class="product-title">{{ $checkoutData['productName'] }}</h5>
                                                <div class="product-total">
                                                    <div class="">
                                                        <span class="product-quantity">{{ $checkoutData['quantity'] }}</span>
                                                        <input type="hidden" name="quantity" value="{{ $checkoutData['quantity'] }}">
                                                    </div>
                                                    <strong>
                                                        <i class="bi bi-x-lg"></i>
                                                        <span class="product-price">{{ number_format($checkoutData['productPrice'], 0, ',', '.') }}</span> VND
                                                    </strong>
                                                </div>
                                                <p><strong>Color: </strong>
                                                    <span class="color-box" style="display: inline-block; width: 20px; height: 20px; background-color: {{ $checkoutData['color'] }}; border: 1px solid #ddd; border-radius: 10px;"></span>
                                                    <input type="hidden" name="color" value="{{ $checkoutData['color'] }}">

                                                </p>
                                                <p><strong>SIZE: </strong> {{ $checkoutData['size'] }}</p>
                                                <input type="hidden" name="size" value="{{ $checkoutData['size'] }}">

                                            </div>
                                        </li>
                                </ul>

                            </div>
                            <div class="total-cost-summary">
                                <ul>
                                    <!-- Hiển thị Tổng Giá -->
                                    <li class="subtotal">Tổng Giá
                                        <span id="subtotal">{{ number_format($quantity * $productPrice) }} VND</span>
                                    </li>

                                    <!-- Hiển thị Thuế -->
                                    <li>Thuế
                                        <span id="tax">5000 VND</span>
                                    </li>
                                    <li>Giảm giá: <strong>- <span id="voucher_value">0<span> VNĐ</strong></li>
                                    {{-- <!-- Hiển thị Giá trị Giảm Giá -->
                                    @if(session('voucher'))
                                        <li class="discount">Giảm Giá ({{ session('voucher')->code }})
                                            <span id="discount">-{{ number_format(session('voucher_discount')) }} VND</span>
                                        </li>
                                    @endif --}}

                                    <!-- Hiển thị Tổng Đơn Hàng (Bao gồm thuế và giảm giá) -->
                                    <li>Tổng Đơn Hàng (Bao gồm cả thuế)
                                        <span id="total">
                                            {{ number_format(($quantity * $productPrice + 5000) ) }} VND
                                        </span>
                                    </li>

                                    <!-- Các trường ẩn -->
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="total_price" id="total_price"
                                           value="{{ ($quantity * $productPrice + 5000)}}">
                                </ul>

                                <!-- Form áp dụng mã giảm giá -->
                                    <div id="applyVoucher">
                                        <div class="input-group">
                                            <input type="text" name="voucher_code" id="voucher_code" class="form-control" placeholder="Nhập mã giảm giá">
                                            <button type="button" class="btn btn-primary" onclick="getVoucherInfo()">Áp dụng</button>

                                        </div>
                                        <span id="errorMessage" class="error-message"></span><br>
                                    </div>


                            </div>

                            </div>

                            <div class="payment-form">
                                <div class="payment-methods">
                                    <div class="form-group">
                                        <label for="payment_method">Payment Method</label>
                                        <select name="payment_method" id="payment_method" class="form-control" required>
                                            <option value="cash">Cash on Delivery</option>
                                            <option value="vnpay">VNPay</option>
                                        </select>
                                    </div>

                                    <div class="form-group" id="bank_code_group" style="display: none;">
                                        <label for="bank_code">Bank</label>
                                        <select name="bank_code" id="bank_code" class="form-control">
                                            <option value="NCB">NCB</option>
                                            <option value="Vietcombank">Vietcombank</option>
                                            <!-- Add other bank options as needed -->
                                        </select>
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
            document.addEventListener('DOMContentLoaded', function () {
            const addressSelect = document.getElementById('address-selection');
            const addresses = @json($addresses); // Dữ liệu địa chỉ từ backend
            const firstNameInput = document.getElementById('selected-first-name');
            const emailInput = document.getElementById('selected-email');
            const phoneInput = document.getElementById('selected-contact-number');

            // Lắng nghe sự kiện thay đổi địa chỉ
            addressSelect.addEventListener('change', function () {
                const selectedId = this.value;

                // Tìm địa chỉ tương ứng
                const selectedAddress = addresses.find(address => address.id == selectedId);
                // Hiển thị thông tin nếu có
                if (selectedAddress) {
                    firstNameInput.value = selectedAddress.first_name;
                    emailInput.value = selectedAddress.email;
                    phoneInput.value = selectedAddress.contact_number;
                } else {
                    // Xóa thông tin nếu không chọn gì
                    firstNameInput.value = '';
                    emailInput.value = '';
                    phoneInput.value = '';
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const quantityInput = document.querySelector('.quantity-input');
            const subtotalElement = document.getElementById('subtotal');
            const totalElement = document.getElementById('total');
            const tax = 5000;

            if (!quantityInput || !subtotalElement || !totalElement) {
                console.error('Missing elements for calculation.');
                return;
            }

            quantityInput.addEventListener('input', function() {
                const quantity = parseInt(quantityInput.value);
                const productPrice = parseFloat(quantityInput.dataset.price); // Lấy giá từ thuộc tính data-price
                const subtotal = quantity * productPrice;
                const total = subtotal + tax;

                subtotalElement.textContent = subtotal.toLocaleString('vi-VN') + ' VND';
                totalElement.textContent = total.toLocaleString('vi-VN') + ' VND';
            });
        });
            function getVoucherInfo() {
                const errorMessage = document.getElementById('errorMessage');
                const voucherCode = document.getElementById('voucher_code').value;

                const voucher_value = document.getElementById('voucher_value');
                const final_total = document.getElementById('total');

                const totalPrice = document.getElementById('total_price').value;
                // Gửi yêu cầu GET đến API để lấy thông tin mã giảm giá
                if(!voucherCode) {
                    errorMessage.textContent = "Vui lòng nhập mã giảm giá";
                    errorMessage.style.color = "red";
                    return;
                }
                console.log(totalPrice)
                fetch(`http://127.0.0.1:8000/checkout/apply-voucher?voucher_code=${voucherCode}&total_price=${totalPrice}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Xử lý dữ liệu trả về từ API
                        console.log(data.voucher_discount);
                        if (data.result == true) {
                            voucher_value.textContent = data.data.voucher_discount
                            final_total.textContent = data.data.final_total
                            let hiddenInput = document.getElementById('total_price');
                            hiddenInput.value = data.data.final_total;
                        } else {
                            errorMessage.textContent = data.message;
                            errorMessage.style.color = "red";
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        errorMessage.textContent = "Đã xảy ra lỗi khi lấy thông tin mã giảm giá";
                        errorMessage.style.color = "red";
                    });
            }
    </script>
@endsection
