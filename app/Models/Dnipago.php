<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dnipago extends Model
{
  use HasFactory;

  public $timestamps = false;

  protected $table = 'dnipago'; // Nombre de la tabla

  protected $primaryKey = 'id'; // Clave primaria

  protected $guarded = ['id']; // Campos asignables en masa

  protected $casts = [
    'monto' => 'float', // Definir tipos de datos para castear
  ];
}
