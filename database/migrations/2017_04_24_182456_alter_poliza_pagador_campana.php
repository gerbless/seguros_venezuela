<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPolizaPagadorCampana extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poliza_pagador', function (Blueprint $table) {
            $table->integer('campana_id')->unsigned()->nullable()->after('canal_id');
            $table->foreign('campana_id')->references('id')->on('campana')->OnDelete('cascade')->OnUpdate('cascade');
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
