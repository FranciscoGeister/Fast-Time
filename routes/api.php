<?php

use Illuminate\Http\Request;
use App\Member;
use App\MemberHasPlan;
use App\Plan;
use App\Hora;
use App\Pathology;
use App\PreguntaMedica;
use App\PreguntaMember;
use App\PathologyMember;
use App\Homework;
use App\Achievement;
use App\MemberAchievement;
use App\Antecedente;
use App\AntecedenteMember;
use App\PreguntaHabito;
use App\HabitoMember;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login',function(Request $req){
  	$data = $req->json()->all();
    $member = Member::where('email',$data['email'])
    ->join('statuses','statuses.id','=','members.estado')
    ->join('clients','clients.id','=','members.tipo')
    ->join('sedes','sedes.id','=','members.id_sucursal')
    ->select('*','statuses.nombre as estado','clients.nombre as tipo','sedes.nombre as nombre_sede',
           'members.nombre as nombre','members.id as id')
    ->firstOrFail();
    $ok = Hash::check($data['password'], $member->password);
    return response()->json([
      'ok' => $ok,
      'user' => $member
    ]);
});


Route::get('/plan/{member}',function(Member $member){
  $plan_prog = DB::table('member_has_plans')->where('member_id',$member->id)->where('active',1)->first();
  if($plan_prog->plan_or_prog == 1){
    $res = DB::table('members')
    ->join('member_has_plans','members.id','=','member_has_plans.member_id')
    ->join('member_has_sesions','member_has_plans.id','=','member_has_sesions.member_has_plan_id')
    ->join('plans','plans.id','=','member_has_plans.plan_id')
    ->join('sesions','sesions.id','=', 'member_has_sesions.tipo_sesion')
    ->where('member_has_plans.member_id',$member->id)
    ->where('member_has_plans.active','1')
    ->select('plans.nombre as nombre_plan','inicio','vencimiento','sesions.nombre as tipo_sesion',
              'cantidad','duracion','sesiones','sesi_semanal')
    ->get();
    return response($res);
  }
  else{
    $res = DB::table('members')
    ->join('member_has_plans','members.id','=','member_has_plans.member_id')
    ->join('member_has_sesions','member_has_plans.id','=','member_has_sesions.member_has_plan_id')
    ->join('programs','programs.id','=','member_has_plans.plan_id')
    ->join('sesions','sesions.id','=', 'member_has_sesions.tipo_sesion')
    ->where('member_has_plans.member_id',$member->id)
    ->where('member_has_plans.active','1')
    ->select('programs.nombre as nombre_plan','inicio','vencimiento','sesions.nombre as tipo_sesion',
              'cantidad','duracion','sesiones','sesi_semanal')
    ->get();
    return response($res);
  }
});

Route::get('/horas/{member}', function(Member $member){
  $horas = Hora::where('id_socio', $member->id)
  ->join('profesionals','profesionals.id','=','horas.id_prof')
  ->join('event_sede','event_sede.event_id','=','horas.event_id')
  ->join('sedes','sedes.id','=','event_sede.sede_id')
  ->join('statuses','horas.estado', '=', 'statuses.id')
  ->select('horas.id','horas.type','start','end','first_name','last_name','sedes.nombre as sede','statuses.nombre as estado')
  //->where('start','>=',date("Y-m-d H:i:s"))
  ->orderBy('start','asc')->get();
  return response($horas);
});

Route::post('/enviar_encuesta', function(Request $req){
  $data = $req->json()->all();
  $id = DB::table('encuestas')->insertGetId(
    ['id_socio' => $data['id'],
     'amigo' => $data['amigo'],
     'nos_revista' => $data['nos'],
     'tell_revista' => $data['tell'],
     'datos_revista' => $data['datos'],
     'el_sur_revista' => $data['club'],
     'otra_revista' => $data['otra'],
     'tv' => $data['tv'],
     'pantalla' => $data['pantalla'],
     'flyer' => $data['flyer'],
     'facebook' => $data['facebook'],
     'otras_redes' => $data['redes'],
     'otro' => $data['otro'],
      ]);
    if($id){
      $id = 1;
    }
    else{
      $id = 0;
    }
  return response($id);
});

Route::get('/respondio_encuesta/{member}', function(Member $member){
  $id = DB::table('encuestas')->where('id_socio',$member->id)->get();
  return response($id);
});

Route::post('/confirmar_hora', function(Request $req){
  $data = $req->json()->all();
  $res = DB::table('horas')
  ->where('id', $data['id'])
  ->update(['estado' => $data['val']]);
  return response($res);
});

