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
            $table->string("url");
            $table->unsignedBigInteger('paciente_id');
            $table->string('estado');
            $table->timestamps();
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete("cascade");

        });
    }


    public function down()
    {
        Schema::dropIfExists('videos');
    }
};
