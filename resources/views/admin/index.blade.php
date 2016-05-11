@extends('layouts.menu')

@section('header')
    @parent

    <title>Admin</title>

@stop

@section('pagina')


@stop

@section('footer')
    @parent

    <script>
        $(document).ready(function(){
            $("#itemuno").addClass("active");
        });


    </script>



@stop