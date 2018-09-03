@extends('layouts.menu')

@section('content')

<div class="container">
<form method="POST" action="/maquinas">
	{{csrf_field()}}
    <h1>Editar de máquina {{ $machine->nombre }}</h1>
	<div class="form-inline" >
   		<label class="control-label col-sm-1">Nombre</label>
   		<input type="text" name="nombre" class="form-control col-sm-3" value="{{ $machine->nombre }}">
   		<label class="control-label col-sm-1">Marca</label>
   		<input type="text" name="marca" class="form-control col-sm-3" value="{{ $machine->marca }}">
   		<label class="control-label col-sm-1">Código</label>
   		<input type="text" name="codigo" class="form-control col-sm-3" value="{{ $machine->codigo }}">
    </div>
    <div class="form-inline">
        <label class="control-label col-sm-1">Color</label>
        <input type="text" name="color" class="form-control col-sm-3" value="{{ $machine->color }}">
        <label class="control-label col-sm-1">fecha de compra</label>
        <input type="date" name="fecha_compra" class="form-control col-sm-3" value="{{ $machine->fecha_compra }}">
        <label class="control-label col-sm-1">Vendedor</label>
        <input type="text" name="vendedor" class="form-control col-sm-3" value="{{ $machine->vendedor }}">
    </div>
    <div class="form-inline">
        <label>Descripción</label>
        <textarea name="descripcion" rows="2">{{ $machine->descripcion }}</textarea>
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