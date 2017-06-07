<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePolizaAsegurados1A extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poliza_asegurados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nb_nombre',60);
            $table->integer('nu_documento');
            $table->mediumText('tx_direccion');
            $table->date('ff_registro')->nullable()->comment('totalmente opcional este campo');
            /*INICIO DE DATOS DE POERSONA NATURAL*/
            $table->string('nb_apellido',60)->nullable()->comment('aplica para personas naturales y juridica');
            $table->date('ff_ultima_actualizacion')->nullable()->comment('misma fecha de la transacción');
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
        Schema::dropIfExists('poliza_asegurados');
    }
}
