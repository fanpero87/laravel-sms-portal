<?php

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


Route::get('/', [App\Http\Controllers\HomeController::class, 'show'] );
Route::post('/', [App\Http\Controllers\HomeController::class, 'storePhoneNumber'] );
Route::post('/custom', [App\Http\Controllers\HomeController::class, 'sendCustomMessage'] );

// Route::get('/', 'HomeController@show');
// Route::post('/', 'HomeController@storePhoneNumber');
// Route::post('/custom', 'HomeController@sendCustomMessage');

