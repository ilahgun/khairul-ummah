<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\DonaturResource;
use App\Models\Donatur;
use DB;
use Illuminate\Support\Facades\Validator;

class DonaturController extends Controller
{
    public function index()
    {
         //digunakan untuk menampilkan data secara keseluruhan
         $donatur = Donatur::all();
         return response()->json(
            [
                'success'=> true,
                'message'=>'Data Donatur',
                'data'=>$donatur,
            ],200 //200 kalau pesan atau api yang ditawarkan telah sukses
        );
        return new DonaturResource(true, 'Data Donatur', $donatur);
        
    }

    public function show($id)
    {
         //Menampilkan data seorang donatur        
        $donatur = Donatur::find($id);
        if($donatur)
         {
             return response()->json(
                 [
                     'success'=> true,
                     'message'=>'Detail Donatur',
                     'data'=>$donatur,
                    ],200 //200 kalau pesan atau api yang ditawarkan telah sukses
                );
        }

        else{
            return response()->json(
                [
                    'success'=> false,
                    'message'=>'Detail Donatur tidak ditemukan',
                    'data'=>$donatur,
                   ],404 //404 kalau pesan atau api yang ditawarkan tidak ditemukan
               );
        }

        return new DonaturResource(true, 'Detail Data donatur', $donatur);
    }

    public function store(Request $request)
    {
        //proses input form
        $validator = Validator::make($request->all(),[
            'nama' => 'required|unique:donatur|max:45',
            'no_hp' => 'required',

        ]);

        //cek error atau tidak error
       if($validator->fails()){
        return response()->json($validator->errors(), 422);
       }
       $donatur = Donatur::create([
        'nama' => $request->nama,
        'no_hp' => $request->no_hp,
       ]);
       return new DonaturResource(true, 'Data donatur berhasil diinput', $donatur);
    }

    public function update(Request $request, $id)
    {
         //proses form input pegawai
         $validator = Validator::make($request->all(),[
            'nama' => 'required|unique:donatur|max:45',
            'no_hp' => 'required',
        ]);
       //cek error atau tidak error
       if($validator->fails()){
        return response()->json($validator->errors(), 422);
       }

       //proses menyimpan data yang diinput
       $donatur = Donatur::whereId($id)->update([
        'nama' => $request->nama,
        'no_hp' => $request->no_hp,
       ]);
       return new DonaturResource(true, 'Data Donatur berhasil diubah', $donatur);
    }

    public function destroy($id)
    {
        //ini untuk menghapus
        $donatur = Donatur::whereId($id)->first();
        $donatur ->delete();
        return new DonaturResource(true, 'Data donatur berhasil dihapus', $donatur);
    }


}
