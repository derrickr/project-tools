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
    return redirect()->route('login');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('logout','Auth\LoginController@logout');

Route::group(['middleware'=>'auth'],function(){
    Route::get('dashboard','DashboardController@index')->name('dashboard');
});

Route::group(['prefix' => 'resource','middleware' => ['auth','roles'],'roles'=>['admin']], function () {
    Route::get('/', 'ResourceController@create')->name('resource.create');
    Route::post('store', 'ResourceController@store')->name('resource.store');
    Route::put('update/{id}', 'ResourceController@update')->name('resource.update');
});
Route::get('resources', 'ResourceController@index')->name('resource.list');

Route::group(['prefix' => 'user', 'middleware' => ['auth','roles'],'roles'=>['admin']], function () {
    Route::get('/', 'UserController@create')->name('user.create');
    Route::post('check', 'UserController@check')->name('user.check');
    Route::post('add', 'UserController@store')->name('user.store');
    Route::put('update/{id}', 'UserController@update')->name('user.update');
});
Route::get('users', 'UserController@index')->name('user.list');

Route::group(['prefix' => 'action','middleware' => ['auth']], function () {
    Route::get('/', 'ActionController@create')->name('action.create');
    Route::post('add', 'ActionController@store')->name('action.store');
    Route::put('update/{id}', 'ActionController@update')->name('action.update');
});
Route::get('actions', 'ActionController@index')->name('action.list');

Route::group(['prefix' => 'request','middleware' => ['auth']], function () {
    Route::get('/', 'RequestController@create')->name('request.create');
    Route::post('add', 'RequestController@store')->name('request.store');
    Route::put('update/{id}', 'RequestController@update')->name('request.update');
    Route::get('history/{id}', 'RequestController@history')->name('request.history');
    Route::post('action/{action}', 'RequestController@actions')->name('request.action');
    Route::put('action/{action}/{id}', 'RequestController@save_action')->name('request.action');
});
Route::get('requests', 'RequestController@index')->name('request.list');

Route::group(['prefix' => 'docs','middleware' => ['auth']], function () {
    Route::get('/operatingprocedure', 'DocumentationController@operation')->name('docs.operatingprocedure');
    Route::get('/roles', 'DocumentationController@roles')->name('docs.roles');
    Route::get('/notifications', 'DocumentationController@notification')->name('docs.notifications');
    Route::get('/background', 'DocumentationController@background')->name('docs.background');
});
Route::get('docs', 'DocumentationController@index')->name('docs.process');