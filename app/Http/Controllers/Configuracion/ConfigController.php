<?php

namespace App\Http\Controllers\Configuracion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Sede;
use App\Cargo;
use App\Client;
use App\Plan;
use App\Program;
use App\Sesion;
use App\Payment;
use App\Status;
use App\Size;
use App\Unity;
use App\ProgramType;
use App\Exercise;
use App\Implement;
use App\Pathology;
use App\PreguntaMedica;
use App\Achievement;
use App\Antecedente;
use App\PreguntaHabito;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $sedes = Sede::all();
      $cargos = Cargo::all();
      $clients = Client::all();
      $plans = Plan::all();
      $programs = Program::all();
      $sesions = Sesion::all();
      $payments = Payment::all();
      $statuses = Status::all();
      $sizes = Size::all();
      $unities = Unity::all();
      $programTypes = ProgramType::all();
      $exercises = Exercise::all();
      $implements = Implement::all();
      $pathologies = Pathology::all();
      $preguntas_medicas = PreguntaMedica::all();
      $logros = Achievement::all();
      $antecedentes = Antecedente::all();
      $habitos_vida = PreguntaHabito::where('tipo','vida')->get();
      $habitos_laboral = PreguntaHabito::where('tipo','laboral')->get();
      $habitos_salud = PreguntaHabito::where('tipo','salud')->get();
      $habitos_nutricion = PreguntaHabito::where('tipo','nutricion')->get();

      return view('configuracion.variables', ['cargos'=>$cargos,'sedes'=>$sedes, 'clients'=>$clients,
                  'plans'=>$plans,'programs'=>$programs,'sesions'=>$sesions,'payments'=>$payments,
                  'statuses'=>$statuses,'sizes'=>$sizes,'unities'=>$unities,'programTypes'=>$programTypes,
                  'exercises'=>$exercises,'implements'=>$implements, 'pathologies' => $pathologies,
                  'preguntas_medicas' => $preguntas_medicas, 'logros' => $logros, 'antecedentes' => $antecedentes,
                  'habitos_vida' => $habitos_vida, 'habitos_laboral' => $habitos_laboral, 'habitos_salud' => $habitos_salud,
                  'habitos_nutricion' => $habitos_nutricion]);
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

    public function store_cargo(Request $request){
      if( Gate::denies("edit-parameter")){
        abort(403,"No tienes permisos para realizar esta acción");
      }
      $cargo = new Cargo;
      $cargo->nombre = request('name');
      $cargo->save();
        return redirect('variables');
    }

    public function edit_cargo(Request $request, $id){
      if( Gate::denies("edit-parameter")){
        abort(403,"No tienes permisos para realizar esta acción");
      }
      try {
        $cargo= Cargo::findOrFail($id);
        if (request('name')!='') {
          $cargo->nombre = $request['name'];
        }
        $user->save();
        return redirect('variables');

      } catch (Exception $e) {

      }

    }
    public function destroy_cargo($id){
      if( Gate::denies("edit-parameter")){
        abort(403,"No tienes permisos para realizar esta acción");
      }
      try {
        $cargo=Cargo::findOrFail($id);
        $cargo->delete();
      } catch (Exception $e) {

      }
      return redirect('variables');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if( Gate::denies("edit-parameter")){
        abort(403,"No tienes permisos para realizar esta acción");
      }
      $sede = new Sede;
      $sede->codigo = request('first_name');
      $sede->nombre = request('first_name');
      $sede->direccion = request('first_name');
      $sede->ciudad = request('first_name');
      $sede->fono = request('first_name');
      $sede->save();
      return redirect('variables');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $sede = Sede::find($id);
      return Response::json($sede);
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
        //
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
