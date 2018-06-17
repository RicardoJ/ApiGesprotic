<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonLearnedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_learneds', function (Blueprint $table) {
            $table->string('descripcion');
            $table->string('informe');
            $table->string('nombreDeLeccion');
            $table->string('objetivo');
            $table->foreign('id_project')
            ->references('id_project')->on('project')
            ->onDelete('cascade');
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
        Schema::dropIfExists('lesson_learneds');
    }
}
