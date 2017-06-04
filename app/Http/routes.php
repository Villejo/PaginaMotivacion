<?php

// Rutas del Sistema
// Route::any('Inde', array('as'=>'Index','uses'=>'ControllerUsuarios\UsuariosController@Login'))->middleware('guest');
Route::any('/', array('as'=>'Index','uses'=>'ControllerIndex\IndexController@Index'))->middleware('guest');

Route::any('Principal', array('as'=>'Principal','uses'=>'ControllerIndex\IndexController@Principal'));






//--------------------------------fin control consolidados---------------------------------







// Termina Formulario 1



// Si no no existe la ruta va a la vista error
Route::any('{catchall}', function() {
	return Response::view('errors.503',array(),503);
})->where('catchall', '.*')->middleware('auth');



