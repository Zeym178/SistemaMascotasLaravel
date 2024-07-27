<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'productos';
    protected $pirmaryKey = 'id';
    public $timestamps = false;
    protected $fillable=[
        'codigo',
        'nombre',
        'categoria',
        'stock',
        'precio'
    ];

    protected $guarded = [

    ];
}
