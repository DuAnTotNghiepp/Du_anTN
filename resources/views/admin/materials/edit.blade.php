@extends('admin.layouts.master')

@section('title')
    Sửa Chất Liệu
@endsection

@section('content')
    <div class="container">
        <h4>Sửa Chất Liệu</h4>
        <form action="{{ route('materials.update', $material->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Tên Chất Liệu</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $material->name) }}" >
                @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>

            <button type="submit" class="btn btn-primary">Cập Nhật</button>
        </form>
    </div>
@endsection
