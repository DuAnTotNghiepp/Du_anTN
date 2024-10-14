<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckRoleAdminMiddleware;

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

Route::get('/', function () {
        return view('welcome');
})->name('welcome');

Route::get('login', [AuthController::class, 'showFormLogin']);
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::get('register', [AuthController::class, 'showFormRegister']);
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('password/forgot', [AuthController::class, 'showForgotPasswordForm'])->name('password.forgot');
Route::post('password/forgot', [AuthController::class, 'sendResetLinkEmail']);

Route::get('password/reset/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('password/reset', [AuthController::class, 'reset']);

Route::get('login/facebook', [AuthController::class, 'redirectToFacebook']);
Route::get('login/facebook/callback', [AuthController::class ,'handleFacebookCallback']);

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





