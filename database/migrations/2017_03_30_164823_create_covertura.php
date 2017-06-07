<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCovertura extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coberturas', function (Blueprint $table) {
            $table->string('id',5);
            $table->primary('id');
            $table->string('plan_id',3);
            $table->foreign('plan_id')->references('id')->on('planes')->OnDelete('cascade')->OnUpdate('cascade');
            $table->string('nb_cobertura',60);
            $table->decimal('suma_asegurada',10,2);
            $table->integer('caso_muerte');
          /*  $table->integer('cacb_carb_cd_ramo');
            $table->string('cacb_de_cobertura',200);
            $table->string('ramo_id',3)->comment('CACB_CARP_CD_RAMO');
            $table->foreign('ramo_id')->references('id')->on('ramos')->OnDelete('cascade')->OnUpdate('cascade');
            $table->integer('cacb_caro_cd_ramo');
            $table->integer('cacb_mt_maximo');
            $table->string('cacb_in_sumarizacion',1);
            $table->string('cacb_in_cobertura_sub',1);
            $table->string('cacb_de_cobertura1',150);
            $table->string('cacb_de_cobertura2',150);
            $table->string('cacb_de_cobertura3',150);
            $table->string('cacb_in_aumento_automatico',1);
            $table->integer('cacb_mt_maximo_dolares');
            $table->string('cacb_in_valida_monto_sin',1);
            $table->string('cacb_in_sumapri',1)->nullable();
            $table->string('cacb_in_restitucion',60)->nullable();
            $table->string('cacb_in_servicios',1)->nullable();
            $table->string('cacb_de_prestador',60)->nullable();
            $table->integer('cacb_cd_cobertura_matriz');
            $table->string('cacb_ind_cob_basica',1)->nullable();
            $table->string('cacb_ind_cotiz_web',1)->nullable();
            $table->string('cacb_ind_bene_muerte',1)->nullable();
            $table->string('cacb_caps_tp_proveedor',20)->nullable();
            $table->string('cacb_caps_cd_proveedor',20)->nullable();
            $table->string('cacb_in_renta',20)->nullable();
            $table->string('cacb_fr_pago_renta',20)->nullable(); */
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
        Schema::dropIfExists('coberturas');
    }
}
