<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id="_token" value="{{ csrf_token() }}">
    <title></title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    {!! Html::script('vue.js') !!}
    {!! Html::script('vue-resource.min.js') !!}


</head>
<body id="app">

<div class="row">
    <div class="col-md-6 col-md-offset-3">

        <h1 v-show="name">Bienvenido @{{ name }}</h1>

        <input type="text" class="form-control" v-model="name" @keyup.enter="metodo" @blur="metodo">

        <hr>

        <pre>@{{ $data | json }}</pre>

    </div>
</div>

<script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<script>

    Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#_token').getAttribute('value');

        new Vue({
            el: "#app",
            data: {
                name: "Álvaro"
            },
            methods: {
                metodo: function(){

                    this.ajaxRequest = true;
                    this.$http.post('/prueba/datos', {
                        nombre: this.name
                    }, function (data, status, request) {
                        this.postResults = data;

                        this.ajaxRequest = false;
                    });
                }
            }
        });



</script>

</body>
</html>