@extends('adminlte::page')

@section('title', 'Listado de Categorías')

@section('content_header')
    <h1>Listado de Productos</h1>
@stop

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <a href="{{ route('producto.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Agregar Nueva Producto
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Categoria</th>
                        <th>Stock</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($producto as $pro)
                        <tr>
                            <td>{{ $pro->id }}</td>
                            <td>{{ $pro->codigo }}</td>
                            <td>{{ $pro->nombre }}</td>
                            <td>{{ $pro->categoria }}</td>
                            <td>{{ $pro->stock }}</td>
                            <td>{{ $pro->precio }}</td>
                            <td>
                                <a href="{{ route('producto.edit', $pro->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('producto.destroy', $pro->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta categoría?')">
                                        <i class="fa fa-trash"></i> Borrar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $producto->Links() }}
        </div>
    </div>
</div>
@stop
