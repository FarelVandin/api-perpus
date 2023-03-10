<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthC;
use App\Http\Controllers\bukuC;
use App\Http\Controllers\userC;
use App\Http\Controllers\peminjamanC;
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

route::post('/login',[AuthC::class,'login']);


Route::apiResource('/peminjaman', peminjamanC::class)->middleware(['auth:sanctum']);
Route::apiResource('/buku', bukuC::class);

Route::apiResource('/user', UserC::class)->middleware(['auth:sanctum']);


    