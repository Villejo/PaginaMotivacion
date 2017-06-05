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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::any('/', array('as'=>'Index','uses'=>'ControllerIndex\IndexController@Index'))->middleware('guest');

Route::any('Principal', array('as'=>'Principal','uses'=>'ControllerIndex\IndexController@Principal'));






//--------------------------------fin control consolidados---------------------------------







// Termina Formulario 1



// Si no no existe la ruta va a la vista error
Route::any('{catchall}', function() {
	return Response::view('errors.503',array(),503);
})->where('catchall', '.*')->middleware('auth');



