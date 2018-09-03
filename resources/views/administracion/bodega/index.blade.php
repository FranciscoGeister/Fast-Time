@extends('layouts.menu')

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">


<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script src=" https://code.jquery.com/jquery-1.12.4.js "></script>
<script src=" https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js "></script>
<script src=" https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js "></script>
<script src=" https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js "></script>
<script src=" https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js "></script>
<script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js "></script>
<script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js "></script>
<script src=" https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js "></script>
<script src=" https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js "></script>

@endsection

@section('content')
<div class="container">
	<nav aria-label="breadcrumb">
	    <ol class="breadcrumb">
	      <li class="breadcrumb-item">Administración</li>
	      <li class="breadcrumb-item active" aria-current="page">Productos</li>
	    </ol>
	</nav>
	
	<br>
	<div class="tab">
		@foreach($sucursales as $sucursal)
		<button class="tablinks" onclick="openSucursal(event, '{{ $sucursal->nombre }}')">{{ $sucursal->nombre }}</button>
	  	@endforeach
	</div>

	@foreach($sucursales as $sucursal)
		<div id="{{ $sucursal->nombre }}" class="tabcontent">
			<div class="tab">
				<button class="subTablinks" onclick="openSubMenu(event, 'p_{{ $sucursal->nombre }}')">Productos</button>
				<button class="subTablinks" onclick="openSubMenu(event, 'u_{{ $sucursal->nombre }}')">Underwears</button>
				<button class="subTablinks" onclick="openSubMenu(event, 'c_{{ $sucursal->nombre }}')">Útiles de aseo</button>
			</div>
			<div id="p_{{ $sucursal->nombre }}" class="subTabcontent">
			 	<table class="table table-striped table-bordered" id="product_{{ $sucursal->id }}">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Marca</th>
							<th>Stock</th>
							<th>Stock Crítico</th>
							<th>Precio</th>
							<th>Fecha vencimiento</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($products as $product)
							@if($product->id_sucursal== $sucursal->id)
								@if($product->stock<=$product->stock_critico)
									<tr id="danger">
								@else
									<tr>
								@endif
										<td>{{ $product->nombre }}</td>
										<td>{{ $product->marca }}</td>
										<td>{{ $product->stock }}</td>
										<td>{{ $product->stock_critico }}</td>
										<td>${{ number_format($product->precio,0, "," , ".") }}</td>
										<td>{{ date_format(new DateTime($product->vencimiento), 'd-m-Y') }}</td>
										<td>
										<form action="productos/{{$product->id}}" method="POST">
				          					{{csrf_field()}}
				          					{{method_field('DELETE')}}
				            				<button class="btn btn-danger" type="submit">Eliminar</button>
								        </form>
								    	</td>
								    	<td>
								        	<form action="controlIngreso/create" method="POST">
									           	{{csrf_field()}}
									           	{{method_field('GET')}}
									           	<input type="hidden" name="id_sucursal" value="{{ $sucursal->id }}">
									           	<input type="hidden" name="id_product" value="{{ $product->id }}">
									           	<input type="hidden" name="tipo" value="producto">
										        <button class="btn btn-primary" type="submit">Agregar</button>	
									        </form>
								    	</td>
								    	<td>
								    		<form action="productos/{{ $product->id }}/edit" method="POST">
								    			{{csrf_field()}}
								           		{{method_field('GET')}}
								           		<button class="btn btn-warning" type="submit">Editar</button>
								    		</form>
								    	</td>
								    	<td>
								        <form action="controlTransfer/create" method="POST">
								           	{{csrf_field()}}
								           	{{method_field('GET')}}
								           	<input type="hidden" name="id_origen" value="{{ $sucursal->id }}">
								           	<input type="hidden" name="nom_sucursal" value="{{ $sucursal->nombre }}">
								           	<input type="hidden" name="id_product_origen" value="{{ $product->id }}">
								           	<input type="hidden" name="tipo" value="producto">
									        <button class="btn btn-info" type="submit">Trasladar</button>	
								        </form>
								    	</td>
				      				</tr>
							@endif
						@endforeach
					</tbody>
				</table>
				<form action="productos/create" method="POST">
		        	{{csrf_field()}}
		        	{{method_field('GET')}}
		        	<input type="hidden" name="sucursal" value="{{ $sucursal->nombre }}">
		        	<input type="hidden" name="id_sucursal" value="{{ $sucursal->id }}">
		        	<button class="btn btn-primary" type="submit">Agregar nuevo producto</button>
				</form>
			</div>
			<div id="u_{{ $sucursal->nombre }}" class="subTabcontent">				
				<table class="table table-striped table-bordered" id="under_{{ $sucursal->id }}">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Marca</th>
							<th>Talla</th>
							<th>Stock</th>
							<th>Stock Crítico</th>
							<th>Precio de venta</th>
							<th>Precio de arriendo</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($underwears as $underwear)
							@if($underwear->id_sucursal== $sucursal->id)
								@if($underwear->stock<=$underwear->stock_critico)
									<tr id="danger">
								@else
									<tr>
								@endif
									<td>{{ $underwear->nombre }}</td>
									<td>{{ $underwear->marca }}</td>
									<td>{{ $underwear->talla }}</td>
									<td>{{ $underwear->stock }}</td>
									<td>{{ $underwear->stock_critico }}</td>
									<td>${{ number_format($underwear->precio,0, "," , ".") }}</td>
									<td>${{ number_format($underwear->precio_arriendo,0, "," , ".") }}</td>
									<td>
									<form action="productos/{{$underwear->id}}" method="POST">
			          					{{csrf_field()}}
			          					{{method_field('DELETE')}}
			            				<button class="btn btn-danger" type="submit">Eliminar</button>
							        </form>
							    	</td>
							    	<td>
							        <form action="controlIngreso/create" method="POST">
							           	{{csrf_field()}}
							           	{{method_field('GET')}}
							           	<input type="hidden" name="id_sucursal" value="{{ $sucursal->id }}">
							           	<input type="hidden" name="id_product" value="{{ $underwear->id }}">
							           	<input type="hidden" name="tipo" value="underwear">
								        <button class="btn btn-primary" type="submit">Agregar</button>	
							        </form>
							    	</td>
							    	<td>
							    		<form action="underwears/{{ $underwear->id }}/edit" method="POST">
							    			{{csrf_field()}}
							           		{{method_field('GET')}}
							           		<button class="btn btn-warning" type="submit">Editar</button>
							    		</form>
							    	</td>
							    	<td>
							        <form action="controlTransfer/create" method="POST">
							           	{{csrf_field()}}
							           	{{method_field('GET')}}
						           		<input type="hidden" name="id_origen" value="{{ $sucursal->id }}">
							           	<input type="hidden" name="nom_sucursal" value="{{ $sucursal->nombre }}">
							           	<input type="hidden" name="id_product_origen" value="{{ $underwear->id }}">
							           	<input type="hidden" name="tipo" value="underwear">
								        <button class="btn btn-info" type="submit">Trasladar</button>	
							        </form>
							    	</td>
			      				</tr>
							@endif
						@endforeach
					</tbody>
				</table>
				<form action="underwears/create" method="POST">
		       		{{csrf_field()}}
		        	{{method_field('GET')}}
		        	<input type="hidden" name="sucursal" value="{{ $sucursal->nombre }}">
		        	<input type="hidden" name="id_sucursal" value="{{ $sucursal->id }}">
		    	    <button class="btn btn-primary" type="submit">Agregar nuevo underwear</button>
				</form>
			</div>
			<div id="c_{{ $sucursal->nombre }}" class="subTabcontent">
			 	<table class="table table-striped table-bordered" id="clean_{{ $sucursal->id }}">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Marca</th>
							<th>Stock</th>
							<th>Stock crítico</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($cleanings as $cleaning)
							@if($cleaning->id_sucursal== $sucursal->id)
								@if($cleaning->stock<=$cleaning->stock_critico)
									<tr id="danger">
								@else
									<tr>
								@endif
									<td>{{ $cleaning->nombre }}</td>
									<td>{{ $cleaning->marca }}</td>
									<td>{{ $cleaning->stock }}</td>
									<td>{{ $cleaning->stock_critico }}</td>
									<td>
									<form action="aseo/{{$cleaning->id}}" method="POST">
			          					{{csrf_field()}}
			          					{{method_field('DELETE')}}
			            				<button class="btn btn-danger" type="submit">Eliminar</button>
							        </form>
							    	</td>
							    	<td>
							        <form action="controlIngreso/create" method="POST">
							           	{{csrf_field()}}
							           	{{method_field('GET')}}
							           	<input type="hidden" name="id_product" value="{{ $cleaning->id }}">
							           	<input type="hidden" name="id_sucursal" value="{{ $sucursal->id }}">
							           	<input type="hidden" name="tipo" value="aseo">
								        <button class="btn btn-primary" type="submit">Agregar</button>	
							        </form>
							    	</td>
							    	<td>
							    		<form action="aseo/{{ $cleaning->id }}/edit" method="POST">
							    			{{csrf_field()}}
							           		{{method_field('GET')}}
							           		<button class="btn btn-warning" type="submit">Editar</button>
							    		</form>
							    	</td>
							    	<td>
							        <form action="controlTransfer/create" method="POST">
							           	{{csrf_field()}}
							           	{{method_field('GET')}}
						           		<input type="hidden" name="id_origen" value="{{ $sucursal->id }}">
							           	<input type="hidden" name="nom_sucursal" value="{{ $sucursal->nombre }}">
							           	<input type="hidden" name="id_product_origen" value="{{ $cleaning->id }}">
							           	<input type="hidden" name="tipo" value="aseo">
								        <button class="btn btn-info" type="submit">Trasladar</button>	
							        </form>
							    	</td>
			      				</tr>
							@endif
						@endforeach
					</tbody>
				</table>
				<form action="aseo/create" method="POST">
		        	{{csrf_field()}}
		        	{{method_field('GET')}}
		        	<input type="hidden" name="sucursal" value="{{ $sucursal->nombre }}">
		        	<input type="hidden" name="id_sucursal" value="{{ $sucursal->id }}">
		        	<button class="btn btn-primary" type="submit">Agregar nuevo útil</button>
				</form>
			</div>
		</div>
	@endforeach
