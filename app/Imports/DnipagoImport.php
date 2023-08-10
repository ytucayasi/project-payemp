<?php

namespace App\Imports;

use App\Models\Dnipago;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DnipagoImport implements ToModel, WithHeadingRow
{

  public function model(array $row)
  {
    return new Dnipago([
      'dni' => $row['dni'],
      'monto' => $row['monto']
    ]);
  }
}
