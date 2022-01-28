<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;
    protected $table = 'estado'; // Nombre de la tabla
    protected $fillable = [
        'id_pais',
        'nombre',
    ];
    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }
}
