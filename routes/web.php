<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;

Route::get('/', function () {
    return view('index');
});
Route::get('/{post}', function (Post $post) {
    return view('single', ["post" => $post]);
});
