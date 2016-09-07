<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');
Route::get('select', 'HomeController@select');
Route::post('logout', 'HomeController@logout');
Route::get('getQrcode', 'HomeController@getQrcode');
Route::post('resetQrcode', 'HomeController@resetQrcode');

Route::get('passport', 'OauthController@login');
Route::post('passport', 'OauthController@check');

Route::get('uploadQRCode', 'QrcodeController@upload');
Route::post('uploadQRCode', 'QrcodeController@check');
