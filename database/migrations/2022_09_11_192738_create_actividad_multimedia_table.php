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
        Schema::create('actividad_multimedia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('multimedia_id');
            $table->unsignedBigInteger('actividad_id');

            $table->foreign("multimedia_id")->references("id")->on("multimedias")->onDelete("cascade");
            $table->foreign("actividad_id")->references("id")->on("actividads")->onDelete("cascade");
            $table->unique(['multimedia_id', 'actividad_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividad_multimedia');
    }
};
