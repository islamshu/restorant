<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();
Route::get('login',[HomeController ::class,'login_admin'])->name('login');
Route::get('/',[HomeController ::class,'index'])->name('index');

Route::post('login',[HomeController::class,'post_login_admin'])->name('post_login_admin');
Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/setting', [App\Http\Controllers\HomeController::class, 'setting'])->name('setting');
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'get_orders'])->name('get_orders');
    Route::get('/refresh', [App\Http\Controllers\OrderController::class, 'refresh'])->name('refresh');
    Route::get('/change_status', [App\Http\Controllers\OrderController::class, 'change_status'])->name('change_status');
    Route::get('logout',[HomeController::class,'logout'])->name('logout');
    Route::get('profile',[HomeController::class,'profile'])->name('profile');
    Route::post('update_profile',[HomeController::class,'update_profile'])->name('update_profile');
    Route::get('export',[HomeController::class,'export'])->name('export');
    

    Route::post('add_general', [App\Http\Controllers\HomeController::class, 'add_general'])->name('add_general');
});

