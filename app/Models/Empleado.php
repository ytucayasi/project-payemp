<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'empleados'; // Nombre de la tabla
    
    protected $primaryKey = 'id'; // Clave primaria
    
    protected $guarded = ['id']; // Campos asignables en masa
    
    protected $casts = [
        'estado' => 'integer', // Definir tipos de datos para castear
    ];
}
