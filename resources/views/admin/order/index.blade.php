@extends('admin.layouts.master')

@section('title')
    Danh Sách Đơn Hàng
@endsection
@section('content')
    <!-- start page title -->
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
                <h4 class="mb-sm-0">Quản Lý Đơn Hàng</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Quản Lý Đơn Hàng</a></li>
                        <li class="breadcrumb-item active">Danh Sách Đơn Hàng</li>
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
                        <h4 class="fs-semibold">Bạn có chắc chắn muốn xóa Đơn Hàng này không?</h4>
                        <p class="text-muted fs-14 mb-4 pt-1">Xóa Đơn Hàng này sẽ xóa tất cả thông tin của Đơn Hàng khỏi cơ
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
                                        <th class="" data-sort="" scope="col">ID</th>
                                        <th class="" data-sort="" scope="col">Tên Khách Hàng</th>
                                        <th class="" data-sort="" scope="col">Email</th>
                                        <th class="" data-sort="" scope="col">Số Điện Thoại</th>
                                        <th class="" data-sort="" scope="col">Tổng Giá</th>
                                        <th class="" data-sort="" scope="col">Ngày Đặt</th>
                                        <th class="" data-sort="" scope="col">Phương Thức Thanh Toán</th>
                                        <th class="" data-sort="tags" scope="col">Trạng Thái</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($data as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td class="name">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        {{ $order->user_name }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="company_name">{{ $order->user_email }}</td>
                                            <td class="company_name">{{ $order->user_phone }}</td>
                                            <td class="category_name">{{ $order->total_price }}</td>
                                            <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                                            <td class="company_name">
                                                @if($order->payment_method === 'cash')
                                                    Thanh toán khi nhận hàng
                                                @elseif($order->payment_method === 'vnpay')
                                                    Thanh toán online
                                                @endif
                                            </td>
                                            <td class="company_name">
                                                @if($order->status == 'pending')
                                                    Chờ Xác Nhận
                                                @elseif($order->status == 'completed')
                                                    Đã Xác Nhận
                                                @elseif($order->status == 'delivery')
                                                    Đang Giao Hàng
                                                @elseif($order->status == 'delivered')
                                                    Giao Hàng Thành Công
                                                @elseif($order->status == 'hoanthanh')
                                                    Đã Nhận
                                                @elseif($order->status == 'canceled')
                                                    Đã hủy
                                                @endif
                                            </td>

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
                                                                        href="{{ route('order.show', ['id' => $order->id]) }}"><i
                                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                        Show</a>
                                                                </li>
                                                                <li><a class="dropdown-item edit-item-btn"
                                                                        href="{{ route('order.edit', ['id' => $order->id]) }}"><i
                                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                        Edit</a>
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
                                {{ $data->links() }}
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
        document.addEventListener('DOMContentLoaded', function () {
            // Kiểm tra nếu trạng thái hiện tại là 'pending'
            const status = "{{ $order->status }}";
            const statusText = document.getElementById('status-text');
            const orderId = "{{ $order->id }}"; // ID của đơn hàng

            if (status === 'pending') {
                let countdown = 30 * 60; // 30 phút (1800 giây)

                // Hàm đếm ngược
                const timer = setInterval(() => {
                    countdown--;

                    if (countdown <= 0) {
                        clearInterval(timer);

                        // Cập nhật trạng thái sang 'completed' sau 30 phút
                        fetch(`/api/orders/${orderId}/update-status`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ status: 'completed' })
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    statusText.innerText = 'Đã Xác Nhận';
                                    alert('Trạng thái đã được tự động chuyển sang Đã Xác Nhận.');
                                } else {
                                    console.error('Lỗi cập nhật trạng thái:', data.message);
                                }
                            })
                            .catch(error => console.error('Lỗi:', error));
                    }
                }, 1000); // Cập nhật mỗi giây
            }
        });
    </script>
    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#customerTable tbody tr');

            rows.forEach(function(row) {
                let productName = row.querySelector('.name .flex-grow-1').textContent.toLowerCase();
                let productPrice = row.querySelector('.company_name').textContent.toLowerCase();
                let productCate = row.querySelector('.category_name').textContent.toLowerCase();
                // Kiểm tra nếu tên Đơn Hàng hoặc giá khớp với giá trị tìm kiếm
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
