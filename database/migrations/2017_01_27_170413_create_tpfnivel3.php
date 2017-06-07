<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTpfnivel3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tpfnivel3', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tpfnivel2_id')->unsigned();
            $table->foreign('tpfnivel2_id')->references('id')->on('tpfnivel2')->OnDelete('cascade')->OnUpdate('cascade');
            $table->string('nb_tpfnivel3',60);
            $table->integer('orden');
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
        Schema::dropIfExists('tpfnivel3');
    }
}
