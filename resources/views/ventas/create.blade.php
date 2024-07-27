@extends('adminlte::page')

@section('title', 'Crear Venta')

@section('content_header')
    <h1>Crear Nueva Venta</h1>
@stop

@section('content')
<div class="container">
    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="producto">Producto</label>
                <select id="producto" class="form-control">
                    <option value="">Seleccione un producto</option>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id }}" data-precio="{{ $producto->precio }}" data-stock="{{ $producto->stock }}">
                            {{ $producto->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="precio">Precio</label>
                <input type="text" id="precio" class="form-control" readonly>
            </div>
            <div class="form-group col-md-2">
                <label for="stock">Stock</label>
                <input type="text" id="stock" class="form-control" readonly>
            </div>
            <div class="form-group col-md-2">
                <label for="cantidad">Cantidad</label>
                <input type="number" id="cantidad" class="form-control">
            </div>
        </div>

        <button type="button" id="agregarProducto" class="my-4 btn btn-primary">Agregar Producto</button>

        <h3>Detalle de Venta</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="detalleVenta"></tbody>
        </table>

        <h4>Total: <span id="totalVentaDisplay">0</span></h4>
        <input type="hidden" name="total" id="totalVenta" value="0">

        <button type="submit" class="mt-4 btn btn-success">Confirmar Venta</button>
    </form>
</div>
@stop

@section('js')
<script>
    document.getElementById('producto').addEventListener('change', function() {
        let selectedOption = this.options[this.selectedIndex];
        let precio = selectedOption.getAttribute('data-precio');
        let stock = selectedOption.getAttribute('data-stock');
        document.getElementById('precio').value = precio;
        document.getElementById('stock').value = stock;
    });

    document.getElementById('agregarProducto').addEventListener('click', function() {
        let productoSelect = document.getElementById('producto');
        let productoId = productoSelect.value;
        let productoNombre = productoSelect.options[productoSelect.selectedIndex].text;
        let precio = document.getElementById('precio').value;
        let cantidad = document.getElementById('cantidad').value;
        let stock = document.getElementById('stock').value;

        if (productoId && cantidad > 0 && cantidad <= stock) {
            let detalleVenta = document.getElementById('detalleVenta');
            let newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${productoNombre}</td>
                <td>${precio}</td>
                <td>${cantidad}</td>
                <td>${precio * cantidad}</td>
                <td><button type="button" class="btn btn-danger btn-sm eliminarProducto">Eliminar</button></td>
            `;
            detalleVenta.appendChild(newRow);

            let totalVenta = document.getElementById('totalVenta');
            let totalVentaDisplay = document.getElementById('totalVentaDisplay');
            totalVenta.value = parseFloat(totalVenta.value) + (precio * cantidad);
            totalVentaDisplay.innerText = totalVenta.value;

            // Limpiar campos de entrada
            productoSelect.value = '';
            document.getElementById('precio').value = '';
            document.getElementById('stock').value = '';
            document.getElementById('cantidad').value = '';
        }
    });

    document.getElementById('detalleVenta').addEventListener('click', function(event) {
        if (event.target.classList.contains('eliminarProducto')) {
            let row = event.target.closest('tr');
            let totalVenta = document.getElementById('totalVenta');
            let totalVentaDisplay = document.getElementById('totalVentaDisplay');
            totalVenta.value = parseFloat(totalVenta.value) - parseFloat(row.cells[3].innerText);
            totalVentaDisplay.innerText = totalVenta.value;
            row.remove();
        }
    });
</script>
@stop
