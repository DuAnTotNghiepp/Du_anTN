@extends('client.layouts.app')

@section('content')
    <div class="breadcrumb-area ml-110">
        <div class="container-fluid p-0">
            <div class="row">
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
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

    <div class="checkout-area mt-100 ml-110">
        <div class="container">
            <div class="row">
                <form action="{{ route('orders.store1') }}" method="POST" class="row">
                    @csrf
                    <div class="col-xxl-8">
                        <div class="billing-from">
                            <h5 class="checkout-title">Billing Details</h5>
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Select Address -->
                                    <div class="eg-input-group">
                                        <label for="address-selection">Chọn Địa chỉ nhận</label><a
                                            href="{{ route('profile', ['id' => auth()->user()->id]) }}">
                                            Thêm Địa Chỉ Khác
                                        </a>
                                        <select id="address-selection" name="user_address" class="form-control" required>
                                            <option value="">-- Chọn Địa chỉ --</option>
                                            @foreach ($addresses as $address)
                                                <option value="{{ $address->id }}">
                                                    {{ $address->address }}, {{ $address->commune }}, {{ $address->city }},
{{ $address->state }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- Display Selected Address Info -->
                                    <div id="selected-address-info">
                                        <div class="eg-input-group">
                                            <label for="selected-first-name">Tên</label>
                                            <input type="text" id="selected-first-name" name="user_name" value=""
                                                readonly placeholder="Your first name">
                                        </div>
                                        <div class="eg-input-group">
                                            <label for="selected-email">Email</label>
                                            <input type="email" id="selected-email" name="user_email" value=""
                                                readonly placeholder="Your Email">
                                        </div>
                                        <div class="eg-input-group">
                                            <label for="selected-contact-number">Số Điện Thoại</label>
                                            <input type="text" id="selected-contact-number" name="user_phone"
                                                value="" readonly placeholder="Your Phone">
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
                                    <!-- Hiển thị các sản phẩm trong giỏ hàng -->
                                    @foreach ($cartItems as $item)
                                        <li class="single-product">
                                            <div class="product-img">
                                                <img src="{{ asset('storage/' . $item->product->img_thumbnail) }}"
                                                    alt="{{ $item->product->name }}"
                                                    style="max-width: 100px; border-radius: 5px;">
</div>
                                            <div class="product-info">
                                                <h5 class="product-title">{{ $item->product->name }}</h5>
                                                <div class="product-total">
                                                    <div class="">
                                                        <span class="product-quantity">{{ $item->quantity }}</span>
                                                        <input type="hidden" name="quantity[]" value="{{ $item->quantity }}">
                                                    </div>
                                                    <strong>
                                                        <i class="bi bi-x-lg"></i>
                                                        <span class="product-price">{{ number_format($item->product->price_sale, 0, ',', '.') }}</span>
                                                        VND
                                                    </strong>
                                                    <input type="hidden" name="product_id[]" value="{{ $item->product->id }}">
                                                    <input type="hidden" name="variant_id[]" value="{{ $item->variant_id ?? '' }}">
                                                    <input type="hidden" name="product_name[]" value="{{ $item->product->name }}">
                                                    <input type="hidden" name="product_sku[]" value="{{ $item->product->sku }}">
                                                    <input type="hidden" name="product_img_thumbnail[]" value="{{ $item->product->img_thumbnail }}">
                                                    <input type="hidden" name="product_price_regular[]" value="{{ $item->product->price_regular }}">
                                                    <input type="hidden" name="product_price_sale[]" value="{{ $item->product->price_sale }}">
                                                </div>
                                                <p><strong>Màu: </strong>
                                                    <input type="hidden" name="color[]" value="{{ $item->color }}"><span class="color-box" style="display: inline-block; width: 20px; height: 20px; background-color: {{ $item->color }}; border: 1px solid #ddd; border-radius: 10px;"></span>
                                                </p>
                                                <p><strong>Cỡ: </strong>{{ $item->size }}</p>
                                                <input type="hidden" name="size[]" value="{{ $item->size }}">
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>
<div class="total-cost-summary">
                            <ul>
                                <!-- Hiển thị Tổng Giá -->
                                <li class="subtotal">Tổng Giá
                                    <span id="subtotal">{{ number_format($total) }} VND</span>
                                </li>

                                <!-- Hiển thị Thuế -->
                                <li>Thuế
                                    <span id="tax">5000 VND</span>
                                </li>
                                <li>Giảm giá: <strong>- <span id="voucher_value">0<span> VNĐ</strong></li>

                                <!-- Hiển thị Tổng Đơn Hàng -->
                                <li>Tổng Đơn Hàng (Bao gồm thuế)
                                    <span id="total">{{ number_format($totalWithTax) }} VND</span>
                                </li>
                            </ul>

                            <!-- Các trường ẩn -->
                            <input type="hidden" name="total_price" id="total_price" value="{{ $total + 5000 }}">

                            <!-- Form áp dụng mã giảm giá -->
                            <div id="applyVoucher">
                                <div class="input-group">
                                    <input type="text" name="voucher_code" id="voucher_code" class="form-control"
                                        placeholder="Nhập mã giảm giá">
                                    <button type="button" class="pd-add-cart"
                                        style="height: 45px; border: 1px solid #ced4da" onclick="getVoucherInfo()">Áp
                                        dụng</button>
                                </div>
                                <span id="errorMessage" class="error-message"></span><br>
                            </div>
                        </div>
                        <div class="payment-form">
                            <div class="payment-methods">
                                <div class="form-group">
                                    <label for="payment_method">Payment Method</label>
                                    <select name="payment_method" id="payment_method" class="form-control" required>
                                        <option value="cash">Thanh Toán Khi Nhận Hàng</option>
                                        <option value="vnpay">Thanh Toán VNPay</option>
                                    </select>
                                </div>

                                <div class="form-group" id="bank_code_group" style="display: none;">
                                    <label for="bank_code">Bank</label>
                                    <select name="bank_code" id="bank_code" class="form-control">
                                        <option value="NCB">NCB</option>
<option value="Vietcombank">Vietcombank</option>
                                    </select>
                                </div>
                            </div>

                            <div class="place-order-btn">
                                <button type="submit">Đặt Hàng</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addressSelect = document.getElementById('address-selection');
            const addresses = @json($addresses); // Dữ liệu địa chỉ từ backend
            const firstNameInput = document.getElementById('selected-first-name');
            const emailInput = document.getElementById('selected-email');
            const phoneInput = document.getElementById('selected-contact-number');

            // Lắng nghe sự kiện thay đổi địa chỉ
            addressSelect.addEventListener('change', function() {
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

    </script>
    <script>

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
                const productPrice = parseFloat(quantityInput.dataset
                    .price); // Lấy giá từ thuộc tính data-price
                const subtotal = quantity * productPrice;
                const total = subtotal + tax;

                subtotalElement.textContent = subtotal.toLocaleString('vi-VN') + ' VND';
                totalElement.textContent = total.toLocaleString('vi-VN') + ' VND';
            });
        });
