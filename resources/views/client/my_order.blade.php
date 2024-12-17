@extends('client.profile')

@section('content_profile')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            /* padding: 20px; */
        }

        .invoice-header {
            text-align: center;
            color: #e31e24;
            font-weight: bold;
        }

        .invoice-header h1 {
            font-size: 24px;
        }

        .company-logo {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .invoice-details {
            margin: 20px 0;
        }

        .invoice-table {
            margin: 20px 0;
        }

        .invoice-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-table th,
        .invoice-table td {
            text-align: left;
            padding: 8px;
            border: 1px solid #ddd;
        }

        .invoice-summary {
            text-align: right;
        }

        .payment-info,
        .contact-info {
            margin-top: 20px;
            font-size: 14px;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
        }
    </style>
    <div class="col-xxl-8 col-xl-8 col-lg-8">
        <div class="profile-form-wrapper">

            <div class="container mt-5">
                <div class="card">
                    <div class="card-header text-white">
                        <h5 class="mt-3">MY ORDER</h5>
                    </div>
                    <div class="card-body">
                        <table style="width: 100%;">
                            <tr class="text-center">
                                <th>IMAGE</th>
                                <th>NAME</th>
                                <th>PRICE</th>
                                <th>QUANTITY</th>
                                <th>STATUS</th>
                            </tr>
                            @foreach ($orders as $order)
                                <tr class="text-center">
                                    <td><img src="{{ Storage::url($order->product->img_thumbnail ?? 'users/dd.jpg') }}"
                                            style="width: 70px; height: 70px" class="rounded-circle img-thumbnail"></td>
                                    <td>{{ $order->product->name }}</td>
                                    <td>{{ number_format($order->product->price_sale) }} VND</td>
                                    <td>{{ $order->product->quantity }}</td>
                                    <td>{{ $order->status }}</td>
                                </tr>
                                <tr>
                                    <th colspan="5">
                                        @php
                                            // Tính tổng tiền của từng sản phẩm
                                            $totalAmount = 0;
                                            $subTotal = $order->product->quantity * $order->product->price_sale;
                                            $totalAmount += $subTotal;
                                        @endphp
                                        <p class="text-end">Thành tiền:
                                            <span style="color: rgb(255, 115, 0)">{{ number_format($totalAmount) }}
                                                VND</span>
                                        </p>
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
                                            <div class="invoice-container m-3">
                                                <div class="company-logo">
                                                    <div>
                                                        <strong>Hóa đơn #{{ $order->id }}</strong><br>
                                                        <strong>Công ty XNK MANSTYLE</strong>
                                                    </div>
                                                    <div>

                                                        <strong>Ngày:
                                                            {{ $order->created_at->format('d/m/Y H:i') }}</strong><br>
                                                        <strong>Trạng thái: {{ $order->status }}</strong>
                                                    </div>
                                                </div>

                                                <div class="invoice-details">
                                                    <strong>Khách hàng:</strong> {{ $order->user->name }}<br>
                                                    <p><strong>Email:</strong> {{ $order->user->email }}</p>
                                                    @php
                                                        $address = $order->user->addresses->first(); // Lấy địa chỉ đầu tiên của người dùng
                                                    @endphp
                                                    @if ($address)
                                                        <p><strong>Địa chỉ: </strong>{{ $address->address ?? '' }},
                                                            {{ $address->commune ?? '' }}, {{ $address->state ?? '' }},
                                                            {{ $address->city ?? '' }}</p>

                                                        <p><strong>Số điện thoại:</strong>
                                                            {{ $address->contact_number ?? '' }}</p>
                                                    @else
                                                        <p>Không có thông tin địa chỉ</p>
                                                    @endif
                                                </div>

                                                <div class="invoice-table">
                                                    <table style="width: 100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Sản phẩm</th>
                                                                <th>Số lượng/Đơn giá</th>
                                                                <th>Đơn giá</th>
                                                                <th>Thành tiền</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $totalAmount = 0;
                                                                $subTotal =
                                                                    $order->product->quantity *
                                                                    $order->product->price_sale;
                                                                $totalAmount += $subTotal;
                                                            @endphp
                                                            <tr>
                                                                <td>{{ $order->product->name }}</td>
                                                                <td>{{ $order->product->quantity }}</td>
                                                                <td>{{ number_format($order->product->price_sale) }} VND
                                                                </td>
                                                                <td>{{ number_format($subTotal) }} VND</td>
                                                            </tr>

                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="3" class="invoice-summary "><strong>Tổng
                                                                        cộng:</strong></td>
                                                                <td>{{ number_format($totalAmount) }} VND</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3" class="invoice-summary"><strong>Thuế
                                                                        (0%):</strong></td>
                                                                <td>0đ</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3" class="invoice-summary"><strong>TỔNG
                                                                        TIỀN:</strong></td>
                                                                <td>{{ number_format($totalAmount) }} VND</td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="payment-info">
                                                            <strong>Thông tin thanh toán:</strong><br>
                                                            Ngân hàng VIB<br>
                                                            Tên tài khoản: Công ty XNK MANSTYLE<br>
                                                            Số tài khoản: 123-456789-789<br>
                                                            Hạn thanh toán: 24 giờ
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="contact-info">
                                                            <strong>Thông tin liên hệ:</strong><br>
                                                            manstyle.com.vn<br>
                                                            13 P. Trịnh Văn Bô, Xuân Phương, Nam Từ Liêm, Hà Nội<br>
                                                            +84 981 725 836
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="downpdf text-center mt-5">
                                                    <a href="{{ route('my_order.invoice', $order->id) }}" class="">
                                                        Xuất Hóa Đơn
                                                    </a>
                                                </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Lấy tất cả các link "Xem chi tiết"
            const detailLinks = document.querySelectorAll('.show-details');
            // Gắn sự kiện click cho từng link
            detailLinks.forEach(link => {
                link.addEventListener('click', function() {
                    const orderId = this.getAttribute('data-order-id'); // Lấy ID đơn hàng
                    const detailRow = document.getElementById('details-' +
                    orderId); // Dòng chứa chi tiết
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
@endsection
