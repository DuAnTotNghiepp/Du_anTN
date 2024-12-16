@extends('admin.layouts.master')

@section('title')
    Sửa Sản Phẩm Biến Thể
@endsection
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Thêm sản phẩm Biến Thể</title>
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
                    <h4 class="mb-sm-0">Quản Lý Sản Phẩm Biến Thể</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Quản Lý Sản Phẩm Biến Thể</a></li>
                            <li class="breadcrumb-item active">Sửa Sản Phẩm Biến Thể</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <h2>
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if(session('info'))
                <div class="alert alert-info">{{ session('info') }}</div>
            @endif

            </h2>

            <div class="col-lg-8">
                <form action="{{route('product_variant.update', ['id'=>$listPro->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="project-title-input">ID Sản Phẩm Biến Thể</label>
                                <input style="border: none" type="text" class="form-control" id="project-title-input" value="{{$listPro->product_id}}" readonly
                                    placeholder="Enter ID Sản Phẩm Biến Thể">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="project-title-input">ID Biến Thể</label>
                                <input style="border: none" type="text" class="form-control" id="project-title-input" value="{{$listPro->variants_id}}" readonly
                                    placeholder="Enter ID Biến Thể">
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div>
                                        <label for="datepicker-deadline-input" class="form-label">Số Lượng</label>
                                        <input type="number" min="1" max="1000" class="form-control" name="quantity" id="quantity" value="{{$listPro->quantity}}"
                                            data-provider="flatpickr" data-date-format="d M, Y">
                                    </div>
                                </div>
                            </div><br>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                    <div class="text-end mb-4">
                        <button class="btn btn-success w-sm" type="submit">Sửa sản phẩm Biến Thể</button>
                        <a class="btn btn-secondary w-sm" href="{{ route('product_variant.index') }}">Quay lại danh sách</a>
                    </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end main content-->
        </form><!-- end form -->

    </body>
    </html>
@endsection
