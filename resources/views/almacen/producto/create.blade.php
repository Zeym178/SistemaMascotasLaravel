@extends('adminlte::page')

@section('title', 'Crear Producto')

@section('content_header')
    <h1>Crear Nuevo Producto</h1>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Nueva Producto</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('producto.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="codigo">Codigo</label>
                            <input type="text" name="codigo" class="form-control" id="codigo" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" id="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="categoria">Categoría</label>
                            <select name="categoria" class="form-control" id="categoria" required>
                                <option value="">Seleccione una categoría</option>
                                @foreach($Categoria as $cat)
                                    <option value="{{ $cat->id }}" {{ $cat->id == $cat->nombre ? 'selected' : '' }}>
                                        {{ $cat->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="number" name="stock" class="form-control" id="stock" required>
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="number" name="precio" class="form-control" id="precio" step="any" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('producto.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
