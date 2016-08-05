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
        $salidas = DB::table('relevamiento_plazas')
        	->select(['id_plaza', 'plaza', 'distrito', 'relevado']);

        return Datatables::of($salidas)
        	->addColumn('action', function ($salidas) {
                return '<a href="#" class="btn btn-xs geolocalizar"><i class="glyphicon glyphicon-globe"></i></a><a href="#" class="btn btn-xs"><i class="glyphicon glyphicon-upload"></i></a>';
            })
        	->make(true);
    }
}
