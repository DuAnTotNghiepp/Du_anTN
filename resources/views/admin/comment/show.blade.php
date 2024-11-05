@extends('admin.layouts.master')

@section('title', 'Bình Luận cho Sản Phẩm')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Quản Lý Bình Luận</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Quản Lý Bình Luận</a></li>
                        <li class="breadcrumb-item active">Bình Luận cho Sản Phẩm</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- start content -->
    <div class="col-xxl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Bình Luận cho Sản Phẩm: {{ $product->name }}</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Người Dùng</th>
                                <th scope="col">Nội Dung</th>
                                <th scope="col">Ngày Đăng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product->binh_luans as $comment)
                                <tr>
                                    <td>{{ $comment->id }}</td>
                                    <td>{{ $comment->user->name }}</td>
                                    <td>{{ $comment->noidung }}</td>
                                    <td>{{ $comment->created_at ? $comment->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer">
                <a href="{{ route('comment.index') }}" class="btn btn-secondary">Quay lại danh sách sản phẩm</a>
            </div>
        </div>
    </div>
    <!-- end content -->
@endsection
