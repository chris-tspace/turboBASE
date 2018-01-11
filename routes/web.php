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

Auth::routes();

Route::get('/test', function() { return view('test'); });

Route::redirect('/', '/login');
Route::redirect('/home', '/engine')->name('home');

Route::get('/engineType', 'EngineTypeController@index')->name('engineType.index');
Route::get('/engineType/create', 'EngineTypeController@create')->name('engineType.create');
Route::post('/engineType', 'EngineTypeController@store')->name('engineType.store');
Route::get('/engineType/{engineType}', 'EngineTypeController@show')->name('engineType.show');
Route::get('/engineType/{engineType}/edit', 'EngineTypeController@edit')->name('engineType.edit');
Route::patch('/engineType/{engineType}', 'EngineTypeController@update')->name('engineType.update');
Route::delete('/engineType/{engineType}', 'EngineTypeController@destroy')->name('engineType.destroy');

Route::get('/engine', 'EngineController@index')->name('engine.index');
Route::get('/engine/create', 'EngineController@create')->name('engine.create');
Route::post('/engine', 'EngineController@store')->name('engine.store');
Route::get('/engine/{engine}', 'EngineController@show')->name('engine.show');
Route::get('/engine/{engine}/edit', 'EngineController@edit')->name('engine.edit');
Route::patch('/engine/{engine}', 'EngineController@update')->name('engine.update');
Route::delete('/engine/{engine}', 'EngineController@destroy')->name('engine.destroy');