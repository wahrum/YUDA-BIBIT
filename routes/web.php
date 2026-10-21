<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;

// ─── Halaman Publik ────────────────────────────────────────────────────────────
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/produk', [PublicController::class, 'products'])->name('products');
Route::get('/produk/{slug}', [PublicController::class, 'productDetail'])->name('product.detail');

// ─── Admin Auth ────────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Area yang hanya bisa diakses setelah login sebagai admin
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Kategori
        Route::resource('categories', CategoryController::class)
            ->except(['show']);

        // Produk
        Route::resource('products', ProductController::class)
            ->except(['show']);
        Route::delete('/products/images/{image}', [ProductController::class, 'destroyImage'])
            ->name('products.images.destroy');

        // Pengaturan Situs
        Route::get('/settings', [SettingController::class, 'index'])->name('settings');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    });
});
