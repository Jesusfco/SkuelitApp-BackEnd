<?php

use Illuminate\Http\Request;

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

Route::post('login', 'LoginController@signin');
Route::get('checkAuth', 'LoginController@checkAuth');

Route::post('user/uniqueEmail', 'UserController@checkUniqueEmail');

Route::post('period/get', 'PeriodController@getPeriods');
Route::get('period/{id}', 'PeriodController@show');
Route::post('period/create', 'PeriodController@storePeriod');
Route::post('period/update', 'PeriodController@update');

Route::post('payment/get', 'PaymentController@get');
Route::get('payment/{id}', 'PaymentController@show');
Route::post('payment/store', 'PaymentController@store');
Route::post('payment/update', 'PaymentController@update');
Route::post('payment/periods', 'PaymentController@latestPeriods');