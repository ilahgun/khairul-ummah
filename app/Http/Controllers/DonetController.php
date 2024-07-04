<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donatur;
use App\Models\Donasi;
use App\Models\Metode_pembayaran;
use Illuminate\Support\Facades\DB;

class DonetController extends Controller
{
    public function index()
    {
        $ar_jml = [10000, 25000, 50000, 100000, 1000000];
        $ar_metode_pembayaran = Metode_pembayaran::all();
        return view('landingpage.donasi', compact('ar_metode_pembayaran', 'ar_jml'));
    }

    public function store(Request $request)
    {
        // $donet = $request->all();
        // dd($donet);
        $donet = $request->validate(
            [
                'nama' => 'required|max:45',
                'no_hp' => 'required',
                'keterangan' => 'required|string|max:150',
                'jml_donasi' => 'required',
                'bukti_transfer' => 'required|image|mimes:jpg,jpeg,png,gift,svg|max:2048',
                'metode_pembayaran_id' => 'required',
            ],

            [
                'nama.required' => 'Nama Wajib diisi',
                'nama.max' => 'Jumlah katakter maksimal 45',
                'no_hp.required' => 'No Handphone Wajib diisi',
                'keterangan.required' => 'Keterangan Wajib diisi',
                'tgl_donasi.required' => 'Tanggal Donasi Wajib diisi',
                'jml_donasi.required' => 'Jumlah Donasi Wajib diisi',
                'bukti_transfer.mimes' => 'Bukti Transfer harus berupa jpg, png, girf, svg',
                'bukti_transfer.max' => 'Ukuran gambar maksimal 2048 KB',
                'bukti_transfer.required' => 'Wajib menyertakan bukti transfer',
                'donatur_id.required' => 'Kategori Kegiatan Wajib diisi',
                'donatur_id.integer' => 'Donatur Wajib diisi sesuai dengan yang tersedia di dalam pilihan',
                'metode_pembayaran_id.required' => 'Metode Pembayaran Wajib diisi',
            ]
        );



        $donatur = new Donatur;
        $donatur->nama = $donet['nama'];
        $donatur->no_hp = $donet['no_hp'];
        $donatur->save();

        //apakah ingin upload bukti transfer
        if (!empty($request->bukti_transfer)) {
            //$fileName = $request->bukti_transfer->getClientOriginal
            $fileName = 'bukti_transfer-' . $donatur->nama . '-' . now()->format('Y-m-d His') . '.' . $request->bukti_transfer->extension();
            //Ini digunakan untuk meletakkan fotonya di mana
            $request->bukti_transfer->move(public_path('admin/images/bukti_transfer'), $fileName);
        } else {
            $fileName = '';
        }

        DB::table('donasi')->insert(
            [
                'keterangan' => $request->keterangan,
                'tgl_donasi' => now(),
                'jml_donasi' => $request->jml_donasi,
                'bukti_transfer' => $fileName,
                'donatur_id' => $donatur->id,
                'metode_pembayaran_id' => $request->metode_pembayaran_id,
                'created_at' => now(),
            ]
        );

        // $donasi = new Donasi;
        // $donasi->keterangan = $donet['keterangan'];
        // $donasi->tgl_donasi = now();
        // $donasi->jml_donasi = $donet['jml_donasi'];
        // $donasi->bukti_transfer = $fileName;
        // $donasi->donatur_id = $donatur->id;
        // $donasi->metode_pembayaran_id = $donet['metode_pembayaran_id'];
        // $donasi->save();

        return redirect()->back()
            ->with('success', 'Terimakasih telah melakukan donasi');
    }
}
