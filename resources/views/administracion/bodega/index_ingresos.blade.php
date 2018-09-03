@extends('layouts.menu')
<link href="{{ asset('css/table.css') }}" rel="stylesheet">
@section('content')

<table class="table table-bordered">
			<thead>
				<tr>
					<th>N° boleta/factura</th>
					<th>Sucursal</th>
					<th>Cant. ingresada</th>
					<th>Producto</th>
					<th>Tipo</th>
					<th>Usuario</th>
					<th>Fecha</th>
				</tr>
			</thead>
			<tbody>
				@foreach($entries as $entry)
					<tr>
						<td>{{ $entry->boleta }}</td>
						<td>{{ $entry->sucursal }}</td>
						<td>{{ $entry->cant_agregar }}</td>
						<td>{{ $entry->id_product }}</td>
						<td>{{ $entry->tipo }}</td>
						<td>{{ $entry->id_user }}</td>
						<td>{{ $entry->created_at }}</td>
      				</tr>
				@endforeach
			</tbody>
		</table>
@endsection