@extends('admin.layouts.master')

@section('title', 'Danh Sách Sản Phẩm và Bình Luận')

@section('content')
<div class="container">
    <h1>Danh Sách Sản Phẩm</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Sản Phẩm</th>
                <th>Số Lượng Bình Luận</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($listPro as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->binh_luans_count }} Bình Luận</td>
                <td>
                    <a href="{{ route('product.comments', $product->id) }}" class="btn btn-primary">Xem Bình Luận</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
