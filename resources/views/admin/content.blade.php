@extends('admin.layouts.master')

@section('title')
    Dashboard
@endsection
@section('content')
    <div class="row">
        <div class="col">

            <div class="h-100">
                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1">Xin chào, AMIN!</h4>
                                <p class="text-muted mb-0">Bạn muốn làm gì hôm nau</p>
                            </div>
                            <div class="mt-3 mt-lg-0">
                                <form action="javascript:void(0);">
                                    <div class="row g-3 mb-0 align-items-center">
                                        <div class="col-sm-auto">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <label for="start-date" class="me-2">Từ ngày:</label>
                                                    <input type="date" id="start-date"
                                                        class="form-control d-inline-block w-auto" name="start-date">
                                                </div>
                                                <div class="me-3">
                                                    <label for="end-date" class="me-2">Đến ngày:</label>
                                                    <input type="date" id="end-date"
                                                        class="form-control d-inline-block w-auto" name="end-date">
                                                </div>
                                                <div>
                                                    <button class="btn btn-primary" id="filter-button">Lọc</button>
                                                </div>
                                            </div>
                                        </div>


                                        <!--end col-->
{{--                                        <div class="col-auto">--}}
{{--                                            <button type="button" class="btn btn-soft-success"><i--}}
{{--                                                    class="ri-add-circle-line align-middle me-1"></i> Add--}}
{{--                                                Product--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
                                        <!--end col-->
                                        <div class="col-auto">
                                            <button type="button"
                                                class="btn btn-soft-info btn-icon waves-effect waves-light layout-rightside-btn">
                                                <i class="ri-pulse-line"></i></button>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </form>
                            </div>
                        </div><!-- end card header -->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

                <div class="row">
                    <div class="row mt-3" id="dashboard-stats">
                        <div class="col-xl-4 col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Tổng doanh thu
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span id="income-total"
                                                    class="counter-value">0</span>đ</h4>
                                            <a href="{{ route('products.best-selling') }}" class="text-decoration-underline">Xem chi tiết</a>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-success-subtle rounded fs-3">
                                                <i class="bx bx-dollar-circle text-success"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-4 col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Số đơn hàng
                                                mới</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span id="order-count-new"
                                                    class="counter-value">0</span></h4>
                                            <a href="{{ route('orderRates.best-selling') }}"class="text-decoration-underline">Xem
                                                tất cả đơn hàng</a>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-info-subtle rounded fs-3">
                                                <i class="bx bx-shopping-bag text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-4 col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Số tài khoản
                                                mới</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span id="account-count"
                                                    class="counter-value">0</span></h4>
                                            <a href="{{ route('conversionRate.best-selling') }}" class="text-decoration-underline">Xem chi tiết</a>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-warning-subtle rounded fs-3">
                                                <i class="bx bx-user-circle text-warning"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const filterButton = document.getElementById('filter-button');
                            const accountCountElement = document.getElementById('account-count');
                            const orderCountElement = document.getElementById('order-count-new');
                            const incomeTotalElement = document.getElementById('income-total');

                            filterButton.addEventListener('click', function() {
                                const startDate = document.getElementById('start-date').value;
                                const endDate = document.getElementById('end-date').value;

                                if (startDate && endDate) {
                                    fetchStatistics(startDate, endDate);
                                } else {
                                    alert('Vui lòng chọn cả ngày bắt đầu và ngày kết thúc');
                                }
                            });

                            function fetchStatistics(startDate, endDate) {
                                fetch(`/admin/dashboard-stats?start_date=${startDate}&end_date=${endDate}`)
                                    .then(response => response.json())
                                    .then(data => {
                                        accountCountElement.textContent = data.accounts;
                                        orderCountElement.textContent = data.orders;
                                        incomeTotalElement.textContent = data.income.toFixed(2);
                                    })
                                    .catch(error => {
                                        console.error('Error fetching dashboard stats:', error);
                                    });
                            }

                            fetchStatistics('', '');
                        });
                    </script>
                    <div class="row">
                        <div class="col-xl">
                            <div class="card">
                                <div class="card-header border-0 align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Biểu đồ thu nhập</h4>
                                    <div>
                                        <button type="button" class="btn btn-soft-primary btn-sm"
                                            data-time="1Y">1Năm</button>
                                    </div>
                                </div>

