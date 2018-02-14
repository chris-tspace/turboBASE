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
Route::get("/engineType/autocompleteFamily", 'engineTypeController@autocompleteFamily')->name('engineType.autocompleteFamily');
Route::post('/engineType', 'EngineTypeController@store')->name('engineType.store');
Route::get('/engineType/{engineType}', 'EngineTypeController@show')->name('engineType.show');
Route::get('/engineType/{engineType}/edit', 'EngineTypeController@edit')->name('engineType.edit');
Route::patch('/engineType/{engineType}', 'EngineTypeController@update')->name('engineType.update');
Route::delete('/engineType/{engineType}', 'EngineTypeController@destroy')->name('engineType.destroy');

Route::get('/engine', 'EngineController@index')->name('engine.index');
Route::get('/engine/create', 'EngineController@create')->name('engine.create');
Route::post('/engine', 'EngineController@store')->name('engine.store');
Route::post('/engine/installAircraft', 'EngineController@installAircraft')->name('engine.installAircraft');
Route::get('/engine/{engine}', 'EngineController@show')->name('engine.show');
Route::get('/engine/{engine}/edit', 'EngineController@edit')->name('engine.edit');
Route::patch('/engine/{engine}', 'EngineController@update')->name('engine.update');
Route::patch('/engine/{engine}/removeAircraft', 'EngineController@removeAircraft')->name('engine.removeAircraft');
Route::delete('/engine/{engine}', 'EngineController@destroy')->name('engine.destroy');

Route::get('/aircraftType', 'AircraftTypeController@index')->name('aircraftType.index');
Route::get('/aircraftType/create', 'AircraftTypeController@create')->name('aircraftType.create');
Route::get("/aircraftType/autocompleteManufacturer", 'AircraftTypeController@autocompleteManufacturer')->name('aircraftType.autocompleteManufacturer');
Route::get('/aircraftType/createVersion/{aircraftType}', 'AircraftTypeController@createVersion')->name('aircraftType.createVersion');
Route::post('/aircraftType', 'AircraftTypeController@store')->name('aircraftType.store');
Route::get('/aircraftType/{aircraftType}', 'AircraftTypeController@show')->name('aircraftType.show');
Route::get('/aircraftType/{aircraftType}/edit', 'AircraftTypeController@edit')->name('aircraftType.edit');
Route::patch('/aircraftType/{aircraftType}', 'AircraftTypeController@update')->name('aircraftType.update');
Route::delete('/aircraftType/{aircraftType}', 'AircraftTypeController@destroy')->name('aircraftType.destroy');

Route::get('/aircraft', 'AircraftController@index')->name('aircraft.index');
Route::get('/aircraft/create', 'AircraftController@create')->name('aircraft.create');
Route::post('/aircraft', 'AircraftController@store')->name('aircraft.store');
Route::get('/aircraft/{aircraft}', 'AircraftController@show')->name('aircraft.show');
Route::get('/aircraft/{aircraft}/edit', 'AircraftController@edit')->name('aircraft.edit');
Route::patch('/aircraft/{aircraft}', 'AircraftController@update')->name('aircraft.update');
Route::delete('/aircraft/{aircraft}', 'AircraftController@destroy')->name('aircraft.destroy');

Route::get('/post', 'PostController@index')->name('post.index');
Route::get('/post/create', 'PostController@create')->name('post.create');
Route::post('/post', 'PostController@store')->name('post.store');
Route::get('/post/{post}', 'PostController@show')->name('post.show');
Route::get('/post/{post}/edit', 'PostController@edit')->name('post.edit');
Route::patch('/post/{post}', 'PostController@update')->name('post.update');
Route::delete('/post/{post}', 'PostController@destroy')->name('post.destroy');

Route::get('/comment', 'CommentController@index')->name('comment.index');
Route::get('/comment/create', 'CommentController@create')->name('comment.create');
Route::post('/comment', 'CommentController@store')->name('comment.store');
Route::get('/comment/{comment}', 'CommentController@show')->name('comment.show');
Route::get('/comment/{comment}/edit', 'CommentController@edit')->name('comment.edit');
Route::patch('/comment/{comment}', 'CommentController@update')->name('comment.update');
Route::delete('/comment/{comment}', 'CommentController@destroy')->name('comment.destroy');