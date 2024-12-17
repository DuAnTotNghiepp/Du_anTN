<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.accounts.index', compact('users'));
    }
    public function getDashboardStats(Request $request)
    {
        $startDate = $request->input('start_date', now()->subMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));

        $accounts = User::whereBetween('created_at', [$startDate, $endDate])->count();
        $orders = Order::whereBetween('created_at', [$startDate, $endDate])->count();
        $income = Order::whereBetween('created_at', [$startDate, $endDate])->sum('total_price');

        return response()->json([
            'accounts' => $accounts,
            'orders' => $orders,
            'income' => $income,
        ]);
    }



    public function getRevenueStats(Request $request)
    {
        $timeRange = $request->get('time', '1Y');

        $monthsInVietnamese = [
            'Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
            'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
        ];

        $months = [];
        $revenueData = [];
        $orderCount = 0;
        $totalRevenue = 0;

        for ($i = 0; $i < 12; $i++) {
            $currentMonth = date('n', strtotime("-$i month"));
            $months[] = $monthsInVietnamese[$currentMonth - 1];

            $monthlyRevenue = Order::whereYear('created_at', date('Y', strtotime("-$i month")))
                                   ->whereMonth('created_at', date('m', strtotime("-$i month")))
                                   ->sum('total_price');
            $revenueData[] = $monthlyRevenue;

            $totalRevenue += $monthlyRevenue;

            $monthlyOrderCount = Order::whereYear('created_at', date('Y', strtotime("-$i month")))
                                      ->whereMonth('created_at', date('m', strtotime("-$i month")))
                                      ->count();
            $orderCount += $monthlyOrderCount;
        }

        return response()->json([
            'months' => array_reverse($months),
            'revenueData' => array_reverse($revenueData),
            'totalRevenue' => $totalRevenue,
            'orderCount' => $orderCount,
        ]);
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

    public function showUsers()
    {
        $users = User::all(); // Lấy tất cả người dùng (hoặc bạn có thể thêm điều kiện lọc theo trạng thái)
        return view('admin.users.index', compact('users'));
    }

    public function toggleUserStatus(User $user)
    {
        $user->is_active = !$user->is_active; // Đảo ngược trạng thái
        $user->save();

        return redirect()->route('accounts.index'); // Quay lại trang danh sách người dùng
    }
}
