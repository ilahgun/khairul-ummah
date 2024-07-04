<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Metode_pembayaran;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
//ini extension data koneksinya
use App\Exports\Metode_pembayaranExport;
//ini bagian untuk sweetaler
use RealRashid\SweetAlert\Facades\Alert;

class Metode_pembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilkan seluruh data
        $metode_pembayaran = Metode_pembayaran::orderBy('id', 'DESC')->paginate(10);
        return view('metode_pembayaran.index', compact('metode_pembayaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('metode_pembayaran.form');
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
                'icon' => 'required|image|mimes:jpg,jpeg,png,svg,ico|max:2048',
                'nama' => 'required|unique:metode_pembayaran|max:45',
                'nomor' => 'required|unique:metode_pembayaran|max:50',
            ],

            [
                'icon.required' => 'Icon Wajib diisi',
                'icon.image' => 'Icon Wajib format gambar',
                'icon.mimes' => 'Icon Wajib jpg/jpeg/png/svg/ico',
                'icon.max' => 'Size Terlalu Besar',
                'nama.required' => 'Nama Wajib diisi',
                'nama.max' => 'Jumlah katakter maksimal 45',
                'nomor.required' => 'Nomor Wajib diisi',
                'nomor.max' => 'Jumlah katakter maksimal 50',
            ]
        );

        // Metode_pembayaran::create($request->all());
        if (!empty($request->icon)) {
            //$fileName = $request->bukti_transfer->getClientOriginal
            $fileName = 'icon-' . $request->nama . '.' . $request->icon->extension();
            //Ini digunakan untuk meletakkan fotonya di mana
            $request->icon->move(public_path('admin/images/icon_pembayaran'), $fileName);
        } else {
            $fileName = '';
        }

        DB::table('metode_pembayaran')->insert(
            [
                'nama' => $request->nama,
                'nomor' => $request->nomor,
                'icon' => $fileName,
                'created_at' => now(),
            ]
        );

        return redirect()->route('metode_pembayaran.index')
            ->with('success', 'Metode Pembayaran Berhasil Disimpan');
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
        $row = Metode_pembayaran::find($id);
        return view('metode_pembayaran.form_edit', compact('row'));
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
        //proses input kategori_kegiatan
        $request->validate([
            'icon' => 'required|image|mimes:jpg,jpeg,png,svg,ico|max:2048',
            'nama' => 'required|max:45',
            'nomor' => 'required|max:50',
        ]);

        if (!empty($request->icon)) {
            //$fileName = $request->bukti_transfer->getClientOriginal
            $fileName = 'icon-' . $request->nama . '.' . $request->icon->extension();
            //Ini digunakan untuk meletakkan fotonya di mana
            $request->icon->move(public_path('admin/images/icon_pembayaran'), $fileName);
        } else {
            $fileName = '';
        }

        DB::table('metode_pembayaran')->where('id', $id)->update(
            [
                'nama' => $request->nama,
                'nomor' => $request->nomor,
                'icon' => $fileName,
                'updated_at' => now(),

            ]
        );

        return redirect()->route('metode_pembayaran.index')
            ->with('success', 'Metode Pembayaran Berhasil Disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Metode_pembayaran::find($id);
        if (!empty($row->icon)) unlink(public_path() . '/admin/images/icon_pembayaran/' . '/' . $row->icon);
        Metode_pembayaran::where('id', $id)->delete();
        return redirect()->route('metode_pembayaran.index')
            ->with('success', 'Data Metode Pembayaran Berhasil dihapus');
    }

    public function metode_pembayaranPDF()
    {
        $metode_pembayaran = Metode_pembayaran::all();
        $pdf = PDF::loadView('metode_pembayaran.metode_pembayaranPDF', ['metode_pembayaran' => $metode_pembayaran]);
        return $pdf->download('data_metode_pembayaran.pdf');
    }

    public function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->cari;

        // mengambil data dari table pegawai sesuai pencarian data
        $kategori_kegiatan = DB::table('metode_pembayaran')
            ->where('nama', 'like', "%" . $cari . "%")
            ->paginate();
        // mengirim data pegawai ke view index
        return view('metode_pembayaran.index', compact('metode_pembayaran'));
    }
}
