<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTrabajosMasterTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajos_master', function (Blueprint $table) {
            $table->increments('id_master');
            $table->integer('id_plaza')->unsigned();
            $table->foreign('id_plaza')->references('id_plaza')->on('informacion_plazas');
            $table->string('descripcion', 255);
            $table->date('fecha');
            $table->integer('imagenes')->default(0);
            $table->integer('id_usuario')->unsigned();
            $table->foreign('id_usuario')->references('id')->on('users');
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
        Schema::drop('trabajos_master');
    }
}
