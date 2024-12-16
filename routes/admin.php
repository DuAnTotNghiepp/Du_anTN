<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CataloguesController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\Product_VariantController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VariantsController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;




Route::prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::get('/list', [CataloguesController::class, 'index'])->name('index');
        Route::get('create', [CataloguesController::class, 'create'])->name('create');
        Route::post('store', [CataloguesController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CataloguesController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CataloguesController::class, 'update'])->name('update');
        Route::get('/{id}/destroy', [CataloguesController::class, 'destroy'])->name('destroy');
    });

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
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::controller(OrderController::class)
            ->name('order.')
            ->prefix('admin/orders/')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('store', 'store')->name('store');
                Route::get('{id}/show', 'show')->name('show');
                Route::get('{id}/edit', 'edit')->name('edit');
                Route::put('{id}/update', 'update')->name('update');
            });
    });
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::controller(Product_VariantController::class)
            ->name('product_variant.')
            ->prefix('admin/product_variants/')
            ->group(function () {
                Route::get('/', 'index')->name('index');
            });
            Route::post('/product-variant/update-stock', [Product_VariantController::class, 'updateStock'])->name('product_variant.update_stock');
            Route::delete('/product-variant/{id}', [Product_VariantController::class, 'destroy'])->name('product_variant.destroy');
            Route::get('/products/{id}/update-quantity', [ProductController::class, 'updateQuantity']);
    });

Route::controller(VariantsController::class)
    ->name('variant.')
    ->prefix('admin/variants/')
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

Route::controller(VoucherController::class)
    ->name('vouchers.')
    ->prefix('admin/vouchers/')
    ->group(function () {

        Route::get('/', 'index')
        ->name('index');
        Route::get('create', 'create')
            ->name('create');
        Route::post('store', 'store')
            ->name('store');

        Route::get('{id}/edit', 'edit')->name('edit');
        Route::put('{id}', 'update')->name('update');

        Route::post('{id}/toggle-visibility', 'toggleVisibility')
            ->name('toggleVisibility');
        Route::delete('{id}/destroy', 'destroy')
            ->name('destroy');
});

Route::controller(BlogController::class)
    ->name('blog.')
    ->prefix('admin/blog/')
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
