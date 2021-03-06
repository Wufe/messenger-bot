<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get(
	'/webhook',
	'FacebookWebhookController@validateWebhook'
);
Route::post(
	'/webhook',
	'FacebookWebhookController@receiveRequest'
)->middleware( 'webhook' );