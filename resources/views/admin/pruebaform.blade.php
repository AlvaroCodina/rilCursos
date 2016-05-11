

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @section('header')

        {!! Html::style('bootstrap/css/bootstrap.min.css') !!}
        {!! Html::style('bootstrap/css/bootstrap-theme.min.css') !!}
        {!! Html::style('styles/style.css') !!}

    @show
</head>
<body>


<div class="col-lg-12 col-md-12 col-xs-12">

    <form action="/prueba" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" id="nombre"/>
        </div>
        <div class="form-group">
            <label for="imagen">Foto</label>
            <input type="file" name="imagen" class="form-control" id="imagen"/>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>

</div>


    <script src="https://code.jquery.com/jquery-2.2.2.min.js" integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI=" crossorigin="anonymous"></script>
    {!! Html::script('bootstrap/js/bootstrap.min.js') !!}

</body>
</html>