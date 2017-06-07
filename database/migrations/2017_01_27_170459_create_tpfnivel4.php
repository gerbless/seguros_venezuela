<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTpfnivel4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tpfnivel4', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tpfnivel3_id')->unsigned();
            $table->foreign('tpfnivel3_id')->references('id')->on('tpfnivel3')->OnDelete('cascade')->OnUpdate('cascade');
            $table->string('nb_tpfnivel4',60);
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
        Schema::dropIfExists('tpfnivel4');
    }
}
