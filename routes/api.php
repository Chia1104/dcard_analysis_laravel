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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::get('/getAllDcard/{limit}', 'GetAllDcardController@index');
Route::get('/getAllDcard/before/{beforeId}/{limit}', 'GetAllDcardController@beforeId');
Route::get('/getAllDcard/search/{content}', 'GetAllDcardController@searchContent');
Route::get('/article/{id}', 'GetArticleIdController@index');
Route::get('/date/{date1}/{date2}', 'GetDateDcardController@index');
Route::get('/date/today', 'GetTodayDcardController@index');
Route::get('/date/week', 'GetWeekDcardController@index');
Route::get('/date/month', 'GetMonthDcardController@index');
Route::get('/GBChart12Data', 'GBChart12DataController@index');
Route::get('/GBChart4Data', 'GBChart4DataController@index');
Route::get('/GBChartData/{date1}/{date2}', 'GetGBChartDataController@index');
Route::get('/LineChart12Data', 'LineChart12DataController@index');

Route::group(['middleware' => 'auth:api'], function(){
	Route::post('details', 'UserController@details');
});
