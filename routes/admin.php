<?php

use App\Http\Controllers\Admin\CataloguesController;
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
