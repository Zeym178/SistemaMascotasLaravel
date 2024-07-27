<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = 'detalle';
    protected $pirmaryKey = 'id';
    protected $fillable = ['id_pro', 'cantidad', 'precio', 'id_venta'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }
}
