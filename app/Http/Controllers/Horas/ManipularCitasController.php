<?php

namespace App\Http\Controllers\Horas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\Profesional;
use App\Sede;
use App\Member;
use App\Hora;
class ManipularCitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $events= Event::all();
      $sedes = Sede::all();
      $clientes = Member::all();
      $profesionales = Profesional::all();
      $horas = Hora::all();
      return view('operacion.manipular_citas', ['profesionales'=>$profesionales, 'horas'=>$horas,'members'=>$clientes,'sedes'=>$sedes,'events'=>$events]);
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
        //
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
        //
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
//
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
