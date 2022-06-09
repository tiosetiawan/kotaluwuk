<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
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

Route::get('/', [LoginController::class, 'index'])->middleware('guest');


// routing login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/store', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class,'destroy']);

// routing auth akses
Route::group(['middleware' => ['auth']], function () {
Route::get('/dashboard', [DashboardController::class, 'index']);

// get datatables
Route::get('/configuration/users/json', [UserController::class, 'getTable']);
Route::get('/configuration/roles/json', [RoleController::class, 'getTable']);
Route::get('/configuration/permissions/json', [PermissionController::class, 'getTable']);

// get data cherry
Route::get('/configuration/users/cherry', [UserController::class, 'getUser']);

// resource
Route::resource('/configuration/users', UserController::class);
Route::resource('/configuration/roles', RoleController::class);
Route::resource('/configuration/permissions', PermissionController::class);
});


// testing spatie route
Route::put('post/publish', [DashboardController::class, 'publish'])->name('post.publish');
Route::put('post/unpublish', [DashboardController::class, 'unpublish'])->name('post.unpublish');
