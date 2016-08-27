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

            $master = new TrabajosMaster;
            $master->id_usuario = $request->usuario;
            $contador = $request->contadorhidden;

            if($contador > 0)
            {
            	$master->imagenes = $contador;   
            }
            else
            {
                $master->imagenes = 0;   
            }

            $master->save();

            //Obtenemos el id 
            $id = $master->id_master;

            if($contador > 0)
            {
                for($i=0 ; $i < $contador ; $i++)
                {
                    Image::where('id', $request->fotos[$i])
                        ->update(['id_master' => $id]);
                }    
            }

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
            return redirect('/home')
                ->with('status', 'Se ha procesado correctamente.');
        }

        catch (Exception $e)
        {
            //Rollback y redirect con error
            DB::rollback();
            return redirect('/home')
                ->withErrors('Se ha producido un errro: ( ' . $e->getCode() . ' ): ' . $e->getMessage().' - Copie este texto y envielo a informática');
        }
	}
}
