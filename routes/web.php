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

Route::get('/'                  , function() { return redirect()->route('users.list'); });
Route::get('/usuarios'          , ['as' => 'users.list'   , 'uses' => 'UsersController@list']);
Route::get('/usuarios/ver/{id}' , ['as' => 'users.show'   , 'uses' => 'UsersController@show']);
Route::get('/usuarios/novo'     , ['as' => 'users.create' , 'uses' => 'UsersController@create']);
Route::post('/usuarios/salvar'  , ['as' => 'users.store'  , 'uses' => 'UsersController@store']);
Route::post('/usuarios/editar'  , ['as' => 'users.edit'   , 'uses' => 'UsersController@edit']);
Route::delete('usuarios/{id}'   , ['as' => 'users.delete' , 'uses' => 'UsersController@delete']);
