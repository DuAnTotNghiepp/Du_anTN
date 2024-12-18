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
                                        <div class="col-lg-12">
                                   
                                            <!-- Display Selected Address Info -->
                                            <div id="selected-address-info">
                                                <div class="eg-input-group">
                                                    <label for="selected-first-name">Họ & Tên:</label>
                                                    <input type="text" id="selected-first-name" name="user_name" value="" readonly placeholder="Your first name">
                                                </div>
                                            </div>
                                             <!-- Select Address -->
                                             <div class="eg-input-group">
                                                <label for="address-selection">Chọn Địa chỉ nhận:</label>
                                                 <!-- Nút để hiển thị/ẩn form -->
                                            <button class="btn float-end" id="add-address-btn">Thêm Địa Chỉ</button>
                                                <select id="address-selection" name="user_address" class="form-control" required>
                                                    <option value="">-- Chọn Địa chỉ --</option>
                                                    @foreach ($addresses as $address)
                                                        <option value="{{ $address->id }}">
                                                            {{ $address->address }}, {{ $address->commune }}, {{ $address->city }}, {{ $address->state }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Display Selected Address Info -->
                                    <div id="selected-address-info">
                                        <div class="eg-input-group">
                                            <label for="selected-email">Email:</label>
                                            <input type="email" id="selected-email" name="user_email" value="" readonly placeholder="Your Email">
                                        </div>
                                        <div class="eg-input-group">
                                            <label for="selected-contact-number">Số Điện Thoại:</label>
                                            <input type="text" id="selected-contact-number" name="user_phone" value="" readonly placeholder="Your Phone">
                                        </div>
                                    </div>
                                </div>

                                <div class="eg-input-group mb-0">
                                    <label for="selected-contact-number">Ghi chú:</label>
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
                                            <img src="{{ $checkoutData['image'] }}" alt="{{ $checkoutData['productName'] }}"
                                                style="max-width: 100px; border-radius: 5px;">
                                        </div>
                                        <div class="product-info">
                                            <h5 class="product-title">{{ $checkoutData['productName'] }}</h5>
                                            <div class="product-total">
                                                <div class="">
                                                    <span class="product-quantity">{{ $checkoutData['quantity'] }}</span>
                                                    <input type="hidden" name="quantity"
                                                        value="{{ $checkoutData['quantity'] }}">
                                                </div>
                                                <strong>
                                                    <i class="bi bi-x-lg"></i>
                                                    <span
                                                        class="product-price">{{ number_format($checkoutData['productPrice'], 0, ',', '.') }}</span>
                                                    VND
                                                </strong>
                                            </div>
                                            <p><strong>Color: </strong>
                                                <span class="color-box"
                                                    style="display: inline-block; width: 20px; height: 20px; background-color: {{ $checkoutData['color'] }}; border: 1px solid #ddd; border-radius: 10px;"></span>
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
                                
                                    <!-- Hiển thị Giảm Giá -->
                                    <li>Giảm giá: <strong>- <span id="voucher_value">{{ number_format($voucherValue ?? 0) }}</span> VNĐ</strong></li>
                                
                                    <!-- Hiển thị Tổng Đơn Hàng (Bao gồm thuế và giảm giá) -->
                                    <li>Tổng Đơn Hàng (Bao gồm cả thuế và giảm giá)
                                        <span id="total">
                                            {{ number_format(($quantity * $productPrice + 5000) - ($voucherValue ?? 0)) }}
                                        </span> VND
                                    </li>
                                
                                    <!-- Các trường ẩn -->
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="total_price" id="total_price"
                                        value="{{ ($quantity * $productPrice + 5000) - ($voucherValue ?? 0) }}">
                                </ul>
                                

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
 <!-- Form thêm địa chỉ -->
            <div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('profile.address.store') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="addAddressLabel">Thêm Địa Chỉ</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Form các trường thêm địa chỉ -->
                                <div class="mb-3">
                                    <label for="addFirstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="addFirstName" name="first_name"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="addLastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="addLastName" name="last_name"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="addEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="addEmail" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="addContactNumber" class="form-label">Contact Number</label>
                                    <input type="tel" class="form-control" id="addContactNumber"
                                        name="contact_number" required>
                                </div>
                                <div>
                                    <label class="form-label">City</label>
                                    <select class="form-select form-select-sm mb-3" id="city" name="city">
                                        <option value="" selected>Select province</option>
                                    </select>
                                    <label class="form-label">District</label>
                                    <select class="form-select form-select-sm mb-3" id="district" name="state">
                                        <option value="" selected>Select district</option>
                                    </select>
                                    <label class="form-label">Ward</label>
                                    <select class="form-select form-select-sm" id="ward" name="commune">
                                        <option value="" selected>Select ward</option>
                                    </select>
                                    <!-- Input ẩn để lưu tên tỉnh, huyện, xã -->
                                    <input type="hidden" id="city_name" name="city">
                                    <input type="hidden" id="district_name" name="state">
                                    <input type="hidden" id="ward_name" name="commune">

                                </div>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
                                <script>
                                    var citis = document.getElementById("city");
                                    var districts = document.getElementById("district");
                                    var wards = document.getElementById("ward");
                                    var Parameter = {
                                        url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
                                        method: "GET",
                                        responseType: "application/json",
                                    };

                                    axios(Parameter)
                                        .then(function(result) {
                                            console.log("Dữ liệu JSON tải thành công:", result.data); // Kiểm tra dữ liệu tải về
                                            renderCity(result.data);
                                        })
                                        .catch(function(error) {
                                            console.error("Không thể tải dữ liệu:", error);
                                        });

                                    function renderCity(data) {
                                        for (const x of data) {
                                            citis.options[citis.options.length] = new Option(x.Name, x.Id);
                                        }
                                        citis.onchange = function() {
                                            districts.length = 1;
                                            wards.length = 1;
                                            if (this.value != "") {
                                                const result = data.filter(n => n.Id === this.value);
                                                for (const k of result[0].Districts) {
                                                    districts.options[districts.options.length] = new Option(k.Name, k.Id);
                                                }
                                            }
                                        };
                                        document.getElementById("city").addEventListener("change", function() {
                                            const cityName = this.options[this.selectedIndex].text; // Lấy tên tỉnh/thành
                                            document.getElementById("city_name").value = cityName; // Gán vào input ẩn
                                        });

                                        document.getElementById("district").addEventListener("change", function() {
                                            const districtName = this.options[this.selectedIndex].text; // Lấy tên quận/huyện
                                            document.getElementById("district_name").value = districtName; // Gán vào input ẩn
                                        });

                                        document.getElementById("ward").addEventListener("change", function() {
                                            const wardName = this.options[this.selectedIndex].text; // Lấy tên xã/phường
                                            document.getElementById("ward_name").value = wardName; // Gán vào input ẩn
                                        });

                                        districts.onchange = function() {
                                            wards.length = 1;
                                            const dataCity = data.filter((n) => n.Id === citis.value);
                                            if (this.value != "") {
                                                const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;
                                                for (const w of dataWards) {
                                                    wards.options[wards.options.length] = new Option(w.Name, w.Id);
                                                }
                                            }
                                        };
                                    }
                                </script>
                                <div class="mb-3">
                                    <label for="addAddress" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="addAddress" name="address" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button type="submit" class="btn btn-dark">Thêm Địa Chỉ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                document.getElementById('add-address-btn').addEventListener('click', function() {
                    const addModal = new bootstrap.Modal(document.getElementById('addAddressModal'));
                    addModal.show();
                });
                document.querySelectorAll('.edit-button').forEach(button => {
                    button.addEventListener('click', function() {
                        const addressId = this.getAttribute('data-id');

                        // Giả sử bạn có API trả về thông tin địa chỉ
                        axios.get(`/api/addresses/${addressId}`).then(response => {
                            const address = response.data;
                            document.getElementById('editFirstName').value = address.first_name;
                            document.getElementById('editLastName').value = address.last_name;
                            document.getElementById('editEmail').value = address.email;
                            document.getElementById('editContactNumber').value = address.contact_number;
                            document.getElementById('editAddress').value = address.address;

                            // Tải dữ liệu tỉnh, quận, xã nếu cần
                            document.getElementById('editCityName').value = address.city_name;
                            document.getElementById('editDistrictName').value = address.state_name;
                            document.getElementById('editWardName').value = address.commune_name;
                        });
                    });

                // document.getElementById('toggle-form-btn').addEventListener('click', function() {
                //     const formContainer = document.getElementById('address-form-container');
                //     formContainer.style.display = formContainer.style.display === 'none' ? 'block' : 'none';
                // });
            });
            </script>
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