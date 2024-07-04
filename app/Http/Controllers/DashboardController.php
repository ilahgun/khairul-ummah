<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Donasi;
use App\Models\Anak_asuh;
use App\Models\Donatur;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
        public function index()
        {
                $ar_donasi = DB::table('donasi')->select('tgl_donasi', 'jml_donasi')->get();
                $ar_tempatlahir = DB::table('anak_asuh')
                        ->selectRaw('tmp_lahir, count(tmp_lahir) as jumlah')
                        ->groupBy('tmp_lahir')
                        ->get();
                $ar_pendidikan = DB::table('anak_asuh')
                        ->selectRaw('pendidikan, count(pendidikan) as jumlah')
                        ->groupBy('pendidikan')
                        ->get();
                $ar_gender = DB::table('anak_asuh')
                        ->selectRaw('gender, count(gender) as jumlah')
                        ->groupBy('gender')
                        ->get();
                $row_total = DB::table('donasi')
                        ->selectRaw('sum(jml_donasi) as total_donasi')
                        ->first();
                $row_pengurus = User::count();
                $row_donatur = Donatur::count();
                $row_anakasuh = Anak_asuh::count();

                return view('dashboard.index', compact(
                        'ar_donasi',
                        'ar_gender',
                        'ar_pendidikan',
                        'ar_tempatlahir',
                        'row_pengurus',
                        'row_donatur',
                        'row_anakasuh',
                        'row_total'
                ));
        }
}
