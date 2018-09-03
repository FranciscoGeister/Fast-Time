@extends('layouts.menu')

@section('content')

<h3>Productos</h3>
<table class="table table-bordered" id="soldProducts">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Monto</th>
        </tr>
    </thead>
    <tbody>
    @foreach($soldProducts as $soldProduct)
    <tr>
        <td>{{ $soldProduct->id }}</td>
        <td>{{ $soldProduct->cantidad }}</td>
        <td>{{ $soldProduct->monto }}</td>
    </tr>
    @endforeach
	</tbody>
</table>
<h3>Formas de pago</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Forma de pago</th>
            <th>Monto</th>
        </tr>
    </thead>
    <tbody>
    @foreach($payments as $payment)
    <tr>
        <td>{{ $payment->id }}</td>
        <td>{{ $payment->monto }}</td>
    </tr>
    @endforeach
    </tbody>
</table>

@endsection