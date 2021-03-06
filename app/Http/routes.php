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

Route::get('/cargartrabajo/{id}', ['uses' => 'CargarTrabajoController@index']);

Route::get('/datatables/relevamiento', ['uses' => 'DatatablesController@relevamiento']);


Route::get('/datatables/detallestrabajos/{id_plaza}', ['uses' => 'DatatablesController@trabajosCargados']);

Route::post('/movimientos/addsalida', ['as' => 'addsalida', 'uses' => 'MovimientosController@store']);

Route::post('/movimientos/addtrabajo', ['as' => 'addtrabajo', 'uses' => 'CargarTrabajoController@store']);


//RESPUESTAS AJAX JSON/ARRAY

Route::get('/ajax/viewplaza/{id}', ['uses' => 'AjaxController@getPlaza']);

Route::get('/ajax/mobiliario/{id}', ['uses' => 'AjaxController@getMobiliario']);

Route::get('/ajax/geoplazas', ['uses' => 'AjaxController@getCoordenadas']);

Route::get('/ajax/detallestrabajos/{id_master}', ['uses' => 'AjaxController@getDetalles']);

//IMAGENES

Route::post('cargartrabajo/store', ['as' => 'store-trabajo', 'uses' =>'CargarTrabajoController@store']);

Route::post('/cargartrabajo/imagenes/upload', ['uses' =>'ImagenesController@postUpload']);

Route::post('cargartrabajo/imagenes/delete', ['as' => 'upload-remove', 'uses' =>'ImagenesController@deleteUpload']);