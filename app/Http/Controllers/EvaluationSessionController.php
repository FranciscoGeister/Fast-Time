<?php

namespace App\Http\Controllers;

use App\EvaluationSession;
use App\Exercise;
use App\Homework;
use App\EvaluationHomework;
use App\Profesional;
use Illuminate\Http\Request;

class EvaluationSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize("create",EvaluationSession::class);
        $evaluation_sheet_id= $request['evaluation_sheet_id'];
        $member_id= $request['member_id'];
        $tipo= $request['tipo'];
        $exercises= Exercise::all();
        $professionals= Profesional::all();
        return view('operacion.evaluacion_create',compact('evaluation_sheet_id','member_id','tipo','exercises','professionals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $this->authorize("create",EvaluationSession::class);
        $evaluationSession = EvaluationSession::create([
            'evaluation_sheet_id'=>$request['evaluation_sheet_id'],
            'tipo'=>$request['tipo'],
            'fecha'=>$request['fecha'],
            'hora'=>$request['hora'],
            'peso'=>$request['peso'],
            'circunferencia'=>$request['circunferencia'],
            'pliegues'=>$request['pliegues'],
            'pecho'=>$request['pecho'],
            'tricipital'=>$request['tricipital'],
            'cintura'=>$request['cintura'],
            'bicipital'=>$request['bicipital'],
            'cont_iliaco'=>$request['cont_iliaco'],
            'subescapular'=>$request['subescapular'],
            'cadera'=>$request['cadera'],
            'suprailiaco'=>$request['suprailiaco'],
            'muslo'=>$request['muslo'],
            'bisep_der'=>$request['bisep_der'],
            'total_cont'=>$request['total_cont'],
            'total_pliegues'=>$request['total_pliegues'],
            'profesional_id'=>$request['coach_id'],
        ]);
        if($request['exercises']!=null){
            $exercises= $request['exercises'];
            $series= $request['series'];
            $repetitions= $request['repetitions'];
            $rest=$request['rest'];
            for ($i=0; $i<sizeof($exercises) ; $i++) {
                EvaluationHomework::create([
                    'member_id'=>$request['member_id'],
                    'exercise_id'=>$exercises[$i],
                    'series'=>$series[$i],
                    'repetitions'=>$repetitions[$i],
                    'rest'=>$rest[$i],
                    'profesional_id'=>$request['coach_id'],
                    'evaluation_session_id'=>$evaluationSession->id,
                    'evaluation_sheet_id'=>$request['evaluation_sheet_id'],
                ]);
            }
        }

        return redirect()->action('EvaluationSheetController@show', ['id' => $request['member_id']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EvaluationSession  $evaluationSession
     * @return \Illuminate\Http\Response
     */
    public function show(EvaluationSession $evaluationSession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EvaluationSession  $evaluationSession
     * @return \Illuminate\Http\Response
     */
    public function edit(EvaluationSession $evaluationSession)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EvaluationSession  $evaluationSession
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EvaluationSession $evaluationSession)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EvaluationSession  $evaluationSession
     * @return \Illuminate\Http\Response
     */
    public function destroy(EvaluationSession $evaluationSession)
    {
        //
    }
}
