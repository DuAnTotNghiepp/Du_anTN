<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

        public function handle($request, Closure $next, ...$guards)
    {
        $user = auth()->user();

        if ($user && !$user->is_active) {
            auth()->logout(); // Đăng xuất người dùng nếu tài khoản không hoạt động
            return redirect('/login')->withErrors(['Your account has been deactivated.']);
        }

        return $next($request);
    }

}
