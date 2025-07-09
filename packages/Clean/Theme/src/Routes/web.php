<?php

use Illuminate\Support\Facades\Route;
use Clean\Theme\Http\Controllers\ThemeController;

Route::group(['middleware' => ['web']], function () {
    Route::prefix('theme')->name('theme.')->group(function () {
        
        // Theme demo
        Route::get('/demo', [ThemeController::class, 'demo'])->name('demo');
        
        // Style guide
        Route::get('/style-guide', [ThemeController::class, 'styleGuide'])->name('style-guide');
        
        // API endpoints
        Route::prefix('api')->name('api.')->group(function () {
            Route::get('/css', [ThemeController::class, 'generateCSS'])->name('css');
            Route::get('/config', [ThemeController::class, 'config'])->name('config');
            Route::get('/assets', [ThemeController::class, 'assets'])->name('assets');
            Route::get('/icons', [ThemeController::class, 'icons'])->name('icons');
        });
        
    });
});