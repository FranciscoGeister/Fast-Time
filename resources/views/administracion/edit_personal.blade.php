@extends('layouts.menu')
<link rel="STYLESHEET" type="text/css" href="{{ asset("css/titles.css") }}">

@section('content')
<div class="col-xs-12">
<div class="center-block">
<form method="POST" action="/update/{{$user->id}}" enctype="multipart/form-data">
  {{csrf_field() }}
  {{ method_field('PUT') }}
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a>Administración</a></li>
        <li class="breadcrumb-item"><a href="#" id="back" onclick="confirmar()">Personal</a></li>
        <li class="breadcrumb-item active" aria-current="page">Editar Personal</li>
      </ol>
    </nav>

    <br>
      <div class="d-flex justify-content-center">
          <h2 class="title">Editar Personal</h2>
      </div>
      <br>
      
      <div class="form-group row">
        <div class="col-md-6">
          <img src="{{ Storage::url($user->avatar) }}" width="100px"><br>
          <label class="control-label">Foto perfil</label>
          <input type="file" name="avatar">
        </div>
        <div class="col-md-6">
            <img src="{{ Storage::url($user->huella) }}" width="100px"><br>
            <label class="control-label">Huella digital</label>
            <input type="file" name="huella">
        </div>
      </div>

      <div class="form-group" >
          <div class="row">
            <div class="col">
              <label for="first_name" class="control-label"><h6>Nombre</h6></label>
              <input type="text" id= "fname" name="first_name" class="form-control" value={{$user->first_name}} required="">
            </div>
            <div class="col">
              <label for="last_name" class="control-label"><h6>Apellido Paterno</h6></label>
              <input type="text" id= "lname" name="last_name" class="form-control" value={{$user->last_name}} required="">
            </div>
            <div class="col">
              <label for="mother_last_name" class="control-label"><h6>Apellido Materno</h6></label>
              <input type="text" id= "mname" name="mother_last_name" class="form-control" value={{$user->mother_last_name}} required="">
            </div>
          </div>
      </div>

      <div class="form-group">
        <div class="row">
          <div class="col">
            <label for="rut" class="control-label"><h6>Rut</h6>
            <input type="text" class="form-control" name="rut" value={{$user->rut}} required="">
            </label>
          </div>
          <div class="col">
          <label for="celular" class="control-label"><h6>Celular</h6>
              <input type="text" class="form-control" name="celular" value={{$user->celular}}>
          </label>
          </div>
          <div class="col">
            <label><h6>Correo</h6>
                <input type="email" class="form-control" name="email" value={{$user->email}} required="">
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
                @if($user->link==1)
                <option value="1" selected>Honorario</option>
                <option value="2">Contrato</option>
                @else
                <option value="1">Honorario</option>
                <option value="2" selected>Contrato</option>
                @endif
              </select>
            </label>
          </div>
          <div class="col">
            <label class="control-label"><h6>Horas Contratadas (diarias)</h6>
            <input class="form-control" type="number" name="contracted_hours" value={{$user->contracted_hours}} required="">
            </label>
          </div>
        </div>
      </div>
      <div class="form-group">
      <div class="row">
          <div class="col-md-4">
            <label for="nacimiento" class="control-label"><h6>Fecha de nacimiento</h6>
            <input class="form-control" type="date" id="nacimiento" name="nacimiento" value={{$user->nacimiento}} required="">
            </label>
          </div>
          <div class="col-md-4">
            <label class="control-label"><h6>Color</h6>
            <input id="cp9" name="color" type="text" class="form-control" value={{$user->color}} required="">
            </label>
          </div>
      </div>
    </div>
      <div class="form-group">
        <div class="row">
          <div class="col">
            <h6>Sede</h6>
            <!--Extraemos los valores guardados-->
            @foreach ($user_sedes as $user_sede)
                @php ($checked_list[] = $user_sede->id)
            @endforeach
            @foreach ($sedes as $sede)
                @if($checked_list > 0)
                {{ Form::checkbox('sede[]', $sede->id, in_array($sede->id, $checked_list)) }}
                @else
                {{ Form::checkbox('sede[]', $sede->id) }}
                @endif
                {{ Form::label('sede', $sede->nombre) }}<br>
            @endforeach
          </div>
      </div>
    </div>

      <div class="form-group">
        <button class="btn btn-primary" type="submit">Editar</button>
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

function confirmar() {
  var r = confirm("Los cambios no se guardaran");
  if (r == true) {
      document.getElementById("back").href = "/personal";
  }
}
</script>
@endsection
