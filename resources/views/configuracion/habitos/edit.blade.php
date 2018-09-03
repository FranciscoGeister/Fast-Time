@extends('layouts.menu')

@section('content')

<div class="container">
<form method="POST" action="/habitos/{{$habito->id}}" enctype="multipart/form-data">
    {{csrf_field()}}
    {{method_field('PUT')}}
    <h1>Editar Pregunta: {{$habito->pregunta}}</h1>
    <label class="control-label col-sm-1">Pregunta</label>
    <input type="text" name="pregunta" class="form-control col-sm-4" value="{{$habito->pregunta}}">
  </br>
    <button class="btn btn-primary" type="submit">Editar</button>
</form>
</div>

<style>
textarea {
    width: 100%;
    height: 150px;
    padding: 12px 20px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
    resize: none;
}
</style>

@endsection
