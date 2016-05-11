<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos_cursos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idCurso')->unsigned();
            $table->foreign('idCurso')->references('id')->on('cursos');
            $table->integer('idAlumno')->unsigned();
            $table->foreign('idAlumno')->references('id')->on('users');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('alumnos_cursos');
    }
}
