<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Antecedente;
use Illuminate\Support\Facades\Gate;
class AntecedenteController extends Controller
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
      $antecedente = new Antecedente;
      $antecedente->nombre = request('nombre');
      $antecedente->save();
      return redirect('variables');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if( Gate::denies("edit-parameter")){
        abort(403,"No tienes permisos para realizar esta acción");
      }
      $antecedente = Antecedente::find($id);
      return view('configuracion.antecedentes.edit', compact('antecedente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      if( Gate::denies("edit-parameter")){
        abort(403,"No tienes permisos para realizar esta acción");
      }
      $antecedente = Antecedente::find($id);
      $antecedente->fill($request->all());
      $antecedente->save();
      return redirect('variables');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      if( Gate::denies("edit-parameter")){
        abort(403,"No tienes permisos para realizar esta acción");
      }
      Antecedente::findOrFail($id)->delete();
      return redirect('variables');
    }
}
