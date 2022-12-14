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
        Schema::create('evaluacions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("paciente_id");
            $table->date("fecha");
            $table->integer("gds");
            $table->date("gds_fecha");
            $table->integer("mental");
            $table->date("mental_fecha");
            $table->integer("cdr");
            $table->date("cdr_fecha");
            $table->string("nombre_escala")->nullable();
            $table->integer("escala")->nullable();
            $table->date("fecha_escala")->nullable();
            $table->string("diagnostico");
            $table->string("observaciones")->nullable();
            
            $table->foreign("paciente_id")->references("id")->on("pacientes")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluacions');
    }
};
