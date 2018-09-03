@extends('layouts.menu')
<link rel="STYLESHEET" type="text/css" href="{{ asset("css/titles.css") }}">

@section('content')

<div class="container">
	<form method="POST" action="/cycles">
		{{csrf_field()}}
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a>Operación</a></li>
		    <li class="breadcrumb-item"><a href="/fichaSesion">Registro de sesiones</a></li>
		    <li class="breadcrumb-item"><a href="/fichaSesion/{{ $member->id }}">Ficha de sesiones</a></li>
		    <li class="breadcrumb-item active" aria-current="page"><a>Nuevo Ciclo</a></li>
		  </ol>
		</nav>
		<br>
		<div class="row">
			<div class="form-group col-sm-4">
				<div class="form-inline">
				<label>Socio:</label>
				<label>{{ $member->nombre }} {{ $member->paterno }}</label>
				</div>
			    <div class="form-inline">
				    <label>Coach:</label>
				    <select class="form-control" name="coach_id">
				        @foreach($coaches as $coach)
				            <option value="{{ $coach->id }}">{{ $coach->first_name }} {{ $coach->last_name }}</option>
				        @endforeach
				    </select>
			    </div>
			    <div class="form-inline">
			    	<label class="control-label">Fecha: </label>
			    	<input type="date" class="form-control" name="date" value="{{ date('Y-m-d') }}">
			    </div>
			</div>
			<div class="form-group col-sm-4">
				<h4 class="title">Estímulo:</h4>
				<input type="checkbox" name="metabolic" value="1">Metabólico<br>
				<input type="checkbox" name="tonification" value="1">Tonificación<br>
				<input type="checkbox" name="recuperation" value="1">Recuperación<br>
			</div>
			<div class="form-group col-sm-4">
				<h4 class="title">Obj. Ciclo:</h4>
				<input type="radio" name="cycle_obj" class="cycle_obj" value="Ajuste">Ajuste<br>			
				<input type="radio" name="cycle_obj" class="cycle_obj" value="Carga">Carga<br>
				<input type="radio" name="cycle_obj" class="cycle_obj" value="Impacto">Impacto<br>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-sm-4">
				<h4 class="title">Obj. Macro:</h4>			
				<input type="checkbox" name="stabilization" value="1">Estabilización<br>			
				<input type="checkbox" name="acc_metab" value="1">Acc. Metabólico<br>
				<input type="checkbox" name="strength" value="1">Fuerza<br>			
			</div>
			<div class="form-group col-sm-4">
				<h4 class="title">Tiempo Sección:</h4>
				<div class="form-inline">
					<label>Warm Up:</label>
					<input type="number" class="form-control col-sm-3" name="warm_up_time">
				</div>
				<div class="form-inline">
					<label>Estab/Com:</label>
					<input type="number" class="form-control col-sm-3" name="stabilization_time">
				</div>
				<div class="form-inline">
					<label>Fuerza:</label>
					<input type="number" class="form-control col-sm-3" name="strength_time">
				</div>
				<div class="form-inline">
					<label>ACC Metab.:</label>
					<input type="number" class="form-control col-sm-3" name="acc_metab_time">
				</div>
			</div>
			<div class="form-group col-sm-4">
				<h4 class="title">RPE Objetivo Ciclo:</h4>
				<div class="form-inline">
					<label>Warm Up:</label>
					<input type="float" class="form-control col-sm-2" name="rpe_wu_min" id="rpe_wu_min">
					<input type="float" class="form-control col-sm-2" name="rpe_wu_max" id="rpe_wu_max">
				</div>
				<div class="form-inline">
					<label>Estab/Com:</label>
					<input type="float" class="form-control col-sm-2" name="rpe_stab_min" id="rpe_stab_min">
					<input type="float" class="form-control col-sm-2" name="rpe_stab_max" id="rpe_stab_max">
				</div>
				<div class="form-inline">
					<label>Fuerza:</label>
					<input type="float" class="form-control col-sm-2" name="rpe_str_min" id="rpe_str_min">
					<input type="float" class="form-control col-sm-2" name="rpe_str_max" id="rpe_str_max">
				</div>
				<div class="form-inline">
					<label>ACC Metab.:</label>
					<input type="float" class="form-control col-sm-2" name="rpe_acc_min" id="rpe_acc_min">
					<input type="float" class="form-control col-sm-2" name="rpe_acc_max" id="rpe_acc_max">
				</div>
			</div>
		</div>
		<center><h3>Prioridades del Ciclo</h3></center>
		<br>

		<div class="row">
			<div class="form-group col-sm-6">
				<h3 class="title">Warm Up:</h3>
				<div class="form-inline">
					<label>Plio 0:</label>
					<input type="number" class="form-control col-sm-2" name="plio_0">
				</div>
				<div class="form-inline">
					<label>Plio 1:</label>
					<input type="number" class="form-control col-sm-2" name="plio_1">
				</div>
				<div class="form-inline">
					<label>Desplaz.:</label>
					<input type="number" class="form-control col-sm-2" name="wu_displacement">
				</div>
				<div class="form-inline">
					<label>Desplaz. + Res.:</label>
					<input type="number" class="form-control col-sm-2" name="displacement_plus">
				</div>
				<div class="form-inline">
					<label>Movilidad Art.:</label>
					<input type="number" class="form-control col-sm-2" name="mov_arti">
				</div>
			</div>
			<div class="form-group col-sm-6">
				<h3 class="title">Estabilización:</h3>
				<div class="form-inline">
					<label>Anti Flex. SUP:</label>
					<input type="number" class="form-control col-sm-2" name="anti_flex_sup">
				</div>
				<div class="form-inline">
					<label>Anti Flex PRO:</label>
					<input type="number" class="form-control col-sm-2" name="anti_flex_pro">
				</div>
				<div class="form-inline">
					<label>Anti Flex LATER:</label>
					<input type="number" class="form-control col-sm-2" name="anti_flex_later">
				</div>
				<div class="form-inline">
					<label>Anti Rotación:</label>
					<input type="number" class="form-control col-sm-2" name="anti_rotation">
				</div>
				<div class="form-inline">
					<label>Anti Extensión:</label>
					<input type="number" class="form-control col-sm-2" name="anti_extension">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-sm-6">
				<h3 class="title">Fuerza:</h3>
				<div class="form-inline">
					<label>F-E Cadera:</label>
					<input type="number" class="form-control col-sm-2" name="fe_hip">
				</div>
				<div class="form-inline">
					<label>Rodilla Dom.:</label>
					<input type="number" class="form-control col-sm-2" name="knee_dom">
				</div>
				<div class="form-inline">
					<label>Empujón Vert.:</label>
					<input type="number" class="form-control col-sm-2" name="vert_push">
				</div>
				<div class="form-inline">
					<label>Empujón Hor.:</label>
					<input type="number" class="form-control col-sm-2" name="horiz_push">
				</div>
				<div class="form-inline">
					<label>Tirón Vert.:</label>
					<input type="number" class="form-control col-sm-2" name="vert_pull">
				</div>
				<div class="form-inline">
					<label>Tirón Hor.:</label>
					<input type="number" class="form-control col-sm-2" name="horiz_pull">
				</div>
				<div class="form-inline">
					<label>Rotaciones:</label>
					<input type="number" class="form-control col-sm-2" name="rotations">
				</div>
			</div>
			<div class="form-group col-sm-6">
				<h3 class="title">Acc. Metabólica:</h3>
				<div class="form-inline">
					<label>Burpee:</label>
					<input type="number" class="form-control col-sm-2" name="burpee">
				</div>
				<div class="form-inline">
					<label>Lanzamientos:</label>
					<input type="number" class="form-control col-sm-2" name="throwings">
				</div>
				<div class="form-inline">
					<label>Pliométrico:</label>
					<input type="number" class="form-control col-sm-2" name="pliometrico">
				</div>
				<div class="form-inline">
					<label>Desplaz.:</label>
					<input type="number" class="form-control col-sm-2" name="displacement">
				</div>
				<div class="form-inline">
					<label>Step:</label>
					<input type="number" class="form-control col-sm-2" name="step">
				</div>
				<div class="form-inline">
					<label>TRX:</label>
					<input type="number" class="form-control col-sm-2" name="trx">
				</div>
				<div class="form-inline">
					<label>BOX:</label>
					<input type="number" class="form-control col-sm-2" name="box">
				</div>
			</div>
		</div>
		<h4 class="title">Notas</h4>
    	<textarea name="note" rows="2"></textarea>
		<input type="hidden" name="member_id" value="{{ $member->id }}">
		<input type="hidden" name="session_tab_id" value="{{ $session_tab_id }}">
		<button class="btn btn-primary" type="submit">Crear</button>
	</form>