{{--                    <div class="row">--}}
{{--                        <div class="col-xl-6">--}}
{{--                            <div class="card">--}}
{{--                                <div class="card-header align-items-center d-flex">--}}
{{--                                    <h4 class="card-title mb-0 flex-grow-1">Best Selling Products</h4>--}}
{{--                                    <div class="flex-shrink-0">--}}
{{--                                        <div class="dropdown card-header-dropdown">--}}
{{--                                            <a class="text-reset dropdown-btn" href="#"--}}
{{--                                               data-bs-toggle="dropdown" aria-haspopup="true"--}}
{{--                                               aria-expanded="false">--}}
{{--                                                            <span class="fw-semibold text-uppercase fs-12">Sort by:--}}
{{--                                                            </span><span class="text-muted">Today<i--}}
{{--                                                        class="mdi mdi-chevron-down ms-1"></i></span>--}}
{{--                                            </a>--}}
{{--                                            <div class="dropdown-menu dropdown-menu-end">--}}
{{--                                                <a class="dropdown-item" href="#">Today</a>--}}
{{--                                                <a class="dropdown-item" href="#">Yesterday</a>--}}
{{--                                                <a class="dropdown-item" href="#">Last 7 Days</a>--}}
{{--                                                <a class="dropdown-item" href="#">Last 30 Days</a>--}}
{{--                                                <a class="dropdown-item" href="#">This Month</a>--}}
{{--                                                <a class="dropdown-item" href="#">Last Month</a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div><!-- end card header -->--}}

