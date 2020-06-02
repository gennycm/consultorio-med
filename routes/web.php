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

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
   // define your route, route groups here
   Route::get('/home', 'HomeController@index')->name('home');
   // userController.php
    Route::resource('/users', 'UserController');
    Route::get('/search-users', 'UserController@search');
    Route::get('/clean-users', 'UserController@clean');

    Route::resource('/roles', 'RoleController');
    
    Route::resource('/patients', 'PatientController');
    Route::get('/search-patients', 'PatientController@search');
    Route::get('/clean-patients', 'PatientController@clean');

    Route::resource('/institutions', 'InstitutionController');
    Route::get('/search-institutions', 'InstitutionController@search');
    Route::get('/clean-institutions', 'InstitutionController@clean');
   // Route::get('/filter-institutions', 'InstitutionController@filter');
    Route::post('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
});



