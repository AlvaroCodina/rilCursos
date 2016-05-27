<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function login()
    {
        if(Auth::user()){
            return Redirect('/cursos');
        }
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function postLogin(Request $request)
    {

        $rules = array(
            'email' => 'required|min:3|max:100',
            'password' => 'required|min:3|max:100',
        );
        $messages = [
            'required' => 'El campo :attribute es requerido.',
            'min' => 'El campo :attribute tiene que tener 3 caracteres mínimo.',
            'max' => 'El campo :attribute tiene que tener 100 caracteres máximo.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            Input::flash();
            return view('auth.login')->withInput(Input::all())->withErrors($validator);
        }

        $credentials  = ['email' => $request->get('email'), 'password' => $request->get('password')];

        if( Auth::guard('web')->attempt($credentials) ){
            if ($request->is('/login')) {
                return redirect("/cursos");
            }
            else{
                return Redirect()->back();
            }
        }else{
            Input::flash();
            return view('auth.login')->withInput(Input::all())->with('valido', 'El email o la contraseña no son correctos!');
        }

    }

    public function postRegister(Request $request)
    {
        $rules = array(
            'name' => 'required|min:3|max:100',
            'apellidos' => 'required|min:3|max:100',
            'email' => 'required|min:3|max:100',
            'telefono' => 'required|integer',
            'password' => 'required|min:3|max:100',
            'password_confirmation' => 'required|same:password',
        );
        $messages = [
            'required' => 'El campo :attribute es requerido.',
            'min' => 'El campo :attribute tiene que tener 3 caracteres mínimo.',
            'max' => 'El campo :attribute tiene que tener 100 caracteres máximo.',
            'same' => 'Las contraseñas tienen que coincidir.',
            'integer' => 'El campo :attribute tiene que ser numérico.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            Input::flash();
            return view('auth.register')->withInput(Input::all())->withErrors($validator);
        }

        $request->merge(['password' => Hash::make($request->password)]);

        Auth::guard('web')->login(User::create($request->all()));

        if ($request->is('/register')) {
            return redirect("/cursos");
        }
        else{
            return Redirect()->back();
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/cursos');
    }
}
