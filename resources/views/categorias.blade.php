@extends('layouts.pagina')

@section('header')
    @parent

    <title>{{ $categoria->nombre }}</title>

@stop


@section('pagina')

    <div class="container-fluid">

        <div class="col-lg-12 vacio"></div>

        <h1 class="text-center">{{ $categoria->nombre }}</h1>

        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading">{{ $categoria->nombre }}</div>
                    <div class="panel-body">
                        <p>{{ $categoria->descripcion }}</p>
                        <div class="color" style="background-color: {{ $categoria->color }}"></div>
                        @if(Storage::disk('local')->has('categoria-'.$categoria->slug.'.jpg'))
                            <img src="{{ route('categoria.imagen', ['filename' => 'categoria-'.$categoria->slug.'.jpg']) }}" class="img-responsive" />
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 vacio"></div>

        <h1 class="text-center">Cursos de {{ $categoria->nombre }}</h1>

        <div class="row">
            @foreach($cursos as $curso)
                <div class="col-lg-4 col-md-4 col-sm-6">
                    @if(\App\Cursos::terminado($curso) < 0)
                        <div class="panel panel-default">
                    @else
                        <div class="panel panel-primary">
                    @endif
                        <div class="panel-heading">{{ $curso->resumen }}</div>
                        <div class="panel-body">
                            <p>{{ $curso->descripcion }}</p>
                            <p>{{ $curso->horario }}</p>
                        </div>
                        <a href="/cursos/{{ $curso->slug }}" class="btn btn-primary">Más Información</a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="vacio"></div>

    </div>

@stop

@section('footer')
    @parent

@stop