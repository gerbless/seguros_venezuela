<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAperturas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aperturas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('toque_apertura');
            $table->integer('tpfnivel1_id')->unsigned();
            $table->foreign('tpfnivel1_id')->references('id')->on('tpfnivel1')->OnDelete('cascade')->OnUpdate('cascade');
            $table->integer('tpfnivel2_id')->unsigned()->nullable();
            $table->foreign('tpfnivel2_id')->references('id')->on('tpfnivel2')->OnDelete('cascade')->OnUpdate('cascade');
            $table->integer('tpfnivel3_id')->unsigned()->nullable();
            $table->foreign('tpfnivel3_id')->references('id')->on('tpfnivel3')->OnDelete('cascade')->OnUpdate('cascade');
            $table->integer('tpfnivel4_id')->unsigned()->nullable();
            $table->foreign('tpfnivel4_id')->references('id')->on('tpfnivel4')->OnDelete('cascade')->OnUpdate('cascade');
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
        Schema::dropIfExists('aperturas');
    }
}
