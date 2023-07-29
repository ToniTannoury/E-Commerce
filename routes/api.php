<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/signin', [AuthController::class, 'signIn']);


Route::controller(AuthController::class)->group(function () {
  Route::post('login', 'login');
  Route::post('register', 'register');
  Route::post('logout', 'logout');
  Route::post('refresh', 'refresh');
  Route::apiResource("customers" , CustomerController::class);
  Route::apiResource("products" , ProductController::class);
  Route::apiResource("favorites" , FavoriteController::class);
});
