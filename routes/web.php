<?php

// Controller
use App\Http\Controllers\BlogsController;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


// Route Blogs
Route::redirect('/', 'blogs');

Route::resource('/blogs', BlogsController::class);

Route::fallback(function () {
    echo '<h1>This page not found !</h1>';
});





