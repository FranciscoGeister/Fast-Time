@extends('layouts.menu')
<link rel="STYLESHEET" type="text/css" href="{{ asset("css/titles.css") }}">

@section('content')

<div class="container">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a>Operación</a></li>
	    <li class="breadcrumb-item"><a href="/fichaSesion">Registro de sesiones</a></li>
	    <li class="breadcrumb-item active" aria-current="page"><a>Ficha de sesiones</a></li>
	  </ol>
	</nav>
	<br>
	<ul class="nav nav-pills">
	@for($i=0;$i<sizeof($cycles);$i++)
	    <li><a class="nav-link" data-toggle="pill" href="#cycle{{ $i }}">Ciclo {{ $i+1 }}</a></li>
	@endfor
	<form action="/cycles/create" method="POST">
	    {{csrf_field()}}
	    {{method_field('GET')}}
	    <input type="hidden" name="session_tab_id" value="{{ $sessionTab->id }}">
	    <input type="hidden" name="member_id" value="{{ $member->id }}">
		<button class="btn btn-primary" type="submit">Nuevo Ciclo</button>
	</form>
  	</ul>
  	<br>
  	<h3>Socio: {{ $member->nombre }} {{ $member->paterno }} {{ $member->materno }}</h3>
  	<br>

  	<div class="tab-content">
  		@for($i=0;$i<sizeof($cycles);$i++)
	    	<div id="cycle{{ $i }}" class="tab-pane fade">
				<div class="row">
					<div class="form-group col-sm-4">
						<div class="form-inline">
							<span>Encuesta: &nbsp;</span>
							<a  href="{{url('encuesta/' .$member->id)}}">Ver Encuesta</a>
						</div>
					    <div class="form-inline">
						    <span>Coach: &nbsp;</span>
					        @foreach($coaches as $coach)
					        @if($coach->id==$cycles[$i]->coach_id)
					            <label>{{ $coach->first_name }} {{ $coach->last_name }}</label>
					        @endif
					        @endforeach
					    </div>
					    <div class="form-inline">
					    	<span>Fecha: &nbsp;</span>
					    	<label>{{date_format(new DateTime($cycles[$i]->date), 'd-m-Y') }}</label>
					    </div>
					</div>
					<div class="form-group col-sm-4">
						<h4 class="title">Estímulo:</h4>
						@if($cycles[$i]->metabolic==1)
							<input type="checkbox" name="metabolic" checked disabled>Metabólico<br>
						@else
							<input type="checkbox" name="metabolic" disabled>Metabólico<br>
						@endif
						@if($cycles[$i]->tonification==1)
							<input type="checkbox" name="tonification" checked disabled>Tonificación<br>
						@else
							<input type="checkbox" name="tonification" disabled>Tonificación<br>
						@endif
						@if($cycles[$i]->recuperation==1)
							<input type="checkbox" name="recuperation" checked disabled>Recuperación<br>
						@else
							<input type="checkbox" name="recuperation" disabled>Recuperación<br>
						@endif
					</div>
					<div class="form-group col-sm-4">
						<h4 class="title">Obj. Ciclo:</h4>
						@if($cycles[$i]->cycle_obj=="Ajuste")
							<input type="checkbox" name="adjustment" checked disabled>Ajuste<br>
						@else
							<input type="checkbox" name="adjustment" disabled>Ajuste<br>
						@endif
						@if($cycles[$i]->cycle_obj=="Carga")
							<input type="checkbox" name="load" checked disabled>Carga<br>
						@else
							<input type="checkbox" name="load" disabled>Carga<br>
						@endif
						@if($cycles[$i]->cycle_obj=="Impacto")
							<input type="checkbox" name="impact" checked disabled>Impacto<br>
						@else
							<input type="checkbox" name="impact" disabled>Impacto<br>
						@endif
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-4">
						<h4 class="title">Obj. Macro:</h4>
						@if($cycles[$i]->stabilization==1)
							<input type="checkbox" name="stabilization" checked disabled>estabilización<br>
						@else
							<input type="checkbox" name="stabilization" disabled>Estabilización<br>
						@endif
						@if($cycles[$i]->acc_metab==1)
							<input type="checkbox" name="acc_metab" checked disabled>Acc. Metabólico<br>
						@else
							<input type="checkbox" name="acc_metab" disabled>Acc. Metabólico<br>
						@endif
						@if($cycles[$i]->strength==1)
							<input type="checkbox" name="strength" checked disabled>Fuerza<br>
						@else
							<input type="checkbox" name="strength" disabled>Fuerza<br>
						@endif
					</div>
					<div class="form-group col-sm-4">
						<h4 class="title">Tiempo Sección:</h4>
						<table>
							<tr>
								<td>Warm Up:</td>
								<td>{{ $cycles[$i]->warm_up_time }}</td>
							</tr>
							<tr>
								<td>Estab/Com:</td>
								<td>{{ $cycles[$i]->stabilization_time }}</td>
							</tr>
							<tr>
								<td>Fuerza:</td>
								<td>{{ $cycles[$i]->strength_time }}</td>
							</tr>
							<tr>
								<td>ACC Metab.:</td>
								<td>{{ $cycles[$i]->acc_metab_time }}</td>
							</tr>
						</table>
					</div>
					<div class="form-group col-sm-4">
						<h4 class="title">RPE Objetivo Ciclo:</h4>
						<table>
							<tr>
								<td>Warm Up:</td>
								<td>{{ $cycles[$i]->rpe_wu_min }} - {{ $cycles[$i]->rpe_wu_max }}</td>
							</tr>
							<tr>
								<td>Estab/Com:</td>
								<td>{{ $cycles[$i]->rpe_stab_min }} - {{ $cycles[$i]->rpe_stab_max }}</td>
							</tr>
							<tr>
								<td>Fuerza:</td>
								<td>{{ $cycles[$i]->rpe_str_min }} - {{ $cycles[$i]->rpe_str_max }}</td>
							</tr>
							<tr>
								<td>ACC Metab.:</td>
								<td>{{ $cycles[$i]->rpe_acc_min }} - {{ $cycles[$i]->rpe_acc_max }}</td>
							</tr>
						</table>
					</div>
				</div>
				<center><h3>Prioridades del Ciclo</h3></center>
				<div class="row">
					<div class="form-group col-sm-6">
						<h3 class="title">Warm Up:</h3>
						<table>
							<tr>
								<td>Plio 0:</td>
								<td>{{ $cycles[$i]->plio_0 }}</td>
							</tr>
							<tr>
								<td>Plio 1:</td>
								<td>{{ $cycles[$i]->plio_1 }}</td>
							</tr>
							<tr>
								<td>Desplaz.:</td>
								<td>{{ $cycles[$i]->wu_displacement }}</td>
							</tr>
							<tr>
								<td>Desplaz. + Res.:</td>
								<td>{{ $cycles[$i]->displacement_plus }}</td>
							</tr>
							<tr>
								<td>Movilidad Art.:</td>
								<td>{{ $cycles[$i]->mov_arti }}</td>
							</tr>
						</table>
					</div>
					<div class="form-group col-sm-6">
						<h3 class="title">Estabilización:</h3>
						<table>
							<tr>
								<td>Anti Flex. SUP:</td>
								<td>{{ $cycles[$i]->anti_flex_sup }}</td>
							</tr>
							<tr>
								<td>Anti Flex PRO:</td>
								<td>{{ $cycles[$i]->anti_flex_pro }}</td>
							</tr>
							<tr>
								<td>Anti Flex LATER:</td>
								<td>{{ $cycles[$i]->anti_flex_later }}</td>
							</tr>
							<tr>
								<td>Anti Rotación:</td>
								<td>{{ $cycles[$i]->anti_rotation }}</td>
							</tr>
							<tr>
								<td>Anti Extensión:</td>
								<td>{{ $cycles[$i]->anti_extension }}</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-6">
						<h3 class="title">Fuerza:</h3>
						<table>
							<tr>
								<td>F-E Cadera:</td>
								<td>{{ $cycles[$i]->fe_hip }}</td>
							</tr>
							<tr>
								<td>Rodilla Dom.:</td>
								<td>{{ $cycles[$i]->knee_dom }}</td>
							</tr>
							<tr>
								<td>Empujón Vert.:</td>
								<td>{{ $cycles[$i]->vert_push }}</td>
							</tr>
							<tr>
								<td>Empujón Hor.:</td>
								<td>{{ $cycles[$i]->horiz_push }}</td>
							</tr>
							<tr>
								<td>Tirón Vert.:</td>
								<td>{{ $cycles[$i]->vert_pull }}</td>
							</tr>
							<tr>
								<td>Tirón Hor.:</td>
								<td>{{ $cycles[$i]->horiz_pull }}</td>
							</tr>
							<tr>
								<td>Rotaciones:</td>
								<td>{{ $cycles[$i]->rotations }}</td>
							</tr>
						</table>
					</div>
					<div class="form-group col-sm-6">
						<h3 class="title">Acc. Metabólica:</h3>
						<table>
							<tr>
								<td>Burpee:</td>
								<td>{{ $cycles[$i]->burpee }}</td>
							</tr>
							<tr>
								<td>Lanzamientos:</td>
								<td>{{ $cycles[$i]->throwings }}</td>
							</tr>
							<tr>
								<td>Pliométrico:</td>
								<td>{{ $cycles[$i]->pliometrico }}</td>
							</tr>
							<tr>
								<td>Desplaz.:</td>
								<td>{{ $cycles[$i]->displacement }}</td>
							</tr>
							<tr>
								<td>Step:</td>
								<td>{{ $cycles[$i]->step }}</td>
							</tr>
							<tr>
								<td>TRX:</td>
								<td>{{ $cycles[$i]->trx }}</td>
							</tr>
							<tr>
								<td>BOX:</td>
								<td>{{ $cycles[$i]->box }}</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<h4 class="title">Historial Médico</h4>
						<textarea name="medical_history" rows="2">{{ $personalFile->medical_history }}</textarea>
					</div>
					<div class="col-sm-6">
						<h4 class="title">Meta de Entrenamiento</h4>
	    				<textarea name="training_goal" rows="2">{{ $personalFile->training_goal }}</textarea>
    				</div>
    			</div>
    			<div class="row">
    				<div class="col-sm-12">
						<h4 class="title">Notas</h4>
						<textarea name="note" rows="2">{{ $cycles[$i]->note }}</textarea>
					</div>				
    			</div>
				<hr size="8px" color="black" />
				<h2 class="title">Sesiones:</h2>

				<?php $cont = 1; ?>
				@foreach($sessionRecords as $sr)
					@if($sr->cycle_id==$cycles[$i]->id)
						<div class="card">
					    	<div class="card-header" id="headingOne">
					        	<h5 class="mb-0">
					          		<a data-toggle="collapse" href="#collapse{{ $i }}{{ $cont }}"><h4><b>Sesión {{ $cont }}</b></h4></a>
					        	</h5>
					      	</div>
					      	<div id="collapse{{ $i }}{{ $cont }}" class="collapse" aria-labelledby="headingOne">
					        	<div class="card-body">
				    			    <label>Coach:</label>
							        @foreach($coaches as $coach)
							        @if($coach->id==$cycles[$i]->coach_id)
							            <label>{{ $coach->first_name }} {{ $coach->last_name }}</label>
							        @endif
							        @endforeach
							        <br>
							        <div class="form-inline">
									<label>Fecha: &nbsp;</label>
									<label>{{date_format(new DateTime($sr->date), 'd-m-Y') }}</label>							
									</div>
									<br>

									<table class="table table-bordered table-responsive" cellpadding="10">
										<thead>
											<th colspan="3">Warm Up ({{ $sr->r_or_t_wu }})</th>
											<th colspan="3">Estabilización ({{ $sr->r_or_t_est }})</th>
										</thead>
										<tbody>
											<tr align="center">
												<td>Ejercicio</td>
												<td>Serie</td>
												<td>Repetición</td>
												<td>Ejercicio</td>
												<td>Serie</td>
												<td>Repetición</td>
											</tr>
											<tr style="text-align: center">
												<td><span>{{ $sr->wu_o_1 }}</span></td>
												<td><label>{{ $sr->wu_s_1 }}</label></td>
												<td><label>{{ $sr->wu_r_1 }}</label></td>
												<td><span>{{ $sr->est_o_1}}</span></td>
												<td><label>{{ $sr->est_s_1 }}</label></td>
												<td><label>{{ $sr->est_r_1 }}</label></td>
											</tr>
											<tr style="text-align: center">
												<td ><span>{{ $sr->wu_o_2 }}</span></td>
												<td><label>{{ $sr->wu_s_2 }}</label></td>
												<td><label>{{ $sr->wu_r_2 }}</label></td>
												<td><span>{{ $sr->est_o_2 }}</span></td>
												<td><label>{{ $sr->est_s_2 }}</label></td>
												<td><label>{{ $sr->est_r_2 }}</label></td>
											</tr>
											<tr style="text-align: center">
												<td><span>{{ $sr->wu_o_3 }}</span></td>
												<td><label>{{ $sr->wu_s_3 }}</td>
												<td><label>{{ $sr->wu_r_3 }}</td>
												<td><span>{{ $sr->est_o_3 }}</span></td>
												<td><label>{{ $sr->est_s_3 }}</label></td>
												<td><label>{{ $sr->est_r_3 }}</label></td>
											</tr>
											<tr style="text-align: center">
												<td><span>{{ $sr->wu_o_4 }}</span></td>
												<td><label>{{ $sr->wu_s_4 }}</label></td>
												<td><label>{{ $sr->wu_r_4 }}</label></td>
												<td><span>{{ $sr->est_o_4 }}</span></td>
												<td><label>{{ $sr->est_s_4 }}</label></td>
												<td><label>{{ $sr->est_r_4 }}</label></td>
											</tr>
											<tr>
												<td colspan="3">
													<label>RPE Warm Up:</label>
													@if($cycles[$i]->rpe_wu_min<=$sr->rpe_wu&&$sr->rpe_wu<=$cycles[$i]->rpe_wu_max)
													<label style="color: green">{{ $sr->rpe_wu }}</label>
													@else
														<label style="color: red">{{ $sr->rpe_wu }}</label>
													@endif
												</td>
												<td colspan="3">
													<label>RPE estabilización:</label>
													@if($cycles[$i]->rpe_stab_min<=$sr->rpe_stab&&$sr->rpe_stab<=$cycles[$i]->rpe_stab_max)
														<label style="color: green">{{ $sr->rpe_stab }}</label>											
													@else
														<label style="color: red">{{ $sr->rpe_stab }}</label>
													@endif
												</td>
											</tr>
										</tbody>
									</table>
									<table class="table table-bordered table-responsive">
										<thead>
											<th colspan="4">Fuerza ({{ $sr->r_or_t_str }})</th>
										</thead>
										<tbody>
											<tr align="center">
												<td>Ejercicio</td>
												<td>Serie</td>
												<td>Repetición</td>
												<td>Peso (Kg.)</td>
											</tr>
											<tr style="text-align: center">
												<td><span>{{ $sr->str_o_1 }}</span></td>
												<td><label>{{ $sr->str_s_1 }}</label></td>
												<td><label>{{ $sr->str_r_1 }}</label></td>
												<td><label>{{ $sr->str_w_1 }}</label></td>
											</tr>
											<tr style="text-align: center">
												<td>
													<span>{{ $sr->str_o_2 }}</span>
												</td>
												<td><label>{{ $sr->str_s_2 }}</label></td>
												<td><label>{{ $sr->str_r_2 }}</label></td>
												<td><label>{{ $sr->str_w_2 }}</label></td>
											</tr>
											<tr style="text-align: center">
												<td><span>{{ $sr->str_o_3 }}</span></td>
												<td><label>{{ $sr->str_s_3 }}</label></td>
												<td><label>{{ $sr->str_r_3 }}</label></td>
												<td><label>{{ $sr->str_w_3 }}</label></td>
											</tr>
											<tr style="text-align: center">
												<td><span>{{ $sr->str_o_4 }}</span></td>
												<td><label>{{ $sr->str_s_4 }}</label></td>
												<td><label>{{ $sr->str_r_4 }}</label></td>
												<td><label>{{ $sr->str_w_4 }}</label></td>
											</tr>
											<tr>
												<td colspan="4">
													<label>RPE Fuerza:</label>
													@if($cycles[$i]->rpe_str_min<=$sr->rpe_str&&$sr->rpe_str<=$cycles[$i]->rpe_str_max)
														<label style="color: green">{{ $sr->rpe_str }}</label>
													@else
														<label style="color: red">{{ $sr->rpe_str }}</label>
													@endif
												</td>
											</tr>
										</tbody>
									</table>
									<table class="table table-bordered table-responsive">
										<thead>
											<th colspan="3">Acc. Metabólica ({{ $sr->r_or_t_acc }})</th>
										</thead>
										<tbody>
											<tr align="center">
												<td>Ejercicio</td>
												<td>Serie</td>
												<td>Repetición</td>
											</tr>
											<tr style="text-align: center">
												<td><span>{{ $sr->acc_o_1 }}</span></td>
												<td><label>{{ $sr->acc_s_1 }}</label></td>
												<td><label>{{ $sr->acc_r_1 }}</label></td>
											</tr>
											<tr style="text-align: center">
												<td><span>{{ $sr->acc_o_2 }}</span></td>
												<td><label>{{ $sr->acc_s_2 }}</label></td>
												<td><label>{{ $sr->acc_r_2 }}</label></td>
											</tr>
											<tr style="text-align: center">
												<td><span>{{ $sr->acc_o_3 }}</span></td>
												<td><label>{{ $sr->acc_s_3 }}</label></td>
												<td><label>{{ $sr->acc_r_3 }}</label></td>
											</tr>
											<tr style="text-align: center">
												<td><span>{{ $sr->acc_o_4 }}</span></td>
												<td><label>{{ $sr->acc_s_4 }}</label></td>
												<td><label>{{ $sr->acc_r_4 }}</label></td>
											</tr>
											<tr>
												<td colspan="3">
													<label>RPE Acc. Metat.:</label>
													@if($cycles[$i]->rpe_acc_min<=$sr->rpe_acc&&$sr->rpe_acc<=$cycles[$i]->rpe_acc_max)
														<label style="color: green">{{ $sr->rpe_acc }}</label>
													@else
														<label style="color: red">{{ $sr->rpe_acc }}</label>								
													@endif
												</td>
											</tr>
										</tbody>
									</table>
									<h3 class="title">Notas sesión:</h3>
									<textarea name="notes" rows="2">{{ $sr->notes }}</textarea>
									<br>
									<br>

									<h3 class="title">Tareas</h3>
									<table class="table table-bordered table-responsive">
										<thead>
											<td>Nombre</td>
											<td>Sigla</td>
											<td>Series</td>
											<td>Repeticiones</td>
											<td>Descanso (seg.)</td>
										</thead>
										<tbody>
											@foreach($homeworks as $hw)
											@if($hw->session_record_id==$sr->id)
											<tr style="text-align: center">
												<td>{{ $hw->nombre }}</td>
												<td>{{ $hw->sigla }}</td>
												<td>{{ $hw->series }}</td>
												<td>{{ $hw->repetitions }}</td>
												<td>{{ $hw->rest }}</td>
											</tr>
											@endif
											@endforeach
										</tbody>

									</table>

					        	</div>
					      	</div>
					    </div>
					    <?php $cont++; ?>
					@endif
				@endforeach
				<form action="/registroSesion/create" method="POST">
				    {{csrf_field()}}
				    {{method_field('GET')}}
				    <input type="hidden" name="member_id" value="{{ $member->id }}">
				    <input type="hidden" name="session_tab_id" value="{{ $sessionTab->id }}">
				    <input type="hidden" name="cycle_id" value="{{ $cycles[$i]->id }}">
					<button class="btn btn-primary" type="submit">Nueva Sesión</button>
				</form>
			</div>
		@endfor

	</div>
</div>

<style type="text/css">



.size{
		width: 80px;
	}
textarea {
    width: 100%;
    height: 100px;
    padding: 12px 20px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
    resize: none;
}
.title{
    color: maroon;
}

table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
}
</style>

@endsection
