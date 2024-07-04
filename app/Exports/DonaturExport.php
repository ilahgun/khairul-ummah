<?php

namespace App\Exports;

use App\Models\Donatur;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DonaturExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        //return Donatur::all();
        $ar_donatur = DB::table('donatur')
            ->select('donatur.nama', 'donatur.no_hp')
            ->get();
        return $ar_donatur;
    }

    public function headings(): array
    {
        return ["Nama", "No. Handphone"];
    }
}
