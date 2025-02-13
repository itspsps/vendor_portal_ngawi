<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

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

Route::post('/cekpostman', [UserController::class, 'cekpostman'])->name('cekpostman');
Route::post('/UpdatePOHeader', [BidController::class, 'UpdatePOHeader'])->name('UpdatePOHeader');
Route::post('/postman', [UserController::class, 'postman']);
Route::post('/api_login/login_check', [UserController::class, 'login_check'])->name('login_check');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
    // API VP-NGAWI
});
