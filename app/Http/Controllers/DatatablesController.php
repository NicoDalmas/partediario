<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Datatables;

use DB;

class DatatablesController extends Controller
{
    public function relevamiento()
    {
        $salidas = DB::table('informacion_plazas')
        	->select(['id_plaza', 'nombre', 'distrito', 'direccion', 'observaciones', 'latitud', 'longitud', 'codigo']);

        return Datatables::of($salidas)
        	->addColumn('action', function ($salidas) {
                return '<a href="#" class="btn btn-xs geolocalizar"><i class="glyphicon glyphicon-globe"></i></a><a href="#" data-id="'.$salidas->id_plaza.'" class="btn btn-xs info"><i class="glyphicon glyphicon-info-sign"></i></a><a href="/cargartrabajo/'.$salidas->id_plaza.'" class="btn btn-xs"><i class="glyphicon glyphicon-upload"></i></a>';
            })
        	->make(true);
    }
    public function trabajosCargados($id_plaza)
    {
        $tabladetalles = DB::table('trabajos_master')
            ->where('trabajos_master.id_plaza', '=', $id_plaza)
            ->join('users','trabajos_master.id_usuario', '=', 'users.id')
            ->select(['trabajos_master.descripcion', 'trabajos_master.fecha', 'trabajos_master.imagenes', 'users.name', 'trabajos_master.id_master']);
        return Datatables::of($tabladetalles)->make(true);
    }
}
