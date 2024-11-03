@extends('admin.layouts.master')

@section('title')
    Danh Sách Thuộc Tính
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

    <body>
        <!-- start page title -->
        <div class="row">

            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Quản Lý Thuộc Tính Sản Phẩm</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Quản Lý Thuộc Tính Sản Phẩm</a></li>
                            <li class="breadcrumb-item active">Thêm Thuộc Tính Sản Phẩm</li>
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

            <div class="col-lg-7">
                <form action="{{ route('variant.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="project-title-input">Tên Thuộc Tính</label>
                                <select name="thuoctinh" class="form-select" id="attribute-select" data-choices data-choices-search-false>
                                    <option value="">Tùy Chọn</option>
                                    <option value="Color">Color</option>
                                    <option value="Size">Size</option>
                                </select>
                            </div>

                            <!-- Input cho kích thước -->
                            <div class="mb-3" id="size-input" style="display: none;">
                                <label class="form-label" for="size-value">Size</label>
                                <input name="size_value" type="text" class="form-control" id="size-value" placeholder="Kích Thước (M, L, XL,...)">
                            </div>

                            <!-- Input cho màu sắc -->
                            <div class="mb-3" id="color-input" style="display: none;">
                                <label class="form-label" for="color-value">Color</label>
                                <input name="color_value" type="color" class="form-control" id="color-value" placeholder="Màu Sắc">
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                    <div class="text-end mb-4">
                        <button type="reset" class="btn btn-danger w-sm" id="resetButton">Reset</button>
                        <button class="btn btn-success w-sm" type="submit">Thêm Thuộc Tính</button>
                        <a class="btn btn-secondary w-sm" href="{{ route('variant.index') }}">Quay lại Danh Sách Thuộc Tính</a>
                    </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end main content-->
        </form><!-- end form -->



        <!-- end main content-->
        <script>
            document.getElementById('attribute-select').addEventListener('change', function () {
                var sizeInput = document.getElementById('size-input');
                var colorInput = document.getElementById('color-input');

                if (this.value === 'Size') {
                    sizeInput.style.display = 'block';
                    colorInput.style.display = 'none';
                } else {
                    sizeInput.style.display = 'none';
                    colorInput.style.display = 'block';
                }
            });
        </script>
        <script>

            document.getElementById('resetButton').addEventListener('click', function() {
                // Lấy tất cả các input, textarea, và select trong form
                let form = document.querySelector('form'); // Thay thế 'form' bằng id hoặc class cụ thể của form nếu cần
                let inputs = form.querySelectorAll('input, select');

                // Xóa giá trị của tất cả các trường
                inputs.forEach(input => {
                    if (input.type === 'checkbox' || input.type === 'radio') {
                        input.checked = false; // Bỏ chọn các checkbox hoặc radio
                    } else {
                        input.value = ''; // Xóa giá trị của các input, textarea, select
                    }
                });
            });
        </script>

    </body>

    </html>
@endsection
