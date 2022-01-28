<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;
    protected $table = 'ciudad'; // Nombre de la tabla
    protected $fillable = [
        'id_estado',
        'nombre',
    ];
    public function pais()
    {
        return $this->belongsTo(Estado::class);
    }
}
