<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';
    protected $pirmaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['vendedor', 'total', 'fecha'];
    protected $guarded = [

    ];
}

