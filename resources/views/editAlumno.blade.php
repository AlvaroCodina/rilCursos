@extends('layouts.pagina')

@section('header')
    @parent

    <title>Editar datos</title>

@stop


@section('pagina')

    <div class="separacion-top"></div>

    <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">

    <form action="/datos/update" method="POST">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <input name="_method" type="hidden" value="PUT">

        <div class="form-group col-md-4">
            <label for="name">Nombre</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="name" value="{{ $alumno->name }}"/>
            @if ($errors->has('name')) <p class="help-block">{{ $errors->first('Nombre') }}</p> @endif
        </div>
        <div class="form-group col-md-4">
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" class="form-control" id="apellidos" placeholder="apellidos" value="{{ $alumno->apellidos }}"/>
            @if ($errors->has('apellidos')) <p class="help-block">{{ $errors->first('Apellidos') }}</p> @endif
        </div>
        <div class="form-group col-md-4">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control" id="email" placeholder="Email" value="{{ $alumno->email }}"/>
            @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
        </div>
        <div class="form-group col-md-4">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" class="form-control" id="telefono" placeholder="Teléfono" value="{{ $alumno->telefono }}"/>
            @if ($errors->has('telefono')) <p class="help-block">{{ $errors->first('telefono') }}</p> @endif
        </div>
        <div class="form-group col-md-4">
            <label for="camara">Cámara</label>
            <input type="text" name="camara" class="form-control" id="camara" placeholder="Cámara" value="{{ $alumno->camara }}"/>
            @if ($errors->has('camara')) <p class="help-block">{{ $errors->first('camara') }}</p> @endif
        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>

    </div>

@stop

@section('footer')

    @parent

@stop