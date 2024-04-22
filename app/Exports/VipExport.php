<?php

namespace App\Exports;

use App\Models\Vip;
use Maatwebsite\Excel\Concerns\FromCollection;

class VipExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Vip::all();
    }
}
