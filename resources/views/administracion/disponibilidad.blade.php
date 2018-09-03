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

@endsection

@section('content')

<div class=container>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a>Administración</a></li>
      <li class="breadcrumb-item"><a href="/personal">Personal</a></li>
      <li class="breadcrumb-item active" aria-current="page">Disponibilidad</li>
    </ol>
  </nav>

  <br>
  <select class="form-control" name="sede" id="sede">
    <option value=9999>Elegir Sede</option>
    <option value=8888>Mostrar Todo</option>
    @foreach($sedes as $sede)
    <option value="{{$sede->id}}">{{$sede->nombre}}</option>
    @endforeach
  </select>

  {{Form::open(['route' => 'events.store', 'method' => 'post', 'role' =>  'form'])}}
    <div id="responsive-modal" class="modal fade" tabindex="-1" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4>Ingresar Disponibilidad</h4>
          </div>
          <div class="modal-body">
            {{ Form::label('title', 'Profesional') }}<br>
            <select class="form-control-inline" name="title">
            @foreach($profesionales as $profesional)
            <option value="{{$profesional->id}}">{{$profesional->first_name}} {{$profesional->last_name}}</option>
            @endforeach
            </select>
            <div class="form-group">
              {{ Form::label('date_start', 'Fecha Inicio') }}
              {{ Form::text('date_start', old('_date_start'), ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
              {{ Form::label('time_start', 'Hora Inicio') }}
              {{ Form::text('time_start', old('_time_start'), ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
              {{ Form::label('date_end', 'Fecha Fin') }}
              {{ Form::text('date_end', old('date_end'), ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
              {{ Form::label('time_end', 'Hora Fin') }}
              {{ Form::text('time_end', old('_time_end'), ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
              <h6>Sede</h6>
              @foreach ($sedes as $sede)
                  {{ Form::checkbox('sede[]', $sede->id) }}
                  {{ Form::label('sede', $sede->nombre) }}<br>
              @endforeach
            </div>
            <input type="hidden" name="day" class="day" value="">
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
  <div class="container">
    <br>
    <div id='calendar'></div>
  </div>

  <div id="modal-event" class="modal fade" tabindex="-1" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Detalles Disponibilidad</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            {{ Form::label('_title', 'Nombre') }}
            {{ Form::text('_title', old('_title'), ['class' => 'form-control']) }}
          </div>
          <div class="form-group">
            {{ Form::label('_date_start', 'Fecha Inicio') }}
            {{ Form::text('_date_start', old('_date_start'), ['class' => 'form-control']) }}
          </div>
          <div class="form-group">
            {{ Form::label('_time_start', 'Hora Inicio') }}
            {{ Form::text('_time_start', old('_time_start'), ['class' => 'form-control']) }}
          </div>

          <div class="form-group">
            {{ Form::label('_time_end', 'Hora Fin') }}
            {{ Form::text('_time_end', old('_time_end'), ['class' => 'form-control']) }}
          </div>

        </div>
        <div class="modal-footer">

          <div class="form-group">
            <label for="sel1">Eliminar:</label>
            <select class="form-control" id="sel1">
              <option selected value="on">Solo uno</option>
              <option value = "off">Todos</option>
            </select>
          </div>
          <a id="delete" data-href="{{url('events')}}" data-id="" class="btn btn-danger">Eliminar</a>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <a id="update_" data-href="{{url('events')}}" data-id="" class="btn btn-success">Actualizar</a>
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
      defaultView: 'agendaWeek',
			navLinks: true, // can click day/week names to navigate views
			editable: true,
      selectable: true,
      selectHelper: true,
      aspectRatio: 3,

      select: function(start, end){
        start = moment(start.format());

        $('#date_start').val(start.format('YYYY-MM-DD'));
        $('#time_start').val(start.format('HH:mm:ss'));
        $('#date_end').val(end.format('YYYY-MM-DD'));
        $('#time_end').val(end.format('HH:mm:ss'));
        $('#day').val(moment(start).day());
        $('#responsive-modal').modal('show');
      },
      eventClick: function(event, jsEvent, view){
        var date_start = $.fullCalendar.moment(event.start).format('YYYY-MM-DD');
        var time_start = $.fullCalendar.moment(event.start).format('HH:mm:ss');
        var date_end = $.fullCalendar.moment(event.end).format('YYYY-MM-DD');
        var time_end = $.fullCalendar.moment(event.end).format('HH:mm:ss');
        var day = $.fullCalendar.moment(event.start).day();
        $('#modal-event #delete').attr('data-id', event.id);
        $('#modal-event #update_').attr('data-id', event.id);
        $('#modal-event #_title').val(event.title);
        $('#modal-event #_date_start').val(date_start);
        $('#modal-event #_time_start').val(time_start);
        $('#modal-event #_day').val(day);
        $('#modal-event #_date_end').val(date_end);
        $('#modal-event #_time_end').val(time_end);
        $('#modal-event').modal('show');
      },

			events: BASEURL + '/events'
		});
	});

  //load events by id_sede from select input
  $("#sede").change(function(){
    $('#calendar').fullCalendar ('removeEvents');
    var fcSources = {
    events: {
                url: BASEURL + '/event_sede/'+$('#sede').val(),
                type: 'GET',
                error: function() { alert('Porfavor, ingrese una sede para visualizar'); },
            }
    };
    $('#calendar').fullCalendar('addEventSource', fcSources.events);
  });


  $('#_time_start').bootstrapMaterialDatePicker({
    date: false,
    shortTime:false,
    format: 'HH:mm:ss'
  });

  $('#_time_end').bootstrapMaterialDatePicker({
    date: false,
    shortTime:false,
    format: 'HH:mm:ss'
  });

  $('.colorpicker').colorpicker();
  $('.colorpicker').css({
     "z-index": 999999
 });

 $('#delete').on('click', function(){
   var x = $(this);
   var delete_url = x.attr('data-href')+'/'+x.attr('data-id');
   var letters = $("#sel1").val();
   console.log(letters);
   $.ajax({
     headers:{
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     },
     url: delete_url,
     type: 'DELETE',
     data: letters,
     success: function(result){
       $('#modal-event').modal('hide');
       alert(result.message);
        location.reload();
     },
     error: function(result){
       $('#modal-event').modal('hide');
       alert(result.message);
        location.reload();
     }
   })
 })


 $('#update_').on('click', function(){
   var x = $(this);
   var update_url = x.attr('data-href')+'/'+x.attr('data-id');
   var formData = {
     title: $('#_title').val(),
     date_start: $('#_date_start').val(),
     time_start: $('#_time_start').val(),
     time_end: $('#_time_end').val(),
     dia: $('#_day').val(),
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
