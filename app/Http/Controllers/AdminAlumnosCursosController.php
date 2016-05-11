<?php

namespace App\Http\Controllers;

use App\AlumnosCursos;
use App\Cursos;
use App\User;
use App\UsersCursos;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminAlumnosCursosController extends Controller
{
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

        /*$listaEspera = Cursos::find($id)->listaesperacursos()->get();
        $espera = array();
        foreach($listaEspera as $dts){
            $espera[] = User::find($dts->alumnos_id);
        }*/

        return view('admin.listado')->with('lista', $lista)->with('curso', $curso)->with('numAlumnos', $datos);     //->with('espera', $espera)

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
