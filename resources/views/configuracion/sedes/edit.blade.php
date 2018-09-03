@extends('layouts.menu')
@section('content')

<form method="POST" action="/edit_sede/{{$sede->id}}">
    {{csrf_field()}}
    {{ method_field('PUT') }}
    <h1>Editar Sede {{$sede->nombre}}</h1>
    <div class="col">
      <label for="name" class="control-label" ></label>
      <input type="text" name="name" class="form-control" placeholder="Nombre" value="{{$sede->nombre}}">
    </div>
    <div class="col">
      <label for="codigo" class="control-label" ></label>
      <input type="text" name="codigo" class="form-control" placeholder="Codigo" value="{{$sede->codigo}}">
    </div>
    <div class="col">
      <label for="address" class="control-label" name="Dirección: "></label>
      <input type="text" name="address" class="form-control" placeholder="Dirección" value="{{$sede->direccion}}">
    </div>
    <div class="col">
      <label for="city" class="control-label" ></label>
      <input type="text" name="city" class="form-control" placeholder="Ciudad" value="{{$sede->ciudad}}">
    </div>
    <div class="col">
      <label for="phone" class="control-label" ></label>
      <input type="text" name="phone" class="form-control" placeholder="Teléfono" value="{{$sede->fono}}">
    </div>
    <br>

    <button class="btn btn-primary" type="submit">Actualizar</button>
</form>
@endsection
