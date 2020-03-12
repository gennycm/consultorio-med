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
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth']], function() {
   // define your route, route groups here
   Route::get('/home', 'HomeController@index')->name('home');
   // userController.php
    Route::resource('/users', 'UserController');
    Route::resource('/roles', 'RoleController');
    Route::post('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
});



