<?php

namespace App\Http\Controllers;

use App\EvaluationSheet;
use Illuminate\Http\Request;
use App\Member;
use App\MemberHasPlan;
use App\PersonalFile;

class EvaluationSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members= Member::join('member_has_plans','members.id','=','member_has_plans.member_id')->select('members.*')->groupBy('members.id')->get();
        return view('operacion.registro_evaluaciones',compact('members'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EvaluationSheet  $evaluationSheet
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member= Member::find($id);
        $memberHasPlan= MemberHasPlan::where('member_id',$id)->where('active',1)->first();
        $evaluationSheet= EvaluationSheet::where('member_has_plan_id',$memberHasPlan->id)->first();
        $evaluationSessions= $evaluationSheet->evaluationSessions()->join('profesionals','evaluation_sessions.profesional_id','=','profesionals.id')->select('evaluation_sessions.*','profesionals.first_name','profesionals.last_name')->get();
        $personalFile= PersonalFile::where('member_id',$id)->first();
        $homeworks= $evaluationSheet->homeWorks()->join('exercises','evaluation_homeworks.exercise_id','=','exercises.id')->get();    
       
        return view('operacion.ficha_evaluaciones',compact('member','evaluationSheet','evaluationSessions','personalFile','homeworks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EvaluationSheet  $evaluationSheet
     * @return \Illuminate\Http\Response
     */
    public function edit(EvaluationSheet $evaluationSheet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EvaluationSheet  $evaluationSheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EvaluationSheet $evaluationSheet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EvaluationSheet  $evaluationSheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(EvaluationSheet $evaluationSheet)
    {
        //
    }
}
