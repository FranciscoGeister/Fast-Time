@extends('layouts.menu')
<link rel="STYLESHEET" type="text/css" href="{{ asset("css/titles.css") }}">

@section('content')
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
{!! Html::script('vendor/autocomplete/jquery.easy-autocomplete.min.js') !!}
<!-- CSS file -->
{!! Html::style('vendor/autocomplete/easy-autocomplete.css') !!}

@if(Session::has('msg'))
  <div class="alert alert-success">
      {{Session::get('msg')}}
  </div>

@endif
<div class="container">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a>Fidelización</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a>Notificaciones</a></li>
  </ol>
</nav>
<br>
<h2 class="title"> Notificaciones </h2>
<form>
  <span class="search"><b>Buscar</b></span> <input id="text_noti" type="text" onchange="doSearch('notificaciones','text_noti')" onkeyup="doSearch('notificaciones','text_noti')" />
</form>

<div id="Notificaciones" class="tabcontent">
    <table class="table table-bordered" id="notificaciones">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Mensaje</th>
                <th>Programada</th>
                <th>URL</th>
                <th colspan="3">Operaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notifications as $notification)
            <tr>
                <td>{{ $notification->name }}</td>
                <td>{{ $notification->message }}</td>
                <td>{{ $notification->schedule }}</td>
                <td>{{ $notification->url }}</td>
                <td>
                    <form action="notifications/{{$notification->id}}" method="POST">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn btn-danger" type="submit">Eliminar</button>
                    </form>
                </td>
                <td>
                    <form action="notifications/{{$notification->id}}/edit" method="POST">
                        {{csrf_field()}}
                        {{method_field('GET')}}
                        <button class="btn btn-warning" type="submit">Editar</button>
                    </form>
                </td>
                <td>
                    <form action="sendNotification/{{$notification->id}}" method="POST">
                        {{csrf_field()}}
                        {{method_field('GET')}}
                        <button class="btn btn-primary" type="submit">Enviar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <form action="/notifications/create" method="POST">
        {{csrf_field()}}
        {{method_field('GET')}}
        <button class="btn btn-primary" type="submit">Nueva plantilla de notificacion</button>
    </form>
  </br>
</div>

  <h2 class="title"> Notificación Rápida </h2>
  <form action="/sendQuickNotification" method="POST">
      {{csrf_field()}}
      {{method_field('GET')}}
      <table class="table">
        <thead>
            <tr>
                <th>Mensaje</th>
                <th>Programar</th>
                <th>URL</th>
            </tr>
        </thead>
        <tbody>
          <tr>
            <td><textarea class="form-control" name="message"></textarea></td>
            <td>
              <input class="form-control" type="date" name="date">
              <input class="form-control" type="time" name="time">
            </td>
            <td><input class="form-control" type="text" name="url"></td>
          </tr>
        </tbody>
      </table>
    </br>


      <span class="search"><b>Buscar</b></span> <input id="text_socios" type="text" onchange="doSearch('socios','text_socios')" onkeyup="doSearch('socios','text_socios')" />
      <br>
      <br>
      <table class="table table-bordered" id="socios">
          <thead>
              <tr>
                  <th>Nombre completo</th>
                  <th>Sexo</th>
                  <th>Email</th>
                  <th>Tipo</th>
                  <th>Estado</th>
                  <th>Fecha nacimiento</th>
                  <th><input type="checkbox" onClick="toggle(this)" /> Seleccionar todo</th>
              </tr>
          </thead>
          <tbody>
              @foreach($members as $member)
              <tr>
                  <td>{{ $member->nombre }} {{ $member->paterno }} {{ $member->materno }}</td>
                  <td>{{ $member->sexo }}</td>
                  <td>{{ $member->email }}</td>
                  @if($member->tipo == 1)
                  <td>Socio</td>
                  @endif
                  @if($member->tipo == 2)
                  <td>Embajador</td>
                  @endif
                  @if($member->estado == 4)
                  <td>Inactivo</td>
                  @endif
                  @if($member->estado == 3)
                  <td>Activo</td>
                  @endif
                  <td>{{date_format(new DateTime($member->nacimiento), 'd-m-Y') }}</td>
                  <td>
                      <input type="checkbox" name="socio[]" value="{{ $member->id }}">
                  </td>
              </tr>
              @endforeach
          </tbody>
      </table>
      <button class="btn btn-primary" type="submit">Enviar</button>
  </form>



<script language="javascript">
  function doSearch(table,text)
  {
    var tableReg = document.getElementById(table);
    var searchText = document.getElementById(text).value.toLowerCase();
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
  var options = {
    url: "display-search-queries",

    getValue: function(element) {
              return element.nombre+" "+element.paterno+" "+element.materno;
            },
    list: {
    match: {
            enabled: true
        }
    }
  };
//-------------------------------------------//
$("#searchTerm").easyAutocomplete(options);

  function toggle(source) {
    checkboxes = document.getElementsByName('socio[]');
    var tableReg = document.getElementById('socios');
    for(var i=0, n=checkboxes.length;i<n;i++) {
      if(tableReg.rows[i+1].style.display != 'none'){
        checkboxes[i].checked = source.checked;
      }
    }
  }

</script>




@endsection
