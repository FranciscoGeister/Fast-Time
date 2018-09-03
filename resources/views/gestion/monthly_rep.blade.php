@extends('layouts.menu')

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
<table class="table table-bordered">
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
                <td></td>
                <td></td>
                <td class="totales"></td>
                <td></td>
                <td></td>
                <td class="totales"></td>
                <td></td>
                <td></td>
                <td class="totales"></td>
            </tr>
        @endfor
        <tr>
            <td colspan="3"></td>
            <td class="total_total"></td>
            <td colspan="2"></td>
            <td class="total_total"></td>
            <td colspan="2"></td>
            <td class="total_total"></td>
        </tr>
    </tbody>
</table>
</div>

<style type="text/css">
	table .totales {
        background-color:yellow;
    }

    table .total_total {
        background-color:red;
    }

</style>

@endsection
