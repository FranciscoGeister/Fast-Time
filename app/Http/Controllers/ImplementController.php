<?php

namespace App\Http\Controllers;

use App\Implement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class ImplementController extends Controller
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
        if( Gate::denies("edit-parameter")){
          abort(403,"No tienes permisos para realizar esta acción");
        }
        $implement = new Implement;
        $implement->nombre = request('nombre');
        $implement->sigla = request('sigla');
        $implement->save();
        return redirect('variables');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Implement  $implement
     * @return \Illuminate\Http\Response
     */
    public function show(Implement $implement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Implement  $implement
     * @return \Illuminate\Http\Response
     */
    public function edit(Implement $implement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Implement  $implement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Implement $implement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Implement  $implement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if( Gate::denies("edit-parameter")){
          abort(403,"No tienes permisos para realizar esta acción");
        }
        Implement::findOrFail($id)->delete();
        return redirect('variables');
    }
}
