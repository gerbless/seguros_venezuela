<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterClientesLote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('clientes', function (Blueprint $table) {
        $table->integer('lote_id')->unsigned()->after('users_id')->nullable();
        $table->foreign('lote_id')->references('id')->on('lote_masivo')->OnDelete('cascade')->OnUpdate('cascade');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
    Schema::table('clientes', function (Blueprint $table) {
        //
    });
}
}