let appliedVouchers = []; // Mảng để lưu trữ các mã đã áp dụng

        function getVoucherInfo() {
            const errorMessage = document.getElementById('errorMessage');
            const voucherCode = document.getElementById('voucher_code').value;

            const voucher_value = document.getElementById('voucher_value');
            const final_total = document.getElementById('total');

            const totalPrice = document.getElementById('total_price').value;

            // Gửi yêu cầu GET đến API để lấy thông tin mã giảm giá
            if (!voucherCode) {
                errorMessage.textContent = "Vui lòng nhập mã giảm giá";
                errorMessage.style.color = "red";
                return;
            }

            // Kiểm tra nếu mã đã được áp dụng
            if (appliedVouchers.includes(voucherCode)) {
                errorMessage.textContent = "Mã giảm giá đã được áp dụng!";
                errorMessage.style.color = "red";
                return;
            }

            fetch(`http://127.0.0.1:8000/checkout/apply-voucher?voucher_code=${voucherCode}&total_price=${totalPrice}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Xử lý dữ liệu trả về từ API
                    if (data.result === true) {
                        voucher_value.textContent = data.data.voucher_discount;
                        final_total.textContent = data.data.final_total;
                        let hiddenInput = document.getElementById('total_price');
                        hiddenInput.value = data.data.final_total;

                        // Lưu mã giảm giá đã áp dụng vào mảng
                        appliedVouchers.push(voucherCode);

                        // Hiển thị thông báo áp dụng thành công
                        errorMessage.textContent = "Mã giảm giá đã được áp dụng thành công!";
                        errorMessage.style.color = "green";
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