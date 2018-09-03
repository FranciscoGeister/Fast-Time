@extends('layouts.menu')

<link rel="STYLESHEET" type="text/css" href="{{ asset("css/titles.css") }}">

@section('content')


<div class="container">
<nav aria-label="breadcrumb">
  	<ol class="breadcrumb">
    	<li class="breadcrumb-item"><a>Operación</a></li>
    	<li class="breadcrumb-item"><a href="/fichaEvaluaciones">Registro de evaluaciones</a></li>
    	<li class="breadcrumb-item active" aria-current="page"><a>Ficha de evaluaciones</a></li>
  	</ol>
</nav>
<br>
<h3 class="title">Datos Personales</h3>
<h4 class="title">Socio: <span class="normal">{{ $member->nombre }} {{ $member->paterno }} {{ $member->materno }}</span></h4>
<h4 class="title">Fecha de nacimiento: <span class="normal">{{date_format(new DateTime($member->nacimiento), 'd-m-Y') }}</span></h4>
<h4 class="title">Email: <span class="normal">{{ $member->email }}</span></h4>
<br>

<h5 class="title">HISTORIAL MÉDICO</h5>
<textarea name="medical_history" rows="2">{{ $personalFile->medical_history }}</textarea>
<br>
<br>

<h5 class="title">META DE ENTRENAMIENTO</h5>
<textarea name="meta_entrenamiento" rows="2">{{ $personalFile->training_goal }}</textarea>
<br>
<br>

