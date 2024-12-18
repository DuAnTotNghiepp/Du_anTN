@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="d-flex align-items-center mb-3">
            <form action="{{ route('products.best-selling') }}" method="GET" class="d-flex">
                <div class="me-3">
                    <label for="start-date" class="me-2">Từ ngày:</label>
                    <input type="date" id="start-date" class="form-control d-inline-block w-auto" name="start_date"
                        value="{{ request('start_date') }}">
                </div>
                <div class="me-3">
                    <label for="end-date" class="me-2">Đến ngày:</label>
                    <input type="date" id="end-date" class="form-control d-inline-block w-auto" name="end_date"
                        value="{{ request('end_date') }}">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" id="filter-button">Lọc</button>
                </div>
            </form>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Top sản phẩm bán chạy</h4>
                </div>
                <div class="card-body">
                    <!-- Form lọc theo khoảng thời gian -->


                    <!-- Bảng hiển thị sản phẩm -->
                    <div class="table-responsive table-card">
                        <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng đặt</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($products->isEmpty())
                                    <tr>
                                        <td colspan="3" class="text-center">Không có sản phẩm nào trong khoảng thời gian
                                            này.</td>
                                    </tr>
                                @else
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-light rounded p-1 me-2">
                                                        <img src="{{ Storage::url($product->product_img_thumbnail) }}"
                                                            alt="" class="img-fluid d-block" />
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-14 my-1">
                                                            <a href="#"
                                                                class="text-reset">{{ $product->product_name }}</a>
                                                        </h5>
                                                        <span class="text-muted">{{ $product->product_sku }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal">
                                                    {{ number_format($product->product_price, 1) }} vnđ</h5>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal">{{ $product->total_orders }}</h5>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bảng top người dùng -->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Top người dùng mua nhiều nhất</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Tổng số tiền</th>
                                    <th>Tổng số đơn đặt</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($users->isEmpty())
                                    <tr>
                                        <td colspan="3" class="text-center">Không có dữ liệu nào trong khoảng thời gian
                                            này.</td>
                                    </tr>
                                @else
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                <h5 class="fs-14 my-1">{{ $user->user_email }}</h5>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal">{{ number_format($user->total_price, 1) }}
                                                    vnđ</h5>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal">{{ $user->total_orders }}</h5>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
