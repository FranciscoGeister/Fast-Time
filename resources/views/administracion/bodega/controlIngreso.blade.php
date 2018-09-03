@extends('layouts.menu')

@section('content')

<link rel="STYLESHEET" type="text/css" href="{{ asset("css/titles.css") }}"> 

<div class="container">
	<form method="POST" action="/controlIngreso">
		{{csrf_field()}}
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a>Administración</a></li>
		    <li class="breadcrumb-item"><a href="#" id="back" onclick="confirmar()">Productos</a></li>
		    <li class="breadcrumb-item active" aria-current="page"><a>Control Ingreso</a></li>
		  </ol>
		</nav>
		<br>
		<h1 class="title">Control de ingreso</h1>
		<br>
		<h4 class="title">Item: <span class="normal">{{ $item->nombre }}</span></h4>
		<h4 class="title">Marca: <span class="normal">{{ $item->marca }}</span></h4>
		<h4 class="title">Sucursal: <span class="normal">{{ $sucursal->nombre }}</span></h4>
		<br>
		<div class="form-group row">
			<label class="col-sm-3 col-form-label">Número boleta/factura</label>
			<div class="col-sm-2">
        		<input type="number" name="boleta" class="form-control" placeholder="Boleta/Factura" required>
        	</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-3 col-form-label">Cantidad a agregar</label>
			<div class="col-sm-2">
				<input type="number" name="cant_agregar" class="form-control" placeholder="Cantidad" required>
			</div>
		</div>
		@if(strcmp($tipo,"producto")==0)
			<div class="form-group row">
				<label class="col-sm-3 col-form-label">Fecha de vencimiento</label>
				<div class="col-sm-3">
					<input class="form-control" type="date" name="vencimiento" required>
				</div>
			</div>
		@endif      
		<div class="form-inline">
   			<label>Comentario</label>
    		<textarea name="comentario" rows="2"></textarea>
		</div>
		<input type='hidden' name='id_sucursal' value="{{$sucursal->id}}">
		<input type='hidden' name='id_product' value="{{$item->id}}">
		<input type='hidden' name='tipo' value="{{$tipo}}">
		<button class="btn btn-primary" type="submit">Terminar</button>
	</form>
</div>


<script type="text/javascript">
function confirmar() {
    var r = confirm("Los datos no se guardaran");
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