<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $fillable = array('nombre', 'color', 'descripcion', 'slug');

    public function cursos()
    {
        //return $this->belongsToMany('App\Cursos');
        return $this->belongsTo('App\Cursos');
    }

    public static function mirarCursos($categoria)
    {
        $cursos = Cursos::where('idCategoria', $categoria->id)->get();
        $cont = 0;
        foreach($cursos as $curso){
            $cont++;
        }
        if($cont==0){
            return false;
        }
        else{
            return $cursos;
        }
    }

}
