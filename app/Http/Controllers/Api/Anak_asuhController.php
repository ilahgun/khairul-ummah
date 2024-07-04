<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anak_asuh;
use App\Http\Resources\Anak_asuhResource;
// use Dotenv\Validator;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Anak_asuhController extends Controller
{
    public function index()
    {
        //menampilkan seluruh data
        $anak_asuh = Anak_asuh::all();
        return new Anak_asuhResource(true, 'Data Anak Asuh', $anak_asuh);
    }

    public function show($id)
    {
        //menampilkan detail data
        $anak_asuh = Anak_asuh::whereId($id)->first();
        if ($anak_asuh) {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Detail Anak Asuh',
                    'data' => $anak_asuh,
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Detail Anak Asuh Tidak ditemukan',
                ],
                404
            );
        }

        // return new Anak_asuhResource(true, 'Detail Data Anak Asuh', $anak_asuh);
    }

    public function store(Request $request)
    {
        //proses input anak asuh
        $validator = Validator::make(
            $request->all(),
            [
                'nama' => 'required|max:45',
                'tmp_lahir' => 'required',
                'tgl_lahir' => 'required',
                'gender' => 'required',
                'pendidikan' => 'required',
                // 'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $anak_asuh = Anak_asuh::create([
            'nama' => $request->nama,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'gender' => $request->gender,
            'pendidikan' => $request->pendidikan,
        ]);

        return new Anak_asuhResource(true, 'Data Anak Asuh Berhasil diinput', $anak_asuh);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama' => 'required|max:45',
                'tmp_lahir' => 'required',
                'tgl_lahir' => 'required',
                'gender' => 'required',
                'pendidikan' => 'required',
                // 'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $anak_asuh = Anak_asuh::whereId($id)->update([
            'nama' => $request->nama,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'gender' => $request->gender,
            'pendidikan' => $request->pendidikan,
        ]);

        return new Anak_asuhResource(true, 'Data Anak Asuh Berhasil diubah', $anak_asuh);
    }

    public function destroy($id)
    {
        $anak_asuh = Anak_asuh::whereId($id)->first();
        $anak_asuh->delete();

        return new Anak_asuhResource(true, 'Data Anak Asuh Berhasil dihapus', $anak_asuh);
    }
}
