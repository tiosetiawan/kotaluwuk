<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Api\DashboardController;

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
Route::get('/login', [LoginController::class, 'index']);
Route::post('/store', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class,'destroy']);

// routing admin
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::put('post/publish', [DashboardController::class, 'publish'])->name('post.publish');
Route::put('post/unpublish', [DashboardController::class, 'unpublish'])->name('post.unpublish');
