@extends('layouts.menu')
@section('content')
<h3>Ingresar Sede</h3>
<form action="/create_sede" method="post">
  {{csrf_field()}}
  <div class="col">
    <label for="name" class="control-label" ></label>
    <input type="text" name="name" class="form-control" placeholder="Nombre">
  </div>
  <div class="col">
    <label for="codigo" class="control-label" ></label>
    <input type="text" name="codigo" class="form-control" placeholder="Codigo">
  </div>
  <div class="col">
    <label for="address" class="control-label" ></label>
    <input type="text" name="address" class="form-control" placeholder="Dirección">
  </div>
  <div class="col">
    <label for="city" class="control-label" ></label>
    <input type="text" name="city" class="form-control" placeholder="Ciudad">
  </div>
  <div class="col">
    <label for="phone" class="control-label" ></label>
    <input type="text" name="phone" class="form-control" placeholder="Teléfono">
  </div>
  <br>
  <div class="d-flex justify-content-center">
      <button type="submit" class="btn btn-primary">Agregar</button>
  </div>

</form>
@endsection
