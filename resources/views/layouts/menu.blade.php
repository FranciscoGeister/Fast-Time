<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Fastfit') }}</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
    <!-- Styles -->
    @yield('styles')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Pacifico" />
</head>
<body>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <div class="navbar-header">
          <a class="navbar-brand" style="font-family: Pacifico;font-size: 24px;width:120px; color:blue">FastTime</a>
        </div>
        @guest
        <li ><a class="nav-link" href="{{ route('login') }}">Login</a></li>
        @else
        <li class="nav-item active">
          <a class="nav-link" href="{{url('home')}}">Inicio <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Administración
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{url('personal')}}">Personal</a>
            <a class="dropdown-item" href="{{ url('productos')}}">Productos</a>
            <a class="dropdown-item" href="#">Infraestructura</a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Operación
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{url('socios')}}">Ingresar socio</a>
            <a class="dropdown-item" href="{{url('ventaCortesiaIndex')}}">Sesiones de Cortesía</a>
            <a class="dropdown-item" href="{{url('agendar_hora')}}">Agendar Hora</a>
            <a class="dropdown-item" href="{{url('sell_products')}}">Venta</a>
            <a class="dropdown-item" href="{{url('deudas')}}">Saldar Deuda</a>
            <!--<a class="dropdown-item" href="">Control Asistencia</a>-->
            <a class="dropdown-item" href="{{url('fichaSesion')}}">Registro de Sesiones</a>
            <a class="dropdown-item" href="{{url('fichaPersonal')}}">Ficha socio</a>
            <a class="dropdown-item" href="{{url('fichaEvaluaciones')}}">Evaluaciones</a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Fidelización
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ url('campañas')}}">Campañas</a>
            <a class="dropdown-item" href="{{url('notifications')}}">Notificaciones</a>
            <!-- <a class="dropdown-item" href="{{url('encuesta/0')}}">Encuestas</a> -->
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Gestión
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ url('socios/consultas')}}">Consultas</a>
            <a class="dropdown-item" href="{{ url('inf_mensual')}}">Informe Mensual</a>
            <a class="dropdown-item" href="{{ url('ingresos')}}">Formas de Pago</a>
            <a class="dropdown-item" href="{{ url('inf_pagos')}}">Informe de Pagos</a>
            <a class="dropdown-item" href="{{ url('logs')}}">Logs de Ventas</a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Configuración
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
             <a class="dropdown-item" href="/register">Registrar Usuario</a>
             <a class="dropdown-item" href="{{ url('maquinas')}}">Máquinas</a>
             <a class="dropdown-item" href="{{ url('variables')}}">Parámetros</a>
          </div>
        </li>
        <li >
          <a class="nav-link" href="{{ route('logout') }}"
             onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            Salir
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
      </li>
@endguest
      </ul>
    </div>
  </nav>
        @yield('content')

    <!-- Script -->
    @yield('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>
