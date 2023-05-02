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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->longText("url");
            $table->unsignedBigInteger('paciente_id');
            $table->string('crea_id');
            $table->string('estado');
            $table->timestamps();
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete("cascade");
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('videos');
    }
};
