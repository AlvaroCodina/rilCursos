@extends('layouts.menu')

@section('header')
    @parent

    <title>Alumnos</title>


@stop

@section('pagina')

    <div class="separacion-top"></div>

<div class="col-sm-8 col-sm-offset-2">

    <div class="page-header">
        <h1><span class="glyphicon glyphicon-th-list"></span> Alumnos del Curso: {{ $curso->resumen }}<small> {{ $curso->fechaInicio }}</small></h1>
        <h3>Número mínimo: {{ $curso->numMin }}, Número máximo: {{ $curso->numMax }}</h3>

        <input type="hidden" id="idCurso" name="idCurso" value="{{ $curso->id }}">

        <div class="form-group">
            <select name="plantillas" id="plantillas" class="form-control">
                @foreach($plantillas as $plantilla)
                    <option value="{{ $plantilla->id }}">{{ $plantilla->nombre }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-info" id="enviar">Enviar <span class="fi-mail"></span></button>
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
                <th>Seleccionar</th>
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
                        <button class='btn btn-danger' data-toggle='modal' data-target='#quitarAlumno' onclick='modal("{{ $user['ids'] }}");'><span class='fi-x'></span></button>
                    </td>
                    <td><input type="checkbox" onclick="check(this);" class="chk" value="{{ $user['email'] }}"></td>
                </tr>
            @endforeach

            <tr>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>Lista de Espera</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
            </tr>

            @for($i=0;$i< count($espera); $i++)
                <tr>
                    <td>{{ $espera[$i]->name }}</td>
                    <td>{{ $espera[$i]->apellidos }}</td>
                    <td>{{ $espera[$i]->email }}</td>
                    <td>{{ $espera[$i]->telefono }}</td>
                    <td>-</td>
                    <td>
                        <button class='btn btn-danger' data-toggle='modal' data-target='#quitarAlumno' onclick='modal("{{ $curso->id."|".$espera[$i]->id."|1" }}");'><span class='fi-x'></span></button>
                    </td>
                    <td><input type="checkbox" class="chk" value="{{ $espera[$i]->email }}"></td>
                </tr>
            @endfor

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

    <div id="quitarAlumno" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Quitar el Alumno</h4>
                </div>
                <div class="modal-body">
                    <p>¿Quitar al Alumno del curso?</p>
                </div>
                <div id="modal-append" class="modal-footer">

                </div>
            </div>

        </div>
    </div>

</div>

@stop

@section('footer')
    @parent

    <script>

        var arrayEmails = "";

        function check(chk){
            arrayEmails = arrayEmails.replace($(chk).val() + "|", "");
            if(chk.checked){
                arrayEmails = arrayEmails + $(chk).val() + "|";
            }else{
            }
        }

        $(document).ready(function(){



            $('#enviar').click(function(){

                if(arrayEmails != ""){
                    $.ajax({
                        url: "/alumnoscursos/emails",
                        method: "POST",
                        data:
                        {
                            emails : arrayEmails,
                            id : $("#idCurso").val(),
                            idPlantilla : $("#plantillas").val(),
                        },
                        datatype: "text"
                    }).done(function() {
                        alert( "success" );
                    });
                }
                else{
                    alert("No hay ningún alumno seleccionado!");
                }
            });

        });

        function modal(ids){
            $("#modal-append").empty();
            var form = "<form method='POST' action='/admin/listaespera/" + ids + "' style='float: right;'><input type='hidden' name='_token' value='{!! csrf_token() !!}'><input name='_method' type='hidden' value='DELETE'><button type='submit' class='btn btn-danger'></span> Borrar</button></form>";
            var boton = "<button type='button' class='btn btn-default' data-dismiss='modal' style='float: left;'>Cancelar</button>";
            $("#modal-append").append(form);
            $("#modal-append").append(boton);
        }

    </script>

@stop