<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE cursos MODIFY COLUMN descripcion TEXT');
    }

    public function down()
    {
        DB::statement('ALTER TABLE cursos MODIFY COLUMN descripcion VARCHAR(255)');
    }
}
