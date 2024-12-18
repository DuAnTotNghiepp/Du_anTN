@extends('admin.layouts.master')

@section('title')
    Danh Sách Sản Phẩm
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
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
                        <p class="text-muted fs-14 mb-4 pt-1">Xóa sản phẩm này sẽ xóa tất cả thông tin của sản phẩm khỏi
                            cơ
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
                        <button class="btn btn-info add-btn" data-bs-toggle="modal" data-bs-target="#showModal"><i
                                class="ri-add-fill me-1 align-bottom"></i> Add Contacts
                        </button>
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
                                    <th>#</th>
                                    <th class="sort" data-sort="id" scope="col">ID</th>
                                    <th class="sort" data-sort="name" scope="col">Tên</th>
                                    <th class="sort" data-sort="create_at" scope="col">Ngày tạo</th>
                                    <th class="sort" data-sort="create_at" scope="col">Trạng thái</th>


                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody class="list form-check-all">

                                @foreach ($data as $item)
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="chk_child"
                                                       value="option1">
                                            </div>
                                        </th>
                                        <td class="id" style="display:none;"><a href="javascript:void(0);"
                                                                                class="fw-medium link-primary">#VZ001</a>
                                        </td>
                                        <td class="id">{{ $item->id }}</td>
                                        <td class="name">{{ $item->name }}</td>
                                        <td class="created_at">{{ $item->created_at }}</td>
                                        <td>{!! $item->is_active
                                                ? '<span class="badge bg-primary ">Yes</span>'
                                                : '<span class="badge bg-primary ">No</span>' !!}</td>

                                        <td>
                                            @if (session('model'))
                                                @php $model = session('model'); @endphp
                                            @endif
                                            <ul class="list-inline hstack gap-2 mb-0">

                                                <li class="list-inline-item">
                                                    <div class="dropdown">
                                                        <button class="btn btn-soft-secondary btn-sm dropdown"
                                                                type="button" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                            <i class="ri-more-fill align-middle"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item view-item-btn"
                                                                   href="javascript:void(0);"><i
                                                                        class="ri-eye-fill align-bottom me-2 text-muted"></i>View</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item edit-item-btn"
                                                                   href="{{route('admin.edit',$item->id)}}"
                                                                   data-bs-toggle="moda>
                                                                    <i class=" ri-pencil-fill align-bottom me-2
                                                                   text-muted" ></i> Edit
                                                                </a>
                                                            </li>
                                                            <li><a class="dropdown-item remove-item-btn"
                                                                   data-bs-toggle="modal" href="#deleteRecordModal"><i
                                                                        class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                    Delete</a></li>
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
                                {{--                                {{ $listPro->links() }}--}}
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0">
                                <div class="modal-header bg-info-subtle p-3">
                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                            id="close-modal"></button>
                                </div>
                                <form action="{{ route('admin.store') }}" method="POST" class="tablelist-form"
                                      autocomplete="off">
                                    @csrf

                                    <div class="modal-body">
                                        <input type="hidden" id="id-field" />
                                        <div class="row g-3">
                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <div class="position-relative d-inline-block">
                                                        <div class="position-absolute  bottom-0 end-0">
                                                            <label for="customer-image-input" class="mb-0"
                                                                   data-bs-toggle="tooltip" data-bs-placement="right"
                                                                   title="Select Image">
                                                                <div class="avatar-xs cursor-pointer">
                                                                    <div
                                                                        class="avatar-title bg-light border rounded-circle text-muted">
                                                                        <i class="ri-image-fill"></i>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                            <input class="form-control d-none" value=""
                                                                   id="customer-image-input" type="file"
                                                                   accept="image/png, image/gif, image/jpeg">
                                                        </div>
                                                        <div class="avatar-lg p-1">
                                                            <div class="avatar-title bg-light rounded-circle">
                                                                <img src="{{ asset('theme/admin/assets/images/users/user-dummy-img.jpg') }}"
                                                                     id="customer-img"
                                                                     class="avatar-md rounded-circle object-fit-cover" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label for="name" class="form-label">Name</label>
                                                    <input type="text" name="name"
                                                           class="form-control" placeholder="Enter name" />
                                                    @error('name')
                                                    <span style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <input type="checkbox" name="is_active" id="is_active"
                                                           value="1" class="form-check-input"
                                                        {{ isset($item) && $item->is_active ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_active">
                                                        {{ isset($item) && $item->is_active ? 'Active' : 'Inactive' }}
                                                    </label>
                                                </div>

                                            </div>


                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close
                                            </button>
                                            <button type="submit" class="btn btn-success" id="add-btn">Add Contact
                                            </button>
                                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                        </div>
                                    </div>
                                </form>
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
        // Tìm kiếm danh mục
        document.getElementById('searchInput').addEventListener('input', function () {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#customerTable tbody tr');

            rows.forEach(function (row) {
                let categoryName = row.querySelector('.name')?.textContent.toLowerCase() || '';
                if (categoryName.includes(filter)) {
                    row.style.display = ''; // Hiển thị nếu khớp với từ khóa
                } else {
                    row.style.display = 'none'; // Ẩn nếu không khớp
                }
            });
        });

        // Xác nhận xóa danh mục
        document.querySelectorAll('.remove-item-btn').forEach(button => {
            button.addEventListener('click', function () {
                let categoryId = this.closest('tr').querySelector('.id').textContent; // Lấy ID danh mục
                let deleteModal = new bootstrap.Modal(document.getElementById('deleteRecordModal'));
                deleteModal.show();

                document.getElementById('confirmDelete').onclick = function () {
                    fetch(`/admin/categories/${categoryId}/destroy`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
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
