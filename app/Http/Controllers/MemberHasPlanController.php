<?php

namespace App\Http\Controllers;

use App\MemberHasPlan;
use App\MemberHasSesion;
use App\Member;
use App\Plan;
use App\Program;
use App\Payment;
use App\Sesion;
use App\Underwear;
use App\Size;
use App\Product;
use App\Sale;
use App\SoldProduct;
use App\EvaluationSheet;
use App\PaymentOfSale;
use App\SessionTab;
use App\MemberDebt;
use App\DebtHistory;
use App\SoldPlan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MemberHasPlanController extends Controller
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

        $this->authorize("create",Member::class);
        $plans= Plan::all();
        $payments= Payment::all();
        $sesions= Sesion::all();
        $member= Member::find($request['member_id']);
        return view('operacion.ventaPlan',['sesions'=>$sesions,'member'=>$member,'plans'=>$plans,
                                            'payments'=>$payments]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //buscar si ya tenia un plan activo
        $newPlan= MemberHasPlan::where('member_id',$request['member_id'])
                                ->where('active',1)
                                ->first();
        //si ya tiene un plan se crea uno nuevo(no activo)
        if ($newPlan!=null) {
            $memberHasPlan= MemberHasPlan::create([
                'member_id'=>$request['member_id'],
                'plan_id'=>$request['plan_id'],
                'plan_or_prog'=>$request['plan_or_prog'],
                'contrato'=>$request['contrato'],
                'active'=>'0',
                'new'=>'1',
                'estado'=>'1',
            ]);
        }
        //si no tiene un plan se le crea uno nuevo(activo)
        else{
            $memberHasPlan= MemberHasPlan::create([
                'member_id'=>$request['member_id'],
                'plan_id'=>$request['plan_id'],
                'plan_or_prog'=>$request['plan_or_prog'],
                'contrato'=>$request['contrato'],
                'active'=>'1',
                'new'=>'0',
                'estado'=>'1',
            ]);
        }
        //plan_or_prog para saber si es un plan o un programa
        if($request['plan_or_prog']==1){
            $plan= Plan::find($request['plan_id']);
            $cant_sesiones= $plan->sesiones;
            $MemberHasSesion= MemberHasSesion::create([
                'member_id'=>$request['member_id'],
                'tipo_sesion'=>'4',
                'cantidad'=>$cant_sesiones,
                'member_has_plan_id'=>$memberHasPlan->id,
            ]);
        }
        else{
            $prog= Program::find($request['plan_id']);
            $cant_sesiones= $prog->sesiones;
            $sesi_nutri= $prog->sesi_nutri;
            $MemberHasSesion= MemberHasSesion::create([
                'member_id'=>$request['member_id'],
                'tipo_sesion'=>'4',
                'cantidad'=>$cant_sesiones,
                'member_has_plan_id'=>$memberHasPlan->id,
            ]);
            $MemberHasSesion= MemberHasSesion::create([
                'member_id'=>$request['member_id'],
                'tipo_sesion'=>'6',
                'cantidad'=>$sesi_nutri,
                'member_has_plan_id'=>$memberHasPlan->id,
            ]);
        }
        $sesionesExtra= $request['sesion'];
        $cantExtra= $request['cantidad'];
        for($i=0;$i<sizeof($sesionesExtra);$i++){
            MemberHasSesion::create([
            'member_id'=>$request['member_id'],
            'tipo_sesion'=>$sesionesExtra[$i],
            'cantidad'=>$cantExtra[$i],
            'member_has_plan_id'=>$memberHasPlan->id,
            ]);
        }
        $sale= Sale::create([
                'member_id'=>$request['member_id'],
                'sede_id'=>1,
                'monto'=>$request['total'],
                'boleta'=>$request['boleta'],
                'iva'=>0,
                'date'=>$request['date'],
                'user_id'=>Auth::id(),
                ]);
        SoldPlan::create([
            'sale_id'=>$sale->id,
            'plan_id'=>$memberHasPlan->plan_id,
            'plan_or_prog'=>$memberHasPlan->plan_or_prog,
            'member_has_plan_id'=>$memberHasPlan->id,
        ]);
        $pagos= $request['pago'];
        $monto_pagos= $request['monto_pago'];
        for($i=0;$i<sizeof($pagos);$i++){
            PaymentOfSale::create([
                'payment_id'=>$pagos[$i],
                'monto'=>$monto_pagos[$i],
                'sale_id'=>$sale->id,
                'iva'=>0,
                'date'=>$request['date'],
                'boleta'=>$request['boleta'],
                'sede_id'=>1,
            ]);
            if ($pagos[$i]==7) {
                $exist= MemberDebt::where('member_id',$request['member_id'])->first();
                if(!$exist){
                    MemberDebt::create([
                    'member_id'=>$request['member_id'],
                    'amount'=>$monto_pagos[$i],
                    ]);
                }
                else{
                    $exist->amount= $exist->amount+$monto_pagos[$i];
                    $exist->save();
                }
                DebtHistory::create([
                    'member_id'=>$request['member_id'],
                    'amount'=>$monto_pagos[$i]*(-1),
                    'boleta'=>$request['boleta'],
                ]);
            }
        }

        EvaluationSheet::create([
            'member_has_plan_id'=>$memberHasPlan->id,
        ]);
        SessionTab::create([
            'member_has_plan_id'=>$memberHasPlan->id,
        ]);

        return redirect('socios');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MemberHasPlan  $memberHasPlan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $memberPlan= MemberHasPlan::where('member_id',$id)->first();
        $member= Member::find($id);
        if($memberPlan!=null){
            $memberSesions= $memberPlan->sesions;
            $plan= Plan::find($memberPlan->plan_id);
        }
        else{
            $memberSesions= null;
            $plan= null;
        }

        return view('operacion.infoPlanes',compact('memberPlan','memberSesions','member','plan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MemberHasPlan  $memberHasPlan
     * @return \Illuminate\Http\Response
     */
    public function edit(MemberHasPlan $memberHasPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MemberHasPlan  $memberHasPlan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MemberHasPlan $memberHasPlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MemberHasPlan  $memberHasPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(MemberHasPlan $memberHasPlan)
    {
        //
    }

    public function findValor(Request $request){

        if($request->plan_or_prog==1){
            $plan=Plan::select('valor','sesiones')->where('id',$request->id)->first();
            return response()->json($plan);
        }
        else{
            $prog=Program::select('valor','sesiones','sesi_nutri')->where('id',$request->id)->first();
            return response()->json($prog);
        }
    }

    public function getPlanes(Request $request){

        //it will get price if its id match with product id
        $planes=Plan::all();

        return response()->json($planes);
    }

    public function getProgramas(Request $request){

        //it will get price if its id match with product id
        $programas=Program::all();

        return response()->json($programas);
    }

    public function getValorProduct(Request $request){
        $product= Product::select('precio')->where('id',$request->id)->first();
        return response()->json($product);
    }
    public function getValorUnder(Request $request){
        $under= Underwear::select('precio','precio_arriendo')->where('id',$request->id)->first();
        return response()->json($under);
    }
    public function getValorSession(Request $request){
        $sesion= Sesion::select('precio')->where('id',$request->id)->first();
        return response()->json($sesion);
    }
}
