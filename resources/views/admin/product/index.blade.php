@extends('admin.layouts.master')

@section('title')
    Danh Sách Sản Phẩm
@endsection
@section('content')
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
    <!-- start page title -->
    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}
    <div class="row">

        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Quản Lý Sản Phẩm</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Quản Lý Sản Phẩm</a></li>
                        <li class="breadcrumb-item active">Danh Sách Sản Phẩm</li>
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
                        <div class="flex-grow-1">
                            <a href="{{ route('product.create') }}" class="btn btn-info add-btn"><i
                                    class="ri-add-fill me-1 align-bottom"></i> Add Product</a>
                        </div>
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
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <thead class="table-light">
                                    <tr>
                                        <th class="sort" data-sort="idsanpham" scope="col">ID</th>
                                        <th class="sort" data-sort="name" scope="col">Tên Sản Phẩm</th>
                                        <th class="sort" data-sort="company_name" scope="col">Giá Thường</th>
                                        <th class="sort" data-sort="email_id" scope="col">Giá Khuyến Mãi</th>
                                        <th class="sort" data-sort="category_name" scope="col">Danh Mục Sản Phẩm </th>
                                        <th class="sort" data-sort="phone" scope="col">Số Lượng</th>
                                        <th class="sort" data-sort="lead_score" scope="col">Mã Sản Phẩm</th>
                                        <th class="sort" data-sort="tags" scope="col">Trạng Thái</th>
                                        <th class="sort" data-sort="date" scope="col">View</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($listPro as $pr)
                                        <tr>
                                            <td>{{ $pr->id }}</td>
                                            <td class="name">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        @if (!isset($pr->img_thumbnail))
                                                            khong co hinh anh
                                                        @else
                                                            <img src="{{ Storage::url($pr->img_thumbnail) }}"
                                                                alt="" class="avatar-xs rounded-circle">
                                                        @endif
                                                    </div>
                                                    <div class="flex-grow-1 ms-2 name">{{ $pr->name }}</div>
                                                </div>
                                            </td>
                                            <td class="company_name">{{ $pr->price_regular }}</td>
                                            <td class="email_id">{{ $pr->price_sale }}</td>
                                            <td class="category_name">{{ $pr->catelogues->name }}</td>
                                            <td class="phone">{{ $pr->quantity }}
                                            </td>
                                            <td class="lead_score">{{ $pr->sku }}</td>
                                            <td class="tags">
                                                {{ $pr->is_active ? 'Còn hàng' : 'Hết hàng' }}
                                            </td>
                                            <td>{{ $pr->view }}</td>
                                            <td>
                                                <ul class="list-inline hstack gap-2 mb-0">
                                                    <li class="list-inline-item">
                                                        <div class="dropdown">
                                                            <button class="btn btn-soft-secondary btn-sm dropdown"
                                                                type="button" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="ri-more-fill align-middle"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a class="dropdown-item edit-item-btn"
                                                                        href="{{ route('product.edit', ['id' => $pr->id]) }}"><i
                                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                        Edit</a></li>
                                                                <li><a href="{{ url('/products/' . $pr->id . '/update-quantity') }}"
                                                                        class="btn btn-primary">
                                                                        Cập nhật số lượng
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <button class="dropdown-item delete-btn"
                                                                        data-id="{{ $pr->id }}"><i
                                                                            class="ri-delete-bin-2-line"></i> Xóa</button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
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
    </div>
    <!-- end main content-->
    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#customerTable tbody tr');

            rows.forEach(function(row) {
                let productName = row.querySelector('.name .flex-grow-1').textContent.toLowerCase();
                let productPrice = row.querySelector('.company_name').textContent.toLowerCase();
                let productCate = row.querySelector('.category_name').textContent.toLowerCase();
                // Kiểm tra nếu tên sản phẩm hoặc giá khớp với giá trị tìm kiếm
                if (productName.includes(filter) || productPrice.includes(filter) || productCate.includes(
                        filter)) {
                    row.style.display = ''; // Hiển thị nếu tên hoặc giá khớp với kết quả tìm kiếm
                } else {
                    row.style.display = 'none'; // Ẩn nếu không khớp
                }
            });
        });

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                var productId = this.getAttribute('data-id');
                var deleteModal = new bootstrap.Modal(document.getElementById('deleteRecordModal'));
                deleteModal.show();

                document.getElementById('confirmDelete').onclick = function() {
                    fetch('/admin/products/' + productId + '/destroy', {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);
                                window.location.reload(); // Reload lại trang sau khi xóa
                            } else {
                                alert('Lỗi: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Có lỗi xảy ra:', error);
                        });
                };
            });
        });
    </script>
    </html>
@endsection
