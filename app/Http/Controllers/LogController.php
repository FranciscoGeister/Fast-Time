<?php

namespace App\Http\Controllers;

use App\Member;
use App\Profesional;
use App\Sale;
use App\InternalSale;
use App\CanceledSale;
use App\Product;
use App\PaymentOfSale;
use App\SoldProduct;
use App\SoldPlan;
use App\memberHasPlan;
use App\SessionTab;
use App\EvaluationSheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    public function index()
    {
        $memberSales = Sale::join('members','sales.member_id','=','members.id')
        					->join('sedes','sales.sede_id','=','sedes.id')
        					->join('users','sales.user_id','=','users.id')
        					->select('sales.*','members.email as member_email','sedes.nombre as sede_name','users.email as user_email')
        					->get();
        $professionalSales = InternalSale::join('profesionals','internal_sales.profesional_id','=','profesionals.id')
        								->join('users','internal_sales.user_id','=','users.id')
        								->select('internal_sales.*','profesionals.email as professional_email','users.email as user_email')
        								->get();
        $canceledSales = CanceledSale::join('members','canceled_sales.member_id','=','members.id')
			        					->join('sedes','canceled_sales.sede_id','=','sedes.id')
			        					->join('users','canceled_sales.user_id','=','users.id')
			        					->join('users as users2','canceled_sales.user2_id','=','users2.id')
			        					->select('canceled_sales.*','members.email as member_email','sedes.nombre as sede_name','users.email as user_email','users2.email as user2_email')
			        					->get();
        return view('gestion.logs',compact('memberSales','professionalSales','canceledSales'));
    }

    public function saleDetail($id)
    {
        //plan vendido
        $soldPlan = SoldPlan::where('sale_id',$id)->first();
        //o productos vendidos
    	$soldProducts = SoldProduct::where('sale_id',$id)
    								->join('products','sold_products.product_id','=','products.id')
    								->select('sold_products.*','products.nombre','products.marca')
    								->get();
        //si fue plan
        if ($soldPlan!=null && $soldPlan->plan_or_prog==1) {
            $planDetail = SoldPlan::where('sale_id',$id)
                                ->join('sales','sold_plans.sale_id','=','sales.id')
                                ->join('plans','sold_plans.plan_id','=','plans.id')
                                ->select('sales.monto','sales.date','plans.nombre')
                                ->first();
        }
        //si fue programa
        elseif($soldPlan!=null && $soldPlan->plan_or_prog==2){
            $planDetail = SoldPlan::where('sale_id',$id)
                                ->join('sales','sold_plans.sale_id','=','sales.id')
                                ->join('programs','sold_plans.plan_id','=','programs.id')
                                ->select('sales.monto','programs.nombre')
                                ->first();
        }
        //si fue venta de productos planDetail es nulo para que la vista no de error
        else{
            $planDetail = null;
        }  
    	
    	return view('gestion.saleDetail',compact('soldProducts','planDetail'));
    }

    public function cancelSale($id)
    {
    	$user_id = Auth::id();
    	$sale = Sale::find($id);
        CanceledSale::create([
        	'member_id'=>$sale->member_id,
        	'sede_id'=>$sale->sede_id,
        	'monto'=>$sale->monto,
        	'boleta'=>$sale->boleta,
        	'iva'=>$sale->iva,
        	'date'=>$sale->date,
        	'user_id'=>$sale->user_id,
        	'user2_id'=>$user_id
        ]);
        $soldProducts = $sale->products;
        $payments = $sale->payments;
        foreach ($soldProducts as $sp) {
        	$temp = Product::find($sp->product_id);
        	$temp->stock = $temp->stock+$sp->cantidad;
        	$temp->save();
        	$sp->delete();
        }
        foreach ($payments as $pay) {
        	$pay->delete();
        }
        $soldPlan = SoldPlan::where('sale_id',$id)->first();
        if ($soldPlan!=null) {
            $memberHasPlan = MemberHasPlan::find($soldPlan->member_has_plan_id);
            $memberSessions = $memberHasPlan->sessions;
            foreach ($memberSessions as $ms) {
                $ms->delete();
            }
            $evaluationSheet = EvaluationSheet::where('member_has_plan_id',$memberHasPlan->id)->first();
            $evaluationSheet->delete();
            $sessionTab = SessionTab::where('member_has_plan_id',$memberHasPlan->id)->first();
            $sessionTab->delete();
            $memberHasPlan->delete();
            $soldPlan->delete();
        }        
        $sale->delete();
        
        return redirect('/logs');
    }
}
