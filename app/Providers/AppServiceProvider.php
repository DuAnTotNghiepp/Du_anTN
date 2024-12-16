<?php

namespace App\Providers;

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
       Paginator::useBootstrap();
   }
}
