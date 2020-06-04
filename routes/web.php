<?php

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
    return view('calendar.test');
});

// Route::resource('calendars', 'CalendarController', ['only' => 'show']);
Route::get('calendars', 'Auth\CalendarController@getDates')->name('calendars.month');
Route::get('calendar.show', function () {
    return view('calendar.test');
});