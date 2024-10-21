@extends('admin.layouts.master')

@section('title', 'Bình Luận cho Sản Phẩm')

@section('content')
<div class="container">
    <h1>Bình Luận cho Sản Phẩm: {{ $product->name }}</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Người Dùng</th>
                <th>Nội Dung</th>
                <th>Ngày Đăng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($product->binh_luans as $comment)
            <tr>
                <td>{{ $comment->id }}</td>
                <td>{{ $comment->user->name }}</td>
                <td>{{ $comment->noidung }}</td>
                @if ($comment->created_at)
                {{ $comment->created_at->format('d/m/Y H:i') }}
            @else
                N/A
            @endif
            
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('comment.index') }}" class="btn btn-secondary">Quay lại danh sách sản phẩm</a>
</div>
@endsection