{{--                                <div class="card-body">--}}
{{--                                    <div class="table-responsive table-card">--}}
{{--                                        <table--}}
{{--                                            class="table table-hover table-centered align-middle table-nowrap mb-0">--}}
{{--                                            <tbody>--}}
{{--                                            <tr>--}}
{{--                                                <td>--}}
{{--                                                    <div class="d-flex align-items-center">--}}
{{--                                                        <div class="avatar-sm bg-light rounded p-1 me-2">--}}
{{--                                                            <img--}}
{{--                                                                src="{{ asset('theme/admin/assets/images/products/img-1.png') }}"--}}
{{--                                                                alt="" class="img-fluid d-block"/>--}}
{{--                                                        </div>--}}
{{--                                                        <div>--}}
{{--                                                            <h5 class="fs-14 my-1"><a--}}
{{--                                                                    href="apps-ecommerce-product-details.html"--}}
{{--                                                                    class="text-reset">Branded T-Shirts</a></h5>--}}
{{--                                                            <span class="text-muted">24 Apr 2021</span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 my-1 fw-normal">$29.00</h5>--}}
{{--                                                    <span class="text-muted">Price</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 my-1 fw-normal">62</h5>--}}
{{--                                                    <span class="text-muted">Orders</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 my-1 fw-normal">510</h5>--}}
{{--                                                    <span class="text-muted">Stock</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 my-1 fw-normal">$1,798</h5>--}}
{{--                                                    <span class="text-muted">Amount</span>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>--}}
{{--                                                    <div class="d-flex align-items-center">--}}
{{--                                                        <div class="avatar-sm bg-light rounded p-1 me-2">--}}
{{--                                                            <img--}}
{{--                                                                src="{{ asset('theme/admin/assets/images/products/img-2.png') }}"--}}
{{--                                                                alt="" class="img-fluid d-block"/>--}}
{{--                                                        </div>--}}
{{--                                                        <div>--}}
{{--                                                            <h5 class="fs-14 my-1"><a--}}
{{--                                                                    href="apps-ecommerce-product-details.html"--}}
{{--                                                                    class="text-reset">Bentwood Chair</a></h5>--}}
{{--                                                            <span class="text-muted">19 Mar 2021</span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 my-1 fw-normal">$85.20</h5>--}}
{{--                                                    <span class="text-muted">Price</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 my-1 fw-normal">35</h5>--}}
{{--                                                    <span class="text-muted">Orders</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 my-1 fw-normal"><span--}}
{{--                                                            class="badge bg-danger-subtle text-danger">Out of stock</span>--}}
{{--                                                    </h5>--}}
{{--                                                    <span class="text-muted">Stock</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 my-1 fw-normal">$2982</h5>--}}
{{--                                                    <span class="text-muted">Amount</span>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>--}}
{{--                                                    <div class="d-flex align-items-center">--}}
{{--                                                        <div class="avatar-sm bg-light rounded p-1 me-2">--}}
{{--                                                            <img--}}
{{--                                                                src="{{ asset('theme/admin/assets/images/products/img-3.png') }}"--}}
{{--                                                                alt="" class="img-fluid d-block"/>--}}
{{--                                                        </div>--}}
{{--                                                        <div>--}}
{{--                                                            <h5 class="fs-14 my-1"><a--}}
{{--                                                                    href="apps-ecommerce-product-details.html"--}}
{{--                                                                    class="text-reset">Borosil Paper Cup</a>--}}
{{--                                                            </h5>--}}
{{--                                                            <span class="text-muted">01 Mar 2021</span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 my-1 fw-normal">$14.00</h5>--}}
{{--                                                    <span class="text-muted">Price</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 my-1 fw-normal">80</h5>--}}
{{--                                                    <span class="text-muted">Orders</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 my-1 fw-normal">749</h5>--}}
{{--                                                    <span class="text-muted">Stock</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 my-1 fw-normal">$1120</h5>--}}
{{--                                                    <span class="text-muted">Amount</span>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>--}}
{{--                                                    <div class="d-flex align-items-center">--}}
{{--                                                        <div class="avatar-sm bg-light rounded p-1 me-2">--}}
{{--                                                            <img--}}
{{--                                                                src="{{ asset('theme/admin/assets/images/products/img-4.png') }}"--}}
{{--                                                                alt="" class="img-fluid d-block"/>--}}
{{--                                                        </div>--}}
{{--                                                        <div>--}}
{{--                                                            <h5 class="fs-14 my-1"><a--}}
{{--                                                                    href="apps-ecommerce-product-details.html"--}}
{{--                                                                    class="text-reset">One Seater Sofa</a></h5>--}}
{{--                                                            <span class="text-muted">11 Feb 2021</span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 my-1 fw-normal">$127.50</h5>--}}
{{--                                                    <span class="text-muted">Price</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 my-1 fw-normal">56</h5>--}}
{{--                                                    <span class="text-muted">Orders</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 my-1 fw-normal"><span--}}
{{--                                                            class="badge bg-danger-subtle text-danger">Out of stock</span>--}}
{{--                                                    </h5>--}}
{{--                                                    <span class="text-muted">Stock</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 my-1 fw-normal">$7140</h5>--}}
{{--                                                    <span class="text-muted">Amount</span>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>--}}
{{--                                                    <div class="d-flex align-items-center">--}}
{{--                                                        <div class="avatar-sm bg-light rounded p-1 me-2">--}}
{{--                                                            <img--}}
{{--                                                                src="{{ asset('theme/admin/assets/images/products/img-5.png') }}"--}}
{{--                                                                alt="" class="img-fluid d-block"/>--}}
{{--                                                        </div>--}}
{{--                                                        <div>--}}
{{--                                                            <h5 class="fs-14 my-1"><a--}}
{{--                                                                    href="apps-ecommerce-product-details.html"--}}
{{--                                                                    class="text-reset">Stillbird Helmet</a></h5>--}}
{{--                                                            <span class="text-muted">17 Jan 2021</span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 my-1 fw-normal">$54</h5>--}}
{{--                                                    <span class="text-muted">Price</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 my-1 fw-normal">74</h5>--}}
{{--                                                    <span class="text-muted">Orders</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 my-1 fw-normal">805</h5>--}}
{{--                                                    <span class="text-muted">Stock</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 my-1 fw-normal">$3996</h5>--}}
{{--                                                    <span class="text-muted">Amount</span>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                            </tbody>--}}
{{--                                        </table>--}}
{{--                                    </div>--}}

{{--                                    <div--}}
{{--                                        class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">--}}
{{--                                        <div class="col-sm">--}}
{{--                                            <div class="text-muted">--}}
{{--                                                Showing <span class="fw-semibold">5</span> of <span--}}
{{--                                                    class="fw-semibold">25</span> Results--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-auto  mt-3 mt-sm-0">--}}
{{--                                            <ul class="pagination pagination-separated pagination-sm mb-0 justify-content-center">--}}
{{--                                                <li class="page-item disabled">--}}
{{--                                                    <a href="#" class="page-link">←</a>--}}
{{--                                                </li>--}}
{{--                                                <li class="page-item">--}}
{{--                                                    <a href="#" class="page-link">1</a>--}}
{{--                                                </li>--}}
{{--                                                <li class="page-item active">--}}
{{--                                                    <a href="#" class="page-link">2</a>--}}
{{--                                                </li>--}}
{{--                                                <li class="page-item">--}}
{{--                                                    <a href="#" class="page-link">3</a>--}}
{{--                                                </li>--}}
{{--                                                <li class="page-item">--}}
{{--                                                    <a href="#" class="page-link">→</a>--}}
{{--                                                </li>--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="col-xl-6">--}}
{{--                            <div class="card card-height-100">--}}
{{--                                <div class="card-header align-items-center d-flex">--}}
{{--                                    <h4 class="card-title mb-0 flex-grow-1">Top Sellers</h4>--}}
{{--                                    <div class="flex-shrink-0">--}}
{{--                                        <div class="dropdown card-header-dropdown">--}}
{{--                                            <a class="text-reset dropdown-btn" href="#"--}}
{{--                                               data-bs-toggle="dropdown" aria-haspopup="true"--}}
{{--                                               aria-expanded="false">--}}
{{--                                                        <span class="text-muted">Report<i--}}
{{--                                                                class="mdi mdi-chevron-down ms-1"></i></span>--}}
{{--                                            </a>--}}
{{--                                            <div class="dropdown-menu dropdown-menu-end">--}}
{{--                                                <a class="dropdown-item" href="#">Download Report</a>--}}
{{--                                                <a class="dropdown-item" href="#">Export</a>--}}
{{--                                                <a class="dropdown-item" href="#">Import</a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div><!-- end card header -->--}}

{{--                                <div class="card-body">--}}
{{--                                    <div class="table-responsive table-card">--}}
{{--                                        <table--}}
{{--                                            class="table table-centered table-hover align-middle table-nowrap mb-0">--}}
{{--                                            <tbody>--}}
{{--                                            <tr>--}}
{{--                                                <td>--}}
{{--                                                    <div class="d-flex align-items-center">--}}
{{--                                                        <div class="flex-shrink-0 me-2">--}}
{{--                                                            <img--}}
{{--                                                                src="{{ asset('theme/admin/assets/images/companies/img-1.png') }}"--}}
{{--                                                                alt="" class="avatar-sm p-2"/>--}}
{{--                                                        </div>--}}
{{--                                                        <div>--}}
{{--                                                            <h5 class="fs-14 my-1 fw-medium">--}}
{{--                                                                <a href="apps-ecommerce-seller-details.html"--}}
{{--                                                                   class="text-reset">iTest Factory</a>--}}
{{--                                                            </h5>--}}
{{--                                                            <span class="text-muted">Oliver Tyler</span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <span class="text-muted">Bags and Wallets</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <p class="mb-0">8547</p>--}}
{{--                                                    <span class="text-muted">Stock</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <span class="text-muted">$541200</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 mb-0">32%<i--}}
{{--                                                            class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i>--}}
{{--                                                    </h5>--}}
{{--                                                </td>--}}
{{--                                            </tr><!-- end -->--}}
{{--                                            <tr>--}}
{{--                                                <td>--}}
{{--                                                    <div class="d-flex align-items-center">--}}
{{--                                                        <div class="flex-shrink-0 me-2">--}}
{{--                                                            <img--}}
{{--                                                                src="{{ asset('theme/admin/assets/images/companies/img-2.png') }}"--}}
{{--                                                                alt="" class="avatar-sm p-2"/>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="flex-grow-1">--}}
{{--                                                            <h5 class="fs-14 my-1 fw-medium"><a--}}
{{--                                                                    href="apps-ecommerce-seller-details.html"--}}
{{--                                                                    class="text-reset">Digitech Galaxy</a></h5>--}}
{{--                                                            <span class="text-muted">John Roberts</span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <span class="text-muted">Watches</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <p class="mb-0">895</p>--}}
{{--                                                    <span class="text-muted">Stock</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <span class="text-muted">$75030</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 mb-0">79%<i--}}
{{--                                                            class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i>--}}
{{--                                                    </h5>--}}
{{--                                                </td>--}}
{{--                                            </tr><!-- end -->--}}
{{--                                            <tr>--}}
{{--                                                <td>--}}
{{--                                                    <div class="d-flex align-items-center">--}}
{{--                                                        <div class="flex-shrink-0 me-2">--}}
{{--                                                            <img--}}
{{--                                                                src="{{ asset('theme/admin/assets/images/companies/img-3.png') }}"--}}
{{--                                                                alt="" class="avatar-sm p-2"/>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="flex-gow-1">--}}
{{--                                                            <h5 class="fs-14 my-1 fw-medium"><a--}}
{{--                                                                    href="apps-ecommerce-seller-details.html"--}}
{{--                                                                    class="text-reset">Nesta Technologies</a>--}}
{{--                                                            </h5>--}}
{{--                                                            <span class="text-muted">Harley Fuller</span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <span class="text-muted">Bike Accessories</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <p class="mb-0">3470</p>--}}
{{--                                                    <span class="text-muted">Stock</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <span class="text-muted">$45600</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 mb-0">90%<i--}}
{{--                                                            class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i>--}}
{{--                                                    </h5>--}}
{{--                                                </td>--}}
{{--                                            </tr><!-- end -->--}}
{{--                                            <tr>--}}
{{--                                                <td>--}}
{{--                                                    <div class="d-flex align-items-center">--}}
{{--                                                        <div class="flex-shrink-0 me-2">--}}
{{--                                                            <img--}}
{{--                                                                src="{{ asset('theme/admin/assets/images/companies/img-8.png') }}"--}}
{{--                                                                alt="" class="avatar-sm p-2"/>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="flex-grow-1">--}}
{{--                                                            <h5 class="fs-14 my-1 fw-medium"><a--}}
{{--                                                                    href="apps-ecommerce-seller-details.html"--}}
{{--                                                                    class="text-reset">Zoetic Fashion</a></h5>--}}
{{--                                                            <span class="text-muted">James Bowen</span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <span class="text-muted">Clothes</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <p class="mb-0">5488</p>--}}
{{--                                                    <span class="text-muted">Stock</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <span class="text-muted">$29456</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 mb-0">40%<i--}}
{{--                                                            class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i>--}}
{{--                                                    </h5>--}}
{{--                                                </td>--}}
{{--                                            </tr><!-- end -->--}}
{{--                                            <tr>--}}
{{--                                                <td>--}}
{{--                                                    <div class="d-flex align-items-center">--}}
{{--                                                        <div class="flex-shrink-0 me-2">--}}
{{--                                                            <img--}}
{{--                                                                src="{{ asset('theme/admin/assets/images/companies/img-5.png') }}"--}}
{{--                                                                alt="" class="avatar-sm p-2"/>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="flex-grow-1">--}}
{{--                                                            <h5 class="fs-14 my-1 fw-medium">--}}
{{--                                                                <a href="apps-ecommerce-seller-details.html"--}}
{{--                                                                   class="text-reset">Meta4Systems</a>--}}
{{--                                                            </h5>--}}
{{--                                                            <span class="text-muted">Zoe Dennis</span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <span class="text-muted">Furniture</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <p class="mb-0">4100</p>--}}
{{--                                                    <span class="text-muted">Stock</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <span class="text-muted">$11260</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 mb-0">57%<i--}}
{{--                                                            class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i>--}}
{{--                                                    </h5>--}}
{{--                                                </td>--}}
{{--                                            </tr><!-- end -->--}}
{{--                                            </tbody>--}}
{{--                                        </table><!-- end table -->--}}
{{--                                    </div>--}}

{{--                                    <div--}}
{{--                                        class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">--}}
{{--                                        <div class="col-sm">--}}
{{--                                            <div class="text-muted">--}}
{{--                                                Showing <span class="fw-semibold">5</span> of <span--}}
{{--                                                    class="fw-semibold">25</span> Results--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-auto  mt-3 mt-sm-0">--}}
{{--                                            <ul class="pagination pagination-separated pagination-sm mb-0 justify-content-center">--}}
{{--                                                <li class="page-item disabled">--}}
{{--                                                    <a href="#" class="page-link">←</a>--}}
{{--                                                </li>--}}
{{--                                                <li class="page-item">--}}
{{--                                                    <a href="#" class="page-link">1</a>--}}
{{--                                                </li>--}}
{{--                                                <li class="page-item active">--}}
{{--                                                    <a href="#" class="page-link">2</a>--}}
{{--                                                </li>--}}
{{--                                                <li class="page-item">--}}
{{--                                                    <a href="#" class="page-link">3</a>--}}
{{--                                                </li>--}}
{{--                                                <li class="page-item">--}}
{{--                                                    <a href="#" class="page-link">→</a>--}}
{{--                                                </li>--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div> <!-- .card-body-->--}}
{{--                            </div> <!-- .card-->--}}
{{--                        </div> <!-- .col-->--}}
{{--                    </div> <!-- end row-->--}}

{{--                    <div class="row">--}}
{{--                        <div class="col-xl-4">--}}
{{--                            <div class="card card-height-100">--}}
{{--                                <div class="card-header align-items-center d-flex">--}}
{{--                                    <h4 class="card-title mb-0 flex-grow-1">Store Visits by Source</h4>--}}
{{--                                    <div class="flex-shrink-0">--}}
{{--                                        <div class="dropdown card-header-dropdown">--}}
{{--                                            <a class="text-reset dropdown-btn" href="#"--}}
{{--                                               data-bs-toggle="dropdown" aria-haspopup="true"--}}
{{--                                               aria-expanded="false">--}}
{{--                                                        <span class="text-muted">Report<i--}}
{{--                                                                class="mdi mdi-chevron-down ms-1"></i></span>--}}
{{--                                            </a>--}}
{{--                                            <div class="dropdown-menu dropdown-menu-end">--}}
{{--                                                <a class="dropdown-item" href="#">Download Report</a>--}}
{{--                                                <a class="dropdown-item" href="#">Export</a>--}}
{{--                                                <a class="dropdown-item" href="#">Import</a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div><!-- end card header -->--}}

{{--                                <div class="card-body">--}}
{{--                                    <div id="store-visits-source"--}}
{{--                                         data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]'--}}
{{--                                         class="apex-charts" dir="ltr"></div>--}}
{{--                                </div>--}}
{{--                            </div> <!-- .card-->--}}
{{--                        </div> <!-- .col-->--}}

{{--                        <div class="col-xl-8">--}}
{{--                            <div class="card">--}}
{{--                                <div class="card-header align-items-center d-flex">--}}
{{--                                    <h4 class="card-title mb-0 flex-grow-1">Recent Orders</h4>--}}
{{--                                    <div class="flex-shrink-0">--}}
{{--                                        <button type="button" class="btn btn-soft-info btn-sm">--}}
{{--                                            <i class="ri-file-list-3-line align-middle"></i> Generate Report--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                </div><!-- end card header -->--}}

{{--                                <div class="card-body">--}}
{{--                                    <div class="table-responsive table-card">--}}
{{--                                        <table--}}
{{--                                            class="table table-borderless table-centered align-middle table-nowrap mb-0">--}}
{{--                                            <thead class="text-muted table-light">--}}
{{--                                            <tr>--}}
{{--                                                <th scope="col">Order ID</th>--}}
{{--                                                <th scope="col">Customer</th>--}}
{{--                                                <th scope="col">Product</th>--}}
{{--                                                <th scope="col">Amount</th>--}}
{{--                                                <th scope="col">Vendor</th>--}}
{{--                                                <th scope="col">Status</th>--}}
{{--                                                <th scope="col">Rating</th>--}}
{{--                                            </tr>--}}
{{--                                            </thead>--}}
{{--                                            <tbody>--}}
{{--                                            <tr>--}}
{{--                                                <td>--}}
{{--                                                    <a href="apps-ecommerce-order-details.html"--}}
{{--                                                       class="fw-medium link-primary">#VZ2112</a>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <div class="d-flex align-items-center">--}}
{{--                                                        <div class="flex-shrink-0 me-2">--}}
{{--                                                            <img--}}
{{--                                                                src="{{ asset('theme/admin/assets/images/users/avatar-1.jpg') }}"--}}
{{--                                                                alt="" class="avatar-xs rounded-circle"/>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="flex-grow-1">Alex Smith</div>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                                <td>Clothes</td>--}}
{{--                                                <td>--}}
{{--                                                    <span class="text-success">$109.00</span>--}}
{{--                                                </td>--}}
{{--                                                <td>Zoetic Fashion</td>--}}
{{--                                                <td>--}}
{{--                                                            <span--}}
{{--                                                                class="badge bg-success-subtle text-success">Paid</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 fw-medium mb-0">5.0<span--}}
{{--                                                            class="text-muted fs-11 ms-1">(61 votes)</span></h5>--}}
{{--                                                </td>--}}
{{--                                            </tr><!-- end tr -->--}}
{{--                                            <tr>--}}
{{--                                                <td>--}}
{{--                                                    <a href="apps-ecommerce-order-details.html"--}}
{{--                                                       class="fw-medium link-primary">#VZ2111</a>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <div class="d-flex align-items-center">--}}
{{--                                                        <div class="flex-shrink-0 me-2">--}}
{{--                                                            <img--}}
{{--                                                                src="{{ asset('theme/admin/assets/images/users/avatar-2.jpg') }}"--}}
{{--                                                                alt="" class="avatar-xs rounded-circle"/>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="flex-grow-1">Jansh Brown</div>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                                <td>Kitchen Storage</td>--}}
{{--                                                <td>--}}
{{--                                                    <span class="text-success">$149.00</span>--}}
{{--                                                </td>--}}
{{--                                                <td>Micro Design</td>--}}
{{--                                                <td>--}}
{{--                                                            <span--}}
{{--                                                                class="badge bg-warning-subtle text-warning">Pending</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 fw-medium mb-0">4.5<span--}}
{{--                                                            class="text-muted fs-11 ms-1">(61 votes)</span></h5>--}}
{{--                                                </td>--}}
{{--                                            </tr><!-- end tr -->--}}
{{--                                            <tr>--}}
{{--                                                <td>--}}
{{--                                                    <a href="apps-ecommerce-order-details.html"--}}
{{--                                                       class="fw-medium link-primary">#VZ2109</a>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <div class="d-flex align-items-center">--}}
{{--                                                        <div class="flex-shrink-0 me-2">--}}
{{--                                                            <img--}}
{{--                                                                src="{{ asset('theme/admin/assets/images/users/avatar-3.jpg') }}"--}}
{{--                                                                alt="" class="avatar-xs rounded-circle"/>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="flex-grow-1">Ayaan Bowen</div>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                                <td>Bike Accessories</td>--}}
{{--                                                <td>--}}
{{--                                                    <span class="text-success">$215.00</span>--}}
{{--                                                </td>--}}
{{--                                                <td>Nesta Technologies</td>--}}
{{--                                                <td>--}}
{{--                                                            <span--}}
{{--                                                                class="badge bg-success-subtle text-success">Paid</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 fw-medium mb-0">4.9<span--}}
{{--                                                            class="text-muted fs-11 ms-1">(89 votes)</span></h5>--}}
{{--                                                </td>--}}
{{--                                            </tr><!-- end tr -->--}}
{{--                                            <tr>--}}
{{--                                                <td>--}}
{{--                                                    <a href="apps-ecommerce-order-details.html"--}}
{{--                                                       class="fw-medium link-primary">#VZ2108</a>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <div class="d-flex align-items-center">--}}
{{--                                                        <div class="flex-shrink-0 me-2">--}}
{{--                                                            <img--}}
{{--                                                                src="{{ asset('theme/admin/assets/images/users/avatar-4.jpg') }}"--}}
{{--                                                                alt="" class="avatar-xs rounded-circle"/>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="flex-grow-1">Prezy Mark</div>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                                <td>Furniture</td>--}}
{{--                                                <td>--}}
{{--                                                    <span class="text-success">$199.00</span>--}}
{{--                                                </td>--}}
{{--                                                <td>Syntyce Solutions</td>--}}
{{--                                                <td>--}}
{{--                                                            <span--}}
{{--                                                                class="badge bg-danger-subtle text-danger">Unpaid</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 fw-medium mb-0">4.3<span--}}
{{--                                                            class="text-muted fs-11 ms-1">(47 votes)</span></h5>--}}
{{--                                                </td>--}}
{{--                                            </tr><!-- end tr -->--}}
{{--                                            <tr>--}}
{{--                                                <td>--}}
{{--                                                    <a href="apps-ecommerce-order-details.html"--}}
{{--                                                       class="fw-medium link-primary">#VZ2107</a>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <div class="d-flex align-items-center">--}}
{{--                                                        <div class="flex-shrink-0 me-2">--}}
{{--                                                            <img--}}
{{--                                                                src="{{ asset('theme/admin/assets/images/users/avatar-6.jpg') }}"--}}
{{--                                                                alt="" class="avatar-xs rounded-circle"/>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="flex-grow-1">Vihan Hudda</div>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                                <td>Bags and Wallets</td>--}}
{{--                                                <td>--}}
{{--                                                    <span class="text-success">$330.00</span>--}}
{{--                                                </td>--}}
{{--                                                <td>iTest Factory</td>--}}
{{--                                                <td>--}}
{{--                                                            <span--}}
{{--                                                                class="badge bg-success-subtle text-success">Paid</span>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <h5 class="fs-14 fw-medium mb-0">4.7<span--}}
{{--                                                            class="text-muted fs-11 ms-1">(161 votes)</span>--}}
{{--                                                    </h5>--}}
{{--                                                </td>--}}
{{--                                            </tr><!-- end tr -->--}}
{{--                                            </tbody><!-- end tbody -->--}}
{{--                                        </table><!-- end table -->--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div> <!-- .card-->--}}
{{--                        </div> <!-- .col-->--}}
{{--                    </div> <!-- end row-->--}}
                                <div class="card-header p-0 border-0 bg-light-subtle">
                                    <div class="row g-0 text-center">
                                        <div class="col-6 col-sm-3">
                                            <div class="p-3 border border-dashed border-start-0">
                                                <h5 class="mb-1"><span id="revenue-total" class="counter-value"
                                                        data-target="0">0</span></h5>
                                                <p class="text-muted mb-0">Doanh thu cả năm</p>
                                            </div>
                                        </div>


                                        <div class="card-body p-0 pb-2">
                                            <div class="w-100">
                                                <div id="revenueChart"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const buttons = document.querySelectorAll('.btn');
                                    buttons.forEach(button => {
                                        button.addEventListener('click', function() {
                                            const timeRange = this.getAttribute('data-time');
                                            fetchRevenueData(timeRange);
                                        });
                                    });

                                    fetchRevenueData('1Y');
                                });

                                function fetchRevenueData(timeRange) {
                                    fetch(`/admin/revenue-stats?time=${timeRange}`)
                                        .then(response => response.json())
                                        .then(data => {
                                            const totalRevenue = data.totalRevenue;
                                            const months = data.months;
                                            const revenueData = data.revenueData;
                                            const orderData = data.orderData;

                                            document.getElementById('revenue-total').textContent = `${totalRevenue.toFixed(2)}`;
                                            renderChart(months, revenueData, orderData);
                                        })
                                        .catch(error => {
                                            console.error('Error fetching revenue data:', error);
                                        });
                                }

                                function renderChart(months, revenueData, orderData) {
                                    var options = {
                                        chart: {
                                            height: 350,
                                            type: 'bar',
                                        },
                                        plotOptions: {
                                            bar: {
                                                columnWidth: '30%',
                                                endingShape: 'rounded',
                                            },
                                        },
                                        dataLabels: {
                                            enabled: false,
                                        },
                                        series: [{
                                            name: 'Doanh thu',
                                            data: revenueData,
                                        }, {
                                            name: 'Đơn hàng',
                                            data: orderData,
                                        }],
                                        xaxis: {
                                            categories: months,
                                        },
                                        yaxis: [{
                                            labels: {
                                                formatter: function(value) {
                                                    return value; // Giữ nguyên giá trị y-axis
                                                }
                                            },
                                            title: {
                                                text: 'Revenue / Orders'
                                            }
                                        }],
                                        fill: {
                                            opacity: 1,
                                        },
                                    };

                                    var chart = new ApexCharts(document.querySelector("#revenueChart"), options);
                                    chart.render();
                                }
                            </script>


                        </div>

                    </div> <!-- end col -->


                </div>

            </div>
        @endsection

        @section('script-libs')
            <script src="{{ asset('theme/admin/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

            <!-- Vector map-->
            <script src="{{ asset('theme/admin/assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
            <script src="{{ asset('theme/admin/assets/libs/jsvectormap/maps/world-merc.js') }}"></script>

            <!--Swiper slider js-->
            <script src="{{ asset('theme/admin/assets/libs/swiper/swiper-bundle.min.js') }}"></script>

            <!-- Dashboard init -->
            <script src="{{ asset('theme/admin/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
        @endsection

        @section('script-libs')
            <link href="{{ asset('theme/admin/assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet"
                type="text/css" />
            <link href="{{ asset('theme/admin/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet"
                type="text/css" />
        @endsection
