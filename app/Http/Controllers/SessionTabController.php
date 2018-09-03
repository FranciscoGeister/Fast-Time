<?php

namespace App\Http\Controllers;

use App\SessionTab;
use Illuminate\Http\Request;
use App\Member;
use App\MemberHasPlan;
use App\Profesional;
use App\PersonalFile;
use App\Homework;


class SessionTabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("index",SessionTab::class);
        $members= Member::join('member_has_plans','members.id','=','member_has_plans.member_id')->select('members.*')->groupBy('members.id')->get();
        return view('operacion.registroSesion',compact('members'));
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
     * @param  \App\SessionTab  $sessionTab
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $member= Member::find($id);
        $coaches= Profesional::all();
        $memberHasPlan= MemberHasPlan::where('member_id',$id)->where('active',1)->first();
        $sessionTab= SessionTab::where('member_has_plan_id',$memberHasPlan->id)->first();
        $this->authorize("view",$sessionTab);
        $cycles= $sessionTab->cycles;
        $sessionRecords= $sessionTab->sessionRecords;
        $homeworks= $sessionTab->homeWorks()->join('exercises','homeworks.exercise_id','=','exercises.id')->get();
        $personalFile= PersonalFile::where('member_id',$id)->first();
        return view('operacion.sessionTab',compact('member','coaches','sessionRecords','sessionTab','cycles','personalFile','homeworks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SessionTab  $sessionTab
     * @return \Illuminate\Http\Response
     */
    public function edit(SessionTab $sessionTab)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SessionTab  $sessionTab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SessionTab $sessionTab)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SessionTab  $sessionTab
     * @return \Illuminate\Http\Response
     */
    public function destroy(SessionTab $sessionTab)
    {
        //
    }
}
