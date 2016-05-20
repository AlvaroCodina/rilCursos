@extends('layouts.menu')

@section('header')
    @parent

    <title>Categorías</title>
    <style>
        .row{
            margin-left: 0;
            margin-right: 0;
        }
    </style>


@stop

@section('pagina')

    <div class="separacion-top"></div>

    @include('datatables.listadoCategorias')

    <div class="col-sm-8 col-sm-offset-2">

        <div class="page-header">
            <h1> @if($categoria) <span class="fi-pencil"></span> Editar {{ $categoria->nombre }} @else <span class="fi-plus"></span> Nueva Categoría @endif </h1>
        </div>

        <div>
            @if($categoria)
                <form action="/admin/categorias/{{ $categoria->id }}" method="POST" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PUT">
            @else
                <form action="/admin/categorias" method="post" enctype="multipart/form-data">
            @endif

                <input type="hidden" name="_token" value="{!! csrf_token() !!}">

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" id="nombre" placeholder="nombre" value="@if($categoria){{ $categoria->nombre }}@else{{ \Illuminate\Support\Facades\Input::old('nombre') }}@endif"/>
                    @if ($errors->has('nombre')) <p class="help-block">{{ $errors->first('nombre') }}</p> @endif
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <input type="text" name="descripcion" class="form-control" id="descripcion" placeholder="descripción" value="@if($categoria){{ $categoria->descripcion }}@else{{ \Illuminate\Support\Facades\Input::old('descripcion') }}@endif"/>
                    @if ($errors->has('descripcion')) <p class="help-block">{{ $errors->first('descripcion') }}</p> @endif
                </div>
                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" class="form-control" id="foto" />
                </div>
                <div class="form-group">
                    <label for="color">Color</label>
                    <input type="text" name="color" class="form-control" id="color" placeholder="color" value="@if($categoria){{ $categoria->color }}@else{{ \Illuminate\Support\Facades\Input::old('color') }}@endif"/>
                    @if ($errors->has('color')) <p class="help-block">{{ $errors->first('color') }}</p> @endif
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" class="form-control" id="slug" placeholder="slug" value="@if($categoria){{ $categoria->slug }}@else{{ \Illuminate\Support\Facades\Input::old('slug') }}@endif"/>
                    @if ($errors->has('slug')) <p class="help-block">{{ $errors->first('slug') }}</p> @endif
                </div>

                <button type="submit" class="btn btn-primary">Enviar</button>

            </form>
        </div>
        <div class="vacio"></div>
    </div>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Borrar la categoría</h4>
                </div>
                <div class="modal-body">
                    <p>Si la categoría tiene cursos se pasarán a la categoría Otros</p>
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
            $("#itemdos").addClass("active");
            $("#btn-cancelar").click(function(){
                window.location.replace("/admin/categorias");
            });
            $("#btn-aceptar").click(function(){
                window.location.replace("/admin/categorias/borrar");
            });

            $(function() {
                $('#categorias-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('datatablesCategorias.data') !!}',
                    columns: [
                        { data: 'nombre', name: 'nombre' },
                        { data: 'descripcion', name: 'descripcion' },
                        { data: 'color', name: 'color' },
                        { data: 'slug', name: 'slug' },
                        {
                            data: "id",
                            "render": function (data) {
                                return "<form action='/admin/categorias/" + data + "/edit' method='PUT'><button type='submit' class='btn btn-warning'><span class='fi-pencil'></span> Editar</button></form>";
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
            var form = "<form method='POST' action='/admin/categorias/" + id + "' style='float: right;'><input type='hidden' name='_token' value='{!! csrf_token() !!}'><input name='_method' type='hidden' value='DELETE'><button type='submit' class='btn btn-danger'></span> Borrar</button></form>";
            var boton = "<button type='button' class='btn btn-default' data-dismiss='modal' style='float: left;'>Cancelar</button>";
            $("#modal-append").append(form);
            $("#modal-append").append(boton);
        }

    </script>



@stop