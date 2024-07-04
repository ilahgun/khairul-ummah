<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\UserExport;
//ini yang vendor excellnya
use Maatwebsite\Excel\Facades\Excel;
//ini digunakan untuk alert
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dignakan untuk menampilkan data secara keseluruhan
        $user = User::orderBy('id', 'DESC')->paginate(10);
        return view('user.index', compact('user'));
        //di compact=> dengan membawa array divisi
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //arahkan ke form input data
        return view('user.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //proses form input user
        $request->validate(
            [
                'nama' => 'required|max:20',
                'no_hp' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required',
                'status' => 'required',
                'role' => 'required',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png,gift,svg|max:2048',
            ],

            [
                'nama.required' => 'Nama Wajib diisi',
                'nama.max' => 'Karakter maksimal 20',
                'no_hp.required' => 'No. Handphone Wajib diisi',
                'email.required' => 'Email Wajib diisi',
                'email.unique' => 'Email ini sudah didaftarkan',
                'password.required' => 'Password Wajib diinputkan',
                'status.required' => 'Status Wajib diinputkan',
                'role.required' => 'Role Wajib diinputkan',
                'foto.mimes' => 'Foto harus berupa jpg, png, girf, svg',
                'foto.max' => 'Ukuran foto maksimal 2048 KB',

            ]
        );

        //apakah user inin upload foto
        if (!empty($request->foto)) {
            //$fileName = $request->foto->getClientOriginal
            $fileName = 'foto-' . $request->nama . '.' . $request->foto->extension();
            //Ini figunakan untuk meletakkan fotonya di mana
            $request->foto->move(public_path('admin/images'), $fileName);
        } else {
            $fileName = '';
        }



        //lakukan insert data dari request form
        DB::table('users')->insert(
            [
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'password' => $request->password,
                'status' => $request->status,
                'role' => $request->role,
                'foto' => $fileName,
                'created_at' => now(),
            ]
        );

        return redirect()->route('user.index')
            ->with('success', 'User Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = User::find($id);
        return view('user.detail', compact('row'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = User::find($id);
        return view('user.form_edit', compact('row'));
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
        //proses form input user
        $request->validate([
            'nama' => 'required|max:20',
            'no_hp' => 'required',
            // 'email' => 'required|unique:users',
            'password' => 'required',
            'status' => 'required',
            'role' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gift,svg|max:2048',
        ]);

        //apakah user inin upload foto
        if (!empty($request->foto)) {
            //$fileName = $request->foto->getClientOriginal
            $fileName = 'foto-' . $request->nama . '.' . $request->foto->extension();
            //Ini figunakan untuk meletakkan fotonya di mana
            $request->foto->move(public_path('admin/images'), $fileName);
        } else {
            $fileName = '';
        }

        //lakukan insert data dari request form
        DB::table('users')->where('id', $id)->update(
            [
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                // 'email' => $request->email,
                'password' => $request->password,
                'status' => $request->status,
                'role' => $request->role,
                'foto' => $fileName,
                'updated_at' => now(),
            ]
        );

        return redirect()->route('user.index')
            ->with('success', 'User Berhasil Disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = User::find($id);
        if (!empty($row->foto)) unlink(public_path() . '/admin/images/' . '/' . $row->foto);
        $row = User::find($id);
        User::where('id', $id)->delete();
        return redirect()->route('user.index')
            ->with('success', 'User Berhasil dihapus');
    }

    public function userPDF()
    {
        $user = User::all();
        $pdf = PDF::loadView('user.userPDF', ['user' => $user]);
        return $pdf->download('data_user.pdf');
    }

    public function userExcel()
    {
        return Excel::download(new UserExport, 'data_user.xlsx');
    }

    public function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->cari;

        // mengambil data dari table pegawai sesuai pencarian data
        $user = DB::table('users')
            ->where('nama', 'like', "%" . $cari . "%")
            ->paginate();
        // mengirim data pegawai ke view index
        return view('user.index', compact('user'));
    }
}
