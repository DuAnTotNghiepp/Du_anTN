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
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet"/>

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

        /* Đảm bảo mỗi biến thể có một dòng riêng */
        .card-body .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            /* Khoảng cách giữa các dòng */
        }

        .card-body .form-group label {
            display: flex;
            align-items: center;
        }

        .card-body .form-group label .ml-2 {
            margin-left: 10px;
            /* Khoảng cách giữa màu sắc và kích thước */
        }

        .card-body .form-group input {
            margin-left: 10px;
            /* Khoảng cách giữa label và ô nhập liệu */
            width: 150px;
            /* Đặt độ rộng cho ô nhập liệu */
        }

        .variants-scroll {
            display: flex;
            flex-direction: column; /* Đặt các phần tử theo chiều dọc */
            max-height: 300px; /* Giới hạn chiều cao của phần cuộn */
            overflow-y: auto; /* Cho phép cuộn dọc */
            padding: 10px 0;
        }

        .variants-scroll .form-group {
            margin-bottom: 10px; /* Khoảng cách giữa các biến thể */
        }

        .variants-scroll label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
        }

        .variants-scroll input[type="checkbox"] {
            margin-right: 5px;
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
                            <label class="form-label" for="project-title-input">Tên Sản phẩm</label>
                            <input type="text" class="form-control" id="project-title-input" name="name"
                                   placeholder="Nhập Tên Sản phẩm" value="{{ old('name') }}">
                        </div>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-3">
                            <label class="form-label" for="project-thumbnail-img">Ảnh Sản Phẩm</label>
                            <input class="form-control" id="project-thumbnail-img" name="img_thumbnail" type="file"
                                   accept="image/png, image/gif, image/jpeg">
                            <img id="imgPreview" src="" style="width: 100px; margin-top: 10px;">
                        </div>
                        @error('img_thumbnail')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label class="form-label">Ảnh liên Quan</label>
                            <div class="dropzone">
                                <input type="file" id="product-image-input" name="image[]" multiple
                                       accept="image/png, image/gif, image/jpeg" class="form-control">
                                <div class="preview-gallery" id="galleryPreview"></div>
                            </div>
                            @error('image')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mô Tả Sản Phẩm</label>
                            <div id="ckeditor-classic">
                                <textarea class="form-control" placeholder="Enter Description" name="description"
                                          id="description" rows="3">{{ old('description') }}</textarea>
                            </div>
                        </div>
                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3 mb-lg-0">
                                    <label for="choices-priority-input" class="form-label">Giá Thường</label>
                                    <input type="number" class="form-control" name="price_regular" id="price_regular"
                                           step="0.01" data-provider="flatpickr" data-date-format="d M, Y"
                                           value="{{ old('price_regular') }}">
                                </div>
                                @error('price_regular')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3 mb-lg-0">
                                    <label for="choices-status-input" class="form-label">Giá Khuyến Mãi</label>
                                    <input type="number" class="form-control" name="price_sale" id="price_sale"
                                           value="{{ old('price_sale') }}">
                                    <span id="priceSaleError" style="color: red; display: none;">Giá khuyến mãi không
                                            được lớn hơn giá thường.</span>
                                </div>
                                @error('price_sale')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="mb-3">
                            <label class="form-label">Hướng Dẫn Sử Dụng</label>
                            <div id="ckeditor-classic">
                                <textarea class="form-control" placeholder="Enter User_manual" name="user_manual"
                                          id="user_manual" rows="3">{{ old('user_manual') }}</textarea>
                            </div>
                            @error('user_manual')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nội Dung Chi Tiết</label>
                            <div id="ckeditor-classic">
                                <textarea name="content" id="content" rows="10"
                                          cols="80">{{ old('content') }}</textarea>
                            </div>
                            @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <br>
                        <div class="mb-3">
                            <div id="ckeditor-classic">
                                <div class="row gy-3">
                                    <div class="col-lg-12" style="display: flex; justify-content: space-evenly;">
                                        <!-- Switches Color -->
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                   name="is_hot_deal" id="is_hot_deal">
                                            <label class="form-check-label" for="SwitchCheck1">Sản phẩm hot</label>
                                        </div>
                                        <div class="form-check form-switch form-switch-warning">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                   name="is_active" id="is_active" checked>
                                            <label class="form-check-label" for="SwitchCheck4">Trạng thái hoạt
                                                động</label>
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
                    <a class="btn btn-secondary w-sm" href="{{ route('product.index') }}">Quay lại danh sách</a>
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
                            <input type="text" class="form-control" name="sku" value="{{ old('sku') }}" id="sku">
                            <button type="button" class="btn btn-outline-secondary" id="generateSKU">Random</button>
                        </div>
                        @error('sku')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- end card -->
            {{-- <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Chất Liệu</h5>
                </div>
                <div class="card-body">
                    <div>
                        <input type="text" class="form-control" name="material" id="material" data-provider="flatpickr" data-date-format="d M, Y">
                    </div>
                    @error('material')
                        <span id="material-error" style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <!-- end card body -->
            </div> --}}
            <!-- end card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Thuộc Tính Sản Phẩm</h5>
                </div>
                <div class="card-body">
                    <!-- Thêm số lượng cho từng kết hợp màu sắc và kích thước -->
                    <div class="mb-3">
                        <label for="stock" class="form-label">Số lượng cho từng biến thể</label>
                        @error('selected_variants')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="variants-scroll">

                            @foreach ($Color as $color)
                                @foreach ($Size as $size)
                                    <div class="form-group">
                                        <label>
                                            <input style="width: 20px; height: 20px;" type="checkbox"
                                                   class="form-check-input"
                                                   name="selected_variants[{{ $color->id }}][{{ $size->id }}]"
                                                  >
                                            <div
                                                style="width: 20px; height: 20px; border-radius: 10px; background-color: {{ $color->value }}; display: inline-block; border: 1px solid #ccc;"></div>
                                            - {{ $size->value }}
                                        </label>
                                        <input type="number" class="form-control stock-input"
                                               name="stock[{{ $color->id }}][{{ $size->id }}]" min="1"
                                               placeholder="Số lượng sản phẩm" disabled/>
                                    </div>

                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">

                <div class="card-body">
                    <div class="mb-3">
                        <label for="choices-categories-input" class="form-label">Danh mục</label>
                        <select name="catalogues_id" class="form-select" data-choices data-choices-search-false
                                id="choices-categories-input">
                            @foreach ($listCate as $category)
                                <option value="{{ $category->id }}"
                                        @if ($category->id == old('catalogues_id')) selected @endif>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('catalogues_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- end card body -->
            </div>
            <div class="card">

                <div class="card-body">

                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="material_id">Chất liệu</label>
                                <select name="material_id" class="form-select" data-choices data-choices-search-false
                                        id="choices-categories-input">
                                    <option value="" disabled selected>Chọn chất liệu</option>
                                    @foreach ($materials as $material)
                                        <option value="{{ $material->id }}"
                                                @if (old('material_id') == $material->id) selected @endif>
                                            {{ $material->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('material_id')
                        <span id="material-error" style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- end card -->


            <!-- end card -->
        </div>
        <!-- end col -->


    </div>
    <!-- end main content-->
    </form><!-- end form -->



    <!-- end main content-->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Lấy tất cả các checkbox
            const checkboxes = document.querySelectorAll('.form-check-input');

            checkboxes.forEach(checkbox => {
                // Thêm sự kiện change cho từng checkbox
                checkbox.addEventListener('change', function () {
                    const parent = this.closest('.form-group'); // Tìm phần tử cha chứa cả checkbox và input
                    const stockInput = parent.querySelector('.stock-input'); // Lấy input số lượng

                    if (this.checked) {
                        // Nếu checkbox được chọn, kích hoạt input và focus
                        stockInput.disabled = false;
                        stockInput.value = ''; // Đặt giá trị mặc định là rỗng
                        stockInput.focus();
                    } else {
                        // Nếu checkbox bỏ chọn, vô hiệu hóa input và xóa giá trị
                        stockInput.disabled = true;
                        stockInput.value = '';
                    }
                });
            });
        });

    </script>

    <script>
        document.getElementById('project-thumbnail-img').addEventListener('change', function (event) {
            const [file] = event.target.files;
            if (file) {
                document.getElementById('imgPreview').src = URL.createObjectURL(file);
            }
        });

        // Hiển thị xem trước ảnh trong bộ sưu tập
        document.getElementById('product-image-input').addEventListener('change', function (event) {
            const galleryPreview = document.getElementById('galleryPreview');
            galleryPreview.innerHTML = ''; // Xóa ảnh cũ trong gallery
            Array.from(event.target.files).forEach(file => {
                const imgElement = document.createElement('img');
                imgElement.src = URL.createObjectURL(file);
                imgElement.classList.add('preview-img');
                galleryPreview.appendChild(imgElement);
            });
        });
        document.getElementById('generateSKU').addEventListener('click', function () {
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
        document.getElementById('project-thumbnail-img').addEventListener('change', function (event) {
            var file = event.target.files[0];
            var reader = new FileReader();

            // Đọc file ảnh
            reader.onload = function (e) {
                // Hiển thị ảnh bằng cách thay đổi thuộc tính 'src' của img
                document.getElementById('imgPreview').src = e.target.result;
            }

            // Kiểm tra nếu có file được chọn và là ảnh
            if (file && file.type.match('image.*')) {
                reader.readAsDataURL(file); // Đọc dữ liệu dưới dạng URL
            }
        });
        document.getElementById('resetButton').addEventListener('click', function () {
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
        document.getElementById('price_sale').addEventListener('input', function () {
            var priceRegular = parseFloat(document.getElementById('price_regular').value);
            var priceSale = parseFloat(this.value);
            var priceSaleError = document.getElementById('priceSaleError');

            if (priceSale > priceRegular) {
                priceSaleError.style.display = 'block';
                this.classList.add('is-invalid'); // Thêm class 'is-invalid' để highlight input
            } else {
                priceSaleError.style.display = 'none';
                this.classList.remove('is-invalid');
            }
        });
    </script>
    <script>
        var nameInput = document.getElementById('project-title-input');
        var nameError = document.querySelector('#project-title-input + span'); // Tìm element span kế tiếp của input

        nameInput.addEventListener('input', function () {
            if (this.value.trim() === '') {
                nameError.style.display = 'block';
                this.classList.add('is-invalid');
            } else {
                nameError.style.display = 'none';
                this.classList.remove('is-invalid');
            }
        });

        nameInput.addEventListener('focus', function () {
            if (this.value.trim() === '') {
                nameError.style.display = 'block';
                this.classList.add('is-invalid');
            }
        });
    </script>
    <script>
        var descriptionInput = document.getElementById('description');
        var descriptionError = document.getElementById('description-error');

        descriptionInput.addEventListener('blur', function () {
            if (this.value.trim() === '') {
                descriptionError.style.display = 'block';
            }
        });

        descriptionInput.addEventListener('focus', function () {
            descriptionError.style.display = 'none';
        });
    </script>
    <script>
        var priceRegularInput = document.getElementById('price_regular');
        var priceRegularError = document.getElementById('price-regular-error');

        priceRegularInput.addEventListener('focus', function () {
            priceRegularError.style.display = 'none';
        });
    </script>
    <script>
        var priceSaleInput = document.getElementById('price_sale');
        var priceSaleError = document.getElementById('priceSaleError');
        var priceSaleErrorSpan = document.getElementById('price-sale-error');

        priceSaleInput.addEventListener('focus', function () {
            priceSaleError.style.display = 'none';
            if (priceSaleErrorSpan) {
                priceSaleErrorSpan.style.display = 'none';
            }
        });
    </script>
    <script>
        var quantityInput = document.getElementById('quantity');
        var quantityError = document.getElementById('quantity-error');

        quantityInput.addEventListener('focus', function () {
            if (quantityError) {
                quantityError.style.display = 'none';
            }
        });
    </script>
    <script>
        var userManualInput = document.getElementById('user_manual');
        var userManualError = document.getElementById('user-manual-error');

        userManualInput.addEventListener('focus', function () {
            if (userManualError) {
                userManualError.style.display = 'none';
            }
        });

        userManualInput.addEventListener('blur', function () {
            if (userManualInput.value.trim() === '' && userManualError) {
                userManualError.style.display = 'block';
            }
        });
    </script>
    <script>
        var skuInput = document.getElementById('sku');
        var skuError = document.getElementById('sku-error');
        var generateButton = document.getElementById('generateSKU');

        skuInput.addEventListener('focus', function () {
            if (skuError) {
                skuError.style.display = 'none';
            }
        });

        skuInput.addEventListener('blur', function () {
            if (skuInput.value.trim() === '' && skuError) {
                skuError.style.display = 'block';
            }
        });

        generateButton.addEventListener('click', function () {
            if (skuError) {
                skuError.style.display = 'none';
            }
        });

        generateButton.addEventListener('focus', function () {
            if (skuError) {
                skuError.style.display = 'none';
            }
        });

        generateButton.addEventListener('blur', function () {
            if (skuInput.value.trim() === '' && skuError) {
                skuError.style.display = 'block';
            }
        });
    </script>
    <script>
        var materialInput = document.getElementById('material');
        var materialError = document.getElementById('material-error');

        materialInput.addEventListener('focus', function () {
            if (materialError) {
                materialError.style.display = 'none';
            }
        });

        materialInput.addEventListener('blur', function () {
            if (materialInput.value.trim() === '' && materialError) {
                materialError.style.display = 'block';
            }
        });

        document.addEventListener('click', function (event) {
            if (event.target.type !== 'text' && materialInput.value.trim() === '' && materialError) {
                materialError.style.display = 'block';
            }
        });
    </script>
    </body>
    </html>
@endsection
