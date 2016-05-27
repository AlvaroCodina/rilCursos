@extends('layouts.pagina')

@section('header')
    @parent

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Curso de {{ $categoria->nombre }}</title>

@stop


@section('pagina')

    <div class="separacion-top"></div>

    <div class="container">
        <h3 class="text-center">Curso {{ $categoria->nombre }} <small>{{ $curso->horario }}</small></h3><br>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <div class="interesado" style="background-color: {{ \App\Http\Controllers\AlumnosCursosController::getInteres($curso->id) }};"><a id="interes"><span class='fi-plus'></span> Me interesa</a></div>
                        <h3>{{ $curso->resumen }}</h3><br>
                        <p>{{ $curso->descripcion }}</p>
                        <p>El curso se realizará a fecha de: {{ $curso->fechaInicio." con una duración de:  ".$curso->duracion }}</p><br>
                        <blockquote>
                            {{ $curso->lugar }}
                        </blockquote><br>
                        <p>El precio por persona es de: {{ $curso->precios }}</p><br>
                        <p>El profesor que dará la clase es: <a href="/datos/profesor/{{ $profesor->id }}">{{ $profesor->nombre." ".$profesor->apellidos }}</a></p><br>
                        @if(Storage::disk('local')->has('curso-'.$curso->slug.'.jpg'))
                            <img src="{{ route('curso.imagen', ['filename' => 'curso-'.$curso->slug.'.jpg']) }}" class="img-responsive" />
                        @endif
                        {!! $curso->contenidoHtml  !!}
                        <a href="/inscribirse/{{ $curso->slug }}" class="btn btn-primary">Inscribirse</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="vacio"></div>

    </div>

@stop

@section('footer')
    @parent

    <script>

        $(document).ready(function(){

            $('#interes').click(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/interes",
                    method: "POST",
                    data:
                    {
                        idAlumno : "{{ Illuminate\Support\Facades\Auth::user()->id }}",
                        idCurso : "{{ $curso->id }}",
                    },
                    datatype: "text"
                }).done(function(){
                    location.reload();
                });
            });

        });

    </script>

@stop