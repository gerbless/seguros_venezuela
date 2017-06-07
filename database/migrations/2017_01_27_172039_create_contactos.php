<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void->nullable();
     */
    public function up()
    {
        Schema::create('contactos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('clientes_id')->unsigned();
            $table->foreign('clientes_id')->references('id')->on('clientes')->OnDelete('cascade')->OnUpdate('cascade');
            $table->integer('tpfnivel1_id')->unsigned();
            $table->foreign('tpfnivel1_id')->references('id')->on('tpfnivel1')->OnDelete('cascade')->OnUpdate('cascade');
            $table->integer('tpfnivel2_id')->unsigned()->nullable();
            $table->foreign('tpfnivel2_id')->references('id')->on('tpfnivel2')->OnDelete('cascade')->OnUpdate('cascade');
            $table->integer('tpfnivel3_id')->unsigned()->nullable();
            $table->foreign('tpfnivel3_id')->references('id')->on('tpfnivel3')->OnDelete('cascade')->OnUpdate('cascade');
            $table->integer('tpfnivel4_id')->unsigned()->nullable();
            $table->foreign('tpfnivel4_id')->references('id')->on('tpfnivel4')->OnDelete('cascade')->OnUpdate('cascade');
            $table->integer('users_id')->unsigned();
            $table->foreign('users_id')->references('id')->on('users')->OnDelete('cascade')->OnUpdate('cascade');
            $table->string('telefono',20);
            $table->mediumText('comentario');
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
        Schema::dropIfExists('contactos');
    }
}
