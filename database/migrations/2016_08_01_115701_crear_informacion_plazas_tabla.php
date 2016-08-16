<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearInformacionPlazasTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informacion_plazas', function (Blueprint $table) {
            $table->increments('id_plaza');
            $table->string('nombre', 60);
            $table->string('direccion', 60);
            $table->string('codigo', 15);
            $table->string('distrito', 15);
            $table->string('latitud', 20);
            $table->string('longitud', 20);
            $table->string('observaciones', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
