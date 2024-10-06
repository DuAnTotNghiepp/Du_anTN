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
        <th scope="col">Số Lượng Sản Phẩm</th>
        <th scope="col">Nội Dung Chi Tiết</th>
        <th scope="col">Mô Tả Sản Phẩm</th>
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
        @foreach ($listPro as $item)
        <tr>
            <th scope="row">{{$item->id}}</th>
            <td>{{$item->name}}</td>
            <td>{{$item->price}}</td>
            <td>{{$item->quantity}}</td>
            <td>
                @if (!isset($item->image))
                    khong co hinh anh
                @else
                <img width="100px" height="100px" src="{{Storage::url($item->image)}}">
                @endif
            </td>
                    <td>{{$item->loadAllCategory->name}}</td>
                    {{--<td>{{$item->catename}}</td> --}}
                    {{-- <td>{{$listCate[$item->category_id]}}</td> --}}
            <td>{{$item->status}}</td>
            <td><a href="{{route('product.edit', ['id'=>$item->id])}}">Edit</a>
                <form action="{{route('product.destroy', ['id'=>$item->id])}}" method="POST">
                    @csrf
                    @method('DELETE')
                     <button type="submit">DELETE</button>
                </form>
            </td>

          </tr>
        @endforeach

    </tbody>
  </table>
  {{$listPro->links()}}

@endsection

