<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();  // Lấy tất cả tài khoản
        return view('admin.accounts.index', compact('users'));
    }

    public function create()
    {
        return view('admin.accounts.create');  // Hiển thị form tạo tài khoản mới
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),  // Mã hóa mật khẩu
        ]);

        return redirect()->route('admin.accounts')->with('success', 'Tài khoản đã được tạo.');
    }

    public function edit(User $user)
    {
        return view('admin.accounts.edit', compact('user'));  // Hiển thị form chỉnh sửa tài khoản
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,  // Mã hóa mật khẩu nếu thay đổi
        ]);

        return redirect()->route('accounts.index')->with('success', 'Tài khoản đã được cập nhật.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('accounts.index')->with('success', 'Tài khoản đã được xóa.');
    }
}
