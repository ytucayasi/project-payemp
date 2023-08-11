<?php

namespace App\Http\Livewire;

use App\Imports\DnipagoImport;
use App\Models\Dnipago as ModelsDnipago;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithFileUploads;
use App\Exports\DnipagoExport;
use App\Models\Empleado;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Dnipago extends Component
{
  use WithFileUploads;

  public $search = '';
  public $pagos = [];
  public $showModal = false;
  public $showModal2 = false;
  public $progress = 0;
  public $excelFile;

  public function render()
  {
    $this->pagos = ModelsDnipago::where('dni', 'LIKE', "%{$this->search}%")->get();
    return view('livewire.dnipago');
  }

  public function updatedExcelFile()
  {
    $this->validate([
      'excelFile' => 'required|mimes:xlsx,csv'
    ]);
  }

  public function importExcel()
  {
    $this->validate([
      'excelFile' => 'required|mimes:xlsx,csv'
    ]);

    DB::table('dnipago')->truncate();

    Excel::import(new DnipagoImport, $this->excelFile);

    session()->flash('message', 'Datos del Excel cargados exitosamente.');
  }
  public function prepareDataForExport()
  {
      $data = [];

      foreach ($this->pagos as $pago) {
          $empleado = Empleado::where('dni', $pago->dni)->first();

          if ($empleado) {
              $data[] = [
                  'dni' => $empleado->dni,
                  'nCuenta' => $empleado->nCuenta,
                  'aPaterno' => $empleado->aPaterno,
                  'aMaterno' => $empleado->aMaterno,
                  'nombres' => $empleado->nombres,
                  'modContratacion' => $empleado->modContratacion,
                  'monto' => $pago->monto,
                  'estado' => $empleado->estado,
              ];
          }
      }

      return $data;
  }
  public function exportToExcel()
    {
        $data = $this->prepareDataForExport();

        return Excel::download(new class($data) implements FromArray, WithHeadings {
          private $data;
      
          public function __construct($data)
          {
              $this->data = $data;
          }
      
          public function array(): array
          {
              return $this->data;
          }
      
          public function headings(): array
          {
              return [
                  'DNI',
                  'N° CUENTA',
                  'APELL. PATERNO',
                  'APELL. MATERNO',
                  'NOMBRES',
                  'MODO. DE CONTRA.',
                  'MONTO',
                  'ESTADO',
              ];
          }
      }, 'pagosEmpleado.xlsx');
    }

  
}
