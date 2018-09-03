<?php

namespace App\Http\Controllers;

use App\Objetive;
use Illuminate\Http\Request;

class ObjetiveController extends Controller
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
        $objetive = new Objetive;
        $objetive->nombre = request('nombre');
        $objetive->save();
        return redirect('variables');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Objetive  $objetive
     * @return \Illuminate\Http\Response
     */
    public function show(Objetive $objetive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Objetive  $objetive
     * @return \Illuminate\Http\Response
     */
    public function edit(Objetive $objetive)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Objetive  $objetive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Objetive $objetive)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Objetive  $objetive
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Objetive::findOrFail($id)->delete();
        return redirect('variables');
    }
}
