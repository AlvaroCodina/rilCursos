@extends('layouts.menu')

@section('header')
    @parent

    <title>Alumnos</title>


@stop

@section('pagina')

    <div class="separacion-top"></div>

<div class="col-sm-8 col-sm-offset-2">

    <div class="page-header">
        <h1><span class="glyphicon glyphicon-th-list"></span> Listado de los Alumnos del Curso: {{ $curso->resumen }}<small> {{ $curso->fechaInicio }}</small></h1>
        <h3>Alumnos inscritos: {{ $numAlumnos }}, Número mínimo: {{ $curso->numMin }}, Número máximo: {{ $curso->numMax }}</h3>
            <form action="/alumnoscursos/emails" method="post">

                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <input type="hidden" name="idCurso" value="{{ $curso->id }}">

                <div class="form-group">
                    <select name="plantillas" id="plantillas" class="form-control">
                        @foreach($plantillas as $plantilla)
                            <option value="{{ $plantilla->id }}">{{ $plantilla->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-info">Enviar <span class="glyphicon glyphicon-envelope"></span></button>
            </form>
    </div>

    <div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Pagó</th>
                <th>Quitar</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($lista as $user)
                <tr>
                    <td>{{ $user['name'] }}</td>
                    <td>{{ $user['apellidos'] }}</td>
                    <td>{{ $user['email'] }}</td>
                    <td>{{ $user['telefono'] }}</td>
                    <td>
                        <form action="/alumnoscursos/textopago/{{ $user['pago'] }}/{{ $user['ids'] }}" method="post">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            @if($user['pago']==0)
                                <button type="submit" class="btn btn-warning">No pagó</button>
                            @else
                                <button type="submit" class="btn btn-success">Si pagó</button>
                            @endif
                        </form>
                    </td>
                    <td>
                        {{ Form::open(array('route' => array('admin.alumnoscursos.destroy', $user['ids']), 'method' => 'delete')) }}
                        <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove-sign"></span> Quitar</button>
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach

            <!--<tr>
                <td>-</td>
                <td>-</td>
                <td>Lista de Espera</td>
                <td>-</td>
                <td>-</td>
            </tr>

            for($i=0;$i< count($espera); $i++)
                <tr>
                    <td>{ { $espera[$i]->nombre }}</td>
                    <td>{ { $espera[$i]->apellidos }}</td>
                    <td>{ { $espera[$i]->email }}</td>
                    <td>{ { $espera[$i]->telefono }}</td>
                    <td>
                        { { Form::open(array('route' => array('alumnoscursos.destroy', $curso->id."|".$espera[$i]->id."|1"), 'method' => 'delete')) }}
                        <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove-sign"></span> Quitar</button>
                        { { Form::close() }}
                    </td>
                </tr>
            endfor -->

            </tbody>
        </table>
    </div>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Añadir Alumno</button>

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
                        <a href="/alumnoscursos/insertaralumno/{{ $curso->id }}/{{ $alumno->id }}"><li class="list-group-item">{{ $alumno->name . ' ' . $alumno->apellidos . ' | ' . $alumno->email}}</li></a>
                    @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>

        </div>
    </div>

</div>

@stop

@section('footer')
    @parent

@stop