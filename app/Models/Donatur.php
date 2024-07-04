<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    use HasFactory;
    //mapping ke tabel
    protected $table = 'donatur';
    //mapping ke kolom/fieldnya
    protected $fillable = ['nama', 'no_hp'];
    //relasi one to many ke tabel donasi
    public function donasi()
    {
        return $this->hasMany(Donasi::class);
    }
}
