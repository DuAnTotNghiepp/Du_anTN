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
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="project-title-input">Tên Sản Phẩm</label>
                                <input type="text" class="form-control" id="project-title-input" name="name"
                                    placeholder="Enter Tên Sản Phẩm">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="project-thumbnail-img">Ảnh Sản Phẩm</label>
                                <input class="form-control" id="project-thumbnail-img" name="img_thumbnail" type="file"
                                    accept="image/png, image/gif, image/jpeg">
                                <img id="imgPreview" src="" style="width: 100px; margin-top: 10px;">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ảnh liên Quan</label>
                                <div class="dropzone">
                                    <input type="file" id="product-image-input" name="image[]" multiple accept="image/png, image/gif, image/jpeg" class="form-control">
                                    <div class="preview-gallery" id="galleryPreview"></div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mô Tả Sản Phẩm</label>
                                <div id="ckeditor-classic">
                                    <textarea class="form-control" placeholder="Enter Description" name="description" id="description" rows="3"
                                        required></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3 mb-lg-0">
                                        <label for="choices-priority-input" class="form-label">Giá Thường</label>
                                        <input type="number" class="form-control" name="price_regular"
                                            id="price_regular" step="0.01" required data-provider="flatpickr"
                                            data-date-format="d M, Y">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3 mb-lg-0">
                                        <label for="choices-status-input" class="form-label">Giá Khuyến Mãi</label>
                                        <input type="number" class="form-control" name="price_sale" id="price_sale"
                                            step="0.01" required data-provider="flatpickr" data-date-format="d M, Y">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <label for="datepicker-deadline-input" class="form-label">Số Lượng</label>
                                        <input type="number" class="form-control" name="quantity" id="quantity"
                                            required data-provider="flatpickr" data-date-format="d M, Y">
                                    </div>
                                </div>
                            </div><br>

                            <div class="mb-3">
                                <label class="form-label">Hướng Dẫn Sử Dụng</label>
                                <div id="ckeditor-classic">
                                    <textarea class="form-control" placeholder="Enter User_manual" name="user_manual" id="user_manual" rows="3"
                                        required></textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nội Dung Chi Tiết</label>
                                <div id="ckeditor-classic">
                                    <textarea name="content" id="content" rows="10" cols="80"></textarea>
                                </div>
                            </div><br>
                            <div class="mb-3">
                                <div id="ckeditor-classic">
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
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    name="is_new" id="is_new">
                                                <label class="form-check-label" for="SwitchCheck3">Sản phẩm mới</label>
                                            </div>
                                            <div class="form-check form-switch form-switch-warning">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    name="is_active" id="is_active" checked>
                                                <label class="form-check-label" for="SwitchCheck4">Trạng thái hoạt
                                                    động</label>
                                            </div>
                                            <div class="form-check form-switch form-switch-danger">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    name="is_show_home" id="is_show_home">
                                                <label class="form-check-label" for="SwitchCheck5">Hiển thị trên trang
                                                    chủ</label>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->


                    <div class="text-end mb-4">
                        <button type="reset" class="btn btn-danger w-sm" id="resetButton">Reset</button>
                        <button class="btn btn-success w-sm" type="submit">Thêm sản phẩm</button>
                        <a class="btn btn-secondary w-sm" href="{{ route('product.index') }}">Quay lại trang chủ</a>
                    </div>
            </div>
            <!-- end col -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Mã Sản Phẩm</h5>
                    </div>
                    <div class="card-body">
                        <div>
                            <label class="form-label mb-0">Mã sản phẩm (SKU)</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="sku" id="sku" required>
                                <button type="button" class="btn btn-outline-secondary" id="generateSKU">Random</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Chất Liệu</h5>
                    </div>
                    <div class="card-body">
                        <div>
                            <input type="text" class="form-control" name="material" id="material" required
                                data-provider="flatpickr" data-date-format="d M, Y">
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Thuộc Tính Sản Phẩm</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="choices-categories-input" class="form-label">Màu Sắc</label>
                            @foreach ($Color as $col)
                                <input type="checkbox" value="{{$col->id}}" name="id_variant[]">
                                <div style="width: 20px; height: 20px; background-color: {{$col->value}}; display: inline-block; border: 1px solid #ccc;"></div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label for="choices-categories-input" class="form-label">Kích Thước</label>
                            @foreach ($Size as $col)
                                <input type="checkbox" value="{{$col->id}}" name="id_variant[]">
                                {{$col->value}}
                            @endforeach
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <!-- end card -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Categories</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="choices-categories-input" class="form-label">Categories</label>
                            <select name="catalogues_id" class="form-select" data-choices data-choices-search-false
                                id="choices-categories-input">
                                @foreach ($listCate as $category)
                                    <option value="{{ $category->id }}" @if ($category->id == old('catalogues_id')) selected @endif>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Title URL</h5>
                        <input type="text" id="title" name="title">
                    </div>
                    <div class="card-body">
                        <div>
                            <div>
                                <label class="form-label mb-0">URL</label>
                                <input type="text" class="form-control" name="slug" id="slug" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> © Velzon.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Design & Develop by Themesbrand
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end card -->
            </div>
            <!-- end col -->

        </div>
        <!-- end main content-->
        </form><!-- end form -->



        <!-- end main content-->
        <script>
            document.getElementById('project-thumbnail-img').addEventListener('change', function(event) {
                const [file] = event.target.files;
                if (file) {
                    document.getElementById('imgPreview').src = URL.createObjectURL(file);
                }
            });

            // Hiển thị xem trước ảnh trong bộ sưu tập
            document.getElementById('product-image-input').addEventListener('change', function(event) {
                const galleryPreview = document.getElementById('galleryPreview');
                galleryPreview.innerHTML = ''; // Xóa ảnh cũ trong gallery
                Array.from(event.target.files).forEach(file => {
                    const imgElement = document.createElement('img');
                    imgElement.src = URL.createObjectURL(file);
                    imgElement.classList.add('preview-img');
                    galleryPreview.appendChild(imgElement);
                });
            });
            document.getElementById('generateSKU').addEventListener('click', function() {
                // Hàm sinh mã SKU ngẫu nhiên gồm 8 ký tự chữ và số, viết hoa
                function generateRandomSKU(length = 8) {
                    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                    let sku = '';
                    for (let i = 0; i < length; i++) {
                        sku += chars.charAt(Math.floor(Math.random() * chars.length));
                    }
                    return sku;
                }

                // Gán giá trị SKU vào input
                document.getElementById('sku').value = generateRandomSKU();
            });
            // Bắt sự kiện khi chọn ảnh
            document.getElementById('project-thumbnail-img').addEventListener('change', function(event) {
                var file = event.target.files[0];
                var reader = new FileReader();

                // Đọc file ảnh
                reader.onload = function(e) {
                    // Hiển thị ảnh bằng cách thay đổi thuộc tính 'src' của img
                    document.getElementById('imgPreview').src = e.target.result;
                }

                // Kiểm tra nếu có file được chọn và là ảnh
                if (file && file.type.match('image.*')) {
                    reader.readAsDataURL(file); // Đọc dữ liệu dưới dạng URL
                }
            });
            document.getElementById('resetButton').addEventListener('click', function() {
                // Lấy tất cả các input, textarea, và select trong form
                let form = document.querySelector('form'); // Thay thế 'form' bằng id hoặc class cụ thể của form nếu cần
                let inputs = form.querySelectorAll('input, textarea, select');

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