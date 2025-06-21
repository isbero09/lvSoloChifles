<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = ["cedula" ,"nombre", "apellido", "email", "rol", "telefono", "estado"];
}