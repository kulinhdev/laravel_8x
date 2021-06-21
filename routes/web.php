<?php

// Controller
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HttpClientController;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route Blogs



// Route Product
Route::get('/product', [ProductController::class, 'index']);

Route::get('/product/{id}', [ProductController::class, 'detail']);

Route::get('/category', [CategoryController::class, 'index']);

// Http Client 
Route::get('/posts', 'HttpClientController@getAll');
Route::get('/posts/{id}', 'HttpClientController@getById');
Route::get('/add-posts', 'HttpClientController@addPost');
Route::get('/update-posts/{id}', 'HttpClientController@updatePost');
Route::get('/delete-posts/{id}', 'HttpClientController@deletePost');


// *** Router Type *** \\
// Route parameter
Route::get('/user/{id}/{name}', function ($id, $name) {
    return 'Customer ' . $id . ' ' . $name;
})->whereAlpha('name');   // Needless (->whereNumber('id')) --> Because define Global Constraints in EventServiceProvider

// Many parameter
Route::get('/category/{category}/action/{action}', function ($category, $action) {
    return 'Route -> ' . $category . ' --- ' . 'Action -> ' . $action;
});

// Optional Parameters
Route::get('/category/{id?}', function ($id = 12) {
    return 'Category ' . $id;
})->where('id', '[0-9]+');

// Route name
Route::get('demo-name1', function () {
    return 'Demo Route name !';
})->name('demo-name');

Route::get('call-demo-name', function () {
    return '<a href="' . route('demo-name') . '">Call Route name !</a>';
});

Route::get('redirect', function () {
    return redirect('/');
});

// Route Group admin/user...
Route::prefix('admin')->group(function () {     // P2 => Route::group(['prefix' => 'admin'], function() {});
    Route::get('/users', function () {
        return 'All Users';
    });
    Route::post('/users', function () {
        return 'Add Users';
    });
    Route::get('/users/{id}', function ($id) {
        return 'All Users ' . $id;
    });
    Route::put('/users/{id}', function ($id) {
        return 'Update Users ' . $id;
    });
    Route::delete('/users/{id}', function ($id) {
        return 'Delete Users ' . $id;
    });
});

// Route call Controller
// Lrv-8 
Route::get('/category-demo1', [CategoryController::class, 'index']);

// Lrv-8 or
Route::get('/category-demo2', '\App\Http\Controllers\CategoryController@index');

// Lrv-8 before
// Uncomment: RouteServiceProvider.php ==> protected $namespace = 'App\\Http\\Controllers'
Route::get('/category-demo3', 'CategoryController@index');

Route::get('/env', function () {
    return env('APP_NAME');
});
