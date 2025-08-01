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
    Route::get('/products/attributes', [App\Http\Controllers\Admin\ProductController::class, 'attributes'])->name('products.attributes');
    Route::get('/products/trash', [App\Http\Controllers\Admin\ProductController::class, 'trash'])->name('products.trash');

    // Category routes
    Route::get('/categories', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('categories.create');
    Route::get('/categories/{id}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('categories.edit');
    Route::get('/categories/tree', [App\Http\Controllers\Admin\CategoryController::class, 'tree'])->name('categories.tree');
    Route::get('/categories/trash', [App\Http\Controllers\Admin\CategoryController::class, 'trash'])->name('categories.trash');
    Route::get('/categories/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'show'])->name('categories.show');

    // Order routes
    Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/pending', [App\Http\Controllers\Admin\OrderController::class, 'pending'])->name('orders.pending');
    Route::get('/orders/tracking', [App\Http\Controllers\Admin\OrderController::class, 'tracking'])->name('orders.tracking');
    Route::get('/orders/create', [App\Http\Controllers\Admin\OrderController::class, 'create'])->name('orders.create');
    Route::get('orders/invoices', [App\Http\Controllers\Admin\OrderController::class, 'invoices' ])->name('orders.invoices');

    // Inventory routes
    Route::get('/inventory', [App\Http\Controllers\Admin\InventoryController::class, 'index'])->name('inventory.index');

});

require __DIR__ . '/auth.php';
