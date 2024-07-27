<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class productoController extends Controller
{
    public function __construct(){

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $productos=DB::table('productos')->where('nombre', 'LIKE', '%'.$query.'%')
            ->paginate(10);
            return view('almacen.producto.index', ["producto"=>$productos, "serchlext"=>$query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Categoria = Categoria::all(); // Obtener todas las categorías
        return view('almacen.producto.create', compact('Categoria'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $producto = new Producto;
        $producto->codigo=$request->get('codigo');
        $producto->nombre=$request->get('nombre');
        $producto->categoria=$request->get('categoria');
        $producto->stock=$request->get('stock');
        $producto->precio=$request->get('precio');
        $producto->save();
        return Redirect::to('almacen/producto');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view("almacen.producto.show", ["producto"=>Producto:: findorFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Categoria = Categoria::all();
        return view("almacen.producto.edit", compact('Categoria'), ["producto"=>Producto:: findorFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $producto=Producto::findOrFail($id);
        $producto->codigo=$request->get('codigo');
        $producto->nombre=$request->get('nombre');
        $producto->categoria=$request->get('categoria');
        $producto->stock=$request->get('stock');
        $producto->precio=$request->get('precio');
        $producto->update();
        return Redirect::to('almacen/producto');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $producto=Producto::findOrFail($id);
        $producto->delete();
        return Redirect::to('almacen/producto');
    }
}
