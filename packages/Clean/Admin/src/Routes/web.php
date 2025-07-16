<?php

use Illuminate\Support\Facades\Route;
use Clean\Admin\Http\Controllers\AdminController;
use Clean\Admin\Http\Controllers\ProductController;
use Clean\Admin\Http\Controllers\BrandController;
use Clean\Admin\Http\Controllers\CategoryController;
use Clean\Admin\Http\Controllers\IngredientController;

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
        
        // Categories Management - Ruta de compatibilidad
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
        
        // Categories Management - Rutas completas CRUD
        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            Route::post('/', [CategoryController::class, 'store'])->name('store');
            Route::get('/{cleanCategory}', [CategoryController::class, 'show'])->name('show');
            Route::get('/{cleanCategory}/edit', [CategoryController::class, 'edit'])->name('edit');
            Route::put('/{cleanCategory}', [CategoryController::class, 'update'])->name('update');
            Route::delete('/{cleanCategory}', [CategoryController::class, 'destroy'])->name('destroy');
            
            // Operaciones adicionales
            Route::post('/bulk-action', [CategoryController::class, 'bulkAction'])->name('bulk-action');
            Route::get('/export', [CategoryController::class, 'export'])->name('export');
        });
        
        // Ingredients Management - Ruta de compatibilidad
        Route::get('/ingredients', [IngredientController::class, 'index'])->name('ingredients');
        
        // Ingredients Management - Rutas completas CRUD
        Route::prefix('ingredients')->name('ingredients.')->group(function () {
            Route::get('/', [IngredientController::class, 'index'])->name('index');
            Route::get('/create', [IngredientController::class, 'create'])->name('create');
            Route::post('/', [IngredientController::class, 'store'])->name('store');
            Route::get('/{cleanIngredient}', [IngredientController::class, 'show'])->name('show');
            Route::get('/{cleanIngredient}/edit', [IngredientController::class, 'edit'])->name('edit');
            Route::put('/{cleanIngredient}', [IngredientController::class, 'update'])->name('update');
            Route::delete('/{cleanIngredient}', [IngredientController::class, 'destroy'])->name('destroy');
            
            // Operaciones adicionales
            Route::post('/bulk-action', [IngredientController::class, 'bulkAction'])->name('bulk-action');
            Route::get('/export', [IngredientController::class, 'export'])->name('export');
            Route::get('/{cleanIngredient}/safety-info', [IngredientController::class, 'safetyInfo'])->name('safety-info');
        });
        
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