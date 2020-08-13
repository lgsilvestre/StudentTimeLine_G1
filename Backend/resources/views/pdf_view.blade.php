<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
  <h1>Información Estudiante</h1>
  <div>
    @foreach($estudiante as $key => $atributo)
        <p>Matricula: {{$atributo->matricula}}</p>
        <p>RUT: {{$atributo->rut}} </p>
        <p>Nombre Completo: {{$atributo->nombre_completo}} </p>
        <p>Correo: {{$atributo->correo}}  </p>
        <p>Año Ingreso: {{$atributo->anho_ingreso}}  </p>
        <p>Situación Académica: {{$atributo->situacion_academica}}  </p>
        <p>Escuela: {{$atributo->escuela}}  </p>
    @endforeach
  </div>
  <div>
  <h1>Observaciones</h1>
    @foreach($observaciones as $key => $observacion)
        <p>Profesor: {{$observacion->profesor}}</p>
        <p>Curso: {{$observacion->curso}} </p>
        <p>Categoria: {{$observacion->categoria}} </p>
        <p>Título: {{$observacion->titulo}}  </p>
        <p>Descripción: {{$observacion->descripcion}}  </p>
        <p>Tipo: {{$observacion->tipo}}  </p>
        <p>-----</p>
    @endforeach
  </div>
</body>
</body>
</html>