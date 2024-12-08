@extends('admin.layouts.master')

@section('content')
<div class="container">
    <h1>Chi tiết Đơn Hàng #{{ $order->id }}</h1>
    <div class="row">
        <!-- Cột Thông Tin Khách Hàng -->
        <div class="col-md-6">
            <h3>Thông tin khách hàng</h3>
            <ul class="list-group">
                <li class="list-group-item"><strong>Tên khách hàng:</strong> {{ $order->user_name }}</li>
                <li class="list-group-item"><strong>Email:</strong> {{ $order->user_email }}</li>
                <li class="list-group-item"><strong>Số điện thoại:</strong> {{ $order->user_phone }}</li>
                <li class="list-group-item"><strong>Địa chỉ:</strong> {{ $order->user_address }}</li>
                {{-- <li class="list-group-item"><strong>Ghi chú:</strong> {{ $order->user_note ?? 'Không có' }}</li> --}}
                <li class="list-group-item"><strong>Phương thức thanh toán:</strong> {{ ucfirst($order->payment_method) }}</li>
                <li class="list-group-item"><strong>Trạng thái:</strong> {{ ucfirst($order->status) }}</li>
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
                        <th>Kích cỡ </th>
                        <th>Màu sắc </th>
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
                                <img src="{{ Storage::url($item->product_img_thumbnail) }}"  alt="Thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                            </td>
                            <!-- Tên sản phẩm -->
                            <td>{{ $item->product_name }}</td>
                            <!-- SKU -->
                            <td>{{ $item->product_sku }}</td>
                            <!-- Kích cỡ và màu sắc -->
                            <td> {{ $item->size ?? 'N/A' }}  </td>
                            {{-- <p><strong>Màu sắc:</strong> <span class="color-box" style="display: inline-block; width: 20px; height: 20px; background-color: {{ $cartItem['color'] }};"></span></p> --}}

                            <td class="color-box " style="display: inline-block; width: 20px; height: 20px; background-color: {{ $item['color'] }};"></td>

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
    <div class="mt-3">
        {{-- <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Quay lại danh sách đơn hàng</a>
    </div> --}}
</div>
@endsection
