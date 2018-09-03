@extends('layouts.menu')
<link href="{{ asset('css/table.css') }}" rel="stylesheet">
@section('content')


<div class="tab">
    <button class="tablinks" onclick="openSucursal(event, 'Clientes')">Clientes</button>
    <button class="tablinks" onclick="openSucursal(event, 'Planes')">Planes</button>
    <button class="tablinks" onclick="openSucursal(event, 'Programas')">Programas</button>
    <button class="tablinks" onclick="openSucursal(event, 'Sesiones')">Sesiones</button>
    <button class="tablinks" onclick="openSucursal(event, 'Sedes')">Sedes</button>
    <button class="tablinks" onclick="openSucursal(event, 'Cargos')">Cargos</button>
    <button class="tablinks" onclick="openSucursal(event, 'Pagos')">Pagos</button>
    <button class="tablinks" onclick="openSucursal(event, 'Estados')">Estados</button>
    <button class="tablinks" onclick="openSucursal(event, 'Tallas')">Tallas</button>
    <button class="tablinks" onclick="openSucursal(event, 'UM')">Unidad de medida</button>
    <button class="tablinks" onclick="openSucursal(event, 'Tipos_Programas')">Tipos de programas</button>
    <button class="tablinks" onclick="openSucursal(event, 'Ejercicios')">Ejercicios</button>
    <button class="tablinks" onclick="openSucursal(event, 'Implementos')">Implementos</button>
    <button class="tablinks" onclick="openSucursal(event, 'Patologías')">Patologías</button>
    <button class="tablinks" onclick="openSucursal(event, 'Preguntas')">Preguntas Médicas</button>
    <button class="tablinks" onclick="openSucursal(event, 'Antecedentes')">Antecedentes Personales</button>
    <button class="tablinks" onclick="openSucursal(event, 'Vida')">Preguntas de Hábitos de Vida</button>
    <button class="tablinks" onclick="openSucursal(event, 'Laboral')">Preguntas de Hábitos de Vida Laboral</button>
    <button class="tablinks" onclick="openSucursal(event, 'Salud')">Preguntas de Hábitos No Saludables</button>
    <button class="tablinks" onclick="openSucursal(event, 'Nutricion')">Preguntas de Hábitos Nutricionales</button>
    <button class="tablinks" onclick="openSucursal(event, 'Logros')">Logros</button>
</div>

<div class="container">
<div id="Clientes" class="tabcontent">
  <!-- Table-to-load-the-data Part -->
  <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
            @if($client->estado==1)
            <tr>
                <td>{{$client->nombre}}</td>
                <td>
                  <form action="clientes/{{$client->id}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                      <button class="btn btn-danger" type="submit">
                        Eliminar
                      </button>
                  </form>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    </div>
    <!-- Form for ingresing new "cargo"-->
