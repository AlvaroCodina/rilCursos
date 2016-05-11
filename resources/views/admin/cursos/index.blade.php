@extends('layouts.menu')

@section('header')
    @parent

    <title>Cursos</title>


@stop

@section('pagina')

    @if($editarCrear)

    @include('create',['editarCrear' => 'Nuevo'])

    @else

        @include('edit',['editarCrear' => 'Editar'])
    @endif

    @include('datatables.listadoCursos')

    <div class="vacio"></div>

@stop



@section('footer')
    @parent

    <script>
        $(document).ready(function(){
            $("#itemdos").addClass("active");

            $(function() {
                $('#cursos-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('datatables.data') !!}',
                    columns: [
                        { data: 'idCategoria', name: 'idCategoria' },
                        { data: 'idProfesor', name: 'idProfesor' },
                        { data: 'numMax', name: 'numMax' },
                        { data: 'numMin', name: 'numMin' },
                        { data: 'fechaInicio', name: 'fechaInicio' },
                        { data: 'duracion', name: 'duracion' },
                        { data: 'resumen', name: 'resumen' },
                        { data: 'descripcion', name: 'descripcion' },
                        { data: 'imagen', name: 'imagen' },
                        { data: 'lugar', name: 'lugar' },
                        { data: 'horario', name: 'horario' },
                        { data: 'contenidoHtml', name: 'contenidoHtml' },
                        { data: 'precios', name: 'precios' },
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
                                return "<form action='/admin/cursos/" + data + "/edit' method='PUT'><button type='submit' class='btn btn-warning'><span class='glyphicon glyphicon-edit'></span> Editar</button></form>";
                            }
                        },
                        {
                            data: "id",
                            "render": function (data) {
                                return "<form method='DELETE' action='/admin/cursos/" + data + "'><button type='submit' class='btn btn-danger'><span class='glyphicon glyphicon-remove-sign'></span> Borrar</button></form>";
                            }
                        },
                    ]
                });
            });

        });


    </script>



@stop