@extends('layouts.menu')
@section('styles')
{!! Html::script('vendor/seguce92/fullcalendar-3.6.2/lib/jquery.min.js') !!}
{!! Html::style('vendor/seguce92/fullcalendar-3.6.2/fullcalendar.min.css') !!}
{!! Html::script('vendor/seguce92/fullcalendar-3.6.2/lib/moment.min.js') !!}
{!! Html::script('vendor/seguce92/fullcalendar-3.6.2/fullcalendar.min.js') !!}
{!! Html::script('vendor/seguce92/fullcalendar-3.6.2/locale/es.js') !!}
{!! Html::style('vendor/seguce92/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') !!}
{!! Html::script('vendor/seguce92/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') !!}

{!! Html::style('vendor/seguce92/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') !!}
{!! Html::script('vendor/seguce92/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') !!}

{!! Html::style('vendor/seguce92/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css') !!}
{!! Html::script('vendor/seguce92/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js') !!}

<!-- JS file -->
{!! Html::script('vendor/autocomplete/jquery.easy-autocomplete.min.js') !!}

<!-- CSS file -->
{!! Html::style('vendor/autocomplete/easy-autocomplete.css') !!}

@endsection
@section('content')
<div style="width:800px; margin:0 auto;">
  <select class="form-control" name="sede" id="sede" onload="first_time()">
      <option value=8888 selected>Mostrar Todo</option>
      @foreach($sedes as $sede)
      <option value="{{$sede->id}}">{{$sede->nombre}}</option>
      @endforeach
  </select>
</div>

