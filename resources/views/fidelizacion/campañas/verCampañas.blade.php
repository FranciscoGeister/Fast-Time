@extends('layouts.menu')

@section('styles')
<script src=" https://code.jquery.com/jquery-1.12.4.js "></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
@endsection

@section('content')
<div class="container">
    <table class="table table-bordered" id="campañas">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Mensaje</th>
                <th>Imagen</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($campañas as $campaña)
            <tr>
                <td>{{ $campaña->nombre }}</td>
                <td>{{ $campaña->descripcion }}</td>
                <td>{{ $campaña->mensaje }}</td>
                <td><img src="{{ Storage::url($campaña->imagen) }}"  width="150px"></td>
                <td>
                    <form action="campañas/{{$campaña->id}}" method="POST">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn btn-danger" type="submit">Eliminar</button>
                    </form>
                </td>
                <td>
                    <form action="campañas/{{$campaña->id}}/editar" method="POST">
                        {{csrf_field()}}
                        {{method_field('GET')}}
                        <button class="btn btn-warning" type="submit">Editar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <form action="/campañas/create" method="POST">
        {{csrf_field()}}
        {{method_field('GET')}}
        <button class="btn btn-primary" type="submit">Nueva Campaña</button>
    </form>
  </br>
  <button onclick="location.href='{{ url('notification') }}'">
     Check Stock</button>
</div>
@endsection

@section('scripts')
<script language="javascript">

    $(document).ready(function() {
        $('#campañas').DataTable( {
            language: {
                processing:     "Procesando...",
                search:         "Buscar:",
                lengthMenu:    "Mostrar _MENU_ registros",
                info:           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                infoEmpty:      "Mostrando registros del 0 al 0 de un total de 0 registros",
                infoFiltered:   "(filtrado de un total de _MAX_ registros)",
                infoPostFix:    "",
                loadingRecords: "Cargando...",
                zeroRecords:    "No se encontraron resultados",
                emptyTable:     "Ningún dato disponible en esta tabla",
                paginate: {
                    first:      "Primero",
                    previous:   "Último",
                    next:       "Siguiente",
                    last:       "Anterior"
                },
                aria: {
                    sortAscending:  ": Activar para ordenar la columna de manera ascendente",
                    sortDescending: ": Activar para ordenar la columna de manera descendente"
                }
            } 
        } );
    } );

</script>
@endsection
