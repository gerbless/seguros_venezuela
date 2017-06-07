<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPolizaaseguradoTarifario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poliza_asegurados', function (Blueprint $table) {
            $table->integer('tarifario_id')->nullable()->after('id')->unsigned();
            $table->foreign('tarifario_id')->references('id')->on('tarifario')->OnDelete('cascade')->OnUpdate('cascade');
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
            //1
        });
    }
}
