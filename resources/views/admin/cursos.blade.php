@extends('layouts.menu')

@section('header')
    @parent

    <title>Cursos</title>
    <style>
        .row{
            margin-left: 0;
            margin-right: 0;
        }
    </style>


@stop

@section('pagina')

    <div class="separacion-top"></div>

    <div class="col-sm-8 col-sm-offset-2">

        <div class="page-header">
            <h1> @if($curso) <span class="glyphicon glyphicon-edit"></span> Editar {{ $curso->categoria }} @else <span class="glyphicon glyphicon-share"></span> Nuevo Curso @endif </h1>
        </div>

        <div>
            @if($curso)
                @include('admin.edit')
            @else
                @include('admin.form')
            @endif
        </div>

    </div>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Borrar el Curso</h4>
                </div>
                <div class="modal-body">
                    <p>Si el Curso tiene Alumnos se borrarán los datos</p>
                </div>
                <div id="modal-append" class="modal-footer">

                </div>
            </div>

        </div>
    </div>

    @include('datatables.listadoCursos')

    <div class="vacio"></div>

@stop



@section('footer')
    @parent

    <script>
        $(document).ready(function(){
            $("#itemtres").addClass("active");

            $(function() {
                $('#cursos-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('datatables.data') !!}',
                    columns: [
                        { data: 'numMax', name: 'numMax', width: '50px' },
                        { data: 'numMin', name: 'numMin', width: '50px' },
                        { data: 'fechaInicio', name: 'fechaInicio' },
                        { data: 'duracion', name: 'duracion' },
                        { data: 'resumen', name: 'resumen' },
                        { data: 'horario', name: 'horario' },
                        { data: 'slug', name: 'slug' },
                        {
                            data: "id",
                            "render": function (data) {
                                return "<form action='/admin/alumnoscursos/" + data + "' method='GET'><button type='submit' class='btn btn-info'><span class='glyphicon glyphicon-list'></span> Ver alumnos</button></form>";
                            }
                        },
                        {
                            data: "id",
                            "render": function (data) {
                                return "<form method='GET' action='/admin/cursos/" + data + "/edit'><button type='submit' class='btn btn-warning'><span class='glyphicon glyphicon-edit'></span> Editar</button></form>";
                            }
                        },
                        {
                            data: "id",
                            "render": function (data) {
                                return "<button class='btn btn-danger' data-toggle='modal' data-target='#myModal' onclick='modal(" + data + ");'><span class='glyphicon glyphicon-remove-sign'></span> Borrar</button>";
                            }
                        },
                    ]
                });
            });

        });

        function modal(id){
            $("#modal-append").empty();
            var form = "<form method='POST' action='/admin/cursos/" + id + "' style='float: right;'><input type='hidden' name='_token' value='{!! csrf_token() !!}'><input name='_method' type='hidden' value='DELETE'><button type='submit' class='btn btn-danger'></span> Borrar</button></form>";
            var boton = "<button type='button' class='btn btn-default' data-dismiss='modal' style='float: left;'>Cancelar</button>";
            $("#modal-append").append(form);
            $("#modal-append").append(boton);
        }

    </script>



@stop