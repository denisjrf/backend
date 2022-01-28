<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billetera extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_cliente',
        'documento',
        'celular',
        'valor'
    ];
}