@extends('layouts.menu')

<link rel="STYLESHEET" type="text/css" href="{{ asset("css/titles.css") }}">

@section('content')

<div class="container">
<form method="POST" action="/underwears">
	{{csrf_field()}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a>Administración</a></li>
          <li class="breadcrumb-item"><a href="#" id="back" onclick="confirmar()">Productos</a></li>
          <li class="breadcrumb-item active" aria-current="page">Nuevo Producto</li>
        </ol>
    </nav>
    <br>
    <h1 class="title">Ingreso de nuevo underwear</h1>
    <h2 class="title">Sucursal: <span class="normal">{{ $sucursal }}</span></h2>
    <br>
    <div class="form-group row" >
            <label class="control-label col-md-2">Nombre:</label>
            <div class="col-md-4">
                <input type="text" name="nombre" class="form-control" placeholder="Nombre" required="">
            </div>              
    </div>
    <div class="form-group row">
            <label class="control-label col-md-2">Marca:</label>
            <div class="col-md-4">
                <input type="text" name="marca" class="form-control" placeholder="Marca" required="">
            </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2">Talla:</label>
        <div class="col-md-2">
            <select class="form-control" name="talla">
                @foreach($sizes as $size)
                    <option value="{{ $size->nombre }}">{{ $size->nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2">Stock:</label>
        <div class="col-md-2">
            <input type="number" name="stock" class="form-control" placeholder="Stock" required="">
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2">Stock Crítico:</label>
        <div class="col-md-2">
            <input type="number" name="stock_critico" class="form-control" value="0" required="">
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2">Precio:</label>
        <div class="col-md-2">
            <input type="hidden" name="precio" id="precio">
            <input type="text" name="vista_precio" class="form-control" onkeyup="this.value= formatNumber.format_precio(this.value)" required="">
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2">Precio de arriendo:</label>
        <div class="col-md-2">
            <input type="hidden" name="precio_arriendo" id="precio_arriendo">
            <input type="text" name="vista_precio_arriendo" class="form-control" onkeyup="this.value= formatNumber.format_arriendo(this.value)" required="">
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2">Número boleta/factura:</label>
        <div class="col-md-2">
            <input type="number" name="boleta" class="form-control" placeholder="boleta/factura" required="">
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2">Estado:</label>
        <div class="col-md-2">
            <select class="form-control" name="estado">
                    <option value="7" selected="">Disponible</option>
                    <option value="8">No disponible</option>
            </select>
        </div>
    </div>
    <input type='hidden' name='id_sucursal' value="{{$id_sucursal}}">
    <button class="btn btn-primary" type="submit">Crear</button>
</form>
</div>

<script type="text/javascript">
var formatNumber = {
    separador: ".", // separador para los miles
    sepDecimal: ',', // separador para los decimales
    formatear:function (num){
        num +='';
        var splitStr = num.split('.');
        var splitLeft = splitStr[0];
        var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
        var regx = /(\d+)(\d{3})/;
        while (regx.test(splitLeft)) {
            splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
        }

        return this.simbol + splitLeft +splitRight;
    },
    format_precio:function(num, simbol){
        this.simbol = simbol ||'';
        res= num.replace(/\./g,"");
        document.getElementById('precio').value= res;
        console.log(res);
        return this.formatear(res);
    },
    format_arriendo:function(num, simbol){
        this.simbol = simbol ||'';
        res= num.replace(/\./g,"");
        document.getElementById('precio_arriendo').value= res;
        console.log(res);
        return this.formatear(res);
    }
}

function confirmar() {
    var r = confirm("Los datos no se guardaran");
    if (r == true) {
        document.getElementById("back").href = "/productos";
    }
}
</script>

@endsection