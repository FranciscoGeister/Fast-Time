<?php

namespace App\Http\Controllers\Horas;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Hora;
use App\Sesion;
use App\Event;
use App\Sede;
use App\Member;
use App\Profesional;
use Carbon\Carbon;
use App\Status;
use App\MemberHasPlan;
use App\Plan;
use App\Program;
use App\Size;
use App\MemberDebt;
use App\Machine;
class CitasController extends Controller
{
  //return events filtered by sede_id
     public function event_sede($id)
     {
       error_log($id,0);
        $event=array();
        $event_sede = DB::table('event_sede')->get();
        //if user don't select option yet
        if ($id == 9999) {
          return false;
        }
        //show all events
        if ($id == 8888) {
          $events = Event::all();
          return Response()->json($events);
        }
        //Search event by sede filter
        foreach ($event_sede as $e_s) {
          if ($e_s->sede_id == $id) {
            $e = Event::find($e_s->event_id);
            array_push($event,$e);
          }
        }
        return Response()->json($event);
     }

     public function event_machine($id)
     {
       error_log($id,0);
        $event2=array();
        $event_sede = DB::table('event_sede')->get();
        //if user don't select option yet
        if ($id == 9999) {
          return false;
        }
        //show all events
        if ($id == 8888) {
          $events = Event::all();
          return Response()->json($events);
        }

        //find the machine to know the sede_id
        $machine = Machine::find($id);
        //Search event by sede filter
        foreach ($event_sede as $e_s) {
          if ($e_s->sede_id == $machine->sede_id) {
            $e = Event::find($e_s->event_id);
            array_push($event2,$e);
          }
        }
        return Response()->json($event2);
     }

     //return events filtered by sede_id
        public function hour_sede($id)
        {
           //$hours=array();
           //$horas = Hora::all();
           if ($id == 9999) {
             return false;
           }
           //show all events
           if ($id == 8888) {
             $events = Hora::all();
             return Response()->json($events);
           }
           /*
           foreach ($horas as $h) {
             $event_id = $h->event_id;
             $sede_id = $h->sede_id;
             $event_sede = DB::table('event_sede')
             ->where('event_id', '=', $event_id)
             ->get();
             //error_log($event_id,0);
             foreach ($event_sede as $e_s) {
               if ($e_s->sede_id == $id) {
                 //error_log($e_s->event_id,0);
                 array_push($hours,$h);
               }
             }
           }
           */
           $horas = Hora::where('machine_id',$id)->get();
           return Response()->json($horas);
        }

     //return events from specific Sede
     public function ver_citas(){
       $types = Sesion::all();
       //$sedes = Sede::all();
       $machines = Machine::join('sedes','machines.sede_id','=','sedes.id')
                          ->select('machines.*','sedes.nombre as sede_nombre')
                          ->get();
       $events = Event::all();
       $profesionals = Profesional::all();
       $status = Status::all();
       $members = Member::all();
      return view('operacion.agendar_hora', ['status'=>$status,
                                             'events'=>$events,
                                             'profesionales'=>$profesionals,
                                             'machines'=> $machines,
                                             'types' => $types,
                                             'members' => $members]);
     }

