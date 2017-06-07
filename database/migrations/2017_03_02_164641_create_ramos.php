<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRamos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ramos', function (Blueprint $table) {
            $table->string('id',3);
            $table->primary('id');
            $table->string('nb_ramo',120);
            $table->string('carp_tp_ramo',1);
            $table->string('carp_cd_sigla',5);
            $table->string('carp_in_financiado',1);
            $table->integer('carp_nu_meses_rehabilitar');
            $table->string('carp_in_violacion',1);
            $table->string('carp_tp_grupo',5);
            $table->string('carp_in_particular_colectivo',1);
            $table->string('carp_in_individual_colectivo',1);
            $table->string('carp_in_anulacion',1);
            $table->integer('carp_st_renovacion');
            $table->string('carp_fe_calculo_renovacion',10);
            $table->string('carp_in_solicitud_anulacion',10);
            $table->string('carp_in_renovacion_automatica',1);
            $table->string('carp_in_manejo_raco',1);
            $table->string('carp_cd_area',5);
            $table->string('carp_dias_anulacion',5);
            $table->string('carp_dias_prorroga',5);
            $table->string('carp_cd_sigla_mov',10);
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
        Schema::dropIfExists('ramos');
    }
}
