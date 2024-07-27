@extends('adminlte::page')

@section('title', 'Historial de Ventas')

@section('content_header')
    <h1>Historial de Ventas</h1>
@stop

@section('content')
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Vendedor</th>
                <th>Total</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
                <tr>
                    <td>{{ $venta->id }}</td>
                    <td>{{ $venta->vendedor }}</td>
                    <td>{{ $venta->total }}</td>
                    <td>{{ $venta->fecha }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $ventas->Links() }}
</div>
@stop
