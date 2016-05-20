@extends('layouts.menu')

@section('header')
    @parent

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Alumnos</title>
    {!! Html::style('styles/lista.css') !!}

@stop

@section('pagina')

    <div class="separacion-top"></div>

<div class="col-sm-8 col-sm-offset-2">

    <div class="page-header">
        <h1><span class="fi-list"></span> Alumnos del Curso: {{ $curso->resumen }}<small> {{ $curso->fechaInicio }}</small> <a href="/admin/listainteresados/{{ $curso->id }}" class="btn btn-primary">Ir a interesados</a></h1>
        <h3>Número mínimo: {{ $curso->numMin }}, Número máximo: {{ $curso->numMax }}, cuesta: {{ $curso->precios }}</h3>

        <input type="hidden" id="idCurso" name="idCurso" value="{{ $curso->id }}">

        <div class="form-group">
            <select name="plantillas" id="plantillas" class="form-control">
                @foreach($plantillas as $plantilla)
                    <option value="{{ $plantilla->id }}">{{ $plantilla->nombre }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-info" id="enviar">Enviar <span class="fi-mail"></span></button>
    </div>
</div>
<div class="col-sm-12">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Nombre y apellidos</th>
                <th>Contacto</th>
                <th style="min-width: 150px;">Señal</th>
                <th style="min-width: 150px;">Resto</th>
                <th>Regalo</th>
                <th style="min-width: 300px;">Observaciones</th>
                <th>Quitar</th>
                <th>-</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($lista as $user)
                <tr>
                    <td>{{ $user['name'] ." ". $user['apellidos'] }}</td>
                    <td>
                        <button onclick="contacto('{{ $user['email'] . "|" . $user['telefono'] }}');" class="btn btn-default contacto"><span class="fi-plus"> Info</span></button>
                    </td>
                    <td>
                        <input type="text" class="form-control senal" id="senal|{{ $user['ids'] }}" value="{{ $user['senal'] }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </td>
                    <td>
                        <input type="text" class="form-control resto" id="resto|{{ $user['ids'] }}" value="{{ $user['resto'] }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </td>
                    <td>
                        <form action="/alumnoscursos/textoregalo/{{ $user['regalo'] }}/{{ $user['ids'] }}" method="post">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            @if($user['regalo']==0)
                                <button type="submit" class="btn btn-warning">No</button>
                            @else
                                <button type="submit" class="btn btn-success">Si</button>
                            @endif
                        </form>
                    </td>
                    <td>
                        <input type="text" class="form-control observaciones" id="observaciones|{{ $user['ids'] }}" value="{{ $user['observaciones'] }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </td>
                    <td>
                        <button class='btn btn-default' data-toggle='modal' data-target='#quitarAlumno' onclick='modal("{{ $user['ids'] }}");'><span class='fi-x'></span></button>
                    </td>
                    <td><input type="checkbox" onclick="check(this);" class="chk" value="{{ $user['email'] }}"></td>
                </tr>
            @endforeach

            <tr class="danger">
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>Lista de Espera</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
            </tr>

            @for($i=0;$i< count($espera); $i++)
                <tr>
                    <td>{{ $espera[$i]->name . " " . $espera[$i]->apellidos }}</td>
                    <td>
                        <!--<button onclick="contacto('{ { $user['email'] . "|" . $user['telefono'] }}');" class="btn btn-info contacto"><span class="fi-plus"> Info</span></button>-->
                    </td>
                    <td>{{ $espera[$i]->senal }}</td>
                    <td>{{ $espera[$i]->resto }}</td>
                    <td>{{ $espera[$i]->regalo }}</td>
                    <td>{{ $espera[$i]->observaciones }}</td>
                    <td>
                        <button class='btn btn-default' data-toggle='modal' data-target='#quitarAlumno' onclick='modal("{{ $curso->id."|".$espera[$i]->id."|1" }}");'><span class='fi-x'></span></button>
                    </td>
                    <td><input type="checkbox" class="chk" value="{{ $espera[$i]->email }}"></td>
                </tr>
            @endfor

            </tbody>
        </table>
    </div>
    <button class="btn btn-primary" id="insertar">Añadir Alumno</button>
    <button type="button" class="btn btn-primary" id="marcar">Marcar / Desmarcar</button>
</div>


    <div class="col-sm-12">
        <div class="contenedor" data-behaviour="search-on-list">
            <input type="text" class="input-query" data-search-on-list="search" placeholder="Buscar..."/>
            <span class="counter" data-search-on-list="counter"></span>
            <div class="list-wrap">
                <ul class="list" data-search-on-list="list">
                    @foreach($alumnos as $alumno)
                        <li class="list-item" data-search-on-list="list-item">
                            <a href="/alumnoscursos/insertaralumno/{{ $curso->id }}/{{ $alumno->id }}" class="list-item-link">{{ $alumno->name . ' ' . $alumno->apellidos}} <span class="item-list-subtext">{{ $alumno->email }}</span></a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>


    <div id="contacto" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Datos de contacto</h4>
                </div>
                <div class="modal-body">
                    <p>Email: <a id="mailto"><span id="email"></span></a></p>
                    <p>Teléfono: <a id="tel"><span id="telefono"></span></a></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>

        </div>
    </div>

    <div id="quitarAlumno" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Quitar el Alumno</h4>
                </div>
                <div class="modal-body">
                    <p>¿Quitar al Alumno del curso?</p>
                </div>
                <div id="modal-append" class="modal-footer">

                </div>
            </div>

        </div>
    </div>


@stop

@section('footer')
    @parent

    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <script>

        (function() {
            // TODO: be more elegant here
            function format(text) {
                return text.replace(/ /g, '').replace(/(<([^>]+)>)/ig, '').toLowerCase();
            }

            var SearchOnList = {
                $LIST: '[data-search-on-list=list]',
                $SEARCH: '[data-search-on-list=search]',
                $LIST_ITEM: '[data-search-on-list=list-item]',
                $COUNTER: '[data-search-on-list=counter]',
                TEMPLATE_EMTPY: '<li class="list-item list-item--disable">No se encontraron resultados</li>',

                init: function($element) {
                    this.items = [];
                    this.itemsMatched = [];

                    this.$element = $element;
                    this.$list = this.$element.find(this.$LIST);
                    this.$search = this.$element.find(this.$SEARCH);
                    this.$counter = this.$element.find(this.$COUNTER);

                    this.items = this._getAllItems();
                    this.itemsMatched = this.items;

                    this._updateCounter();
                    this._handleResults();
                    this._setEventListeners();
                },

                _setEventListeners: function() {
                    this.$search
                            .on('keyup', $.proxy(this._onKeyup, this))
                            .on('query:changed', $.proxy(this._handleQueryChanged, this))
                            .on('query:results:some', $.proxy(this._handleResults, this))
                            .on('query:results:none', $.proxy(this._handleNoResults, this))
                },

                _onKeyup: function() {
                    var query = this.$search.val(),
                            previousQuery = this.$search.data('previousQuery', query);

                    // TODO: Decide when query actually changed
                    if (this._queryChanged()) {
                        this.$search.trigger('query:changed', {
                            query: query,
                            previousQuery: previousQuery
                        });
                    }
                },

                _queryChanged: function() {
                    var query = this.$search.val();
                    if ($.trim(query).length === 0 && this.$search.data('previousQuery') === undefined) {
                        return false;
                    }
                    return true;
                },

                _handleQueryChanged: function(e, data) {
                    this.itemsMatched = this.items.map(function(item) {
                        if (format(item.name).match(format(data.query))) {
                            return {
                                name: item.name,
                                visible: true
                            }
                        }
                        return {
                            name: item.name,
                            visible: false
                        }
                    });

                    this._render();
                    this._updateCounter();
                },

                _handleNoResults: function() {
                    this.$list.html(this.TEMPLATE_EMTPY);
                },

                _handleResults: function() {
                    this.$list.empty().append(this._renderItemsVisible())
                },

                _someItemsVisible: function() {
                    return this.itemsMatched.some(function(item) {
                        return item.visible;
                    });
                },

                _render: function() {
                    (this._someItemsVisible()) ?
                            this.$search.trigger('query:results:some'):
                            this.$search.trigger('query:results:none');
                },

                _updateCounter: function() {
                    (this._someItemsVisible()) ?
                            this.$counter.text(this._renderItemsVisible().length):
                            this.$counter.text('');
                },

                _getAllItems: function() {
                    var $items = this.$list.find(this.$LIST_ITEM);

                    return $items.map(function() {
                        var $item = $(this);

                        return {
                            name: $item.html(),
                            visible: true
                        };
                    }).toArray();
                },

                _renderItemsVisible: function() {
                    var itemInTemplate;
                    return this.itemsMatched.sort(function(a, b) {
                        if (a.name < b.name) return -1
                        if (a.name > b.name) return 1;
                        return 0;
                    }).reduce(function(items, item) {
                        itemInTemplate = '<li class="list-item" data-search-on-list="list-item">' + item.name + '</li>';
                        if (item.visible) {
                            items.push(itemInTemplate);
                        }
                        return items;
                    }, []);
                }
            };

            window.SearchOnList = SearchOnList;
        })();

        SearchOnList.init($('[data-behaviour=search-on-list]'));


        $(document).ready(function(){
            $(".contenedor").hide();

            $("#insertar").click(function(){
                if($(".contenedor").is(":visible")){
                    $(".contenedor").hide();
                }
                else{
                    $(".contenedor").show();
                }
            });
        });


    </script>

    <script>

        var arrayEmails = "";
        var email = "";
        var telefono = "";
        var senal = "";

        function check(chk){
            arrayEmails = arrayEmails.replace($(chk).val() + "|", "");
            if(chk.checked){
                arrayEmails = arrayEmails + $(chk).val() + "|";
            }else{
            }
        }

        function contacto(datos){
            var arr = datos.split("|");
            email = arr[0];
            telefono = arr[1];
        }

        $(document).ready(function(){

            $(".senal").blur(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/anadir/senal",
                    method: "POST",
                    data:
                    {
                        senal : $(this).val(),
                        ids : $(this).attr('id'),
                    },
                    datatype: "text"
                });
            });

            $(".resto").blur(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/anadir/resto",
                    method: "POST",
                    data:
                    {
                        resto : $(this).val(),
                        ids : $(this).attr('id'),
                    },
                    datatype: "text"
                });
            });

            $(".observaciones").blur(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/anadir/observaciones",
                    method: "POST",
                    data:
                    {
                        observaciones : $(this).val(),
                        ids : $(this).attr('id'),
                    },
                    datatype: "text"
                });
            });

            $("#marcar").click(function(){
                if($(".chk").is(":checked")){
                    $(".chk").prop( "checked", false );
                }
                else{
                    $(".chk").prop( "checked", true );
                }

            });

            $(".contacto").click(function(){
                $("#email").text(email);
                $("#telefono").text(telefono);
                $("#mailto").attr("href", "mailto:" + email)
                $("#tel").attr("href", "tel:+" + telefono)
                $('#contacto').modal('show');
            });

            $('#enviar').click(function(){

                if(arrayEmails != ""){
                    $.ajax({
                        url: "/alumnoscursos/emails",
                        method: "POST",
                        data:
                        {
                            emails : arrayEmails,
                            id : $("#idCurso").val(),
                            idPlantilla : $("#plantillas").val(),
                        },
                        datatype: "text"
                    }).done(function() {
                        alert( "success" );
                    });
                }
                else{
                    alert("No hay ningún alumno seleccionado!");
                }
            });

        });

        function modal(ids){
            $("#modal-append").empty();
            var form = "<form method='POST' action='/admin/listaespera/" + ids + "' style='float: right;'><input type='hidden' name='_token' value='{!! csrf_token() !!}'><input name='_method' type='hidden' value='DELETE'><button type='submit' class='btn btn-danger'></span> Borrar</button></form>";
            var boton = "<button type='button' class='btn btn-default' data-dismiss='modal' style='float: left;'>Cancelar</button>";
            $("#modal-append").append(form);
            $("#modal-append").append(boton);
        }



    </script>

@stop