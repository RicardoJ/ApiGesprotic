<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agreements', function (Blueprint $table) {
            $table->increments('id_agreement');
            $table->string('contenidoDelContrato');
            $table->string('fechaDeEntrega');
            $table->string('fechaDelContrato');
            $table->string('metodoDePago');
            $table->string('nombreDeLaEmpresa');
            $table->string('personaEncargada');
            $table->integer('provider_id')->unsigned();
            $table->timestamps();

            $table->foreign('id_provider')
                                ->references('id')->on('providers')
                                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agreements');
    }
}
