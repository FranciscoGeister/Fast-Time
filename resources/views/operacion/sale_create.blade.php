@extends('layouts.menu')
<link rel="STYLESHEET" type="text/css" href="{{ asset("css/titles.css") }}">

@section('content')

<div class="container">
<form method="POST" action="/sell_products" onsubmit="return validar(this);">
    {{csrf_field()}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a>Operación</a></li>
          <li class="breadcrumb-item"><a href="#" id="back" onclick="confirmar()">Venta</a></li>
          <li class="breadcrumb-item active" aria-current="page"><a>Venta de Productos</a></li>
        </ol>
    </nav>
    <br>
    <h4 class="title">Venta de Productos a socio: <span class="normal">{{ $member->nombre }} {{ $member->paterno }}</span></h4>
    <br>
    <div class="form-inline">
        <label class="control-label col-sm-2"><b>Productos</b></label>
        <button class="btn btn-primary" id="agregar_product" type="button">+</button>
    </div>
     <table class="table table_product table-bordered">
        <thead>
            <tr>
                <td>Producto</td>
                <td>Precio Unitario</td>
                <td>Cantidad</td>
                <td>Precio Total</td>
            </tr>
        </thead>
    </table>
    <br>
    <div class="form-inline">
        <label class="control-label col-sm-2"><b>Underwear</b></label>
        <button class="btn btn-primary" id="agregar_under" type="button">+</button>
    </div>
     <table class="table table_under table-bordered">
        <thead>
            <tr>
                <td>Producto</td>
                <td>Precio Unitario</td>
                <td>Cantidad</td>
                <td>Precio Total</td>
            </tr>
        </thead>
    </table>
    <br>
    @if($hasPlan==1)
        <div class="form-inline">
            <label class="control-label col-sm-2"><b>Sesiones extra</b></label>
            <button class="btn btn-primary" id="agregar" type="button">+</button>
        </div>
        <table class="table table_sesions table-bordered">
            <thead>
                <tr>
                    <td>Tipo</td>
                    <td>Precio Unitario</td>
                    <td>Cantidad</td>
                    <td>Precio Total</td>
                </tr>
            </thead>
        </table>
    @endif
    <br>
    <label class="control-label"><h4 class="title">Resumen: </h4></label>
    <div class="form-inline">
        <label class="control-label col-sm-3">Total productos</label>
        <input type="hidden" name="total_product" class="total_product" value="0">
        <input type="text" name="vista_total_product" class="vista_total_product form-control col-sm-2" value="$0" style="text-align:right" readonly>
    </div>
    <div class="form-inline">
        <label class="control-label col-sm-3">Total Underwear</label>
        <input type="hidden" name="total_under" class="total_under" value="0">
        <input type="text" name="vista_total_under" class="vista_total_under form-control col-sm-2" value="$0" style="text-align:right" readonly>
    </div>
    <div class="form-inline">
        <label class="control-label col-sm-3">Total sesiones</label>
        <input type="hidden" name="total_sesion" class="total_sesion" id="total_sesion" value="0">
        <input type="text" name="vista_total_sesion" class="vista_total_sesion form-control col-sm-2" value="$0" style="text-align:right" readonly>
    </div>
    <div class="form-inline">
        <label class="control-label col-sm-3">Total</label>
        <input type="hidden" name="total" class="total" id="total" value="0">
        <input type="text" name="vista_total" class="vista_total form-control col-sm-2" value="$0" style="text-align:right" readonly>
    </div>
    <br>
    <div class="form-inline">
        <label class="control-label col-sm-2"><b>Forma de pago</b></label>
        <button class="btn btn-primary" id="agregar_pago" type="button">+</button>
    </div>
    <table class="table table_pays table-bordered">
        <thead>
            <tr>
                <td>Tipo</td>
                <td>Monto</td>
            </tr>
        </thead>
    </table>
    <div class="row form-inline">
        <label class="control-label col-sm-2">Por pagar: </label>
        <input type="hidden" class="restante" id="restante" value="0">
        <input type="text" class="vista_restante form-control" id="vista_restante" value="$0" style="text-align:right" readonly>
        <label class="control-label col-sm-2">Total: </label>
        <input type="hidden" class="total_verified" id="total_verified" value="0">
        <input type="text" class="vista_total_verified form-control" id="vista_total_verified" value="$0" style="text-align:right" readonly>
    </div>
    <br>
    <div class="row form-inline">
        <label class="control-label col-sm-2">N° boleta exenta:</label>
        <input type="number" class="boleta form-control col-sm-2" name="boleta" style="text-align:right">
        <label class="control-label col-sm-2">Fecha:</label>
        <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}">
    </div>
    <br>
    <input type="hidden" name="member_id" value="{{ $member->id }}">
    <input type="hidden" name="id_sucursal" value="{{ $id_sucursal }}">
    <button class="btn btn-primary" type="submit">Finalizar</button>
