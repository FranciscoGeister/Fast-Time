<?php

namespace App\Http\Controllers;

use App\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class ExerciseController extends Controller
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
        $exercise = new Exercise;
        $exercise->nombre = request('nombre');
        $exercise->sigla = request('sigla');
        $exercise->video = $request->file('video')->store('public/videos');
        $exercise->foto = $request->file('foto')->store('public/fotos');
        $exercise->save();
        return redirect('variables');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function show(Exercise $exercise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function edit(Exercise $exercise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exercise $exercise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if( Gate::denies("edit-parameter")){
          abort(403,"No tienes permisos para realizar esta acción");
        }
        Exercise::findOrFail($id)->delete();
        return redirect('variables');
    }
}
