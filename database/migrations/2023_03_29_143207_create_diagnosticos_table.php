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
        Schema::create('diagnosticos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("paciente_id");
            $table->date("fecha");
            $table->string("enfermedad");
            $table->string("antecedentes");
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

            $table->unsignedBigInteger("multimedia_gds_id")->nullable();
            $table->unsignedBigInteger("multimedia_mec_id")->nullable();
            $table->unsignedBigInteger("multimedia_cdr_id")->nullable();
            $table->unsignedBigInteger("multimedia_custom_id")->nullable();

            $table->foreign("multimedia_gds_id")->references("id")->on("multimedias")->onDelete("cascade");
            $table->foreign("multimedia_mec_id")->references("id")->on("multimedias")->onDelete("cascade");
            $table->foreign("multimedia_cdr_id")->references("id")->on("multimedias")->onDelete("cascade");
            $table->foreign("multimedia_custom_id")->references("id")->on("multimedias")->onDelete("cascade");
            
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
