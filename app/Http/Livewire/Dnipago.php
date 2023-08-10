<?php

namespace App\Http\Livewire;

use App\Imports\DnipagoImport;
use App\Models\Dnipago as ModelsDnipago;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithFileUploads;

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
}
