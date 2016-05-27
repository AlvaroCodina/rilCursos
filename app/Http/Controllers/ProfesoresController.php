<?php

namespace App\Http\Controllers;

use App\Profesores;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProfesoresController extends Controller
{

    public function getProfesor($id){
        $profesor = Profesores::find($id);
        return view('profesor')->with('profesor', $profesor);
    }

}
