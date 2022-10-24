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
        Schema::create('multimedia_sesion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('multimedia_id');
            $table->unsignedBigInteger('sesion_id');
            $table->timestamps();

            $table->foreign("multimedia_id")->references("id")->on("multimedias")->onDelete("cascade");
            $table->foreign("sesion_id")->references("id")->on("sesions")->onDelete("cascade");
            $table->unique(['multimedia_id', 'sesion_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('multimedia_sesion');
    }
};
