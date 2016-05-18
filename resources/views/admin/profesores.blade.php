@extends('layouts.menu')

@section('header')
    @parent

    <title>Profesores</title>
    <style>
        .row{
            margin-left: 0;
            margin-right: 0;
        }
    </style>


@stop

@section('pagina')

    <div class="separacion-top"></div>

    @include('datatables.listadoProfesores')

    <div class="col-sm-8 col-sm-offset-2">

        <div class="page-header">
            <h1><span class="fi-torso-business"></span> @if($profesor) Editar {{ $profesor->nombre }} @else  Nuevo Profesor @endif </h1>
        </div>

        <div>
            @if($profesor)
                {{ Form::model($profesor, array('route' => array('admin.profesores.update', $profesor->id), 'method' => 'PUT')) }}
            @else
                {{ Form::model(array('route' => array('admin.profesores'), 'method' => 'POST')) }}
            @endif


            <div class="form-group">
                {{ Form::label('nombre', 'Nombre') }}
                {{ Form::text('nombre', \Illuminate\Support\Facades\Input::old('nombre'), array('class' => 'form-control', 'placeholder' => 'nombre')) }}
                @if ($errors->has('nombre')) <p class="help-block">{{ $errors->first('nombre') }}</p> @endif
            </div>

            <div class="form-group">
                {{ Form::label('apellidos', 'Apellidos') }}
                {{ Form::text('apellidos', \Illuminate\Support\Facades\Input::old('apellidos'), array('class' => 'form-control', 'placeholder' => 'apellidos')) }}
                @if ($errors->has('apellidos')) <p class="help-block">{{ $errors->first('apellidos') }}</p> @endif
            </div>

            <div class="form-group">
                {{ Form::label('email', 'email') }}
                {{ Form::text('email', \Illuminate\Support\Facades\Input::old('email'), array('class' => 'form-control', 'placeholder' => 'email')) }}
                @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
            </div>

            <div class="form-group">
                {{ Form::label('admin', 'Admin') }}
                {{ Form::select('admin', array('0' => 'No', '1' => 'Si'), \Illuminate\Support\Facades\Input::old('admin'), array('class' => 'form-control')) }}
                @if ($errors->has('admin')) <p class="help-block">{{ $errors->first('admin') }}</p> @endif
            </div>

            {{ Form::submit('Enviar', array('class' => 'btn btn-default')) }}

            {{ Form::close() }}
        </div>
        <div class="vacio"></div>
    </div>

@stop



@section('footer')
    @parent

    <script>
        $(document).ready(function(){
            $("#itemcinco").addClass("active");

            $(function() {
                $('#profesores-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('datatablesProfesores.data') !!}',
                    columns: [
                        { data: 'nombre', name: 'nombre' },
                        { data: 'apellidos', name: 'apellidos' },
                        { data: 'email', name: 'email' },
                        { data: 'admin', name: 'admin' },
                        {
                            data: "id",
                            "render": function (data) {
                                return "<form action='/admin/profesores/" + data + "/edit' method='PUT'><button type='submit' class='btn btn-warning'><span class='fi-pencil'></span> Editar</button></form>";
                            }
                        },
                        {
                            data: "id",
                            "render": function (data) {
                                return "<form method='POST' action='/admin/profesores/" + data + "'><input type='hidden' name='_token' value='{!! csrf_token() !!}'><input name='_method' type='hidden' value='DELETE'><button type='submit' class='btn btn-danger'><span class='fi-x'></span></button></form>";
                            }
                        },
                    ]
                });
            });

        });


    </script>



@stop