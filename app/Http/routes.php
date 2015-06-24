<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/','Auth\AuthController@toHome');
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('home',[
    'middleware'=>'auth',
    'uses'=>'AbsencesController@getHome'
]);
Route::post('home',[
    'middleware'=>'auth',
    'uses'=>'AbsencesController@postHome'
]);

Route::get('home/tambahAbsen',[
    'middleware'=>'auth',
    'uses'=>'AbsencesController@getInsert'
]);
Route::post('home/tambahAbsen',[
    'middleware'=>'auth',
    'uses'=>'AbsencesController@postInsert'
]);

Route::get('home/laporan',[
    'middleware'=>'auth',
    'uses'=>'LaporanController@getIndex'
]);
Route::get('home/student/{nis}',[
    'middleware'=>'auth',
    'uses'=>'LaporanController@getShow'
]);
Route::post('home/laporan',[
    'middleware'=>'auth',
    'uses'=>'LaporanController@exportLaporan'
]);
Route::get('home/configuration',[
    'middleware'=>'auth',
    'uses'=>'AbsencesController@getConfig'
]);
Route::post('home/configuration',[
    'middleware'=>'auth',
    'uses'=>'AbsencesController@postConfig'
]);
Route::get('/tes','LaporanController@getBanyak');