<?php

use App\Http\Controllers\Api\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/make_order',[OrderController::class,'make_order']);
Route::get('/all_data',[OrderController::class,'all_data']);
Route::get('get_status/{id}',[OrderController::class, 'get_status'])->name('get_status');
Route::post('resend_request',[OrderController::class, 'resend_request'])->name('resend_request');

