<?php

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

// Auth
Route::post('/login', 'UserController@login');
Route::post('/register', 'UserController@register');
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('/details', 'UserController@details');
});

//API V1
Route::get('/dcard', 'APIController@getDcard');
Route::get('/dcardBefore', 'APIController@beforeId');
Route::get('/dcardSearch', 'APIController@searchContent');
Route::get('/article/{id}', 'APIController@getArticle');
Route::get('/date/{date1}/{date2}', 'APIController@getDateBetween');
Route::get('/date/today', 'APIController@getToday');
Route::get('/date/week', 'APIController@getWeek');
Route::get('/date/month', 'APIController@getMonth');
Route::get('/GBChart12Data', 'APIController@getGBChart12Month');
Route::get('/GBChart4Data', 'APIController@getGBChart4Month');
Route::get('/GBChartData/{date1}/{date2}', 'APIController@getGBChartDateBetween');
Route::get('/LineChart12Data', 'APIController@getLineChart12Month');

// API V2
Route::get('/v2/testData', 'APIV2Controller@testData');
