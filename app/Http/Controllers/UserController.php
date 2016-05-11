<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            return redirect('/login')
                ->withErrors($validator)->withInput();
        }

        $credentials  = ['email' => $request->get('email'), 'password' => $request->get('password')];

        if( Auth::guard('web')->attempt($credentials) ){
            return Redirect()->back();
            //return Redirect::to(URL::previous());
        }else{
            return redirect('/login')
                ->withErrors(['errors' => 'Login Inválido'])
                ->withInput();
        }

    }

    public function postRegister(Request $request)
    {
        $rules = array(
            'name' => 'required|min:3|max:100',
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
            return redirect('/register')
                ->withErrors($validator)->withInput();
        }

        $request->merge(['password' => Hash::make($request->password)]);

        Auth::guard('web')->login(User::create($request->all()));

        return Redirect()->back();
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/cursos');
    }
}
