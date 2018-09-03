
@extends('layouts.menu')




@section('content')


<div id="container" class="container">
  <h4>Patologias</h4>
  <ul>
  @foreach($patologias as $patologia)
      <li>{{$patologia->nombre}}</li>
  @endforeach
  </ul>
  <h4>Preguntas Médicas</h4>
  <dl>
  @foreach($preguntas->preguntas as $pregunta)
      @foreach($preguntas->respuestas as $respuesta)
        @if($respuesta->pregunta_id == $pregunta->id)
          <dt>{{$pregunta->pregunta}}</dt>
          <dd>Respuesta: {{$respuesta->respuesta}}</dd>
        @endif
      @endforeach
  @endforeach
  </dl>
  <h4>Antecedentes Personales</h4>
  <ul>
  @foreach($antecedentes as $antecedente)
      <li>{{$antecedente->nombre}}</li>
  @endforeach
  </ul>
  <h4>Hábitos de Vida</h4>
  <dl>
  @foreach($habitos->vida as $habito)
      @foreach($habitos->respuestas as $respuesta)
        @if($respuesta->pregunta_id == $habito->id)
          <dt>{{$habito->pregunta}}</dt>
          <dd>Respuesta: {{$respuesta->respuesta}}</dd>
        @endif
      @endforeach
  @endforeach
  </dl>
  <h4>Hábitos Laborales</h4>
  <dl>
  @foreach($habitos->laboral as $habito)
      @foreach($habitos->respuestas as $respuesta)
        @if($respuesta->pregunta_id == $habito->id)
          <dt>{{$habito->pregunta}}</dt>
          <dd>Respuesta: {{$respuesta->respuesta}}</dd>
        @endif
      @endforeach
  @endforeach
  </dl>
  <h4>Hábitos No Saludables</h4>
  <dl>
  @foreach($habitos->salud as $habito)
      @foreach($habitos->respuestas as $respuesta)
        @if($respuesta->pregunta_id == $habito->id)
          <dt>{{$habito->pregunta}}</dt>
          <dd>Respuesta: {{$respuesta->respuesta}}</dd>
        @endif
      @endforeach
  @endforeach
  </dl>
  <h4>Hábitos Nutricionales</h4>
  <dl>
  @foreach($habitos->nutricion as $habito)
      @foreach($habitos->respuestas as $respuesta)
        @if($respuesta->pregunta_id == $habito->id)
          <dt>{{$habito->pregunta}}</dt>
          <dd>Respuesta: {{$respuesta->respuesta}}</dd>
        @endif
      @endforeach
  @endforeach
  </dl>
</div>
@endsection
