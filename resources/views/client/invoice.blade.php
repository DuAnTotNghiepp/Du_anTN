<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa Đơn</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .invoice-container {
            background: white;
            border: 5px solid #e31e24;
            border-radius: 10px;
            padding: 20px;
            max-width: 800px;
            margin: auto;
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
        .invoice-table th, .invoice-table td {
            text-align: left;
            padding: 8px;
            border: 1px solid #ddd;
        }
        .invoice-summary {
            text-align: right;
        }
        .payment-info, .contact-info {
            margin-top: 20px;
            font-size: 14px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <div class="invoice-container">
        <div class="invoice-header">
            <h1>HÓA ĐƠN</h1>
        </div>
       
        <div class="company-logo">
            <div>
                <strong>Công ty XNK MANSTYLE</strong>
            </div>
           
            <div>
                <strong>Hóa đơn #{{ $order->id }}</strong><br>
                Ngày: {{ $order->created_at->format('d/m/Y H:i') }}
            </div>
        </div>
    
        <div class="invoice-details">
            <strong>Khách hàng:</strong> {{ $order->user->name }}<br>
            <p><strong>Email:</strong> {{ $order->user->email }}</p>
        @php
        $address = $order->user->addresses->first(); // Lấy địa chỉ đầu tiên của người dùng
            @endphp
            @if ($address)
            <p><strong>Địa chỉ:</strong>{{ $address->first_name ?? '' }} {{ $address->last_name ?? '' }},</p>
            <p>{{ $address->address ?? '' }}, {{ $address->commune ?? '' }}, {{ $address->state ?? '' }}, {{ $address->city ?? '' }}</p>
            <p><strong>Số điện thoại:</strong> {{ $address->contact_number ?? '' }}</p>
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
                            // Tính tổng tiền của từng sản phẩm
                            $totalAmount = 0;
                            $subTotal = $order->product->quantity * $order->product->price_sale;
                            $totalAmount += $subTotal; // Cộng dồn vào tổng cộng
                        @endphp
                        <tr>
                            <td>{{ $order->product->name }}</td>
                            <td>{{ $order->product->quantity }}</td>
                            <td>{{ number_format($order->product->price_sale) }} VND</td>
                            <td>{{ number_format($subTotal) }} VND</td>
                        </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="invoice-summary "><strong>Tổng cộng:</strong></td>
                        <td>{{ number_format($totalAmount) }} VND</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="invoice-summary"><strong>Thuế (0%):</strong></td>
                        <td>0đ</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="invoice-summary"><strong>TỔNG TIỀN:</strong></td>
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
        <div class="footer">
            &copy; 2025 Công ty XNK MANSTYLE. CTY thời trang số 1 Việt Nam.
        </div>
    </div>
    
    
</body>
</html>
