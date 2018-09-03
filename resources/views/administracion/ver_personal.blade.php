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
      <li class="breadcrumb-item"><a>Administración</a></li>
      <li class="breadcrumb-item active" aria-current="page">Personal</li>
    </ol>
  </nav>

  <table class="table table-striped table-bordered" id="professionals">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Paterno</th>
        <th>Materno</th>
        <th>Rut</th>
        <th>Correo</th>
        <th>Sede</th>
        <th>Fecha nacimiento</th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    @foreach ($profesionales as $prof)
    <tr>
      <td>{{$prof->first_name}}</td>
      <td>{{$prof->last_name}}</td>
      <td>{{$prof->mother_last_name}}</td>
      <td>{{$prof->rut}}</td>
      <td >{{$prof->email}}</td>
      <!-- Imprimir Sedes -->
      <td >
        @foreach($prof_sede as $object)
        @if($prof->id === $object->profesional_id)
          @foreach($sedes as $sede)
            @if($object->sede_id === $sede->id)
              {{$sede->nombre}}
            @endif
          @endforeach
        @endif
        @endforeach
      </td>
      <td>{{date_format(new DateTime($prof->nacimiento), 'd-m-Y')}}</td>
      <td>
        <form action="/posts/{{$prof->id}}" method="POST">
          {{csrf_field()}}
          {{method_field('DELETE')}}
            <button class="btn btn-danger" type="submit">
              Eliminar
            </button>
        </form>
      </td>
      <td>
        <a class="btn btn-primary" href="/edit_personal/{{$prof->id}}">Editar</a>
      </td>
      <td>
        <form action="/turnos/{{$prof->id}}" method="POST">
          {{csrf_field()}}
          {{method_field('GET')}}
          <button class="btn btn-danger" type="submit">Turnos</button>
        </form>
      </td>
    </tr>

    @endforeach
    </tbody>
  </table>
  <br>
  <div class="d-flex justify-content-around">
  <a class="btn btn-warning" href="{{url('/agregar')}}"> Agregar Nuevo</a>
  <a class="btn btn-primary" href="disponibilidad" >Disponibilidad</a>
  </div>
</div>

@endsection

@section('scripts')
<script language="javascript">

$(document).ready(function() {
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
@endsection