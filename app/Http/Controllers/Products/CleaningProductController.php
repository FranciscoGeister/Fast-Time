<?php

namespace App\Http\Controllers\Products;

use App\CleaningProduct;
use App\ProductEntry;
use App\Unity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CleaningProductController extends Controller
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
        $unities = Unity::all();
        return view('administracion.bodega.create_cleaning',['sucursal'=>$request['sucursal'],'id_sucursal'=>$request['id_sucursal'],'unities'=>$unities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $cleaning= CleaningProduct::create([
            'nombre'=>$request['nombre'],
            'marca'=>$request['marca'],
            'stock'=>$request['stock'],
            'stock_critico'=>$request['stock_critico'],
            'id_sucursal'=>$request['id_sucursal'],
            'estado'=>$request['estado'],
            'descripcion'=>$request['descripcion'],
            ]);
        ProductEntry::create([
            'boleta'=>$request['boleta'],
            'id_sucursal'=>$request['id_sucursal'],
            'cant_agregar'=>$request['stock'],
            'id_product'=>$cleaning->id,
            'comentario'=>$request['comentario'],
            'tipo'=>'aseo',
            'id_user'=>Auth::id(),
        ]);
        return redirect('productos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CleaningProduct  $cleaningProduct
     * @return \Illuminate\Http\Response
     */
    public function show(CleaningProduct $cleaningProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CleaningProduct  $cleaningProduct
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cleaning= CleaningProduct::find($id);
        $unities = Unity::all();
        return view('administracion.bodega.edit_cleaning',['cleaning'=>$cleaning,'unities'=>$unities]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CleaningProduct  $cleaningProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cleaning= CleaningProduct::find($id);
        $cleaning->fill($request->all());
        $cleaning->save();
        return redirect('productos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CleaningProduct  $cleaningProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cleaning= CleaningProduct::find($id);
        $cleaning->estado='0';
        $cleaning->save();
        return redirect('productos');
    }
}
