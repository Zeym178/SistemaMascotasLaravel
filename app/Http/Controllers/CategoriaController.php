<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categoria;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoriaFormRequest;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
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
            $categorias=DB::table('categoria')->where('nombre', 'LIKE', '%'.$query.'%')
            ->paginate(10);
            return view('almacen.categoria.index', ["categoria"=>$categorias, "serchlext"=>$query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("almacen.categoria.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categoria=new Categoria;
        $categoria->nombre=$request->get('categoria');
        $categoria->descripcion=$request->get('descripcion');
        $categoria->save();
        return Redirect::to('almacen/categoria');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view("almacen.categoria.show", ["categoria"=>Categoria:: findorFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view("almacen.categoria.edit", ["categoria"=>Categoria:: findorFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $categoria=Categoria::findOrFail($id);
        $categoria->nombre=$request->get('categoria');
        $categoria->descripcion=$request->get('descripcion');
        $categoria->update();
        return Redirect::to('almacen/categoria');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categoria=Categoria::findOrFail($id);
        $categoria->delete();
        return Redirect::to('almacen/categoria');
    }
}
