@extends('layouts.menu')

<link rel="STYLESHEET" type="text/css" href="{{ asset("css/titles.css") }}">

@section('content')

<div class="container">
    <form method="POST" action="/aseo/{{$cleaning->id}}">
        {{csrf_field() }}
        {{method_field('PUT')}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a>Administración</a></li>
              <li class="breadcrumb-item"><a href="#" id="back" onclick="confirmar()">Productos</a></li>
              <li class="breadcrumb-item active" aria-current="page">Editar Producto</li>
            </ol>
        </nav>
        <br>
        <h1 class="title">Editar útil de aseo</h1>
        <br>
    	<div class="form-group row" >
            <label class="control-label col-md-2">Nombre:</label>
            <div class="col-md-4">
                <input type="text" name="nombre" class="form-control" value="{{$cleaning->nombre}}" required="">
            </div>              
        </div>
        <div class="form-group row">
            <label class="control-label col-md-2">Marca:</label>
            <div class="col-md-4">
                <input type="text" name="marca" class="form-control" value="{{$cleaning->marca}}" required="">
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-md-2">Stock:</label>
            <div class="col-md-2">
                <input type="number" name="stock" class="form-control" value="{{ $cleaning->stock }}" required="">
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-md-2">Stock Crítico:</label>
            <div class="col-md-2">
                <input type="number" name="stock_critico" class="form-control" value="{{ $cleaning->stock_critico }}" required="">
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-md-2">Unidad de medida:</label>
            <div class="col-md-2">
                <select class="form-control" name="um" required="">
                @foreach($unities as $um)
                    @if($um->id==$cleaning->um)
                        <option value="{{ $um->id }}" selected="">{{ $um->nombre }}</option>
                    @else
                        <option value="{{ $um->id }}">{{ $um->nombre }}</option>
                    @endif
                @endforeach
            </select>
            </div>
        </div>
        <div class="form-inline">
            <label>Descripción</label>
            <textarea name="descripcion" rows="2">{{$cleaning->descripcion}}</textarea>
        </div>
        <button class="btn btn-primary" type="submit">Editar</button>
    </form>
</div>

<script type="text/javascript">
function confirmar() {
    var r = confirm("Los cambios no se guardaran");
    if (r == true) {
        document.getElementById("back").href = "/productos";
    }
}
</script>

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