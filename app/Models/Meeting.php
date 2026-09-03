<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_rapat',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'tempat',
        'pimpinan_rapat',
        'notulis',
        'agenda',
        'pembahasan',
        'keputusan',
        'jumlah_hadir',
        'daftar_hadir',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
