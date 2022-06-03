<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|-------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// routing login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/store', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class,'destroy']);

// routing akses admin
Route::group(['middleware' => ['auth']], function () {
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/user/json', [UserController::class, 'getTable']);

// get datables
Route::get('/user/json', [UserController::class, 'getTable']);
Route::get('/roles/json', [RoleController::class, 'getTable']);

// get data cherry
Route::get('/user/cherry', [UserController::class, 'getUser']);

// resource
Route::resource('/user', UserController::class);
Route::resource('/roles', RoleController::class);
});

Route::put('post/publish', [DashboardController::class, 'publish'])->name('post.publish');
Route::put('post/unpublish', [DashboardController::class, 'unpublish'])->name('post.unpublish');
