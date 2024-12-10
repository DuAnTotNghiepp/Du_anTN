@extends('admin.layouts.master')

@section('title')
    Danh Sách Mã Giảm Giá
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">

        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Quản Lý Mã Giảm Giá</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Quản Lý Mã Giảm Giá</a></li>
                        <li class="breadcrumb-item active">Thêm Mã Giảm Giá</li>
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
                            <a href="{{ route('vouchers.create') }}" class="btn btn-info add-btn"><i
                                    class="ri-add-fill me-1 align-bottom"></i> Add Voucher</a>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="hstack text-nowrap gap-2">
                                <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()"><i
                                        class="ri-delete-bin-2-line"></i></button>
                                <button class="btn btn-danger"><i class="ri-filter-2-line me-1 align-bottom"></i>
                                    Filters</button>
                                <button class="btn btn-soft-success">Import</button>
                                <button type="button" id="dropdownMenuLink1" data-bs-toggle="dropdown"
                                    aria-expanded="false" class="btn btn-soft-info"><i class="ri-more-2-fill"></i></button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                    <li><a class="dropdown-item" href="#">All</a></li>
                                    <li><a class="dropdown-item" href="#">Last Week</a></li>
                                    <li><a class="dropdown-item" href="#">Last Month</a></li>
                                    <li><a class="dropdown-item" href="#">Last Year</a></li>
                                </ul>
                            </div>
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
                                <input type="text" class="form-control search" id="searchInput" placeholder="Search for contact...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <div class="col-md-auto ms-auto">
                            <div class="d-flex align-items-center gap-2">
                                <span class="text-muted">Sort by: </span>
                                <select class="form-control mb-0" data-choices data-choices-search-false
                                    id="choices-single-default">
                                    <option value="Name">Name</option>
                                    <option value="Company">Company</option>
                                    <option value="Lead">Lead</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body m-3">
                    <div>
                        <div class="table-responsive table-card mb-3">
                            <table class="table align-middle table-nowrap mb-0" id="customerTable">
                                <h1 class="text-center ">Sửa Mã Giảm Giá</h1>

                                <form action="{{ route('vouchers.update', $voucher->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="container mt-5">
                                        <div class="row">
                                            <!-- Mã Voucher -->
                                            <div class="col-md-6 mb-3">
                                                <label for="code" class="form-label">Mã Voucher</label>
                                                <input type="text" name="code" id="code" class="form-control" value="{{ $voucher->code }}" required>
                                            </div>
                                
                                            <!-- Loại Voucher -->
                                            <div class="col-md-6 mb-3">
                                                <label for="type" class="form-label">Loại Voucher</label>
                                                <select name="type" id="type" class="form-select" required>
                                                    <option value="fixed" {{ $voucher->type == 'fixed' ? 'selected' : '' }}>Cố định</option>
                                                    <option value="percent" {{ $voucher->type == 'percent' ? 'selected' : '' }}>Phần trăm</option>
                                                </select>
                                            </div>
                                
                                            <!-- Giá trị -->
                                            <div class="col-md-6 mb-3">
                                                <label for="value" class="form-label">Giá trị</label>
                                                <input type="number" name="value" id="value" class="form-control" value="{{ $voucher->value }}" required>
                                            </div>
                                
                                            <!-- Giá trị đơn hàng tối thiểu -->
                                            <div class="col-md-6 mb-3">
                                                <label for="minimum_order_value" class="form-label">Giá trị đơn hàng tối thiểu</label>
                                                <input type="number" name="minimum_order_value" id="minimum_order_value" class="form-control" 
                                                       value="{{ $voucher->minimum_order_value }}" required>
                                            </div>
                                
                                            <!-- Giới hạn sử dụng -->
                                            <div class="col-md-6 mb-3">
                                                <label for="usage_limit" class="form-label">Giới hạn sử dụng</label>
                                                <input type="number" name="usage_limit" id="usage_limit" class="form-control" 
                                                       value="{{ $voucher->usage_limit }}" required>
                                            </div>
                                
                                            <!-- Ngày bắt đầu -->
                                            <div class="col-md-6 mb-3">
                                                <label for="start_date" class="form-label">Ngày bắt đầu</label>
                                                <input type="datetime-local" name="start_date" id="start_date" class="form-control" 
                                                       value="{{ date('Y-m-d\TH:i', strtotime($voucher->start_date)) }}" required>
                                            </div>
                                
                                            <!-- Ngày kết thúc -->
                                            <div class="col-md-6 mb-3">
                                                <label for="end_date" class="form-label">Ngày kết thúc</label>
                                                <input type="datetime-local" name="end_date" id="end_date" class="form-control" 
                                                       value="{{ date('Y-m-d\TH:i', strtotime($voucher->end_date)) }}" required>
                                            </div>
                                
                                            <!-- Trạng thái -->
                                            <div class="col-md-6 mb-3">
                                                <label for="status" class="form-label">Trạng thái</label>
                                                <select name="status" id="status" class="form-select" required>
                                                    <option value="active" {{ $voucher->status == 'active' ? 'selected' : '' }}>Hoạt động</option>
                                                    <option value="expired" {{ $voucher->status == 'expired' ? 'selected' : '' }}>Hết hạn</option>
                                                    <option value="disabled" {{ $voucher->status == 'disabled' ? 'selected' : '' }}>Tắt</option>
                                                </select>
                                            </div>
                                
                                            <!-- Button Actions -->
                                            <div class="col-12 d-flex justify-content-between">
                                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                                                <a href="{{ route('vouchers.index') }}" class="btn btn-secondary">Quay lại</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                
                                
                            </table>
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                        colors="primary:#121331,secondary:#08a88a"
                                        style="width:75px;height:75px"></lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted mb-0">We've searched more than 150+ contacts We did not find any
                                        contacts for you search.</p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <div class="pagination-wrap hstack gap-2">
                                <a class="page-item pagination-prev disabled" href="#">
                                    Previous
                                </a>
                                <ul class="pagination listjs-pagination mb-0"></ul>
                                <a class="page-item pagination-next" href="#">
                                    Next
                                </a>
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
                                <form class="tablelist-form" autocomplete="off">
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
                                                                <img src="assets/images/users/user-dummy-img.jpg"
                                                                    id="customer-img"
                                                                    class="avatar-md rounded-circle object-fit-cover" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label for="name-field" class="form-label">Name</label>
                                                    <input type="text" id="customername-field" class="form-control"
                                                        placeholder="Enter name" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div>
                                                    <label for="company_name-field" class="form-label">Company
                                                        Name</label>
                                                    <input type="text" id="company_name-field" class="form-control"
                                                        placeholder="Enter company name" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div>
                                                    <label for="designation-field" class="form-label">Designation</label>
                                                    <input type="text" id="designation-field" class="form-control"
                                                        placeholder="Enter Designation" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div>
                                                    <label for="email_id-field" class="form-label">Email ID</label>
                                                    <input type="text" id="email_id-field" class="form-control"
                                                        placeholder="Enter email" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div>
                                                    <label for="phone-field" class="form-label">Phone</label>
                                                    <input type="text" id="phone-field" class="form-control"
                                                        placeholder="Enter phone no" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div>
                                                    <label for="lead_score-field" class="form-label">Lead Score</label>
                                                    <input type="text" id="lead_score-field" class="form-control"
                                                        placeholder="Enter value" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div>
                                                    <label for="taginput-choices"
                                                        class="form-label font-size-13 text-muted">Tags</label>
                                                    <select class="form-control" name="taginput-choices"
                                                        id="taginput-choices" multiple>
                                                        <option value="Lead">Lead</option>
                                                        <option value="Partner">Partner</option>
                                                        <option value="Exiting">Exiting</option>
                                                        <option value="Long-term">Long-term</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" id="add-btn">Add
                                                Contact</button>
                                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end add modal-->

                    <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" id="deleteRecord-close"
                                        data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                                </div>
                                <div class="modal-body p-5 text-center">
                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                        colors="primary:#405189,secondary:#f06548"
                                        style="width:90px;height:90px"></lord-icon>
                                    <div class="mt-4 text-center">
                                        <h4 class="fs-semibold">You are about to delete a contact ?</h4>
                                        <p class="text-muted fs-14 mb-4 pt-1">Deleting your contact will remove all of your
                                            information from our database.</p>
                                        <div class="hstack gap-2 justify-content-center remove">
                                            <button class="btn btn-link link-success fw-medium text-decoration-none"
                                                id="deleteRecord-close" data-bs-dismiss="modal"><i
                                                    class="ri-close-line me-1 align-middle"></i> Close</button>
                                            <button class="btn btn-danger" id="delete-record">Yes, Delete It!!</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end delete modal -->

                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->

        <!--end col-->
    </div>
    <!-- end main content-->
    <script>

document.getElementById('searchInput').addEventListener('input', function () {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll('#customerTable tbody tr');

    rows.forEach(function (row) {
        let productName = row.querySelector('.name .flex-grow-1').textContent.toLowerCase();
        let productPrice = row.querySelector('.company_name').textContent.toLowerCase();
        let productCate = row.querySelector('.category_name').textContent.toLowerCase();
        // Kiểm tra nếu tên sản phẩm hoặc giá khớp với giá trị tìm kiếm
        if (productName.includes(filter) || productPrice.includes(filter) || productCate.includes(filter)) {
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


