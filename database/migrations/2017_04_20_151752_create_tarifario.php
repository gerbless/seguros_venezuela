<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTarifario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarifario', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('campana_id')->unsigned();
            $table->foreign('campana_id')->references('id')->on('campana')->OnDelete('cascade')->OnUpdate('cascade');
            $table->string('ramo_id',3);
            $table->foreign('ramo_id')->references('id')->on('ramos')->OnDelete('cascade')->OnUpdate('cascade');
            $table->integer('producto_id');
            $table->foreign('producto_id')->references('id')->on('productos')->OnDelete('cascade')->OnUpdate('cascade');
            $table->string('plan_id',3);
            $table->foreign('plan_id')->references('id')->on('planes')->OnDelete('cascade')->OnUpdate('cascade');
            $table->string('frecuencia_pago_id',3);
            $table->foreign('frecuencia_pago_id')->references('id')->on('frecuencia_pago')->OnDelete('cascade')->OnUpdate('cascade');
            $table->decimal('prima',11,3);
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
        Schema::dropIfExists('tarifario');
    }
}
