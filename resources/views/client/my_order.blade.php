@extends('client.profile')
@section('content_profile')
<div class="col-xxl-8 col-xl-8 col-lg-8">
    <div class="profile-form-wrapper">

        <div class="container mt-5">
            <div class="card">
                <div class="card-header text-white">
                    <h5 class="mt-3">ĐƠN HÀNG</h5>
                </div>
            <div class="card-body">
                {{-- <table style="width: 100%; text-align: center">
                    <tr>
                        <th>IMAGE</th>
                        <th>NAME</th>
                        <th>PRICE</th>
                        <th>QUANTITY</th>
                        <th>STATUS</th>
                    </tr>
                    <tr></tr>
                    @foreach ($orders as $order)
                    <tr style="text-align: center">
                        <td><img src="{{ Storage::url($order->product->img_thumbnail ?? 'users/dd.jpg') }}" 
                             style="width: 70px; height: 70px" class="rounded-circle img-thumbnail"></td>
                        <td>{{ $order->product->name }}</td>
                        <td>{{ $order->product->price_sale }}</td>
                        <td>{{ $order->product->quantity }}</td>
                        <td>{{ $order->status }}</td>
                    </tr>
                    <tr>
                       <th colspan="5"> <p class="text-end">Thành tiền: <span style="color: rgb(255, 115, 0)">{{ number_format($order->total_price)}} VND</span></p>
                        <a href="{{ route('my_orders', $order->id) }}" class="float-end">Xem chi tiết</a></th>
                    </tr>
                    @endforeach
                </table> --}}
                <!-- Trang danh sách đơn hàng -->
<table style="width: 100%; text-align: center">
    <tr>
        <th>IMAGE</th>
        <th>NAME</th>
        <th>PRICE</th>
        <th>QUANTITY</th>
        <th>STATUS</th>
    </tr>
    @foreach ($orders as $order)
    <tr>
        <td><img src="{{ Storage::url($order->product->img_thumbnail ?? 'users/dd.jpg') }}" 
             style="width: 70px; height: 70px" class="rounded-circle img-thumbnail"></td>
        <td>{{ $order->product->name }}</td>
        <td>{{ number_format($order->product->price_sale) }} VND</td>
        <td>{{ $order->product->quantity }}</td>
        <td>{{ $order->status }}</td>
    </tr>
    <tr>
        <th colspan="5">
            <p class="text-end">Thành tiền: 
                <span style="color: rgb(255, 115, 0)">{{ number_format($order->total_price) }} VND</span>
            </p>
            <!-- Link để xem chi tiết -->
            <a href="javascript:void(0);" class="float-end show-details" 
               data-order-id="{{ $order->id }}">Xem chi tiết</a>
        </th>
    </tr>
    <!-- Khu vực hiển thị chi tiết đơn hàng -->
    <tr id="details-{{ $order->id }}" class="order-details" style="display: none;">
        <td colspan="5">
            <div class="card">
                <div class="card-header">
                    <h5>Chi tiết đơn hàng #{{ $order->id }}</h5>
                </div>
                <div class="card-body">
                    <p><strong>Người nhận hàng:</strong> {{ $order->user->name }}</p>
                    <p><strong>Email:</strong> {{ $order->user->email }}</p>
                    {{-- <p><strong>Số điện thoại:</strong> {{ $order->addresseses->contact_number }}</p>
                    <p><strong>Địa chỉ:</strong> {{ $order->addresses->first_name }}
                                                {{ $order->addresses->last_name }},
                                                {{ $order->addresses->addresses }},
                                                {{ $order->addresses->commune }},
                                                {{ $order->addresses->state }}, {{ $order->addresses->city }}</p> --}}
                    <p><strong>Tên sản phẩm:</strong> {{ $order->product->name }}</p>
                    <p><strong>Giá:</strong> {{ number_format($order->product->price_sale) }} VND</p>
                    <p><strong>Số lượng:</strong> {{ $order->product->quantity }}</p>
                    <p><strong>Tổng tiền:</strong> {{ number_format($order->total_price) }} VND</p>
                    <p><strong>Ngày đặt hàng:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Trạng thái:</strong> {{ $order->status }}</p>
                </div>
            </div>
        </td>
    </tr>
    @endforeach
</table>

            </div>

</div>
</div>
</div>
</div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Lấy tất cả các link "Xem chi tiết"
        const detailLinks = document.querySelectorAll('.show-details');

        // Gắn sự kiện click cho từng link
        detailLinks.forEach(link => {
            link.addEventListener('click', function () {
                const orderId = this.getAttribute('data-order-id'); // Lấy ID đơn hàng
                const detailRow = document.getElementById('details-' + orderId); // Dòng chứa chi tiết

                // Ẩn/Hiện chi tiết
                if (detailRow.style.display === 'none') {
                    detailRow.style.display = 'table-row'; // Hiển thị chi tiết
                } else {
                    detailRow.style.display = 'none'; // Ẩn chi tiết
                }
            });
        });
    });
</script>

