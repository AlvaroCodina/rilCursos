<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function prueba(){
        return view('admin.pruebaform');
    }

    public function datos(Request $request){
        // will output all our request and die
        dd($request->senal);
        //dd($request->nombre . " - " . $request->ids);


        //DB::table('users')->where('id', 1)->update(array('name' => $name));
    }

}
