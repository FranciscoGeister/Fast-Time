<?php

namespace App\Http\Controllers;

use App\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = Program::all();
        return view('configuracion.program.index', compact('programs'));
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
        return view('configuracion.program.create');
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
        $program= Program::create([
            'nombre'=>$request['nombre'],
            'duracion'=>$request['duracion'],
            'valor'=>$request['valor'],
            'sesiones'=>$request['sesiones'],
            'sesi_semanal'=>$request['sesi_semanal'],
            'sesi_nutri'=>$request['sesi_nutri'],
            'estado'=>$request['estado'],
            'descripcion'=>$request['descripcion'],
            ]);
        return redirect('/variables');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Gate::denies("edit-parameter")){
          abort(403,"No tienes permisos para realizar esta acción");
        }
        $program= Program::find($id);
        return view('configuracion.program.edit',['program'=>$program]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Gate::denies("edit-parameter")){
          abort(403,"No tienes permisos para realizar esta acción");
        }
        $program= Program::find($id);
        $program->fill($request->all());
        $program->save();
        return redirect('/variables');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies("edit-parameter")){
          abort(403,"No tienes permisos para realizar esta acción");
        }
        $program= Program::find($id);
        $program->estado='0';
        $program->save();
        return redirect('/variables');
    }
}
