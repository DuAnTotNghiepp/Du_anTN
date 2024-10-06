@extends('admin.layouts.master')

@section('title')
    Danh Sách Sản Phẩm
@endsection
@section('content')
<a class="btn btn-light" href="{{route('product.create')}}">Them San Pham</a>
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
        @foreach($listPro as $pr)
        <tr>
            <th scope="row">{{$pr->id}}</th>
            <td>{{$pr->name}}</td>
            <td>{{$pr->price_regular}}</td>
            <td>{{$pr->price_sale}}</td>
            <td>{{$pr->catelogues->name}}</td>
            <td>
                @if (!isset($pr->img_thumbnail))
                    khong co hinh anh
                @else
                <img width="100px" height="100px" src="{{Storage::url($pr->img_thumbnail)}}">
                @endif
            </td>
            <td>{{$pr->quantity}}</td>
            <td>{{$pr->description}}</td>
            <td>{{$pr->content}}</td>
            <td>{{$pr->slug}}</td>
            <td>{{$pr->user_manual}}</td>
            <td>{{$pr->sku}}</td>
            <td>{{$pr->material}}</td>
            <td>{{$pr->is_active}}</td>
            <td>{{$pr->view}}</td>
            <td><a href="{{route('product.edit', ['id'=>$pr->id])}}">Edit</a>
                <form action="{{ route('product.destroy', $pr->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-info" type="submit">Xóa sản phẩm</button>
                </form></td>

        </tr>
        @endforeach
    </tbody>
  </table>


@endsection

