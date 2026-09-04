<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nik',
        'no_hp',
        'email',
        'nama_usaha',
        'jenis_usaha',
        'bentuk_usaha',
        'lokasi_pasar',
        'blok_nomor',
        'alamat_domisili',
        'foto_ktp',
        'foto_usaha',
        'status',
        'catatan_admin',
    ];

    public function getFotoKtpUrlAttribute(): ?string
    {
        if ($this->foto_ktp && file_exists(public_path($this->foto_ktp))) {
            return asset($this->foto_ktp);
        }
        if ($this->foto_ktp && file_exists(storage_path('app/public/'.$this->foto_ktp))) {
            return asset('storage/'.$this->foto_ktp);
        }

        return null;
    }

    public function getFotoUsahaUrlAttribute(): ?string
    {
        if ($this->foto_usaha && file_exists(public_path($this->foto_usaha))) {
            return asset($this->foto_usaha);
        }
        if ($this->foto_usaha && file_exists(storage_path('app/public/'.$this->foto_usaha))) {
            return asset('storage/'.$this->foto_usaha);
        }

        return null;
    }
}
