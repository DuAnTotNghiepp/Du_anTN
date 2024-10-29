@extends('admin.layouts.master')


@section('title')
    Danh Sách Sản Phẩm
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">

        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Quản Lý Bình Luận</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Quản Lý Bình Luận</a></li>
                        <li class="breadcrumb-item active">Danh Sách Sản Phẩm</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->


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
                                    <th class="sort" data-sort="name" scope="col">Tên Sản Phẩm</th>
                                    <th class="sort" data-sort="lead_score" scope="col">Mã Sản Phẩm</th>
                                    <th class="sort" data-sort="date" scope="col">Số bình luận</th>
                                    <th scope="col">Action</th>
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
                                        <td class="name">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    @if (!isset($pr->img_thumbnail))
                                                        khong co hinh anh
                                                    @else
                                                        <img src="{{ Storage::url($pr->img_thumbnail) }}"
                                                            alt="" class="avatar-xs rounded-circle"  >
                                                    @endif
                                                </div>
                                                <div class="flex-grow-1 ms-2 name">{{ $pr->name }}</div>
                                            </div>
                                        </td>
                                        <td class="lead_score">{{ $pr->sku }}</td>
                                        <td>{{ $pr->binh_luans_count }} Bình Luận</td>

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
                                                            <li> <a href="{{ route('product.comments', $pr->id) }}" class="btn btn-primary">Xem Bình Luận</a></li>
                                                           


                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

   
@endsection
