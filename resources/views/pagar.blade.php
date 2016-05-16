@extends('layouts.pagina')

@section('header')
    @parent

    <title>Pagar {{ $categoria->nombre }}</title>

@stop


@section('pagina')

    <div class="container-fluid">

        <div class="col-lg-12 vacio"></div>

        <h1 class="text-center">Pago del curso: {{ $categoria->nombre }} <small>{{ $curso->horario }}</small></h1>

        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <form action="/pagar" method="post" class="form-group">
                            <input type='hidden' name='_token' value='{!! csrf_token() !!}'>
                            <label>Haz la transferencia de la señal: 20€ a la siguiente Cuenta Bancaria: ES02 0049 4345 0526 1000 4056</label>
                            <br>
                            <button type="submit" class="btn btn-success">Volver</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@stop

@section('footer')
    @parent


@stop