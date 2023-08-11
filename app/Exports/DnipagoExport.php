<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;

class DnipagoExport implements FromCollection
{
    protected $pagos;

    public function __construct($pagos)
    {
        $this->pagos = $pagos;
    }

    public function collection()
    {
        return $this->pagos;
    }
}