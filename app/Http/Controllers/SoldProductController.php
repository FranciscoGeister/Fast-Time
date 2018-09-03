<?php

namespace App\Http\Controllers;

use App\SoldProduct;
use App\Member;
use App\Product;
use App\Underwear;
use App\Payment;
use App\Sale;
use App\PaymentOfSale;
use App\MemberDebt;
use App\Sesion;
use App\MemberHasPlan;
use App\MemberHasSesion;
use App\DebtHistory;
use App\Profesional;
use App\InternalSale;
use App\ProfessionalDebt;
use App\ProfessionalDebtHistory;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SoldProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('vender',Product::class);
        $members= Member::join('clients','members.tipo','=','clients.id')->select('members.*','clients.nombre as type')->get();
        $profesionals= Profesional::all();
        return view('operacion.sale_index', compact('members','profesionals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user_id = Auth::id();
        $user = User::find($user_id);
        $id_sucursal = $user->sede_id;
        $this->authorize('vender',Product::class);
        $member= Member::find($request['member_id']);
        $memberHasPlan = MemberHasPlan::where('member_id',$member->id)->where('active',1)->first();
        if ($memberHasPlan!=null) {
            $hasPlan = 1;
        }
        else
            $hasPlan = 0;
        $products= Product::where('estado',7)->where('id_sucursal',$id_sucursal)->get();
        $underwears= Underwear::where('estado',7)->where('id_sucursal',$id_sucursal)->get();
        $sessions= Sesion::all();
        $payments= Payment::all();
        return view('operacion.sale_create',compact('products','underwears','payments','member','sessions','id_sucursal','hasPlan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sale= Sale::create([
                'member_id'=>$request['member_id'],
                'sede_id'=>$request['id_sucursal'],
                'monto'=>$request['total'],
                'boleta'=>$request['boleta'],
                'iva'=>1,
                'date'=>$request['date'],
                'user_id'=>Auth::id(),
                ]);
        $underwears= $request['under'];
        $cantUnders= $request['cant_under'];
        $monto_under= $request['monto_under'];
        for($i=0;$i<sizeof($underwears);$i++){
            $under= Underwear::find($underwears[$i]);
            $under->stock=$under->stock-$cantUnders[$i];
            $under->save();
        }
        $products= $request['product'];
        $cantProducts= $request['cant_prod'];
        $monto_product= $request['monto_product'];
        for($i=0;$i<sizeof($products);$i++){
            $product= Product::find($products[$i]);
            $product->stock=$product->stock-$cantProducts[$i];
            $product->save();
            SoldProduct::create([
                'product_id'=>$products[$i],
                'cantidad'=>$cantProducts[$i],
                'monto'=>$monto_product[$i],
                'sale_id'=>$sale->id,
                'date'=>$request['date'],
            ]);
        }
        $sesionesExtra= $request['sesion'];
        $cantExtra= $request['cantidad'];
        $memberHasPlan= MemberHasPlan::where('member_id',$request['member_id'])->where('active',1)->first();
        if($memberHasPlan!=null){
            $memberSessions= $memberHasPlan->sesions;
            for($i=0;$i<sizeof($sesionesExtra);$i++){
                $session= MemberHasSesion::where('member_has_plan_id',$memberHasPlan->id)
                                            ->where('tipo_sesion',$sesionesExtra[$i])->first();
                if($session==null){
                    MemberHasSesion::create([
                    'member_id'=>$request['member_id'],
                    'tipo_sesion'=>$sesionesExtra[$i],
                    'cantidad'=>$cantExtra[$i],
                    'member_has_plan_id'=>$memberHasPlan->id,
                    ]);
                }
                else{
                    $session->cantidad=$session->cantidad+$cantExtra[$i];
                    $session->save();
                }
            }
        }
        
        $pagos= $request['pago'];
        $monto_pagos= $request['monto_pago'];
        for($i=0;$i<sizeof($pagos);$i++){
            PaymentOfSale::create([
                'payment_id'=>$pagos[$i],
                'monto'=>$monto_pagos[$i],
                'sale_id'=>$sale->id,
                'iva'=>1,
                'date'=>$request['date'],
                'boleta'=>$request['boleta'],
                'sede_id'=>$request['id_sucursal'],
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

        return redirect('sell_products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SoldProduct  $soldProduct
     * @return \Illuminate\Http\Response
     */
    public function show(SoldProduct $soldProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SoldProduct  $soldProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(SoldProduct $soldProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SoldProduct  $soldProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SoldProduct $soldProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SoldProduct  $soldProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(SoldProduct $soldProduct)
    {
        //
    }

    /*
    funcion para venta interna
    */
    public function interna(Request $request)
    {
        $this->authorize('vender',Product::class);
        $prof= Profesional::find($request['prof_id']);
        $products= Product::where('id_sucursal',1)->get();
        return view('operacion.interna_create',compact('products','prof'));
    }

    public function ventaInterna(Request $request)
    {
        $this->authorize("vender",Product::class);
        InternalSale::create([
            'profesional_id'=>$request['profesional_id'],
            'date'=>$request['date'],
            'amount'=>$request['total'],
            'user_id'=>Auth::id(),
        ]);
        $products= $request['product'];
        $cantProducts= $request['cant_prod'];
        $monto_product= $request['monto_product'];
        for($i=0;$i<sizeof($products);$i++){
            $product= Product::find($products[$i]);
            $product->stock=$product->stock-$cantProducts[$i];
            $product->save();
        }
        $pagos= $request['pago'];
        $monto_pagos= $request['monto_pago'];
        for($i=0;$i<sizeof($pagos);$i++){
            if ($pagos[$i]==7) {
                $exist= ProfessionalDebt::where('profesional_id',$request['profesional_id'])->first();
                if(!$exist){
                    ProfessionalDebt::create([
                    'profesional_id'=>$request['profesional_id'],
                    'amount'=>$monto_pagos[$i],
                    ]);
                }
                else{
                    $exist->amount= $exist->amount+$monto_pagos[$i];
                    $exist->save();
                }
                ProfessionalDebtHistory::create([
                    'profesional_id'=>$request['profesional_id'],
                    'amount'=>$monto_pagos[$i]*(-1),
                ]);
            }
        }
        return redirect('sell_products');
    }
}
