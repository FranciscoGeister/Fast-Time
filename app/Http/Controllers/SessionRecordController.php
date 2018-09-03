<?php

namespace App\Http\Controllers;

use App\SessionRecord;
use App\Profesional;
use App\Exercise;
use App\Homework;
use App\Cycle;
use App\SessionTab;
use Illuminate\Http\Request;

class SessionRecordController extends Controller
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
        $this->authorize("create",SessionTab::class);
        $profesionals= Profesional::all();
        $cycle_id= request('cycle_id');
        $cycle=Cycle::find($cycle_id);
        /*
        $rpe_wu_min=$cycle->rpe_wu_min;
        $rpe_wu_max=$cycle->rpe_wu_max;
        $rpe_acc_min=$cycle->rpe_acc_min;
        $rpe_acc_max=$cycle->rpe_acc_max;
        $rpe_stab_min=$cycle->rpe_stab_min;
        $rpe_stab_max=$cycle->rpe_stab_max;
        $rpe_str_min=$cycle->rpe_str_min;
        $rpe_str_max=$cycle->rpe_str_max;
        */
        $session_tab_id= request('session_tab_id');
        $member_id= request('member_id');
        $exercises= Exercise::all();
        return view('operacion.session_record_create', compact('profesionals','cycle','session_tab_id','exercises','member_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize("create",SessionTab::class);
        $sessionRecord= sessionRecord::create($request->all());

        if($request['exercises']!=null){
            $exercises= $request['exercises'];
            $series= $request['series'];
            $repetitions= $request['repetitions'];
            $rest=$request['rest'];
            for ($i=0; $i<sizeof($exercises) ; $i++) {
                homework::create([
                    'member_id'=>$request['member_id'],
                    'exercise_id'=>$exercises[$i],
                    'series'=>$series[$i],
                    'repetitions'=>$repetitions[$i],
                    'rest'=>$rest[$i],
                    'profesional_id'=>$request['coach_id'],
                    'session_record_id'=>$sessionRecord->id,
                    'session_tab_id'=>$sessionRecord->session_tab_id,
                ]);
            }
        }
        return redirect()->action('SessionTabController@show', ['id' => request('member_id')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SessionRecord  $sessionRecord
     * @return \Illuminate\Http\Response
     */
    public function show(SessionRecord $sessionRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SessionRecord  $sessionRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(SessionRecord $sessionRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SessionRecord  $sessionRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SessionRecord $sessionRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SessionRecord  $sessionRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(SessionRecord $sessionRecord)
    {
        //
    }
}
