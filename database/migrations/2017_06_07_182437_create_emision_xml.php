<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmisionXml extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emision_xml', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('users_id')->unsigned()->nullable();
            $table->foreign('users_id')->references('id')->on('users')->OnDelete('cascade')->OnUpdate('cascade');
            $table->date('desde');
            $table->date('hasta');
            $table->mediumText('claves');
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
        Schema::dropIfExists('emision_xml');
    }
}
