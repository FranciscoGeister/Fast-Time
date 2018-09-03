@extends('layouts.menu')
<link rel="STYLESHEET" type="text/css" href="{{ asset("css/titles.css") }}">

@section('content')

<div class="container">
<form method="POST" action="/planUsuario" onsubmit="return validar(this);">
    {{csrf_field()}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a>Operación</a></li>
          <li class="breadcrumb-item"><a href="#" id="back" onclick="confirmar()">Ingresar Cliente</a></li>
          <li class="breadcrumb-item active" aria-current="page"><a>Venta Plan/Prog.</a></li>
        </ol>
    </nav>
    <br>
    <h3 class="title">Venta de Plan/Programa a socio: <span class="normal">{{ $member->nombre }} {{ $member->paterno }}</span> </h3><br>
    <div class="row">
    <div class="form-group col-sm-6">
    <label class="control-label col-sm-2">Plan o programa</label>
    <select class="plan_or_prog col-sm-3 form-control" name="plan_or_prog">
        <option value="0" selected disabled>Elija</option>
        <option value="1">Plan</option>
        <option value="2">Programa</option>
    </select>
    <label class="control-label col-sm-1">Plan</label>
    <select class="plan_id col-sm-3 form-control" name="plan_id">
    </select>
    </div>
    <div class="info_plan form-group col-sm-6">
    <span>Sesiones</span>
    <input type="text" class="sesiones form-control col-sm-3" style="text-align:right" readonly>
    <span>Nutricionista</span>
    <input type="text" class="sesi_nutri form-control col-sm-3" name="sesi_nutri" style="text-align:right" readonly>
    <span>Valor</span>
    <input type="text" class="valor form-control col-sm-3" id="valor" style="text-align:right" readonly>
    <span>Descuento</span>
    <input type="text" class="form-control col-sm-3" id="descuento" style="text-align:right">
    </div>
    </div>
    <span>Contrato asociado</span>
    <input type="number" class="contrato form-control col-sm-2" id="contrato" name="contrato" style="text-align:right" required><br/>
    <div class="form-inline">
        <label class="control-label col-sm-2"><b>Agregar Sesiones</b></label>
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
    <br>
    <label class="control-label title"><h4>Resumen: </h4></label>
    <div class="form-inline">
        <label class="control-label col-sm-3">Valor Plan/Programa</label>
        <input type="hidden" name="total_plan" class="total_plan" id="total_plan" value="0">
        <input type="text" name="vista_total_plan" class="vista_total_plan form-control col-sm-2" id="vista_total_plan" value="$0" style="text-align:right" readonly>
    </div>
    <div class="form-inline">
        <label class="control-label col-sm-3">Valor sesiones</label>
        <input type="hidden" name="total_sesion" class="total_sesion" id="total_sesion" value="0">
        <input type="text" name="vista_total_sesion" class="vista_total_sesion form-control col-sm-2" value="$0" style="text-align:right" readonly>
    </div>
    <div class="form-inline">
        <label class="control-label col-sm-3">Total</label>
        <input type="hidden" name="total" class="total" id="total" value="0">
        <input type="text" name="vista_total" class="vista_total form-control col-sm-2" id="vista_total" value="$0" style="text-align:right" readonly>
    </div><br>
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
    <br>
    <div class="row form-inline">
        <label class="control-label col-sm-2">Por pagar: </label>
        <input type="hidden" class="restante" id="restante">
        <input type="text" class="vista_restante form-control" id="vista_restante" style="text-align:right" readonly>
        <label class="control-label col-sm-2">Total: </label>
        <input type="hidden" class="total_verified" id="total_verified">
        <input type="text" class="vista_total_verified form-control" id="vista_total_verified" style="text-align:right" readonly>
    </div>
    <br>
    <div class="row form-inline">
        <label class="control-label col-sm-2" required>N° boleta exenta:</label>
        <input type="number" class="boleta form-control col-sm-2" name="boleta" style="text-align:right">
        <label class="control-label col-sm-2">Fecha:</label>
        <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}">
    </div>
    <input type="hidden" name="member_id" value="{{ $member->id }}">
    <button class="btn btn-primary" type="submit">Finalizar</button>
