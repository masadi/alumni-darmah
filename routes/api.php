<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\WilayahController;
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
//Route::get('no-access', [PageController::class, 'no_access'])->name('login');
Route::get('/provinsi', [WilayahController::class, 'provinsi']);
Route::post('/kabupaten', [WilayahController::class, 'kabupaten']);
Route::post('/kecamatan', [WilayahController::class, 'kecamatan']);
Route::post('/desa', [WilayahController::class, 'desa']);
Route::post('register', [AlumniController::class, 'register']);
Route::group(['prefix' => 'auth'], function () {
  Route::get('/semester', [AuthController::class, 'semester']);
  Route::post('login', [AuthController::class, 'login']);
  Route::post('register', [AuthController::class, 'register']);
  Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);
  });
});
Route::group(['middleware' => 'auth:sanctum'], function () {
  Route::group(['prefix' => 'alumni'], function () {
    Route::get('/', [AlumniController::class, 'index']);
  });
  Route::group(['prefix' => 'users'], function () {
    Route::get('/profil', [AuthController::class, 'profil']);
    Route::post('/update-profile', [AuthController::class, 'update_profile']);
  });
});
