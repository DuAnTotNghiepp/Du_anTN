@extends('admin.layouts.master')

@section('title')
    Danh Sách Sản Phẩm
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
                    <h4 class="mb-sm-0">Quản Lý Sản Phẩm</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Quản Lý Sản Phẩm</a></li>
                            <li class="breadcrumb-item active">Thêm Sản Phẩm</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Quản Lý Sản Phẩm - Thêm Sản Phẩm</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
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
                        <form action="{{ route('product.update', ['id' => $listPro->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row gy-3">
                                <div class="col-lg-12">
                                    <div>
                                        <label class="form-label mb-0">Tên Sản Phẩm</label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{$listPro->name}}"
                                            data-provider="flatpickr" data-date-format="d M, Y">
                                    </div>
                                </div>
                                <!-- end col -->
                            </div><br>
                            <!-- end row -->
                            <div class="row gy-3">
                                <div class="col-lg-12">
                                    <div>
                                        <label class="form-label mb-0">Danh Mục Sản Phẩm</label>
                                        <select name="catalogues_id" id="catalogues_id" style="width: 100%;">
                                            @foreach ($listCate as $category)
                                                <option value="{{ $category->id }}"
                                                    @if ($category->id == $listPro->catalogues_id) selected @endif>{{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div><br>
                            <!-- end row -->
                            <div class="row gy-3">
                                <div class="col-lg-12">
                                    <div>
                                        <label class="form-label mb-0">Giá Sản Phẩm Gốc</label>
                                        <input type="number" class="form-control" name="price_regular" id="price_regular" value="{{$listPro->price_regular}}"
                                            step="0.01" required data-provider="flatpickr" data-date-format="d M, Y">
                                    </div>
                                </div>
                                <!-- end col -->
                            </div><br>
                            <!-- end row -->
                            <div class="row gy-3">
                                <div class="col-lg-12">
                                    <div>
                                        <label class="form-label mb-0">Giá Sản Phẩm Khuyến Mãi</label>
                                        <input type="number" class="form-control" name="price_sale" id="price_sale" value="{{$listPro->price_sale}}"
                                            step="0.01" required data-provider="flatpickr" data-date-format="d M, Y">
                                    </div>
                                </div>
                                <!-- end col -->
                            </div><br>
                            <!-- end row -->
                            <div class="row gy-3">
                                <div class="col-lg-12">
                                    <div>
                                        <label class="form-label mb-0">Số Lượng</label>
                                        <input type="number" class="form-control" name="quantity" id="quantity" required value="{{$listPro->quantity}}"
                                            data-provider="flatpickr" data-date-format="d M, Y">
                                    </div>
                                </div>
                                <!-- end col -->
                            </div><br>
                            <!-- end row -->
                            <div class="row gy-3">
                                <div class="col-lg-12">
                                    <div>
                                        <label class="form-label mb-0">Ảnh sản phẩm</label>
                                        <input type="file" class="form-control" name="img_thumbnail" id="img_thumbnail"
                                            data-provider="flatpickr" data-date-format="d M, Y">
                                        <img src="{{Storage::url($listPro->img_thumbnail)}}" width="100px" alt="">
                                    </div>
                                </div>
                                <!-- end col -->
                            </div><br>
                            <!-- end row -->
                            <div class="row gy-3">
                                <div class="col-lg-12">
                                    <div>
                                        <label class="form-label mb-0">Chất liệu</label>
                                        <input type="text" class="form-control" name="material" id="material" required value="{{$listPro->material}}"
                                            data-provider="flatpickr" data-date-format="d M, Y">
                                    </div>
                                </div>
                                <!-- end col -->
                            </div><br>
                            <!-- end row -->

                            <div class="row gy-3">
                                <div class="col-lg-12">
                                    <div>
                                        <label class="form-label" for="des-info-description-input">Hướng dẫn sử dụng</label>
                                        <textarea class="form-control" placeholder="Enter Description" name="user_manual" id="user_manual" rows="3" required>$listPro->user_manual</textarea>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div><br>
                            <!-- end row -->
                            <div class="row gy-3">
                                <div class="col-lg-12">
                                    <div>
                                        <label class="form-label mb-0">Mã sản phẩm (SKU)</label>
                                        <input type="text" class="form-control" name="sku" id="sku" required value="{{$listPro->sku}}">
                                    </div>
                                </div>
                                <!-- end col -->
                            </div><br>
                            <!-- end row -->
                            <div class="row gy-3">
                                <div class="col-lg-12">
                                    <div>
                                        <label for="title">Title:</label>
                                        <input type="text" id="title" name="title">
                                    </div>
                                    <div>
                                        <label class="form-label mb-0">URL</label>
                                        <input type="text" class="form-control" name="slug" id="slug" value="{{$listPro->slug}}"
                                            readonly>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div><br>
                            <!-- end row -->
                            <div class="row gy-3">
                                <div class="col-lg-12">
                                    <div>
                                        <label class="form-label" for="des-info-description-input">Mô tả Sản Phẩm</label>
                                        <textarea class="form-control" placeholder="Enter Description" name="description" id="description" rows="3" required>{{$listPro->description}}</textarea>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div><br>
                            <!-- end row -->
                            <div class="row gy-3">
                                <div class="col-lg-12">
                                    <div>
                                        <label class="form-label mb-0">Nội dung chi tiết</label>
                                        <textarea name="content" id="content" rows="10" cols="80">$listPro->content</textarea><br><br>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div><br>
                            <!-- end row -->
                            <div class="row gy-3">
                                <div class="col-lg-12"
                                    style="display: flex; justify-content: space-between; align-items: center;">
                                    <!-- Switches Color -->
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            name="is_hot_deal" id="is_hot_deal">
                                        <label class="form-check-label" for="SwitchCheck1">Sản phẩm hot</label>
                                    </div>
                                    <div class="form-check form-switch form-switch-secondary">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            name="is_good_deal" id="is_good_deal">
                                        <label class="form-check-label" for="SwitchCheck2">Sản phẩm tốt</label>
                                    </div>
                                    <div class="form-check form-switch form-switch-success">
                                        <input class="form-check-input" type="checkbox" role="switch" name="is_new"
                                            id="is_new">
                                        <label class="form-check-label" for="SwitchCheck3">Sản phẩm mới</label>
                                    </div>
                                    <div class="form-check form-switch form-switch-warning">
                                        <input class="form-check-input" type="checkbox" role="switch" name="is_active"
                                            id="is_active" checked>
                                        <label class="form-check-label" for="SwitchCheck4">Trạng thái hoạt động</label>
                                    </div>
                                    <div class="form-check form-switch form-switch-danger">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            name="is_show_home" id="is_show_home">
                                        <label class="form-check-label" for="SwitchCheck5">Hiển thị trên trang chủ</label>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div><br>
                            <!-- end row -->
                            <button class="btn btn-info" type="submit">Sửa sản phẩm</button>
                        </form><!-- end form -->

                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
            <a class="btn btn-light" href="{{ route('product.index') }}">Quay lại trang chủ</a>
            <!-- end col -->
        </div>
        <!-- end row -->

        <!-- end main content-->

        <script>
            // Tích hợp CKEditor với trường 'content'
            CKEDITOR.replace('content');
        </script>
        <script>
            function generateSlug(str) {
                // Convert to lowercase
                str = str.toLowerCase();

                // Remove accents (dấu tiếng Việt)
                str = str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");

                // Replace spaces with hyphens
                str = str.replace(/\s+/g, '-');

                // Remove all non-alphanumeric characters except hyphens
                str = str.replace(/[^\w\-]+/g, '');

                // Remove multiple hyphens
                str = str.replace(/\-\-+/g, '-');

                // Trim hyphens from the start and end of the string
                str = str.replace(/^-+/, '').replace(/-+$/, '');

                return str;
            }

            document.getElementById('title').addEventListener('input', function() {
                var title = this.value;
                var slug = generateSlug(title);
                document.getElementById('slug').value = slug;
            });
        </script>

    </body>

    </html>
@endsection
