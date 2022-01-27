<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'clients', 'as' => 'clients.'], function () {
    Route::get('/', [ClientController::class, 'index'])->name('list');
    Route::post('/', [ClientController::class, 'store'])->name('store');
    Route::get('/{id}', [ClientController::class, 'show'])->name('show');
    Route::put('/{id}', [ClientController::class, 'update'])->name('update');
    Route::delete('/{id}', [ClientController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'suppliers', 'as' => 'suppliers.'], function () {
    Route::get('/', [SupplierController::class, 'index'])->name('list');
    Route::post('/', [SupplierController::class, 'store'])->name('store');
    Route::get('/{supplier_id}', [SupplierController::class, 'show'])->name('show');
    Route::put('/{supplier_id}', [SupplierController::class, 'update'])->name('update');
    Route::delete('/{supplier_id}', [SupplierController::class, 'destroy'])->name('destroy');

    Route::group(['prefix' => '{supplier_id}/products', 'as' => 'products.'], function () {
        Route::get('/', [ProductController::class, 'listBySupplier'])->name('list');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{product_id}', [ProductController::class, 'show'])->name('show');
        Route::put('/{product_id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{product_id}', [ProductController::class, 'destroy'])->name('destroy');
    });
});

Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('list');
});


Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
    Route::get('/{order_id}', [OrderController::class, 'show'])->name('show');
    Route::post('/', [OrderController::class, 'store'])->name('store');
    Route::put('/{order_id}', [OrderController::class, 'update'])->name('update');
});
