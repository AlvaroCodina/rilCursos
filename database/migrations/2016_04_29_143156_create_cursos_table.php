<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idCategoria')->unsigned();
            $table->foreign('idCategoria')->references('id')->on('categorias');
            $table->integer('idProfesor')->unsigned();
            $table->foreign('idProfesor')->references('id')->on('profesores');
            $table->date('fechaInicio');
            $table->integer('numMax');
            $table->integer('numMin');
            $table->string('duracion');
            $table->string('resumen');
            $table->string('descripcion');
            $table->string('imagen');
            $table->string('lugar');
            $table->string('horario');
            $table->string('contenidoHtml');
            $table->string('precios');
            $table->string('slug');
            $table->rememberToken();
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
        Schema::drop('cursos');
    }
}
