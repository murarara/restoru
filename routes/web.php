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

Route::get('/', 'TopPageController@index')->name('index');


// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');

Route::post('login', 'Auth\LoginController@login')->name('login.post');

Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');

//Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

Route::post('signup', 'CreateUserController@store')->name('signup.post');

Route::group(['middleware' => 'auth'], function () {
    Route::get('reset_page', 'TopPageController@reset_page')->name('reset_page');
    Route::post('reset_password', 'TopPageController@reset_password')->name('reset_password');
    Route::get('change_department_page', 'TopPageController@change_department_page')->name('change_department_page');
    Route::post('change_department', 'TopPageController@change_department')->name('change_department');
    Route::get('susume_page', 'TopPageController@susume_page')->name('susume_page');
    Route::post('susume_post', 'TopPageController@susume_post')->name('susume_post');
});

//カレンダー
// Route::resource('/', 'CalendarController', ['only' => 'index']);
Route::resource('/main', 'CalendarController', ['only' => 'index']);
Route::resource('paidVacation', 'PaidVacationsController', ['only' => ['store']]);
// Route::get('/', 'PaidVacationsController@index');