</form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script type="text/javascript">
$("#agregar_product").click(function(){
    var nuevaFila="<tr>";
    nuevaFila+='<td><select class="product form-control col-sm-12" name="product[]">'+
                        '<option value="0" selected disabled>Elija</option>'+
                        '@foreach($products as $product)'+
                        '<option value="{{ $product->id }}">{{ $product->nombre }}</option>'+
                        '@endforeach'+
                    '</select></td>';
    nuevaFila+='<td><input type="hidden" class="unitario" name="unitario">';
    nuevaFila+='<input type="text" class="vista_unitario form-control col-sm-12" style="text-align:right" readonly></td>';
    nuevaFila+='<td><input type="number" class="cantidad form-control col-sm-12" name="cant_prod[]" style="text-align:right"></td>';
    nuevaFila+='<td><input type="hidden" class="monto" name="monto_product[]">';
    nuevaFila+='<input type="text" class="vista_monto form-control col-sm-12" style="text-align:right" readonly></td>';
    nuevaFila+='<td><button class="btn btn-danger" type="button">Borrar</button></td>';
    nuevaFila+="</tr>";
    $(".table_product").append(nuevaFila);
});

$("#agregar_under").click(function(){
    var nuevaFila="<tr>";
    nuevaFila+='<td><select class="under form-control col-sm-12" name="under[]">'+
                        '<option value="0" selected disabled>Elija</option>'+
                        '@foreach($underwears as $underwear)'+
                        '<option value="{{ $underwear->id }}">{{ $underwear->nombre }} {{ $underwear->talla }}</option>'+
                        '@endforeach'+
                    '</select></td>';
    nuevaFila+='<td><input type="hidden" class="unitario" name="unitario">';
    nuevaFila+='<input type="text" class="vista_unitario form-control col-sm-12" style="text-align:right" readonly></td>';
    nuevaFila+='<td><input type="text" class="cantidad form-control col-sm-12" name="cant_under[]" style="text-align:right" ></td>';
    nuevaFila+='<td><input type="hidden" class="monto" name="monto_under[]">';
    nuevaFila+='<input type="text" class="vista_monto form-control col-sm-12" style="text-align:right" readonly></td>';
    nuevaFila+='<td><button class="btn btn-danger" type="button">Borrar</button></td>';
    nuevaFila+="</tr>";
    $(".table_under").append(nuevaFila);
});

$("#agregar").click(function(){
    var nuevaFila="<tr>";
    nuevaFila+='<td><select class="sesion form-control col-sm-12" name="sesion[]">'+
                        '<option value="0" selected disabled>Tipo de sesion</option>'+
                        '@foreach($sessions as $session)'+
                        '<option value="{{ $session->id }}">{{ $session->nombre }}</option>'+
                        '@endforeach'+
                    '</select></td>';
    nuevaFila+='<td><input type="hidden" class="unitario" name="unitario">';
    nuevaFila+='<input type="text" class="vista_unitario form-control col-sm-12" style="text-align:right" readonly></td>';
    nuevaFila+='<td><input type="number" class="cantidad form-control col-sm-12" name="cantidad[]" style="text-align:right"></td>';
    nuevaFila+='<td><input type="hidden" class="monto" name="monto_sesion[]">';
    nuevaFila+='<input type="text" class="vista_monto form-control col-sm-12" style="text-align:right" readonly></td>';
    nuevaFila+='<td><button class="btn btn-danger" type="button">Borrar</button></td>';
    nuevaFila+="</tr>";
    $(".table_sesions").append(nuevaFila);
});

$("#agregar_pago").click(function(){
    var nuevaFila="<tr>";
    nuevaFila+='<td><select class="pago form-control" name="pago[]">'+
                        '<option value="0" selected disabled>Elija</option>'+
                        '@foreach($payments as $payment)'+
                        '<option value="{{ $payment->id }}">{{ $payment->nombre }}</option>'+
                        '@endforeach'+
                    '</select></td>';
    nuevaFila+='<td><input type="hidden" class="monto_pago" name="monto_pago[]">';
    nuevaFila+='<input type="text" class="vista_monto form-control" name="vista_monto_pago[]" style="text-align:right" onkeyup="this.value= formatNumber.format_esp(this.value)"></td>';
    nuevaFila+='<td><button class="btn btn-danger" type="button">Borrar</button></td>';
    nuevaFila+="</tr>";
    $(".table_pays").append(nuevaFila);
});

