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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/date/{date1}/{date2}', 'GetDateDcardController@index');
Route::get('/date/today', 'GetTodayDcardController@index');
Route::get('/date/week', 'GetWeekDcardController@index');
Route::get('/date/month', 'GetMonthDcardController@index');
Route::get('/GBChart12Data', 'GBChart12DataController@index');
