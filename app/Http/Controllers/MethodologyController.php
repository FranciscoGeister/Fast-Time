<?php

namespace App\Http\Controllers;

use App\Methodology;
use Illuminate\Http\Request;

class MethodologyController extends Controller
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
        $methodology = new Methodology;
        $methodology->nombre = request('nombre');
        $methodology->save();
        return redirect('variables');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Methodology  $methodology
     * @return \Illuminate\Http\Response
     */
    public function show(Methodology $methodology)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Methodology  $methodology
     * @return \Illuminate\Http\Response
     */
    public function edit(Methodology $methodology)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Methodology  $methodology
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Methodology $methodology)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Methodology  $methodology
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Methodology::findOrFail($id)->delete();
        return redirect('variables');
    }
}
