@extends('client.layouts.app')

@section('content')

    <form action="{{ route('searchWarranty') }}" method="get">
        @csrf
        <div class="container">
            <h1>Thời gian bảo hành theo mã sản phẩm</h1>
            <div class="row mb-3">
                <div class="col-md-8 offset-md-2">
                    <input type="text" name="sku" id="productCode" class="form-control" placeholder="Nhập mã sản phẩm">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Tính thời gian bảo hành</button>
        </div>
    </form>

    <!-- Hộp thông báo sẽ hiển thị kết quả dưới dạng bảng -->
    @if (isset($product))
        <div class="container mt-4">
            <h2>Kết quả bảo hành</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Mã Sản Phẩm</th>
                        <th>Ngày Mua</th>
                        <th>Ngày Hết Hạn Bảo Hành</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product->orders as $order)
                        <tr>
                            <td>{{ $product->sku }}</td>
                            <td>{{ $order->created_at->format('d-m-Y') }}</td>
                            <td>{{ $order->created_at->addDays(7)->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @elseif(isset($message))
        <div class="alert alert-warning mt-4">
            {{ $message }}
        </div>
    @endif

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .container {
            margin-top: 30px;
            text-align: center;
        }

        input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
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

        /* Tùy chỉnh bảng kết quả */
        table {
            margin-top: 20px;
            width: 100%;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        th, td {
            text-align: center;
        }

        .alert {
            max-width: 600px;
            margin: 20px auto;
        }
    </style>
@endsection
