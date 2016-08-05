<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearRelevamientoPlazasTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relevamiento_plazas', function (Blueprint $table) {
            $table->increments('id_plaza');
            $table->string('plaza', 60);
            $table->string('distrito', 15);
            $table->date('relevado');
            $table->string('limpieza', 15);
            $table->string('jardineria', 15);
            $table->string('arbolado', 15);
            $table->string('juegos', 15);
            $table->string('bebederos', 15);
            $table->string('estaciones_aerobicas', 15);
            $table->string('bicicleteros', 15);
            $table->string('cercos', 15);
            $table->string('riego', 15);
            $table->string('carteleria', 15);
            $table->string('mobiliario', 15);
            $table->string('mastil', 15);
            $table->string('arenero', 15);
            $table->string('caminos', 15);
            $table->string('veredas', 15);
            $table->string('luminarias', 15);
            $table->string('esculturas', 15);
            $table->string('playon', 15);
            $table->string('cestos', 15);
            $table->string('observaciones', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('relevamiento_plazas');
    }
}
