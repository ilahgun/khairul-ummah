<?php

namespace App\Exports;

use App\Models\Kategori_Kegiatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Kategori_KegiatanExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        //return Donatur::all();
        $ar_kategori_kegiatan = DB::table('kategori_kegiatan')
            ->select('kategori_kegiatan.nama')
            ->get();
        return $ar_kategori_kegiatan;
    }

    public function headings(): array
    {
        return ["Nama"];
    }
}
