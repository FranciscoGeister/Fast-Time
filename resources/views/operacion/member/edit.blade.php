@extends('layouts.menu')

@section('content')

<div class="container">
<form method="POST" action="/socios/{{$member->id}}" enctype="multipart/form-data">
    {{csrf_field()}}
    {{method_field('PUT')}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a>Operación</a></li>
          <li class="breadcrumb-item"><a href="/socios">Ingresar Cliente</a></li>
          <li class="breadcrumb-item active" aria-current="page"><a>Editar Cliente</a></li>
        </ol>
    </nav>
    <br>
    <h1 class="title">Datos socio</h1>
    <br>
    <img src="{{ Storage::url($member->avatar) }}" width="100px">
    <label class="control-label col-sm-2">Foto perfil</label>
    <input type="file" name="avatar">
    <br>
    <br>
	<div class="form-inline" >
   		<label class="control-label col-sm-1">Nombre</label>
   		<input type="text" name="nombre" class="form-control col-sm-3" value="{{$member->nombre}}">
       	<label class="control-label col-sm-1">Paterno</label>
       	<input type="text" name="paterno" class="form-control col-sm-3" value="{{$member->paterno}}">
        <label class="control-label col-sm-1">Materno</label>
        <input type="text" name="Materno" class="form-control col-sm-3" value="{{$member->materno}}">
    </div>
    <br>

    <div class="form-inline">
        <label class="control-label col-sm-1">Rut</label>
        <input type="text" name="rut" class="form-control col-sm-3" value="{{$member->rut}}">
        <label class="control-label col-sm-1">Email</label>
        <input type="text" name="email" class="form-control col-sm-3" value="{{$member->email}}">
        <label class="control-label col-sm-1">Celular</label>
        <input type="text" name="celular" class="form-control col-sm-3" value="{{$member->celular}}">
    </div>
    <br>

    <div class="form-inline">
        <label class="control-label col-sm-1">Sexo</label>
        <select class="form-control col-sm-3" name="sexo">
            @if($member->sexo=="Femenino")
            <option value="Femenino" selected>Femenino</option>
            <option value="Masculino">Masculino</option>
            @else
            <option value="Masculino" selected>Masculino</option>
            <option value="Femenino">Femenino</option>
            @endif
        </select>
        <label class="control-label col-sm-1">Tipo</label>
        <select class="form-control col-sm-3" name="tipo">
            @foreach($clients as $client)
            @if($member->tipo!=$client->id)
            <option value="{{ $client->id }}">{{ $client->nombre }}</option>
            @else
            <option value="{{ $client->id }}" selected>{{ $client->nombre }}</option>
            @endif
            @endforeach
        </select>
        <label for="nacimiento" class="control-label col-sm-2">Fecha de nacimiento</label>
        <input class="form-control col-sm-2" type="date" name="nacimiento" value="{{$member->nacimiento}}">
    </div>
    <br>

    <div class="form-inline">
        <label class="control-label col-sm-1">Sucursal</label>
        <select class="form-control col-sm-2" name="sucursal">
            @foreach($sucursales as $sucursal)
            @if($member->id_sucursal!=$sucursal->id)
            <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
            @else
            <option value="{{ $sucursal->id }}" selected>{{ $sucursal->nombre }}</option>
            @endif
            @endforeach
        </select>
        <label class="control-label col-sm-1">Estado</label>
        <select class="form-control col-sm-2" name="estado">
            @foreach($statuses as $status)
            @if($status->id==$member->estado)
                <option value="{{ $status->id }}" selected>{{ $status->nombre }}</option>
            @else
                <option value="{{ $status->id }}">{{ $status->nombre }}</option>
            @endif
            @endforeach
        </select>
        <label class="control-label col-sm-1">Password</label>
        <input class="form-control col-sm-2" type="text" name="password" value="{{ $member->password }}">
        <label class="control-label col-sm-2">¿Recibir Mail?</label>
        <select class="form-control col-sm-1" name="want_info">
            @if($member->want_info==1)
                <option value="1" selected>Si</option>
                <option value="0">No</option>
            @else
                <option value="1">Si</option>
                <option value="0" selected>No</option>
            @endif
        </select>
    </div>
    <br>
    <br>

    <div class="control-group">
        <img src="{{ Storage::url($member->huella) }}" width="100px">
        <label class="control-label">Huella digital</label>
        <input type="file" name="huella">
    </div>
    <br>

    <h1 class="title">Plan/Programa Activo</h1>
    <br>
    @if($plan!=null)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre Plan/Programa</th>
                    <th>Fecha inicio</th>
                    <th>Fecha caducidad</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $plan->nombre }}</td>
                    <td><input class="form-control" type="date" name="fecha_inicio" value="{{ $memberPlan->inicio }}" readonly></td>
                    <td><input class="form-control" type="date" name="vencimiento" value="{{ $memberPlan->vencimiento }}"></td>
                </tr>
            </tbody>
        </table>
        
    <br>
    <h1 class="title">Sesiones</h1>
    <br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @if($plan!=null)
            @foreach($memberSesions as $memberSesion)
                <tr>
                    @foreach($sesions as $sesion)
                    @if($memberSesion->tipo_sesion==$sesion->id)
                    <td>{{ $sesion->nombre }}</td>
                    <td>{{ $memberSesion->cantidad }}</td>
                    @endif
                    @endforeach
                </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    <br>
    <h3 class="title">Comentarios fecha caducidad</h3>
    <textarea name="comen_venc" rows="2">{{ $memberPlan->comen_venc }}</textarea>
    <br>
    <br>

    <h1 class="title">Nuevos Planes/Programas contratados:</h1>
    <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre Plan/Programa</th>
                    <th>Operación</th>
                </tr>
            </thead>
            <tbody>
                @if($newPlan!=null)               
                    <tr>
                        <td>{{ $newPlanName->nombre }}</td>
                        <td>
                            <a href="#" id="activar" class="btn btn-info" role="button" onclick="confirmar({{$newPlan->id}},{{$memberPlan->id}})">Activar</a>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    <input type="hidden" name="memberPlan_id" value="{{ $memberPlan->id }}">
    <button class="btn btn-primary" type="submit">Actualizar</button>
</form>
@else
    <h3>No tienen plan activo</h3>
    <br>
    <button class="btn btn-primary" type="submit">Actualizar</button>
@endif
</div>

<style type="text/css">
    .title{
    color: maroon;
    }
    
    textarea {
        width: 50%;
        height: 100px;
        padding: 12px 20px;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
        background-color: #f8f8f8;
        resize: none;
    }
</style>

<script type="text/javascript">
    function confirmar(newPlanId,memberPlanId) {
        if('<?php echo $memberSesions;?>'!=null){
            var r = confirm("Aun existen sesiones en el plan actual. ¿Desea eliminarlas?");
        }
        if (r == true) {
            document.getElementById("activar").href = "/socios/activar/"+newPlanId+"/"+memberPlanId;
        }
    }
</script>

@endsection
