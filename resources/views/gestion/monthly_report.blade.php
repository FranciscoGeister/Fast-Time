@extends('layouts.menu')

<link rel="STYLESHEET" type="text/css" href="{{ asset("css/titles.css") }}">

@section('content')
<br>

<div class="container">
<form class="form-inline" action="informe_mensual" method="POST">
	{{csrf_field()}}
    {{method_field('GET')}}
	<label>Sucursal: &nbsp;</label>
	<select class="form-control" name="sede">
        @foreach($sedes as $sede)
		<option value="{{ $sede->id }}">{{ $sede->nombre}}</option>
        @endforeach
	</select>
	<label>&nbsp; Mes: &nbsp;</label>
	<select class="form-control" name="month">
		<option value="1">Enero</option>
		<option value="2">Febrero</option>
		<option value="3">Marzo</option>
		<option value="4">Abril</option>
		<option value="5">Mayo</option>
		<option value="6">Junio</option>
		<option value="7">Julio</option>
		<option value="8">Agosto</option>
		<option value="9">Septiembre</option>
		<option value="10">Octubre</option>
		<option value="11">Noviembre</option>
		<option value="12">Diciembre</option>
	</select>
	<button class="btn btn-primary" type="submit">Aceptar</button>
</form>
<br>
<h3 class="title">Informe Mensual Sucursal: <span class="normal">{{ $sucursal->nombre }}</span></h3>
<h3 class="title">Mes de: <span class="normal">{{ $month }}</span></h3>
<br>
<button class="btn btn-primary" onclick="exportTableToExcel('tblData','{{ $sucursal->nombre }}-{{$month}}')">Exportar a Exel</button>
<br>
<table class="table table-bordered" id="tblData">
    <thead>
        <tr>
            <th colspan="7">Ventas con IVA</th>
            <th colspan="3">Ventas sin IVA</th>
        </tr>
        <tr>
            <th></th>
            <th colspan="2">Boletas con IVA</th>
            <th></th>
            <th colspan="2">Ventas Transbank</th>
            <th></th>
            <th colspan="2">Boletas Exentas</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Día</td>
            <td>Del N°</td>
            <td>Al N°</td>
            <td>Total</td>
            <td>Del N°</td>
            <td>Al N°</td>
            <td>Total</td>
            <td>Del N°</td>
            <td>Al N°</td>
            <td>Total</td>
        </tr>
        @for($i=1;$i<=31;$i++)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $boleta_desde_iva[$i-1] }}</td>
                <td>{{ $boleta_hasta_iva[$i-1] }}</td>
                <td class="totales" style="text-align:right">${{ number_format($totales_iva[$i-1],0, "," , ".")}}</td>
                <td>{{ $boleta_desde_transb[$i-1] }}</td>
                <td>{{ $boleta_hasta_transb[$i-1] }}</td>
                <td class="totales" style="text-align:right">${{ number_format($totales_transb[$i-1],0, "," , ".")}}</td>
                <td>{{ $boleta_desde_sin_iva[$i-1] }}</td>
                <td>{{ $boleta_hasta_sin_iva[$i-1] }}</td>
                <td class="totales" style="text-align:right">${{ number_format($totales_sin_iva[$i-1],0, "," , ".")}}</td>
            </tr>
        @endfor
        <tr>
            <td colspan="3"></td>
            <td class="total_total" style="text-align:right">${{ number_format($total_iva,0, "," , ".") }}</td>
            <td colspan="2"></td>
            <td class="total_total" style="text-align:right">${{ number_format($total_transb,0, "," , ".") }}</td>
            <td colspan="2"></td>
            <td class="total_total" style="text-align:right">${{ number_format($total_sin_iva,0, "," , ".") }}</td>
        </tr>
    </tbody>
</table>
</div>

<script type="text/javascript">
    function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
</script>

<style type="text/css">
	table .totales {
        background-color:yellow;
    }

    table .total_total {
        background-color:red;
    }

</style>

@endsection
