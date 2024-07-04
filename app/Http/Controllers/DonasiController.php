<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
//ini extension data koneksinya
use App\Models\Donasi;
use App\Models\Donatur;
use App\Exports\DonasiExport;
use App\Models\Metode_pembayaran;
// //ini yang vendor excellnya
use Maatwebsite\Excel\Facades\Excel;
//ini bagian untuk sweetaler
use RealRashid\SweetAlert\Facades\Alert;

class DonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilkan seluruh data
        $donasi = Donasi::orderBy('id', 'DESC')->paginate(10);
        return view('donasi.index', compact('donasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //arahkan ke form input data
        $ar_donatur = Donatur::all();
        $ar_metode_pembayaran = Metode_pembayaran::all();
        return view('donasi.form', compact('ar_donatur', 'ar_metode_pembayaran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'keterangan' => 'required|string|max:150',
                'tgl_donasi' => 'required',
                'jml_donasi' => 'required',
                'bukti_transfer' => 'nullable|image|mimes:jpg,jpeg,png,gift,svg|max:2048',
                'donatur_id' => 'required|integer:45',
                'metode_pembayaran_id' => 'required',
            ],

            [
                'keterangan.required' => 'Keterangan Wajib diisi',
                'tgl_donasi.required' => 'Tanggal Donasi Wajib diisi',
                'jml_donasi.required' => 'Jumlah Donasi Wajib diisi',
                'bukti_transfer.mimes' => 'Bukti Transfer harus berupa jpg, png, girf, svg',
                'bukti_transfer.max' => 'Ukuran gambar maksimal 2048 KB',
                'donatur_id.required' => 'Kategori Kegiatan Wajib diisi',
                'donatur_id.integer' => 'Donatur Wajib diisi sesuai dengan yang tersedia di dalam pilihan',
                'metode_pembayaran_id.required' => 'Metode Pembayaran Wajib diisi',
            ]
        );

        //apakah ingin upload bukti transfer
        if (!empty($request->bukti_transfer)) {
            //$fileName = $request->bukti_transfer->getClientOriginal
            $fileName = 'bukti_transfer-' . $request->tgl_donasi . '.' . $request->bukti_transfer->extension();
            //Ini digunakan untuk meletakkan fotonya di mana
            $request->bukti_transfer->move(public_path('admin/images/bukti_transfer'), $fileName);
        } else {
            $fileName = '';
        }

        DB::table('donasi')->insert(
            [
                'keterangan' => $request->keterangan,
                'tgl_donasi' => $request->tgl_donasi,
                'jml_donasi' => $request->jml_donasi,
                'bukti_transfer' => $fileName,
                'donatur_id' => $request->donatur_id,
                'metode_pembayaran_id' => $request->metode_pembayaran_id,
                'created_at' => now(),
            ]
        );
        // Donasi::create($request->all());


        return redirect()->route('donasi.index')
            ->with('success', 'donasi Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ar_donatur = Donatur::all();
        $ar_metode_pembayaran = Metode_pembayaran::all();
        $row = Donasi::find($id);
        return view('donasi.form_edit', compact('ar_donatur', 'ar_metode_pembayaran', 'row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required',
            'tgl_donasi' => 'required',
            'jml_donasi' => 'required',
            'bukti_transfer' => 'nullable|image|mimes:jpg,jpeg,png,gift,svg|max:2048',
            'donatur_id' => 'required',
            'metode_pembayaran_id' => 'required',

        ]);

        //apakah ingin upload bukti transfer
        if (!empty($request->bukti_transfer)) {
            //$fileName = $request->bukti_transfer->getClientOriginal
            $fileName = 'bukti_transfer-' . $request->donatur_id->nama . '-' . now()->format('Y-m-d His') . '.' . $request->bukti_transfer->extension();
            //Ini digunakan untuk meletakkan fotonya di mana
            $request->bukti_transfer->move(public_path('admin/images/bukti_transfer'), $fileName);
        } else {
            $fileName = '';
        }

        DB::table('donasi')->where('id', $id)->update(
            [
                'keterangan' => $request->keterangan,
                'tgl_donasi' => $request->tgl_donasi,
                'jml_donasi' => $request->jml_donasi,
                'bukti_transfer' => $request->bukti_transfer,
                'donatur_id' => $request->donatur_id,
                'metode_pembayaran_id' => $request->metode_pembayaran_id,
                'updated_at' => now(),

            ]
        );

        return redirect()->route('donasi.index')
            ->with('success', 'donatur Berhasil Disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Donasi::find($id);
        if (!empty($row->bukti_transfer)) unlink(public_path() . '/admin/images/bukti_transfer/' . '/' . $row->bukti_transfer);
        Donasi::where('id', $id)->delete();
        return redirect()->route('donasi.index')
            ->with('success', 'Data Kegiatan Berhasil dihapus');
    }

    public function donasiPDF()
    {
        $donasi = Donasi::all();
        $pdf = PDF::loadView('donasi.donasiPDF', ['donasi' => $donasi]);
        return $pdf->download('data_donasi.pdf');
    }

    public function donasiExcel()
    {
        return Excel::download(new DonasiExport, 'data_donasi.xlsx');
    }

    public function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->cari;

        // mengambil data dari table pegawai sesuai pencarian data
        $kegiatan = DB::table('donasi')
            ->where('keterangan', 'like', "%" . $cari . "%")
            ->paginate();
        // mengirim data pegawai ke view index
        return view('donasi.index', compact('donasi'));
    }
}
