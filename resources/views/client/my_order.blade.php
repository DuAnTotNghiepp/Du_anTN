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
                                <th>Ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá sản phẩm</th>
                                <th>TT - SL </th>
                                <th>Trạng thái</th>
                            </tr>
                            @foreach ($orders as $order)
                            @foreach ($order->order_items as $item)
                            <tr class="text-center">
                                <td><img src="{{ Storage::url($order->product->img_thumbnail ?? 'users/dd.jpg') }}" 
                                    style="width: 70px; height: 70px" class="rounded-circle img-thumbnail"></td>
                               
                                <td>
                                    <ul>
                                            <li>
                                                <strong>{{ $item->product_name }}</strong> 
                                            </li>
                                      
                                    </ul>
                                </td>
                                <td>
                                    {{ number_format($item->product_price_sale) }} VND
                                </td>
                                <td> <div class="row " style="text-align: center;" >
                                    ( {{$item->size}} /  
                                        <div class="rounded-circle" style="width: 7px; height: 20px; background-color: {{$item->color}}; border: 1px solid #000; margin-left: 5px;"></div> )
                                        - {{ $item->quantity }}
                                    </div></td>
                                @endforeach
                                <td>{{ $order->status }}</td>
                            </tr>
                         
                                <tr>
                                    <td colspan="3">
                                        @if ($order->status === 'pending')
                                            <button class="btn btn-primary" onclick="cancelOrder({{ $order->id }})">Hủy
                                                đơn hàng</button>
                                        @elseif ($order->status === 'delivered')
                                            <button class="btn btn-dark" onclick="markOrderAsReceived({{ $order->id }})">Đã nhận hàng</button>
                                        @endif
                                    </td>
                                    <td colspan="2">
                                        @php
                                            // Tính tổng tiền của từng sản phẩm
                                            $totalAmount = 0;
                                            $subTotal = $item->quantity * $item->product_price_sale;
                                            $totalAmount += $subTotal;
                                        @endphp

                                        <p class="text-end">Thành tiền:
                                            <span style="color: rgb(255, 115, 0)">{{ number_format($order->order_items->sum(fn($item) => $item->product_price_sale * $item->quantity)) }}
                                                VND</span>
                                        </p>
                                        <a href="javascript:void(0);" class="float-end show-details"
                                            data-order-id="{{ $order->id }}">Xem chi tiết</a>
                                    </td>

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
                                                    $address = $order->address; // Lấy địa chỉ từ đơn hàng
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
                                                          
                                                   @foreach ($order->order_items as $item)
                                                   @php
                                                   $totalAmount = 0;
                                                   $subTotal =
                                                       $item->quantity *
                                                       $item->product_price_sale;
                                                   $totalAmount += $subTotal;
                                               @endphp
                                                   <tr class="text-center">
                                                   <td>
                                                           <ul>
                                                                   <li>
                                                                       <strong>{{ $item->product_name }}</strong> 
                                                                   </li>
                                                             
                                                           </ul>
                                                       </td>
                                                       <td> <div class="row " style="text-align: center;" >
                                                        ( {{$item->size}} /  
                                                            <div class="rounded-circle" style="width: 7px; height: 20px; background-color: {{$item->color}}; border: 1px solid #000; margin-left: 5px;"></div> )
                                                            - {{ $item->quantity }}
                                                        </div></td>
                                                       <td>
                                                           {{ number_format($item->product_price_sale) }} VND
                                                       </td>
                                                       <td>
                                                        {{ number_format($subTotal) }} VND
                                                       </td>
                                                       </tr>
                                                       @endforeach
                                                      
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="3" class="invoice-summary "><strong>Tổng
                                                                        cộng:</strong></td>
                                                                <td>{{ number_format($order->order_items->sum(fn($item) => $item->product_price_sale * $item->quantity)) }} VND</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3" class="invoice-summary"><strong>Thuế
                                                                        (0%)
                                                                        :</strong></td>
                                                                <td>0đ</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3" class="invoice-summary"><strong>TỔNG
                                                                        TIỀN:</strong></td>
                                                                <td>{{ number_format($order->order_items->sum(fn($item) => $item->product_price_sale * $item->quantity)) }} VND</td>
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
                        <script>
                            function cancelOrder(orderId) {
                                if (confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?')) {
                                    fetch(`/orders/cancel/${orderId}`, {
                                            method: 'POST',
                                            headers: {
                                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                                'Content-Type': 'application/json',
                                            },
                                            body: JSON.stringify({})
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                alert(data.success);
                                                location.reload(); // Tải lại trang
                                            } else {
                                                alert(data.error);
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Lỗi:', error);
                                            alert('Có lỗi xảy ra khi gửi yêu cầu.');
                                        });
                                }
                            }
                        </script>
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
