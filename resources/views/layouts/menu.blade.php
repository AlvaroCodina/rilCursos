<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" >
@section('header')

    {!! Html::style('bootstrap/css/bootstrap.min.css') !!}
    {!! Html::style('bootstrap/css/bootstrap-theme.min.css') !!}
    {!! Html::style('foundation-icons/foundation-icons.css') !!}
    {!! Html::style('styles/style.css') !!}
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.0.2/css/responsive.bootstrap.min.css">

    @show
</head>
<body>


<div class="col-lg-12 col-md-12 col-xs-12">

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                    <li id="itemtres"><a href="/admin/cursos">Cursos</a></li>
                    <li id="itemcuatro"><a href="/admin/alumnos">Alumnos</a></li>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li id="itemdos"><a href="/admin/categorias">Categorías</a></li>
                    <li id="itemcinco"><a href="/admin/profesores">Profesores</a></li>
                    <li id="itemseis"><a href="/admin/mails">Mails</a></li>
                    <li id="logout"><a href="/admin/logout"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>

</div>

@yield('pagina')


@section('footer')

    <script src="https://code.jquery.com/jquery-2.2.2.min.js" integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.0.2/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.0.2/js/responsive.bootstrap.min.js"></script>
    {!! Html::script('bootstrap/js/bootstrap.min.js') !!}
    <script>
    $(document).ready(function(){

        $.extend(true, $.fn.dataTable.defaults, {
            "stateSave": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
            }
        });

    });
    </script>
@show

</body>
</html>