<?php

use App\Http\Controllers\Admin\CataloguesController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VariantsController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::get('/list', [CataloguesController::class, 'index'])->name('index');
        Route::get('create', [CataloguesController::class, 'create'])->name('create');
        Route::post('store', [CataloguesController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CataloguesController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [CataloguesController::class, 'update'])->name('update');
        Route::get('{id}destroy', [CataloguesController::class, 'destroy'])->name('destroy');
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
