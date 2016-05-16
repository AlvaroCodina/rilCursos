<h2>Hola {{ $name }}</h2>

<h3>Te falta por pagar el curso de {{ $categoria->nombre }}</h3>

<p>Datos del curso:</p>

<p>{{ $curso->resumen }}</p>

<p>{{ $curso->descripcion }}</p>

<p>Lugar: {{ $curso->lugar }}</p>

<p>{{ $curso->fechaInicio . ' ' . $curso->horario }}</p>