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
Route::post('/v2/login', 'UserController@login');
Route::post('/v2/register', 'UserController@register');
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('/v2/details', 'UserController@details');
});

// API V2
Route::get('/v2/dcard', 'Dcard\Controllers\DcardAPIController@getDcards');
Route::get('/v2/searchDcard', 'APIV2Controller@searchDcards');
Route::get('/v2/beforeDcard', 'APIV2Controller@beforeId');
Route::get('/v2/dcard/{id}', 'APIV2Controller@getDcardById');
Route::get('/v2/date/{date1}/{date2}', 'APIV2Controller@getDateBetween');
Route::get('/v2/date/{type}', 'APIV2Controller@getDateDcards');
Route::get('/v2/totalSAClass', 'APIV2Controller@getTotalSAClass');
Route::get('/v2/avgSAScore', 'APIV2Controller@getAvgSAScore');
