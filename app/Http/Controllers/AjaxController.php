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
			->where('id_plaza', '=', $id )
			->select('*')
			->get();
    	return Response::json($rubrosub);
    }
    public function getCoordenadas()
    {
    	$coordinates=DB::table('relevamiento_plazas')
			->select('limpieza', 'jardineria', 'id_plaza', 'plaza')
			->get();

		$original_data = json_decode(json_encode($coordinates), true);
        $features = array();

        foreach($original_data as $key => $value) { 
            $features[] = array(
                    'type' => 'Feature',
                    'geometry' => array('type' => 'Point', 'coordinates' => array((float)$value['jardineria'],(float)$value['limpieza'])),
                    'properties' => array('name' => $value['plaza'], 'id' => $value['id_plaza']),
                    );
            };   

        $allfeatures = array('type' => 'FeatureCollection', 'features' => $features);

		return Response::json($allfeatures);
    }
}


