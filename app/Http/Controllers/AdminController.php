<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'Tháng 1',
            'Tháng 2',
            'Tháng 3',
            'Tháng 4',
            'Tháng 5',
            'Tháng 6',
            'Tháng 7',
            'Tháng 8',
            'Tháng 9',
            'Tháng 10',
            'Tháng 11',
            'Tháng 12'
        ];

        $months = [];
        $revenueData = [];
        $orderData = [];
        $totalRevenue = 0;

        for ($i = 0; $i < 12; $i++) {
            $currentMonth = date('n', strtotime("-$i month"));
            $months[] = $monthsInVietnamese[$currentMonth - 1];

            $monthlyRevenue = Order::where('status', 'hoanthanh')
                ->whereYear('created_at', date('Y', strtotime("-$i month")))
                ->whereMonth('created_at', date('m', strtotime("-$i month")))
                ->sum('total_price');
            $revenueData[] = $monthlyRevenue;
            $totalRevenue += $monthlyRevenue;

            $monthlyOrderCount = Order::where('status', 'hoanthanh')
                ->whereYear('created_at', date('Y', strtotime("-$i month")))
                ->whereMonth('created_at', date('m', strtotime("-$i month")))
                ->count();
            $orderData[] = $monthlyOrderCount;
        }

        return response()->json([
            'months' => array_reverse($months),
            'revenueData' => array_reverse($revenueData),
            'orderData' => array_reverse($orderData),
            'totalRevenue' => $totalRevenue,
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
    public function conversionRate(Request $request)
    {
        $convertedUsers = DB::table('users')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->where('orders.status', 'paid')
            ->when($request->input('start_date'), function ($query, $startDate) {
                return $query->whereDate('orders.created_at', '>=', $startDate);
            })
            ->when($request->input('end_date'), function ($query, $endDate) {
                return $query->whereDate('orders.created_at', '<=', $endDate);
            })
            ->count();

        $totalUsers = DB::table('users')
            ->when($request->input('start_date'), function ($query, $startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($request->input('end_date'), function ($query, $endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->count();

        $conversionRate = $totalUsers ? ($convertedUsers / $totalUsers) * 100 : 0;

        return view('admin.statistical.account_conversion', compact('totalUsers', 'convertedUsers', 'conversionRate'));
    }

    public function orderRates(Request $request)
    {
        $completedOrders = DB::table('orders')
        ->where('status', 'hoanthanh')
        ->when($request->input('start_date'), function ($query, $startDate) {
            return $query->whereDate('created_at', '>=', $startDate);
        })
        ->when($request->input('end_date'), function ($query, $endDate) {
            return $query->whereDate('created_at', '<=', $endDate);
        })
        ->count();

    $canceledOrders = DB::table('orders')
        ->where('status', 'canceled')
        ->when($request->input('start_date'), function ($query, $startDate) {
            return $query->whereDate('created_at', '>=', $startDate);
        })
        ->when($request->input('end_date'), function ($query, $endDate) {
            return $query->whereDate('created_at', '<=', $endDate);
        })
        ->count();

    $totalOrders = DB::table('orders')
        ->when($request->input('start_date'), function ($query, $startDate) {
            return $query->whereDate('created_at', '>=', $startDate);
        })
        ->when($request->input('end_date'), function ($query, $endDate) {
            return $query->whereDate('created_at', '<=', $endDate);
        })
        ->count();

    $completionRate = $totalOrders ? ($completedOrders / $totalOrders) * 100 : 0;
    $cancellationRate = $totalOrders ? ($canceledOrders / $totalOrders) * 100 : 0;

    $totalCompleted = $completedOrders;
        return view('admin.statistical.statisticalcancel', compact('totalOrders', 'completedOrders', 'canceledOrders', 'completionRate', 'cancellationRate','totalCompleted'));
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
