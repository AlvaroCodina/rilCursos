@extends('layouts.pagina')

@section('header')
    @parent

    <title>Cursos rIL</title>

@stop


@section('pagina')

    <div class="col-lg-12 vacio"></div>

    <div class="container text-center">
        <h3>Ultimos Cursos</h3><br>
        <div class="row">
            @foreach($ultimosCursos as $curso)
                <div class="col-sm-4">
                    @if(\App\Cursos::terminado($curso) < 0)
                        <div class="panel panel-default">
                    @else
                        <div class="panel panel-primary">
                    @endif
                            <div class="panel-heading contenido">{{ $curso->resumen }}</div>
                            <div class="panel-body">
                                <p class="contenido">{{ $curso->descripcion }}</p>
                                <p>{{ $curso->horario }}</p>
                                @if(Storage::disk('local')->has('curso-'.$curso->slug.'.jpg'))
                                    <img src="{{ route('curso.imagen', ['filename' => 'curso-'.$curso->slug.'.jpg']) }}" class="img-responsive" />
                                @endif
                                <a href="/cursos/{{ $curso->slug }}" class="btn btn-primary">Más Información</a>
                            </div>
                        </div>
                </div>
            @endforeach
        </div>
    </div><br>

    <div class="col-lg-12 vacio"></div>

    <div class="container text-center">
        <h3>Categorías</h3><br>

        <div class="row">
            @foreach($categorias as $dts)
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">{{ $dts->nombre }}</div>
                        <div class="panel-body">{{ $dts->descripcion }}</div>
                        <a href="/categorias/{{ $dts->slug }}" class="btn btn-primary">Más Información</a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="col-lg-12 vacio"></div>

    </div>

@stop

@section('footer')
    @parent

@stop