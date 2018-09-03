<?php

namespace App\Http\Controllers;

use App\ProfessionalDebt;
use App\Profesional;
use App\Payment;
use App\ProfessionalDebtHistory;
use Illuminate\Http\Request;

class ProfessionalDebtController extends Controller
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
     * @param  \App\ProfessionalDebt  $professionalDebt
     * @return \Illuminate\Http\Response
     */
    public function show(ProfessionalDebt $professionalDebt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProfessionalDebt  $professionalDebt
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $debt= ProfessionalDebt::find($id);
        $professional= Profesional::find($debt->profesional_id);
        $payments= Payment::all();
        return view('operacion.debts_edit_professional',compact('debt','professional','payments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProfessionalDebt  $professionalDebt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $debt= ProfessionalDebt::find($id);
        $debt->amount= $debt->amount-request('total_verified');
        if($debt->amount==0){
            $debt->delete();
        }
        else{
            $debt->save();
        }
        ProfessionalDebtHistory::create([
            'profesional_id'=>$debt->profesional_id,
            'amount'=>$request['total_verified'],
        ]);  
        return redirect('deudas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProfessionalDebt  $professionalDebt
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfessionalDebt $professionalDebt)
    {
        //
    }
}
