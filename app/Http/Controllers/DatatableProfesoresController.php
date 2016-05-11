<?php

namespace App\Http\Controllers;

use App\Profesores;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests;

class DatatableProfesoresController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return view('datatables.index');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        return Datatables::of(Profesores::query())->make(true);
    }
}
