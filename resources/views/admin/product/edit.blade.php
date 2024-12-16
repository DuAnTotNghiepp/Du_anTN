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
                    <h4 class="mb-sm-0">Quản Lý Sản Phẩm</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Quản Lý Sản Phẩm</a></li>
                            <li class="breadcrumb-item active">Sửa Sản Phẩm</li>
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
                <form action="{{route('product.update', ['id'=>$listPro->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="project-title-input">Tên Sản Phẩm</label>
                                <input type="text" class="form-control" id="project-title-input" name="name" value="{{$listPro->name}}"
                                    placeholder="Enter Tên Sản Phẩm">
                                    @error('name')
                                            <span id="name-error" style="color: red">{{ $message }}</span>
                                        @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="project-thumbnail-img">Ảnh Sản Phẩm</label>
                                <input class="form-control" id="project-thumbnail-img" name="img_thumbnail" type="file"
                                    accept="image/png, image/gif, image/jpeg">
                                    <img id="imgPreview" src="{{Storage::url($listPro->img_thumbnail)}}" style="width: 100px;">
                                    @error('img_thumbnail')
                                            <span id="img_thumbnail-error" style="color: red">{{ $message }}</span>
                                        @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ảnh Liên Quan</label>
                                <div class="dropzone">
                                    <input type="file" id="product-image-input" name="image[]" multiple accept="image/png, image/gif, image/jpeg" class="form-control">
                                    <div class="preview-gallery" id="galleryPreview">
                                        @foreach($listImg as $image)
                                            <img src="{{ Storage::url($image->image) }}" style="width: 100px; margin-right: 10px;">
                                        @endforeach
                                    </div>
                                </div>
                                @error('image')
                                            <span id="image-error" style="color: red">{{ $message }}</span>
                                        @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mô Tả Sản Phẩm</label>
                                <div id="ckeditor-classic">
                                    <textarea class="form-control" placeholder="Enter Description" name="description" id="description" rows="3"
                                        >{{$listPro->description}}</textarea>
                                </div>
                                @error('description')
                                            <span id="description-error" style="color: red">{{ $message }}</span>
                                        @enderror
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3 mb-lg-0">
                                        <label for="choices-priority-input" class="form-label">Giá Thường</label>
                                        <input type="number" class="form-control" name="price_regular" id="price_regular" value="{{$listPro->price_regular}}"
                                            step="0.01"  data-provider="flatpickr" data-date-format="d M, Y">
                                    </div>
                                    @error('price_regular')
                                            <span id="price_regular-error" style="color: red">{{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3 mb-lg-0">
                                        <label for="choices-status-input" class="form-label">Giá Khuyến Mãi</label>
                                        <input type="number" class="form-control" name="price_sale" id="price_sale" value="{{$listPro->price_sale}}"
                                            step="0.01"  data-provider="flatpickr" data-date-format="d M, Y">
                                    </div>
                                    @error('price_sale')
                                            <span id="price_sale-error" style="color: red">{{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="col-lg-4">
                                    {{-- <div>
                                        <label for="datepicker-deadline-input" class="form-label">Số Lượng</label>
                                        <input type="number" class="form-control" name="quantity" id="quantity"  value="{{$listPro->quantity}}"
                                            data-provider="flatpickr" data-date-format="d M, Y">
                                    </div> --}}

                                    </div>
                                    @error('quantity')
                                            <span id="quantity-error" style="color: red">{{ $message }}</span>
                                        @enderror

                                </div>
                            </div><br>

                            <div class="mb-3">
                                <label class="form-label">Hướng Dẫn Sử Dụng</label>
                                <div id="ckeditor-classic">
                                    <textarea class="form-control" placeholder="Enter User_manual" name="user_manual" id="user_manual" rows="3"
                                        >{{$listPro->user_manual}}</textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nội Dung Chi Tiết</label>
                                <div id="ckeditor-classic">
                                    <textarea name="content" id="content" rows="10" cols="80">{{$listPro->content}}</textarea>
                                </div>
                            </div><br>
                            <div class="mb-3">
                                <div id="ckeditor-classic">
                                    <div class="row gy-3">
                                        <div class="col-lg-12"
                                            style="display: flex; justify-content: space-evenly;">
                                            <!-- Switches Color -->
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" {{ $listPro->is_hot_deal ? 'checked' : '' }}
                                                    name="is_hot_deal" id="is_hot_deal">
                                                <label class="form-check-label" for="SwitchCheck1">Sản phẩm hot</label>
                                            </div>
                                            <div class="form-check form-switch form-switch-warning">
                                                <input class="form-check-input" type="checkbox" role="switch" {{ $listPro->is_active ? 'checked' : '' }}
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
                        <button class="btn btn-success w-sm" type="submit">Sửa sản phẩm</button>
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
                                <input type="text" class="form-control" name="sku" id="sku" value="{{$listPro->sku}}" >
                                <button type="button" class="btn btn-outline-secondary" id="generateSKU">Random</button>
                            </div>
                            @error('sku')
                            <span id="sku-error" style="color: red">{{ $message }}</span>
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
                            <input type="text" class="form-control" name="material" id="material" required value="{{$listPro->material}}"
                                data-provider="flatpickr" data-date-format="d M, Y">
                        </div>
                    </div>
                    <!-- end card body -->
                </div> --}}
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Chất Liệu</h5>
                    </div>
                    <div class="card-body">
                        <div>
                            <label for="material" class="form-label">Chọn Chất Liệu</label>
                            <select name="material_id" id="material" class="form-control">
                                {{-- <option value="">Chọn chất liệu</option> --}}
                                @foreach ($materials as $material)
                                <option value="{{ $material->id }}" @if ($material->id == $listPro->material_id) selected @endif>
                                    {{ $material->name }}
                                </option>
                            @endforeach
                            </select>
                        </div>

                    </div>
                    <!-- end card body -->
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Thuộc Tính Sản Phẩm</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="choices-categories-input" class="form-label">Màu Sắc</label>
                            @foreach ($Color as $col)
                                <input type="checkbox" value="{{$col->id}}" name="id_variant[]" {{in_array($col->id,$vari_id)?'checked':''}}>
                                <div style="width: 20px; height: 20px; background-color: {{$col->value}}; display: inline-block; border: 1px solid #ccc;"></div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label for="choices-categories-input" class="form-label">Kích Thước</label>
                            @foreach ($Size as $col)
                                <input type="checkbox" value="{{$col->id}}" name="id_variant[]" {{in_array($col->id,$vari_id)?'checked':''}}>
                                {{$col->value}}
                            @endforeach
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Tags</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="choices-categories-input" class="form-label">Categories</label>
                            <select name="catalogues_id" class="form-select" data-choices data-choices-search-false
                                id="choices-categories-input">
                                @foreach ($listCate as $category)
                                    <option value="{{ $category->id }}" @if ($category->id == $listPro->catalogues_id) selected @endif>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <!-- end card -->


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
        </script>
        <script>
            // Tích hợp CKEditor với trường 'content'
            CKEDITOR.replace('content');
        </script>

    </body>

    </html>
@endsection
