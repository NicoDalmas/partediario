<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrabajosDetalles extends Model
{
    protected $table = 'trabajos_detalles';
	protected $primaryKey = 'id_detalle';
    //Definimos los campos que se pueden llenar con asignación masiva
    protected $fillable = ['id_master','mobiliario','tipo_trabajos', 'cuadrilla', 'descripcion'];

    public function master()
    {
    	return $this->belongsTo('App\TrabajosMaster');
    }
}
