<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTarifariorango extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tarifario', function (Blueprint $table) {
            $table->integer('aplica_rango')->unsigned()->nullable()->after('prima');
            $table->foreign('aplica_rango')->references('id')->on('status')->OnDelete('cascade')->OnUpdate('cascade');
            $table->integer('rangoedad_id')->unsigned()->nullable()->after('aplica_rango');
            $table->foreign('rangoedad_id')->references('id')->on('rango_edad')->OnDelete('cascade')->OnUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tarifario', function (Blueprint $table) {
            //
        });
    }
}
