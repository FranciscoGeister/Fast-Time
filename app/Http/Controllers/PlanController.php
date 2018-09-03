<?php

namespace App\Http\Controllers;

use App\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plan::all();
        return view('configuracion.plan.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies("edit-parameter")){
          abort(403,"No tienes permisos para realizar esta acción");
        }
        return view('configuracion.plan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::denies("edit-parameter")){
          abort(403,"No tienes permisos para realizar esta acción");
        }
        $plan= Plan::create([
            'nombre'=>$request['nombre'],
            'duracion'=>$request['duracion'],
            'valor'=>$request['valor'],
            'sesiones'=>$request['sesiones'],
            'sesi_semanal'=>$request['sesi_semanal'],
            'estado'=>$request['estado'],
            'descripcion'=>$request['descripcion'],
            ]);
        return redirect('/variables');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Gate::denies("edit-parameter")){
          abort(403,"No tienes permisos para realizar esta acción");
        }
        $plan= Plan::find($id);
        return view('configuracion.plan.edit',['plan'=>$plan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Gate::denies("edit-parameter")){
          abort(403,"No tienes permisos para realizar esta acción");
        }
        $plan= Plan::find($id);
        $plan->fill($request->all());
        $plan->save();
        return redirect('/variables');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies("edit-parameter")){
          abort(403,"No tienes permisos para realizar esta acción");
        }
        $plan= Plan::find($id);
        $plan->estado='0';
        $plan->save();
        return redirect('/variables');
    }
}
