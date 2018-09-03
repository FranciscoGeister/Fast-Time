<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\PreguntaMember;
use App\PreguntaMedica;
use App\PreguntaHabito;

class EncuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = 0)
    {
      if($id){
        $patologias = Member::find($id)->patologias;
        $preguntas = (object)array(
          'preguntas' => PreguntaMedica::all(),
          'respuestas' => PreguntaMember::where('member_id',$id)->get()
        );
        $antecedentes = Member::find($id)->antecedentes;
        $habitos = (object)array(
          'vida' => PreguntaHabito::where('tipo','vida')->get(),
          'laboral' => PreguntaHabito::where('tipo','laboral')->get(),
          'salud' => PreguntaHabito::where('tipo','salud')->get(),
          'nutricion' => PreguntaHabito::where('tipo','nutricion')->get(),
          'respuestas' => \DB::table('preguntas_habitos_members')->where('member_id',$id)->get()
        );
        return view('fidelizacion.encuestas.verEncuestaMember',compact(
          'patologias',
          'preguntas',
          'antecedentes',
          'habitos'));
      }
      else{
        $members = Member::join('clients','members.tipo','=','clients.id')
                        ->select('members.*','clients.nombre as nombre_tipo')
                        ->get();

        return view('fidelizacion.encuestas.verEncuestas', compact('members'));
      }
    }

    public function getAntecedentes($id){
      return response(Member::find($id)->antecedentes);
    }
    public function getPatologias($id){
      return response(Member::find($id)->patologias);
    }
    public function getPreguntas($id){
      return response()->json([
        'preguntas' => PreguntaMedica::all(),
        'respuestas' => PreguntaMember::where('member_id',$id)->get()
      ]);
    }
    public function getHabitos($id){
      return response()->json([
        'vida' => PreguntaHabito::where('tipo','vida')->get(),
        'laboral' => PreguntaHabito::where('tipo','laboral')->get(),
        'salud' => PreguntaHabito::where('tipo','salud')->get(),
        'nutricion' => PreguntaHabito::where('tipo','nutricion')->get(),
        'respuestas' => \DB::table('preguntas_habitos_members')->where('member_id',$id)->get()
      ]);
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
