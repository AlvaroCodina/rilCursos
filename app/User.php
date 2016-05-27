<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'apellidos', 'email', 'telefono', 'camara', 'password', 'fechaNacimiento', 'localidad', 'conocimientosWin', 'conocimientosFoto', 'equipamiento',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userscursos()
    {
        return $this->hasMany('App\UsersCursos');
    }

    /**
     * Relación con Cursos
     */
    public function cursos()
    {
        return $this->belongsToMany('App\Cursos','users_cursos','users_id');
    }

    public static function ListaEspera($alumno)
    {

        $res = array();

        $lista = DB::table('lista_espera')->where('users_id', $alumno->id)->pluck('cursos_id');
        for ($i = 0; $i < count($lista); $i++) {
            $res[] = DB::table('cursos')->where('id', $lista[$i])->get();
        }

        if ($res == null) {
            return 0;
        } else {
            return $res;
        }
    }

    public static function ListaInteres($alumno)
    {

        $res = array();

        $lista = DB::table('lista_interesados')->where('users_id', $alumno->id)->pluck('cursos_id');
        for ($i = 0; $i < count($lista); $i++) {
            $res[] = DB::table('cursos')->where('id', $lista[$i])->get();
        }

        if ($res == null) {
            return 0;
        } else {
            return $res;
        }
    }

}
