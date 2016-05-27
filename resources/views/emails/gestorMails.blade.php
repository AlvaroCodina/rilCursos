@extends('layouts.menu')

@section('header')
    @parent

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gestor de Mails</title>

    <style>
        .flotar{ float: left; margin-right: 20px; }
    </style>

@stop

@section('pagina')

    <div class="separacion-top"></div>

    <div class="col-sm-8 col-sm-offset-2">

        <div class="page-header">
            <h1><span class="fi-mail"></span> Mails</h1>

            <div class="form-group">
                <select name="plantillas" id="plantillas" class="form-control">
                    @foreach($plantillas as $plantilla)
                        <option value="{{ $plantilla->id }}">{{ $plantilla->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-info" id="editar">Editar</button>
        </div>

        <form action="/admin/mails" method="post">

            <input type="hidden" name="_token" value="{!! csrf_token() !!}">

            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control"><br>

            <textarea class="ckeditor" name="editor1" id="editor1" rows="10" cols="80">

            </textarea><br>

            <button type="submit" id="crear" class="btn btn-primary flotar">Crear plantilla</button>
        </form>
        <button id="save" class="btn btn-primary flotar">Guardar plantilla</button>
        <button class='btn btn-success flotar' data-toggle='modal' data-target='#myModal'>Prueba plantilla</button>

        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Enviar prueba al correo:</h4>
                    </div>
                    <div class="modal-body">
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" class="form-control">
                        <button id="send" class="btn btn-primary">Enviar</button>
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

    {!! Html::script('vendors/ckeditor/ckeditor.js') !!}

    <script>
        $(document).ready(function() {
            $("#itemseis").addClass("active");
            $("#save").hide();

            $('#editar').click(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                 });
                $.ajax({
                    url: "/plantillas/emails",
                    method: "POST",
                    data:
                    {
                        idPlantilla : $("#plantillas").val(),
                    },
                    datatype: "text"
                }).done(function(data){
                    CKEDITOR.instances['editor1'].insertHtml(data);
                    $("#crear").hide();
                    $("#save").show();
                });
            });

            $("#save").click(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/plantillas/update",
                    method: "POST",
                    data:
                    {
                        idPlantilla : $("#plantillas").val(),
                        contenido : CKEDITOR.instances['editor1'].getData(),
                    },
                    datatype: "text"
                }).done(function(){
                    CKEDITOR.instances['editor1'].setData('');
                    $("#crear").show();
                    $("#save").hide();
                });
            });

            $("#send").click(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/plantillas/sendPrueba",
                    method: "POST",
                    data:
                    {
                        idPlantilla : $("#plantillas").val(),
                        email : $("#email").val(),
                    },
                    datatype: "text"
                }).done(function(){
                    $('#myModal').modal('toggle');
                });
            });

        });
    </script>

@stop