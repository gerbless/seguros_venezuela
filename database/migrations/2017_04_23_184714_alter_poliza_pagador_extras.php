<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPolizaPagadorExtras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poliza_pagador', function (Blueprint $table) {
            $table->string('nb_apellido',60)->nullable()->comment('aplica para personas naturales y juridica');
            $table->date('ff_ultima_actualizacion')->nullable()->comment('misma fecha de la transacción');
            $table->integer('nivel_educativo_id')->unsigned();
            $table->foreign('nivel_educativo_id')->references('id')->on('nivel_educativo')->OnDelete('cascade')->OnUpdate('cascade');
            $table->integer('ocupacion_id')->unsigned();
            $table->foreign('ocupacion_id')->references('id')->on('ocupacion')->OnDelete('cascade')->OnUpdate('cascade');
            $table->date('ff_nacimiento');
            $table->string('sexo_id',1);
            $table->foreign('sexo_id')->references('id')->on('sexos')->OnDelete('cascade')->OnUpdate('cascade');
            $table->string('estadocivil_id',1);
            $table->foreign('estadocivil_id')->references('id')->on('estado_civil')->OnDelete('cascade')->OnUpdate('cascade');
            $table->integer('nu_hijos');
            $table->string('email');
            $table->integer('nu_tlf_hogar');
            $table->integer('nu_tlf_celular');
            $table->string('nb_empresa')->nullable()->comment('nombre de la empresa donde trabaja la persona');
            $table->string('nb_cargo')->nullable()->comment('cargo en que de sesenpena');
            $table->decimal('nu_ingresos',10,2)->nullable();
            $table->integer('nu_tlf_oficina1')->nullable()->comment('aplica para persona natural y empresa');
            $table->integer('nu_tlf_oficina2')->nullable()->comment('aplica para persona natural y empresa');
            /*FIN DE FATOS PERSONA NATURAL*/
            $table->integer('activida_economica_id')->unsigned();
            $table->foreign('activida_economica_id')->references('id')->on('activida_economica')->OnDelete('cascade')->OnUpdate('cascade');
            $table->integer('nu_capital_promedio')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
