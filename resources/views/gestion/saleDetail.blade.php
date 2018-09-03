@extends('layouts.menu')
<link rel="STYLESHEET" type="text/css" href="{{ asset("css/titles.css") }}">

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
          <li class="breadcrumb-item"><a>Gestión</a></li>
          <li class="breadcrumb-item"><a href="/logs">Log de Ventas</a></li>
          <li class="breadcrumb-item active" aria-current="page"><a>Detalle venta</a></li>
        </ol>
    </nav>
    <br>
    @if(sizeof($soldProducts)!=0)
    <table class="table table-bordered" id="socios">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Cantidad</th>
                <th>Monto</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($soldProducts as $sp)
            <tr>
                <td>{{ $sp->nombre }}</td>
                <td>{{ $sp->marca }}</td>
                <td>{{ $sp->cantidad }}</td>
                <td align="right">${{ number_format($sp->monto,0, "," , ".") }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @elseif($planDetail!=null)
    <table class="table table-bordered" id="plan">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $planDetail->nombre }}</td>
                <td align="right">${{ number_format($planDetail->monto,0, "," , ".") }}</td>
            </tr>
        </tbody>
    </table>
    @endif
</div>

@endsection


@section('scripts')
<script language="javascript">

$(document).ready(function() {
        $('#socios').dataTable( {
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

        $('#plan').dataTable( {
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


    } );

</script>
@endsection