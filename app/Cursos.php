<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    protected $table = 'cursos';

    protected $fillable = array('idCategoria', 'idProfesor', 'numMax', 'numMin', 'resumen', 'descripcion', 'lugar', 'imagen', 'fechaInicio', 'duracion', 'horario', 'precios', 'contenidosHtml', 'slug');



    /**
     * Obtiene los alumnos del curso.
     */
    public function userscursos()
    {
        return $this->hasMany('App\UsersCursos');
    }

    /**
     * Relación con Alumnos
     */
    public function users()
    {
        return $this->belongsToMany('App\User','users_cursos','cursos_id','users_id');
    }

    public function listaesperacursos()
    {
        return $this->hasMany('App\ListaEspera');
    }

    public function listainteresadoscursos()
    {
        return $this->hasMany('App\ListaInteresados');
    }

    public function categorias()
    {
        return $this->belongsToMany('App\Categorias');
    }

    public static function terminado($curso){
        $dt = Carbon::now();
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $curso->fechaInicio. ' 00:00:00');
        $diff = $dt->diffInDays($date, false);
        return $diff;
    }

}