</div>

<script type="text/javascript">
	$(document).on('click','.cycle_obj',function(){
		if ($(this).val()=="Ajuste") {
			document.getElementById('rpe_wu_min').value="4";
			document.getElementById('rpe_wu_max').value="5";
			document.getElementById('rpe_stab_min').value="5";
			document.getElementById('rpe_stab_max').value="6";
			document.getElementById('rpe_str_min').value="5";
			document.getElementById('rpe_str_max').value="6";
			document.getElementById('rpe_acc_min').value="7";
			document.getElementById('rpe_acc_max').value="8";
		}
		if ($(this).val()=="Carga") {
			document.getElementById('rpe_wu_min').value="5";
			document.getElementById('rpe_wu_max').value="6";
			document.getElementById('rpe_stab_min').value="5";
			document.getElementById('rpe_stab_max').value="7";
			document.getElementById('rpe_str_min').value="7";
			document.getElementById('rpe_str_max').value="9";
			document.getElementById('rpe_acc_min').value="7";
			document.getElementById('rpe_acc_max').value="9";
		}
		if ($(this).val()=="Impacto") {
			document.getElementById('rpe_wu_min').value="4";
			document.getElementById('rpe_wu_max').value="6";
			document.getElementById('rpe_stab_min').value="5";
			document.getElementById('rpe_stab_max').value="8";
			document.getElementById('rpe_str_min').value="7";
			document.getElementById('rpe_str_max').value="10";
			document.getElementById('rpe_acc_min').value="7";
			document.getElementById('rpe_acc_max').value="10";
		}

	});
</script>

<style type="text/css">
	div label {
  	width: 60%;
  	float: left;
}
textarea {
    width: 100%;
    height: 150px;
    padding: 12px 20px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
    resize: none;
}
</style>

@endsection
