@extends('admin.layouts.master')

@section('title')
    Thêm Chất Liệu
@endsection

@section('content')
    <div class="container">
        <h4>Thêm Chất Liệu Mới</h4>
        <form action="{{ route('materials.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Tên Chất Liệu</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" >
                @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>


            <button type="submit" class="btn btn-primary mt-3">Thêm Chất Liệu</button>
        </form>
    </div>
@endsection
