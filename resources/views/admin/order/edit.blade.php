@extends('admin.layouts.master')

@section('title')
    Sửa Sản Phẩm
@endsection
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Thêm sản phẩm</title>
        <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
        <!-- Thêm CSS của Select2 -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

        <!-- Thêm JavaScript của jQuery và Select2 -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    </head>
    <style>
        .preview-img {
            max-width: 100px;
            max-height: 100px;
            margin-top: 10px;
            border: 1px solid #ccc;
        }

        .preview-gallery img {
            max-width: 100px;
            max-height: 100px;
            margin: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>

    <body>
        <!-- start page title -->
        <div class="row">

            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Quản Lý Đơn Hàng</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Quản Lý Đơn Hàng</a></li>
                            <li class="breadcrumb-item active">Sửa Đơn Hàng</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <h2>
                @if (session('success'))
                    <div>
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div>
                        {{ session('error') }}
                    </div>
                @endif
            </h2>

            <div class="col-lg-8">
                <form action="{{ route('order.update', ['id' => $orde->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="project-title-input">Tên Người Dùng</label>
                                <input type="text" class="form-control" id="project-title-input" name="user_name" readonly
                                    value="{{ $orde->user_name }}" placeholder="Enter Tên Sản Phẩm" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="project-title-input">Email Người Dùng</label>
                                <input type="text" class="form-control" id="project-title-input" name="user_email" readonly
                                    value="{{ $orde->user_email }}" placeholder="Enter Tên Sản Phẩm" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="project-title-input">Số Điện Thoại</label>
                                <input type="text" class="form-control" id="project-title-input" name="user_phone" readonly
                                    value="{{ $orde->user_phone }}" placeholder="Enter Tên Sản Phẩm" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="project-title-input">Địa Chỉ</label>
                                <input type="text" class="form-control" id="project-title-input" name="user_address" readonly
                                value="{{ $orde->address->address }}, {{ $orde->address->city }}, {{ $orde->address->state }}" placeholder="Enter Tên Sản Phẩm" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="project-title-input">Giá Trị Tổng Đơn Hàng</label>
                                <input type="text" class="form-control" id="project-title-input" name="total_price" readonly
                                    value="{{ $orde->total_price }}(VND)" placeholder="Enter Tên Sản Phẩm" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ghi Chú Của Khách Hàng</label>
                                <div id="ckeditor-classic">
                                    <textarea class="form-control" readonly  readonly placeholder="Enter user_note" name="user_note" id="user_note" rows="3">{{ $orde->user_note }}</textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label>Trạng Thái Đơn Hàng</label>
                                <select name="status" class="form-control">
                                    <option value="pending" {{ $orde->status == 'pending' ? 'selected' : '' }}>Chờ Xác Nhận
                                    </option>
                                    <option value="completed" {{ $orde->status == 'completed' ? 'selected' : '' }}>Đã Xác Nhận</option>
                                    <option value="delivery" {{ $orde->status == 'delivery' ? 'selected' : '' }}>Đang Giao
                                    <option value="delivered" {{ $orde->status == 'delivered' ? 'selected' : '' }}>Đã Giao
                                    <option value="canceled" {{ $orde->status == 'canceled' ? 'selected' : '' }}>Đã Hủy
                                    </option>
                                </select>
                                @error('status')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                    <div class="text-end mb-4">
                        <button class="btn btn-success w-sm" type="submit">Cập Nhật</button>
                        <a class="btn btn-secondary w-sm" href="{{ route('order.index') }}">Quay lại danh sách</a>
                    </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end main content-->
        </form>
        <!-- end form -->

    </body>

    </html>
@endsection
