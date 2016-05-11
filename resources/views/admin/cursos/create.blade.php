<div class="col-sm-8 col-sm-offset-2">

    <div class="page-header">
        <h1><span class="glyphicon glyphicon-share"></span>{{$editarCrear}} Curso</h1>
    </div>

    <div>

            {{ Form::model(array('route' => array('admin.cursos'), 'method' => 'POST')) }}
                @include('_form')
            {{ Form::submit($editarCrear . ' Curso', array('class' => 'btn btn-default')) }}

        {{ Form::close() }}
    </div>

</div>