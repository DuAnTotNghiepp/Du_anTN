<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Catalogues;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
   public function boot(): void
   {
       //
       $data = Catalogues::all(); // Lấy danh sách danh mục
       view()->share('data', $data);
       if (auth()->check()) {
        $cartItems = Cart::where('user_id', auth()->id())->get();
        } else {
            $cartItems = collect(); // Nếu chưa đăng nhập, trả về collection rỗng
        }
        view()->share('cartItems', $cartItems);
       Paginator::useBootstrap();
   }
}