<div class="panel-group" id="accordion">
    <div class="panel panel-default">
      	<div class="panel-heading">
        	<h4 class="panel-title">
          	<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Evaluación inicial</a>
        	</h4>
      	</div>
    	<div id="collapse1" class="panel-collapse collapse in">
    		@foreach($evaluationSessions as $evaluation)
    			@if($evaluation->tipo==1)
    				<div class="col-sm-6">
    				<table class="table table-bordered">
			            <tr>
			            	<td>
			            		<div class="form-inline">
			                	<label>Fecha: &nbsp;</label>
			    				<span>{{date_format(new DateTime($evaluation->fecha), 'd-m-Y') }}</span>
			    				</div>
			    			</td>
			    			<td>
			    				<div class="form-inline">
			                	<label>Hora: &nbsp;</label>
			    				<span>{{substr($evaluation->hora, 0, -3)}}</span>
			    				</div>
			    			</td>				  
			            	<td>
			            		<div class="form-inline">
			            		<label>Peso: &nbsp;</label>
			    				<span>{{$evaluation->peso}}</span>
			    				</div>
			            	</td>
			            </tr>
			    	</table>
			    	</div>
			    	<div class="col-sm-6">
			    	<table class="table table-bordered">
			    		<tbody>
			            <tr>
			            	<td colspan="2"><span><b>Pliegues</b></span></td>
			            	<td colspan="2"><span><b>Contornos</b></span></td>
			            </tr>
			            <tr>
			            	<td>
			            		<label>Bicipital: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span >{{$evaluation->bicipital}}</span>
			            	</td>
			            	<td>
			            		<label>Pecho: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->pecho}}</span>			            		
			            	</td>
			            </tr>
			            <tr>
			            	<td>			            		
			            		<label>Tricipital: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->tricipital}}</span>
			            	</td>
			            	<td>			            		
			            		<label>Cintura: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->cintura}}</span>			            		
			            	</td>
			            </tr>
			            <tr>
			            	<td>			            		
			            		<label>Subescapular: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->subescapular}}</span>			            		
			            	</td>
			            	<td>			            		
			            		<label>Cont. Ilíaco: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->cont_iliaco}}</span>			            		
			            	</td>
			            </tr>
			            <tr>
			            	<td>			            		
			            		<label>Suprailiaco: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->suprailiaco}}</span>
			            	</td>
			            	<td>			            		
			            		<label>Cadera/Glúteo: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->cadera}}</span>			            		
			            	</td>
			            </tr>
			            <tr>
			            	<td>			            		
			            		<label><b>Total:</b> &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->total_pliegues}}</span>			            		
			            	</td>
			            	<td>			            		
			            		<label>Muslo: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->muslo}}</span>			            		
			            	</td>
			            </tr>
			            <tr>
			            	<td rowspan="2" colspan="2">
			            		<label><b>Coach:</b></label>
			            		<label>{{ $evaluation->first_name }} {{ $evaluation->last_name }}</label>
			            	</td>
			            	<td>			            		
			            		<label>Biceps Der.: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->bisep_der}}</span>			            		
			            	</td>
			            </tr>
			             <tr>				       
			            	<td>			            		
			            		<label><b>Total:</b> &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->total_cont}}</span>			            		
			            	</td>
			            </tr>    
			        </tbody>
			   		</table>
			   		<h3>Tareas</h3>
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
							@if($hw->evaluation_session_id==$evaluation->id)
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
		   		@endif
		   	@endforeach
	        <form action="/registroEvaluacion/create" method="POST">
		        {{csrf_field()}}
		        {{method_field('GET')}}
		        <input type="hidden" name="evaluation_sheet_id" value="{{ $evaluationSheet->id }}">
		        <input type="hidden" name="member_id" value="{{ $member->id }}">
		        <input type="hidden" name="tipo" value="1">
        		<button class="btn btn-primary" type="submit">Nueva evaluación inicial</button>
			</form>
    	</div>
    </div>
    <div class="panel panel-default">
    	<div class="panel-heading">
        	<h4 class="panel-title">
        	<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Evaluaciones intermedias</a>
        	</h4>
      	</div>
    	<div id="collapse2" class="panel-collapse collapse">
    		@foreach($evaluationSessions as $evaluation)
    			@if($evaluation->tipo==2)
    				<div class="col-sm-6">
    				<table class="table table-bordered">
        			<tbody>
			            <tr>
			            	<td>
			            		<div class="form-inline">
			                	<label>Fecha: &nbsp;</label>
			    				<span>{{date_format(new DateTime($evaluation->fecha), 'd-m-Y') }}</span>
			    				</div>
			    			</td>
			    			<td>
			    				<div class="form-inline">
			                	<label>Hora: &nbsp;</label>
			    				<span>{{substr($evaluation->hora, 0, -3)}}</span>
			    				</div>
			    			</td>				  
			            	<td>
			            		<div class="form-inline">
			            		<label>Peso: &nbsp;</label>
			    				<span>{{$evaluation->peso}}</span>
			    				</div>
			            	</td>
			            </tr>
			        </tbody>
			    	</table>
			    	</div>
			    	<div class="col-sm-6">
			    	<table class="table table-bordered">
			    		<tbody>
			            <tr>
			            	<td colspan="2"><span><b>Pliegues</b></span></td>
			            	<td colspan="2"><span><b>Contornos</b></span></td>
			            </tr>
			            <tr>
			            	<td>
			            		<label>Bicipital: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span >{{$evaluation->bicipital}}</span>
			            	</td>
			            	<td>
			            		<label>Pecho: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->pecho}}</span>			            		
			            	</td>
			            </tr>
			            <tr>
			            	<td>			            		
			            		<label>Tricipital: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->tricipital}}</span>
			            	</td>
			            	<td>			            		
			            		<label>Cintura: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->cintura}}</span>			            		
			            	</td>
			            </tr>
			            <tr>
			            	<td>			            		
			            		<label>Subescapular: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->subescapular}}</span>			            		
			            	</td>
			            	<td>			            		
			            		<label>Cont. Ilíaco: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->cont_iliaco}}</span>			            		
			            	</td>
			            </tr>
			            <tr>
			            	<td>			            		
			            		<label>Suprailiaco: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->suprailiaco}}</span>
			            	</td>
			            	<td>			            		
			            		<label>Cadera/Glúteo: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->cadera}}</span>			            		
			            	</td>
			            </tr>
			            <tr>
			            	<td>			            		
			            		<label><b>Total:</b> &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->total_pliegues}}</span>			            		
			            	</td>
			            	<td>			            		
			            		<label>Muslo: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->muslo}}</span>			            		
			            	</td>
			            </tr>
			            <tr>
			            	<td rowspan="2" colspan="2">
			            		<label><b>Coach:</b></label>
			            		<label>{{ $evaluation->first_name }} {{ $evaluation->last_name }}</label>
			            	</td>
			            	<td>			            		
			            		<label>Biceps Der.: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->bisep_der}}</span>			            		
			            	</td>
			            </tr>
			             <tr>				       
			            	<td>			            		
			            		<label><b>Total:</b> &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->total_cont}}</span>			            		
			            	</td>
			            </tr>     
			        </tbody>
			   		</table>

			   		<h3>Tareas</h3>
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
							@if($hw->evaluation_session_id==$evaluation->id)
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
			   		<hr>
			   		</div>
		   		@endif
		   	@endforeach
	    	<form action="/registroEvaluacion/create" method="POST">
		        {{csrf_field()}}
		        {{method_field('GET')}}
		        <input type="hidden" name="evaluation_sheet_id" value="{{ $evaluationSheet->id }}">
		        <input type="hidden" name="member_id" value="{{ $member->id }}">
		        <input type="hidden" name="tipo" value="2">
        		<button class="btn btn-primary" type="submit">Nueva evaluación intermedia</button>
			</form>    
    	</div>
    </div>
    <div class="panel panel-default">
      	<div class="panel-heading">
        	<h4 class="panel-title">
        	<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Evaluación final</a>
        	</h4>
      	</div>
    	<div id="collapse3" class="panel-collapse collapse">
    		@foreach($evaluationSessions as $evaluation)
    			@if($evaluation->tipo==3)
    				<div class="col-sm-6">
    				<table class="table table-bordered">
        			<tbody>
			            <tr>
			            	<td>
			            		<div class="form-inline">
			                	<label>Fecha: &nbsp;</label>
			    				<span>{{date_format(new DateTime($evaluation->fecha), 'd-m-Y') }}</span>
			    				</div>
			    			</td>
			    			<td>
			    				<div class="form-inline">
			                	<label>Hora: &nbsp;</label>
			    				<span>{{substr($evaluation->hora, 0, -3)}}</span>
			    				</div>
			    			</td>				  
			            	<td>
			            		<div class="form-inline">
			            		<label>Peso: &nbsp;</label>
			    				<span>{{$evaluation->peso}}</span>
			    				</div>
			            	</td>
			            </tr>
			        </tbody>
			    	</table>
			    	</div>
			    	<div class="col-sm-6">
			    	<table class="table table-bordered">
			    		<tbody>
			            <tr>
			            	<td colspan="2"><span><b>Pliegues</b></span></td>
			            	<td colspan="2"><span><b>Contornos</b></span></td>
			            </tr>
			            <tr>
			            	<td>
			            		<label>Bicipital: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span >{{$evaluation->bicipital}}</span>
			            	</td>
			            	<td>
			            		<label>Pecho: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->pecho}}</span>			            		
			            	</td>
			            </tr>
			            <tr>
			            	<td>			            		
			            		<label>Tricipital: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->tricipital}}</span>
			            	</td>
			            	<td>			            		
			            		<label>Cintura: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->cintura}}</span>			            		
			            	</td>
			            </tr>
			            <tr>
			            	<td>			            		
			            		<label>Subescapular: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->subescapular}}</span>			            		
			            	</td>
			            	<td>			            		
			            		<label>Cont. Ilíaco: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->cont_iliaco}}</span>			            		
			            	</td>
			            </tr>
			            <tr>
			            	<td>			            		
			            		<label>Suprailiaco: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->suprailiaco}}</span>
			            	</td>
			            	<td>			            		
			            		<label>Cadera/Glúteo: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->cadera}}</span>			            		
			            	</td>
			            </tr>
			            <tr>
			            	<td>			            		
			            		<label><b>Total:</b> &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->total_pliegues}}</span>			            		
			            	</td>
			            	<td>			            		
			            		<label>Muslo: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->muslo}}</span>			            		
			            	</td>
			            </tr>
			            <tr>
			            	<td rowspan="2" colspan="2">
			            		<label><b>Coach:</b></label>
			            		<label>{{ $evaluation->first_name }} {{ $evaluation->last_name }}</label>
			            	</td>
			            	<td>			            		
			            		<label>Biceps Der.: &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->bisep_der}}</span>			            		
			            	</td>
			            </tr>
			             <tr>				       
			            	<td>			            		
			            		<label><b>Total:</b> &nbsp;</label>
			            	</td>
			            	<td>
			            		<span>{{$evaluation->total_cont}}</span>			            		
			            	</td>
			            </tr>    
			        </tbody>
			   		</table>

			   		<h3>Tareas</h3>
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
							@if($hw->evaluation_session_id==$evaluation->id)
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
		   		@endif
		   	@endforeach
        	<form action="/registroEvaluacion/create" method="POST">
		        {{csrf_field()}}
		        {{method_field('GET')}}
		        <input type="hidden" name="evaluation_sheet_id" value="{{ $evaluationSheet->id }}">
		        <input type="hidden" name="member_id" value="{{ $member->id }}">
		        <input type="hidden" name="tipo" value="3">
        		<button class="btn btn-primary" type="submit">Nueva evaluación final</button>
			</form> 
    	</div>
  	</div>
</div>

<style>
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

	.table td{
			border-color: black;
		}

	hr { 
	    display: block;
	    margin-top: 0.5em;
	    margin-bottom: 0.5em;
	    margin-left: auto;
	    margin-right: auto;
	    border-width: 10px;
	    background-color: blue;
	} 
	
</style>

@endsection