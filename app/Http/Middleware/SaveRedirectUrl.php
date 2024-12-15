<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SaveRedirectUrl
{

    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            // Lưu URL hiện tại trước khi chuyển đến login
            session(['redirect_url' => $request->fullUrl()]);
        }
        return $next($request);
    }

}
