<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LocalizationController;
use App\Http\Middleware\SetDefaultLocaleForUrls;


Route::prefix('{locale?}')->group(function () {
    Route::get('/', [HomeController::class, 'show'])->name('home');
    Route::get('/articles/{post}', [PostController::class, 'show'])->name('posts.show');
});

Route::get('/locale/{lang}', [LocalizationController::class, 'setLocalization'])->name('locale.switch');
