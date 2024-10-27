<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    if (Auth::check() && Auth::user()->role === User::ROLE_ADMIN) {
        return $next($request);
    }
    
    // Chuyển hướng hoặc trả về lỗi 403 cho người dùng không có quyền
    return redirect('/')->with('error', 'Bạn không có quyền truy cập'); // Hoặc trả về lỗi 403
}


}
