<?php

use Illuminate\Support\Facades\Route;
use Clean\Catalog\Http\Controllers\CatalogController;

Route::group(['middleware' => ['web']], function () {
    Route::prefix('catalog')->name('catalog.')->group(function () {
        
        // Página principal del catálogo
        Route::get('/', [CatalogController::class, 'index'])->name('index');
        
        // Búsqueda
        Route::get('/search', [CatalogController::class, 'search'])->name('search');
        
        // Productos por marca
        Route::get('/brand/{slug}', [CatalogController::class, 'brand'])->name('brand');
        
        // Productos por categoría
        Route::get('/category/{slug}', [CatalogController::class, 'category'])->name('category');
        
        // Detalles del producto
        Route::get('/product/{id}', [CatalogController::class, 'show'])->name('product.show');
        
        // Comparar productos
        Route::post('/compare', [CatalogController::class, 'compare'])->name('compare');
        
        // API endpoints
        Route::prefix('api')->name('api.')->group(function () {
            Route::get('/filters', [CatalogController::class, 'filtersData'])->name('filters');
            Route::post('/dilution', [CatalogController::class, 'dilutionCalculator'])->name('dilution');
            Route::post('/coverage', [CatalogController::class, 'coverageCalculator'])->name('coverage');
        });
        
    });
});