<div class=container onload="first_time()">
  {{Form::open(['url' => 'store_cite', 'method' => 'post', 'role' =>  'form'])}}
    <div id="responsive-modal" class="modal fade" tabindex="-1" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4>Agregar Hora</h4>
          </div>
          <div class="modal-body">
            <!-- SOCIO -->
            <div class="form-group">
                {{ Form::label('socio', 'Socio') }}<br>
                {{ Form::text('socio', null, array('class' => 'form-control','id'=>'_socio')) }}
            </div>
            <div class="row">
              <!--LEFT-->
              <div class="col-md-6">
                 <div class="col-md-12">
                   <!-- PROFESIONAL -->
                   <div class="form-group">
                     {{ Form::label('title', 'Profesional') }}<br>
                     <select class="form-control" id="title" name="title"></select>
                   </div>
                   <!-- FECHA INICIO -->
                   <div class="form-group">
                     {{ Form::label('date_start', 'Fecha Inicio') }}
                     {{ Form::text('date_start', old('_date_start'), ['class' => 'form-control']) }}
                   </div>
                   <!-- HORA INICIO -->
                   <div class="form-group">
                     {{ Form::label('time_start', 'Hora Inicio') }}
                     {{ Form::text('time_start', old('_time_start'), ['class' => 'form-control']) }}
                   </div>
                   <!-- HORA FIN -->
                   <div class="form-group">
                     {{ Form::label('time_end', 'Hora Fin') }}
                     {{ Form::text('time_end', old('_time_end'), ['class' => 'form-control']) }}
                   </div>
                 </div>
              </div>
              <!--END LEFT-->
              <!--RIGHT-->
              <div class="col-md-6">
                 <div class="col-md-12">
                   <!-- TIPO DE HORA -->
                   <div class="form-group">
                     {{ Form::label('type', 'Tipo') }}<br>
                     <select class="form-control" name="type" id="type"></select>
                   </div>
                   <!-- Estado de la Cita -->
                   {{ Form::label('status', 'Estado de la Cita') }}<br>
                   <select class="form-control" name="status">
                   <option value=9999 selected>Ninguna</option>
                   @foreach($status as $s)
                   <option value="{{$s->id}}">{{$s->nombre}}</option>
                   @endforeach
                   </select>
                   <!-- COMENTARIOS -->
                   <div class="form-group">
                     {{ Form::label('comentarios', 'Comentarios') }}
                     {!! Form::textarea('_comentarios',null,['class'=>'form-control', 'rows' => 5, 'cols' => 40]) !!}

                   </div>
                 </div>
              </div>
              <!--END RIGHT-->
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}
          </div>
        </div>
      </div>
    </div>
  {{Form::close()}}
  </div>
  <!-- CALENDAR -->
  <div class="container">
    <br>
    <div id='calendar'></div>
  </div>

  <!-- APPOINTEMENT EDIT -->
  <div id="modal-event" class="modal fade" tabindex="-1" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Editar Hora</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <!-- LEFT -->
            <div class="col-md-6">
               <div class="col-md-12">
                 <!-- PROFESIONAL -->
                 {{ Form::label('title', 'Profesional', ['id' => '_profesional_name']) }}<br>
                 <select class="form-control" name="_title" id="_title">
                 @foreach($profesionales as $profesional)
                 <option value="{{$profesional->id}}">{{$profesional->first_name}}</option>
                 @endforeach
                 </select>
                 <!-- SOCIO -->
                 <div class="form-group">
                   {{ Form::label('_socio', 'Socio', ['id' => '_socio_name']) }}
                   {{ Form::text('_socio', old('_socio'), ['class' => 'form-control']) }}
                 </div>
                 <!-- FECHA INICIO -->
                 <div class="form-group">
                   {{ Form::label('_date_start', 'Fecha Inicio') }}
                   {{ Form::text('_date_start', old('_date_start'), ['class' => 'form-control']) }}
                 </div>
                 <!-- HORA INICIO -->
                 <div class="form-group">
                   {{ Form::label('_time_start', 'Hora Inicio') }}
                   {{ Form::text('_time_start', old('_time_start'), ['class' => 'form-control']) }}
                 </div>
                 <!-- HORA FIN -->
                 <div class="form-group">
                   {{ Form::label('_time_end', 'Hora Fin') }}
                   {{ Form::text('_time_end', old('_time_end'), ['class' => 'form-control']) }}
                 </div>
               </div>
            </div>
            <!-- END LEFT -->
            <!-- RIGHT -->
            <div class="col-md-6">
               <div class="col-md-12">
                 <!-- TIPO DE HORA -->
                 <div class="form-group">
                   {{ Form::label('_type', 'Tipo') }}<br>
                   <select class="form-control" name="_type" id="_type" >
                     @foreach($types as $type)
                     <option>{{$type->nombre}}</option>
                     @endforeach
                   </select>
                 </div>
                 <!-- Estado de la Cita -->
                 {{ Form::label('status', 'Estado de la Cita') }}<br>
                 <select class="form-control" name="status" id="status">
                 @foreach($status as $s)
                 <option value="{{$s->id}}">{{$s->nombre}}</option>
                 @endforeach
                 </select>
                 <!-- COMENTARIOS -->
                 <div class="form-group">
                   {{ Form::label('_comentarios', 'Comentarios') }}
                   {!! Form::textarea('_comentarios',null,['class'=>'form-control', 'rows' => 5, 'cols' => 40]) !!}

                 </div>
               </div>
            </div>
            <!-- END RIGHT-->
          </div>
        </div>
        <div class="modal-footer">
          <a id="delete" data-href="cites_delete" data-id="" class="btn btn-danger">Eliminar</a>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <a id="_update" data-href="{{url('cites')}}" data-id="" class="btn btn-success">Actualizar</a>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script>
  var BASEURL = '{{ url('/') }}';
	$(document).ready(function() {
		$('#calendar').fullCalendar({
			header: {
				left: 'month,agendaWeek,agendaDay',
				center: 'title',
        right: 'prev,next,today'
			},
      allDaySlot: false,
      minTime: "08:00:00",
      maxTime: "23:00:00",
      columnFormat: 'dddd',
      defaultView: 'agendaDay',
			navLinks: true, // can click day/week names to navigate views
			editable: true,
      selectable: true,
      selectHelper: true,
      aspectRatio: 3,

      select: function(start, end){
        tstart = moment.utc(start.format());
        tend = moment.utc(end.format());
        start = moment(start.format());
        $('#date_start').val(start.format('YYYY-MM-DD'));
        $('#time_start').val(start.format('HH:mm:ss'));
        $('#date_end').val(end.format('YYYY-MM-DD'));
        $('#day').val(moment(start).day());
        $('#time_end').val(end.format('HH:mm:ss'));
        $('#responsive-modal').modal('show');
        //Aqui esta el mambo!!!
        var pid = [@foreach($events as $e => $info)
                      '{{$info->id}}',
                    @endforeach ];
        var pstart = [@foreach($events as $e => $info)
                      moment.utc('{{$info->start}}'.replace(" ", "T")),
                    @endforeach ];
        var pend = [@foreach($events as $e => $info)
                      moment.utc('{{ $info->end }}'.replace(" ", "T")),
                     @endforeach ];
        var ptitle = [@foreach($events as $e => $info)
                      '{{ $info->title }}',
                    @endforeach ];
        var x = document.getElementById("title");
        //using the function:
        removeOptions(document.getElementById("title"));
        function removeOptions(selectbox)
        {
            var i;
            for(i = selectbox.options.length - 1 ; i >= 0 ; i--)
            {
                selectbox.remove(i);
            }
        }
        //for each event..
        for (var i = 0; i < pstart.length; i++) {
          //Here, we compare if exists event which is located between [tstart, tend] range
          if ( (tstart.isAfter(pstart[i]) || (tstart.isSame(pstart[i]))) &&
               (tend.isBefore(pend[i]) || (tend.isSame(pend[i]))) ) {
            var option = document.createElement("option");
            option.text = ptitle[i];
            option.value = pid[i];
            //console.log(pid[i]);
            x.add(option);
          }
        }
      },

      eventClick: function(event, jsEvent, view){
        var date_start = $.fullCalendar.moment(event.start).format('YYYY-MM-DD');
        var time_start = $.fullCalendar.moment(event.start).format('HH:mm:ss');
        var date_end = $.fullCalendar.moment(event.end).format('YYYY-MM-DD');
        var time_end = $.fullCalendar.moment(event.end).format('HH:mm:ss');
        var day = $.fullCalendar.moment(event.start).day();
        $('#modal-event #_update').attr('data-id', event.id);
        $('#modal-event #delete').attr('data-id', event.id);
        $('#modal-event #_socio').val(event.title);
        $('#modal-event #_title').val(event.id_prof);
        $('#modal-event #_date_start').val(date_start);
        $('#modal-event #_time_start').val(time_start);
        $('#modal-event #_day').val(day);
        $('#modal-event #_date_end').val(date_end);
        $('#modal-event #_time_end').val(time_end);
        $('#modal-event #status').val(event.estado);
        $('#modal-event #_comentarios').val(event.description);
        $('#modal-event #_type').val(event.type);
        $('#modal-event').modal('show');
      },

		});
    // window.onload
    window.onload = first_time();
	});

  //load info about particular user
  $("#_socio").change(function(){
    var y = document.getElementById("type");
    removeOptions(y);
    function removeOptions(selectbox)
    {
        var i;
        for(i = selectbox.options.length - 1 ; i >= 0 ; i--)
        {
            selectbox.remove(i);
        }
    }
    if ($('#_socio').val().length > 3) {
      $.get('/member_sesion/'+$('#_socio').val(), function(data, status){
      //alert("Data: " + data + "\nStatus: " + status);
        for (var i = 0; i < data.length; i++) {
          if(i%2 == 0){
            var option = document.createElement("option");
            option.text = data[i]+' ('+data[i+1]+')';
            option.value = data[i];
            y.add(option);
        }
      }
      });
    }
  });

  //load events by id_sede from select input
  function first_time() {
    var fcSources = {
      hours: {
                  url:BASEURL + '/hours_sede/'+$('#sede').val(),
                  type: 'GET',
                  error: function() { alert('Porfavor, ingrese una sede para visualizar'); },
              },
      events: {
                  url: BASEURL + '/event_sede/'+$('#sede').val(),
                  type: 'GET',
                  rendering: 'background',
                  backgroundColor : '#a9a9a9',
                  error: function() { alert('Porfavor, ingrese una sede para visualizar'); },
              }
    };

    $('#calendar').fullCalendar('addEventSource', fcSources.hours);
    $('#calendar').fullCalendar('addEventSource', fcSources.events);
  }

  $("#sede").change(function(){
    $('#calendar').fullCalendar ('removeEvents');
    var fcSources = {
      hours: {
                  url:BASEURL + '/hours_sede/'+$('#sede').val(),
                  type: 'GET',
                  error: function() { alert('Porfavor, ingrese una sede para visualizar'); },
              },
      events: {
                  url: BASEURL + '/event_sede/'+$('#sede').val(),
                  type: 'GET',
                  rendering: 'background',
                  backgroundColor : '#a9a9a9',
                  error: function() { alert('Porfavor, ingrese una sede para visualizar'); },
              }
    };

    $('#calendar').fullCalendar('addEventSource', fcSources.hours);
    $('#calendar').fullCalendar('addEventSource', fcSources.events);
  });

  //Autocomplete


  var options = {
  	url: "display-search-queries",

  	getValue: function(element) {
              return element.nombre+" "+element.paterno+" "+element.materno;
            },
  	list: {
  	match: {
  			enabled: false
  		}
  	}

 };
