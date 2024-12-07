@extends('admin.layouts.master')

@section('title')
    Thông tin đơn hàng
@endsection
@section('content')
    <div class="container">
        <h1 class="mt-5">Danh sách đơn hàng</h1>
        @if ($orders->isEmpty())
            <p>Chưa có đơn hàng nào!</p>
        @else
            @foreach ($orders as $order)
                <div class="card mt-4">
                    <div class="card-header">
                        <strong>Đơn hàng #{{ $order->id }}</strong>
                        <p>Người đặt: {{ $order->user_name }}</p>
                        <p>Email: {{ $order->user_email }}</p>
                        <p>Số điện thoại: {{ $order->user_phone }}</p>
                        <p>Tổng tiền: {{ number_format($order->total_price) }} VND</p>
                        <p>Trạng thái: {{ $order->status }}</p>
                    </div>
                    <div class="card-body">
                        <h5>Sản phẩm trong đơn hàng:</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Màu sắc</th>
                                    <th>Kích thước</th>
                                    <th>Giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->product->name ?? 'Không xác định' }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>
                                            <span style="display: inline-block; width: 20px; height: 20px; background-color: {{ $item->color }}; border: 1px solid #ddd;"></span>
                                        </td>
                                        <td>{{ $item->size }}</td>
                                        <td>{{ number_format($item->price) }} VND</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
