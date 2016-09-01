<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTrabajosDetallesTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajos_detalles', function (Blueprint $table) {
            $table->increments('id_detalle');
            $table->integer('id_master')->unsigned();
            $table->foreign('id_master')->references('id_master')->on('trabajos_master');
            $table->string('mobiliario', 60);
            $table->string('tipo_trabajos', 60);
            $table->string('cuadrilla', 60);
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
        Schema::drop('trabajos_detalles');
    }
}
