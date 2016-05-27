@extends('layouts.pagina')

@section('header')
    @parent

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Datos personales</title>

@stop


@section('pagina')

    <div class="separacion-top"></div>

    <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
        <div class="panel-heading"><h2>Datos personales</h2></div>
        <div class="panel panel-default paddTodo capa">
            <p class="parrafo"><span class="label label-info">Nombre:</span> {{ $alumno->name }}</p>
            <p class="parrafo"><span class="label label-info">Apellidos:</span> {{ $alumno->apellidos }}</p>
            <p class="parrafo"><span class="label label-info">Email:</span> {{ $alumno->email }}</p>
            <p class="parrafo"><span class="label label-info">Camara:</span> {{ $alumno->camara }}</p>
            <p class="parrafo"><span class="label label-info">Teléfono:</span> {{ $alumno->telefono }}</p>
            <div class="submenu">
                <a class="enlaces" href="/datos/{{ $alumno->id  }}">Editar</a>
            </div>
        </div>

        <div class="panel-heading"><h2>Cursos</h2></div>

        @if($cursos=="[]")
            <div class="panel panel-default">
                <h3>No tienes cursos</h3>
            </div>
        @endif

        @foreach($cursos as $curso)
            <div class="panel panel-default">
                <h3>Fecha: {{ $curso->fechaInicio }}</h3>
                <p><span class="label label-info">Curso:</span> {{ $curso->resumen }}</p>
                <p><span class="label label-info">Fecha:</span> {{ $curso->fechaInicio }}</p>
            </div>
        @endforeach


        <div class="panel-heading"><h2>Listas de Espera</h2></div>

        @if($espera==0)
            <div class="panel panel-default">
                <h3>No tienes listas de espera</h3>
            </div>
        @else
            <ul class="list-group">
                @for($i=0; $i<count($espera);$i++)
                    <li class="list-group-item">{{ $espera[$i]->resumen . " - " . $espera[$i]->fechaInicio }}</li>
                @endfor
            </ul>
        @endif

        <div class="panel-heading"><h2>Cursos que te interesan</h2></div>

        @if($interes==0)
            <div class="panel panel-default">
                <h3>No tienes cursos que te interesan</h3>
            </div>
        @else
            <ul class="list-group">
                @for($i=0; $i<count($interes);$i++)
                    <li class="list-group-item">{{ $interes[$i]->resumen . " - " . $interes[$i]->fechaInicio }} <a class="darse-baja" id="quitar-{{ $interes[$i]->id . "-" . \Illuminate\Support\Facades\Auth::user()->id  }}">No me interesa el curso</a></li>
                @endfor
            </ul>
        @endif

    </div>


@stop

@section('footer')

    @parent

    <script>

        $(document).ready(function(){

            $('.darse-baja').click(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/interes/baja",
                    method: "POST",
                    data:
                    {
                        ids : $(this).attr('id'),
                    },
                    datatype: "text"
                }).done(function(){
                    location.reload();
                });
            });

        });

    </script>


@stop