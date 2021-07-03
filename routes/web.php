<?php

// Controller
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


Auth::routes();

Route::redirect('/', 'home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// *** Route Blogs *** \\
Route::resource('/blogs', BlogsController::class)->middleware('auth');
Route::get('/trash', [BlogsController::class, 'softDelete'])->name('trash')->middleware('auth');
Route::put('/soft-delete', [BlogsController::class, 'softDeleteAction'])->name('soft_delete');

// 404 Page
Route::fallback(function () {
    return view('error');
});


