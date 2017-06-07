<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRamosCampana extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ramos', function (Blueprint $table) {
            $table->integer('campana_id')->unsigned()->after('id');
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
        Schema::table('ramos', function (Blueprint $table) {
            //
        });
    }
}
