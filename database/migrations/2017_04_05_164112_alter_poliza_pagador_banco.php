<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPolizaPagadorBanco extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poliza_pagador', function (Blueprint $table) {
            $table->string('banco_id',3)->after("clientes_id")->nullable();
            $table->foreign('banco_id')->references('id')->on('bancos')->OnDelete('cascade')->OnUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('poliza_pagador', function (Blueprint $table) {
            //
        });
    }
}
