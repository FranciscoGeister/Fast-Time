@extends('layouts.menu')
@section('content')

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
<select class="form-control" name="sede" id="sede">
    @foreach($sedes as $sede)
    <option value="{{$sede->id}}">{{$sede->nombre}}</option>
    @endforeach
</select>
<div class=container>
  {{Form::open(['route' => 'events.store', 'method' => 'post', 'role' =>  'form'])}}
    <div id="responsive-modal" class="modal fade" tabindex="-1" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4>Agregar Hora</h4>
          </div>
          <div class="modal-body">
            <!-- PROFESIONAL -->
            <div class="form-group">
              {{ Form::label('title', 'Profesional') }}<br>
              <select class="form-control-inline" name="title">
              </select>
            </div>
            <!-- SOCIO -->
            <div class="form-group">
              {{ Form::label('socio', 'Socio') }}
              {{ Form::input('text', '_socio', null, ['class' => 'form-control']) }}
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
            <!-- COMENTARIOS -->
            <div class="form-group">
              {{ Form::label('comentarios', 'Comentarios') }}
              {{ Form::input('text', '_comentarios', null, ['class' => 'form-control']) }}
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

  <!-- APPOINTEMENT -->
  <div id="modal-event" class="modal fade" tabindex="-1" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Agendar Hora</h4>
        </div>
        <div class="modal-body">
          <!-- PROFESIONAL -->
          <div class="form-group">
            {{ Form::label('_title', 'Profesional', ['id' => '_title_name']) }}
            {{ Form::text('_title', old('_title'), ['class' => 'form-control']) }}
          </div>
          <!-- SOCIO -->
          <div class="form-group">
            {{ Form::label('_socio', 'Socio', ['id' => '_socio_name']) }}
            {{ Form::input('text', '_socio', null, ['class' => 'form-control']) }}
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
          <!-- TIPO DE HORA -->
          <div class="form-group">
            {{ Form::label('type', 'Tipo') }}<br>
            <select class="form-control-inline" name="type" id="type">
              @foreach($types as $type)
              <option>{{$type->nombre}}</option>
              @endforeach
            </select>
          </div>
          <!-- COMENTARIOS -->
          <div class="form-group">
            {{ Form::label('_comentarios', 'Comentarios') }}
            {{ Form::input('text', '_comentarios', null, ['class' => 'form-control']) }}
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <a id="agendar" data-href="{{url('cites')}}" data-id="" class="btn btn-success">Agendar</a>
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
      aspectRatio: 2,


      select: function(start, end){
        start = moment(start.format());
        $('#date_start').val(start.format('YYYY-MM-DD'));
        $('#time_start').val(start.format('HH:mm:ss'));
        $('#date_end').val(end.format('YYYY-MM-DD'));
        $('#day').val(moment(start).day());
        $('#time_end').val(end.format('HH:mm:ss'));
        $('#responsive-modal').modal('show');
      },

      eventClick: function(event, jsEvent, view){
        var date_start = $.fullCalendar.moment(event.start).format('YYYY-MM-DD');
        var time_start = $.fullCalendar.moment(event.start).format('HH:mm:ss');
        var date_end = $.fullCalendar.moment(event.end).format('YYYY-MM-DD');
        var time_end = $.fullCalendar.moment(event.end).format('HH:mm:ss');
        var day = $.fullCalendar.moment(event.start).day();
        $('#modal-event #agendar').attr('data-id', event.id);
        $('#modal-event #_socio').val(event.profesional);
        $('#modal-event #_title').val(event.title);
        if (event.state == 0) {
          $('#modal-event #_socio').val(event.profesional);
          document.getElementById('_title_name').innerText = 'Socio';
          document.getElementById('_socio_name').innerText = 'Profesional';
        }
        $('#modal-event #_date_start').val(date_start);
        $('#modal-event #_time_start').val(time_start);
        $('#modal-event #_day').val(day);
        $('#modal-event #_date_end').val(date_end);
        $('#modal-event #_time_end').val(time_end);
        $('#modal-event').modal('show');
      },

      events: [
        {
          url: BASEURL+'events',
          //rendering: 'background' //deja disponibilidad como fondo
        }
      ]

      eventRender: function eventRender( event, element, view ) {
        return ['all', event].indexOf($('#sede').val()) >= 0
      }
		});
	});

  $('#sede').on('change',function(){
      $('#calendar').fullCalendar('rerenderEvents');
  })

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
    alert(delete_url);
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
     error: function(result){
       $('#modal-event').modal('hide');
       alert(result.message);
        location.reload();
     }
   })
 })

 $('#agendar').on('click', function(){
   var x = $(this);
   var update_url = x.attr('data-href')+'/'+x.attr('data-id');
   var formData = {
     profesional: $('#_title').val(),
     socio: $('#_socio').val(),
     date_start: $('#_date_start').val(),
     time_start: $('#_time_start').val(),
     time_end: $('#_time_end').val(),
     comentario: $('#_comentarios').val(),
     type: $('#type').val(),
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


@endsection
