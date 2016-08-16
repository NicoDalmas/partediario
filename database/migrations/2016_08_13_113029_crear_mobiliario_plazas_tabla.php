<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearMobiliarioPlazasTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobiliario_plazas', function (Blueprint $table) {

            $table->integer('id_plaza')->unsigned()->required();
            $table->foreign('id_plaza')->references('id_plaza')->on('informacion_plazas');
            $table->integer('hamaca')->nullable();
            $table->integer('subeybaja')->nullable();
            $table->integer('tobogan')->nullable();
            $table->integer('trepador')->nullable();
            $table->integer('circuitos_aerobicos')->nullable();
            $table->integer('pasamanos')->nullable();
            $table->integer('multijuego')->nullable();
            $table->integer('hamaca_inclusiva')->nullable();
            $table->integer('playon')->nullable();
            $table->integer('bebedero')->nullable();
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
        Schema::drop('mobiliario_plazas');
    }
}
