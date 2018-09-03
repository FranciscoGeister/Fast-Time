<?php

namespace App\Http\Controllers;

use App\MemberDebt;
use App\Member;
use App\Payment;
use App\DebtHistory;
use App\ProfessionalDebt;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MemberDebtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        $memberDebts= Member::join('sales','members.id','=','sales.member_id')
                                    ->join('member_debts','sales.id','=','member_debts.sale_id')
                                    ->select('member_debts.*','members.id','members.nombre','members.rut', DB::raw('SUM(amount)'))
                                    ->groupBy('members.id')
                                    ->get();
        */
        $this->authorize("view",MemberDebt::class);
        $debtors= MemberDebt::join('members','member_debts.member_id','=','members.id')
                                ->select('member_debts.*','members.nombre','members.paterno','members.materno','members.rut','members.email')
                                ->get();

        $professionalDebtors= ProfessionalDebt::join('profesionals','professional_debts.profesional_id','=','profesionals.id')
                                                ->select('professional_debts.*','profesionals.first_name','profesionals.last_name','profesionals.mother_last_name',
                                                            'profesionals.email','profesionals.rut')
                                                ->get();
        return view('operacion.debts_index',compact('debtors','professionalDebtors'));
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
     * @param  \App\MemberDebt  $memberDebt
     * @return \Illuminate\Http\Response
     */
    public function show(MemberDebt $memberDebt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MemberDebt  $memberDebt
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $debt= MemberDebt::find($id);
        $this->authorize("update",$debt);
        $member= Member::find($debt->member_id);
        $payments= Payment::all();
        return view('operacion.debts_edit',compact('debt','member','payments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MemberDebt  $memberDebt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $debt= MemberDebt::find($id);
        $this->authorize("update",$debt);
        $debt->amount= $debt->amount-request('total_verified');
        if($debt->amount==0){
            $debt->delete();
        }
        else{
            $debt->save();
        }
        DebtHistory::create([
            'member_id'=>$debt->member_id,
            'amount'=>$request['total_verified'],
            'boleta'=>$request['boleta'],
        ]);
        return redirect('deudas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MemberDebt  $memberDebt
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
