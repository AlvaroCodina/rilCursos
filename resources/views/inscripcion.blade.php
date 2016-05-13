@extends('layouts.pagina')

@section('header')
    @parent

    <title>Inscripcion {{ $categoria->nombre }}</title>

@stop


@section('pagina')

    <div class="separacion-top"></div>

    <div class="container">
        <h3 class="text-center">Inscripcion al curso: {{ $categoria->nombre }} <small>{{ $curso->horario }}</small></h3><br>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <h3>{{ $curso->resumen }}</h3><br>
                        <p>{{ $curso->descripcion }}</p>
                        <p>El curso se realizará a fecha de: {{ $curso->fechaInicio." con una duración de:  ".$curso->duracion }}</p><br>
                        <blockquote>
                            {{ $curso->lugar }}
                        </blockquote><br>
                        <p>El precio por persona es de: {{ $curso->precios }}</p><br>
                        <p>El profesor que dará la clase es: {{ $profesor->nombre." ".$profesor->apellidos }}</p><br>
                        @if(Storage::disk('local')->has('curso-'.$curso->slug.'.jpg'))
                            <img src="{{ route('curso.imagen', ['filename' => 'curso-'.$curso->slug.'.jpg']) }}" class="img-responsive" />
                        @endif
                        <a href="/pagar/{{ $curso->slug }}" class="btn btn-primary">Pagar</a>
                        @if(isset($msg))
                            <div class="form-group">
                                <div class="col-md-offset-4 col-md-6 invalido">
                                    <p>{{ $msg }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="vacio"></div>

    </div>

@stop

@section('footer')
    @parent

@stop