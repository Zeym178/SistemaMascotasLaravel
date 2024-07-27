<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Producto;
use Illuminate\Http\Request;

use App\Models\Venta;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
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
            $ventas=DB::table('ventas')->where('vendedor', 'LIKE', '%'.$query.'%')
            ->paginate(10);
            return view('ventas.index', ["ventas"=>$ventas, "serchlext"=>$query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::all(); // Obtener todas las categorías
        return view("ventas.create", compact('productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ventas=new Venta;
        $us = Auth::user();
        $ventas->vendedor = $us->name;
        //$ventas->vendedor = "hola";
        $ventas->total=$request->get('total');
        $ventas->fecha= Carbon::now()->format('d/m/Y');
        $ventas->save();
        return Redirect::to('ventas');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view("ventas.show", ["Venta"=>Venta:: findorFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view("ventas.edit", ["Venta"=>Venta:: findorFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $ventas=Venta::findOrFail($id);
        $ventas->vendedor=$request->get('vendedor');
        $ventas->total=$request->get('total');
        $ventas->update();
        return Redirect::to('ventas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ventas=Venta::findOrFail($id);
        $ventas->delete();
        return Redirect::to('ventas');
    }
}
