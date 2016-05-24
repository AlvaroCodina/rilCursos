<?php

namespace App\Http\Controllers;

use App\Plantillas;
use App\UsersCursos;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AdminAlumnosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plantillas = Plantillas::all();
        return view('admin.alumnos')->with('alumno', false)->with('plantillas', $plantillas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.alumnos')->with('alumno', false);
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
            'name'      => 'required',
            'apellidos' => 'required',
            'telefono'  => 'required',  //|integer
            'email'     => 'required|email|unique:users',
            //'password'  => 'required',
            //'password_confirmation'  => 'required|same:password',
        );

        $messages = [
            'required' => 'El campo :attribute es requerido.',
            'integer' => 'El campo :attribute debe ser numérico.',
            'same' => 'Las contraseñas tienen que coincidir.',
            'email' => 'El email tiene que ser válido.',
            'unique' => 'El email ya está en uso.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            Input::flash();
            $plantillas = Plantillas::all();
            return view('admin.alumnos')->with('alumno', false)->withInput(Input::all())->withErrors($validator)->with('plantillas', $plantillas);

        } else {

            $request->merge(['password' => Hash::make($request->password)]);

            User::create($request->all());
            return redirect('/admin/alumnos');

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
        $alumno = User::find($id);
        $plantillas = Plantillas::all();
        return view('admin.alumnos')->with('alumno', $alumno)->with('plantillas', $plantillas);
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
            'name'      => 'required',
            'apellidos' => 'required',
            'telefono'  => 'required',  //|integer
            'email'     => 'required|email',
            //'password'  => 'required',
        );

        $messages = [
            'required' => 'El campo :attribute es requerido.',
            'integer' => 'El campo :attribute debe ser numérico.',
            'email' => 'El email tiene que ser válido.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            Input::flash();
            $plantillas = Plantillas::all();
            return view('admin.alumnos')->with('alumno', false)->withInput(Input::all())->withErrors($validator)->with('plantillas', $plantillas);
        } else {
            $alumno = User::find($id);
            $alumno->name      = Input::get('name');
            $alumno->apellidos = Input::get('apellidos');
            $alumno->telefono  = Input::get('telefono');
            $alumno->email     = Input::get('email');
            $alumno->localidad = Input::get('localidad');
            $alumno->fechaNacimiento = Input::get('fechaNacimiento');
            $alumno->conocimientosWin = Input::get('conocimientosWin');
            $alumno->conocimientosFoto = Input::get('conocimientosFoto');
            $alumno->equipamiento = Input::get('equipamiento');
            //$alumno->password  = Input::get('password');
            $alumno->camara    = Input::get('camara');
            $alumno->update();

            return Redirect('/admin/alumnos');
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
        $alumno = User::find($id);
        $res = UsersCursos::mirarAlumnos($alumno);
        if($res){
            foreach($res as $alumcurs){
                $alumcurs->delete();
            }
        }
        $alumno->delete();

        return Redirect('/admin/alumnos');
    }
}
