<div class="form-group">
    {{ Form::label('idCategoria', 'Categoria') }}
    {{ Form::select('idCategoria', array('1' => '1', '2' => '2', '3' => '3'), \Illuminate\Support\Facades\Input::old('idCategoria'), array('class' => 'form-control')) }}
    @if ($errors->has('idCategoria')) <p class="help-block">{{ $errors->first('idCategoria') }}</p> @endif
</div>

<div class="form-group">
    {{ Form::label('idProfesor', 'Profesor') }}
    {{ Form::select('idProfesor', array('1' => '1'), \Illuminate\Support\Facades\Input::old('idProfesor'), array('class' => 'form-control')) }}
    @if ($errors->has('idProfesor')) <p class="help-block">{{ $errors->first('idProfesor') }}</p> @endif
</div>

<div class="form-group">
    {{ Form::label('numMax', 'Número Máximo') }}
    {{ Form::text('numMax', \Illuminate\Support\Facades\Input::old('numMax'), array('class' => 'form-control', 'placeholder' => 'Número entre el 6 y el 15')) }}
    @if ($errors->has('numMax')) <p class="help-block">{{ $errors->first('numMax') }}</p> @endif
</div>

<div class="form-group">
    {{ Form::label('numMin', 'Número Mínimo') }}
    {{ Form::text('numMin', \Illuminate\Support\Facades\Input::old('numMin'), array('class' => 'form-control', 'placeholder' => 'Número entre el 4 y el 6')) }}
    @if ($errors->has('numMin')) <p class="help-block">{{ $errors->first('numMin') }}</p> @endif
</div>

<div class="form-group">
    {{ Form::label('fechaInicio', 'Fecha Inicio') }}
    {{ Form::date('fechaInicio', \Illuminate\Support\Facades\Input::old('fechaInicio'), array('class' => 'form-control', 'placeholder' => 'aaaa-mm-dd')) }}
    @if ($errors->has('fechaInicio')) <p class="help-block">{{ $errors->first('fechaInicio') }}</p> @endif
</div>

<div class="form-group">
    {{ Form::label('duracion', 'Duración') }}
    {{ Form::text('duracion', \Illuminate\Support\Facades\Input::old('duracion'), array('class' => 'form-control', 'placeholder' => 'Ej: 1h y media')) }}
    @if ($errors->has('duracion')) <p class="help-block">{{ $errors->first('duracion') }}</p> @endif
</div>

<div class="form-group">
    {{ Form::label('resumen', 'Resumen') }}
    {{ Form::text('resumen', \Illuminate\Support\Facades\Input::old('resumen'), array('class' => 'form-control', 'placeholder' => 'Un resumen del curso')) }}
    @if ($errors->has('resumen')) <p class="help-block">{{ $errors->first('resumen') }}</p> @endif
</div>

<div class="form-group">
    {{ Form::label('descripcion', 'Descripción') }}
    {{ Form::text('descripcion', \Illuminate\Support\Facades\Input::old('descripcion'), array('class' => 'form-control', 'placeholder' => 'Una descripcion del curso')) }}
    @if ($errors->has('descripcion')) <p class="help-block">{{ $errors->first('descripcion') }}</p> @endif
</div>

<div class="form-group">
    {{ Form::label('lugar', 'Lugar') }}
    {{ Form::text('lugar', \Illuminate\Support\Facades\Input::old('lugar'), array('class' => 'form-control', 'placeholder' => 'Dónde se realiza el curso')) }}
    @if ($errors->has('lugar')) <p class="help-block">{{ $errors->first('lugar') }}</p> @endif
</div>

<div class="form-group">
    {{ Form::label('horario', 'Horario') }}
    {{ Form::text('horario', \Illuminate\Support\Facades\Input::old('horario'), array('class' => 'form-control', 'placeholder' => 'Ej: de 6:30 a 8:00')) }}
    @if ($errors->has('horario')) <p class="help-block">{{ $errors->first('horario') }}</p> @endif
</div>

<div class="form-group">
    {{ Form::label('contenidoHTML', 'Contenido HTML') }}
    {{ Form::text('contenidoHTML', \Illuminate\Support\Facades\Input::old('contenidoHTML'), array('class' => 'form-control', 'placeholder' => 'Para poner contenido HTML al curso')) }}
    @if ($errors->has('contenidoHTML')) <p class="help-block">{{ $errors->first('contenidoHTML') }}</p> @endif
</div>

<div class="form-group">
    {{ Form::label('precios', 'Precios') }}
    {{ Form::text('precios', \Illuminate\Support\Facades\Input::old('precios'), array('class' => 'form-control', 'placeholder' => 'precio/s del curso')) }}
    @if ($errors->has('precios')) <p class="help-block">{{ $errors->first('precios') }}</p> @endif
</div>

<div class="form-group">
    {{ Form::label('imagen', 'Imagen') }}
    {{ Form::file('imagen', \Illuminate\Support\Facades\Input::old('imagen'), array('class' => 'form-control')) }}
    @if ($errors->has('imagen')) <p class="help-block">{{ $errors->first('imagen') }}</p> @endif
</div>

<div class="form-group">
    {{ Form::label('slug', 'Slug') }}
    {{ Form::text('slug', \Illuminate\Support\Facades\Input::old('slug'), array('class' => 'form-control', 'placeholder' => 'slug')) }}
    @if ($errors->has('slug')) <p class="help-block">{{ $errors->first('slug') }}</p> @endif
</div>