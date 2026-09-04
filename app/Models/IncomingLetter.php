<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingLetter extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_surat',
        'tanggal_surat',
        'tanggal_terima',
        'pengirim',
        'perihal',
        'keterangan',
        'disposisi',
        'status',
        'file_lampiran',
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
        'tanggal_terima' => 'date',
    ];

    public function getFileLampiranUrlAttribute(): ?string
    {
        if ($this->file_lampiran && file_exists(public_path($this->file_lampiran))) {
            return asset($this->file_lampiran);
        }
        if ($this->file_lampiran && file_exists(storage_path('app/public/'.$this->file_lampiran))) {
            return asset('storage/'.$this->file_lampiran);
        }

        return null;
    }
}
