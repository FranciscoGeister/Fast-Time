<?php

namespace App\Http\Controllers;

use App\Sesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SesionController extends Controller
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
        if(Gate::denies("edit-parameter")){
          abort(403,"No tienes permisos para realizar esta acción");
        }
        $sesion = new Sesion;
        $sesion->nombre = request('nombre');
        $sesion->precio = request('precio');
        $sesion->estado = '1';
        $sesion->save();
        return redirect('variables');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function show(Sesion $sesion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function edit(Sesion $sesion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sesion $sesion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        if(Gate::denies("edit-parameter")){
          abort(403,"No tienes permisos para realizar esta acción");
        }
        $sesion= Sesion::find($id);
        $sesion->estado='0';
        $sesion->save();
        return redirect('variables');
    }
}