$(".table_product").on('click',".btn-danger",eliminarFila_product);
function eliminarFila_product(){
    var fila=$(this).parent().parent();
    var ancestro=$(this).parents();
    var monto= fila.find('.monto').val();
    var total_ant= ancestro.find('.total').val();
    var total_product_ant=ancestro.find('.total_product').val();
    var total_verified= ancestro.find('.total_verified').val();
    ancestro.find('.total').val(total_ant-monto);
    ancestro.find('.vista_total').val(formatNumber.format(total_ant-monto,"$"));
    ancestro.find('.total_product').val(total_product_ant-monto);
    ancestro.find('.vista_total_product').val(formatNumber.format(total_product_ant-monto,"$"));
    ancestro.find('.restante').val(total_ant-monto-total_verified);
    ancestro.find('.vista_restante').val(formatNumber.format(total_ant-monto-total_verified,"$"));
    $(this).parent().parent().remove();
}

$(".table_under").on('click',".btn-danger",eliminarFila_under);
function eliminarFila_under(){
    var fila=$(this).parent().parent();
    var ancestro=$(this).parents();
    var monto= fila.find('.monto').val();
    var total_ant= ancestro.find('.total').val();
    var total_under_ant=ancestro.find('.total_under').val();
    var total_verified= ancestro.find('.total_verified').val();
    ancestro.find('.total').val(total_ant-monto);
    ancestro.find('.vista_total').val(formatNumber.format(total_ant-monto,"$"));
    ancestro.find('.total_under').val(total_under_ant-monto);
    ancestro.find('.vista_total_under').val(formatNumber.format(total_under_ant-monto,"$"));
    ancestro.find('.restante').val(total_ant-monto-total_verified);
    ancestro.find('.vista_restante').val(formatNumber.format(total_ant-monto-total_verified,"$"));
    $(this).parent().parent().remove();
}

$(".table_sesions").on('click',".btn-danger",eliminarFila);
function eliminarFila(){        
    var fila=$(this).parent().parent();
    var ancestro=$(this).parents();
    var monto= fila.find('.monto').val();
    var total_ant= ancestro.find('.total').val();
    var total_sesion_ant=ancestro.find('.total_sesion').val();
    var total_verified= ancestro.find('.total_verified').val();
    ancestro.find('.total').val(total_ant-monto);
    ancestro.find('.vista_total').val(formatNumber.format(total_ant-monto,"$"));
    ancestro.find('.restante').val(total_ant-monto-total_verified);
    ancestro.find('.vista_restante').val(formatNumber.format(total_ant-monto-total_verified,"$"));
    ancestro.find('.total_sesion').val(total_sesion_ant-monto);
    ancestro.find('.vista_total_sesion').val(formatNumber.format(total_sesion_ant-monto,"$"));
    $(this).parent().parent().remove();
}

$(".table_pays").on('click',".btn-danger",eliminarFila_pay);
function eliminarFila_pay(){
    $(this).parent().parent().remove();
    var pagos= document.getElementsByName("monto_pago[]");
    var total=0;
    for(i=0;i<pagos.length;i++){
        total+=parseInt(pagos[i].value.replace(/\./g,""));
    }
    document.getElementById('total_verified').value= total;
    document.getElementById('vista_total_verified').value= formatNumber.format(total,"$");
    document.getElementById('restante').value= document.getElementById('total').value-total;
    document.getElementById('vista_restante').value= formatNumber.format(document.getElementById('total').value-total,"$");
}

$(".table_product").on('keyup',".cantidad",actualizarMonto);
function actualizarMonto(){
    var fila=$(this).parent().parent();
    var unitario= fila.find('.unitario').val();
    var cant= fila.find('.cantidad').val();
    var monto_ant= fila.find('.monto').val();
    var total= cant*unitario;
    fila.find('.monto').val(total);
    fila.find('.vista_monto').val(formatNumber.format(total,"$"));
    var ancestro=$ (this).parents();
    var total_ant=ancestro.find('.total_product').val();
    var temp_total=ancestro.find('.total').val();
    var total_verified= ancestro.find('.total_verified').val();
    ancestro.find('.total_product').val(total_ant-monto_ant+total);
    ancestro.find('.vista_total_product').val(formatNumber.format(total_ant-monto_ant+total,"$"));
    ancestro.find('.total').val(temp_total-monto_ant+total);
    ancestro.find('.vista_total').val(formatNumber.format(temp_total-monto_ant+total,"$"));
    ancestro.find('.restante').val(temp_total-monto_ant+total-total_verified);
    ancestro.find('.vista_restante').val(formatNumber.format(temp_total-monto_ant+total-total_verified,"$"));
}

