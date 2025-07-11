<?php

use Illuminate\Support\Facades\Route;
use Clean\Admin\Http\Controllers\AdminController;

Route::group(['middleware' => ['web']], function () {
    
    // Ruta principal /admin redirige al dashboard de Clean
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    Route::prefix('admin/clean')->name('admin.clean.')->group(function () {
        
        // Dashboard
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // Products Management
        Route::get('/products', [AdminController::class, 'products'])->name('products');
        Route::post('/products/bulk', [AdminController::class, 'bulkOperation'])->name('products.bulk');
        Route::get('/products/export', [AdminController::class, 'exportProducts'])->name('products.export');
        
        // Brands Management
        Route::get('/brands', [AdminController::class, 'brands'])->name('brands');
        
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
            Route::get('/products/suggestions', [AdminController::class, 'productSuggestions'])->name('products.suggestions');
            Route::get('/ingredients/{id}/safety', [AdminController::class, 'ingredientSafetyInfo'])->name('ingredients.safety');
        });
        
    });
});