<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Product routes
    Route::get('/products', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('products.create');
    Route::get('/products/{id}/edit', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('products.edit');
    Route::get('/products/import-export', [App\Http\Controllers\Admin\ProductController::class, 'importExport'])->name('products.import-export');
    Route::get('/products/inventory', [App\Http\Controllers\Admin\ProductController::class, 'inventory'])->name('products.inventory');
    Route::get('/products/attributes', [App\Http\Controllers\Admin\ProductController::class, 'attributes'])->name('products.attributes');
    Route::get('/products/trash', [App\Http\Controllers\Admin\ProductController::class, 'trash'])->name('products.trash');

});

require __DIR__ . '/auth.php';
