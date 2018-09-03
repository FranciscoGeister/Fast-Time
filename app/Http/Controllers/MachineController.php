<?php

namespace App\Http\Controllers;

use App\Machine;
use App\Sede;
use Illuminate\Http\Request;

class MachineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("view",Machine::class);
        $machines = Machine::join('sedes','machines.sede_id','=','sedes.id')
                            ->select('machines.*','sedes.nombre as nombre_sede')->get();
        return view('configuracion.machines.index', compact('machines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize("create",Machine::class);
        $sucursales = Sede::all();
        return view('configuracion.machines.create', ['sucursales'=>$sucursales]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize("create",Machine::class);
        $machine= Machine::create([
            'nombre'=>$request['nombre'],
            'marca'=>$request['marca'],
            'codigo'=>$request['codigo'],
            'color'=>$request['color'],
            'fecha_compra'=>$request['fecha_compra'],
            'vendedor'=>$request['vendedor'],
            'descripcion'=>$request['descripcion'],
            'sede_id'=>$request['sede_id'],
            'estado'=>'1',
            ]);
        return redirect('/maquinas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Machine  $machine
     * @return \Illuminate\Http\Response
     */
    public function show(Machine $machine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Machine  $machine
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $machine= Machine::find($id);
        //$this->authorize("edit",$machine);
        return view('configuracion.machines.edit',['machine'=>$machine]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Machine  $machine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Machine $machine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Machine  $machine
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $machine= Machine::find($id);
        $this->authorize("delete",$machine);
        $machine->estado='0';
        $machine->save();
        return redirect('/maquinas');
    }
}
