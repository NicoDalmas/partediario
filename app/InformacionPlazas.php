<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InformacionPlazas extends Model
{
    protected $table = 'informacion_plazas';
	protected $primaryKey = 'id_plaza';
    //Definimos los campos que se pueden llenar con asignación masiva
    protected $fillable = ['nombre','direccion', 'codigo', 'distrito', 'latitud', 'longitud', 'observaciones'];
}
