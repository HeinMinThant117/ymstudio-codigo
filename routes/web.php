<?php

use App\Models\Promocode;
use Illuminate\Support\Facades\Route;
use Zorb\Promocodes\Facades\Promocodes;

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

Route::get('/generate', function () {
    // $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    // $res = "";
    // for ($i = 0; $i < 10; $i++) {
    //     $res .= $chars[mt_rand(0, strlen($chars) - 1)];
    // }

    // // return 'HI';
    // return $res;

    return Promocode::where('promo_code', '=', 'BUTXXZJ7S8')->count();
});
