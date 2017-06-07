<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirecciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direcciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pais_id')->unsigned()->default(1)->comment('colocar por defecto 1');
            $table->foreign('pais_id')->references('id')->on('paises')->OnDelete('cascade')->OnUpdate('cascade');
            $table->string('estado_id',3);
            $table->foreign('estado_id')->references('id')->on('estados')->OnDelete('cascade')->OnUpdate('cascade');
            $table->integer('ciudad_id')->unsigned();
            $table->foreign('ciudad_id')->references('id')->on('ciudades')->OnDelete('cascade')->OnUpdate('cascade');
            $table->string('municipio_id',3);
            $table->foreign('municipio_id')->references('id')->on('municipios')->OnDelete('cascade')->OnUpdate('cascade');
            $table->string('nb_parroquia',60);
            $table->string('co_postal',3)->default(' ')->comment('colocar en blanco por defecto');
            $table->mediumText('tx_avenida_calle');
            $table->mediumText('tx_urbanizacion_direccion');
            $table->mediumText('nb_edificio_casa');
            $table->string('nu_piso',20)->default('NA')->comment('en caso de que no aplique por default colocamos NA');
            $table->string('nu_casa',20)->default('NA')->comment('en caso de que no aplique por default colocamos NA');
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
        Schema::dropIfExists('direcciones');
    }
}
