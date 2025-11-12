<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProductController;

Route::controller(SearchController::class)
    ->group(static function (): void {
        Route::get('/', 'index')->name('home');
        Route::get('/search', 'search')->name('search');
    });

Route::resource('products', ProductController::class);
