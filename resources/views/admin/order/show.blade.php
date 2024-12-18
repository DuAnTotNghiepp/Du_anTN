@extends('admin.layouts.master')

@section('content')
<style>
    .order-detail {
        border: 1px solid #ddd; /* Màu sắc và độ dày của border */
        padding: 20px; /* Khoảng cách bên trong */
        border-radius: 5px; /* Để bo góc cho border */
        background-color: #f9f9f9; /* Màu nền cho vùng chi tiết đơn hàng */
    }
    .color-box {
        width: 20px; /* Đặt chiều rộng cho ô màu */
        height: 20px; /* Đặt chiều cao cho ô màu */
        border: 1px solid #ccc; /* Thêm border cho ô màu */
        margin: 0 auto; /* Căn giữa ô màu */
    }
</style>

<div class="container">
    <div class="order-detail">
        <h1>Chi tiết Đơn Hàng #{{ $order->id }}</h1>
        <div class="row">
            <!-- Cột Thông Tin Khách Hàng -->
            <div class="col-md-6">
                <h3>Thông tin khách hàng</h3>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Tên khách hàng:</strong> {{ $order->user_name }}</li>
                    <li class="list-group-item"><strong>Email:</strong> {{ $order->user_email }}</li>
                    <li class="list-group-item"><strong>Số điện thoại:</strong> {{ $order->user_phone }}</li>
                    <li class="list-group-item"><strong>Địa chỉ:</strong> {{ $order->address->address }}, {{ $order->address->city }}, {{ $order->address->state }}</li>
                    <li class="list-group-item"><strong>Ghi chú:</strong> {{ $order->user_note ?? 'Không có' }}</li>
                    <li class="list-group-item"><strong>Phương thức thanh toán:</strong> {{ ucfirst($order->payment_method) }}</li>
                    <li class="list-group-item"><strong>Trạng thái:</strong>  
                        @if($order->status == 'pending')
                            Đang Xác Nhận
                        @elseif($order->status == 'completed')
                            Đã Xác Nhận
                        @elseif($order->status == 'unpaid')
                            Chưa Trả Tiền
                        @elseif($order->status == 'canceled')
                            Đã hủy
                        @elseif($order->status == 'shipped')
                            Đang giao hàng
                        @else
                            {{ $order->status }}
                        @endif
                    </li>
                </ul>
            </div>

            <!-- Cột Thông Tin Sản Phẩm -->
            <div class="col-md-6">
                <h3>Thông tin sản phẩm</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Sản phẩm</th>
                            <th>SKU</th>
                            <th>Kích cỡ</th>
                            <th>Màu sắc</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <!-- Hình ảnh sản phẩm -->
                                <td>
                                    <img src="{{ Storage::url($item->product_img_thumbnail) }}" alt="Thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <!-- Tên sản phẩm -->
                                <td>{{ $item->product_name }}</td>
                                <!-- SKU -->
                                <td>{{ $item->product_sku }}</td>
                                <!-- Kích cỡ -->
                                <td>{{ $item->size ?? 'N/A' }}</td>
                                <!-- Màu sắc -->
                                <td>
                                    <div class="color-box" style="background-color: {{ $item['color'] }};"></div>
                                </td>
                                <!-- Số lượng -->
                                <td>{{ $item->quantity }}</td>
                                <!-- Giá sản phẩm -->
                                <td>
                                    @if($item->product_price_sale)
                                        <span>{{ number_format($item->product_price_sale, 2) }} VND</span><br>
                                        <small><del>{{ number_format($item->product_price_regular, 2) }} VND</del></small>
                                    @else
                                        <span>{{ number_format($item->product_price_regular, 2) }} VND</span>
                                    @endif
                                </td>
                                <!-- Tổng giá -->
                                <td>
                                    @if($item->product_price_sale)
                                        {{ number_format($item->quantity * $item->product_price_sale, 2) }} VND
                                    @else
                                        {{ number_format($item->quantity * $item->product_price_regular, 2) }} VND
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <h4 class="text-right">
                    <strong>Tổng giá trị đơn hàng: {{ number_format($order->total_price, 2) }} VND</strong>
                </h4>
            </div>
        </div>
        <div class="mt-3 text-right">
            <a href="{{ route('order.index') }}" class="btn btn-primary">Quay lại danh sách đơn hàng</a>
        </div>
    </div>
</div>
@endsection
