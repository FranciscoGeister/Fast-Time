<?php

namespace App\Http\Controllers\Horas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\Profesional;
use App\Sede;
use App\Member;
use App\Hora;
use App\Sesion;
use App\Status;
class HorasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $events= Event::all();
      $sedes = Sede::all();
      $clientes = Member::all();
      $profesionales = Profesional::all();
      $horas = Hora::all();
      $types = Sesion::all();
      
      return view('operacion.agendar_hora', ['profesionales'=>$profesionales, 'types'=>$types,'members'=>$clientes,'sedes'=>$sedes,'events'=>$events]);
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
      if ($event->disponible === 1) {
        if ($event->finish === $request->time_end) {
            $event->disponible = 0;
        }else{
          $event->disponible = 1;
        }
        $hora = new Hora();
        $hora->title = $request->socio;
        $hora->profesional = $request->profesional;
        $hora->socio = $request->socio;
        $hora->start = $request->date_start.' '.$request->time_start;
        $hora->end =  $request->date_start.' '.$request->time_end;
        $hora->event_id = $id;
        $hora->begin = $request->time_start;
        $hora->finish = $request->time_end;
        $hora->description = $request->comentario;
        $hora->estado =  false;
        $hora->color =  '#00FF00';
        $hora->save();
        $event->save();
        return response()->json([
            'message' => 'actualizado'
        ]);
      }else{
        return response()->json([
            'message' => 'error'
        ]);
      }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
