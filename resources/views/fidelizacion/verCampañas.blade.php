@extends('layouts.menu')
<link href="{{ asset('css/table.css') }}" rel="stylesheet">
<link rel="STYLESHEET" type="text/css" href="{{ asset("css/titles.css") }}">

@section('content')
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
{!! Html::script('vendor/autocomplete/jquery.easy-autocomplete.min.js') !!}
<!-- CSS file -->
{!! Html::style('vendor/autocomplete/easy-autocomplete.css') !!}

<div class="container">
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a>Fidelización</a></li>
      <li class="breadcrumb-item active" aria-current="page"><a>Campañas</a></li>
    </ol>
</nav>
<br>
<form>
  <span class="search"><b>Buscar</b></span>  <input id="searchTerm" type="text" class="form-control col-sm-5" onchange="doSearch()" onkeyup="doSearch()" />
</form>
<br>

<div id="Campañas" class="tabcontent">
    <table class="table table-bordered" id="campañas">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Mensaje</th>
                <th>Imagen</th>
                <th colspan="2">Operaciones</th>
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
</div>


<script language="javascript">
  function doSearch()
  {
    var tableReg = document.getElementById('campañas');
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
  };

/*
  var options = {
    url: "display-search-queries",

    getValue: function(element) {
              return element.nombre;
            },
    list: {
    match: {
            enabled: true
        }
    }
  };*/
//-------------------------------------------//
//$("#searchTerm").easyAutocomplete(options);
</script>
@endsection
