@extends('layouts.menu')

<link rel="STYLESHEET" type="text/css" href="{{ asset("css/titles.css") }}">

@section('content')

<div class="container">
	<nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a>Operación</a></li>
          <li class="breadcrumb-item"><a href="/deudas">Saldar Deuda</a></li>
          <li class="breadcrumb-item active" aria-current="page"><a>Historial</a></li>
        </ol>
    </nav>
	<br>
    <h3 class="title">Historial de deudas socio: <span class="normal">{{ $member->nombre }} {{ $member->paterno }}</span> </h3>
    <br>
	<table class="table table-bordered" id="deudas">
        <thead>
            <tr>
                <th>N° Boleta</th>
                <th>Monto</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($debtHistory as $dh)
            <tr>
                <td>{{ $dh->boleta }}</td>
                <td>${{ number_format($dh->amount,0, "," , ".")  }}</td>
                <td>{{ date_format(new DateTime($dh->created_at), 'd-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
