<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRangoEdad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rango_edad', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('minimo');
            $table->integer('maximo');
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('status')->OnDelete('cascade')->OnUpdate('cascade');
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
        Schema::dropIfExists('rango_edad');
    }
}
