<?php

namespace App\Http\Controllers;

use App\Profesores;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AdminProfesoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.profesores')->with('profesor', false);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.profesores')->with('profesor', false);
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
            'nombre'    => 'required',
            'apellidos' => 'required',
            'email'     => 'required|email|unique:profesores',
        );

        $messages = [
            'required' => 'El campo :attribute es requerido.',
            'email' => 'El campo :attribute tiene que ser un email válido.',
            'unique' => 'El email ya está en uso.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            Input::flash();
            return view('admin.profesores')->with('profesor', false)->withInput(Input::all())->withErrors($validator);

        } else {

            Profesores::create($request->all());
            return redirect('/admin/profesores');

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
        $profesor = Profesores::find($id);

        return view('admin.profesores')->with('profesor', $profesor);
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
            'nombre'    => 'required',
            'apellidos' => 'required',
            'email'     => 'required|email',
        );

        $messages = [
            'required' => 'El campo :attribute es requerido.',
            'email' => 'El campo :attribute tiene que ser un email válido.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            Input::flash();
            return view('admin.profesores')->with('profesor', false)->withInput(Input::all())->withErrors($validator);
        } else {
            $profesor = Profesores::find($id);
            $profesor->nombre      = Input::get('nombre');
            $profesor->apellidos   = Input::get('apellidos');
            $profesor->email       = Input::get('email');
            $profesor->admin       = Input::get('admin');
            $profesor->update();

            return Redirect('/admin/profesores');
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
        $profesor = Profesores::find($id);
        $profesor->delete();

        return Redirect('/admin/profesores');
    }
}
