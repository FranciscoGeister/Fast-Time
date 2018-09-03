@extends('layouts.menu')

<link rel="STYLESHEET" type="text/css" href="{{ asset("css/titles.css") }}">

@section('content')
<div class="col-xs-12">
<div class="center-block">
<form method="POST" action="/posts" enctype="multipart/form-data">
  {{csrf_field() }}
<div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a>Administración</a></li>
          <li class="breadcrumb-item"><a href="#" id="back" onclick="confirmar()">Personal</a></li>
          <li class="breadcrumb-item active" aria-current="page">Agregar Personal</li>
        </ol>
      </nav>
      @if (session('status'))
          <div class="alert alert-danger">
               {{ session('status') }}
          </div>
      @endif
      <br>
      <div class="d-flex justify-content-center">
        <h2 class="title">Registro de Personal</h2>
      </div>
      <br>
      <div class="form-group row">
        <div class="col-md-6">
          <output id="thumb_avatar"></output><br>
          <label class="control-label">Foto perfil</label>
          <input type="file" name="avatar" id="avatar"><br>
        </div>
        <div class="col-md-6">
            <output id="thumb_huella"></output><br>
            <label class="control-label">Huella digital</label>
            <input type="file" name="huella" id="huella"><br>
        </div>
      </div>
      <div class="form-group" >
          <div class="row">
            <div class="col">
              <label for="first_name" class="control-label"><h6>Nombre</h6></label>
              <input type="text" name="first_name" class="form-control"  placeholder="Nombre" required>              
            </div>
            <div class="col">
              <label for="last_name" class="control-label"><h6>Apellido Paterno</h6></label>
              <input type="text" name="last_name" class="form-control" placeholder="Apellido Paterno" required>             
            </div>
            <div class="col">
              <label for="mother_last_name" class="control-label"><h6>Apellido Materno</h6></label>
              <input type="text" name="mother_last_name" class="form-control" placeholder="Apellido Materno" required>              
            </div>
          </div>
      </div>

      <div class="form-group">
        <div class="row">
          <div class="col">
            <label for="rut" class="control-label"><h6>Rut</h6>
            <input type="text" class="form-control" name="rut" placeholder="xx.xxx.xxx-x" required>
            </label>
          </div>
          <div class="col">
          <label for="celular" class="control-label"><h6>Celular</h6>
              <input type="text" class="form-control" name="celular" placeholder="Celular" required>
          </label>
          </div>
          <div class="col">
            <label><h6>Correo</h6>
                <input type="email" class="form-control" name="email" placeholder="Correo" required>
            </label>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col">
            <label><h6>Cargo</h6>
                <select class="form-control" name="tipo">
                  @foreach ($cargos as $cargo)
                  <option>{{$cargo->nombre}}</option>
                  @endforeach
                </select>
            </label>
          </div>
          <div class="col">
            <label><h6>Vínculo</h6>
              <select class="form-control" name='link'>
                <option value="1">Honorario</option>
                <option value="2">Contrato</option>
              </select>
            </label>
          </div>
          <div class="col">
            <label class="control-label"><h6>Horas Contratadas(diarias)</h6>
              <input type="number" class="form-control" name="contracted_hours">
          </label>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-md-4">
            <label for="nacimiento" class="control-label"><h6>Fecha de nacimiento</h6>
            <input class="form-control" type="date" name="nacimiento" placeholder="aaaa-mm-dd" required>
            </label>
          </div>
          <div class="col-md-4">
            <h6>Color</h6>
            <input id="cp9" name="color" type="text" class="form-control col-md-6">
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col">
            <h6>Sede</h6>
            @foreach ($sedes as $sede)
                {{ Form::checkbox('sede[]', $sede->id) }}
                {{ Form::label('sede', $sede->nombre) }}<br>
            @endforeach
          </div>
        </div>
      </div>

      <div class="d-flex justify-content-center">
        <button class="btn btn-primary" type="submit">Registrar</button>
      </div>
</div>
</form>
</div>
</div>

{!! Html::style('vendor/seguce92/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css') !!}
{!! Html::script('vendor/seguce92/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js') !!}
<style>
.colorpicker-2x .colorpicker-saturation {
  width: 200px;
  height: 200px;
}

.colorpicker-2x .colorpicker-hue,
.colorpicker-2x .colorpicker-alpha {
  width: 30px;
  height: 200px;
}

.colorpicker-2x .colorpicker-color,
.colorpicker-2x .colorpicker-color div {
  height: 30px;
}

.thumb {
    height: 100px;
    border: 1px solid #000;
    margin: 10px 5px 0 0;
}

</style>
<script>
$(function () {
  $('#cp9').colorpicker({
    customClass: 'colorpicker-2x',
    sliders: {
      saturation: {
        maxLeft: 200,
        maxTop: 200
      },
      hue: {
        maxTop: 200
      },
      alpha: {
        maxTop: 200
      }
    }
  });
});

function thumbAvatar(evt) {
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
           document.getElementById("thumb_avatar").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
          };
      })(f);
      reader.readAsDataURL(f);
    }
}
function thumbHuella(evt) {
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
           document.getElementById("thumb_huella").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
          };
      })(f);
      reader.readAsDataURL(f);
    }
}

document.getElementById('avatar').addEventListener('change', thumbAvatar, false);
document.getElementById('huella').addEventListener('change', thumbHuella, false);

function confirmar() {
  var r = confirm("Los datos no se guardaran");
  if (r == true) {
      document.getElementById("back").href = "/personal";
  }
}
</script>
@endsection
