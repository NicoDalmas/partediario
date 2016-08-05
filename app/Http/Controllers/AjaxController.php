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
}


