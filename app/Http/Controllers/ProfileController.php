<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.profile');
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
        return view('user.profile');
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
        Validator::extend('without_spaces', function ($attr, $value) {
            return preg_match('/^\S*$/u', $value);
        });

        $request->validate(
            [
                'nama' => 'required|min:2|max:45',
                'no_hp' => ['required', 'without_spaces', 'regex:/^(^\+62|62|^08)(\d{3,4}-?){2}\d{3,4}$/', 'min:9', 'max:20'],
                'email' => 'required|email|max:45',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            ],
            // Custom Error Code
            [
                'nama.required' => 'Nama belakang wajib di isi',
                'nama.min' => 'Nama belakang terlalu pendek',
                'nama.max' => 'Nama belakang terlalu panjang, maksimal 45 karakter',
                'no_hp.required' => 'Nomor Telepon wajib di isi',
                'no_hp.without_spaces' => 'Nomor Telepon terdapat spasi',
                'no_hp.regex' => 'Nomor Telepon tidak sesuai format',
                'no_hp.unique' => 'Nomor Telepon telah digunakan',
                'no_hp.min' => 'Nomor Telepon terlalu Pendek',
                'no_hp.max' => 'Nomor Telepon terlalu Panjang',
                'email.required' => 'Email wajib di isi',
                'email.email' => 'Harus berupa format email',
                'email.unique' => 'Email sudah terdaftar',
                'email.max' => 'Email terlalu panjang, maksimal 45 karakter',
                'foto.image' => 'Harus sebuah image dengan format jpg,jpeg,png',
                'foto.mimes' => 'Hanya memperbolehkan format jpg,jpeg,png',
                'foto.max' => 'Size terlalu besar, maksimal size 4MB',
            ]
        );

        $foto = DB::table('users')->select('foto')->where('id', $id)->get();
        foreach ($foto as $f) {
            $namaFileFotoLama = $f->foto;
        }

        $data = User::find($id);

        if (!empty($request->foto)) {

            if (!empty($data->foto)) unlink(public_path() . '/admin/images/' . $data->foto);

            $fileName = 'pict-' . $request->nama . '.' . $request->foto->extension();
            $request->foto->move(public_path('admin/images'), $fileName);
        } else {
            $fileName = $namaFileFotoLama;
        }

        //lakukan insert data dari request form
        DB::table('users')->where('id', $id)->update(
            [
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'foto' => $fileName,
                'updated_at' => now(),
            ]
        );

        return redirect('profile')->with('success', 'Update data berhasil');
    }

    public function updatePassword(Request $request)
    {
        $request->validate(
            [
                'password' => 'required|string|min:8|confirmed',
            ],
            // Custom Error Code
            [
                'password.required' => 'Password wajib di isi',
                'password.min' => 'Password terlalu pendek, minimal 8 karakter',
                'password.confirmed' => 'Password tidak sama',
            ]
        );

        $user = User::find(Auth::id());
        $user->password = Hash::make($request->password);
        $user->save();
        $request->session()->regenerate();

        return back()->with('success', 'Password berhasil di ubah');
    }
}
