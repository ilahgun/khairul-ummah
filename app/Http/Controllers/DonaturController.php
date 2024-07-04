<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donatur;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
//ini extension data koneksinya
use App\Exports\DonaturExport;
//ini yang vendor excellnya
use Maatwebsite\Excel\Facades\Excel;
//ini bagian untuk sweetaler
use RealRashid\SweetAlert\Facades\Alert;

//tutorial untuk pagination
// https: //www.malasngoding.com/

class DonaturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //digunakan untuk menampilkan data secara keseluruhan
        // $donatur = Donatur::orderBy('id', 'DESC')->get();
        $donatur = Donatur::orderBy('id', 'DESC')->paginate(10);
        return view('donatur.index', compact('donatur'));
        //di compact=> dengan membawa array divisi
    }

    public function apiDonatur()
    {
        //digunakan untuk menampilkan data secara keseluruhan
        $donatur = Donatur::all();
        return response()->json(
            [
                'success' => true,
                'message' => 'Data Donatur',
                'data' => $donatur,
            ],
            200 //200 kalau pesan atau api yang ditawarkan telah sukses
        );
    }

    public function apiDonaturDetail($id)
    {
        //Menampilkan data seorang pegawai        
        $donatur = Donatur::find($id);
        if ($donatur) {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Detail Donatur',
                    'data' => $donatur,
                ],
                200 //200 kalau pesan atau api yang ditawarkan telah sukses
            );
        } else {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Detail Donatur tidak ditemukan',
                    'data' => $donatur,
                ],
                404 //404 kalau pesan atau api yang ditawarkan tidak ditemukan
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('donatur.form');
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
                'nama' => 'required|unique:donatur|max:45',
                'no_hp' => 'required',
            ],

            [
                'nama.required' => 'Nama Wajib diisi',
                'nama.max' => 'Jumlah katakter maksimal 45',
                'no_hp.required' => 'No Handphone Wajib diisi',
            ]
        );

        Donatur::create($request->all());

        return redirect()->route('donatur.index')
            ->with('success', 'Donatur Berhasil Disimpan');
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
        $row = Donatur::find($id);
        return view('donatur.form_edit', compact('row'));
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
        //proses input donatur
        $request->validate([
            'nama' => 'required|max:45',
            'no_hp' => 'required',
        ]);

        DB::table('donatur')->where('id', $id)->update(
            [
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'updated_at' => now(),

            ]
        );

        return redirect()->route('donatur.index')
            ->with('success', 'Donatur Berhasil Disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Donatur::find($id);
        Donatur::where('id', $id)->delete();
        return redirect()->route('donatur.index')
            ->with('success', 'Data Donatur Berhasil dihapus');
    }

    public function donaturPDF()
    {
        $donatur = Donatur::all();
        $pdf = PDF::loadView('donatur.donaturPDF', ['donatur' => $donatur]);
        return $pdf->download('data_donatur.pdf');
    }

    public function donaturExcel()
    {
        return Excel::download(new DonaturExport, 'data_donatur.xlsx');
    }

    public function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->cari;

        // mengambil data dari table pegawai sesuai pencarian data
        $donatur = DB::table('donatur')
            ->where('nama', 'like', "%" . $cari . "%")
            ->paginate();
        // mengirim data pegawai ke view index
        return view('donatur.index', compact('donatur'));
    }
}
