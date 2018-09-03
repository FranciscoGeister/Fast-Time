<?php

namespace App\Http\Controllers;

use App\ProfessionalDebtHistory;
use App\Profesional;
use Illuminate\Http\Request;

class ProfessionalDebtHistoryController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProfessionalDebtHistory  $professionalDebtHistory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $debtHistory= ProfessionalDebtHistory::where('profesional_id',$id)->get();
        $professional= Profesional::find($id);

        return view('operacion.debtHistory_professional',compact('debtHistory','professional'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProfessionalDebtHistory  $professionalDebtHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProfessionalDebtHistory $professionalDebtHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProfessionalDebtHistory  $professionalDebtHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProfessionalDebtHistory $professionalDebtHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProfessionalDebtHistory  $professionalDebtHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfessionalDebtHistory $professionalDebtHistory)
    {
        //
    }
}
