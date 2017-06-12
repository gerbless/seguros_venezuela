<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tarifario_id')->unsigned();
            $table->foreign('tarifario_id')->references('id')->on('tarifario')->OnDelete('cascade')->OnUpdate('cascade');
            $table->integer('poliza_pagador_id')->unsigned();
            $table->foreign('poliza_pagador_id')->references('id')->on('poliza_pagador')->OnDelete('cascade')->OnUpdate('cascade');
            $table->integer('users_id')->unsigned();
            $table->foreign('users_id')->references('id')->on('users')->OnDelete('cascade')->OnUpdate('cascade');
            $table->decimal('monto',20,2);
            $table->decimal('total',20,2);
            $table->integer('nu_asegurados');
            $table->mediumText('reporte_poliza');
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
        Schema::dropIfExists('ventas');
    }
}
