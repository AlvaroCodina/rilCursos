<?php

namespace App\Http\Controllers;

use App\Categorias;
use App\Cursos;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoriasController extends Controller
{

    /**
     * Genera una respuesta con la ruta de la imagen
     *
     * @param $filename nombre de la imagen
     * @return Response
     */
    public function getImagenCategoria($filename){
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

    }

    public function getCategoria($slug) {

        $categoria = Categorias::where('slug',$slug)->get();
        if ($categoria) {
            //$cursos = $categoria[0]->cursos();
            $cursos = DB::table('cursos')->where('idCategoria', $categoria[0]->id)->get();
            return view('categorias')->with('categoria', $categoria[0])->with('cursos', $cursos);
        }

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
