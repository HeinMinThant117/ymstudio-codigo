<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ClassPackController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\PromocodeController;
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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

Route::get('class-packs', [ClassPackController::class, 'index']);
Route::get('class-packs/{id}', [ClassPackController::class, 'show']);

Route::post('orders', [OrderController::class, 'store'])->middleware('auth:api');
Route::get('orders/{id}', [OrderController::class, 'show'])->middleware('auth:api');

Route::post('promocodes', [PromocodeController::class, 'store']);
Route::post('promocodes/verify', [PromocodeController::class, 'verify'])->middleware('auth:api');
Route::post('promocodes/apply', [PromocodeController::class, 'apply'])->middleware('auth:api');
