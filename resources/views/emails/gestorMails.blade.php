@extends('layouts.menu')

@section('header')
    @parent

    <title>Gestor de Mails</title>

@stop

@section('pagina')

    <div class="separacion-top"></div>

    <div class="col-sm-8 col-sm-offset-2">

        <div class="page-header">
            <h1><span class="fi-mail"></span> Mails</h1>
        </div>

        <form action="/admin/mails" method="post">

            <input type="hidden" name="_token" value="{!! csrf_token() !!}">

            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control"><br>

            <textarea class="ckeditor" name="editor1" id="editor1" rows="10" cols="80">

            </textarea><br>

            <button type="submit" class="btn btn-primary">Guardar plantilla</button>
        </form>

    </div>


@stop



@section('footer')
    @parent

    {!! Html::script('vendors/ckeditor/ckeditor.js') !!}

    <script>
        $(document).ready(function() {
            $("#itemseis").addClass("active");
        });
    </script>

@stop