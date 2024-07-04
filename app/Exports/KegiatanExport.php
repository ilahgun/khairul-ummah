<?php

namespace App\Exports;

use App\Models\Kegiatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KegiatanExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Kegiatan::select("nama", "tgl_kegiatan", "deskripsi", "kategori_id")->get();
    }
    public function headings(): array
    {
        return ["Nama", "Tanggal Kegiatan", "Deskripsi", "Kategori Kegiatan"];
    }
}
