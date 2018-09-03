<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Profesional;
use App\Sede;
use Carbon\Carbon;
class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Event::where('state' ,1)->get();
        return Response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //saving days each weak until end date
        $fecha1 = new Carbon($request->date_start);
        $fecha2 = new Carbon($request->date_end);
        //saving hours each weak until end date
        $hora1 = $request->time_start;
        $hora2 = $request->time_end;
        //find profesional
        $prof = Profesional::find($request->title);
        error_log($request->time_start,0);

        for($date = $fecha1; $date->lte($fecha2); $date->addDay(7)) {
            #error_log($date,0);
            #do {
              $event = new Event();
              $profesionals = Profesional::all();
              #$parcial = date('h:i:s',strtotime($hora1.'+60 minutes'));
              $event->title = $prof->first_name.' '.$prof->last_name;
              $event->start = $date->format('Y-m-d').' '.$hora1;
              $event->end = $date->format('Y-m-d').' '.$hora2;
              $event->begin = $hora1;
              $event->finish = $hora2;
              $event->state = 1;
              $event->id_prof = $request->title;
              foreach ($profesionals as $profesional) {
                if ($profesional->first_name == $prof->first_name) {
                  $event->color = $profesional->color;
                }
              }
              //add relation values
              $event->save();
              foreach (request('sede') as $value) {
                $event->sedes()->attach($value);
              }
            #  $hora1 = date('h:i:s',strtotime($hora1.'+60 minutes'));
            #  error_log($hora1,0);
            #  error_log($hora2,0);
            #} while ($hora1 < $hora2);

        }
        return redirect('disponibilidad');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $event = Event::find($id);
      $profesionals = Profesional::all();
      $event->profesional = $request->title;
      if ($request->socio) {
        $event->profesional =  $request->profesional;
        $event->state =  0;
        $event->title = $request->socio;
      }

      $event->start = $request->date_start . ' ' . $request->time_start;
      $event->end = $request->date_start . ' ' . $request->time_end;
      foreach ($profesionals as $profesional) {
        if ($profesional->first_name == $request->title) {
          $event->color = $profesional->color;
        }
      }
      //add relation values
      foreach (request('sede') as $value) {
        $event->sedes()->attach($value);
      }
      $event->save();
      return response()->json([
          'message' => 'actualizado'
      ]);
    }

    /**
     * PROBLEMA NO ESTA PASANDO EL REQUEST !!!
     *
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $event = Event::find($id);
        if ($event == null){
          return Response()->json([
            'message' => 'eliminación incorrecta'
          ]);
        }

        $event->delete();
        return Response()->json([
          'message' => 'eliminación correcta'
        ]);
    }



}
