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
      <li class="breadcrumb-item"><a>Gestión</a></li>
      <li class="breadcrumb-item active" aria-current="page"><a>Log de Ventas</a></li>
    </ol>
</nav>
<br>
<div class="tab">
    <button class="tablinks active" onclick="openTab(event, 'Socios')">Socios</button>
    <button class="tablinks" onclick="openTab(event, 'Colaboradores')">Colaboradores</button>
</div>
  <div id="Socios" class="tabcontent" style="display:block;">
  <table class="table table-striped table-bordered" id="members">
      <thead>
          <tr>
              <th>Email</th>
              <th>Sede</th>
              <th>Monto</th>
              <th>N° Boleta</th>
              <th>IVA</th>
              <th>Fecha</th>
              <th>Asistente</th>
              <th></th>
              <th></th>
          </tr>
      </thead>
      <tbody>
          @foreach($memberSales as $ms)
          <tr>
              <td>{{ $ms->member_email }}</td>
              <td>{{ $ms->sede_name }}</td>
              <td align="right">${{ number_format($ms->monto,0, "," , ".") }}</td>
              <td>{{ $ms->boleta }}</td>
              @if($ms->iva==1)
                <td>Si</td>
              @else
                <td>No</td>
              @endif
              <td>{{ date_format(new DateTime($ms->date), 'd-m-Y') }}</td>
              <td>{{ $ms->user_email }}</td>
              <td>
                  <form action="sale_detail/{{ $ms->id }}" method="POST">
                      {{csrf_field()}}
                      {{method_field('GET')}}
                      <button class="btn btn-info" type="submit">Detalle</button>
                  </form>
              </td>
              <td>
                  <form action="cancel_sale/{{ $ms->id }}" method="POST">
                      {{csrf_field()}}
                      {{method_field('GET')}}
                      <button class="btn btn-warning" type="submit">Anular</button>
                  </form>
              </td>
          </tr>
          @endforeach
      </tbody>
  </table>
  <br>
  <h3>Ventas Anuladas</h3>

  <table class="table table-striped table-bordered" id="canceled_sales">
      <thead>
          <tr>
              <th>Email</th>
              <th>Sede</th>
              <th>Monto</th>
              <th>N° Boleta</th>
              <th>IVA</th>
              <th>Fecha</th>
              <th>Asistente</th>
              <th>Anulada por</th>
          </tr>
      </thead>
      <tbody>
          @foreach($canceledSales as $cs)
          <tr>
              <td>{{ $cs->member_email }}</td>
              <td>{{ $cs->sede_name }}</td>
              <td align="right">${{ number_format($cs->monto,0, "," , ".") }}</td>
              <td>{{ $cs->boleta }}</td>
              @if($cs->iva==1)
                <td>Si</td>
              @else
                <td>No</td>
              @endif
              <td>{{ date_format(new DateTime($cs->date), 'd-m-Y') }}</td>
              <td>{{ $cs->user_email }}</td>
              <td>{{ $cs->user2_email }}</td>
          </tr>
          @endforeach
      </tbody>
  </table>
</div>
<div id="Colaboradores" class="tabcontent">
    <table class="table table-striped table-bordered" id="professionals">
        <thead>
            <tr>
                <th>Email</th>
                <th>Monto</th>
                <th>Fecha</th>
                <th>Asistente</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($professionalSales as $prof)     
            <tr>
                <td>{{ $prof->professional_email }}</td>
                <td align="right">${{ number_format($prof->amount,0, "," , ".") }}</td>
                <td>{{ $prof->date }}</td>
                <td>{{ $prof->user_email }}</td>
              <td>
                  <form action="historial_deudas_profesional/{{ $prof->id }}" method="POST">
                      {{csrf_field()}}
                      {{method_field('GET')}}
                      <button class="btn btn-info" type="submit">Detalle</button>
                  </form>
              </td>
              <td>
                  <form action="historial_deudas/{{ $ms->id }}" method="POST">
                      {{csrf_field()}}
                      {{method_field('GET')}}
                      <button class="btn btn-warning" type="submit">Anular</button>
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

        $('#canceled_sales').dataTable( {
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