@extends('layouts.menu')

@section('content')

<div class="container">
<form method="POST" action="/logros/{{$logro->id}}" enctype="multipart/form-data">
    {{csrf_field()}}
    {{method_field('PUT')}}
    <h1>Editar Logro: {{$logro->nombre}}</h1>
    <label class="control-label col-sm-1">Nombre</label>
    <input type="text" name="nombre" class="form-control col-sm-4" value="{{$logro->nombre}}">
    <label class="control-label col-sm-1">Descripción</label>
    <input type="text" name="descripcion" class="form-control col-sm-4" value="{{$logro->descripcion}}">
    <label class="control-label col-sm-1">Icono</label>
    <img src="{{ Storage::url($logro->icono) }}"  width="150px">
    <input type="file" name="icono" class="form-control col-sm-4">
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
