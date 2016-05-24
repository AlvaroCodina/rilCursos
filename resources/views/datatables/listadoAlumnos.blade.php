<div class="col-sm-8 col-sm-offset-2">

    <div class="page-header">
        <h1><span class="fi-torsos-all"></span> Listado de Alumnos</h1>

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
<div>
    <table class="table table-striped table-bordered dt-responsive nowrap" id="alumnos-table" style="width: 100%;">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Cámara</th>
            <th>Ver cursos</th>
            <th>Editar</th>
            <th>Borrar</th>
        </tr>
        </thead>
    </table>
</div>