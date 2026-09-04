<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nik',
        'nomor_anggota',
        'nama_usaha',
        'jenis_usaha',
        'bentuk_usaha',
        'lokasi_pasar',
        'blok_nomor',
        'no_hp',
        'email',
        'alamat_domisili',
        'foto',
        'foto_usaha',
        'terdaftar_sejak',
        'status',
        'catatan',
    ];

    protected $casts = [
        'terdaftar_sejak' => 'date',
    ];

    public function getFotoUrlAttribute(): string
    {
        if ($this->foto && file_exists(public_path($this->foto))) {
            return asset($this->foto);
        }
        if ($this->foto && file_exists(storage_path('app/public/'.$this->foto))) {
            return asset('storage/'.$this->foto);
        }

        return asset('assets/images/default-avatar-gray.png');
    }

    public function getFotoUsahaUrlAttribute(): string
    {
        if ($this->foto_usaha && file_exists(public_path($this->foto_usaha))) {
            return asset($this->foto_usaha);
        }
        if ($this->foto_usaha && file_exists(storage_path('app/public/'.$this->foto_usaha))) {
            return asset('storage/'.$this->foto_usaha);
        }

        return asset('assets/images/appsi-logo.png');
    }
}