</div>



<script>
function openSucursal(evt, sucursal) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    var j, subTabcontent, subTablinks;
    
    subTabcontent = document.getElementsByClassName("subTabcontent");
    for (j = 0; j < subTabcontent.length; j++) {
        subTabcontent[j].style.display = "none";
    }
    subTablinks = document.getElementsByClassName("subTablinks");
    for (j = 0; j < subTablinks.length; j++) {
        subTablinks[j].className = subTablinks[j].className.replace(" active", "");
    }
    document.getElementById(sucursal).style.display = "block";
    evt.currentTarget.className += " active";
}
</script> 

<script>
function openSubMenu(evt, tipo) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("subTabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("subTablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tipo).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>

@section('scripts')
<script language="javascript">

$(document).ready(function() {
	var sucursales = <?php echo $sucursales;?>;
	var tablaProduct = "#product_";
	var tablaUnder = "#under_";
	var tablaClean = "#clean_";
	for (var i = 0; i < sucursales.length; i++) {
		$(tablaProduct.concat(sucursales[i].id)).dataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            "language": {
              buttons:{
                copy: "Copiar",
                print: "Imprimir"
              },
              "sProcessing":     "Procesando...",
              "sLengthMenu":     "Mostrar _MENU_ registros",
              "sZeroRecords":    "No se encontraron resultados",
              "sEmptyTable":     "Ningún dato disponible en esta tabla",
              "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
              "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
              "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
              "sInfoPostFix":    "",
              "sSearch":         "Buscar:",
              "sUrl":            "",
              "sInfoThousands":  ",",
              "sLoadingRecords": "Cargando...",
              "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
              },
              "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
              }
            }
    	} );

    	$(tablaUnder.concat(sucursales[i].id)).dataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            "language": {
              buttons:{
                copy: "Copiar",
                print: "Imprimir"
              },
              "sProcessing":     "Procesando...",
              "sLengthMenu":     "Mostrar _MENU_ registros",
              "sZeroRecords":    "No se encontraron resultados",
              "sEmptyTable":     "Ningún dato disponible en esta tabla",
              "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
              "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
              "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
              "sInfoPostFix":    "",
              "sSearch":         "Buscar:",
              "sUrl":            "",
              "sInfoThousands":  ",",
              "sLoadingRecords": "Cargando...",
              "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
              },
              "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
              }
            }
    	} );

    	$(tablaClean.concat(sucursales[i].id)).dataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            "language": {
              buttons:{
                copy: "Copiar",
                print: "Imprimir"
              },
              "sProcessing":     "Procesando...",
              "sLengthMenu":     "Mostrar _MENU_ registros",
              "sZeroRecords":    "No se encontraron resultados",
              "sEmptyTable":     "Ningún dato disponible en esta tabla",
              "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
              "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
              "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
              "sInfoPostFix":    "",
              "sSearch":         "Buscar:",
              "sUrl":            "",
              "sInfoThousands":  ",",
              "sLoadingRecords": "Cargando...",
              "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
              },
              "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
              }
            }
    	} );
	}
} );

</script>
@endsection


<style>
body {font-family: "Lato", sans-serif;}

/* Style the tab */
div.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
div.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
div.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
div.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
</style>

<style>
	#danger {background-color:rgba(255,0,0,0.3);}
</style>


@endsection