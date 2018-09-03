<?php

namespace App\Http\Controllers;

use App\WorkingDay;
use App\Profesional;
use Illuminate\Http\Request;

class WorkingDayController extends Controller
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
        WorkingDay::create([
            'profesional_id'=>request('profesional_id'),
            'date'=>date('Y-m-d'),
            'sede_id'=>1,
            'start'=>date("H:i:s"),
            'hours_worked'=>'00:00',
        ]);

        return redirect()->action('WorkingDayController@show', ['id' => request('profesional_id')]);
    }

    /**
     * en este caso despliega (muestra) todos los working days
     * del profesional $id.
     *
     * @param  \App\WorkingDay  $workingDay
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profesional= Profesional::find($id);
        $working_days= $profesional->workingDays;

        return view('administracion.working_days',compact('working_days','profesional'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WorkingDay  $workingDay
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkingDay $workingDay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WorkingDay  $workingDay
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $working_day= WorkingDay::find($id);
        $working_day->end= date("H:i:s");
        $working_day->hours_worked= date("H:i:s", strtotime("00:00:00")+strtotime($working_day->end)-strtotime($working_day->start));
        $working_day->save();

        return redirect()->action('WorkingDayController@show', ['id' => $working_day->profesional_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkingDay  $workingDay
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkingDay $workingDay)
    {
        //
    }
}
