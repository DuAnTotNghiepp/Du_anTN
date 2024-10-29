<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Client\ClientController;
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

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('login', [AuthController::class, 'showFormLogin']);
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'showFormRegister']);
Route::post('register', [AuthController::class, 'register'])->name('register');

// Client Routes
Route::get('/', [ClientController::class, 'index'])->name('index');
// Route::get('/product/detail', [ClientController::class, 'product'])->name('product.detail');
Route::get('product/{id}', [ClientController::class, 'show_variants'])->name('client.product_detail');
Route::get('/product/checkout', [ClientController::class, 'checkout'])->name('product.checkout');

// Password Reset Routes
Route::get('password/forgot', [AuthController::class, 'showForgotPasswordForm'])->name('password.forgot');
Route::post('password/forgot', [AuthController::class, 'sendResetLinkEmail']);
Route::get('password/reset/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('password/reset', [AuthController::class, 'reset']);

// Social Login Routes
Route::get('login/facebook', [AuthController::class, 'redirectToFacebook']);
Route::get('login/facebook/callback', [AuthController::class, 'handleFacebookCallback']);

// Admin Routes (Requires auth and admin middleware)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.content');
    })->name('content');
    
    // Admin account management
    Route::get('admin/accounts', [AdminController::class, 'index'])->name('accounts.index');
    Route::get('admin/accounts/create', [AdminController::class, 'create'])->name('accounts.create');
    Route::post('admin/accounts', [AdminController::class, 'store'])->name('accounts.store');
    Route::get('admin/accounts/{user}/edit', [AdminController::class, 'edit'])->name('accounts.edit');
    Route::put('admin/accounts/{user}', [AdminController::class, 'update'])->name('accounts.update');
    Route::delete('admin/accounts/{user}', [AdminController::class, 'destroy'])->name('accounts.destroy');
});
