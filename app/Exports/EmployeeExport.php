<?php

namespace App\Exports;

use App\Models\Empleado;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeeExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Empleado::all();
    }

    public function headings(): array
    {
        // Encabezados personalizados
        return [
            'ID',
            'Tipo de Doc.',
            'DNI',
            'N° de cuenta',
            'Apellido Paterno',
            'Apellido Materno',
            'Nombres',
            'Mod. de Contratación',
            'Estado'
        ];
    }
}