$(".table_under").on('keyup',".cantidad",actualizarMonto2);
function actualizarMonto2(){
    var fila=$(this).parent().parent();
    var unitario= fila.find('.unitario').val();
    var cant= fila.find('.cantidad').val();
    var monto_ant= fila.find('.monto').val();
    var total= cant*unitario;
    fila.find('.monto').val(total);
    fila.find('.vista_monto').val(formatNumber.format(total,"$"));
    var ancestro=$ (this).parents();
    var total_ant=ancestro.find('.total_under').val();
    var temp_total=ancestro.find('.total').val();
    var total_verified= ancestro.find('.total_verified').val();
    ancestro.find('.total_under').val(total_ant-monto_ant+total);
    ancestro.find('.vista_total_under').val(formatNumber.format(total_ant-monto_ant+total,"$"));
    ancestro.find('.total').val(temp_total-monto_ant+total);
    ancestro.find('.vista_total').val(formatNumber.format(temp_total-monto_ant+total,"$"));
    ancestro.find('.restante').val(temp_total-monto_ant+total-total_verified);
    ancestro.find('.vista_restante').val(formatNumber.format(temp_total-monto_ant+total-total_verified,"$"));
}

$(".table_sesions").on('keyup',".cantidad",actualizarMonto);
function actualizarMonto(){
    var fila=$(this).parent().parent();
    var unitario= fila.find('.unitario').val();
    var cant= fila.find('.cantidad').val();
    var monto_ant= fila.find('.monto').val();
    var total= cant*unitario;
    fila.find('.monto').val(total);
    fila.find('.vista_monto').val(formatNumber.format(total,"$"));
    var ancestro=$ (this).parents();
    var total_ant=ancestro.find('.total_sesion').val();
    var temp_total=ancestro.find('.total').val();
    var total_verified= ancestro.find('.total_verified').val();
    ancestro.find('.total_sesion').val(total_ant-monto_ant+total);
    ancestro.find('.vista_total_sesion').val(formatNumber.format(total_ant-monto_ant+total,"$"));
    ancestro.find('.total').val(temp_total-monto_ant+total);
    ancestro.find('.vista_total').val(formatNumber.format(temp_total-monto_ant+total,"$"));
    ancestro.find('.restante').val(temp_total-monto_ant+total-total_verified);
    ancestro.find('.vista_restante').val(formatNumber.format(temp_total-monto_ant+total-total_verified,"$"));
}

$(".table_pays").on('keyup',".vista_monto",actualizarMonto3);
function actualizarMonto3(){
    var monto=$(this).val();
    var pagos= document.getElementsByName("monto_pago[]");
    var vista_pagos= document.getElementsByName("vista_monto_pago[]");
    var total=0;
    for(i=0;i<vista_pagos.length;i++){
        if(vista_pagos[i].value==""){                
            total+= 0;
            pagos[i].value= 0;
        }
        else{
            total+=parseInt(vista_pagos[i].value.replace(/\./g,""));
            pagos[i].value= vista_pagos[i].value.replace(/\./g,"");
        }
    }
    document.getElementById('total_verified').value= total;
    document.getElementById('vista_total_verified').value= formatNumber.format(total,"$");
    document.getElementById('restante').value= document.getElementById('total').value-total;
    document.getElementById('vista_restante').value= formatNumber.format(document.getElementById('total').value-total,"$");
}

$(document).on('change','.product',function(){
    var id=$(this).val();
    var div=$(this).parent().parent();
    $.ajax({
        type:'get',
        url:'{!!URL::to('getValorProduct')!!}',
        data:{'id':id},
        success:function(data){
           div.find('.unitario').val(data.precio);
           div.find('.vista_unitario').val(formatNumber.format(data.precio,"$"));
        },
        error:function(){
        }
    });
});

$(document).on('change','.under',function(){
    var id=$(this).val();
    var div=$(this).parent().parent();
    var op=" ";
    $.ajax({
        type:'get',
        url:'{!!URL::to('getValorUnder')!!}',
        data:{'id':id},
        success:function(data){
           div.find('.unitario').val(data.precio);
           div.find('.vista_unitario').val(formatNumber.format(data.precio,"$"));
        },
        error:function(){
        }
    });
});

$(document).on('change','.sesion',function(){
    var id=$(this).val();
    var div=$(this).parent().parent();
    $.ajax({
        type:'get',
        url:'{!!URL::to('getValorSession')!!}',
        data:{'id':id},
        success:function(data){
           div.find('.unitario').val(data.precio);
           div.find('.vista_unitario').val(formatNumber.format(data.precio,"$"));
        },
        error:function(){
        }
    });
});

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
                return this.formatear(res);
    }
}

function validar(form1) { 
    if(form1.total.value != form1.total_verified.value) { alert('El total de las formas de pago no concuerda con el total de la venta') ; return false ; } 
}

function confirmar() {
    var r = confirm("Se perderan los datos!");
    if (r == true) {
        document.getElementById("back").href = "/sell_products";
    }
}

</script>
@endsection
