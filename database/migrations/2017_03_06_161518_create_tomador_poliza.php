<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTomadorPoliza extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tomador_poliza', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nb_nombre',60);
            $table->string('nacionalidad_id',1);
            $table->foreign('nacionalidad_id')->references('id')->on('nacionalidad')->OnDelete('cascade')->OnUpdate('cascade');
            $table->integer('nu_documento');
            $table->integer('direccion_id')->unsigned();
            $table->foreign('direccion_id')->references('id')->on('direcciones')->OnDelete('cascade')->OnUpdate('cascade');
            $table->date('ff_registro')->nullable()->comment('totalmente opcional este campo (Fecha de la emisión)');
            $table->string('tipo_persona_id',1);
            $table->foreign('tipo_persona_id')->references('id')->on('tipo_persona')->OnDelete('cascade')->OnUpdate('cascade');
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
        Schema::dropIfExists('tomador_poliza');
    }
}
