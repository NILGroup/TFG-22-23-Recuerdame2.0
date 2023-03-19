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
            $table->string("diagnostico");
            $table->integer("gds")->nullable();
            $table->date("gds_fecha")->nullable();
            $table->integer("mental")->nullable();
            $table->date("mental_fecha")->nullable();
            $table->integer("cdr")->nullable();
            $table->date("cdr_fecha")->nullable();
            $table->string("nombre_escala")->nullable();
            $table->integer("escala")->nullable();
            $table->date("fecha_escala")->nullable();
            $table->string("observaciones")->nullable();
            
            $table->foreign("paciente_id")->references("id")->on("pacientes")->onDelete("cascade");
            $table->softDeletes();
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
