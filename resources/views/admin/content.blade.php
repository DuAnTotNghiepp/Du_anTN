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
                                <h4 class="fs-16 mb-1">Good Morning, AMIN!</h4>
                                <p class="text-muted mb-0">Here's what's happening with your store
                                    today.</p>
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
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-soft-success"><i
                                                    class="ri-add-circle-line align-middle me-1"></i> Add
                                                Product
                                            </button>
                                        </div>
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
