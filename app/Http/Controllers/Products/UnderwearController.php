<?php

namespace App\Http\Controllers\Products;

use App\Underwear;
use App\ProductEntry;
use App\Size;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnderwearController extends Controller
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
    public function create(Request $request)
    {
        $sizes= Size::all();
        return view('administracion.bodega.createUnderwear',['sucursal'=>$request['sucursal'], 'id_sucursal'=>$request['id_sucursal'],'sizes'=>$sizes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $underwear= Underwear::create([
            'nombre'=>$request['nombre'],
            'marca'=>$request['marca'],
            'talla'=>$request['talla'],
            'stock_critico'=>$request['stock_critico'],
            'id_sucursal'=>$request['id_sucursal'],
            'precio'=>$request['precio'],
            'estado'=>$request['estado'],
            'precio_arriendo'=>$request['precio_arriendo'],
            'stock'=>$request['stock'],
            ]);
        ProductEntry::create([
            'boleta'=>$request['boleta'],
            'id_sucursal'=>$request['id_sucursal'],
            'cant_agregar'=>$request['stock'],
            'id_product'=>$underwear->id,
            'comentario'=>$request['comentario'],
            'tipo'=>'underwear',
            'id_user'=>Auth::id(),
        ]);
        return redirect('productos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Underwear  $underwear
     * @return \Illuminate\Http\Response
     */
    public function show(Underwear $underwear)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Underwear  $underwear
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $underwear = Underwear::find($id);
        $sizes = Size::all();
        return view('administracion.bodega.edit_underwear',['underwear'=>$underwear,'sizes'=>$sizes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Underwear  $underwear
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $underwear= Underwear::find($id);
        $underwear->fill($request->all());
        $underwear->save();
        return redirect('productos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Underwear  $underwear
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $underwear= Underwear::find($id);
        $underwear->estado='0';
        $underwear->save();
        return redirect('productos');
    }
}
