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
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
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
                                    @if($item->product && $item->product->is_active)
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
                                            <td>
                                                <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="" class="form-control quantity-input" style="width: 80px;">
                                                    <button type="submit" class="btn btn-primary btn-sm mt-2">Cập nhật</button>
                                                </form>
                                            </td>
                                            <td>{{ number_format($item->total_price) }} VND</td>
                                            <td>
                                                <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center text-danger">
                                                Sản phẩm "{{ $item->product->name ?? 'N/A' }}" đã ngừng hoạt động và không còn khả dụng.
                                            </td>
                                        </tr>
                                    @endif
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
                                    <h3 id="total-price">{{ number_format($total) }} VND</h3>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="cart-proceed-btns">
                        <form id="checkout-form" action="{{ route('checkout1') }}" method="GET">
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
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function () {
            const quantity = parseInt(this.value);
            const maxStock = parseInt(this.dataset.stock);
            const cartItemId = this.dataset.id;

            // Kiểm tra nếu số lượng vượt quá tồn kho
            if (quantity > maxStock) {
                alert('Số lượng vượt quá tồn kho. Vui lòng giảm số lượng.');
                this.value = maxStock; // Reset về số lượng tối đa
                return;
            }

            // Gửi yêu cầu Ajax để cập nhật giỏ hàng
            fetch(`/cart/update/${cartItemId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ quantity: quantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Cập nhật tổng giá
                    document.getElementById('total-price').textContent = new Intl.NumberFormat().format(data.total) + ' VND';
                } else {
                    alert(data.error);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });


    </script>
    <script>
        // Lắng nghe sự kiện thay đổi số lượng sản phẩm trong giỏ hàng
        document.querySelectorAll('.quantity-input').forEach(function(input) {
            input.addEventListener('change', function() {
                let productId = this.getAttribute('data-id');
                let quantity = this.value;

                // Lấy giá sản phẩm từ bảng
                let price = parseFloat(this.closest('tr').querySelector('td:nth-child(3)').textContent.replace(' VND', '').replace(',', ''));

                // Tính lại tổng giá sản phẩm
                let totalPrice = price * quantity;

                // Cập nhật lại tổng giá sản phẩm trong bảng
                this.closest('tr').querySelector('.total-price').textContent = totalPrice.toLocaleString() + ' VND';

                // Tính lại tổng giỏ hàng
                updateCartTotal();
            });
        });

        // Hàm tính lại tổng giỏ hàng
        function updateCartTotal() {
            let total = 0;
            document.querySelectorAll('.total-price').forEach(function(price) {
                total += parseFloat(price.textContent.replace(' VND', '').replace(',', ''));
            });

            // Cập nhật tổng giỏ hàng
            document.getElementById('total-price').textContent = total.toLocaleString() + ' VND';
        }
    </script>

@endsection
