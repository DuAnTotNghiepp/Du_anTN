@extends('layouts.admin')

@section('content')
    <h1>Quản lý tài khoản</h1>
    <a href="{{ route('admin.accounts.create') }}" class="btn btn-primary">Thêm tài khoản mới</a>

    <table class="table">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Email</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('admin.accounts.edit', $user->id) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('admin.accounts.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này không?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
