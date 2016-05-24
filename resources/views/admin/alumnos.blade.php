@extends('layouts.menu')

@section('header')
    @parent

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Alumnos</title>
    <style>
        .row{
            margin-left: 0;
            margin-right: 0;
        }
    </style>


@stop

@section('pagina')

    <div class="separacion-top"></div>

    @include('datatables.listadoAlumnos')

    <div class="col-sm-8 col-sm-offset-2">

        <div class="page-header">
            <h1><span class="fi-torso"></span> @if($alumno)  Editar {{ $alumno->name }} @else  Nuevo Alumno @endif </h1>
        </div>

        <div>
            @if($alumno)
                {{ Form::model($alumno, array('route' => array('admin.alumnos.update', $alumno->id), 'method' => 'PUT')) }}
            @else
                {{ Form::model(array('route' => array('admin.alumnos'), 'method' => 'POST')) }}
            @endif


            <div class="form-group">
                {{ Form::label('name', 'Nombre') }}
                {{ Form::text('name', \Illuminate\Support\Facades\Input::old('name'), array('class' => 'form-control', 'placeholder' => 'nombre')) }}
                @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
            </div>

            <div class="form-group">
                {{ Form::label('apellidos', 'Apellidos') }}
                {{ Form::text('apellidos', \Illuminate\Support\Facades\Input::old('apellidos'), array('class' => 'form-control', 'placeholder' => 'apellidos')) }}
                @if ($errors->has('apellidos')) <p class="help-block">{{ $errors->first('apellidos') }}</p> @endif
            </div>

            <div class="form-group">
                {{ Form::label('telefono', 'Teléfono') }}
                {{ Form::tel('telefono', \Illuminate\Support\Facades\Input::old('telefono'), array('class' => 'form-control', 'placeholder' => 'teléfono')) }}
                @if ($errors->has('telefono')) <p class="help-block">{{ $errors->first('telefono') }}</p> @endif
            </div>

            <div class="form-group">
                {{ Form::label('email', 'email') }}
                {{ Form::text('email', \Illuminate\Support\Facades\Input::old('email'), array('class' => 'form-control', 'placeholder' => 'email')) }}
                @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
            </div>

                <div class="form-group">
                    {{ Form::label('fechaNacimiento', 'Fecha Nacimiento') }}
                    {{ Form::text('fechaNacimiento', \Illuminate\Support\Facades\Input::old('fechaNacimiento'), array('class' => 'form-control', 'placeholder' => 'Fecha de Nacimiento')) }}
                    @if ($errors->has('fechaNacimiento')) <p class="help-block">{{ $errors->first('fechaNacimiento') }}</p> @endif
                </div>

                <div class="form-group">
                    {{ Form::label('localidad', 'Localidad') }}
                    {{ Form::text('localidad', \Illuminate\Support\Facades\Input::old('localidad'), array('class' => 'form-control', 'placeholder' => 'Localidad')) }}
                    @if ($errors->has('localidad')) <p class="help-block">{{ $errors->first('localidad') }}</p> @endif
                </div>

                <div class="form-group">
                    {{ Form::label('conocimientosWin', 'Conocimientos Windows') }}
                    {{ Form::text('conocimientosWin', \Illuminate\Support\Facades\Input::old('conocimientosWin'), array('class' => 'form-control', 'placeholder' => 'Conocimientos Windows')) }}
                    @if ($errors->has('conocimientosWin')) <p class="help-block">{{ $errors->first('conocimientosWin') }}</p> @endif
                </div>

                <div class="form-group">
                    {{ Form::label('conocimientosFoto', 'Conocimientos Fotografía') }}
                    {{ Form::text('conocimientosFoto', \Illuminate\Support\Facades\Input::old('conocimientosFoto'), array('class' => 'form-control', 'placeholder' => 'Conocimientos Fotografía')) }}
                    @if ($errors->has('conocimientosFoto')) <p class="help-block">{{ $errors->first('conocimientosFoto') }}</p> @endif
                </div>

                <div class="form-group">
                    {{ Form::label('equipamiento', 'Equipamiento') }}
                    {{ Form::text('equipamiento', \Illuminate\Support\Facades\Input::old('equipamiento'), array('class' => 'form-control', 'placeholder' => 'Equipamiento')) }}
                    @if ($errors->has('equipamiento')) <p class="help-block">{{ $errors->first('equipamiento') }}</p> @endif
                </div>

            <div class="form-group">
                {{ Form::label('password', 'Contraseña') }}
                @if($alumno)
                    {{ Form::text('password', \Illuminate\Support\Facades\Input::old('password'), array('class' => 'form-control', 'placeholder' => 'contraseña (opcional)', 'readonly' => 'false')) }}
                @else
                    {{ Form::text('password', \Illuminate\Support\Facades\Input::old('password'), array('class' => 'form-control', 'placeholder' => 'contraseña (opcional)')) }}
                @endif
                @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
            </div>

            @if($alumno == false)
            <div class="form-group">
                {{ Form::label('password_confirmation', 'Confirmar Contraseña') }}
                {{ Form::text('password_confirmation', \Illuminate\Support\Facades\Input::old('password_confirmation'), array('class' => 'form-control', 'placeholder' => 'Confirmar Contraseña (opcional)')) }}
                @if ($errors->has('password_confirmation')) <p class="help-block">{{ $errors->first('password_confirmation') }}</p> @endif
            </div>
            @endif

            <div class="form-group">
                {{ Form::label('camara', 'Camara') }}
                {{ Form::text('camara', \Illuminate\Support\Facades\Input::old('camara'), array('class' => 'form-control', 'placeholder' => '(opcional)')) }}
                @if ($errors->has('camara')) <p class="help-block">{{ $errors->first('camara') }}</p> @endif
            </div>

            {{ Form::submit('Enviar', array('class' => 'btn btn-default')) }}

            {{ Form::close() }}
        </div>
        <div class="vacio"></div>
    </div>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Borrar el Alumno</h4>
                </div>
                <div class="modal-body">
                    <p>Si el Alumno tiene cursos se borrarán sus datos</p>
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
        $(document).ready(function(){
            $("#itemcuatro").addClass("active");

            $('#enviar').click(function(){
                alert("Por el momento lo desactivo para no liarla");
                /*$.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/alumnos/emails",
                    method: "POST",
                    data:
                    {
                        idPlantilla : $("#plantillas").val(),
                    },
                    datatype: "text"
                });*/
            });

            $(function() {
                var dataTable = $('#alumnos-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('datatablesAlumnos.data') !!}',
                    columns: [
                        { data: 'name', name: 'name' },
                        { data: 'apellidos', name: 'apellidos' },
                        { data: 'telefono', name: 'telefono' },
                        { data: 'email', name: 'email' },
                        { data: 'camara', name: 'camara' },
                        {
                            data: "id",
                            "render": function (data) {
                                return "<form action='/admin/cursosalumnos/" + data + "' method='GET'><button type='submit' class='btn btn-info'><span class='fi-list'></span> Ver cursos</button></form>";
                            }
                        },
                        {
                            data: "id",
                            "render": function (data) {
                                return "<form action='/admin/alumnos/" + data + "/edit' method='PUT'><button type='submit' class='btn btn-warning'><span class='fi-pencil'></span> Editar</button></form>";
                            }
                        },
                        {
                            data: "id",
                            "render": function (data) {
                                return "<button class='btn btn-default' data-toggle='modal' data-target='#myModal' onclick='modal(" + data + ");'><span class='fi-x'></span></button>";
                            }
                        },
                    ]
                });
            });

        });

        function modal(id){
            $("#modal-append").empty();
            var form = "<form method='POST' action='/admin/alumnos/" + id + "' style='float: right;'><input type='hidden' name='_token' value='{!! csrf_token() !!}'><input name='_method' type='hidden' value='DELETE'><button type='submit' class='btn btn-danger'></span> Borrar</button></form>";
            var boton = "<button type='button' class='btn btn-default' data-dismiss='modal' style='float: left;'>Cancelar</button>";
            $("#modal-append").append(form);
            $("#modal-append").append(boton);
        }

    </script>



@stop