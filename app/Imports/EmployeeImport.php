<?php

namespace App\Imports;

use App\Models\Empleado;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeeImport implements ToModel, WithHeadingRow
{

  public function model(array $row)
  {
    return new Empleado([
      'tipdoc' => $row['tipo_documento'],
      'dni' => $row['dni'],
      'nCuenta' => $row['numero_cuenta'],
      'aPaterno' => $row['apellido_paterno'],
      'aMaterno' => $row['apellido_materno'],
      'nombres' => $row['nombres'],
      'modContratacion' => $row['modo_contratacion']
    ]);
  }
}