Route::get('/evaluaciones/{member}', function(Member $member){
    return response(
      DB::table('evaluation_sheets')
      ->join('member_has_plans','member_has_plans.id','=','evaluation_sheets.member_has_plan_id')
      ->join('evaluation_sessions','evaluation_sessions.evaluation_sheet_id','=','evaluation_sheets.id')
      ->where('member_has_plans.member_id',$member->id)
      ->select('evaluation_sheets.meta_entrenamiento as meta','evaluation_sheets.hist_medic',
                'evaluation_sessions.*')
      ->orderBy('evaluation_sessions.tipo','asc')->get()
    );
    /*$plan = App\MemberHasPlan::where('member_id',$member->id)->where('active',1)->first();
    $evaluation = App\EvaluationSheet::where('member_has_plan_id',$plan->id)->get();
    return response($evaluation);*/
});

Route::get('/campañas/{member}', function(Member $member){
    return response(
      Member::find($member->id)->campañas
    );
});

Route::get('/encuesta_larga/{member}', function(Member $member){
    $patologias = Pathology::all();
    $lesiones_socio = $member->patologias;
    foreach($lesiones_socio as $ls){
      foreach($patologias as $pa){
        if($pa['id'] == $ls['id']){
          $pa->{"marca"} = true;
        }
      }
    }
    $preguntas_medicas = PreguntaMedica::all();
    $respuestas = PreguntaMember::where('member_id',$member->id)->get();
    foreach($respuestas as $resp){
      foreach($preguntas_medicas as $preg){
        if($resp['pregunta_id'] == $preg['id']){
          $preg->{"respuesta"} = $resp['respuesta'];
        }
      }
    }
    $antecedentes = Antecedente::all();
    $antecedentes_socio = $member->antecedentes;
    foreach($antecedentes_socio as $ant_soc){
      foreach($antecedentes as $ant){
        if($ant['id'] == $ant_soc['id']){
          $ant->{"marca"} = true;
        }
      }
    }
    $vida = PreguntaHabito::where('tipo','vida')->get();
    $laboral = PreguntaHabito::where('tipo','laboral')->get();
    $salud = PreguntaHabito::where('tipo','salud')->get();
    $nutricion = PreguntaHabito::where('tipo','nutricion')->get();
    $habitos_socio = DB::table('preguntas_habitos_members')->where('member_id',$member->id)->get();
    foreach($habitos_socio as $hs){
      foreach($vida as $v){
        if($hs->pregunta_id == $v['id']){
          $v->{"respuesta"} = $hs->respuesta;
        }
      }
      foreach($laboral as $l){
        if($hs->pregunta_id == $l['id']){
          $l->{"respuesta"} = $hs->respuesta;
        }
      }
      foreach($salud as $s){
        if($hs->pregunta_id == $s['id']){
          $s->{"respuesta"} = $hs->respuesta;
        }
      }
      foreach($nutricion as $n){
        if($hs->pregunta_id == $n['id']){
          $n->{"respuesta"} = $hs->respuesta;
        }
      }
    }
    return response()->json([
      'categorias' => [
        ['nombre' => 'Patologias y Enfermedades',
         'lesiones' => $patologias],
        ['nombre' => 'Historial Médico',
         'preguntas' => $preguntas_medicas],
        ['nombre' => 'Antecedentes Personales',
         'antecedentes' => $antecedentes],
        ['nombre' => 'Hábitos de Vida',
         'habitos' => $vida],
        ['nombre' => 'Hábitos Laborales',
         'habitos' => $laboral],
        ['nombre' => 'Hábitos No Saludables',
         'habitos' => $salud],
        ['nombre' => 'Hábitos Nutricionales',
         'habitos' => $nutricion],
       ]
     ]);
});


