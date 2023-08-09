<?php

namespace App\Http\Livewire;

use App\Imports\EmployeeImport;
use App\Models\Empleado;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithFileUploads;

class EmployeeList extends Component
{
  use WithFileUploads;

  public $search = '';
  public $empleados = [];
  public $showModal = false;
  public $progress = 0;
  public $excelFile;

  public function render()
  {
    $this->empleados = Empleado::where('dni', 'LIKE', "%{$this->search}%")->get();
    return view('livewire.employee-list');
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

    Excel::import(new EmployeeImport($this), $this->excelFile);

    session()->flash('message', 'Datos del Excel cargados exitosamente.');
  }

  public function updateProgress($progress)
  {
    $this->progress = $progress;
  }
}