</form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){

        $(document).on('change','.plan_or_prog',function(){
            var id=$(this).val();
            var div=$(this).parents();
            var op=" ";
            if(id=="1"){
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('getPlans')!!}',
                    data:{'id':id},
                    success:function(data){
                        op+='<option value="0" selected disabled>Elija</option>';
                        for(var i=0;i<data.length;i++){
                        op+='<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
                       }
                       div.find('.plan_id').html(" ");
                       div.find('.plan_id').append(op);
                       div.find('.sesiones').val("");
                       div.find('.valor').val("");
                       div.find('.sesi_nutri').val("");
                    },
                    error:function(){
                    }
                });
            }
            else{
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('getPrograms')!!}',
                    data:{'id':id},
                    success:function(data){
                        op+='<option value="0" selected disabled>Elija</option>';
                        for(var i=0;i<data.length;i++){
                        op+='<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
                       }
                       div.find('.plan_id').html(" ");
                       div.find('.plan_id').append(op);
                       div.find('.sesiones').val("");
                       div.find('.valor').val("");
                       div.find('.sesi_nutri').val("");
                    },
                    error:function(){
                    }
                });
            }
        });

        $(document).on('change','.plan_id',function () {
            var plan_id=$(this).val();
            var a=$(this).parents();
            var plan_or_prog=$('.plan_or_prog').val();

            $.ajax({
                type:'get',
                url:'{!!URL::to('getValor')!!}',
                data:{'id':plan_id,'plan_or_prog':plan_or_prog},
                dataType:'json',//return data will be json
                success:function(data){
                    a.find('.sesiones').val(data.sesiones);
                    a.find('.valor').val(formatNumber.format(data.valor,"$"));
                    var temp_plan=a.find('.total_plan').val();
                    var temp_total= a.find('.total').val();
                    a.find('.total_plan').val(data.valor);
                    a.find('.vista_total_plan').val(formatNumber.format(data.valor,"$"));
                    a.find('.total').val(temp_total-temp_plan+data.valor);
                    a.find('.vista_total').val(formatNumber.format(temp_total-temp_plan+data.valor,"$"));
                    a.find('.restante').val(temp_total-temp_plan+data.valor);
                    a.find('.vista_restante').val(formatNumber.format(temp_total-temp_plan+data.valor,"$"));
                    if(data.sesi_nutri!=undefined){
                        a.find('.sesi_nutri').val(data.sesi_nutri);   
                    }
                    else{
                        a.find('.sesi_nutri').val("0");
                    }
                    
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

        $("#agregar").click(function(){
            var nuevaFila="<tr>";
            nuevaFila+='<td><select class="sesion form-control col-sm-12" name="sesion[]">'+
                                '<option value="0" selected disabled>Tipo de sesion</option>'+
                                '@foreach($sesions as $sesion)'+
                                '<option value="{{ $sesion->id }}">{{ $sesion->nombre }}</option>'+
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
        });
    

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

        $("#descuento").keyup(function(){
            var desct=$(this).val().replace(/\./g,"");
            var total= parseInt(document.getElementById('valor').value.replace(/\.|\$/g,"")-desct);
            $(this).val(formatNumber.format(desct));
            document.getElementById('total_plan').value= total;
            document.getElementById('vista_total_plan').value= formatNumber.format(total,"$");
            document.getElementById('total').value= parseInt(document.getElementById('total_sesion').value)+total;
            document.getElementById('vista_total').value= formatNumber.format(document.getElementById('total').value,"$");
            document.getElementById('restante').value= document.getElementById('total').value-document.getElementById('total_verified').value;
            document.getElementById('vista_restante').value= formatNumber.format(document.getElementById('restante').value,"$");
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
                document.getElementById("back").href = "/socios";
            }
        }

        /*
        $(".vista_monto").on({
            "focus": function (event) {
                $(event.target).select();
            },
            "keyup": function (event) {
                $(event.target).val(function (index, value ) {
                    return value.replace(/\D/g, "")
                                .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                                .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                });
            }
        });*/

        /*function format(input){
            var num = input.value.replace(/\./g,'');
            if(!isNaN(num)){
                num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
                num = num.split('').reverse().join('').replace(/^[\.]/,'');
                input.value = num;
            }
            else{
                alert('Solo se permiten numeros');*/
                //input.value = input.value.replace(/[^\d\.]*/g,'');
        /*    }
        }*/


        /*
        var separador = document.getElementById('table_pays');
        separador.addEventListener('keyup', (e) => {
            var entrada = e.find('.vista_monto').value.split('.').join('');
            entrada = entrada.split('').reverse();
            
            var salida = [];
            var aux = '';
            
            var paginador = Math.ceil(entrada.length / 3);
            
            for(let i = 0; i < paginador; i++) {
                for(let j = 0; j < 3; j++) {
                    "123 4"
                    if(entrada[j + (i*3)] != undefined) {
                        aux += entrada[j + (i*3)];
                    }
                }
                salida.push(aux);
                aux = '';
               
                e.target.value = salida.join('.').split("").reverse().join('');
            }
        }, false);*/
    
</script>

@endsection