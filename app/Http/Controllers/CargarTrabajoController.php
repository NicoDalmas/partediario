<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use View;
use App\InformacionPlazas;
use App\TrabajosMaster;
use App\TrabajosDetalles;
use App\Image;
use Input;

class CargarTrabajoController extends Controller
{

    public function index($id)
    { 

		$plaza = InformacionPlazas::where('id_plaza', '=', $id)->first(); 

    	return View::make('cargartrabajos.cargartrabajos')->with('plaza', $plaza);
    }

    public function store(Request $request){

        DB::beginTransaction();

        try 
        {
            //Validaciones
            /*$validator = Validator::make($request->all(), [
                'tipo_retiro' => 'required|max:60',
                'destino' => 'required|integer',
                'usuario' => 'required|integer',
                'cantidad' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect()
                            ->back()
                            ->withErrors($validator)
                            ->withInput();
            }*/

            //Cargar datos en la tabla salida master
            $master = new TrabajosMaster;
            $master->id_usuario = $request->usuario;
            $contador = $request->contadorhidden;

            if($contador > 0)
            {
            	$master->imagenes = $contador;   
            }
            //Guardamos salidas master
            $master->save();

            //Obtenemos el id 
            $id = $master->id_master;

            if($contador > 0)
            {
                for($i=0;$i <count($contador);$i++)
                {
                    /*$update = array(
                                    'id' => $request->fotos[$i],
                                    );

                    Image::where('id', $request->fotos[$i])
                        ->update(['id_master' => $id]);*/

                    /*$flight = Image::find($request->fotos[$i]);

                    $flight->id_master = $id;

                    $flight->save();*/

                    $fotos = $request->fotos[$i];

                    foreach($fotos as $foto){

                        Image::where('id', $foto['fotos'])
                        ->update(['id_master' => $id]);

                    }
                }    
            }

            //Cargamos datos en la tabla salida detalles
            if($id > 0)
            {
                for($i=0;$i <count($request->mobiliario);$i++)
                {
                    $detalles = array(
                                    'id_master' => $id,
                                    'mobiliario'=> $request->mobiliario[$i],
                                    'tipo_trabajos'  => $request->tipos[$i],
                                    'cuadrilla' => $request->cuadrilla[$i],
                                    'descripcion' => $request->descripcion[$i]
                                    );
                    TrabajosDetalles::create($detalles);
                }    
            }


            //Commit y redirect con success
            DB::commit();
            return redirect()
                ->back()
                ->with('status', $update);
        }

        catch (Exception $e)
        {
            //Rollback y redirect con error
            DB::rollback();
            return redirect()
                ->back()
                ->withErrors('Se ha producido un errro: ( ' . $e->getCode() . ' ): ' . $e->getMessage().' - Copie este texto y envielo a informática');
        }
	}
}
