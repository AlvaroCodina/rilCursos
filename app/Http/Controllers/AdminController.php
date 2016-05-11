<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Auth;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function login()
    {
        return view('auth.login-admin');
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
            //$mes = $validator->messages();
            //dd($mes->get('email'));
            return redirect('/admin/login')
                ->withErrors($validator)->withInput();
        }

        $credentials  = ['email' => $request->get('email'), 'password' => $request->get('password')];

        if( Auth::guard('admin')->attempt($credentials) ){
            return redirect('/admin');
        }else{
            return redirect('/admin/login')
                ->withErrors(['errors' => 'Login Inválido'])
                ->withInput();
        }


        /*$validator = validator($request->all(), [
            'email' => 'required|min:3|max:100',
            'password' => 'required|min:3|max:100',
        ]);

        if($validator->fails()){
            return redirect('/admin/login')
                ->withErrors($validator)
                ->withInput();
        }

        $credentials  = ['email' => $request->get('email'), 'password' => $request->get('password')];

        if( auth()->guard('admin')->attempt($credentials) ){
            return redirect('/admin');
        }else{
            return redirect('/admin/login')
                ->withErrors(['errors' => 'Login Inválido'])
                ->withInput();
        }*/

    }

    public function logout()
    {
        //auth->guard('admin')->logout();
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }

}
