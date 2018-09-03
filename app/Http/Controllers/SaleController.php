<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Sede;
use App\Payment;
use App\PaymentOfSale;
use App\Member;
use App\Hora;
use App\Profesional;
use App\WorkingDay;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $month = date("n");
        $sales= Sale::join('members','sales.member_id','=','members.id')
                    ->join('sedes','sales.sede_id','=','sedes.id')
                    ->select('sales.*','members.rut as rut_socio','sedes.nombre as nombre_sede')
                    ->get();
        $paymentOfSales= PaymentOfSale::join('sales','payment_of_sales.sale_id','=','sales.id')
                                        ->select('payment_of_sales.*','sales.sede_id')
                                        ->get();
        $sedes= Sede::all();
        $payments= Payment::all();
        $p1s1= PaymentOfSale::join('sales','payment_of_sales.sale_id','=','sales.id')
                                ->select('payment_of_sales.*','sales.sede_id')
                                ->whereMonth('payment_of_sales.created_at',$month)
                                ->get()
                                ->where('payment_id',1)
                                ->where('sede_id',1)
                                ->sum('monto');
        $p1s2= PaymentOfSale::join('sales','payment_of_sales.sale_id','=','sales.id')
                                ->select('payment_of_sales.*','sales.sede_id')
                                ->get()
                                ->where('payment_id',1)
                                ->where('sede_id',2)
                                ->sum('monto');
        $p1s3= PaymentOfSale::join('sales','payment_of_sales.sale_id','=','sales.id')
                                ->select('payment_of_sales.*','sales.sede_id')
                                ->get()
                                ->where('payment_id',1)
                                ->where('sede_id',3)
                                ->sum('monto');
        $p2s1= PaymentOfSale::join('sales','payment_of_sales.sale_id','=','sales.id')
                                ->select('payment_of_sales.*','sales.sede_id')
                                ->get()
                                ->where('payment_id',2)
                                ->where('sede_id',1)
                                ->sum('monto');
        $p2s2= PaymentOfSale::join('sales','payment_of_sales.sale_id','=','sales.id')
                                ->select('payment_of_sales.*','sales.sede_id')
                                ->get()
                                ->where('payment_id',2)
                                ->where('sede_id',2)
                                ->sum('monto');
        $p2s3= PaymentOfSale::join('sales','payment_of_sales.sale_id','=','sales.id')
                                ->select('payment_of_sales.*','sales.sede_id')
                                ->get()
                                ->where('payment_id',2)
                                ->where('sede_id',3)
                                ->sum('monto');
        $p3s1= PaymentOfSale::join('sales','payment_of_sales.sale_id','=','sales.id')
                                ->select('payment_of_sales.*','sales.sede_id')
                                ->get()
                                ->where('payment_id',3)
                                ->where('sede_id',1)
                                ->sum('monto');
        $p3s2= PaymentOfSale::join('sales','payment_of_sales.sale_id','=','sales.id')
                                ->select('payment_of_sales.*','sales.sede_id')
                                ->get()
                                ->where('payment_id',3)
                                ->where('sede_id',2)
                                ->sum('monto');
        $p3s3= PaymentOfSale::join('sales','payment_of_sales.sale_id','=','sales.id')
                                ->select('payment_of_sales.*','sales.sede_id')
                                ->get()
                                ->where('payment_id',3)
                                ->where('sede_id',3)
                                ->sum('monto');
        $p4s1= PaymentOfSale::join('sales','payment_of_sales.sale_id','=','sales.id')
                                ->select('payment_of_sales.*','sales.sede_id')
                                ->get()
                                ->where('payment_id',4)
                                ->where('sede_id',1)
                                ->sum('monto');
        $p4s2= PaymentOfSale::join('sales','payment_of_sales.sale_id','=','sales.id')
                                ->select('payment_of_sales.*','sales.sede_id')
                                ->get()
                                ->where('payment_id',4)
                                ->where('sede_id',2)
                                ->sum('monto');
        $p4s3= PaymentOfSale::join('sales','payment_of_sales.sale_id','=','sales.id')
                                ->select('payment_of_sales.*','sales.sede_id')
                                ->get()
                                ->where('payment_id',4)
                                ->where('sede_id',3)
                                ->sum('monto');
        $p5s1= PaymentOfSale::join('sales','payment_of_sales.sale_id','=','sales.id')
                                ->select('payment_of_sales.*','sales.sede_id')
                                ->get()
                                ->where('payment_id',5)
                                ->where('sede_id',1)
                                ->sum('monto');
        $p5s2= PaymentOfSale::join('sales','payment_of_sales.sale_id','=','sales.id')
                                ->select('payment_of_sales.*','sales.sede_id')
                                ->get()
                                ->where('payment_id',5)
                                ->where('sede_id',2)
                                ->sum('monto');
        $p5s3= PaymentOfSale::join('sales','payment_of_sales.sale_id','=','sales.id')
                                ->select('payment_of_sales.*','sales.sede_id')
                                ->get()
                                ->where('payment_id',5)
                                ->where('sede_id',3)
                                ->sum('monto');
        $p6s1= PaymentOfSale::join('sales','payment_of_sales.sale_id','=','sales.id')
                                ->select('payment_of_sales.*','sales.sede_id')
                                ->get()
                                ->where('payment_id',6)
                                ->where('sede_id',1)
                                ->sum('monto');
        $p6s2= PaymentOfSale::join('sales','payment_of_sales.sale_id','=','sales.id')
                                ->select('payment_of_sales.*','sales.sede_id')
                                ->get()
                                ->where('payment_id',6)
                                ->where('sede_id',2)
                                ->sum('monto');
        $p6s3= PaymentOfSale::join('sales','payment_of_sales.sale_id','=','sales.id')
                                ->select('payment_of_sales.*','sales.sede_id')
                                ->get()
                                ->where('payment_id',6)
                                ->where('sede_id',3)
                                ->sum('monto');
        $p7s1= PaymentOfSale::join('sales','payment_of_sales.sale_id','=','sales.id')
                                ->select('payment_of_sales.*','sales.sede_id')
                                ->get()
                                ->where('payment_id',7)
                                ->where('sede_id',1)
                                ->sum('monto');
        $p7s2= PaymentOfSale::join('sales','payment_of_sales.sale_id','=','sales.id')
                                ->select('payment_of_sales.*','sales.sede_id')
                                ->get()
                                ->where('payment_id',7)
                                ->where('sede_id',2)
                                ->sum('monto');
        $p7s3= PaymentOfSale::join('sales','payment_of_sales.sale_id','=','sales.id')
                                ->select('payment_of_sales.*','sales.sede_id')
                                ->get()
                                ->where('payment_id',7)
                                ->where('sede_id',3)
                                ->sum('monto');
        $p8s1= PaymentOfSale::join('sales','payment_of_sales.sale_id','=','sales.id')
                                ->select('payment_of_sales.*','sales.sede_id')
                                ->get()
                                ->where('payment_id',8)
                                ->where('sede_id',1)
                                ->sum('monto');
        $p8s2= PaymentOfSale::join('sales','payment_of_sales.sale_id','=','sales.id')
                                ->select('payment_of_sales.*','sales.sede_id')
                                ->get()
                                ->where('payment_id',8)
                                ->where('sede_id',2)
                                ->sum('monto');
        $p8s3= PaymentOfSale::join('sales','payment_of_sales.sale_id','=','sales.id')
                                ->select('payment_of_sales.*','sales.sede_id')
                                ->get()
                                ->where('payment_id',8)
                                ->where('sede_id',3)
                                ->sum('monto');

                         
        return view('gestion.ingresos',compact('sales','sedes','paymentOfSales','payments','p1s1','p1s2','p1s3','p2s1','p2s2','p2s3','p3s1','p3s2','p3s3','p4s1','p4s2','p4s3','p5s1','p5s2','p5s3','p6s1','p6s2','p6s3','p7s1','p7s2','p7s3','p8s1','p8s2','p8s3'));
    }

    public function monthly_rep()
    {

        $sedes= Sede::all();
        return view('gestion.monthly_rep', compact('sedes'));
    }

    public function monthly_report(Request $request)
    {
        $totales_iva = array();
        $totales_transb = array();
        $totales_sin_iva = array();
        $total_iva=0;
        $total_transb=0;
        $total_sin_iva=0;
        $boleta_desde_iva = array();
        $boleta_hasta_iva = array();
        $boleta_desde_transb = array();
        $boleta_hasta_transb = array();
        $boleta_desde_sin_iva = array();
        $boleta_hasta_sin_iva = array();
        $sedes= Sede::all();
        $sucursal= Sede::find($request['sede']);
        if ($request['month']==1) {
            $month= "Enero";
        }
        elseif ($request['month']==2) {
            $month= "Febrero";
        }
        elseif ($request['month']==3) {
            $month= "Marzo";
        }
        elseif ($request['month']==4) {
            $month= "Abril";
        }
        elseif ($request['month']==5) {
            $month= "Mayo";
        }
        elseif ($request['month']==6) {
            $month= "Junio";
        }
        elseif ($request['month']==7) {
            $month= "Julio";
        }
        elseif ($request['month']==8) {
            $month= "Agosto";
        }
        elseif ($request['month']==9) {
            $month= "Septiembre";
        }
        elseif ($request['month']==10) {
            $month= "Octubre";
        }
        elseif ($request['month']==11) {
            $month= "Noviembre";
        }
        else{
            $month= "Diciembre";
        }
        for ($i=0; $i < 31 ; $i++) { 
            $iva_sale=PaymentOfSale::where('iva',1)
                            ->where('sede_id',$request['sede'])
                            ->whereMonth('date',$request['month'])
                            ->whereDay('date',$i+1)
                            ->whereIn('payment_id', [1,2,5,6,7])
                            ->get();
            $totales_iva[$i]= $iva_sale->sum('monto');
            $total_iva+= $totales_iva[$i];
            $boleta_desde_iva[$i]= $iva_sale->min('boleta');
            $boleta_hasta_iva[$i]= $iva_sale->max('boleta');

            $transb_sale= PaymentOfSale::where('iva',1)
                            ->where('sede_id',$request['sede'])
                            ->whereMonth('date',$request['month'])
                            ->whereDay('date',$i+1)
                            ->whereIn('payment_id', [3,4])
                            ->get();

            $totales_transb[$i]= $transb_sale->sum('monto');
            $total_transb+= $totales_transb[$i];
            $boleta_desde_transb[$i]= $transb_sale->min('boleta');
            $boleta_hasta_transb[$i]= $transb_sale->max('boleta');

            $wo_iva_sale= PaymentOfSale::where('iva',0)
                            ->where('sede_id',$request['sede'])
                            ->whereMonth('date',$request['month'])
                            ->whereDay('date',$i+1)
                            ->get();

            $totales_sin_iva[$i]= $wo_iva_sale->sum('monto');
            $total_sin_iva+= $totales_sin_iva[$i];
            $boleta_desde_sin_iva[$i]= $wo_iva_sale->min('boleta');
            $boleta_hasta_sin_iva[$i]= $wo_iva_sale->max('boleta');

        }

        return view('gestion.monthly_report',compact('totales_iva','boleta_desde_iva','boleta_hasta_iva','total_iva','totales_transb','boleta_desde_transb','boleta_hasta_transb','total_transb','totales_sin_iva','boleta_desde_sin_iva','boleta_hasta_sin_iva','total_sin_iva','sedes','sucursal','month'));

    }

    public function infPagos()
    {

        $sedes= Sede::all();
        return view('gestion.inf_pagos', compact('sedes'));
    }

    public function informePagos(Request $request)
    {
        set_time_limit(0);
        $contracted_professionals= Profesional::where('link',1)->join('profesional_sede','profesionals.id','=','profesional_sede.profesional_id')->where('sede_id',request('sede'))->leftjoin('horas','profesionals.id','=','horas.id_prof')->groupBy('id_prof','profesionals.id')->select('horas.id_prof',DB::raw("COUNT(*) as atenciones"),'profesionals.first_name','profesionals.last_name','profesionals.mother_last_name','profesionals.contracted_hours','profesionals.id')->get();

        for ($i=0; $i < sizeof($contracted_professionals) ; $i++) {
            if(Hora::where('id_prof',$contracted_professionals[$i]->id)->doesntExist()){
                $contracted_professionals[$i]->atenciones = 0;
            }
        }

        $overtime = array();
        $contracted_hours_worked = array();
        $contracted_hours_a_month = array();
        

        for ($i=0; $i < sizeof($contracted_professionals) ; $i++) {
            $contracted_hours_a_month[$i]=0.0;
            $overtime[$i] = 0.0;
            $contracted_hours = $contracted_professionals[$i]->contracted_hours;
            for ($j=0; $j < 31; $j++) { 
                $contracted_hours_worked[$i]= date("H:i:s", strtotime("00:00:00"));
                $working_days= WorkingDay::where('profesional_id',$contracted_professionals[$i]->id)->whereMonth('date',request('month'))->whereDay('date',$j+1)->get();
                foreach ($working_days as $wd ) {
                    $contracted_hours_worked[$i]= date("H:i:s", strtotime($contracted_hours_worked[$i])-strtotime($wd->hours_worked));
                }
                $contracted_hours_worked[$i]= date("H:i:s", strtotime("00:00:00")-strtotime($contracted_hours_worked[$i]));
                $time= explode(':', $contracted_hours_worked[$i]);
                $contracted_hours_a_month[$i] = $contracted_hours_a_month[$i]+(float)$time[0]+(float)($time[1]/60);
                if ($time[0]>$contracted_professionals[$i]->contracted_hours) {
                    $overtime[$i] += ((float)$time[0]-$contracted_professionals[$i]->contracted_hours)+(float)($time[1]/60);
                }
            }
             
            
        }
        $honorary_professionals= Profesional::where('link',2)->join('profesional_sede','profesionals.id','=','profesional_sede.profesional_id')->where('sede_id',request('sede'))->leftjoin('horas','profesionals.id','=','horas.id_prof')->groupBy('id_prof','profesionals.id')->select('horas.id_prof',DB::raw("COUNT(*) as atenciones"),'profesionals.first_name','profesionals.last_name','profesionals.mother_last_name','profesionals.id')->get();

        for ($i=0; $i < sizeof($honorary_professionals) ; $i++) {
            if(Hora::where('id_prof',$honorary_professionals[$i]->id)->doesntExist()){
                $honorary_professionals[$i]->atenciones = 0;
            }
        }

        $honorary_hours_a_month = array();
        $honorary_hours_worked = array();

        for ($i=0; $i < sizeof($honorary_professionals) ; $i++) {
            $honorary_hours_a_month[$i]=0.0;
            for ($j=0; $j < 31; $j++) { 
                $honorary_hours_worked[$i]= date("H:i:s", strtotime("00:00:00"));
                $working_days= WorkingDay::where('profesional_id',$honorary_professionals[$i]->id)->whereMonth('date',request('month'))->whereDay('date',$j+1)->get();
                foreach ($working_days as $wd ) {
                    $honorary_hours_worked[$i]= date("H:i:s", strtotime($honorary_hours_worked[$i])-strtotime($wd->hours_worked));
                }
                $honorary_hours_worked[$i]= date("H:i:s", strtotime("00:00:00")-strtotime($honorary_hours_worked[$i]));
                $time= explode(':', $honorary_hours_worked[$i]);
                $honorary_hours_a_month[$i] = $honorary_hours_a_month[$i]+(float)$time[0]+(float)($time[1]/60);
            }
             
            
        }

        $sedes = Sede::all();
        $sede= Sede::find($request['sede']);
        if ($request['month']==1) {
            $month= "Enero";
        }
        elseif ($request['month']==2) {
            $month= "Febrero";
        }
        elseif ($request['month']==3) {
            $month= "Marzo";
        }
        elseif ($request['month']==4) {
            $month= "Abril";
        }
        elseif ($request['month']==5) {
            $month= "Mayo";
        }
        elseif ($request['month']==6) {
            $month= "Junio";
        }
        elseif ($request['month']==7) {
            $month= "Julio";
        }
        elseif ($request['month']==8) {
            $month= "Agosto";
        }
        elseif ($request['month']==9) {
            $month= "Septiembre";
        }
        elseif ($request['month']==10) {
            $month= "Octubre";
        }
        elseif ($request['month']==11) {
            $month= "Noviembre";
        }
        else{
            $month= "Diciembre";
        }
        

        return view('gestion.informe_pagos',compact('contracted_professionals','contracted_hours_worked','overtime','contracted_hours_a_month','honorary_professionals','honorary_hours_a_month','sedes','month','sede'));
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
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale= Sale::find($id);
        $soldProducts= $sale->products;
        $payments= $sale->payments;
        return view('gestion.infoSale',compact('sale','soldProducts','payments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
