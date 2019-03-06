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

Route::get('/montarPizza', 'MontarPizzaController@create');
Route::get('/montarPizza/create', 'MontarPizzaController@create');
Route::post('/montarPizza/store',  [ 'as' => 'montarPizza.store', 'uses' => 'MontarPizzaController@store']);

Route::get('/', 'MontarPizzaController@create');

/*Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);*/
