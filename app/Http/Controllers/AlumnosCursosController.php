<?php

namespace App\Http\Controllers;

use App\Categorias;
use App\Cursos;
use App\ListaEspera;
use App\ListaInteresados;
use App\Profesores;
use App\User;
use App\UsersCursos;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

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
            $contAlumno = UsersCursos::where('cursos_id', $curso[0]->id)->count();
            if($contAlumno >= $curso[0]->numMax){
                DB::table('lista_espera')->insert(
                    array('cursos_id' => $curso[0]->id, 'users_id' => Auth::user()->id, 'regalo' => 0)
                );
                return $this->getInscribirse($curso[0]->slug, 'Estas en la lista de espera');
            }else{
                DB::table('users_cursos')->insert(
                    array('cursos_id' => $curso[0]->id, 'users_id' => Auth::user()->id, 'regalo' => 0)
                );
                return view("pagar")->with("curso", $curso[0])->with("categoria", $categoria);
            }
        }
        else{
            return $this->getInscribirse($curso[0]->slug, 'Este curso ya pasó');
        }
    }

    public function postPagar(){
        return redirect("/cursos");
    }

    public function getCursosAlumno($id){
        $alumno = User::find($id);
        $cursos = $alumno->cursos()->get();
        return view('admin.listadocursos')->with('cursos', $cursos)->with('alumno', $alumno);
    }

    public function deleteCursosAlumno($ids){
        $dts = explode('|', $ids);
        $usercurso = UsersCursos::where('cursos_id', $dts[1])->where('users_id', $dts[0])->get();
        $usercurso[0]->delete();
        return Redirect('/admin/cursosalumnos/'.$dts[0]);
    }

    public function getDatos(){
        $alumno = User::where('email', Auth::user()->email)->get();

        $cursos = User::find($alumno[0]->id)->cursos()->orderBy('fechaInicio', 'desc')->get();

        $listaEspera = User::ListaEspera($alumno[0]);

        $listaInteres = User::ListaInteres($alumno[0]);

        return view('datosAlumno')->with('alumno', $alumno[0])->with('cursos', $cursos)->with('espera', $listaEspera)->with('interes', $listaInteres[0]);
    }

    public function editarAlumno($id){
        $user = User::find($id);
        return view('editAlumno')->with('alumno', $user);
    }

    public function updateAlumno(){
        $rules = array(
            'name'      => 'required',
            'apellidos' => 'required',
            'telefono'  => 'required',
            'email'     => 'required|email',
        );

        $messages = [
            'required' => 'El campo :attribute es requerido.',
            'integer' => 'El campo :attribute debe ser numérico.',
            'email' => 'El email tiene que ser válido.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            Input::flash();
            $user = User::find(Auth::user()->id);
            return view('editAlumno')->with('alumno', $user)->withInput(Input::all())->withErrors($validator);
        } else {
            $alumno = User::find(Auth::user()->id);
            $alumno->name      = Input::get('name');
            $alumno->apellidos = Input::get('apellidos');
            $alumno->telefono  = Input::get('telefono');
            $alumno->email     = Input::get('email');
            $alumno->camara    = Input::get('camara');
            $alumno->update();

            return Redirect('/datos');
        }
    }

    public function interesado(){
        $idAlumno = Input::get('idAlumno');
        $idCurso = Input::get('idCurso');
        DB::table('lista_interesados')->insert(
            array('cursos_id' => $idCurso, 'users_id' => $idAlumno)
        );
    }

    public function bajaInteresado(){
        $ids = Input::get('ids');
        $dts = explode('-', $ids);
        $interes = ListaInteresados::where('cursos_id', $dts[1])->where('users_id', $dts[2])->get();
        $interes[0]->delete();
    }

    public static function getInteres($id){
        $interes = ListaInteresados::where('cursos_id', $id)->where('users_id', Auth::user()->id)->get();
        if($interes=="[]"){
            return "lightblue";
        }
        else{
            return "lightgreen";
        }
    }

}
