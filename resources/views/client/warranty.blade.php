@extends('client.layouts.app')

@section('content')

    <form action="{{ route('search') }}" method="get">
        @csrf
        <div class="container">
            <h1>Thời gian bảo hành theo mã sản phẩm</h1>
            <input type="text" name="sku" id="productCode" placeholder="Nhập mã sản phẩm" >
            <button type="submit">Tính thời gian bảo hành</button>
        </div>
    </form>

    <!-- Hộp thông báo sẽ hiển thị kết quả -->
    <div id="warranty-notification" class="notification hidden">
        <p id="warranty-message"></p>
        <button onclick="closeNotification()">Đóng</button>
    </div>

    @if (isset($product))
        @foreach ($product->orders as $order)
            <script>
                // Sử dụng JavaScript để hiển thị thông báo
                document.addEventListener('DOMContentLoaded', function() {
                    const notification = document.getElementById('warranty-notification');
                    const messageElement = document.getElementById('warranty-message');

                    // Thiết lập nội dung thông báo
                    const warrantyDate = "{{ $order->created_at->addDays(7)->format('d-m-Y') }}";
                    messageElement.textContent = 'Mã bảo hành của bạn đến hết ngày ' + warrantyDate;

                    // Hiển thị thông báo
                    notification.classList.remove('hidden');
                });

                // Hàm để đóng thông báo
                function closeNotification() {
                    const notification = document.getElementById('warranty-notification');
                    notification.classList.add('hidden');
                }
            </script>
        @endforeach
    @elseif(isset($message))
        <p>{{ $message }}</p>
    @endif

    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .container {
            margin-top: 30px;
        }

        input {
            padding: 10px;
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            max-width: 500px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Hộp thông báo kết quả bảo hành */
        .notification {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #28a745;
            color: white;
            padding: 15px;
            margin-top: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            margin: 20px auto;
        }

        .notification.hidden {
            display: none;
        }

        .notification p {
            margin: 0;
            flex-grow: 1;
        }

        .notification button {
            background-color: #dc3545;
            border: none;
            padding: 8px 12px;
            color: white;
            cursor: pointer;
            margin-left: 15px;
            border-radius: 5px;
        }

        .notification button:hover {
            background-color: #c82333;
        }
    </style>
@endsection
