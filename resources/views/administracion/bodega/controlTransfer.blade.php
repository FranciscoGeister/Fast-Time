@extends('layouts.menu')

<link rel="STYLESHEET" type="text/css" href="{{ asset("css/titles.css") }}">

@section('content')
<div class="container">
<form method="POST" action="/controlTransfer">
	{{csrf_field()}}
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a>Administración</a></li>
	    <li class="breadcrumb-item"><a href="#" id="back" onclick="confirmar()">Productos</a></li>
	    <li class="breadcrumb-item active" aria-current="page"><a>Control traslado</a></li>
	  </ol>
	</nav>
	<br>
    <h1 class="title">Traslado de producto</h1>
    <br>
    <h4 class="title">Item: <span class="normal">{{ $item->nombre }}</span></h4>
    <h4 class="title">Marca: <span class="normal">{{ $item->marca }}</span></h4>
    <h4 class="title">Sucursal de origen: <span class="normal">{{ $sucursal_origen->nombre }}</span></h4>
    <br>
    <div class="form-group row">
		<label class="col-md-2 col-form-label">Sucursal destino:</label>
		<div class="col-md-3">
    		<select class="sucursal form-control" id="sucursal" name="id_destino" required="">
    			<option value="0" selected disabled>elija una sucursal</option>
				@foreach($sucursales as $sucursal)
			    	<option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
			    @endforeach
			</select>
    	</div>
	</div>
	<div class="form-group row">
		<label class="col-md-2 col-form-label">Producto:</label>
		<div class="col-md-4">
    		<select class="producto form-control" name="id_product_destino" id="producto" required="">
    		</select>
    	</div>
	</div>
	<div class="form-group row">
		<label class="col-md-2 col-form-label">Stock actual:</label>
		<div class="col-md-2">
    		<input type="text" class="prod_stock form-control" required="">
    	</div>
	</div>
	<div class="form-group row">
		<label class="col-md-2 col-form-label">Cantidad a trasladar</label>
		<div class="col-md-2">
    		<input class="form-control" type="number" name="cantidad" placeholder="Cantidad" required="">
    	</div>
	</div>
	<div class="form-inline">
        <label>Comentario</label>
        <textarea name="comentario" rows="2"></textarea>
    </div>
	<input type="hidden" name="id_product_origen" value="{{ $item->id }}">
	<input type="hidden" name="tipo" value="{{ $tipo }}">
	<input type="hidden" name="id_origen" value="{{ $sucursal_origen->id }}">
    <button class="btn btn-primary" type="submit">Trasladar</button>
</form>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	$(document).on('change','.sucursal',function(){
		var id_sucu=$(this).val();
		var div=$(this).parent().parent().parent();
		var op=" ";
		var tipo='<?php echo $tipo ?>';

		$.ajax({
			type:'get',
			url:'{!!URL::to('getProducts')!!}',
			data:{'id':id_sucu,'tipo':tipo},
			success:function(data){
				op+='<option value="0" selected disabled>elija un producto</option>';
				for(var i=0;i<data.length;i++){
				op+='<option value="'+data[i].id+'">'+data[i].nombre+" "+data[i].marca+'</option>';
			   }
			   div.find('.producto').html(" ");
			   div.find('.producto').append(op);
			   div.find('.prod_stock').val("");
			},
			error:function(){
			}
		});
	});

	$(document).on('change','.producto',function () {
		var id_product=$(this).val();
		var a=$(this).parent().parent().parent();
		var op="";
		var tipo='<?php echo $tipo ?>';

		$.ajax({
			type:'get',
			url:'{!!URL::to('getStock')!!}',
			data:{'id':id_product,'tipo':tipo},
			dataType:'json',//return data will be json
			success:function(data){
				a.find('.prod_stock').val(data.stock);
			},
			error:function(){
			}
		});
	});
});

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