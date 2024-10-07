@extends('admin.layouts.master')

@section('title')
    Danh Sách Sản Phẩm
@endsection
@section('content')
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <title>
            Product List
        </title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    </head>

    <body class="bg-gray-100">
        <div class="container mx-auto p-4">
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('product.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">
                    + Add Product
                </a>
                <div class="relative">
                    <input class="border border-gray-300 rounded px-4 py-2" placeholder="Search Products..."
                        type="text" />
                    <i class="fas fa-search absolute right-3 top-3 text-gray-400">
                    </i>
                </div>
            </div>
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-200">
                                #
                            </th>
                            <th class="py-2 px-4 border-b border-gray-200">
                                Product
                            </th>
                            <th class="py-2 px-4 border-b border-gray-200">
                                Giá Cố Định
                            </th>
                            <th class="py-2 px-4 border-b border-gray-200">
                                Giá Khuyến Mãi
                            </th>
                            <th class="py-2 px-4 border-b border-gray-200">
                                Số Lượng
                            </th>
                            <th class="py-2 px-4 border-b border-gray-200">
                                Mã Sản Phẩm
                            </th>
                            <th class="py-2 px-4 border-b border-gray-200">
                                Trạng Thái
                            </th>
                            <th class="py-2 px-4 border-b border-gray-200">
                                View
                            </th>
                            <th class="py-2 px-4 border-b border-gray-200">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listPro as $pr)
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    <input type="checkbox" />
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200 flex items-center">
                                    @if (!isset($pr->img_thumbnail))
                                        khong co hinh anh
                                    @else
                                        <img alt="Half Sleeve Round Neck T-Shirts" class="w-10 h-10 rounded mr-2"
                                            height="40" src="{{ Storage::url($pr->img_thumbnail) }}" width="40" />
                                    @endif
                                    <div>
                                        <div>
                                            {{ $pr->name }}
                                        </div>
                                        <div class="text-gray-500 text-sm">
                                            Category: {{ $pr->catelogues->name }}
                                        </div>
                                    </div>
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    {{ $pr->price_regular }}
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    {{ $pr->price_sale }}
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    {{ $pr->quantity }}
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    {{ $pr->sku }}
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    <span class="flex items-center">
                                        {{ $pr->is_active }}
                                    </span>
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    {{ $pr->view }}
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    <a class="btn btn-info" href="{{ route('product.edit', ['id' => $pr->id]) }}">Edit</a>
                                    <form action="{{ route('product.destroy', $pr->id) }}" method="POST"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-info" type="submit">Xóa sản phẩm</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex justify-between items-center p-4">
                    <div class="text-gray-600">
                        Showing 1 to 10 of 12 results
                    </div>
                    <div class="flex items-center">
                        <button class="bg-gray-200 text-gray-600 px-3 py-1 rounded mr-2">
                            Previous
                        </button>
                        <button class="bg-blue-500 text-white px-3 py-1 rounded">
                            1
                        </button>
                        <button class="bg-gray-200 text-gray-600 px-3 py-1 rounded ml-2">
                            2
                        </button>
                        <button class="bg-gray-200 text-gray-600 px-3 py-1 rounded ml-2">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID Sản Phẩm</th>
                <th scope="col">Tên Sản Phẩm</th>
                <th scope="col">Giá Thường</th>
                <th scope="col">Giá Khuyến Mãi</th>
                <th scope="col">Danh Mục Sản Phẩm</th>
                <th scope="col">Ảnh Sản Phẩm</th>
                <th scope="col">Số Lượng</th>
                <th scope="col">Mô Tả Sản Phẩm</th>
                <th scope="col">Nội Dung Chi Tiết</th>
                <th scope="col">Đường Dẫn URL Thân Thiện</th>
                <th scope="col">Hướng Dẫn Sử Dụng Cho Người Dùng</th>
                <th scope="col">Mã Sản Phẩm Sản Phẩm</th>
                <th scope="col">Chất Liệu Phẩm Sản Phẩm</th>
                <th scope="col">Trạng Thái</th>
                <th scope="col">Lượt Xem</th>
                <th scope="col">Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listPro as $pr)
                <tr>
                    <th scope="row">{{ $pr->id }}</th>
                    <td>{{ $pr->name }}</td>
                    <td>{{ $pr->price_regular }}</td>
                    <td>{{ $pr->price_sale }}</td>
                    <td>{{ $pr->catelogues->name }}</td>
                    <td>
                        @if (!isset($pr->img_thumbnail))
                            khong co hinh anh
                        @else
                            <img width="100px" height="100px" src="{{ Storage::url($pr->img_thumbnail) }}">
                        @endif
                    </td>
                    <td>{{ $pr->quantity }}</td>
                    <td>{{ $pr->description }}</td>
                    <td>{{ $pr->content }}</td>
                    <td>{{ $pr->slug }}</td>
                    <td>{{ $pr->user_manual }}</td>
                    <td>{{ $pr->sku }}</td>
                    <td>{{ $pr->material }}</td>
                    <td>{{ $pr->is_active }}</td>
                    <td>{{ $pr->view }}</td>
                    <td><a href="{{ route('product.edit', ['id' => $pr->id]) }}">Edit</a>
                        <form action="{{ route('product.destroy', $pr->id) }}" method="POST"
                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-info" type="submit">Xóa sản phẩm</button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
