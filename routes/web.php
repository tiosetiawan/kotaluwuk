<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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

Route::post('/tostr', [LoginController::class, 'tostr']);

// routing admin
Route::get('/dashboard', function () {
    $data['css'] = array(
    );
    
    $data['js'] = array(
    );
    return view('dashboard.index',[
        'title' => 'Home',
        'data'  => $data
    ]);
});