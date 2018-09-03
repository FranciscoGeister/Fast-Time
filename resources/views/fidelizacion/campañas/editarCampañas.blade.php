@extends('layouts.menu')

<link href="{{ asset('css/table.css') }}" rel="stylesheet">
<link rel="STYLESHEET" type="text/css" href="{{ asset("css/titles.css") }}">

@section('content')



<div class="container">
  <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a>Fidelización</a></li>
        <li class="breadcrumb-item"><a href="/campañas">Campañas</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a>Editar Campaña</a></li>
      </ol>
  </nav>
  <br>

  <h1 class="title">Editar: <span class="normal">{{$campaña->nombre}}</span></h1>
  <br>
<form method="POST" action="/campañas/{{$campaña->id}}" enctype="multipart/form-data">
  {{csrf_field()}}
  {{method_field('PUT')}}
  <h3 class="title">Nombre</h3>
  <input type="text" name="nombre" class="col-sm-4 form-control" value="{{$campaña->nombre}}">
  <br>
  <br>

  <h3 class="title">Mensaje</h3>
  <textarea name="mensaje" rows="2">{{$campaña->mensaje}}</textarea>
  <br>
  <br>

  <h3 class="title">Descripción</h3>
  <textarea name="descripcion" rows="2" >{{$campaña->descripcion}}</textarea>
  <br>
  <br>

  <h3 class="title">Imagen</h3>
  <img src="{{ Storage::url($campaña->imagen) }}"  width="150px">
  <input type="file" id="files" name="imagen" /><br/>
  <output id="list"></output><br/>
  <br>


  <form>
    <span class="search"><b>Buscar</b></span>
    <br> <input id="searchTerm" type="text" onchange="doSearch()" onkeyup="doSearch()" />
  </form>
  <br>
  <table class="table table-bordered" id="socios">
      <thead>
          <tr>
              <th>Nombre completo</th>
              <th>Sexo</th>
              <th>Email</th>
              <th>Tipo</th>
              <th>Fecha nacimiento</th>
              <th><input type="checkbox" onClick="toggle(this)" /> Seleccionar todo</th>
          </tr>
      </thead>
      <tbody>
          @foreach($members as $member)
          @if($member->estado==3)
          <tr>
              <td>{{ $member->nombre }} {{ $member->paterno }} {{ $member->materno }}</td>
              <td>{{ $member->sexo }}</td>
              <td>{{ $member->email }}</td>
              <td>{{ $member->nombre_tipo }}</td>
              <td>{{date_format(new DateTime($member->nacimiento), 'd-m-Y') }}</td>
              <td>
                  <input type="checkbox" name="socio[]" value="{{ $member->id }}">
              </td>
          </tr>
          @endif
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
