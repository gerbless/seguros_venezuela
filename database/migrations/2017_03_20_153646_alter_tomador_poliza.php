<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTomadorPoliza extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tomador_poliza', function (Blueprint $table) {
            $table->integer('clientes_id')->unsigned()->after('id');
            $table->foreign('clientes_id')->references('id')->on('clientes')->OnDelete('cascade')->OnUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tomador_poliza', function (Blueprint $table) {
            //
        });
    }
}
