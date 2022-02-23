<?php

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

// Auth
Route::post('/v2/login', 'Auth\Controllers\UserAPIController@login');
Route::post('/v2/register', 'Auth\Controllers\UserAPIController@register');
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('/v2/details', 'Auth\Controllers\UserAPIController@details');
});

// API V2
Route::get('/v2/dcard', 'Dcard\Controllers\DcardAPIController@getDcards');
Route::get('/v2/searchDcard', 'Dcard\Controllers\DcardAPIController@searchDcards');
Route::get('/v2/dcard/{id}', 'Dcard\Controllers\DcardAPIController@getDcardById');
Route::get('/v2/date/{date1}/{date2}', 'Dcard\Controllers\DcardAPIController@getDateBetween');
Route::get('/v2/date/{type}', 'Dcard\Controllers\DcardAPIController@getDateDcards');
Route::get('/v2/totalSAClass', 'Dcard\Controllers\ChartAPIController@getTotalSAClass');
Route::get('/v2/avgSAScore', 'Dcard\Controllers\ChartAPIController@getAvgSAScore');
