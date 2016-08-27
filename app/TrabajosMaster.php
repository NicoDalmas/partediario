<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrabajosMaster extends Model
{
    protected $table = 'trabajos_master';
	protected $primaryKey = 'id_master';
    //Definimos los campos que se pueden llenar con asignación masiva
    protected $fillable = ['imagenes','id_usuario'];

    public function detalles()
    {
    	return $this->hasMany('App\TrabajosDetalles');

    }
}
