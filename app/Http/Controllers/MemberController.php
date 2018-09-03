<?php

namespace App\Http\Controllers;

use App\Member;
use App\Sede;
use App\Client;
use App\MemberHasPlan;
use App\MemberHasSesion;
use App\Plan;
use App\Status;
use App\Program;
use App\Sesion;
use App\PersonalFile;
use Freshwork\ChileanBundle\Rut;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('create', Member::class);
        $members = Member::join('clients','members.tipo','=','clients.id')
                        ->select('members.*','clients.nombre as nombre_tipo')
                        ->get();
        return view('operacion.member.socios_index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $this->authorize('create',Member::class);

        $sucursales = Sede::all();
        $clients = Client::all();
        $statuses= Status::all();
        return view('operacion.member.create', ['sucursales'=>$sucursales,'clients'=>$clients,
                                                        'statuses'=>$statuses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ( Rut::parse(request('rut'))->validate()){
          $member= Member::create($request->all());
        
          if ($request->hasFile('avatar')) {
                  $member->avatar= $request->file('avatar')->store('public/avatars');
          }
          else{
              $member->avatar='default.png';
          }
          if ($request->hasFile('huella')) {
                  $member->huella= $request->file('huella')->store('public/huellas');
          }
          else{
              $member->huella='default-huella.png';
          }
          PersonalFile::create([
              'member_id'=>$member->id,
          ]);
          $member->save();
          return redirect('socios');
        }else{
          return redirect('/socios/create')->with('status', 'RUT invalido!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member= Member::find($id);
        $sucursales = Sede::all();
        $clients = Client::all();
        $sesions= Sesion::all();
        $statuses= Status::all();
        $memberPlan= MemberHasPlan::where('member_id',$id)
                                    ->where('active',1)
                                    ->first();
        $newPlan= MemberHasPlan::where('member_id',$id)
                                    ->where('active',0)
                                    ->where('new',1)
                                    ->first();

        if($newPlan!=null){
            if($newPlan->plan_or_prog==1){
                $newPlanName= Plan::find($newPlan->plan_id);
            }
            else{
                $newPlanName= Program::find($newPlan->plan_id);
            }
        }

        if($memberPlan!=null){
            $memberSesions= $memberPlan->sessions;
            if($memberPlan->plan_or_prog==1){
                $plan= Plan::find($memberPlan->plan_id);
            }
            else{
                $plan= Program::find($memberPlan->plan_id);
            }
        }
        else{
            $plan= null;
            $memberSesions= null;
        }
        return view('operacion.member.edit',compact('memberPlan','memberSesions','member','plan',
                                                        'sucursales','clients','sesions','statuses','newPlan','newPlanName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update',Member::find($id));

        $member= Member::find($id);
        $member->fill($request->all());
        if ($request->hasFile('avatar')) {
            $member->avatar= $request->file('avatar')->store('public/avatars');
        }
        if ($request->hasFile('huella')) {
            $member->huella= $request->file('huella')->store('public/huellas');
        }
        $member->save();
        if($request->memberPlan_id!=null){
          $memberPlan=MemberHasPlan::find($request->memberPlan_id);
          $memberPlan->comen_venc=$request->comen_venc;
          $memberPlan->vencimiento=$request->vencimiento;
          $memberPlan->save();
        }
        
        return redirect('socios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete',Member::find($id));

        $member= Member::find($id);
        $member->estado='4';
        $member->save();
        $members = Member::join('clients','members.tipo','=','clients.id')
                        ->select('members.*','clients.nombre as nombre_tipo')
                        ->get();
        return view('operacion.member.socios_index', compact('members'));
    }

    public function activate($id, $id2)
    {
        $memberPlan=MemberHasPlan::find($id2);
        $memberPlan->estado='0';
        $memberPlan->active='0';
        $sessions = $memberPlan->sessions;
        foreach ($sessions as $session) {
          $session->delete();
        }
        $memberPlan->save();
        $newPlan= MemberHasPlan::find($id);
        $newPlan->active='1';
        $newPlan->new='0';
        $newPlan->save();

        return redirect('socios');
    }

    public function consultas()
    {
        $members= Member::join('clients','members.tipo','=','clients.id')
                                ->join('statuses','members.estado','=','statuses.id')
                                ->join('sedes','members.id_sucursal','=','sedes.id')
                                ->join('member_has_plans','members.id','=','member_has_plans.member_id')
                                ->where('member_has_plans.active',1)
                                ->select('members.*','statuses.nombre as nomb_estado','sedes.nombre as nomb_sede','clients.nombre as nomb_client',
                                        'member_has_plans.plan_id','member_has_plans.plan_or_prog')
                                ->get();
        $plans= Plan::select('plans.id','plans.nombre')->get();
        $programs= Program::select('programs.id','programs.nombre')->get();
        return view('gestion.queries_index',compact('members','plans','programs'));
    }
}
