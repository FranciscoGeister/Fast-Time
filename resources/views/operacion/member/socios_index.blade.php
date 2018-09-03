@extends('layouts.menu')

@section('styles')
<script src=" https://code.jquery.com/jquery-1.12.4.js "></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

@endsection


@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>Operación</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a>Ingresar Cliente</a></li>
        </ol>
    </nav>
    <br>
    <table class="table table-striped table-bordered" id="members">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Paterno</th>
            <th>Materno</th>
            <th>RUT</th>
            <th>Email</th>
            <th>Tipo</th>
            <th>Fecha nacimiento</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($members as $member)
        @if($member->estado==3)
        <tr>
            <td>{{ $member->nombre }}</td>
            <td>{{ $member->paterno }}</td>
            <td>{{ $member->materno }}</td>
            <td>{{ $member->rut }}</td>
            <td>{{ $member->email }}</td>
            <td>{{ $member->nombre_tipo }}</td>
            <td>{{date_format(new DateTime($member->nacimiento), 'd-m-Y') }}</td>
            <td>
                <form action="socios/{{$member->id}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button class="btn btn-danger" type="submit">Eliminar</button>
                </form>
            </td>
            <td>
                <form action="socios/{{ $member->id }}/edit" method="POST">
                    {{csrf_field()}}
                    {{method_field('GET')}}
                    <button class="btn btn-warning" type="submit">Editar</button>
                </form>
            </td>
            <td>
                <form action="planUsuario/create" method="POST">
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

@endsection


@section('scripts')
<script language="javascript">

    $(document).ready(function() {
        $('#members').DataTable( {
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
