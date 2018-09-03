<?php

namespace App\Http\Controllers\ControlBodega;

use App\ProductTransfer;
use App\Product;
use App\Underwear;
use App\CleaningProduct;
use App\Sede;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductTransferController extends Controller
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
        $this->authorize('view', Product::class);
        $sucursales = Sede::all();
        $sucursal_origen = Sede::find(request('id_origen'));
        if(strcmp($request['tipo'],"producto")== 0){
            $item = Product::find(request('id_product_origen'));
        }
        elseif(strcmp($request['tipo'],"underwear")== 0){
            $item = Underwear::find(request('id_product_origen'));
        }
        else{
            $item = CleaningProduct::find(request('id_product_origen'));
        }
        $tipo = request('tipo');
        return view('administracion.bodega.controlTransfer', compact('sucursales','sucursal_origen','item','tipo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('view', Product::class);
        ProductTransfer::create([
            'id_origen'=>$request['id_origen'],
            'id_destino'=>$request['id_destino'],
            'cantidad'=>$request['cantidad'],
            'id_product_origen'=>$request['id_product_origen'],
            'id_product_destino'=>$request['id_product_destino'],
            'comentario'=>$request['comentario'],
            'tipo'=>$request['tipo'],
            'id_user'=>Auth::id(),
        ]);
        if(strcmp($request['tipo'],"producto")== 0){
            $product_origen= Product::find($request['id_product_origen']);
            $product_origen->stock=$product_origen->stock-$request['cantidad'];
            $product_origen->save();
            $product_destino= Product::find($request['id_product_destino']);
            $product_destino->stock=$product_destino->stock+$request['cantidad'];
            $product_destino->save();
        }
        elseif(strcmp($request['tipo'],"underwear")== 0){
            $underwear_origen= Underwear::find($request['id_product_origen']);
            $underwear_origen->stock=$underwear_origen->stock-$request['cantidad'];
            $underwear_origen->save();
            $underwear_destino= Underwear::find($request['id_product_destino']);
            $underwear_destino->stock=$underwear_destino->stock+$request['cantidad'];
            $underwear_destino->save();
        }
        else{
            $cleaninig_origen= CleaningProduct::find($request['id_product_origen']);
            $cleaninig_origen->stock=$cleaninig_origen->stock-$request['cantidad'];
            $cleaninig_origen->save();
            $cleaninig_destino= CleaningProduct::find($request['id_product_destino']);
            $cleaninig_destino->stock=$cleaninig_destino->stock+$request['cantidad'];
            $cleaninig_destino->save();
        }
        return redirect('productos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductTransfer  $productTransfer
     * @return \Illuminate\Http\Response
     */
    public function show(ProductTransfer $productTransfer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductTransfer  $productTransfer
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductTransfer $productTransfer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductTransfer  $productTransfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductTransfer $productTransfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductTransfer  $productTransfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductTransfer $productTransfer)
    {
        //
    }

    public function getSucursales(Request $request){
        $this->authorize('view', Product::class);
        $sucursales = Sede::all();//get data from table
        return view('administracion.bodega.controlTransfer', ['sucursales'=>$sucursales, 'id_origen'=>$request['id_origen'], 'nom_sucursal'=>$request['nom_sucursal'], 'id_product_origen'=>$request['id_product_origen'], 'tipo'=>$request['tipo']]);//sent data to view

    }

    public function findProductName(Request $request){
        if(strcmp($request->tipo,"producto")== 0){
            $data = Product::select('nombre','id','marca')->where('id_sucursal',$request->id)->get();
        }
        elseif(strcmp($request->tipo,"underwear")== 0){
            $data = Underwear::select('nombre','id','marca')->where('id_sucursal',$request->id)->get();
        }
        else{
            $data = CleaningProduct::select('nombre','id','marca')->where('id_sucursal',$request->id)->get();
        }        
        return response()->json($data);
    }

    public function findStock(Request $request){
        if(strcmp($request->tipo,"producto")== 0){
            $stock = Product::select('stock')->where('id',$request->id)->first();
        }
        elseif(strcmp($request->tipo,"underwear")== 0){
            $stock = Underwear::select('stock')->where('id',$request->id)->first();
        }
        else{
            $stock = CleaningProduct::select('stock')->where('id',$request->id)->first();
        }   
        return response()->json($stock);
    }
}
