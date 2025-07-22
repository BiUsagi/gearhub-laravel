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
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/products', [App\Http\Controllers\Admin\DashboardController::class, 'products'])->name('products.index');
    Route::get('/api/dashboard-data', [App\Http\Controllers\Admin\DashboardController::class, 'apiDashboardData'])->name('api.dashboard-data');

    // Placeholder routes for demo
    Route::get('/products/create', function () {
        return 'Create Product Page'; })->name('products.create');
    Route::get('/orders', function () {
        return 'Orders Page'; })->name('orders.index');
    Route::get('/customers', function () {
        return 'Customers Page'; })->name('customers.index');
    Route::get('/reviews', function () {
        return 'Reviews Page'; })->name('reviews.index');
    Route::get('/coupons', function () {
        return 'Coupons Page'; })->name('coupons.index');
    Route::get('/discounts', function () {
        return 'Discounts Page'; })->name('discounts.index');
    Route::get('/banners', function () {
        return 'Banners Page'; })->name('banners.index');
    Route::get('/analytics', function () {
        return 'Analytics Page'; })->name('analytics');
    Route::get('/settings/general', function () {
        return 'General Settings Page'; })->name('settings.general');
    Route::get('/settings/payment', function () {
        return 'Payment Settings Page'; })->name('settings.payment');
    Route::get('/settings/shipping', function () {
        return 'Shipping Settings Page'; })->name('settings.shipping');
    Route::get('/settings/notifications', function () {
        return 'Notifications Settings Page'; })->name('settings.notifications');
    Route::get('/settings/account', function () {
        return 'Account Settings Page'; })->name('settings.account');
    Route::get('/brands', function () {
        return 'Brands Page'; })->name('brands.index');
    Route::get('/categories', function () {
        return 'Categories Page'; })->name('categories.index');
    Route::get('/profile', function () {
        return 'Admin Profile Page'; })->name('profile');
    Route::get('/notifications', function () {
        return 'Notifications Page'; })->name('notifications');
    Route::get('/messages', function () {
        return 'Messages Page'; })->name('messages');
});

require __DIR__ . '/auth.php';
