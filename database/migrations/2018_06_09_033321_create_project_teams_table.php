<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_teams', function (Blueprint $table) {
            $table->increments('id_projectteam');
            $table->string('nombreDelIntegranteDelProyecto');
            $table->string('rolDelIntegrante');
            $table->string('emailDelIntegrante');
            $table->string('competenciasDelIntegranteDelProyecto');
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
        Schema::dropIfExists('project_teams');
    }
}
