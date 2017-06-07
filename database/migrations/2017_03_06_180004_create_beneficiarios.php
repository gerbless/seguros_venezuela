<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficiarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('heredero_id',1);
            $table->foreign('heredero_id')->references('id')->on('herederos_legales')->OnDelete('cascade')->OnUpdate('cascade');
            $table->string('tipo_persona_id',1);
            $table->foreign('tipo_persona_id')->references('id')->on('tipo_persona')->OnDelete('cascade')->OnUpdate('cascade');
            $table->string('nacionalidad_id',1);
            $table->foreign('nacionalidad_id')->references('id')->on('nacionalidad')->OnDelete('cascade')->OnUpdate('cascade');
            $table->integer('nu_documento');
            $table->string('nb_nombre',60);
            $table->string('nb_apellido',60);
            $table->date('ff_nacimiento');
            $table->integer('edad');
            $table->string('tipobeneficiario_id',1);
            $table->foreign('tipobeneficiario_id')->references('id')->on('tipo_beneficiario')->OnDelete('cascade')->OnUpdate('cascade');
            $table->date('ff_registro');
            $table->date('ff_ultima_actualizacion')->nullable()->comment('misma fecha de la transacción');
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
        Schema::dropIfExists('beneficiarios');
    }
}
