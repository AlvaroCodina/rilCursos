



    <form action="/admin/cursos" method="post" enctype="multipart/form-data">


        <input type="hidden" name="_token" value="{!! csrf_token() !!}">

        <div class="form-group col-md-4">
            <label for="idCategoria">Categoría</label>
            <select name="idCategoria" id="idCategoria" class="form-control">
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="idProfesor">Profesor</label>
            <select name="idProfesor" id="idProfesor" class="form-control">
                @foreach($profesores as $profesor)
                    <option value="{{ $profesor->id }}">{{ $profesor->nombre . " " . $profesor->apellidos }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="slug">Slug</label>
            <input type="text" name="slug" class="form-control" id="slug" placeholder="slug" value="{{ \Illuminate\Support\Facades\Input::old('slug') }}"/>
            @if ($errors->has('slug')) <p class="help-block">{{ $errors->first('slug') }}</p> @endif
        </div>
        <div class="form-group col-md-4">
            <label for="numMax">Número Máximo</label>
            <input type="text" name="numMax" class="form-control" id="numMax" placeholder="Número entre el 6 y el 15" value="{{ \Illuminate\Support\Facades\Input::old('numMax') }}"/>
            @if ($errors->has('numMax')) <p class="help-block">{{ $errors->first('numMax') }}</p> @endif
        </div>
        <div class="form-group col-md-4">
            <label for="numMin">Número Mínimo</label>
            <input type="text" name="numMin" class="form-control" id="numMin" placeholder="Número entre el 4 y el 6" value="{{ \Illuminate\Support\Facades\Input::old('numMin') }}"/>
            @if ($errors->has('numMin')) <p class="help-block">{{ $errors->first('numMin') }}</p> @endif
        </div>
        <div class="form-group col-md-4">
            <label for="fechaInicio">Fecha Inicio</label>
            <input type="date" name="fechaInicio" class="form-control" id="fechaInicio" placeholder="aaaa-mm-dd" value="{{ \Illuminate\Support\Facades\Input::old('fechaInicio') }}"/>
            @if ($errors->has('fechaInicio')) <p class="help-block">{{ $errors->first('fechaInicio') }}</p> @endif
        </div>
        <div class="form-group col-md-4">
            <label for="precios">Precios</label>
            <input type="text" name="precios" class="form-control" id="precios" placeholder="precio/s del curso" value="{{ \Illuminate\Support\Facades\Input::old('precios') }}"/>
            @if ($errors->has('precios')) <p class="help-block">{{ $errors->first('precios') }}</p> @endif
        </div>
        <div class="form-group col-md-4">
            <label for="foto">Foto</label>
            <input type="file" name="foto" class="form-control" id="foto"/>
        </div>
        <div class="form-group col-md-4">
            <label for="duracion">Duración</label>
            <input type="text" name="duracion" class="form-control" id="duracion" placeholder="Ej: 1h y media" value="{{ \Illuminate\Support\Facades\Input::old('duracion') }}"/>
            @if ($errors->has('duracion')) <p class="help-block">{{ $errors->first('duracion') }}</p> @endif
        </div>
        <div class="form-group col-md-6">
            <label for="lugar">Lugar</label>
            <input type="text" name="lugar" class="form-control" id="lugar" placeholder="Dónde se realiza el curso" value="{{ \Illuminate\Support\Facades\Input::old('lugar') }}"/>
            @if ($errors->has('lugar')) <p class="help-block">{{ $errors->first('lugar') }}</p> @endif
        </div>
        <div class="form-group col-md-6">
            <label for="horario">Horario</label>
            <input type="text" name="horario" class="form-control" id="horario" placeholder="Ej: de 6:30 a 8:00" value="{{ \Illuminate\Support\Facades\Input::old('horario') }}"/>
            @if ($errors->has('horario')) <p class="help-block">{{ $errors->first('horario') }}</p> @endif
        </div>
        <div class="form-group col-md-12">
            <label for="resumen">Resumen</label>
            <textarea name="resumen" class="form-control" id="resumen" rows="4" cols="50" value="{{ \Illuminate\Support\Facades\Input::old('resumen') }}" placeholder="Un resumen del curso"></textarea>
            @if ($errors->has('resumen')) <p class="help-block">{{ $errors->first('resumen') }}</p> @endif
        </div>
        <div class="form-group col-md-12">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" class="form-control" id="descripcion" rows="4" cols="50" value="{{ \Illuminate\Support\Facades\Input::old('descripcion') }}" placeholder="Una descripción del curso"></textarea>
            @if ($errors->has('descripcion')) <p class="help-block">{{ $errors->first('descripcion') }}</p> @endif
        </div>
        <div class="form-group col-md-12">
            <label for="contenidoHtml">Contenido</label>
            <textarea name="contenidoHtml" class="form-control" id="contenidoHtml" rows="4" cols="50" value="{{ \Illuminate\Support\Facades\Input::old('contenidoHtml') }}" placeholder="Para poner contenido HTML al curso"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
</form>
