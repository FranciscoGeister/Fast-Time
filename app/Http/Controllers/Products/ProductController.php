<?php

namespace App\Http\Controllers\Products;

use App\Product;
use App\Underwear;
use App\CleaningProduct;
use App\Sede;
use App\ProductEntry;
use App\Unity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view',Product::class);
        $products = Product::where('estado',7)->get();
        $underwears = Underwear::where('estado',7)->get();
        $cleanings = CleaningProduct::where('estado',7)->get();
        $sucursales = Sede::all();
        return view('administracion.bodega.index', compact('products','underwears','cleanings','sucursales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create',Product::class);
        $sedes = Sede::all();
        $unities = Unity::all();
        return view('administracion.bodega.create',['sucursal'=>$request['sucursal'],'id_sucursal'=>$request['id_sucursal'],'sedes'=>$sedes,'unities'=>$unities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create',Product::class);
        $product= Product::create([
            'nombre'=>$request['nombre'],
            'marca'=>$request['marca'],
            'stock'=>$request['stock'],
            'stock_critico'=>$request['stock_critico'],
            'id_sucursal'=>$request['id_sucursal'],
            'precio'=>$request['precio'],
            'vencimiento'=>$request['vencimiento'],
            'um'=>$request['um'],
            'estado'=>$request['estado'],
            'descripcion'=>$request['descripcion'],
            ]);
        ProductEntry::create([
            'boleta'=>$request['boleta'],
            'id_sucursal'=>$request['id_sucursal'],
            'cant_agregar'=>$request['stock'],
            'id_product'=>$product->id,
            'comentario'=>$request['descripcion'],
            'tipo'=>'producto',
            'id_user'=>Auth::id(),
        ]);
        return redirect('productos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $unities = Unity::all();
        $this->authorize('update',$product);
        return view('administracion.bodega.edit_producto',compact('product','unities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product= Product::find($id);
        $this->authorize('update',$product);
        $product->fill($request->all());
        $product->save();
        return redirect('productos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $product= Product::find($id);
        $this->authorize('delete',$product);
        $product->estado='8';
        $product->save();
        return redirect('productos');
    }
}
