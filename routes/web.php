<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController as AuthAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BinhLuanController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\ProductController as ControllersProductController;
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
});

Route::get('password/forgot', [AuthAuthController::class, 'showForgotPasswordForm'])->name('password.forgot');
Route::post('password/forgot', [AuthAuthController::class, 'sendResetLinkEmail']);

Route::get('password/reset/{token}', [AuthAuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('password/reset', [AuthAuthController::class, 'reset']);

Route::get('login/facebook', [AuthAuthController::class, 'redirectToFacebook']);
Route::get('login/facebook/callback', [AuthAuthController::class ,'handleFacebookCallback']);

Route::get('/admin', function () {
    return view('admin.content');
})->name('content');


Route::get('login', [AuthAuthController::class, 'showFormLogin']);
Route::post('login', [AuthAuthController::class, 'login'])->name('login');
Route::get('register', [AuthAuthController::class, 'showFormRegister']);
Route::post('register', [AuthAuthController::class, 'register'])->name('register');
Route::post('logout', [AuthAuthController::class, 'logout'])->name('logout');

//client
Route::get('/', [ClientController::class, 'index'])->name('index');
// Route::get('/product/detail', [ClientController::class, 'product'])->name('product.detail');


//chi tiet test
Route::get('/product/{slug}',[ControllersProductController::class,'detail'])->name('product.detail');
Route::post('product/comment/{id}', [BinhLuanController::class, 'store'])->name('comment.store');
Route::get('admin/comment/index', [ProductController::class, 'indexWithComments'])->name('comment.index');
Route::get('admin/product/{id}/comments', [BinhLuanController::class, 'showComments'])->name('product.comments');



// Group routes under admin middleware
Route::middleware('auth', 'admin')->group(function () {
    Route::get('admin/accounts', [AdminController::class, 'index'])->name('admin.accounts');
    Route::get('admin/accounts/create', [AdminController::class, 'create'])->name('admin.accounts.create');
    Route::post('admin/accounts', [AdminController::class, 'store'])->name('admin.accounts.store');
    Route::get('admin/accounts/{user}/edit', [AdminController::class, 'edit'])->name('admin.accounts.edit');
    Route::put('admin/accounts/{user}', [AdminController::class, 'update'])->name('admin.accounts.update');
    Route::delete('admin/accounts/{user}', [AdminController::class, 'destroy'])->name('admin.accounts.destroy');
});





