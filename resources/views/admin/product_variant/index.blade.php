@extends('admin.layouts.master')

@section('title')
    Danh Sách Sản Phẩm
@endsection
@section('content')
    <!-- start page title -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Tùy chỉnh giao diện phân trang */
        .pagination-container {
            text-align: center;
            margin-top: 20px;
        }

        .pagination {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination a,
        .pagination span {
            display: inline-block;
            padding: 12px 20px;
            font-size: 18px;
            /* Tăng kích thước font */
            color: #fff;
            background-color: #007bff;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .pagination a:hover,
        .pagination span:hover {
            background-color: #0056b3;
        }

        .pagination .disabled a,
        .pagination .disabled span {
            background-color: #ddd;
            cursor: not-allowed;
        }

        .pagination .active a,
        .pagination .active span {
            background-color: #0056b3;
            color: white;
            font-weight: bold;
        }

        .pagination a {
            border: 1px solid #ccc;
        }

        .pagination span {
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        .pagination a:focus,
        .pagination span:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(38, 143, 255, 0.5);
        }
    </style>
    <div class="row">

        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Quản Lý Sản Phẩm</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Quản Lý Sản Phẩm Biến Thể</a></li>
                        <li class="breadcrumb-item active">Danh Sách Sản Phẩm Biến thể</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- Modal Xác Nhận Xóa -->
    <div class="modal fade" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                        colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px"></lord-icon>
                    <div class="mt-4 text-center">
                        <h4 class="fs-semibold">Bạn có chắc chắn muốn xóa sản phẩm này không?</h4>
                        <p class="text-muted fs-14 mb-4 pt-1">Xóa sản phẩm này sẽ xóa tất cả thông tin của sản phẩm khỏi cơ
                            sở dữ liệu.</p>
                        <div class="hstack gap-2 justify-content-center remove">
                            <button class="btn btn-link link-success fw-medium text-decoration-none"
                                data-bs-dismiss="modal">
                                <i class="ri-close-line me-1 align-middle"></i> Đóng
                            </button>
                            <button class="btn btn-danger" id="confirmDelete">Đồng ý, Xóa!</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center flex-wrap gap-2">
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
        <div class="col-xxl-12">
            <div class="card" id="contactList">
                <div class="card-header">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="search-box">
                                <input type="text" class="form-control search" id="searchInput"
                                    placeholder="Search for contact...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <div class="table-responsive table-card mb-3">
                            <table class="table align-middle table-nowrap mb-0" id="customerTable">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 50px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkAll"
                                                    value="option">
                                            </div>
                                        </th>
                                        <th class="sort" data-sort="idsanpham" scope="col">ID</th>
                                        <th class="sort" data-sort="idsanpham" scope="col">Ảnh Sản Phẩm</th>
                                        <th class="sort" data-sort="idsanpham" scope="col">ID Sản Phẩm</th>
                                        <th class="sort" data-sort="company_name" scope="col">Màu Sắc</th>
                                        <th class="sort" data-sort="email_id" scope="col">Kích Thước</th>
                                        <th class="sort" data-sort="email_id" scope="col">Số Lượng</th>
                                        {{-- <th scope="col">Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($listPro as $pr)
                                        <tr>
                                            <th scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="chk_child"
                                                        value="option1">
                                                </div>
                                            </th>
                                            <td class="id" style="display:none;"><a href="javascript:void(0);"
                                                    class="fw-medium link-primary">#VZ001</a></td>
                                            <td>{{ $pr->id }}</td>
                                            <td>
                                                @if ($pr->product)
                                                    <img src="{{ Storage::url($pr->product->img_thumbnail) }}"
                                                        alt="Product Image" style="width: 50px;">
                                                    {{ $pr->product->name }}
                                            <td>{{ $pr->product->id }}</td>
                                        @else
                                            <span>N/A</span>
                                    @endif
                                    </td>
                                    <td>
                                        @if ($pr->color)
                                            <div
                                                style="width: 30px; height: 30px; border-radius: 20px; background-color: {{ $pr->color->value }}; border: 1px solid #ccc; display: inline-block;">
                                            </div>
                                        @else
                                            <span>N/A</span>
                                        @endif
                                    </td>
                                    <td>{{ $pr->size->value ?? 'N/A' }}</td>
                                    <td class="quantity">
                                        <input type="number" min="1" max="1000"
                                            class="form-control stock-input" data-id="{{ $pr->id }}"
                                            value="{{ $pr->stock }}">
                                    </td>
                                    {{-- <td>
                                        <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $pr->id }}">
                                            Xóa
                                        </button>
                                    </td> --}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-container">
                                {{ $listPro->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->

        <!--end col-->
    </div>
    <!-- end main content-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stockInputs = document.querySelectorAll('.stock-input');

            stockInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const id = this.dataset.id;
                    const stock = this.value;

                    if (stock < 0) {
                        alert('Số lượng không được nhỏ hơn 0!');
                        return;
                    }

                    // Gửi AJAX để cập nhật
                    fetch('/product-variant/update-stock', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                id,
                                stock
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Cập nhật thành công!');
                            } else {
                                alert('Đã xảy ra lỗi, vui lòng thử lại!');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Đã xảy ra lỗi, vui lòng thử lại!');
                        });
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-btn');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;

                    if (confirm('Bạn có chắc chắn muốn xóa biến thể này không?')) {
                        fetch(`/product-variant/${id}`, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert(data.message);
                                    // Xóa dòng hiện tại trong bảng
                                    this.closest('tr').remove();
                                } else {
                                    alert(data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Đã xảy ra lỗi, vui lòng thử lại!');
                            });
                    }
                });
            });
        });
    </script>

    </html>
@endsection
