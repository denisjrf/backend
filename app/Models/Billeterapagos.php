<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billeterapagos extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_session',
        'token',
        'monto',
        'documento',
        'celular'
    ];
}
