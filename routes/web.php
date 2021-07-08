<?php

// Controller
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Auth::routes();

Route::redirect('/', 'home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    // *** Route Posts *** \\
});

Route::resource('/posts', PostController::class)->parameters([
    'posts' => 'id'
]);
// SoftDelete Posts
Route::get('/posts/trash', [PostController::class, 'softDelete'])->name('posts.trash');
Route::put('/posts/soft-delete', [PostController::class, 'softDeleteAction'])->name('posts.soft_delete');

// Category and SoftDelete
Route::resource('/categories', CategoryController::class)->except(['create'])->parameters([
    'categories' => 'id'
]);
Route::get('/categories/trash', [CategoryController::class, 'softDelete'])->name('categories.trash');
Route::put('/categories/soft-delete', [CategoryController::class, 'softDeleteAction'])->name('categories.soft_delete');

// Product and SoftDelete
Route::resource('/products', ProductController::class)->parameters([
    'products' => 'id'
]);
Route::get('/products/trash', [ProductController::class, 'softDelete'])->name('products.trash');
Route::put('/products/soft-delete', [ProductController::class, 'softDeleteAction'])->name('products.soft_delete');

// 404 Page
Route::fallback(function () {
    return view('error');
});