Route::post('/guardar_encuesta', function(Request $req){
  $data = $req->json()->all();
  foreach($data['categorias']['1']['preguntas'] as $pregunta){
    if(isset( $pregunta['respuesta'] ) ){
      PreguntaMember::updateOrCreate(
        ['member_id' => $data['user'], 'pregunta_id' => $pregunta['id']],
        ['respuesta' => $pregunta['respuesta']]
      );
    }
    else{
      $borrar = PreguntaMember::where('member_id',$data['user'])->where('pregunta_id',$pregunta['id'])->first();
      if($borrar != null){
        $borrar->delete();
      }
    }
  }
  foreach($data['categorias']['0']['lesiones'] as $lesion){
    if( isset($lesion['marca'])){
      if($lesion['marca'] == true){
        PathologyMember::firstOrCreate(['pathology_id' => $lesion['id'], 'member_id' => $data['user']]);
      }
      else{
        $borrar = PathologyMember::where('pathology_id',$lesion['id'])->where('member_id',$data['user'])->first();
        if($borrar != null){
          $borrar->delete();
        }
      }
    }
    else{
      $borrar = PathologyMember::where('pathology_id',$lesion['id'])->where('member_id',$data['user'])->first();
      if($borrar != null){
        $borrar->delete();
      }
    }
  }
  foreach($data['categorias']['2']['antecedentes'] as $antecedente){
    if( isset($antecedente['marca'])){
      if($antecedente['marca'] == true){
        AntecedenteMember::firstOrCreate(['antecedente_id' => $antecedente['id'], 'member_id' => $data['user']]);
      }
      else{
        $borrar = AntecedenteMember::where('antecedente_id',$antecedente['id'])->where('member_id',$data['user'])->first();
        if($borrar != null){
          $borrar->delete();
        }
      }
    }
    else{
      $borrar = AntecedenteMember::where('antecedente_id',$antecedente['id'])->where('member_id',$data['user'])->first();
      if($borrar != null){
        $borrar->delete();
      }
    }
  }
  foreach($data['categorias']['3']['habitos'] as $habito){
    if( isset($habito['respuesta'])){
      HabitoMember::updateOrCreate(
        ['member_id' => $data['user'], 'pregunta_id' => $habito['id']],
        ['respuesta' => $habito['respuesta']]
      );
    }
    else{
      $borrar = HabitoMember::where('member_id',$data['user'])->where('pregunta_id',$habito['id'])->first();
      if($borrar != null){
        $borrar->delete();
      }
    }
  }
  foreach($data['categorias']['4']['habitos'] as $habito){
    if( isset($habito['respuesta'])){
      HabitoMember::updateOrCreate(
        ['member_id' => $data['user'], 'pregunta_id' => $habito['id']],
        ['respuesta' => $habito['respuesta']]
      );
    }
    else{
      $borrar = HabitoMember::where('member_id',$data['user'])->where('pregunta_id',$habito['id'])->first();
      if($borrar != null){
        $borrar->delete();
      }
    }
  }
  foreach($data['categorias']['5']['habitos'] as $habito){
    if( isset($habito['respuesta'])){
      HabitoMember::updateOrCreate(
        ['member_id' => $data['user'], 'pregunta_id' => $habito['id']],
        ['respuesta' => $habito['respuesta']]
      );
    }
    else{
      $borrar = HabitoMember::where('member_id',$data['user'])->where('pregunta_id',$habito['id'])->first();
      if($borrar != null){
        $borrar->delete();
      }
    }
  }
  foreach($data['categorias']['6']['habitos'] as $habito){
    if( isset($habito['respuesta'])){
      HabitoMember::updateOrCreate(
        ['member_id' => $data['user'], 'pregunta_id' => $habito['id']],
        ['respuesta' => $habito['respuesta']]
      );
    }
    else{
      $borrar = HabitoMember::where('member_id',$data['user'])->where('pregunta_id',$habito['id'])->first();
      if($borrar != null){
        $borrar->delete();
      }
    }
  }
  return response(1);
});

Route::get('/tareas/{member}', function(Member $member){
  $tareas = Homework::join('exercises','homeworks.exercise_id','=','exercises.id')
  ->join('profesionals','homeworks.profesional_id','=','profesionals.id')
  ->where('member_id',$member->id)
  ->select('homeworks.id', 'exercises.nombre as nombre_ejercicio','profesionals.first_name as nombre_profesor',
  'profesionals.last_name as apellido_profesor','exercises.video','exercises.foto','comment','series','repetitions','rest','completed')->get();
  return response($tareas);
});

Route::post('/actualizarTareas', function(Request $req){
  $data = $req->json()->all();
  $member = $data['0'];
  for($i = 1; $i < sizeof($data); $i++){
    $tarea = Homework::find($data[$i]['id']);
    $tarea->completed = $data[$i]['completed'];
  }
  return response($tarea);
});

Route::get('/logros/{member}', function(Member $member){
  return response($member->achievements);
});

Route::get('/logros', function(){
  return response(Achievement::all());
});

Route::post('/completeAchievement', function(Request $req){
  $data = $req->json()->all();
  $ret = MemberAchievement::firstOrCreate([
    'member_id' => $data['user']['id'],
    'achievement_id' => $data['achievement']
  ]);
  return response($ret['id']);
});

Route::get('/habitos/{member}',function(Member $member){
  //return response($member->habitos);
  $var = DB::table('preguntas_habitos_members')->where('member_id',$member->id)->get();
  foreach($var as $v){
    echo $v->id;
  }
});
