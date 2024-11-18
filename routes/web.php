<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BinhLuanController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\OrderController;
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
Route::get('product/{id}', [ClientController::class, 'show'])->name('product.product_detail');
// Route::group(['prefix'=>'checkout'], function(){
//     Route::get('/',[CheckoutController::class, 'form'])->name('checkout');
//     Route::post('/',[CheckoutController::class, 'submit_form'])->name('checkout');
// });
Route::get('/checkout', [CheckoutController::class, 'form'])->name('checkout');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store')->middleware('auth');

// Route::get('/product/checkout/{id}', [OrderController::class, 'show'])->name('productcheckout.checkout');


// Password Reset Routes
Route::get('password/forgot', [AuthController::class, 'showForgotPasswordForm'])->name('password.forgot');
Route::post('password/forgot', [AuthController::class, 'sendResetLinkEmail']);
Route::get('password/reset/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('password/reset', [AuthController::class, 'reset']);

// Social Login Routes
Route::get('login/facebook', [AuthController::class, 'redirectToFacebook']);
Route::get('login/facebook/callback', [AuthController::class, 'handleFacebookCallback']);

// Admin Routes (Requires auth and admin middleware)


Route::get('/admin', function () {
    return view('admin.content');
})->name('content');


Route::get('login', [AuthController::class, 'showFormLogin']);
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'showFormRegister']);
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// Thêm sản phẩm vào giỏ hàng
Route::post('/cart/store/{productId}/{variantId}', [CartController::class, 'store'])->name('cart.store');

// Cập nhật số lượng sản phẩm trong giỏ hàng
Route::post('/cart/update/{cartItemId}', [CartController::class, 'update'])->name('cart.update');

// Xóa sản phẩm khỏi giỏ hàng
Route::delete('/cart/destroy/{cartItemId}', [CartController::class, 'destroy'])->name('cart.destroy');


Route::post('product/comment/{id}', [BinhLuanController::class, 'store'])->name('comment.store');
Route::get('admin/comment/index', [ProductController::class, 'indexWithComments'])->name('comment.index');
Route::get('admin/product/{id}/comments', [BinhLuanController::class, 'showComments'])->name('product.comments');


// Group routes under admin middleware

