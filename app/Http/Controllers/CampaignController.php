<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Member;
use App\CampaignMember;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $this->authorize("view",Campaign::class);
      $members = Member::join('clients','members.tipo','=','clients.id')
                      ->select('members.*','clients.nombre as nombre_tipo')
                      ->get();
      $campañas = Campaign::all();
      return view('fidelizacion.campañas.verCampañas', compact('campañas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $this->authorize("create",Campaign::class);
      $members = Member::join('clients','members.tipo','=','clients.id')
                    ->select('members.*','clients.nombre as nombre_tipo')
                    ->get();
    return view('fidelizacion.crearCampañas', compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->authorize("create",Campaign::class);
      $socios= request('socio');
      $campaña = Campaign::create([
          'nombre'=>request('nombre'),
          'mensaje'=>request('mensaje'),
          'descripcion'=>request('descripcion'),
          'imagen'=>$request->file('imagen')->store('public/campañas'),
      ]);
      $campaña->save();
      foreach ($socios as $socio){
          CampaignMember::create([
            'campaign_id' => $campaña->id,
            'member_id' => $socio
          ]);
      }
      return redirect('campañas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function editar($campaign)
    {
      $campaña = Campaign::find($campaign);
      $this->authorize("update",$campaña);
      $members = Member::join('clients','members.tipo','=','clients.id')
                    ->select('members.*','clients.nombre as nombre_tipo')
                    ->get();
      return view('fidelizacion.campañas.editarCampañas', compact('members','campaña'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campaña = Campaign::find($id);
        $this->authorize("update",$campaña);
        $campaña->fill($request->all());
        if ($request->hasFile('imagen')) {
            $campaña->imagen= $request->file('imagen')->store('public/campañas');
        }
        $campaña->save();
        $campaña_socios = CampaignMember::where('campaign_id',$id)->get();
        foreach($campaña_socios as $cs){
          $cs->delete();
        }
        foreach($request->socio as $s){
          CampaignMember::insert([
            'campaign_id' => $campaña->id,
            'member_id' => $s
          ]);
        }
        return redirect('campañas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $campaign = Campaign::find($id);
      $this->authorize("delete",$campaign);
      $campaña_socio = CampaignMember::where('campaign_id',$id);
      $campaña_socio->delete();
      $campaign->delete();
      return redirect('campañas');
    }
}