//-------------------------------------------//
  $("#_socio").easyAutocomplete(options);

  $('#_time_start').bootstrapMaterialDatePicker({
    date: false,
    shortTime:false,
    format: 'HH:mm:ss'
  })

  $('#_time_end').bootstrapMaterialDatePicker({
    date: false,
    shortTime:false,
    format: 'HH:mm:ss'
  })

  $('.colorpicker').colorpicker();
  $('.colorpicker').css({
     "z-index": 999999
 });

 $('#delete').on('click', function(){
   var x = $(this);
   var delete_url = x.attr('data-href')+'/'+x.attr('data-id');
   $.ajax({
     headers:{
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     },
     url: delete_url,
     type: 'DELETE',
     success: function(result){
       $('#modal-event').modal('hide');
       alert(result.message);
        location.reload();
     },
   })
 })

 $('#_update').on('click', function(){
   var x = $(this);
   var update_url = x.attr('data-href')+'/'+x.attr('data-id');
   console.log($('#_socio').val());
   var formData = {
     profesional: $('#_title').val(),
     socio: $('#_socio').val(),
     date_start: $('#_date_start').val(),
     time_start: $('#_time_start').val(),
     time_end: $('#_time_end').val(),
     comentario: $('#_comentarios').val(),
     type: $('#_type').val(),
     estado: $('#status').val(),
   };
   $.ajax({
     headers:{
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     },
     url: update_url,
     type: 'PATCH',
     data: formData,
    success: function(result){
       $('#modal-event').modal('hide');
       location.reload();
     }
   })
 })

</script>
@endsection

@section('scripts')

@endsection
