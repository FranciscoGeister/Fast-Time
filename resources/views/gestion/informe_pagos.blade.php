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
          <li class="breadcrumb-item active" aria-current="page"><a>Informe de pagos</a></li>
        </ol>
    </nav>
    <br>
    <form class="form-inline" action="informe_pagos" method="POST">
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
  <h3 class="title">Informe de pagos sucursal de <span class="normal">{{ $sede->nombre }}</span> mes de <span class="normal">{{ $month }}</span></h3>
  <br>
    <table class="table table-bordered" id="profesionales">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Paterno</th>
                <th>Materno</th>
                <th>Horas contratadas(diarias)</th>
                <th>Horas Trabajadas</th>
                <th>Horas Extras</th>
                <th>Atenciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $cont = 0; ?>
            @foreach($contracted_professionals as $prof)
            <tr>
                <td>{{ $prof->first_name }}</td>
                <td>{{ $prof->last_name }}</td>
                <td>{{ $prof->mother_last_name }}</td>
                <td>{{ $prof->contracted_hours }}</td>
                <td>{{ number_format((float)$contracted_hours_a_month[$cont], 2, '.', '') }}</td>
                <td>{{ number_format((float)$overtime[$cont], 2, '.', '') }}</td>
                <td>{{ $prof->atenciones }}</td>
            </tr>
            <?php $cont++; ?>
            @endforeach
            <?php $cont = 0; ?>
            @foreach($honorary_professionals as $h_prof)
            <tr>
                <td>{{ $h_prof->first_name }}</td>
                <td>{{ $h_prof->last_name }}</td>
                <td>{{ $h_prof->mother_last_name }}</td>
                <td></td>
                <td>{{ number_format((float)$honorary_hours_a_month[$cont], 2, '.', '') }}</td>
                <td></td>
                <td>{{ $h_prof->atenciones }}</td>
            </tr>
            <?php $cont++; ?>
            @endforeach
        </tbody>
    </table>
</div>

@endsection


@section('scripts')
<script language="javascript">

$(document).ready(function() {
        $('#profesionales').dataTable( {
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