<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $ar_user = DB::table('users')
            ->select(
                'users.nama',
                'users.no_hp',
                'users.email',
                'users.password',
                'users.status',
                'users.role',
            )
            ->get();
        return $ar_user;
    }

    public function headings(): array
    {
        return ["Nama", "No Handphone", "Email", "Password", "Status", "Role",];
    }
}
