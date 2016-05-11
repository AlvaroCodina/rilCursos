<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlumnosCursos extends Model
{
    protected $table = 'alumnos_cursos';

    protected $fillable = array('idAlumno', 'idCurso');

    public function cursos()
    {
        return $this->belongsTo('App\Cursos');
    }
}
