<?php

namespace App\Http\Controllers\Configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sede;
use Illuminate\Support\Facades\Gate;

class SedeController extends Controller
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

    public function store_sede(Request $request){
      if(Gate::denies("edit-parameter")){
        abort(403,"No tienes permisos para realizar esta acción");
      }
      $sede = new Sede;
      $sede->codigo = request('codigo');
      $sede->nombre = request('name');
      $sede->direccion = request('address');
      $sede->ciudad = request('city');
      $sede->fono = request('phone');
      $sede->save();
      return redirect('variables');
    }

    public function go_to_edit($id)
    {
        if(Gate::denies("edit-parameter")){
          abort(403,"No tienes permisos para realizar esta acción");
        }
        $sede= Sede::find($id);
        return view('configuracion.sedes.edit',['sede'=>$sede]);
    }

    public function go_to_create(){
      if(Gate::denies("edit-parameter")){
        abort(403,"No tienes permisos para realizar esta acción");
      }
      return view('configuracion.sedes.create');
    }

    public function edit_sede(Request $request, $id){
        if(Gate::denies("edit-parameter")){
          abort(403,"No tienes permisos para realizar esta acción");
        }
        $sede= Sede::find($id);
        $sede->codigo = request('codigo');
        $sede->nombre = request('name');
        $sede->direccion = request('address');
        $sede->ciudad = request('city');
        $sede->fono = request('phone');
        $sede->save();
        return redirect('variables');

    }
    public function destroy_sede($id){
      if(Gate::denies("edit-parameter")){
        abort(403,"No tienes permisos para realizar esta acción");
      }
      try {
        $sede= Sede::findOrFail($id);
        $sede->delete();
      } catch (Exception $e) {

      }
      return redirect('variables');
    }
}
