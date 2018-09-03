<?php

namespace App\Http\Controllers;

use App\MemberHasSesion;
use App\Member;
use App\MemberHasPlan;
use Illuminate\Http\Request;

class MemberHasSesionController extends Controller
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
     * Display the specified resource.
     *
     * @param  \App\MemberHasSesion  $memberHasSesion
     * @return \Illuminate\Http\Response
     */
    public function show(MemberHasSesion $memberHasSesion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MemberHasSesion  $memberHasSesion
     * @return \Illuminate\Http\Response
     */
    public function edit(MemberHasSesion $memberHasSesion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MemberHasSesion  $memberHasSesion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MemberHasSesion $memberHasSesion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MemberHasSesion  $memberHasSesion
     * @return \Illuminate\Http\Response
     */
    public function destroy(MemberHasSesion $memberHasSesion)
    {
        //
    }

    public function ventaCortesiaIndex(MemberHasSesion $memberHasSesion)
    {
        $members= Member::where('members.estado',3)->join('member_has_plans','members.id','=','member_has_plans.member_id')->select('members.*')->groupBy('members.id')->get();

        return view('operacion.ventaCortesiaIndex',compact('members'));
    }

    //venta sesion de cortesia
    public function ventaCortesia(Request $request)
    {
        $member = Member::find(request('member_id'));
        $memberPlan = MemberHasPlan::where('member_id',request('member_id'))->where('active',1)->first();
        $cortesia = MemberHasSesion::where('member_has_plan_id',$memberPlan->id)->where('tipo_sesion',5)->first();
        if($cortesia!=null){
            $cortesia->cantidad = $cortesia->cantidad+request('cantidad');
            $cortesia->save();
        }
        else{
            MemberHasSesion::create([
                'member_id'=>request('member_id'),
                'tipo_sesion'=>5,
                'cantidad'=>request('cantidad'),
                'member_has_plan_id'=>$memberPlan->id,
            ]);
        }

        return redirect('ventaCortesiaIndex');
    }
}
