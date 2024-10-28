<?php

use App\Http\Controllers\Admin\CataloguesController;
use App\Http\Controllers\Admin\ProductController;
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
