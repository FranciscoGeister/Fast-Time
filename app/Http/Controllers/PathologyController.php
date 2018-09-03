<?php

namespace App\Http\Controllers;

use App\Pathology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class PathologyController extends Controller
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
        $pathology = new Pathology;
        $pathology->nombre = request('nombre');
        $pathology->save();
        return redirect('variables');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pathology  $pathology
     * @return \Illuminate\Http\Response
     */
    public function show(Pathology $pathology)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pathology  $pathology
     * @return \Illuminate\Http\Response
     */
    public function edit(Pathology $pathology)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pathology  $pathology
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pathology $pathology)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pathology  $pathology
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if( Gate::denies("edit-parameter")){
          abort(403,"No tienes permisos para realizar esta acción");
        }
        Pathology::findOrFail($id)->delete();
        return redirect('variables');
    }
}
