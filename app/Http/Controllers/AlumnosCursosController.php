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

    public function getInscribirse($slug){
        $curso = Cursos::where('slug', $slug)->get();
        $categoria = Categorias::find($curso[0]->idCategoria);
        $profesor = Profesores::find($curso[0]->idProfesor);

        if (Auth::check())
        {
            return view('inscripcion')->with('curso', $curso[0])->with('categoria', $categoria)->with('profesor', $profesor);
        }
        else
        {
            return view('noinscripcion');
        }
    }

    public function getPagar($slug){
        $curso = Cursos::where('slug', $slug)->get();
        $categoria = Categorias::find($curso[0]->idCategoria);
        return view("pagar")->with("curso", $curso[0])->with("categoria", $categoria);
    }

    public function postPagar($idCurso, $idAlumno){
        DB::table('users_cursos')->insert(
            array('cursos_id' => $idCurso, 'users_id' => $idAlumno)
        );
        return redirect("/cursos");
    }

}
