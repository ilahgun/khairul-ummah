<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anak_asuh extends Model
{
    use HasFactory;
    //mapping ke tabel
    protected $table = 'anak_asuh';
    //mapping ke kolom/fieldnya
    protected $fillable = ['nama', 'tmp_lahir', 'tgl_lahir', 'gender', 'pendidikan', 'foto'];
}
