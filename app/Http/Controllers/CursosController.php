<?php

namespace App\Http\Controllers;

use App\Categorias;
use App\Cursos;
use App\Profesores;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CursosController extends Controller
{
    /**
     * Genera una respuesta con la ruta de la imagen
     *
     * @param $filename nombre de la imagen
     * @return Response
     */
    public function getImagenCurso($filename){
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ultimosCursos = DB::table('cursos')
            ->join('categorias', 'cursos.idCategoria', '=', 'categorias.id')
            ->select('cursos.*', 'categorias.nombre', 'categorias.color')
            ->orderBy('fechaInicio', 'desc')
            ->take(3)
            ->get();

        $categorias = Categorias::all();

        return view('inicio')->with('ultimosCursos', $ultimosCursos)->with('categorias', $categorias);
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
       //
    }

    public function getCurso($slug){
        $curso = Cursos::where('slug', $slug)->get();
        $categoria = Categorias::find($curso[0]->idCategoria);
        $profesor = Profesores::find($curso[0]->idProfesor);
        return view('cursos')->with('curso', $curso[0])->with('categoria', $categoria)->with('profesor', $profesor);
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
    public function destroy($id)
    {
        //
    }
}
