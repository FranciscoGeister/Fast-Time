@extends('layouts.menu')
<link rel="STYLESHEET" type="text/css" href="{{ asset("css/titles.css") }}">

@section('content')

<div class="container">
<form method="POST" action="/socios" enctype="multipart/form-data">
	{{csrf_field()}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a>Operación</a></li>
          <li class="breadcrumb-item"><a href="/socios">Ingresar Cliente</a></li>
          <li class="breadcrumb-item active" aria-current="page"><a>Nuevo Cliente</a></li>
        </ol>
    </nav>
    @if (session('status'))
          <div class="alert alert-danger">
               {{ session('status') }}
          </div>
      @endif
    <br>
    <h1 class="title">Registro de socio</h1>
    <br>

	<div class="form-inline" >
   		<label class="control-label col-sm-1">Nombre</label>
   		<input type="text" name="nombre" class="form-control col-sm-3" placeholder="Nombre" required>
       	<label class="control-label col-sm-1">Paterno</label>
       	<input type="text" name="paterno" class="form-control col-sm-3" placeholder="Paterno" required>
        <label class="control-label col-sm-1">Materno</label>
        <input type="text" name="materno" class="form-control col-sm-3" placeholder="Materno" required>
    </div>
    <br>

    <div class="form-inline">
        <label class="control-label col-sm-1">Rut</label>
        <input type="text" name="rut" class="form-control col-sm-3" placeholder="xx.xxx.xxx-x" required>
        <label class="control-label col-sm-1">Email</label>
        <input type="text" name="email" class="form-control col-sm-3" placeholder="direccion@mail.cl" required>
        <label class="control-label col-sm-1">Celular</label>
        <input type="text" name="celular" class="form-control col-sm-3" required>
    </div>
    <br>

    <div class="form-inline">
        <label class="control-label col-sm-1">Sexo</label>
        <select class="form-control col-sm-3" name="sexo">
            <option value="Femenino">Femenino</option>
            <option value="Masculino">Masculino</option>
        </select>
        <label class="control-label col-sm-1">Tipo</label>
        <select class="form-control col-sm-3" name="tipo">
            @foreach($clients as $client)
                <option value="{{ $client->id }}">{{ $client->nombre }}</option>
            @endforeach
        </select>
        <label class="control-label col-sm-2">Fecha de nacimiento</label>
        <input class="form-control col-sm-2" type="date" name="nacimiento" placeholder="aaaa-mm-dd" required>
    </div>
    <br>

    <div class="form-inline">
        <label class="control-label col-sm-1">Sucursal</label>
        <select class="form-control col-sm-2" name="id_sucursal">
            @foreach($sucursales as $sucursal)
                <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
            @endforeach
        </select>
        <label class="control-label col-sm-1">Estado</label>
        <select class="form-control col-sm-2" name="estado">
            @foreach($statuses as $status)
            @if($status->id==3)
                <option value="{{ $status->id }}" selected>{{ $status->nombre }}</option>
            @else
                <option value="{{ $status->id }}">{{ $status->nombre }}</option>
            @endif
            @endforeach
        </select>
        <label class="control-label col-sm-1">Password</label>
        <input class="form-control col-sm-2" type="text" name="password" placeholder="password" required>
        <label class="control-label col-sm-2">¿Recibir Mail?</label>
        <select class="form-control col-sm-1" name="want_info">
            <option value="1" selected>Si</option>
            <option value="0">No</option>
        </select>
    </div>
    <br>

    <div class="form-inline">
        <label class="control-label col-sm-2">Foto perfil</label>
        <input type="file" name="avatar">
        <label class="control-label col-sm-2">Huella digital</label>
        <input type="file" name="huella">
    </div>
    <br>

    <button class="btn btn-primary" type="submit">Registrar</button>
</form>
</div>

@endsection