     //Return information about plans/program of user
     public function member_info($id)
     {
        $ss=array();
        $members = Member::all();
        foreach ($members as $member) {
          $c_name = $member->nombre." ".$member->paterno." ".$member->materno;
          if ($c_name == $id) {
            $mem = $member;
          }
        }

        $member_sesion = DB::table('member_has_sesions')
        ->where('member_id', '=', $mem->id)
        ->get();

        foreach ($member_sesion as $s_id) {
          if ($mem->id == $s_id->member_id) {
            $sesions = Sesion::find($s_id->tipo_sesion);
            array_push($ss,$sesions->nombre);
            array_push($ss,$s_id->cantidad);
            error_log($s_id->cantidad,0);
          }
        }

        $debt = MemberDebt::where('member_id',$mem->id)->first();
        if($debt!=null)
          $amount = $debt->amount;
        else
          $amount = 0;

        return Response()->json(['sesiones'=>$ss,'deuda'=>$amount]);
     }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->authorize('create',Hora::class);
      $event = Event::find($request->title);
      $fecha1 = new Carbon($request->date_start);
      $hora1 = $request->time_start;
      $hora2 = $request->time_end;
      $socio = Member::find($request->member_id);
      /*
      //problemas con socios con dos nombres
      $pieces = explode(" ", $request->socio);
      $socio = Member::where('nombre', '=', $pieces[0])
                     ->where('paterno', '=', $pieces[1])
                     ->where('materno', '=', $pieces[2])
                     ->get();
      */
      $hour = new Hora();
      $hour->title = $request->socio;
      $hour->id_prof = $event->id_prof;
      $hour->id_socio = $socio->id;
      $hour->socio =$request->socio;
      $hour->start = $fecha1->format('Y-m-d').' '.$hora1;
      $hour->end = $fecha1->format('Y-m-d').' '.$hora2;
      $hour->begin = $hora1;
      $hour->finish = $hora2;
      $hour->event_id = $event->id;
      $hour->description = $request->_comentarios;
      $hour->estado = $request->status;
      $hour->type = $request->type;
      $hour->color = "#fff67a";
      $hour->machine_id = $request->sede;
      //error_log($hour->type,0);
      $hour->save();
      //caducidad de planes
      if($request->status==1){
        $hour->color = "#82E0AA";
        $hour->save();
        $memberHasPlan= MemberHasPlan::where('member_id',$socio->id)->where('active',1)->first();
        if ($memberHasPlan!=null) {
          if ($memberHasPlan->inicio==null) {
            if($memberHasPlan->plan_or_prog==1){
              $plan= Plan::find($memberHasPlan->plan_id);
            }
            else{
              $plan= Program::find($memberHasPlan->plan_id);
            }
            $duracion= $plan->duracion;
            $fecha = date('Y-m-j');
            $nuevafecha = strtotime ( '+'.$duracion.' day' , strtotime ( $fecha ) ) ;
            $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
            $memberHasPlan->inicio= $fecha;
            $memberHasPlan->vencimiento= $nuevafecha;
            $memberHasPlan->save();
          }
          $sessions= $memberHasPlan->sessions;
          foreach ($sessions as $session) {
            $tipo_sesion=Sesion::where('nombre',$hour->type)->first();
            if ($session->tipo_sesion==$tipo_sesion->id) {
              $session->cantidad=$session->cantidad-1;
              $session->save();
              if ($session->cantidad==0) {
                $session->delete();
              }
            }
          }
        }
      }
      return redirect('agendar_hora');
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
        $this->authorize('create',Hora::class);
        error_log($id,0);
        $hour = Hora::find($id);
        $fecha1 = new Carbon($request->date_start);
        $hora1 = $request->time_start;
        $hora2 = $request->time_end;

        $hour->id_prof = $request->profesional;
        $hour->start = $fecha1->format('Y-m-d').' '.$hora1;
        $hour->end = $fecha1->format('Y-m-d').' '.$hora2;
        $hour->begin = $hora1;
        $hour->finish = $hora2;
        $hour->description = $request->comentario;
        error_log($request,0);
        $hour->estado = $request->estado;
        $hour->type = $request->type;
        if ($request->estado == 1) {
          $hour->color = "#82E0AA";
          $memberHasPlan= MemberHasPlan::where('member_id',$hour->id_socio)->where('active',1)->first();
          if($memberHasPlan!=null){
            if ($memberHasPlan->inicio==null) {
              if($memberHasPlan->plan_or_prog==1){
                $plan= Plan::find($memberHasPlan->plan_id);
              }
              else{
                $plan= Program::find($memberHasPlan->plan_id);
              }
              $duracion= $plan->duracion;
              $fecha = date('Y-m-j');
              $nuevafecha = strtotime ( '+'.$duracion.' day' , strtotime ( $fecha ) ) ;
              $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
              $memberHasPlan->inicio= $fecha;
              $memberHasPlan->vencimiento= $nuevafecha;
              $memberHasPlan->save();
            }
            $sessions= $memberHasPlan->sessions;
            foreach ($sessions as $session) {
              $tipo_sesion=Sesion::where('nombre',$hour->type)->first();
              if ($session->tipo_sesion==$tipo_sesion->id) {
                $session->cantidad=$session->cantidad-1;
                $session->save();
                if ($session->cantidad==0) {
                  $session->delete();
                }
              }
            }
          }
        }
        if ($request->estado == 2) {
          $hour->color = "#fff67a";
        }
        if ($request->estado == 5) {
          $hour->color = "#ff7777";
        }
        error_log($hour,0);
        $hour->save();
    }

    public function delete($id)
    {

      $this->authorize('create',Hora::class);
      $hora = Hora::find($id);
      if ($hora == null)
        return Response()->json([
          'message' => 'eliminación incorrecta'
        ]);
      $hora->delete();
      return Response()->json([
        'message' => 'eliminación correcta'
      ]);
    }

}
