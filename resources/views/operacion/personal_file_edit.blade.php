@extends('layouts.menu')

<link rel="STYLESHEET" type="text/css" href="{{ asset("css/titles.css") }}">

@section('content')

<div class="container">
	<nav aria-label="breadcrumb">
    	<ol class="breadcrumb">
    		<li class="breadcrumb-item"><a>Operación</a></li>
		    <li class="breadcrumb-item"><a href="/fichaPersonal">Ficha Personal</a></li>
		    <li class="breadcrumb-item active" aria-current="page"><a>Datos Ficha Personal</a></li>
		</ol>
	</nav>
	<br>
	<h3 class="title">Datos personales:</h3>
	<br>
	<h4 class="title">Socio: <span class="normal">{{ $member->nombre }} {{ $member->paterno }} {{ $member->materno }}</span></h4>
	<h4 class="title">Fecha de nacimiento: <span class="normal">{{date_format(new DateTime($member->nacimiento), 'd-m-Y') }}</span></h4>
	<h4 class="title">RUT: <span class="normal">{{ $member->rut }}</span></h4><br>

	<form method="POST" action="/fichaPersonal/{{$personalFile->id}}">
	  	{{csrf_field() }}
	  	{{ method_field('PUT') }}
	  	
  		<h3 class="title">Tipo chaleco</h3>
		<div class="row">
			<div class="col-md-1">
  				<label><b>Chaleco:</b></label>
  			</div>
  			<div class="col-md-2">
  				<select class="form-control" name="vest_gender">
  					@if($personalFile->vest_gender=="m")
        				<option value="m" selected>Mujer</option>
        				<option value="h">Hombre</option>
        			@else
    					<option value="h" selected>Hombre</option>
    					<option value="m">Mujer</option>
    				@endif
    			</select>
			</div>
		</div>
		<h3 class="title">Tallas</h3>
		<div class="row">
			<div class="col-md-1">
	    		<label><b>Chaleco:</b></label>
	    	</div>
	    	<div class="col-md-1">
	    		<select class="form-control" name="vest_size">
	        		@foreach($sizes as $size)
	        			@if($personalFile->vest_size==$size->nombre)
	            			<option value="{{ $size->nombre }}" selected>{{ $size->nombre }}</option>
	           			@else
							<option value="{{ $size->nombre }}">{{ $size->nombre }}</option>
						@endif
	        		@endforeach
	    		</select>
	    	</div>
	    </div>
		<div class="row">
			<div class="col-md-1">
	    		<label><b>Brazos:</b></label>
	    	</div>
	    	<div class="col-md-1">
	    		<select class="form-control" name="arm_size">
	        		@foreach($sizes as $size)
	        			@if($personalFile->arm_size==$size->nombre)
	            			<option value="{{ $size->nombre }}" selected>{{ $size->nombre }}</option>
	           			@else
							<option value="{{ $size->nombre }}">{{ $size->nombre }}</option>
						@endif
	        		@endforeach
	    		</select>
	    	</div>
	    </div>
	    <div class="row">
	    	<div class="col-md-1">
	    		<label><b>Glúteos:</b></label>
	    	</div>
	    	<div class="col-md-1">
	    		<select class="form-control" name="glute_size">
			        @foreach($sizes as $size)
			            @if($personalFile->glute_size==$size->nombre)
			            	<option value="{{ $size->nombre }}" selected>{{ $size->nombre }}</option>
			            @else
							<option value="{{ $size->nombre }}">{{ $size->nombre }}</option>
						@endif
			        @endforeach
	    		</select>
	    	</div>
	    </div>
	    <div class="row">
	    	<div class="col-md-1">
	    		<label><b>Piernas:</b></label>
	    	</div>
		    <div class="col-md-1">
			    <select class="form-control" name="leg_size">
			        @foreach($sizes as $size)
			            @if($personalFile->leg_size==$size->nombre)
			            	<option value="{{ $size->nombre }}" selected>{{ $size->nombre }}</option>
			            @else
							<option value="{{ $size->nombre }}">{{ $size->nombre }}</option>
						@endif
			        @endforeach
			    </select>
			</div>
	    </div>
    	<br>
    	<h4 class="title">Historial Médico</h4>
    	<textarea name="medical_history" rows="2">{{ $personalFile->medical_history }}</textarea>
    	<br>
    	<h4 class="title">Meta de Entrenamiento</h4>
    	<textarea name="training_goal" rows="2">{{ $personalFile->training_goal }}</textarea>
    	<br>
    	<button class="btn btn-primary" type="submit">Guardar</button>
    </form>
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
</style>



@endsection
