<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @section('header')

    {!! Html::style('bootstrap/css/bootstrap.min.css') !!}
    {!! Html::style('bootstrap/css/bootstrap-theme.min.css') !!}
    {!! Html::style('styles/style.css') !!}
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.0.2/css/responsive.bootstrap.min.css">

    @show
</head>
<body>


<div class="col-lg-12 col-md-12 col-xs-12">

    <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li id="itemuno"><a href="/admin">Home</a></li>
                    <li id="itemdos"><a href="/admin/categorias">Categorias</a></li>
                    <li id="itemtres"><a href="/admin/cursos">Cursos</a></li>
                    <li id="itemcuatro"><a href="/admin/alumnos">Alumnos</a></li>
                    <li id="itemcinco"><a href="/admin/profesores">Profesores</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ URL::previous() }}"><span class="glyphicon glyphicon-menu-left"></span> Atrás</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ auth()->guard('admin')->user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li id="logout"><a href="/admin/logout"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
                            </ul>
                        </li>
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

@show

</body>
</html>