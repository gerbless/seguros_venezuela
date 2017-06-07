<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPolizaAsegurados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poliza_asegurados', function (Blueprint $table) {
            $table->integer('cliente_id')->unsigned()->after('id');
            $table->foreign('cliente_id')->references('id')->on('clientes')->OnDelete('cascade')->OnUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('poliza_asegurados', function (Blueprint $table) {
            //
        });
    }
}
