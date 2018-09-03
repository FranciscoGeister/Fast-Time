<?php

namespace App\Http\Controllers\Personal;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profesional;
use App\Cargo;
use App\Sede;
use App\Event;
use Freshwork\ChileanBundle\Rut;
use Illuminate\Support\Facades\Validator;
class PersonalController extends Controller
{
  public function index()
  {
    $this->authorize('view',Profesional::class);
    $cargos= Cargo::all();
    $sedes= Sede::all();
      return view('administracion.create', ['cargos'=>$cargos, 'sedes'=>$sedes]);
  }

  public function store(Request $request){
    $this->authorize('view',Profesional::class);
    $profesional = new Profesional;
    $profesional->first_name = request('first_name');
    $profesional->last_name = request('last_name');
    $profesional->mother_last_name = request('mother_last_name');
    $profesional->nacimiento = request('nacimiento');
    $profesional->link = request('link');
    $profesional->contracted_hours = request('contracted_hours');

    if ( Rut::parse(request('rut'))->validate()){
      $profesional->rut = request('rut');
    }else{
      return redirect('agregar')->with('status', 'RUT invalido!');
    }
    $tipo = request('tipo');
    $id_cargo = Cargo::where('nombre',$tipo)->firstOrFail();
    $profesional->tipo = $id_cargo->id;
    $profesional->celular = request('celular');
    $profesional->email = request('email');
    $profesional->color = request('color');
    //foto perfil y huella
    if (request()->hasFile('avatar')) {
      $profesional->avatar= request()->file('avatar')->store('public/avatar');
    }
    else{
      $profesional->avatar= "default.png";
    }
    if (request()->hasFile('huella')) {
      $profesional->huella= request()->file('huella')->store('public/huella');
    }
    else{
      $profesional->huella= "default-huella.png";
    }
    $profesional->estado = 3;
    $profesional->save();

    //add relation values
    foreach (request('sede') as $value) {
      $profesional->sedes()->attach($value);
    }
    return redirect('personal');

  }

  public function download(){
    $this->authorize('view',Profesional::class);
    $profesionals = Profesional::where('estado',3)->get();
    $sedes = Sede::all();
    $prof_sede = DB::table('profesional_sede')->get();
    $cargos = Cargo::all();
    return view('administracion.ver_personal', ['profesionales'=>$profesionals, 'prof_sede'=>$prof_sede,  'sedes'=>$sedes, 'cargos'=>$cargos]);
  }

  // Update user
  public function update(Request $request, $id)
  {
      $this->authorize('view',Profesional::class);
      try{
          //Find the user object from model if it exists
          $user= Profesional::findOrFail($id);
          $events = Event::all();
          $user->first_name = request('first_name');
          $user->last_name = request('last_name');
          $user->mother_last_name = request('mother_last_name');
          $user->nacimiento = request('nacimiento');
          $user->link = request('link');
          $user->contracted_hours = request('contracted_hours');

          if ( Rut::parse(request('rut'))->validate()){
            echo 'es verdadero';
            $user->rut = request('rut');
          }else{
            echo 'el rut es invalido';
          }
          $tipo = request('tipo');
          $id_cargo = Cargo::where('nombre',$tipo)->firstOrFail();
          $user->tipo = $id_cargo->id;
          $user->celular = request('celular');
          $user->email = request('email');
          $user->color = request('color');
          foreach ($events as $event) {
            if ($event->title == $user->first_name) {
              $event->color = request('color');
              $event->save();
            }
          }
          if (request()->hasFile('avatar')) {
            $user->avatar= request()->file('avatar')->store('public');
          }
          if (request()->hasFile('huella')) {
            $user->huella= request()->file('huella')->store('public');
          }
          $user->save();
          //add relation values
          if (request('sede')>0) {
            $user->sedes()->detach();
            foreach (request('sede') as $value)
            {
            $user->sedes()->attach($value);
            }
          }else{
            $user->sedes()->detach();
          }

          return redirect('personal');
      }
      catch(ModelNotFoundException $err){
          //Show error page
      }
  }

  public function gotoedit(Request $request, $id){
      $this->authorize('view',Profesional::class);
      $user       = Profesional::findOrFail($id);
      $cargos     = Cargo::all();
      $sedes      = Sede::all();
      $user_sedes = $user->sedes;
      if (sizeof($user_sedes) > 0) {
        return view('administracion.edit_personal',  ['cargos'=>$cargos,'user'=>$user ,'user_sedes'=>$user_sedes,  'sedes'=>$sedes]);
      }else{
        $user_sedes = [];
        return view('administracion.edit_personal',  ['cargos'=>$cargos,'user'=>$user, 'user_sedes'=>$user_sedes,  'sedes'=>$sedes]);
      }

  }

  public function delete($id){
    $this->authorize('view',Profesional::class);
    $prof = Profesional::find($id);
    $prof->estado = 4;
    $prof->save();
    return redirect('personal');
  }



}
