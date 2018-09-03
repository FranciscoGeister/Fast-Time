<?php

namespace App\Http\Controllers\ControlBodega;

use App\ProductEntry;
use App\Product;
use App\Underwear;
use App\CleaningProduct;
use App\Sede;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entries= ProductEntry::all();        
        return view('administracion.bodega.index_ingresos', compact('entries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(strcmp($request['tipo'],"producto")== 0){
            $item = Product::find(request('id_product'));
        }
        elseif(strcmp($request['tipo'],"underwear")== 0){
            $item = Underwear::find(request('id_product'));
        }
        else{
            $item = CleaningProduct::find(request('id_product'));
        }
        $sucursal = Sede::find(request('id_sucursal'));
        $tipo = request('tipo');
        return view('administracion.bodega.controlIngreso', compact('sucursal','item','tipo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ProductEntry::create([
            'boleta'=>$request['boleta'],
            'id_sucursal'=>$request['id_sucursal'],
            'cant_agregar'=>$request['cant_agregar'],
            'id_product'=>$request['id_product'],
            'comentario'=>$request['comentario'],
            'tipo'=>$request['tipo'],
            'id_user'=>Auth::id(),
        ]);
        if(strcmp($request['tipo'],"producto")== 0){
            $product= Product::find($request['id_product']);
            $product->stock=$product->stock+$request['cant_agregar'];
            $product->vencimiento=$request['vencimiento'];
            $product->save();
        }
        elseif(strcmp($request['tipo'],"underwear")== 0){
            $underwear= Underwear::find($request['id_product']);
            $underwear->stock=$underwear->stock+$request['cant_agregar'];
            $underwear->save();
        }
        else{
            $cleaninig= CleaningProduct::find($request['id_product']);
            $cleaninig->stock=$cleaninig->stock+$request['cant_agregar'];
            $cleaninig->save();
        }
        return redirect('productos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductEntry  $productEntry
     * @return \Illuminate\Http\Response
     */
    public function show(ProductEntry $productEntry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductEntry  $productEntry
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductEntry $productEntry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductEntry  $productEntry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductEntry $productEntry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductEntry  $productEntry
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductEntry $productEntry)
    {
        //
    }



    /**
     * intento fallido
     *
    public function primerIngreso($id_sucursal, $id_product, $tipo, $boleta, $cant_agregar, $comentario){
        ProductEntry::create([
            'boleta'=>$boleta,
            'cant_agregar'=>$cant_agregar,
            'comentario'=>$comentario,
            'id_user'=>Auth::user()->id,
            'id_product'=>$id_product,
            'id_sucursal'=>$id_sucursal,
            'tipo'=>$tipo,
        ]);
        return redirect('productos');
    }
    */
}
