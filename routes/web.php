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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'WelcomeController@index');
// Route::get('/filter', 'WelcomeController@index');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::post('/addabstract', 'DashboardController@add_abstract');
Route::get('/abstract/{id}','WelcomeController@detail');
Route::post('/editabstract','DashboardController@update_abstract');
Route::get('/deleteabstract/{id}','DashboardController@delete_abstract');
