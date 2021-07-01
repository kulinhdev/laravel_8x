<?php

// Controller
use App\Http\Controllers\BlogsController;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


// Route Blogs
Route::redirect('/', 'blogs');

Route::resource('/blogs', BlogsController::class);
Route::get('/trash', [BlogsController::class, 'softDelete'])->name('trash');
Route::put('/restore', [BlogsController::class, 'restoreDelete'])->name('restore');
Route::put('/delete', [BlogsController::class, 'realDelete'])->name('delete');

Route::fallback(function () {
    echo '<h1>This page not found !</h1>';
});





