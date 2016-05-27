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
            <h1><span id="icono"></span> <span id="titulo"></span> &nbsp; <button class="btn btn-primary" id="btn-accion">Nuevo curso</button></h1>
        </div>
    </div>
    <div class="col-sm-12" id="lista">
        @include('datatables.listadoCursos')
    </div>
    <div class="col-sm-8 col-sm-offset-2" id="nuevo">

        <div>
            @if($curso)
                @include('admin.edit')
            @else
                @include('admin.form')
            @endif
        </div>
        <div class="vacio"></div>
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



@stop



@section('footer')
    @parent

    {!! Html::script('vendors/ckeditor/ckeditor.js') !!}

    <script>
        $(document).ready(function(){

            if("{{ $fallo }}" == "si"){
                nuevo();
            }
            if("{{ $fallo }}" == "sisi"){
                editar();
            }
            if("{{ $curso }}" != ""){
                editar();
            }



            $("#titulo").text("Listado de Cursos");
            $("#icono").addClass("fi-list");

            $("#btn-accion").click(function(){
                if($(this).text() == "Nuevo curso"){
                    nuevo();
                }
                else{
                    if($(this).text() == "Listado de cursos"){
                        window.location.replace("/admin/cursos");
                    }
                }
            });

            function editar(){
                $("#btn-accion").text("Listado de cursos");
                $("#nuevo").show();
                $("#lista").hide();
                $("#titulo").text("Editar curso");
                $("#icono").removeClass("fi-plus fi-list");
                $("#icono").addClass("fi-pencil");
            }

            function nuevo(){

                $("#btn-accion").text("Listado de cursos");
                $("#nuevo").show();
                $("#lista").hide();
                $("#titulo").text("Nuevo curso");
                $("#icono").removeClass("fi-list fi-pencil");
                $("#icono").addClass("fi-plus");
            }

            $("#itemtres").addClass("active");

            $(function() {
                var dataTable = $('#cursos-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('datatables.data') !!}',
                    columns: [
                        { data: 'slug', name: 'slug' },
                        { data: 'fechaInicio', name: 'fechaInicio' },
                        { data: 'numMax', name: 'numMax', width: '50px' },
                        { data: 'numMin', name: 'numMin', width: '50px' },
                        { data: 'duracion', name: 'duracion' },
                        { data: 'resumen', name: 'resumen' },
                        { data: 'horario', name: 'horario' },
                        {
                            data: "id",
                            "render": function (data) {
                                return "<form action='/admin/alumnoscursos/" + data + "' method='GET'><button type='submit' class='btn btn-default'><span class='fi-list'></span> Ver alumnos</button></form>";
                            }
                        },
                        {
                            data: "id",
                            "render": function (data) {
                                return "<form action='/admin/listainteresados/" + data + "' method='GET'><button type='submit' class='btn btn-info'><span class='fi-list'></span> Ver interesados</button></form>";
                            }
                        },
                        {
                            data: "id",
                            "render": function (data) {
                                return "<form method='GET' action='/admin/cursos/" + data + "/edit'><button type='submit' class='btn btn-warning editar'><span class='fi-pencil'></span> Editar</button></form>";
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
            var form = "<form method='POST' action='/admin/cursos/" + id + "' style='float: right;'><input type='hidden' name='_token' value='{!! csrf_token() !!}'><input name='_method' type='hidden' value='DELETE'><button type='submit' class='btn btn-danger'></span> Borrar</button></form>";
            var boton = "<button type='button' class='btn btn-default' data-dismiss='modal' style='float: left;'>Cancelar</button>";
            $("#modal-append").append(form);
            $("#modal-append").append(boton);
        }

    </script>



@stop