<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VariantsController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BinhLuanController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\ProductCatalogueController;
use App\Http\Controllers\Client\ProductFavoriteController;
use App\Http\Controllers\Client\VoucherController as ClientVoucherController;
use App\Http\Controllers\ProductController as ControllersProductController;
use Illuminate\Support\Facades\Route;
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

Route::get('product/{id}', [ClientController::class, 'show'])->name('product.product_detail');
Route::put('product/{id}/update', [ProductController::class, 'update'])->name('product.update');

Route::get('product/{id}', [ClientController::class, 'show'])->middleware('save.redirect')->name('product.product_detail');



//profile
Route::get('/profile/{id}', [ClientController::class, 'show_profile'])->name('profile');
Route::get('/my_orders', [ClientController::class, 'show_my_order'])->name('my_orders');
Route::post('profile', [ClientController::class, 'updateProfile'])->name('updateProfile');
// routes/web.php
Route::post('/profile/address', [ClientController::class, 'storeAddress'])->name('profile.address.store');
Route::put('/profile/address/update/{id}', [ClientController::class, 'updateAddress'])->name('profile.address.update');
Route::get('/my_order/{id}/invoice', [ClientController::class, 'exportInvoice'])->name('my_order.invoice');



Route::get('/checkout', [CheckoutController::class, 'form'])->middleware('auth')->name('checkout');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store')->middleware('auth');
Route::post('/orders/vnpay_ment', [OrderController::class, 'vnpay_ment'])->name('orders.vnpay_ment');

Route::get('/checkout/apply-voucher', [CheckoutController::class, 'applyVoucher'])->name('checkout.applyVoucher');

Route::get('/checkout', [CheckoutController::class, 'form'])->name('checkout');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store')->middleware('auth');
Route::post('/vnpay_payment', [OrderController::class, 'vnpayPayment'])->name('orders.vnpay_ment');
Route::get('/vnpay/callback', [OrderController::class, 'vnpayCallback'])->name('vnpay.callback');

Route::post('/variants', [VariantsController::class, 'store'])->name('variants.store');


Route::middleware('auth')->group(function () {
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
});

Route::get('/productcatalogue', [ProductCatalogueController::class, 'index'])->name('productcatalogue');

Route::post('/api/get-products-by-category', [ClientController::class, 'getProductsByCategory']);
Route::post('/favorites/toggle', [ProductFavoriteController::class, 'toggleFavorite'])->name('favorites.toggle');
Route::get('/favorites', [ProductFavoriteController::class, 'favoriteProducts'])->name('favorites.index');
Route::get('/favorites/count', [ProductFavoriteController::class, 'favoriteCount'])->name('favorites.count');


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


//client
Route::get('/', [ClientController::class, 'index'])->name('index');
Route::get('/product/detail', [ClientController::class, 'product'])->name('product.detail');
Route::get('/product/checkout', [ClientController::class, 'checkout'])->name('product.checkout');
Route::get('buying_guide', [ClientController::class , 'buying_guide' ])->name('buying_guide');
Route::get('warranty',[ClientController::class , 'warranty'])->name('warranty');
Route::get('searchWarranty',[ClientController::class,'searchWarranty'])->name('searchWarranty');


Route::post('/search', [ClientController::class, 'search'])->name('product.search');
// Group routes under admin middleware
Route::middleware('auth', 'admin')->group(function () {
    // Route::get('admin/accounts', [AdminController::class, 'index'])->name('admin.accounts');
    Route::get('/admin/accounts', [AdminController::class, 'index'])->name('admin.accounts');
    Route::get('admin/accounts/create', [AdminController::class, 'create'])->name('admin.accounts.create');
    Route::post('admin/accounts', [AdminController::class, 'store'])->name('admin.accounts.store');
    Route::get('admin/accounts/{user}/edit', [AdminController::class, 'edit'])->name('admin.accounts.edit');
    Route::put('admin/accounts/{user}', [AdminController::class, 'update'])->name('admin.accounts.update');
    Route::delete('admin/accounts/{user}', [AdminController::class, 'destroy'])->name('admin.accounts.destroy');
    //thong ke
});
Route::resource('materials', MaterialController::class);
Route::get('/admin/materials/create', [MaterialController::class, 'create'])->name('materials.create');  // Hiển thị form tạo mới
Route::post('/admin/materials', [MaterialController::class, 'store'])->name('materials.store');
Route::delete('/admin/materials/{id}/destroy', [MaterialController::class, 'destroy'])->name('materials.destroy');


Route::resource('cart', CartController::class);

//chi tiet test
Route::post('product/comment/{id}', [BinhLuanController::class, 'store'])->name('comment.store');
Route::get('admin/comment/index', [ProductController::class, 'indexWithComments'])->name('comment.index');
Route::get('admin/product/{id}/comments', [BinhLuanController::class, 'showComments'])->name('product.comments');


// Group routes under admin middlewares
//thong ke
Route::get('/admin/dashboard-stats', [AdminController::class, 'getDashboardStats']);
Route::get('/admin/revenue-stats', [AdminController::class, 'getRevenueStats']);




// Group routes under admin middleware
Route::get('blog/{id}', [BlogController::class, 'show'])->name('blog.detail');

