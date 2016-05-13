<?php

namespace App\Http\Controllers;

use App\Categorias;
use App\Cursos;
use App\Profesores;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AlumnosCursosController extends Controller
{

    public function getInscribirse($slug, $msg = null){
        $curso = Cursos::where('slug', $slug)->get();
        $categoria = Categorias::find($curso[0]->idCategoria);
        $profesor = Profesores::find($curso[0]->idProfesor);

        if (Auth::check())
        {
            return view('inscripcion')->with('curso', $curso[0])->with('categoria', $categoria)->with('profesor', $profesor)->with('msg', $msg);
        }
        else
        {
            return view('noinscripcion');
        }
    }

    public function getPagar($slug){
        $curso = Cursos::where('slug', $slug)->get();
        $categoria = Categorias::find($curso[0]->idCategoria);
        if(Cursos::terminado($curso[0]) >= 0){
            return view("pagar")->with("curso", $curso[0])->with("categoria", $categoria);
        }
        else{
            return $this->getInscribirse($curso[0]->slug, 'Este curso ya pasó');
        }
    }

    public function postPagar($idCurso, $idAlumno){
        DB::table('users_cursos')->insert(
            array('cursos_id' => $idCurso, 'users_id' => $idAlumno, 'pago' => 1)
        );
        return redirect("/cursos");
    }

}
