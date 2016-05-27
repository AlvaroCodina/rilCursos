@extends('layouts.pagina')

@section('header')
    @parent

    <title>Cursos rIL</title>

@stop


@section('pagina')

    <div class="col-lg-12 vacio"></div>

    <div class="container text-center">
        <h2>Últimos Cursos</h2><br>
        <div class="row">
            @foreach($ultimosCursos as $curso)
                <div class="col-sm-4 padd-bottom @if(\App\Cursos::terminado($curso) < 0) acabado @endif">
                    <h3>{{ $curso->nombre }}</h3>
                    @if(Storage::disk('local')->has('curso-'.$curso->slug.'.jpg'))
                        <p><a href="/cursos/{{ $curso->slug }}"><img src="{{ route('curso.imagen', ['filename' => 'curso-'.$curso->slug.'.jpg']) }}" class="img-responsive center-block" /></a></p>
                    @endif
                    <h3><a href="/cursos/{{ $curso->slug }}">{{ $curso->resumen }}</a></h3>
                    <p class="descripcionpeque">{{ $curso->descripcion }}</p>
                    <p>{{ $curso->fechaInicio . ' ' . $curso->horario }}</p>
                    <div class="links">
                        <div class="link-effect-9" id="link-effect-9">
                            <a href="/cursos/{{ $curso->slug }}" style="color: {{ $curso->color }};">Más Información</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div><br>

    <div class="separacion">
        <div class="container text-center">
            <h3>Algo de texto de prueba</h3>
        </div>
    </div>

    <div class="container text-center">
        <h2>Categorías</h2><br>

        <div class="row">
            @foreach($categorias as $dts)
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="panel panel-success" style="height: 200px;">
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