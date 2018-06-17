<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->increments('id_resource');
            $table->string('descripcion');
            $table->date('fechaFinal');
            $table->date('fechaInicial');
            $table->string('nombreDelRecurso');
            $table->string('origen');
            $table->string('relevancia');
            $table->string('tipo');
            $table->int('unidades');
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
        Schema::dropIfExists('resources');
    }
}
