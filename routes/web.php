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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/index',['as' => 'admins.index', 'uses' =>'EmployeeController@index'])->middleware('auth');
Route::get('/admin/create',['as' => 'create-employee', 'uses' =>'EmployeeController@create'])->middleware('auth');
Route::post('/admin/create',['as' => 'store-employee', 'uses' => 'EmployeeController@store'])->middleware('auth');
Route::get('/admin/{id}/destroy', array('as' => 'destroy-emp','uses' => 'EmployeeController@destroy'))->middleware('auth');
Route::get('/admin/{id}/edit', array('as' => 'edit-emp','uses' => 'EmployeeController@edit'))->middleware('auth');

Route::post('/admin/{id}/update', array('as' => 'update-employee','uses' => 'EmployeeController@update'))->middleware('auth');
Route::post('/admin/search',['as' => 'search-employee', 'uses' => 'EmployeeController@searchByName'])->middleware('auth');
//Route::post('/admin/update',['as' => 'update-employee', 'uses' => 'EmployeeController@update'])->middleware('auth');

Route::get('/admin/search',['as' => 'search', 'uses' =>'EmployeeController@searchByName']);