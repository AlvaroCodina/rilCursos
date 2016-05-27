@extends('layouts.pagina')

@section('header')
    @parent

    <title>Datos de {{ $profesor->nombre . " " . $profesor->apellidos }}</title>

@stop


@section('pagina')

    <div class="separacion-top"></div>

    <div class="container">
        <h3 class="text-center">Datos de {{ $profesor->nombre . " " . $profesor->apellidos }}</h3><br>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
                <p>CV y datos</p>
                <a class="btn btn-primary" href="javascript:history.back(1)">Volver</a>
            </div>
        </div>
    </div>

@stop

@section('footer')
    @parent

@stop