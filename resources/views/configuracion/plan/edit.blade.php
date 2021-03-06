@extends('layouts.menu')

@section('content')

<div class="container">
<form method="POST" action="/socios/{{$plan->id}}">
    {{csrf_field()}}
    {{method_field('PUT')}}
    <h1>Editar plan</h1>
    <div class="form-inline" >
        <label class="control-label col-sm-1">Nombre</label>
        <input type="text" name="nombre" class="form-control col-sm-4" value="{{$plan->nombre}}">
        <label class="control-label col-sm-1">Estado</label>
        <select class="form-control col-sm-3" name="estado">
            <option value="1">Disponible</option>
            <option value="0">No disponible</option>
        </select>
    </div>
    <div class="form-inline">
        <label class="control-label col-sm-1">Duración</label>
        <input type="number" name="duracion" class="form-control col-sm-4" value="{{$plan->duracion}}">
        <label class="control-label col-sm-1">Valor</label>
        <input type="number" name="valor" class="form-control col-sm-4" value="{{$plan->valor}}">
    </div>
    <div class="form-inline">
        <label class="control-label col-sm-1">Sesiones</label>
        <input type="number" name="sesiones" class="form-control col-sm-4" value="{{$plan->sesiones}}">
        <label class="control-label col-sm-1">Sesiones semanales</label>
        <input type="number" name="sesi_semanal" class="form-control col-sm-4" value="{{$plan->sesi_semanal}}">
    </div>
    <div class="form-inline">
        <label>Descripción</label>
        <textarea name="descripcion" rows="2">{{$plan->descripcion}}</textarea>
    </div>
    <button class="btn btn-primary" type="submit">Registrar</button>
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