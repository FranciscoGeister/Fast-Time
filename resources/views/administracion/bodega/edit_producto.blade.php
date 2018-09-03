@extends('layouts.menu')

<link rel="STYLESHEET" type="text/css" href="{{ asset("css/titles.css") }}">

@section('content')

<div class="container">
    <form method="POST" action="/productos/{{$product->id}}">
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
        <h1 class="title">Editar producto</h1>
        <br>
        <div class="form-group row" >
            <label class="control-label col-md-2">Nombre:</label>
            <div class="col-md-4">
                <input type="text" name="nombre" class="form-control" value="{{$product->nombre}}" required="">
            </div>              
        </div>
        <div class="form-group row">
            <label class="control-label col-md-2">Marca:</label>
            <div class="col-md-4">
                <input type="text" name="marca" class="form-control" value="{{$product->marca}}" required="">
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-md-2">Stock:</label>
            <div class="col-md-2">
                <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required="">
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-md-2">Stock Crítico:</label>
            <div class="col-md-2">
                <input type="number" name="stock_critico" class="form-control" value="{{ $product->stock_critico }}" required="">
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-md-2">Unidad de medida:</label>
            <div class="col-md-2">
                <select class="form-control" name="um" required="">
                @foreach($unities as $um)
                    @if($um->id==$product->um)
                        <option value="{{ $um->id }}" selected="">{{ $um->nombre }}</option>
                    @else
                        <option value="{{ $um->id }}">{{ $um->nombre }}</option>
                    @endif
                @endforeach
            </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-md-2">Precio:</label>
            <div class="col-md-2">
                <input type="hidden" name="precio" id="precio" value="{{$product->precio}}">
                <input type="text" name="vista_precio" class="form-control" onkeyup="this.value= formatNumber.format_esp(this.value)" value={{$product->precio}} required="">
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-md-2">Vencimiento:</label>
            <div class="col-md-3">
                <input type="date" name="vencimiento" class="form-control" value="{{$product->vencimiento}}" required="">
            </div>
        </div>
        <br>
        <div class="form-inline">
            <label>Descripción</label>
            <textarea name="descripcion" rows="2">{{$product->descripcion}}</textarea>
        </div>
        <button class="btn btn-primary" type="submit">Editar</button>
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
    format:function(num, simbol){
        this.simbol = simbol ||'';
        return this.formatear(num);
    },
    format_esp:function(num, simbol){
        this.simbol = simbol ||'';
        res= num.replace(/\./g,"");
        document.getElementById('precio').value= res;
        console.log(res);
        return this.formatear(res);
    }
}

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