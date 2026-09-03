<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'foto',
        'kategori',
        'tanggal_kegiatan',
    ];

    protected $casts = [
        'tanggal_kegiatan' => 'date',
    ];

    public function getFotoUrlAttribute(): string
    {
        if ($this->foto && file_exists(public_path($this->foto))) {
            return asset($this->foto);
        }
        if ($this->foto && file_exists(storage_path('app/public/' . $this->foto))) {
            return asset('storage/' . $this->foto);
        }
        return asset('assets/images/appsi-logo.png');
    }
}
