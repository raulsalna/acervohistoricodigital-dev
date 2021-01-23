<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\ArchiveImport2;


class SheetImport2 implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
             'Formulario' => new ArchiveImport2()
        ];
    }
}
