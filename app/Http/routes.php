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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/salidas', function () {
    return alert("hola");
});
Route::auth();

Route::get('/home', 'HomeController@index');

Route::auth();

Route::get('/home', 'HomeController@index');


Route::get('/datatables/relevamiento', ['uses' => 'DatatablesController@relevamiento']);

Route::post('/movimientos/addsalida', ['as' => 'addsalida', 'uses' => 'MovimientosController@store']);


//RESPUESTAS AJAX JSON/ARRAY

Route::get('/ajax/viewplaza/{id}', ['uses' => 'AjaxController@getPlaza']);

Route::get('/ajax/geoplazas', ['uses' => 'AjaxController@getCoordenadas']);