@extends('layouts.menu')

@section('header')
    @parent

    <title>Alumnos</title>


@stop

@section('pagina')

    <div class="separacion-top"></div>

<div class="col-sm-8 col-sm-offset-2">

    <div class="page-header">
        <h1><span class="fi-list"></span> Alumnos del Curso: {{ $curso->resumen }}<small> {{ $curso->fechaInicio }}</small></h1>
        <h3>Número mínimo: {{ $curso->numMin }}, Número máximo: {{ $curso->numMax }}, cuesta: {{ $curso->precios }}</h3>

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
</div>
<div class="col-sm-12">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Nombre y apellidos</th>
                <th>Contacto</th>
                <th style="min-width: 150px;">Señal</th>
                <th style="min-width: 150px;">Resto</th>
                <th>Regalo</th>
                <th style="min-width: 300px;">Observaciones</th>
                <th>Quitar</th>
                <th>-</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($lista as $user)
                <tr>
                    <td>{{ $user['name'] ." ". $user['apellidos'] }}</td>
                    <td>
                        <button onclick="contacto('{{ $user['email'] . "|" . $user['telefono'] }}');" class="btn btn-info contacto"><span class="fi-plus"> Info</span></button>
                    </td>
                    <td>
                        <form method="post" action="/anadir/senal/{{ $user['ids'] }}">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <div class="col-xs-6" style="width: 80px;">
                                <input type="text" class="form-control" name="senal" value="{{ $user['senal'] }}">
                            </div>
                            <div class="col-xs-2">
                                <button type="submit" class="btn btn-primary"><span class="fi-plus"></span></button>
                            </div>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="/anadir/resto/{{ $user['ids'] }}">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <div class="col-xs-6" style="width: 80px;">
                                <input type="text" class="form-control" name="resto" value="{{ $user['resto'] }}">
                            </div>
                            <div class="col-xs-2">
                                <button type="submit" class="btn btn-primary"><span class="fi-plus"></span></button>
                            </div>
                        </form>
                    </td>
                    <td>
                        <form action="/alumnoscursos/textoregalo/{{ $user['regalo'] }}/{{ $user['ids'] }}" method="post">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            @if($user['regalo']==0)
                                <button type="submit" class="btn btn-warning">No</button>
                            @else
                                <button type="submit" class="btn btn-success">Si</button>
                            @endif
                        </form>
                    </td>
                    <td>
                        <form method="post" action="/anadir/observaciones/{{ $user['ids'] }}">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <div class="col-xs-10">
                                <input type="text" class="form-control" name="observaciones" value="{{ $user['observaciones'] }}">
                            </div>
                            <div class="col-xs-2">
                                <button type="submit" class="btn btn-primary"><span class="fi-plus"></span></button>
                            </div>
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
                <td>-</td>
            </tr>

            @for($i=0;$i< count($espera); $i++)
                <tr>
                    <td>{{ $espera[$i]->name . " " . $espera[$i]->apellidos }}</td>
                    <td>
                        <!--<button onclick="contacto('{ { $user['email'] . "|" . $user['telefono'] }}');" class="btn btn-info contacto"><span class="fi-plus"> Info</span></button>-->
                    </td>
                    <td>{{ $espera[$i]->senal }}</td>
                    <td>{{ $espera[$i]->resto }}</td>
                    <td>{{ $espera[$i]->regalo }}</td>
                    <td>{{ $espera[$i]->observaciones }}</td>
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
    <button type="button" class="btn btn-primary" id="marcar">Marcar / Desmarcar</button>
</div>


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

    <div id="contacto" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Datos de contacto</h4>
                </div>
                <div class="modal-body">
                    <p>Email: <a id="mailto"><span id="email"></span></a></p>
                    <p>Teléfono: <a id="tel"><span id="telefono"></span></a></p>
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


@stop

@section('footer')
    @parent

    <script>

        var arrayEmails = "";
        var email = "";
        var telefono = "";

        function check(chk){
            arrayEmails = arrayEmails.replace($(chk).val() + "|", "");
            if(chk.checked){
                arrayEmails = arrayEmails + $(chk).val() + "|";
            }else{
            }
        }

        function contacto(datos){
            var arr = datos.split("|");
            email = arr[0];
            telefono = arr[1];
        }

        $(document).ready(function(){

            $("#marcar").click(function(){
                if($(".chk").is(":checked")){
                    $(".chk").prop( "checked", false );
                }
                else{
                    $(".chk").prop( "checked", true );
                }

            });

            $(".contacto").click(function(){
                $("#email").text(email);
                $("#telefono").text(telefono);
                $("#mailto").attr("href", "mailto:" + email)
                $("#tel").attr("href", "tel:+" + telefono)
                $('#contacto').modal('show');
            });

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