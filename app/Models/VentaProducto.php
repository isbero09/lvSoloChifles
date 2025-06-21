<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VentaProducto extends Model
{
    protected $fillable = ["cliente", "producto", "detalle", "precio", "fecha"];
}