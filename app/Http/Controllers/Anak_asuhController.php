<?php

namespace App\Http\Controllers;

use App\Models\Anak_asuh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Anak_asuhExport;
use RealRashid\SweetAlert\Facades\Alert;

class Anak_asuhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilkan seluruh data
        $anak_asuh = Anak_asuh::orderBy('id', 'DESC')->paginate(10);
        return view('anak_asuh.index', compact('anak_asuh'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ar_gender = ['Laki-Laki', 'Perempuan'];
        //arahkan ke form input data
        return view('anak_asuh.form', compact('ar_gender'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //proses input anak asuh
        $request->validate(
            [
                'nama' => 'required|max:45',
                'tmp_lahir' => 'required',
                'tgl_lahir' => 'required',
                'gender' => 'required',
                'pendidikan' => 'required',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            ],
            [
                'nama.required' => 'Nama Wajib diisi',
                'nama.max' => 'Karakter maksimal 45',
                'tmp_lahir.required' => 'Tempat Lahir Wajib diisi',
                'tgl_lahir.required' => 'Tanggal Lahir Wajib diisi',
                'gender.required' => 'Jenis Kelamin Wajib diisi',
                'pendidikan.required' => 'Pendidikan Wajib diisi',
                'foto.mimes' => 'Foto harus berupa jpg, png, girf, svg',
                'foto.max' => 'Ukuran foto maksimal 2048 KB',

            ]
        );
        //------------apakah user  ingin upload foto-----------
        if (!empty($request->foto)) {
            $fileName = 'foto-' . $request->nama . '.' . $request->foto->extension();
            //$fileName = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('admin/images'), $fileName);
        } else {
            $fileName = '';
        }
        //lakukan insert data dari request form
        DB::table('anak_asuh')->insert(
            [
                'nama' => $request->nama,
                'tmp_lahir' => $request->tmp_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'gender' => $request->gender,
                'pendidikan' => $request->pendidikan,
                'foto' => $fileName,
                'created_at' => now(),
            ]
        );

        return redirect()->route('anak_asuh.index')
            ->with('success', 'Data Anak Asuh Baru Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Anak_asuh::find($id);
        return view('anak_asuh.detail', compact('row'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Anak_asuh::find($id);
        return view('anak_asuh.form_edit', compact('row'));
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
        //proses input anak asuh
        $request->validate([
            'nama' => 'required|max:45',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'gender' => 'required',
            'pendidikan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);
        //------------foto lama apabila user ingin ganti foto-----------
        $foto = DB::table('anak_asuh')->select('foto')->where('id', $id)->get();
        foreach ($foto as $f) {
            $namaFileFotoLama = $f->foto;
        }
        //------------apakah user ingin ganti foto lama-----------
        $row = Anak_asuh::find($id);
        if (!empty($request->foto)) {
            //jika ada foto lama, hapus foto lamanya terlebih dahulu
            if (!empty($row->foto)) unlink(public_path() . '/admin/images/' . '/' . $row->foto);
            //proses foto lama ganti foto baru
            $fileName = 'foto-' . $request->nama . '.' . $request->foto->extension();
            //$fileName = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('admin/images'), $fileName);
        }
        //------------tidak berniat ganti ganti foto lama-----------
        else {
            $fileName = $namaFileFotoLama;
        }
        //lakukan update data dari request form edit
        DB::table('anak_asuh')->where('id', $id)->update(
            [
                //'nip'=>$request->nip,
                'nama' => $request->nama,
                'tmp_lahir' => $request->tmp_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'gender' => $request->gender,
                'pendidikan' => $request->pendidikan,
                'foto' => $fileName,
                'updated_at' => now(),
            ]
        );

        return redirect('/anak_asuh' . '/' . $id)
            ->with('success', 'Data Anak Asuh Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //sebelum hapus data, hapus terlebih dahulu fisik file fotonya jika ada
        $row = Anak_asuh::find($id);
        if (!empty($row->foto)) unlink(public_path() . '/admin/images/' . '/' . $row->foto);
        //setelah itu baru hapus data anak asuh
        Anak_asuh::where('id', $id)->delete();
        return redirect()->route('anak_asuh.index')
            ->with('success', 'Data Anak Asuh Berhasil Dihapus');
    }

    public function anak_asuhPDF()
    {
        // $data = Pegawai::all();
        $anak_asuh = Anak_asuh::orderBy('id', 'DESC')->get();
        $pdf = PDF::loadView('anak_asuh.anak_asuhPDF', ['anak_asuh' => $anak_asuh]);
        return $pdf->download('data_anakAsuh.pdf');
    }

    public function anak_asuhExcel()
    {
        return Excel::download(new Anak_asuhExport, 'data_anak.xlsx');
    }

    public function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->cari;

        // mengambil data dari table pegawai sesuai pencarian data
        $anak_asuh = DB::table('anak_asuh')
            ->where('nama', 'like', "%" . $cari . "%")
            ->paginate();
        // mengirim data pegawai ke view index
        return view('anak_asuh.index', compact('anak_asuh'));
    }
}
