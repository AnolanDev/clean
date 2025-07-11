<?php

use Illuminate\Support\Facades\Route;

// Temporary Clean routes for testing
Route::get('/clean', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Clean package is working!',
        'package' => 'Clean/Core',
        'version' => '1.0.0',
        'timestamp' => now()->toDateTimeString()
    ]);
})->name('clean.test');

Route::get('/clean/info', function () {
    return view('clean-info');
})->name('clean.info.test');

// Página principal del sistema Clean
Route::get('/', function () {
    return view('clean-theme::clean-home');
})->name('clean.home');
