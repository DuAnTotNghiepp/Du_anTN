<?php

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/admin', function () {
    return view('admin.content');
})->name('content');

Route::controller(ProductController::class)
    ->name('product.')
    ->prefix('admin/products/')
    ->group(function () {
        Route::get('/', 'index')
            ->name('index');
        Route::get('create', 'create')
            ->name('create');
        Route::post('store', 'store')
            ->name('store');
        Route::get('{id}/edit', 'edit')
            ->name('edit');
        Route::put('{id}/update', 'update')
            ->name('update');
        Route::delete('{id}/destroy', 'destroy')
            ->name('destroy');
    });



