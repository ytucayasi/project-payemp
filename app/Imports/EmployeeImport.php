<?php
namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\Empleado;
use Illuminate\Support\Collection;

class EmployeeImport implements ToModel, WithChunkReading, WithEvents
{
  use Importable;

  private $importer;
  private $totalRows;

  public function __construct($importer)
  {
    $this->importer = $importer;
  }

  public function model(array $row)
  {
    return new Empleado([
      'n' => $row[0],
      'tipdoc' => $row[1],
      'dni' => $row[2],
      'nCuenta' => $row[3],
      'aPaterno' => $row[4],
      'aMaterno' => $row[5],
      'nombres' => $row[6],
      'modContratacion' => $row[7]
    ]);

    $this->importer->updateProgress($this->getCurrentRowCount());
  }

  public function getCurrentRowCount()
  {
    return $this->getRowCount() - $this->startRow() + 1;
  }

  public function getRowCount()
  {
    return $this->totalRows;
  }

  public function chunkSize(): int
  {
    return 100; // El número de filas a importar en cada iteración
  }

  public function startRow(): int
  {
    return 2; // La fila en la que comienzan los datos (excluyendo encabezados)
  }

  public function registerEvents(): array
  {
    return [
      AfterSheet::class => function (AfterSheet $event) {
        $this->totalRows = $event->sheet->getHighestRow();
      }
    ];
  }
}
