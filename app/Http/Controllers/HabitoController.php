<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PreguntaHabito;
use Illuminate\Support\Facades\Gate;
class HabitoController extends Controller
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
    public function store(Request $request, $tipo)
    {
      if( Gate::denies("edit-parameter")){
        abort(403,"No tienes permisos para realizar esta acción");
      }
      $habito = new PreguntaHabito;
      $habito->pregunta = request('pregunta');
      $habito->tipo = $tipo;
      $habito->save();
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
      $habito = PreguntaHabito::find($id);
      return view('configuracion.habitos.edit', compact('habito'));
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
      $habito = PreguntaHabito::find($id);
      $habito->pregunta = request('pregunta');
      $habito->save();
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
      PreguntaHabito::findOrFail($id)->delete();
      return redirect('variables');
    }
}
