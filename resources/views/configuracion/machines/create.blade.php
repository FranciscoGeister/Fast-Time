@extends('layouts.menu')

@section('content')

<div class="container">
<form method="POST" action="/maquinas">
	{{csrf_field()}}
    <h1>Ingreso de máquina</h1>
	<div class="form-inline" >
   		<label class="control-label col-sm-1">Nombre</label>
   		<input type="text" name="nombre" class="form-control col-sm-3" placeholder="Nombre">
   		<label class="control-label col-sm-1">Marca</label>
   		<input type="text" name="marca" class="form-control col-sm-3" placeholder="Marca">
   		<label class="control-label col-sm-1">Código</label>
   		<input type="text" name="codigo" class="form-control col-sm-3" placeholder="código">
    </div>
    <div class="form-inline">
        <label class="control-label col-sm-1">Color</label>
        <input type="text" name="color" class="form-control col-sm-3" placeholder="color">
        <label class="control-label col-sm-1">fecha de compra</label>
        <input type="date" name="fecha_compra" class="form-control col-sm-3" placeholder="">
        <label class="control-label col-sm-1">Vendedor</label>
        <input type="text" name="vendedor" class="form-control col-sm-3" placeholder="vendedor">
    </div>
    <div class="form-inline">
    <label class="control-label col-sm-1">Sucursal</label>
    <select class="form-control col-sm-3" name="sede_id">
            @foreach($sucursales as $sucursal)
            <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-inline">
        <label>Descripción</label>
        <textarea name="descripcion" rows="2"></textarea>
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

