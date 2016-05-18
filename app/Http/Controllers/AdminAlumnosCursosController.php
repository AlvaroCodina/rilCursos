<?php

namespace App\Http\Controllers;

use App\AlumnosCursos;
use App\Cursos;
use App\ListaEspera;
use App\Plantillas;
use App\User;
use App\UsersCursos;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminAlumnosCursosController extends Controller
{

    public function getTextoPago($pago, $ids){
        $dts = explode("|", $ids);
        if($pago==0){ $r=1; }else{ $r=0; }
        DB::table('users_cursos')->where('cursos_id', $dts[0])->where('users_id', $dts[1])->update(array('pago' => $r));
        return redirect('/admin/alumnoscursos/' . $dts[0]);
    }

    public function insertAlumnoCurso($idCurso, $idAlumno){
        $contAlumno = UsersCursos::where('cursos_id', $idCurso)->count();
        $curso = Cursos::find($idCurso);
        if($contAlumno >= $curso->max){
            DB::table('lista_espera')->insert(
                array('cursos_id' => $idCurso, 'users_id' => $idAlumno, 'pago' => 0)
            );
        }else{
            DB::table('users_cursos')->insert(
                array('cursos_id' => $idCurso, 'users_id' => $idAlumno, 'pago' => 0)
            );
        }
        return redirect('/admin/alumnoscursos/' . $idCurso);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lista = Cursos::find($id)->users()->get();
        $curso = Cursos::find($id);
        $datos = UsersCursos::CountAlumnos($id);
        $alumnos = User::all();
        $plantillas = Plantillas::all();

        $dts = [];

        foreach($lista as $user){
            array_push($dts, array('id' => $user->id, 'name' => $user->name, 'apellidos' => $user->apellidos, 'email' => $user->email, 'telefono' => $user->telefono, 'pago' => $this->getPago($curso->id, $user->id), 'ids' => $id."|".$user->id."|0"));
        }

        $listaEspera = ListaEspera::where('cursos_id', $id)->get();
        $espera = array();
        foreach($listaEspera as $listesp){
            $espera[] = User::find($listesp->users_id);
        }

        return view('admin.listado')->with('lista', $dts)->with('curso', $curso)->with('numAlumnos', $datos)->with('alumnos', $alumnos)->with('plantillas', $plantillas)->with('espera', $espera);

    }

    function getPago($idCurso, $idUser){
        $dts = DB::table('users_cursos')->where('cursos_id', $idCurso)->where('users_id', $idUser)->pluck('pago');
        return $dts[0];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ids)
    {
        $dts = explode("|", $ids);
        $usercurso = UsersCursos::where('cursos_id', $dts[0])->where('users_id', $dts[1])->get();
        $usercurso[0]->delete();
        return Redirect('/admin/alumnoscursos/'.$dts[0]);
    }
}
