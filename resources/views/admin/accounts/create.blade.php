@extends('layouts.admin')

@section('content')
    <h1>Thêm tài khoản mới</h1>

    <form action="{{ route('admin.accounts.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Xác nhận mật khẩu</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Thêm tài khoản</button>
    </form>
@endsection
