@extends('layouts.menu')

@section('content')

<div class="container">
	<form method="POST" action="/registroSesion">
		{{csrf_field()}}
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a>Operación</a></li>
		    <li class="breadcrumb-item"><a href="#" id="back" onclick="confirmar()">Registro de sesiones</a></li>
		    <li class="breadcrumb-item"><a href="#" id="back2" onclick="confirmar2()">Ficha de sesiones</a></li>
		    <li class="breadcrumb-item active" aria-current="page"><a>Nueva Sesión</a></li>
		  </ol>
		</nav>
		<br>
			
		<div class="row">
			<div class="col">
				<label class="col-sm-2">Coach:</label>
				<select class="form-control col-sm-6" name="coach_id">
		        @foreach($profesionals as $profesional)
		            <option value="{{ $profesional->id }}">{{ $profesional->first_name }} {{ $profesional->last_name }}</option>
		        @endforeach
	    		</select>
			</div>
			<div class="col">
				<label class="col-sm-2">Fecha:</label>
				<input class="form-control col-sm-6" type="date" name="date" value="{{ date('Y-m-d') }}">
			</div>
		</div>		
		<br>			
		
		<table class="table table-bordered table-responsive">
			<thead align="center">
				<th colspan="3">Warm Up
								<select class="form-control col-md-5" name="r_or_t_wu">
									<option value="Repeticiones">Repeteciones</option>
									<option value="Tiempo">Tiempo</option>
								</select></th>
				<th colspan="3">Estabilización
								<select class="form-control col-md-5" name="r_or_t_est">
									<option value="Repeticiones">Repeteciones</option>
									<option value="Tiempo">Tiempo</option>
								</select></th>
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
				<tr>
					<td>
						<select class="form-control" name="wu_o_1">
							<option selected disabled>Elija</option>
							@if($cycle->plio_0!=null)     
				            	<option value="Plio 0">Plio 0</option>
				            @endif				       
				            @if($cycle->plio_1!=null)
				            	<option value="Plio 1">Plio 1</option>
				            @endif
				            @if($cycle->wu_displacement!=null)
				            	<option value="Desplaz.">Desplaz.</option>
				            @endif
				            @if($cycle->displacement_plus!=null)
				            	<option value="Desplaz. + Res.">Desplaz. + Res.</option>
				            @endif
				            @if($cycle->mov_arti!=null)
				            	<option value="Mov. Articular">Mov. Articular</option>
				            @endif    			
			    		</select>
					</td>
					<td><input class="form-control size" type="number" name="wu_s_1"></td>
					<td><input class="form-control size" type="number" name="wu_r_1"></td>
					<td>
						<select class="form-control" name="est_o_1">
							<option selected disabled>Elija</option>
							@if($cycle->anti_flex_sup!=null)
				            	<option value="Anti Flex. SUP">Anti Flex. SUP</option>
				            @endif
				            @if($cycle->anti_flex_pro!=null)
				            	<option value="Anti Flex. PRO">Anti Flex. PRO</option>
				            @endif
				            @if($cycle->anti_flex_later!=null)
				            	<option value="Anti Flex LATER.">Anti Flex LATER.</option>
				            @endif
				            @if($cycle->anti_rotation!=null)
				            	<option value="Anti Rotación">Anti Rotación</option>
				            @endif
				            @if($cycle->anti_extension!=null)
				            	<option value="Anti Extensión">Anti Extensión</option>
				            @endif	
			    		</select>
					</td>
					<td><input class="form-control size" type="number" name="est_s_1"></td>
					<td><input class="form-control size" type="number" name="est_r_1"></td>
				</tr>
				<tr>
					<td >
						<select class="form-control" name="wu_o_2">
							<option selected disabled>Elija</option>
							@if($cycle->plio_0!=null)     
				            	<option value="Plio 0">Plio 0</option>
				            @endif				       
				            @if($cycle->plio_1!=null)
				            	<option value="Plio 1">Plio 1</option>
				            @endif
				            @if($cycle->wu_displacement!=null)
				            	<option value="Desplaz.">Desplaz.</option>
				            @endif
				            @if($cycle->displacement_plus!=null)
				            	<option value="Desplaz. + Res.">Desplaz. + Res.</option>
				            @endif
				            @if($cycle->mov_arti!=null)
				            	<option value="Mov. Articular">Mov. Articular</option>
				            @endif    			
			    		</select>
					</td>
					<td><input class="form-control size" type="number" name="wu_s_2""></td>
					<td><input class="form-control size" type="number" name="wu_r_2"></td>
					<td>
						<select class="form-control" name="est_o_2">
							<option selected disabled>Elija</option>
							@if($cycle->anti_flex_sup!=null)
				            	<option value="Anti Flex. SUP">Anti Flex. SUP</option>
				            @endif
				            @if($cycle->anti_flex_pro!=null)
				            	<option value="Anti Flex. PRO">Anti Flex. PRO</option>
				            @endif
				            @if($cycle->anti_flex_later!=null)
				            	<option value="Anti Flex LATER.">Anti Flex LATER.</option>
				            @endif
				            @if($cycle->anti_rotation!=null)
				            	<option value="Anti Rotación">Anti Rotación</option>
				            @endif
				            @if($cycle->anti_extension!=null)
				            	<option value="Anti Extensión">Anti Extensión</option>
				            @endif	
			    		</select>
					</td>
					<td><input class="form-control size" type="number" name="est_s_2"></td>
					<td><input class="form-control size" type="number" name="est_r_2"></td>
				</tr>
				<tr>
					<td>
						<select class="form-control" name="wu_o_3">
							<option selected disabled>Elija</option>
							@if($cycle->plio_0!=null)     
				            	<option value="Plio 0">Plio 0</option>
				            @endif				       
				            @if($cycle->plio_1!=null)
				            	<option value="Plio 1">Plio 1</option>
				            @endif
				            @if($cycle->wu_displacement!=null)
				            	<option value="Desplaz.">Desplaz.</option>
				            @endif
				            @if($cycle->displacement_plus!=null)
				            	<option value="Desplaz. + Res.">Desplaz. + Res.</option>
				            @endif
				            @if($cycle->mov_arti!=null)
				            	<option value="Mov. Articular">Mov. Articular</option>
				            @endif    			
			    		</select>
					</td>
					<td><input class="form-control size" type="number" name="wu_s_3"></td>
					<td><input class="form-control size" type="number" name="wu_r_3"></td>
					<td>
						<select class="form-control" name="est_o_3">
							<option selected disabled>Elija</option>
							@if($cycle->anti_flex_sup!=null)
				            	<option value="Anti Flex. SUP">Anti Flex. SUP</option>
				            @endif
				            @if($cycle->anti_flex_pro!=null)
				            	<option value="Anti Flex. PRO">Anti Flex. PRO</option>
				            @endif
				            @if($cycle->anti_flex_later!=null)
				            	<option value="Anti Flex LATER.">Anti Flex LATER.</option>
				            @endif
				            @if($cycle->anti_rotation!=null)
				            	<option value="Anti Rotación">Anti Rotación</option>
				            @endif
				            @if($cycle->anti_extension!=null)
				            	<option value="Anti Extensión">Anti Extensión</option>
				            @endif	
			    		</select>
					</td>
					<td><input class="form-control size" type="number" name="est_s_3"></td>
					<td><input class="form-control size" type="number" name="est_r_3"></td>
				</tr>
				<tr>
					<td>
						<select class="form-control" name="wu_o_4">
							<option selected disabled>Elija</option>
							@if($cycle->plio_0!=null)     
				            	<option value="Plio 0">Plio 0</option>
				            @endif				       
				            @if($cycle->plio_1!=null)
				            	<option value="Plio 1">Plio 1</option>
				            @endif
				            @if($cycle->wu_displacement!=null)
				            	<option value="Desplaz.">Desplaz.</option>
				            @endif
				            @if($cycle->displacement_plus!=null)
				            	<option value="Desplaz. + Res.">Desplaz. + Res.</option>
				            @endif
				            @if($cycle->mov_arti!=null)
				            	<option value="Mov. Articular">Mov. Articular</option>
				            @endif    			
			    		</select>
					</td>
					<td><input class="form-control size" type="number" name="wu_s_4"></td>
					<td><input class="form-control size" type="number" name="wu_r_4"></td>
					<td>
						<select class="form-control" name="est_o_4">
							<option selected disabled>Elija</option>
							@if($cycle->anti_flex_sup!=null)
				            	<option value="Anti Flex. SUP">Anti Flex. SUP</option>
				            @endif
				            @if($cycle->anti_flex_pro!=null)
				            	<option value="Anti Flex. PRO">Anti Flex. PRO</option>
				            @endif
				            @if($cycle->anti_flex_later!=null)
				            	<option value="Anti Flex LATER.">Anti Flex LATER.</option>
				            @endif
				            @if($cycle->anti_rotation!=null)
				            	<option value="Anti Rotación">Anti Rotación</option>
				            @endif
				            @if($cycle->anti_extension!=null)
				            	<option value="Anti Extensión">Anti Extensión</option>
				            @endif	
			    		</select>
					</td>
					<td><input class="form-control size" type="number" name="est_s_4"></td>
					<td><input class="form-control size" type="number" name="est_r_4"></td>
				</tr>
				<tr>
					<td colspan="3">
						<div class="form-inline">
						<label>RPE Warm Up: &nbsp;</label>
						<input class="form-control col-sm-2" type="float" name="rpe_wu" id="rpe_wu">
						</div>	
						<label style="color: green">*En rango &nbsp;</label>
						<label style="color: red">*Fuera de rango</label>				
					</td>
					<td colspan="3">
						<div class="form-inline">
						<label>RPE estabilización: &nbsp;</label>
						<input class="form-control col-sm-2" type="float" name="rpe_stab" id="rpe_stab">
						</div>
						<label style="color: green">*En rango &nbsp;</label>
						<label style="color: red">*Fuera de rango</label>
					</td>
				</tr>
			</tbody>
		</table>	
		<table class="table table-bordered table-responsive">
			<thead align="center">
				<th colspan="4">Fuerza
								<select class="form-control col-md-5" name="r_or_t_str">
									<option value="Repeticiones">Repeteciones</option>
									<option value="Tiempo">Tiempo</option>
								</select></th>
			</thead>
			<tbody>
				<tr align="center">
					<td>Ejercicio</td>
					<td>Serie</td>
					<td>Repetición</td>
					<td>Peso (Kg.)</td>
				</tr>
				<tr>
					<td>
						<select class="form-control" name="str_o_1">
							<option selected disabled>Elija</option>
							@if($cycle->fe_hip!=null)     
				            	<option value="F-E Cadera">F-E Cadera</option>
				            @endif
				            @if($cycle->knee_dom!=null)
				            	<option value="Rodilla Dom.">Rodilla Dom.</option>
				            @endif
				            @if($cycle->vert_push!=null)
				            	<option value="Empujón Vert.">Empujón Vert.</option>
				            @endif
				            @if($cycle->horiz_push!=null)
				            	<option value="Empujón Hor.">Empujón Hor.</option>
				            @endif
				            @if($cycle->vert_pull!=null)
				            	<option value="Tirón Vert.">Tirón Vert.</option>
				            @endif
				            @if($cycle->horiz_pull!=null)
				            	<option value="Tirón Hor.">Tirón Hor.</option>
				            @endif
				            @if($cycle->rotations!=null)
				            	<option value="Rotaciones">Rotaciones</option>
				            @endif	
			    		</select>
					</td>
					<td><input class="form-control size" type="number" name="str_s_1"></td>
					<td><input class="form-control size" type="number" name="str_r_1"></td>
					<td><input class="form-control size" type="number" name="str_w_1"></td>
				</tr>
				<tr>
					<td>
						<select class="form-control" name="str_o_2">
							<option selected disabled>Elija</option>
							@if($cycle->fe_hip!=null)     
				            	<option value="F-E Cadera">F-E Cadera</option>
				            @endif
				            @if($cycle->knee_dom!=null)
				            	<option value="Rodilla Dom.">Rodilla Dom.</option>
				            @endif
				            @if($cycle->vert_push!=null)
				            	<option value="Empujón Vert.">Empujón Vert.</option>
				            @endif
				            @if($cycle->horiz_push!=null)
				            	<option value="Empujón Hor.">Empujón Hor.</option>
				            @endif
				            @if($cycle->vert_pull!=null)
				            	<option value="Tirón Vert.">Tirón Vert.</option>
				            @endif
				            @if($cycle->horiz_pull!=null)
				            	<option value="Tirón Hor.">Tirón Hor.</option>
				            @endif
				            @if($cycle->rotations!=null)
				            	<option value="Rotaciones">Rotaciones</option>
				            @endif
			    		</select>
					</td>
					<td><input class="form-control size" type="number" name="str_s_2"></td>
					<td><input class="form-control size" type="number" name="str_r_2"></td>
					<td><input class="form-control size" type="number" name="str_w_2"></td>
				</tr>
				<tr>
					<td>
						<select class="form-control" name="str_o_3">
							<option selected disabled>Elija</option>     
				            @if($cycle->fe_hip!=null)     
				            	<option value="F-E Cadera">F-E Cadera</option>
				            @endif
				            @if($cycle->knee_dom!=null)
				            	<option value="Rodilla Dom.">Rodilla Dom.</option>
				            @endif
				            @if($cycle->vert_push!=null)
				            	<option value="Empujón Vert.">Empujón Vert.</option>
				            @endif
				            @if($cycle->horiz_push!=null)
				            	<option value="Empujón Hor.">Empujón Hor.</option>
				            @endif
				            @if($cycle->vert_pull!=null)
				            	<option value="Tirón Vert.">Tirón Vert.</option>
				            @endif
				            @if($cycle->horiz_pull!=null)
				            	<option value="Tirón Hor.">Tirón Hor.</option>
				            @endif
				            @if($cycle->rotations!=null)
				            	<option value="Rotaciones">Rotaciones</option>
				            @endif	
			    		</select>
					</td>
					<td><input class="form-control size" type="number" name="str_s_3"></td>
					<td><input class="form-control size" type="number" name="str_r_3"></td>
					<td><input class="form-control size" type="number" name="str_w_3"></td>
				</tr>
				<tr>
					<td>
						<select class="form-control" name="str_o_4">
							<option selected disabled>Elija</option>     
				            @if($cycle->fe_hip!=null)     
				            	<option value="F-E Cadera">F-E Cadera</option>
				            @endif
				            @if($cycle->knee_dom!=null)
				            	<option value="Rodilla Dom.">Rodilla Dom.</option>
				            @endif
				            @if($cycle->vert_push!=null)
				            	<option value="Empujón Vert.">Empujón Vert.</option>
				            @endif
				            @if($cycle->horiz_push!=null)
				            	<option value="Empujón Hor.">Empujón Hor.</option>
				            @endif
				            @if($cycle->vert_pull!=null)
				            	<option value="Tirón Vert.">Tirón Vert.</option>
				            @endif
				            @if($cycle->horiz_pull!=null)
				            	<option value="Tirón Hor.">Tirón Hor.</option>
				            @endif
				            @if($cycle->rotations!=null)
				            	<option value="Rotaciones">Rotaciones</option>
				            @endif	
			    		</select>
					</td>
					<td><input class="form-control size" type="number" name="str_s_4"></td>
					<td><input class="form-control size" type="number" name="str_r_4"></td>
					<td><input class="form-control size" type="number" name="str_w_4"></td>
				</tr>
				<tr>
					<td colspan="4">
						<div class="form-inline">
						<label>RPE Fuerza: &nbsp;</label>
						<input class="form-control col-sm-2" type="float" name="rpe_str" id="rpe_str">
						</div>
						<label style="color: green">*En rango &nbsp;</label>
						<label style="color: red">*Fuera de rango</label>
					</td>
				</tr>
			</tbody>
		</table>
		<table class="table table-bordered table-responsive">
			<thead align="center">
				<th colspan="3">Acc. Metabólica
								<select class="form-control col-md-5" name="r_or_t_acc">
									<option value="Repeticiones">Repeteciones</option>
									<option value="Tiempo">Tiempo</option>
								</select></th>
			</thead>
			<tbody>
				<tr align="center">
					<td>Ejercicio</td>
					<td>Serie</td>
					<td>Repetición</td>
				</tr>
				<tr>
					<td>
						<select class="form-control" name="acc_o_1">
							<option selected disabled>Elija</option>  
							@if($cycle->burpee!=null)   
				            	<option value="Burpee">Burpee</option>
				            @endif	
				            @if($cycle->throwings!=null)
				            	<option value="Lanzamientos">Lanzamientos</option>
				            @endif
				            @if($cycle->pliometrico!=null)
				            	<option value="Pliométrico">Pliométrico</option>
				            @endif
				            @if($cycle->displacement!=null)
				            	<option value="Desplazamiento">Desplazamiento</option>
				            @endif
				            @if($cycle->step!=null)
				            	<option value="Step">Step</option>
				            @endif
				            @if($cycle->trx!=null)
				            	<option value="TRX">TRX</option>
				            @endif
				            @if($cycle->box!=null)
				            	<option value="BOX">BOX</option>
				            @endif
			    		</select>
					</td>
					<td><input class="form-control size" type="number" name="acc_s_1"></td>
					<td><input class="form-control size" type="number" name="acc_r_1"></td>
				</tr>
				<tr>
					<td>
						<select class="form-control" name="acc_o_2">
							<option selected disabled>Elija</option>     
				            @if($cycle->burpee!=null)   
				            	<option value="Burpee">Burpee</option>
				            @endif	
				            @if($cycle->throwings!=null)
				            	<option value="Lanzamientos">Lanzamientos</option>
				            @endif
				            @if($cycle->pliometrico!=null)
				            	<option value="Pliométrico">Pliométrico</option>
				            @endif
				            @if($cycle->displacement!=null)
				            	<option value="Desplazamiento">Desplazamiento</option>
				            @endif
				            @if($cycle->step!=null)
				            	<option value="Step">Step</option>
				            @endif
				            @if($cycle->trx!=null)
				            	<option value="TRX">TRX</option>
				            @endif
				            @if($cycle->box!=null)
				            	<option value="BOX">BOX</option>
				            @endif
			    		</select>
					</td>
					<td><input class="form-control size" type="number" name="acc_s_2"></td>
					<td><input class="form-control size" type="number" name="acc_r_2"></td>
				</tr>
				<tr>
					<td>
						<select class="form-control" name="acc_o_3">
							<option selected disabled>Elija</option>     
				            @if($cycle->burpee!=null)   
				            	<option value="Burpee">Burpee</option>
				            @endif	
				            @if($cycle->throwings!=null)
				            	<option value="Lanzamientos">Lanzamientos</option>
				            @endif
				            @if($cycle->pliometrico!=null)
				            	<option value="Pliométrico">Pliométrico</option>
				            @endif
				            @if($cycle->displacement!=null)
				            	<option value="Desplazamiento">Desplazamiento</option>
				            @endif
				            @if($cycle->step!=null)
				            	<option value="Step">Step</option>
				            @endif
				            @if($cycle->trx!=null)
				            	<option value="TRX">TRX</option>
				            @endif
				            @if($cycle->box!=null)
				            	<option value="BOX">BOX</option>
				            @endif
			    		</select>
					</td>
					<td><input class="form-control size" type="number" name="acc_s_3"></td>
					<td><input class="form-control size" type="number" name="acc_r_3"></td>
				</tr>
				<tr>
					<td>
						<select class="form-control" name="acc_o_4">
							<option selected disabled>Elija</option>     
				            @if($cycle->burpee!=null)   
				            	<option value="Burpee">Burpee</option>
				            @endif	
				            @if($cycle->throwings!=null)
				            	<option value="Lanzamientos">Lanzamientos</option>
				            @endif
				            @if($cycle->pliometrico!=null)
				            	<option value="Pliométrico">Pliométrico</option>
				            @endif
				            @if($cycle->displacement!=null)
				            	<option value="Desplazamiento">Desplazamiento</option>
				            @endif
				            @if($cycle->step!=null)
				            	<option value="Step">Step</option>
				            @endif
				            @if($cycle->trx!=null)
				            	<option value="TRX">TRX</option>
				            @endif
				            @if($cycle->box!=null)
				            	<option value="BOX">BOX</option>
				            @endif
			    		</select>
					</td>
					<td><input class="form-control size" type="number" name="acc_s_4"></td>
					<td><input class="form-control size" type="number" name="acc_r_4"></td>
				</tr>
				<tr>
					<td colspan="3">
						<div class="form-inline">
						<label>RPE Acc. Metat.: &nbsp;</label>
						<input class="form-control col-sm-2" type="float" name="rpe_acc" id="rpe_acc">
						</div>
						<label style="color: green">*En rango &nbsp;</label>
						<label style="color: red">*Fuera de rango</label>
					</td>
				</tr>
			</tbody>
		</table>	
		<h3>Notas sesión:</h3>
		<textarea name="notes" rows="2"></textarea>