<hr>
<h5>Ingresar Nuevo tipo de Socio</h5>
<form method="POST" action="clientes">
    {{csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Nombre</label>
        <input type="text" name="nombre" class="form-control"  placeholder="nombre">
    </div>
    <button type="submit" class="btn btn-default">Agregar</button>
</form>
</div>

<div id="Planes" class="tabcontent">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Duración (días)</th>
                <th>Valor</th>
                <th>Cant. sesiones</th>
                <th>sesiones semanales</th>
                <th colspan="2">Operaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($plans as $plan)
            @if($plan->estado==1)
            <tr>
                <td>{{ $plan->nombre }}</td>
                <td>{{ $plan->duracion }}</td>
                <td>${{ number_format($plan->valor,0, "," , ".") }}</td>
                <td>{{ $plan->sesiones }}</td>
                <td>{{ $plan->sesi_semanal }}</td>
                <td>
                    <form action="planes/{{$plan->id}}" method="POST">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn btn-danger" type="submit">Eliminar</button>
                    </form>
                </td>
                <td>
                    <form action="planes/{{ $plan->id }}/edit" method="POST">
                        {{csrf_field()}}
                        {{method_field('GET')}}
                        <button class="btn btn-warning" type="submit">Editar</button>
                    </form>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    <form action="planes/create" method="POST">
        {{csrf_field()}}
        {{method_field('GET')}}
        <button class="btn btn-primary" type="submit">Agregar nuevo plan</button>
    </form>
</div>
<div id="Programas" class="tabcontent">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Duración (días)</th>
                <th>Valor</th>
                <th>Sesiones nutricionista</th>
                <th>Cant. sesiones</th>
                <th>sesiones semanales</th>
                <th colspan="2">Operaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($programs as $program)
            @if($program->estado==1)
            <tr>
                <td>{{ $program->nombre }}</td>
                <td>{{ $program->duracion }}</td>
                <td>${{ number_format($program->valor,0, "," , ".") }}</td>
                <td>{{ $program->sesi_nutri }}</td>
                <td>{{ $program->sesiones }}</td>
                <td>{{ $program->sesi_semanal }}</td>
                <td>
                    <form action="programas/{{$program->id}}" method="POST">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn btn-danger" type="submit">Eliminar</button>
                    </form>
                </td>
                <td>
                    <form action="programas/{{ $program->id }}/edit" method="POST">
                        {{csrf_field()}}
                        {{method_field('GET')}}
                        <button class="btn btn-warning" type="submit">Editar</button>
                    </form>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    <form action="programas/create" method="POST">
        {{csrf_field()}}
        {{method_field('GET')}}
        <button class="btn btn-primary" type="submit">Agregar nuevo programa</button>
    </form>
</div>

<div id="Sesiones" class="tabcontent">
  <!-- Table-to-load-the-data Part -->
  <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sesions as $sesion)
             @if($sesion->estado==1)
            <tr>
                <td>{{$sesion->nombre}}</td>
                <td>${{ number_format($sesion->precio,0, "," , ".") }}</td>
                <td>
                  <form action="sesiones/{{$sesion->id}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                      <button class="btn btn-danger" type="submit">
                        Eliminar
                      </button>
                  </form>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    </div>
    <!-- Form for ingresing new "sesion"-->
<hr>
<h5>Ingresar nuevo tipo de Sesión</h5>
<form method="POST" action="sesiones">
    {{csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Nombre</label>
        <input type="text" name="nombre" class="form-control"  placeholder="nombre">
        <label for="exampleInputEmail1">Precio</label>
        <input type="text" name="precio" class="form-control"  placeholder="precio">
    </div>
    <button type="submit" class="btn btn-default">Agregar</button>
</form>
</div>
<div id="Sedes" class="tabcontent">
  <!-- Table-to-load-the-data Part -->
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Codigo</th>
                <th>Direccion</th>
                <th>Ciudad</th>
                <th>Fono</th>
            </tr>
        </thead>
        <tbody id="tasks-list" name="tasks-list">
            @foreach ($sedes as $sede)
            <tr id="task{{$sede->id}}">
                <td>{{$sede->nombre}}</td>
                <td>{{$sede->codigo}}</td>
                <td>{{$sede->direccion}}</td>
                <td>{{$sede->ciudad}}</td>
                <td>{{$sede->fono}}</td>
                <td>
                    <form action="/go_to_edit/{{$sede->id}}">
                        <button class="btn btn-warning" type="submit">Editar</button>
                    </form>
                </td>
                <td>
                  <form action="/destroy_sede/{{$sede->id}}" method="POST">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn btn-danger" type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <form action="/sede/create">
        <button class="btn btn-primary" type="submit">Agregar Nueva Sede</button>
    </form>
    <!-- End of Table-to-load-the-data Part -->
    </div>
   <meta name="_token" content="{!! csrf_token() !!}" />
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
   <script src="{{asset('js/ajax-crud.js')}}"></script>

<div id="Cargos" class="tabcontent">
  <!-- Table-to-load-the-data Part -->
  <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cargos as $cargo)
            <tr>
                <td>{{$cargo->nombre}}</td>
                <!--<td>
                    <button class="btn btn-warning btn-xs btn-detail" ="edit_cargo/{{$cargo->id}}">Editar</button>
                </td>-->
                <td>
                  <form action="/destroy_cargo/{{$cargo->id}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                      <button class="btn btn-danger" type="submit">
                        Eliminar
                      </button>
                  </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <!-- Form for ingresing new "cargo"-->
<hr>
<h5>Ingresar Nuevo Cargo</h5>
<form method="POST" action="/create_cargo">
  {{csrf_field() }}
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre</label>
    <input type="text" name="name" class="form-control"  placeholder="nombre">
  </div>
  <button type="submit" class="btn btn-default">Agregar</button>
</form>

</div>
<div id="Estados" class="tabcontent">
  <!-- Table-to-load-the-data Part -->
  <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($statuses as $status)
            <tr>
                <td>{{$status->nombre}}</td>
                <td>
                  <form action="estados/{{$status->id}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                      <button class="btn btn-danger" type="submit">
                        Eliminar
                      </button>
                  </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <!-- Form for ingresing new "cargo"-->
<hr>
<h5>Ingresar Nuevo tipo de estado</h5>
<form method="POST" action="estados">
    {{csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Nombre</label>
        <input type="text" name="nombre" class="form-control"  placeholder="nombre">
    </div>
    <button type="submit" class="btn btn-default">Agregar</button>
</form>
</div>


<div id="Pagos" class="tabcontent">
  <!-- Table-to-load-the-data Part -->
  <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Forma de pago</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
            @if($payment->estado==1)
            <tr>
                <td>{{$payment->nombre}}</td>
                <td>
                  <form action="pagos/{{$payment->id}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                      <button class="btn btn-danger" type="submit">
                        Eliminar
                      </button>
                  </form>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    </div>
    <!-- Form for ingresing new "cargo"-->
<hr>
<h5>Ingresar Nueva forma de Pago</h5>
<form method="POST" action="pagos">
    {{csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Forma de pago</label>
        <input type="text" name="nombre" class="form-control"  placeholder="nombre">
    </div>
    <button type="submit" class="btn btn-default">Agregar</button>
</form>
</div>

<div id="Tallas" class="tabcontent">
  <!-- Table-to-load-the-data Part -->
  <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sizes as $size)
            <tr>
                <td>{{$size->nombre}}</td>
                <td>
                  <form action="tallas/{{$size->id}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                      <button class="btn btn-danger" type="submit">
                        Eliminar
                      </button>
                  </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <!-- Form for ingresing new "talla"-->
<hr>
<h5>Ingresar Nueva Talla</h5>
<form method="POST" action="tallas">
    {{csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Nombre</label>
        <input type="text" name="nombre" class="form-control"  placeholder="nombre">
    </div>
    <button type="submit" class="btn btn-default">Agregar</button>
</form>
</div>

<div id="UM" class="tabcontent">
  <!-- Table-to-load-the-data Part -->
  <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($unities as $unity)
            <tr>
                <td>{{$unity->nombre}}</td>
                <td>
                  <form action="unidades/{{$unity->id}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                      <button class="btn btn-danger" type="submit">
                        Eliminar
                      </button>
                  </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <!-- Form for ingresing new "talla"-->
<hr>
<h5>Ingresar Nueva UM</h5>
<form method="POST" action="unidades">
    {{csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Nombre</label>
        <input type="text" name="nombre" class="form-control"  placeholder="nombre">
    </div>
    <button type="submit" class="btn btn-default">Agregar</button>
</form>
</div>

<div id="Tipos_Programas" class="tabcontent">
  <!-- Table-to-load-the-data Part -->
  <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($programTypes as $type)
            <tr>
                <td>{{$type->nombre}}</td>
                <td>
                  <form action="tipo_programas/{{$type->id}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                      <button class="btn btn-danger" type="submit">
                        Eliminar
                      </button>
                  </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <!-- Form for ingresing new "program type"-->
<hr>
<h5>Ingresar nuevo tipo de programa</h5>
<form method="POST" action="tipo_programas">
    {{csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Nombre</label>
        <input type="text" name="nombre" class="form-control"  placeholder="nombre">
    </div>
    <button type="submit" class="btn btn-default">Agregar</button>
</form>
</div>

<div id="Ejercicios" class="tabcontent">
  <!-- Table-to-load-the-data Part -->
  <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Sigla</th>
                <th>Video</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($exercises as $exercise)
            <tr>
                <td>{{ $exercise->nombre }}</td>
                <td>{{ $exercise->sigla }}</td>
                <td>
                    <video width="200" controls>
                    <source src="{{ Storage::url($exercise->video) }}" type="video/mp4">
                    </video>
                </td>
                <td><img src="{{ Storage::url($exercise->foto) }}" width="100px"></td>
                <td>
                  <form action="ejercicios/{{$exercise->id}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                      <button class="btn btn-danger" type="submit">
                        Eliminar
                      </button>
                  </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <!-- Form for ingresing new "program type"-->
<hr>
<h5>Ingresar nuevo Ejercicio</h5>
<form method="POST" action="ejercicios" enctype="multipart/form-data">
    {{csrf_field() }}
    <div class="form-group">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control"  placeholder="nombre">
        <label>Sigla</label>
        <input type="text" name="sigla" class="form-control"  placeholder="sigla">
        <label>Video</label>
        <input type="file" name="video">
        <br>
        <label>Foto</label>
        <input type="file" name="foto">
    </div>
    <button type="submit" class="btn btn-default">Agregar</button>
</form>
</div>

<div id="Implementos" class="tabcontent">
  <!-- Table-to-load-the-data Part -->
  <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Sigla</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($implements as $implement)
            <tr>
                <td>{{ $implement->nombre }}</td>
                <td>{{ $implement->sigla }}</td>
                <td>
                  <form action="implementos/{{$implement->id}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                      <button class="btn btn-danger" type="submit">
                        Eliminar
                      </button>
                  </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <!-- Form for ingresing new "program type"-->
<hr>
<h5>Ingresar nuevo Implemento</h5>
<form method="POST" action="implementos">
    {{csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Nombre</label>
        <input type="text" name="nombre" class="form-control"  placeholder="nombre">
        <label>Sigla</label>
        <input type="text" name="sigla" class="form-control"  placeholder="sigla">
    </div>
    <button type="submit" class="btn btn-default">Agregar</button>
</form>
</div>

<div id="Patologías" class="tabcontent">
  <!-- Table-to-load-the-data Part -->
  <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pathologies as $pathology)
            <tr>
                <td>{{$pathology->nombre}}</td>
                <td>
                  <form action="pathologies/{{$pathology->id}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                      <button class="btn btn-danger" type="submit">
                        Eliminar
                      </button>
                  </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <!-- Form for ingresing new "cargo"-->
<hr>
<h5>Ingresar nueva patología o enfermedad</h5>
<form method="POST" action="pathologies">
    {{csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Nombre</label>
        <input type="text" name="nombre" class="form-control"  placeholder="nombre">
    </div>
    <button type="submit" class="btn btn-default">Agregar</button>
</form>
</div>

<div id="Preguntas" class="tabcontent">
  <!-- Table-to-load-the-data Part -->
  <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Pregunta</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($preguntas_medicas as $pregunta)
            <tr>
                <td>{{$pregunta->pregunta}}</td>
                <td>
                  <form action="preguntas_medicas/{{$pregunta->id}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                      <button class="btn btn-danger" type="submit">
                        Eliminar
                      </button>
                  </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <!-- Form for ingresing new "cargo"-->
<hr>
<h5>Ingresar nueva pregunta médica</h5>
<form method="POST" action="preguntas_medicas">
    {{csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Pregunta</label>
        <input type="text" name="pregunta" class="form-control"  placeholder="pregunta">
    </div>
    <button type="submit" class="btn btn-default">Agregar</button>
</form>
</div>

<div id="Logros" class="tabcontent">
  <!-- Table-to-load-the-data Part -->
  <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Icono</th>
                <th>Nombre</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logros as $logro)
            <tr>
                <td><img src="{{ Storage::url($logro->icono) }}"  width="150px"></td>
                <td>{{$logro->nombre}}</td>
                <td>{{$logro->descripcion}}</td>
                <td>
                  <form action="logros/{{$logro->id}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                      <button class="btn btn-danger" type="submit">
                        Eliminar
                      </button>
                  </form>
                  <form action="logros/{{$logro->id}}/edit" method="POST">
                    {{csrf_field()}}
                    {{method_field('GET')}}
                      <button class="btn btn-warning" type="submit">
                        Editar
                      </button>
                  </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <!-- Form for ingresing new "cargo"-->
<hr>
<h5>Ingresar Logro</h5>
<form method="POST" action="logros" enctype="multipart/form-data">
    {{csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Nombre</label>
        <input type="text" name="nombre" class="form-control"  placeholder="nombre">
        <label for="exampleInputEmail1">Descripción</label>
        <input type="text" name="descripcion" class="form-control"  placeholder="descripcion">
        <label for="exampleInputEmail1">Icono</label>
        <input type="file" name="icono"   placeholder="icono">
    </div>
    <button type="submit" class="btn btn-default">Agregar</button>
</form>
</div>

<div id="Antecedentes" class="tabcontent">
  <!-- Table-to-load-the-data Part -->
  <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($antecedentes as $antecedente)
            <tr>
                <td>{{$antecedente->nombre}}</td>
                <td>
                  <form action="antecedentes/{{$antecedente->id}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                      <button class="btn btn-danger" type="submit">
                        Eliminar
                      </button>
                  </form>
                  <form action="antecedentes/{{$antecedente->id}}/edit" method="POST">
                    {{csrf_field()}}
                    {{method_field('GET')}}
                      <button class="btn btn-warning" type="submit">
                        Editar
                      </button>
                  </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <!-- Form for ingresing new "cargo"-->
<hr>
<h5>Nuevo Antecedente</h5>
<form method="POST" action="antecedentes" enctype="multipart/form-data">
    {{csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Nombre</label>
        <input type="text" name="nombre" class="form-control"  placeholder="nombre">
    </div>
    <button type="submit" class="btn btn-default">Agregar</button>
</form>
</div>

<div id="Vida" class="tabcontent">
  <!-- Table-to-load-the-data Part -->
  <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Pregunta</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($habitos_vida as $habito)
            <tr>
                <td>{{$habito->pregunta}}</td>
                <td>
                  <form action="habitos/{{$habito->id}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                      <button class="btn btn-danger" type="submit">
                        Eliminar
                      </button>
                  </form>
                  <form action="habitos/{{$habito->id}}/edit" method="POST">
                    {{csrf_field()}}
                    {{method_field('GET')}}
                      <button class="btn btn-warning" type="submit">
                        Editar
                      </button>
                  </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <!-- Form for ingresing new "cargo"-->
<hr>
<h5>Nueva Pregunta</h5>
<form method="POST" action="habitos/vida" enctype="multipart/form-data">
    {{csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Pregunta</label>
        <input type="text" name="pregunta" class="form-control"  placeholder="Pregunta">
    </div>
    <button type="submit" class="btn btn-default">Agregar</button>
</form>
</div>
<div id="Laboral" class="tabcontent">
  <!-- Table-to-load-the-data Part -->
  <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Pregunta</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($habitos_laboral as $habito)
            <tr>
                <td>{{$habito->pregunta}}</td>
                <td>
                  <form action="habitos/{{$habito->id}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                      <button class="btn btn-danger" type="submit">
                        Eliminar
                      </button>
                  </form>
                  <form action="habitos/{{$habito->id}}/edit" method="POST">
                    {{csrf_field()}}
                    {{method_field('GET')}}
                      <button class="btn btn-warning" type="submit">
                        Editar
                      </button>
                  </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <!-- Form for ingresing new "cargo"-->
<hr>
<h5>Nueva Pregunta</h5>
<form method="POST" action="habitos/laboral" enctype="multipart/form-data">
    {{csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Pregunta</label>
        <input type="text" name="pregunta" class="form-control"  placeholder="Pregunta">
    </div>
    <button type="submit" class="btn btn-default">Agregar</button>
</form>
</div>
<div id="Salud" class="tabcontent">
  <!-- Table-to-load-the-data Part -->
  <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Pregunta</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($habitos_salud as $habito)
            <tr>
                <td>{{$habito->pregunta}}</td>
                <td>
                  <form action="habitos/{{$habito->id}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                      <button class="btn btn-danger" type="submit">
                        Eliminar
                      </button>
                  </form>
                  <form action="habitos/{{$habito->id}}/edit" method="POST">
                    {{csrf_field()}}
                    {{method_field('GET')}}
                      <button class="btn btn-warning" type="submit">
                        Editar
                      </button>
                  </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <!-- Form for ingresing new "cargo"-->
<hr>
<h5>Nueva Pregunta</h5>
<form method="POST" action="habitos/salud" enctype="multipart/form-data">
    {{csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Pregunta</label>
        <input type="text" name="pregunta" class="form-control"  placeholder="Pregunta">
    </div>
    <button type="submit" class="btn btn-default">Agregar</button>
</form>
</div>
<div id="Nutricion" class="tabcontent">
  <!-- Table-to-load-the-data Part -->
  <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Pregunta</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($habitos_nutricion as $habito)
            <tr>
                <td>{{$habito->pregunta}}</td>
                <td>
                  <form action="habitos/{{$habito->id}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                      <button class="btn btn-danger" type="submit">
                        Eliminar
                      </button>
                  </form>
                  <form action="habitos/{{$habito->id}}/edit" method="POST">
                    {{csrf_field()}}
                    {{method_field('GET')}}
                      <button class="btn btn-warning" type="submit">
                        Editar
                      </button>
                  </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <!-- Form for ingresing new "cargo"-->
<hr>
<h5>Nueva Pregunta</h5>
<form method="POST" action="habitos/nutricion" enctype="multipart/form-data">
    {{csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Pregunta</label>
        <input type="text" name="pregunta" class="form-control"  placeholder="Pregunta">
    </div>
    <button type="submit" class="btn btn-default">Agregar</button>
</form>
</div>
</div>


<script>
function openSucursal(evt, sucursal) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    var j, subTabcontent, subTablinks;

    subTabcontent = document.getElementsByClassName("subTabcontent");
    for (j = 0; j < subTabcontent.length; j++) {
        subTabcontent[j].style.display = "none";
    }
    subTablinks = document.getElementsByClassName("subTablinks");
    for (j = 0; j < subTablinks.length; j++) {
        subTablinks[j].className = subTablinks[j].className.replace(" active", "");
    }
    document.getElementById(sucursal).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>
<style>
body {font-family: "Lato", sans-serif;}

/* Style the tab */
div.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
div.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
div.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
div.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
</style>

@endsection
