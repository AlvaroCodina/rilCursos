<?php

namespace App\Http\Controllers;

use App\Categorias;
use App\Profesores;
use App\UsersCursos;
use Illuminate\Http\Request;
use App\Cursos;
use App\Http\Requests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminCursosController extends Controller
{

    function devolver(){
        $categorias = Categorias::all();
        $profesores = Profesores::all();
        return view('admin.cursos')->with('curso', false)->with('categorias', $categorias)->with('profesores', $profesores)->with('fallo', 'no');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->devolver();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->devolver();
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
            'duracion'    => 'required',
            'resumen'     => 'required',
            'descripcion' => 'required',
            'lugar'       => 'required',
            'horario'     => 'required',
            'precios'     => 'required',
            'slug'        => 'required|unique:cursos',
            'numMax'      => 'required|integer|between:6,15',
            'numMin'      => 'required|integer|between:4,6',
            'fechaInicio' => 'required|date'
        );

        $messages = [
            'required' => 'El campo :attribute es requerido.',
            'integer' => 'El campo :attribute tiene que ser numero entero.',
            'numMax.between' => 'El campo :attribute tiene que ser un valor entre el 6 y el 15.',
            'numMin.between' => 'El campo :attribute tiene que ser un valor entre el 4 y el 6.',
            'date' => 'El campo :attribute tiene que ser fecha con formato: YYYY/MM/DD.',
            'unique' => 'El campo :attribute tiene que ser único.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {

            Input::flash();
            $categorias = Categorias::all();
            $profesores = Profesores::all();
            return view('admin.cursos')->with('curso', false)->with('categorias', $categorias)->with('profesores', $profesores)->withInput(Input::all())->withErrors($validator)->with('fallo', 'si');

        } else {

            $file = $request->file('foto');

            $filename = 'curso-'.$request['slug'].'.jpg';
            if($file){
                Storage::disk('local')->put($filename, File::get($file));
            }

            Cursos::create($request->all());
            return redirect('/admin/cursos');

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
        $curso = Cursos::find($id);
        $categorias = Categorias::all();
        $profesores = Profesores::all();
        return view('admin.cursos')->with('curso', $curso)->with('categorias', $categorias)->with('profesores', $profesores)->with('fallo', 'no');
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
            'duracion'    => 'required',
            'resumen'     => 'required',
            'descripcion' => 'required',
            'lugar'       => 'required',
            'horario'     => 'required',
            'precios'     => 'required',
            'slug'        => 'required',
            'numMax'      => 'required|integer|between:6,15',
            'numMin'      => 'required|integer|between:4,6',
            'fechaInicio' => 'required|date'
        );

        $messages = [
            'required' => 'El campo :attribute es requerido.',
            'integer' => 'El campo :attribute tiene que ser numero entero.',
            'numMax.between' => 'El campo :attribute tiene que ser un valor entre el 6 y el 15.',
            'numMin.between' => 'El campo :attribute tiene que ser un valor entre el 4 y el 6.',
            'date' => 'El campo :attribute tiene que tener la fecha y la hora.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            $categorias = Categorias::all();
            $profesores = Profesores::all();
            $cur = Cursos::find($id);
            Input::flash();
            return view('admin.cursos')->with('curso', $cur)->with('categorias', $categorias)->with('profesores', $profesores)->withInput(Input::all())->withErrors($validator)->with('fallo', 'sisi');
        } else {
            $curso = Cursos::find($id);
            $curso->idCategoria = Input::get('idCategoria');
            $curso->idProfesor  = Input::get('idProfesor');
            $curso->numMax      = Input::get('numMax');
            $curso->numMin      = Input::get('numMin');
            $curso->fechaInicio = Input::get('fechaInicio');
            $curso->duracion    = Input::get('duracion');
            $curso->resumen     = Input::get('resumen');
            $curso->descripcion = Input::get('descripcion');
            $curso->lugar       = Input::get('lugar');
            $curso->horario     = Input::get('horario');
            $curso->precios     = Input::get('precios');
            $curso->slug        = Input::get('slug');
            $curso->update();

            $file = $request->file('foto');

            $filename = 'curso-'.Input::get('slug').'.jpg';
            if($file){
                Storage::disk('local')->put($filename, File::get($file));
            }

            return Redirect('/admin/cursos');
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
        $curso = Cursos::find($id);
        $res = UsersCursos::mirarCursos($curso);
        if($res){
            foreach($res as $alumcurs){
                $alumcurs->delete();
            }
        }
        Storage::delete('curso-'.$curso->slug.'.jpg');
        $curso->delete();

        return Redirect('/admin/cursos');
    }
}
