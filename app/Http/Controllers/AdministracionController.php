<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profesional;
use App\Sede;

class AdministracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profesionales = Profesional::all();
        $sedes = Sede::all();
        return view('administracion.disponibilidad', ['profesionales'=>$profesionales, 'sedes'=>$sedes]);
    }

}
