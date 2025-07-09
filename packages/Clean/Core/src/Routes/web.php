<?php

use Illuminate\Support\Facades\Route;
use Clean\Core\Http\Controllers\CleanController;

Route::group(['middleware' => ['web']], function () {
    Route::prefix('clean')->group(function () {
        Route::get('/', [CleanController::class, 'index'])->name('clean.index');
        Route::get('/info', [CleanController::class, 'info'])->name('clean.info');
    });
});