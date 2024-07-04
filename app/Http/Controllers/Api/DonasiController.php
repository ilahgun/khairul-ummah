<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\Donatur;
use App\Http\Resources\DonasiResource;
use DB;
use Illuminate\Support\Facades\Validator;

class DonasiController extends Controller
{
    public function index()
    {
        $donasi = Donasi::all();
        return response()->json(
           [
               'success'=> true,
               'message'=>'Data donasi',
               'data'=>$donasi,
           ],200 //200 kalau pesan atau api yang ditawarkan telah sukses
       );
       return new DonasiController(true, 'Data Donasi', $donasi);
    }

    public function show($id)
    {
         //Menampilkan data seorang donasi        
        $donasi = Donasi::find($id);
        if($donasi)
         {
             return response()->json(
                 [
                     'success'=> true,
                     'message'=>'Detail donasi',
                     'data'=>$donasi,
                    ],200 //200 kalau pesan atau api yang ditawarkan telah sukses
                );
        }

        else{
            return response()->json(
                [
                    'success'=> false,
                    'message'=>'Detail donasi tidak ditemukan',
                    'data'=>$donasi,
                   ],404 //404 kalau pesan atau api yang ditawarkan tidak ditemukan
               );
        }

        return new DonasiController(true, 'Detail Data donasi', $donasi);
    }

    public function store(Request $request)
    {
        //proses input form
        $validator = Validator::make($request->all(),[
            'keterangan' => 'required|string|max:150',
            'tgl_donasi' => 'required',
            'jml_donasi' => 'required',
            'donatur_id' => 'required|integer:45',

        ]);

        //cek error atau tidak error
       if($validator->fails()){
        return response()->json($validator->errors(), 422);
       }

       //proses menyimpan data yang diinput
       $donasi = Donasi::create([
        'keterangan' => $request->keterangan,
        'tgl_donasi' => $request->tgl_donasi,
        'jml_donasi' => $request->jml_donasi,
        'donatur_id' => $request->donatur_id,
       ]);
       return new DonasiController(true, 'Data donasi berhasil diinput', $donasi);
    }

    public function update(Request $request, $id)
    {
         //proses form input pegawai
         $validator = Validator::make($request->all(),[
            'keterangan' => 'required|string|max:150',
            'tgl_donasi' => 'required',
            'jml_donasi' => 'required',
            'donatur_id' => 'required|integer:45',
        ]);
       //cek error atau tidak error
       if($validator->fails()){
        return response()->json($validator->errors(), 422);
       }

       //proses menyimpan data yang diinput
       $donasi = Donasi::whereId($id)->update([
        'keterangan' => $request->keterangan,
        'tgl_donasi' => $request->tgl_donasi,
        'jml_donasi' => $request->jml_donasi,
        'donatur_id' => $request->donatur_id,
       ]);
       return new DonasiController(true, 'Data donasi berhasil diubah', $donasi);
    }

    public function destroy($id)
    {
        //ini untuk menghapus
        $donasi = Donasi::whereId($id)->first();
        $donasi ->delete();
        return new DonasiController(true, 'Data donasi berhasil dihapus', $donasi);
    }


}
