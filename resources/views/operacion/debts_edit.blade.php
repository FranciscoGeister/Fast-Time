@extends('layouts.menu')

<link rel="STYLESHEET" type="text/css" href="{{ asset("css/titles.css") }}">

@section('content')

<div class="container">
	<form method="POST" action="/deudas/{{ $debt->id }}" onsubmit="return validar(this);">
	    {{csrf_field()}}
	    {{method_field('PUT')}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a>Operación</a></li>
              <li class="breadcrumb-item"><a href="/deudas">Saldar Deuda</a></li>
              <li class="breadcrumb-item active" aria-current="page"><a>Pagar</a></li>
            </ol>
        </nav>

        <br>
		<h3 class="title">Pago de deuda socio: <span class="normal">{{ $member->nombre }} {{ $member->paterno }}</span></h3>
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
	    </table><br>
	    <div class="row form-inline">
	        <label class="control-label col-sm-2">Por pagar: </label>
	        <input type="hidden" class="total" id="total" value="{{ $debt->amount }}">
	        <input type="hidden" class="restante" id="restante" value="{{ $debt->amount }}">
	        <input type="text" class="vista_restante form-control col-sm-2" id="vista_restante" value="${{ number_format($debt->amount,0, "," , ".")  }}" style="text-align:right" readonly>
	        <label class="control-label col-sm-2">Total: </label>
	        <input type="hidden" class="total_verified" id="total_verified" name="total_verified" value="0">
	        <input type="text" class="vista_total_verified form-control col-sm-2" id="vista_total_verified" value="$0" style="text-align:right" readonly>
	    </div><br>
	    <div class="row form-inline">
	        <label class="control-label col-sm-2">N° boleta exenta:</label>
	        <input type="number" class="boleta form-control col-sm-2" name="boleta" style="text-align:right">
	        <label class="control-label col-sm-2">Fecha:</label>
	        <input type="date" name="date" class="form-control col-sm-2" value="{{ date('Y-m-d') }}">
	    </div>
        <br>
	    <button class="btn btn-primary" type="submit">Finalizar</button>
	</form>
</div>

<script type="text/javascript">
$("#agregar_pago").click(function(){
    var nuevaFila="<tr>";
    nuevaFila+='<td><select class="pago form-control" name="pago[]">'+
                        '<option value="0" selected disabled>Elija</option>'+
                        '@foreach($payments as $payment)'+
                        '@if($payment->id!=7)'+
                        '<option value="{{ $payment->id }}">{{ $payment->nombre }}</option>'+
                        '@endif'+
                        '@endforeach'+
                    '</select></td>';
    nuevaFila+='<td><input type="hidden" class="monto_pago" name="monto_pago[]">';
    nuevaFila+='<input type="text" class="vista_monto form-control" name="vista_monto_pago[]" style="text-align:right" onkeyup="this.value= formatNumber.format_esp(this.value)"></td>';
    nuevaFila+='<td><button class="btn btn-danger" type="button">Borrar</button></td>';
    nuevaFila+="</tr>";
    $(".table_pays").append(nuevaFila);
});

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

function validar(form1) { 
    if(parseInt(form1.total.value) < parseInt(form1.total_verified.value)) { alert('El total de las formas de pago es mayor a la deuda') ; return false ; } 
}

//funcion para separador de miles
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

</script>

@endsection
