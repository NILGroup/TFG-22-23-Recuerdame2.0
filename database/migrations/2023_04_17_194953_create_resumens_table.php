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
        Schema::create('resumens', function (Blueprint $table) {
            $table->id();
            $table->longText('titulo');
            $table->date('fecha')->nullable();
            $table->unsignedBigInteger('paciente_id');
            $table->longText('resumen');
            $table->timestamps();
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resumens');
    }
};
