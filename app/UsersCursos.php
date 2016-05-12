<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UsersCursos extends Model
{
    protected $table = 'users_cursos';

    protected $fillable = array('users_id', 'cursos_id', 'pago');

    public function cursos()
    {
        return $this->belongsTo('App\Cursos');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public static function CountAlumnos($id){
        return DB::table('users_cursos')->where('cursos_id', '=', $id)->count();
    }

    public static function mirarAlumnos($alumno)
    {
        $alumnoscursos = UsersCursos::where('users_id', $alumno->id)->get();
        $cont = 0;
        foreach($alumnoscursos as $curso){
            $cont++;
        }
        if($cont==0){
            return false;
        }
        else{
            return $alumnoscursos;
        }
    }

    public static function mirarCursos($curso)
    {
        $alumnoscursos = UsersCursos::where('cursos_id', $curso->id)->get();
        $cont = 0;
        foreach($alumnoscursos as $curso){
            $cont++;
        }
        if($cont==0){
            return false;
        }
        else{
            return $alumnoscursos;
        }
    }

}
