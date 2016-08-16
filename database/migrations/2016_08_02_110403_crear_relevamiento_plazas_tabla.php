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

            $table->integer('id_plaza')->unsigned()->required();
            $table->foreign('id_plaza')->references('id_plaza')->on('informacion_plazas');
            $table->string('limpieza', 20)->nullable();
            $table->string('jardineria', 20)->nullable();
            $table->string('arbolado', 20)->nullable();
            $table->string('juegos', 20)->nullable();
            $table->string('bebederos', 20)->nullable();
            $table->string('estaciones_aerobicas', 20)->nullable();
            $table->string('bicicleteros', 20)->nullable();
            $table->string('cercos', 20)->nullable();
            $table->string('riego', 20)->nullable();
            $table->string('carteleria', 20)->nullable();
            $table->string('mobiliario', 20)->nullable();
            $table->string('mastil', 20)->nullable();
            $table->string('arenero', 20)->nullable();
            $table->string('caminos', 20)->nullable();
            $table->string('veredas', 20)->nullable();
            $table->string('luminarias', 20)->nullable();
            $table->string('esculturas', 20)->nullable();
            $table->string('playon', 20)->nullable();
            $table->string('cestos', 20)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('relevamiento_plazas');
    }
}
