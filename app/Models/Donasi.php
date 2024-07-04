<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;
    //mapping ke tabel
    protected $table = 'donasi';
    //mapping ke kolom/fieldnya
    protected $fillable = ['keterangan', 'tgl_donasi', 'jml_donasi', 'bukti_transfer', 'donatur_id', 'metode_pembayaran_id'];
    //tabel relasi merujuk/merefer ke tabel master (donatur)
    public function donatur()
    {
        return $this->belongsTo(Donatur::class);
    }
    public function metode_pembayaran()
    {
        return $this->belongsTo(Metode_pembayaran::class);
    }
}
