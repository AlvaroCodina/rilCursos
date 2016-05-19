@extends('layouts.menu')

@section('header')
    @parent

    <title>Interesados</title>


@stop

@section('pagina')

    <div class="separacion-top"></div>

    <div class="col-sm-8 col-sm-offset-2">

        <div class="page-header">
            <h1><span class="fi-torsos-all"></span> Lista Interesados del curso: <small>{{ $curso->resumen . " " . $curso->fechaInicio }}</small></h1>
        </div>

        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Nombre y apellidos</th>
                        <th>Email</th>
                        <th>Puede</th>
                        <th>Nº Intentos</th>
                        <th>Quitar</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($listaInteresados as $dts)
                    <tr>
                        <td>{{ $dts['nombreApellidos'] }}</td>
                        <td>{{ $dts['email'] }}</td>
                        <td>
                            <form action="/listaInteresados/puede/{{ $dts['puede'] }}/{{ $dts['ids'] }}" method="post">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                @if($dts['puede']==0)
                                    <button type="submit" class="btn btn-warning">No</button>
                                @else
                                    <button type="submit" class="btn btn-success">Si</button>
                                @endif
                            </form>
                        </td>
                        <td>{{ $dts['intentos'] }}</td>
                        <td>
                            <button class='btn btn-danger' data-toggle='modal' data-target='#quitarAlumno' onclick='modal("{{ $dts['ids'] }}");'><span class='fi-x'></span></button>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Nuevo Interesado</button>
            <a href="/listaInteresados/mails/{{ $curso->id }}" class="btn btn-info"><span class="fi-mail"></span> Enviar</a>
            <button type="button" class="btn btn-success">Pasar Alumnos</button>
        </div>
    </div>



    <!--
    ---------------------------------------------------------------------------------------------------
                                                MODAL'S
    ---------------------------------------------------------------------------------------------------
    -->



    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Listado de Alumnos</h4>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        @foreach($alumnos as $alumno)
                            <a href="/listaInteresados/insertaralumno/{{ $curso->id }}/{{ $alumno->id }}"><li class="list-group-item">{{ $alumno->name . ' ' . $alumno->apellidos . ' | ' . $alumno->email}}</li></a>
                        @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>

        </div>
    </div>

    <div id="quitarAlumno" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Quitar el Alumno</h4>
                </div>
                <div class="modal-body">
                    <p>¿Quitar al Alumno de la lista de Interesados?</p>
                </div>
                <div id="modal-append" class="modal-footer">

                </div>
            </div>

        </div>
    </div>


@stop

@section('footer')
    @parent


    <script>
        function modal(ids){
            $("#modal-append").empty();
            var form = "<form method='POST' action='/listaInteresados/quitar/" + ids + "' style='float: right;'><input type='hidden' name='_token' value='{!! csrf_token() !!}'><input name='_method' type='hidden' value='DELETE'><button type='submit' class='btn btn-danger'></span> Borrar</button></form>";
            var boton = "<button type='button' class='btn btn-default' data-dismiss='modal' style='float: left;'>Cancelar</button>";
            $("#modal-append").append(form);
            $("#modal-append").append(boton);
        }
    </script>

@stop