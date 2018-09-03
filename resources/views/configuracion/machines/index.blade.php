@extends('layouts.menu')

@section('content')
<form>
	Buscar <input id="searchTerm" type="text" onkeyup="doSearch()" />
</form>

<table class="table table-bordered" id="maquinas">
	<thead>
		<tr>
			<th>Código</th>
			<th>Nombre</th>
			<th>Sucursal</th>
			<th>Marca</th>
			<th>Fecha compra</th>
			<th>Vendedor</th>
			<th colspan="2">Operaciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach($machines as $machine)
		@if($machine->estado=='1')
			<tr>
				<td>{{ $machine->codigo }}</td>
				<td>{{ $machine->nombre }}</td>
				<td>{{ $machine->nombre_sede }}</td>
				<td>{{ $machine->marca }}</td>
				<td>{{ $machine->fecha_compra }}</td>
				<td>{{ $machine->vendedor }}</td>
				<td>
		    		<form action="maquinas/{{ $machine->id }}/edit" method="POST">
		    			{{csrf_field()}}
		           		{{method_field('GET')}}
		           		<button class="btn btn-warning" type="submit">Editar</button>
		    		</form>
		    	</td>
		    	<td>
	     			<form action="maquinas/{{$machine->id}}" method="POST">
	                    {{csrf_field()}}
	                    {{method_field('DELETE')}}
	              		<button class="btn btn-danger" type="submit">Eliminar</button>
	      			</form>
	   			</td>						
			</tr>
		@endif
		@endforeach
	</tbody>
</table>
<form action="maquinas/create" method="POST">
	{{csrf_field()}}
	{{method_field('GET')}}
	<button class="btn btn-primary" type="submit">Agregar nueva máquina</button>
</form>



<script language="javascript">
	function doSearch()
	{
		var tableReg = document.getElementById('maquinas');
		var searchText = document.getElementById('searchTerm').value.toLowerCase();
		var cellsOfRow="";
		var found=false;
		var compareWith="";

		// Recorremos todas las filas con contenido de la tabla
		for (var i = 1; i < tableReg.rows.length; i++)
		{
			cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
			found = false;
			// Recorremos todas las celdas
			for (var j = 0; j < cellsOfRow.length && !found; j++)
			{
				compareWith = cellsOfRow[j].innerHTML.toLowerCase();
				// Buscamos el texto en el contenido de la celda
				if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1))
				{
					found = true;
				}
			}
			if(found)
			{
				tableReg.rows[i].style.display = '';
			} else {
				// si no ha encontrado ninguna coincidencia, esconde la
				// fila de la tabla
				tableReg.rows[i].style.display = 'none';
			}
		}
	}
</script>

@endsection

