<?php

use Illuminate\Support\Facades\Route;
use Clean\Admin\Http\Controllers\AdminController;
use Clean\Admin\Http\Controllers\ProductController;
use Clean\Admin\Http\Controllers\BrandController;

Route::group(['middleware' => ['web']], function () {
    
    // Ruta principal /admin redirige al dashboard de Clean
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    Route::prefix('admin/clean')->name('admin.clean.')->group(function () {
        
        // Dashboard
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // Products Management - Ruta de compatibilidad
        Route::get('/products', [ProductController::class, 'index'])->name('products');
        
        // Products Management - Rutas completas CRUD
        Route::prefix('products')->name('products.')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/create', [ProductController::class, 'create'])->name('create');
            Route::post('/', [ProductController::class, 'store'])->name('store');
            Route::get('/{cleanProduct}', [ProductController::class, 'show'])->name('show');
            Route::get('/{cleanProduct}/edit', [ProductController::class, 'edit'])->name('edit');
            Route::put('/{cleanProduct}', [ProductController::class, 'update'])->name('update');
            Route::delete('/{cleanProduct}', [ProductController::class, 'destroy'])->name('destroy');
            
            // Operaciones adicionales
            Route::post('/bulk-action', [ProductController::class, 'bulkAction'])->name('bulk-action');
            Route::get('/export', [ProductController::class, 'export'])->name('export');
            Route::get('/suggestions', [ProductController::class, 'suggestions'])->name('suggestions');
        });
        
        // Brands Management - Ruta de compatibilidad
        Route::get('/brands', [BrandController::class, 'index'])->name('brands');
        
        // Brands Management - Rutas completas CRUD
        Route::prefix('brands')->name('brands.')->group(function () {
            Route::get('/', [BrandController::class, 'index'])->name('index');
            Route::get('/create', [BrandController::class, 'create'])->name('create');
            Route::post('/', [BrandController::class, 'store'])->name('store');
            Route::get('/{cleanBrand}', [BrandController::class, 'show'])->name('show');
            Route::get('/{cleanBrand}/edit', [BrandController::class, 'edit'])->name('edit');
            Route::put('/{cleanBrand}', [BrandController::class, 'update'])->name('update');
            Route::delete('/{cleanBrand}', [BrandController::class, 'destroy'])->name('destroy');
            
            // Operaciones adicionales
            Route::post('/bulk-action', [BrandController::class, 'bulkAction'])->name('bulk-action');
            Route::get('/export', [BrandController::class, 'export'])->name('export');
        });
        
        // Categories Management
        Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
        
        // Ingredients Management
        Route::get('/ingredients', [AdminController::class, 'ingredients'])->name('ingredients');
        
        // Safety Reports
        Route::get('/safety', [AdminController::class, 'safetyReports'])->name('safety');
        Route::get('/safety/report', [AdminController::class, 'generateSafetyReport'])->name('safety.report');
        
        // Analytics
        Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics');
        
        // Settings
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
        
        // API endpoints
        Route::prefix('api')->name('api.')->group(function () {
            Route::get('/ingredients/{id}/safety', [AdminController::class, 'ingredientSafetyInfo'])->name('ingredients.safety');
        });
        
    });
});