<div class="card">
    <div class="card-header" id="headingOne">
      	<h5 class="mb-0">
        	<a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          	Tareas
        	</a>
      	</h5>
    </div>

    <div id="collapseOne" class="collapse" aria-labelledby="headingOne">
      	<div class="card-body">
	        <div class="form-inline">
		        <label class="control-label col-sm-2"><b>Ejercicios</b></label>
		        <button class="btn btn-primary" id="agregar" type="button">+</button>
    		</div>
    		<table class="table table_exercises table-bordered">
        		<thead>
		            <tr>
		                <td>Nombre</td>
		                <td>Series</td>
		                <td>Repeticiones</td>
		                <td>Descanso (seg.)</td>
		            </tr>
		        </thead>
		    </table>
      	</div>
    </div>
</div>

		<input type="hidden" name="cycle_id" value="{{ $cycle->id }}">
		<input type="hidden" name="session_tab_id" value="{{ $session_tab_id }}">
		<input type="hidden" name="member_id" value="{{ $member_id }}">
    	<button class="btn btn-primary" type="submit">Finalizar</button>
	</form>
</div>

<script type="text/javascript">
	$("#agregar").click(function(){
        var nuevaFila="<tr>";
        nuevaFila+='<td><select class="form-control col-sm-12" name="exercises[]">'+
                            '<option value="0" selected disabled>Elija</option>'+
                            '@foreach($exercises as $exercise)'+
                            '<option value="{{ $exercise->id }}">{{ $exercise->nombre }}</option>'+
                            '@endforeach'+
                        '</select></td>';
        nuevaFila+='<td><input type="number" class="series form-control col-sm-12" name="series[]" style="text-align:right" required=""></td>';
        nuevaFila+='<td><input type="number" class="repetitions form-control col-sm-12" name="repetitions[]" style="text-align:right" required=""></td>';
        nuevaFila+='<td><input type="number" class="rest form-control col-sm-12" name="rest[]" style="text-align:right" required=""></td>';
        nuevaFila+='<td><button class="btn btn-danger" type="button">Borrar</button></td>';
        nuevaFila+="</tr>";
        $(".table_exercises").append(nuevaFila);
    });

    $(".table_exercises").on('click',".btn-danger",eliminarFila);
        function eliminarFila(){                   
            $(this).parent().parent().remove();
        }

    
    $("#rpe_wu").keyup(function(){
    	var rpe_wu= document.getElementById('rpe_wu');
    	var rpe_wu_min = "<?php echo $cycle->rpe_wu_min; ?>" ;
    	var rpe_wu_max = "<?php echo $cycle->rpe_wu_max; ?>" ;
    	console.log(rpe_wu.value);
    	if (rpe_wu_min<=rpe_wu.value&&rpe_wu.value<=rpe_wu_max) {
    		rpe_wu.style.color="green";
    	}
    	else{
    		rpe_wu.style.color="red";	
    	}
    });

    $("#rpe_acc").keyup(function(){
    	var rpe_acc= document.getElementById('rpe_acc');
    	var rpe_acc_min = "<?php echo $cycle->rpe_acc_min; ?>" ;
    	var rpe_acc_max = "<?php echo $cycle->rpe_acc_max; ?>" ;
    	console.log(rpe_acc.value);
    	if (rpe_acc_min<=rpe_acc.value&&rpe_acc.value<=rpe_acc_max) {
    		rpe_acc.style.color="green";
    	}
    	else{
    		rpe_acc.style.color="red";	
    	}
    });

    $("#rpe_str").keyup(function(){
    	var rpe_str= document.getElementById('rpe_str');
    	var rpe_str_min = "<?php echo $cycle->rpe_str_min; ?>" ;
    	var rpe_str_max = "<?php echo $cycle->rpe_str_max; ?>" ;
    	console.log(rpe_str.value);
    	if (rpe_str_min<=rpe_str.value&&rpe_str.value<=rpe_str_max) {
    		rpe_str.style.color="green";
    	}
    	else{
    		rpe_str.style.color="red";	
    	}
    });

    $("#rpe_stab").keyup(function(){
    	var rpe_stab= document.getElementById('rpe_stab');
    	var rpe_stab_min = "<?php echo $cycle->rpe_stab_min; ?>" ;
    	var rpe_stab_max = "<?php echo $cycle->rpe_stab_max; ?>" ;
    	console.log(rpe_wu.value);
    	if (rpe_stab_min<=rpe_stab.value&&rpe_stab.value<=rpe_stab_max) {
    		rpe_stab.style.color="green";
    	}
    	else{
    		rpe_stab.style.color="red";	
    	}
    });


    function confirmar() {
        var r = confirm("Se perderan los datos!");
        if (r == true) {
            document.getElementById("back").href = "/fichaSesion";
    	}
    }

    function confirmar2() {
        var r = confirm("Se perderan los datos!");
        if (r == true) {
            document.getElementById("back2").href = "/fichaSesion/{{ $member_id }}";
    	}
    }
    

</script>


<style type="text/css">
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

	.size{
		width: 80px;
	}

	

</style>
@endsection
