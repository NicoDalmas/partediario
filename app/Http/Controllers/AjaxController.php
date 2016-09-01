<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

use Response;

class AjaxController extends Controller
{
    public function getPlaza($id){
    	$rubrosub=DB::table('relevamiento_plazas')
            ->select('id_plaza', 'limpieza', 'jardineria', 'arbolado', 'juegos', 'bebederos', 'estaciones_aerobicas', 'bicicleteros', 'cercos', 'riego', 'carteleria', 'mobiliario', 'mastil', 'arenero', 'caminos', 'veredas', 'luminarias', 'esculturas', 'playon', 'cestos', 'created_at')
			->where('id_plaza', '=', $id )
			->get();
    	return Response::json($rubrosub);
    }
    public function getMobiliario($id){
        $rubrosub=DB::table('mobiliario_plazas')
            ->select('id_plaza', 'hamaca', 'subeybaja', 'tobogan', 'trepador', 'circuitos_aerobicos', 'pasamanos','multijuego', 'hamaca_inclusiva', 'playon as playon2', 'bebedero')
            ->where('id_plaza', '=', $id )
            ->get();
        return Response::json($rubrosub);
    }

    public function getCoordenadas()
    {
    	$coordinates=DB::table('informacion_plazas')
			->select('id_plaza', 'nombre', 'latitud', 'longitud', 'codigo')
			->get();

		$original_data = json_decode(json_encode($coordinates), true);
        $features = array();

        foreach($original_data as $key => $value) { 
            $features[] = array(
                    'type' => 'Feature',
                    'geometry' => array('type' => 'Point', 'coordinates' => array((float)$value['longitud'],(float)$value['latitud'])),
                    'properties' => array('name' => $value['nombre'], 'id' => $value['id_plaza'], 'codigo' => $value['codigo']),
                    );
            };   

        $allfeatures = array('type' => 'FeatureCollection', 'features' => $features);

		return Response::json($allfeatures);
    }
    public function getDetalles($id_master)
    {
        $detalles=DB::table('trabajos_detalles')
            ->where('id_master', '=', $id_master )
            ->select('mobiliario', 'tipo_trabajos','cuadrilla')
            ->get();
        return Response::json($detalles);
    }
}


