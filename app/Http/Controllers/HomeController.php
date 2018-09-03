<?php

namespace App\Http\Controllers;
use App\Sesion;
use App\Event;
use App\Sede;
use App\Profesional;
use App\Status;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
           $types = Sesion::all();
           $sedes = Sede::all();
           $events = Event::all();
           $profesionals = Profesional::all();
           $status = Status::all();
          return view('home', ['status'=>$status,
                                                 'events'=>$events,
                                                 'profesionales'=>$profesionals,
                                                 'sedes'=> $sedes,
                                                 'types' => $types]);

    }
}
