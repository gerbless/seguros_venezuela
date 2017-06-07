<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cliente',100);
            $table->string('documento',20);
            $table->string('telefono1',20);
            $table->string('telefono2',20);
            $table->string('telefono3',20);
            $table->string('telefono4',20);
            $table->string('telefono5',20);
            $table->string('telefono6',20);
            $table->string('telefono7',20);
            $table->string('telefono8',20);
            $table->date('fecha');
            $table->mediumText('direccion');
            $table->string('dpto',20);
            $table->string('provincia',60);
            $table->string('distrito',60);
            $table->string('linea_credito',60);
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
        Schema::dropIfExists('clientes');
    }
}
