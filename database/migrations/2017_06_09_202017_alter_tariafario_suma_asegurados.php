<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTariafarioSumaAsegurados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tarifario', function (Blueprint $table) {
            $table->integer('suma_total_asegurados')->unsigned()->nullable()->after('prima');
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
