<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OneSignal;
use App\Notification;
use App\Member;
use App\NotificationMember;
use Session;
use Redirect;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("view",Notification::class);
        $notifications = Notification::all();
        $members = Member::all();
        return view('fidelizacion.notificaciones.verNotificaciones',compact('notifications','members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize("create",Notification::class);
        $members = Member::all();
        return view('fidelizacion.notificaciones.crearNotificaciones',compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize("create",Notification::class);
        $socios= request('socio');
        $notification = Notification::create([
            'name' => request('name'),
            'message' => request('message'),
            'schedule' => request('schedule'),
            'url' => request('url')
        ]);
        $notification->save();
        foreach ($socios as $socio){
            NotificationMember::create([
              'notification_id' => $notification->id,
              'member_id' => $socio
            ]);
        }
        return redirect('notifications');
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
        $notification = Notification::find($id);
        $this->authorize("update",$notification);
        $members = Member::all();
        return view('fidelizacion.notificaciones.editarNotificaciones',compact('members','notification'));
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
      $notification = Notification::find($id);
      $this->authorize("update",$notification);
      $socios= request('socio');
      $date = request('date');
      $time = request('time');
      $schedule = $date . " " . $time . " -300";
      $notification->fill($request->all());
      $notification->schedule = $schedule;
      $notification->save();
      $notification_members = NotificationMember::where('notification_id',$notification->id)->get();
      foreach($notification_members as $nm){
        $nm->delete();
      }
      foreach($socios as $s){
        NotificationMember::insert([
          'notification_id' => $notification->id,
          'member_id' => $s
        ]);
      }
      return redirect('notifications');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $notification = Notification::find($id);
      $this->authorize("delete",$notification);
      NotificationMember::where('notification_id',$id)->delete();
      $notification->delete();
      return redirect('notifications');
    }

    public function sendNotification($notification_id){
      $this->authorize("send",Notification::class);
      $notification = Notification::find($notification_id);
      $members = $notification->miembros;
      foreach($members as $member){
        $tags = array(array("key" => "id", "relation" => "=", "value" => $member->id),);
        OneSignal::sendNotificationUsingTags($notification->message,$tags,$url = $notification->url,
        $data = null, $buttons = null, $schedule = $notification->schedule);
      }
      Session::flash('msg', 'Notificación enviada');
      return Redirect::back();
      // return redirect('notifications');
    }

    public function sendQuickNotification(Request $request){
      $this->authorize("send",Notification::class);
      $socios = request('socio');
      $time = request('time');
      $date = request('date');
      $schedule = $date . " " . $time . " GMT-0300";
      foreach($socios as $socio){
        $tags = array(array("key" => "id", "relation" => "=", "value" => $socio),);
        OneSignal::sendNotificationUsingTags(request('message'),$tags,$url = request('url'),
        $data = null, $buttons = null, $send_after = $schedule);
      }
      Session::flash('msg', 'Notificación enviada');
      return Redirect::back();
      //return redirect('notifications');
    }
}
