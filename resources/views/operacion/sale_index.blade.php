@extends('layouts.menu')
<link rel="STYLESHEET" type="text/css" href="{{ asset("css/titles.css") }}">

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src=" https://code.jquery.com/jquery-1.12.4.js "></script>
<script src=" https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js "></script>
<script src=" https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js "></script>

@endsection

@section('content')

<div class="container">
  <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a>Operación</a></li>
          <li class="breadcrumb-item active" aria-current="page"><a>Venta</a></li>
        </ol>
  </nav>
  <br>
  <div class="tab">
    <button class="tablinks active" onclick="openTab(event, 'Socios')">Socios</button>
    <button class="tablinks" onclick="openTab(event, 'Colaboradores')">Colaboradores</button>
  </div>
  <div id="Socios" class="tabcontent" style="display:block;">
    <table class="table table-bordered" id="members">
        <thead>
            <tr>
                <th>Nombre completo</th>
                <th>RUT</th>
                <th>Email</th>
                <th>Tipo</th>
                <th>Fecha nacimiento</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
            @if($member->estado==3)
            <tr>
                <td>{{ $member->nombre }} {{ $member->paterno }} {{ $member->materno }}</td>
                <td>{{ $member->rut }}</td>
                <td>{{ $member->email }}</td>
                <td>{{ $member->type }}</td>
                <td>{{date_format(new DateTime($member->nacimiento), 'd-m-Y') }}</td>               
                <td>
                    <form action="sell_products/create" method="POST">
                        {{csrf_field()}}
                        {{method_field('GET')}}
                        <input type="hidden" name="member_id" value="{{ $member->id }}">
                        <button class="btn btn-primary" type="submit">Vender</button>
                    </form>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    <form action="socios/create" method="POST">
        {{csrf_field()}}
        {{method_field('GET')}}
        <button class="btn btn-primary" type="submit">Socio nuevo</button>
    </form>
  </div>

  <div id="Colaboradores" class="tabcontent">
    <table class="table table-bordered" id="professionals">
        <thead>
            <tr>
                <th>Nombre completo</th>
                <th>RUT</th>
                <th>Email</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($profesionals as $prof)     
            <tr>
                <td>{{ $prof->first_name }} {{ $prof->last_name }} {{ $prof->mother_last_name }}</td>
                <td>{{ $prof->rut }}</td>
                <td>{{ $prof->email }}</td>             
                <td>
                    <form action="sell_products/interna" method="POST">
                        {{csrf_field()}}
                        {{method_field('GET')}}
                        <input type="hidden" name="prof_id" value="{{ $prof->id }}">
                        <button class="btn btn-primary" type="submit">Vender</button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</div>


@section('scripts')
<script language="javascript">
$(document).ready(function() {
        $('#members').dataTable( {
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

        $('#professionals').dataTable( {
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

<script language="javascript">
function openTab(evt, sucursal) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(sucursal).style.display = "block";
    evt.currentTarget.className += " active";
}
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

@endsection