@extends('layouts.menu')

@section('content')

<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
{!! Html::script('vendor/autocomplete/jquery.easy-autocomplete.min.js') !!}
<!-- CSS file -->
{!! Html::style('vendor/autocomplete/easy-autocomplete.css') !!}

<div class="container">
  <h1>Editar {{$notification->name}}</h1>
<form method="POST" action="/notifications/{{$notification->id}}" enctype="multipart/form-data">
  {{csrf_field()}}
  {{method_field('PUT')}}
  <h3>Nombre</h3>
  <input type="text" name="name" class="col-sm-4" value="{{$notification->name}}"><br>

  <h3>Mensaje</h3>
  <textarea name="message" rows="2">{{$notification->message}}</textarea>

  <h3>Progamar</h3>
  <input class="col-sm-2" type="date" name="date">
  <input class="col-sm-2" type="time" name="time">

  <h3>URL</h3>
  <input type="text" class="col-sm-4" name="url" value="{{$notification->url}}">

</br></br>
<h3>Socios</h3>


  Buscar <input id="searchTerm" type="text" onchange="doSearch()" onkeyup="doSearch()" />
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
  <button class="btn btn-primary" type="submit">Actualizar</button>
</div>

<script language="javascript">
  function doSearch()
  {
    var tableReg = document.getElementById('socios');
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
  }

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

function archivo(evt) {
    var files = evt.target.files; // FileList object

    // Obtenemos la imagen del campo "file".
    for (var i = 0, f; f = files[i]; i++) {
      //Solo admitimos imágenes.
      if (!f.type.match('image.*')) {
          continue;
      }

      var reader = new FileReader();

      reader.onload = (function(theFile) {
          return function(e) {
            // Insertamos la imagen
           document.getElementById("list").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
          };
      })(f);

      reader.readAsDataURL(f);
    }
}

document.getElementById('files').addEventListener('change', archivo, false);


</script>

<style>
	textarea {
	    width: 70%;
	    height: 150px;
	    padding: 12px 20px;
	    box-sizing: border-box;
	    border: 2px solid #ccc;
	    border-radius: 4px;
	    background-color: #f8f8f8;
	    resize: none;
	}

	.table td{
			border-color: black;
	}

  .thumb {
      height: 300px;
      border: 1px solid #000;
      margin: 10px 5px 0 0;
  }
</style>


@endsection
