<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sesion', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            //id_etapa int(11)
            $table->string('objetivo'); //varchar en laravel
            $table->string('descripcion');
            $table->string('barreras');
            $table->string('facilitadores');
            $table->date('fecha_finalizada');
            //id_paciente
            //id_usuario
            $table->string('respuesta');
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
        Schema::dropIfExists('sesion');
    }
};
