<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorias;
use App\Http\Requests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminCategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categorias')->with('categoria', false);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categorias')->with('categoria', false);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'nombre'      => 'required',
            'color'       => 'required',
            'descripcion' => 'required',
            'slug'        => 'required|unique:categorias',
        );

        $messages = [
            'required' => 'El campo :attribute es requerido.',
            'unique' => 'El campo :attribute tiene que ser único.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            Input::flash();
            return view('admin.categorias')->with('categoria', false)->withInput(Input::all())->withErrors($validator);

        } else {

            $file = $request->file('foto');

            $filename = 'categoria-'.$request['slug'].'.jpg';
            if($file){
                Storage::disk('local')->put($filename, File::get($file));
            }

            Categorias::create($request->all());
            return redirect('/admin/categorias');

        }
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = Categorias::find($id);

        return view('admin.categorias')->with('categoria', $categoria);
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
        $rules = array(
            'nombre'      => 'required',
            'color'       => 'required',
            'descripcion' => 'required',
            'slug'        => 'required',
        );

        $messages = [
            'required' => 'El campo :attribute es requerido.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            Input::flash();
            return view('admin.categorias')->with('categoria', false)->withInput(Input::all())->withErrors($validator);
        } else {
            $Categoria = Categorias::find($id);
            $Categoria->nombre      = Input::get('nombre');
            $Categoria->color       = Input::get('color');
            $Categoria->descripcion = Input::get('descripcion');
            $Categoria->slug        = Input::get('slug');
            $Categoria->update();

            $file = $request->file('foto');

            $filename = 'categoria-'.Input::get('slug').'.jpg';
            if($file){
                Storage::disk('local')->put($filename, File::get($file));
            }

            return Redirect('/admin/categorias');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categorias::find($id);
        if($categoria->id!=3){
            $res = Categorias::mirarCursos($categoria);
            if($res){
                foreach($res as $curso){
                    $curso->idCategoria = 3;
                    $curso->update();
                }
            }
        }

        Storage::delete('categoria-'.$categoria->slug.'.jpg');
        $categoria->delete();

        return Redirect('/admin/categorias');
    }
}
