<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metode_pembayaran extends Model
{
    use HasFactory;
    //mapping ke tabel
    protected $table = 'metode_pembayaran';
    //mapping ke kolom/fieldnya
    protected $fillable = ['nama', 'nomor'];
    //relasi one to many ke tabel donasi
    public function metode_pembayaran()
    {
        return $this->hasMany(Donasi::class);
    }
}
