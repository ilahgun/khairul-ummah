<?php

namespace App\Exports;

use App\Models\Anak_asuh;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Anak_asuhExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Anak_asuh::select("nama", "tmp_lahir", "tgl_lahir", "gender", "pendidikan")->get();
    }

    public function headings(): array
    {
        return ["Nama", "Tempat Lahir", "Tanggal Lahir", "Jenis Kelamin", "Pendidikan"];
    }
}
