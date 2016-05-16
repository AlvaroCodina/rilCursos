@extends('layouts.menu')

@section('header')
    @parent

    <title>Cursos del Alumno</title>


@stop

@section('pagina')

    <div class="separacion-top"></div>

    <div class="col-sm-8 col-sm-offset-2">

        <div class="page-header">
            <h1><span class="glyphicon glyphicon-th-list"></span> Listado de los Cursos del Alumno: {{ $alumno->name . ' ' . $alumno->apellidos }}</h1>
            <h3>Cursos en los que está inscrito:</h3>
        </div>

        <div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Resumen</th>
                    <th>Fecha Inicio</th>
                    <th>Horario</th>
                    <th>Lugar</th>
                    <th>Precio</th>
                    <th>Quitar</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($cursos as $curso)
                    <tr>
                        <td>{{ $curso->resumen }}</td>
                        <td>{{ $curso->fechaInicio }}</td>
                        <td>{{ $curso->horario }}</td>
                        <td>{{ $curso->lugar }}</td>
                        <td>{{ $curso->precios }}</td>
                        <td>
                            <form method="post" action="/admin/cursosalumnos/{{ $alumno->id . '|' . $curso->id }}">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove-sign"></span> Quitar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>

@stop

@section('footer')
    @parent

@stop