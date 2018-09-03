<?php

namespace App\Http\Controllers;

use App\ProgramType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class ProgramTypeController extends Controller
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
        $type = new ProgramType;
        $type->nombre = request('nombre');
        $type->save();
        return redirect('variables');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProgramType  $programType
     * @return \Illuminate\Http\Response
     */
    public function show(ProgramType $programType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProgramType  $programType
     * @return \Illuminate\Http\Response
     */
    public function edit(ProgramType $programType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProgramType  $programType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProgramType $programType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProgramType  $programType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if( Gate::denies("edit-parameter")){
          abort(403,"No tienes permisos para realizar esta acción");
        }
        ProgramType::findOrFail($id)->delete();
        return redirect('variables');
    }
}
