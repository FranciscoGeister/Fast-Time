@extends('layouts.menu')
 
<link rel="STYLESHEET" type="text/css" href="{{ asset("css/titles.css") }}">

@section('content')

<br>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>Operación</a></li>
            <li class="breadcrumb-item"><a href="/fichaEvaluaciones">Registro de evaluaciones</a></li>
            <li class="breadcrumb-item"><a href="/fichaEvaluaciones/{{ $member_id }}">Ficha de evaluaciones</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a>Nueva Evaluación</a></li>
        </ol>
    </nav>
    <form action="/registroEvaluacion" method="POST">
        {{csrf_field()}}
        <div class="form-inline">
            <label class="col-sm-1">Coach:</label>
            <select class="form-control" name="coach_id">
                @foreach($professionals as $prof)
                    <option value="{{ $prof->id }}">{{ $prof->first_name }} {{ $prof->last_name }}</option>
                @endforeach
            </select>
        </div>
        <br>
    	<div class="col-md-9">
            <table class="table table-bordered">
                <tr>
                    <td>                       
                        <span>Fecha:</span>
                        <input class="form-control" type="date" name="fecha" value="{{ date('Y-m-d') }}">
                    </td>
                    <td>                        
                        <span>Hora:</span>
                        <input class="form-control" type="time" name="hora" required="">
                    </td>                 
                    <td>
                        <span>Peso:</span>
                        <input class="form-control" type="number" name="peso" required="">
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-sm-6">
            <table class="table table-bordered">
                    <tr>
                        <td><b>Pliegues</b></td>
                        <td><b>Contornos</b></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-inline">
                            <label>Bicipital:  &nbsp;</label>
                            <input class="form-control col-sm-4" type="number" name="bicipital" id="bicipital" style="text-align:right">
                            </div>
                        </td>
                        <td>
                            <div class="form-inline">
                            <label>Pecho:  &nbsp;</label>
                            <input class="form-control col-sm-4" type="number" name="pecho" id="pecho" style="text-align:right">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-inline">
                            <label>Tricipital:  &nbsp;</label>
                            <input class="form-control col-sm-4" type="number" name="tricipital" id="tricipital" style="text-align:right">
                            </div>
                        </td>                   
                        <td>
                            <div class="form-inline">
                            <label>Cintura:  &nbsp;</label>
                            <input class="form-control col-sm-4" type="number" name="cintura" id="cintura" style="text-align:right">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-inline">
                            <label>Subescapular:  &nbsp;</label>
                            <input class="form-control col-sm-4" type="number" name="subescapular" id="subescapular" style="text-align:right">
                            </div>
                        </td>
                        <td>
                            <div class="form-inline">
                            <label>Cont. Ilíaco:  &nbsp;</label>
                            <input class="form-control col-sm-4" type="number" name="cont_iliaco" id="cont_iliaco" style="text-align:right">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-inline">
                            <label>Suprailiaco:  &nbsp;</label>
                            <input class="form-control col-sm-4" type="number" name="suprailiaco" id="suprailiaco" style="text-align:right">
                            </div>
                        </td>
                        <td>
                            <div class="form-inline">
                            <label>Cadera/Glúteo:  &nbsp;</label>
                            <input class="form-control col-sm-4" type="number" name="cadera" id="cadera" style="text-align:right">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-inline">
                            <label><b>Total:</b> &nbsp;</label>
                            <input class="form-control col-sm-4" type="number" name="total_pliegues" id="total_pliegues" style="text-align:right" required="">
                            </div>
                        </td>
                        <td>
                            <div class="form-inline">
                            <label>Muslo:  &nbsp;</label>
                            <input class="form-control col-sm-4" type="number" name="muslo" id="muslo" style="text-align:right">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="2">
                        </td>
                        <td>
                            <div class="form-inline">
                            <label>Bíceps Der.:  &nbsp;</label>
                            <input class="form-control col-sm-4" type="number" name="bisep_der" id="bisep_der" style="text-align:right">
                            </div>
                        </td>
                    </tr>
                    <tr>                  
                        <td>
                            <div class="form-inline">
                            <label><b>Total:</b>  &nbsp;</label>
                            <input class="form-control col-sm-4" type="number" name="total_cont" id="total_cont" style="text-align:right" required="">
                            </div>
                        </td>
                    </tr>                  
            </table>
        </div>
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

        <input type="hidden" name="evaluation_sheet_id" value="{{ $evaluation_sheet_id }}">
        <input type="hidden" name="member_id" value="{{ $member_id }}">
        <input type="hidden" name="tipo" value="{{ $tipo }}">
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

    $("#bicipital").keyup(function() {totalPliegues()});

    $("#tricipital").keyup(function() {totalPliegues()});
       
    $("#subescapular").keyup(function() {totalPliegues()});
       
    $("#suprailiaco").keyup(function() {totalPliegues()});

    function totalPliegues(){
        var suma = 0;
        var temp;
        temp = parseInt(document.getElementById('bicipital').value)
        if(!isNaN(temp)){
            suma += temp;
        }
        temp = parseInt(document.getElementById('tricipital').value)
        if(!isNaN(temp)){
            suma += temp;
        }
        temp = parseInt(document.getElementById('subescapular').value)
        if(!isNaN(temp)){
            suma += temp;
        }
        temp = parseInt(document.getElementById('suprailiaco').value)
        if(!isNaN(temp)){
            suma += temp;
        }
        document.getElementById('total_pliegues').value = suma;
    }
        

    $("#pecho").keyup(function(){totalContornos()});
        
    $("#cintura").keyup(function(){totalContornos()});    
        
    $("#cont_iliaco").keyup(function(){totalContornos()});      
        
    $("#cadera").keyup(function(){totalContornos()});      
        
    $("#muslo").keyup(function(){totalContornos()});      
        
    $("#bisep_der").keyup(function(){totalContornos()});      
        
    function totalContornos(){
        var suma = 0;
        var temp;
        temp = parseInt(document.getElementById('pecho').value)
        if(!isNaN(temp)){
            suma += temp;
        }
        temp = parseInt(document.getElementById('cintura').value)
        if(!isNaN(temp)){
            suma += temp;
        }
        temp = parseInt(document.getElementById('cont_iliaco').value)
        if(!isNaN(temp)){
            suma += temp;
        }
        temp = parseInt(document.getElementById('cadera').value)
        if(!isNaN(temp)){
            suma += temp;
        }
        temp = parseInt(document.getElementById('muslo').value)
        if(!isNaN(temp)){
            suma += temp;
        } 
        temp = parseInt(document.getElementById('bisep_der').value)
        if(!isNaN(temp)){
            suma += temp;
        }  
        document.getElementById('total_cont').value = suma; 
    }
</script>

<style>
	.table_evaluations td{
   		border-color: black;
	}
    
    .table td, tr{
        border-color: black;
    }

    label{
        width: 50%;
    }
</style>

@endsection
