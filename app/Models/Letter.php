<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Letter extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'nomor_surat',
        'tanggal',
        'jenis_surat',
        'tujuan',
        'keperluan',
        'perihal',
        'tempat_tujuan',
        'nama_pejabat',
        'jabatan_pejabat',
        'alamat_tujuan',
        'lokasi',
        'tanggal_mulai',
        'tanggal_selesai',
        'lampiran',
        'tembusan',
        'nama_penandatangan',
        'jabatan_penandatangan',
        'nama_sekretaris',
        'jabatan_sekretaris',
        'isi_surat',
        'hash_keabsahan',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($letter) {
            if (empty($letter->uuid)) {
                $letter->uuid = (string) Str::uuid();
            }
            if (empty($letter->hash_keabsahan)) {
                $letter->hash_keabsahan = strtoupper(substr(hash('sha256', ($letter->nomor_surat ?? '') . time() . Str::random(10)), 0, 16));
            }
        });
    }

    public static function generateNomorSurat(string $jenis = 'SURAT BIASA'): string
    {
        $romawi = ['', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        $bulanRomawi = $romawi[(int) date('n')];
        $tahun = date('Y');

        $count = static::whereYear('tanggal', $tahun)->count() + 1;
        $nomorUrut = str_pad($count, 3, '0', STR_PAD_LEFT);

        return "{$nomorUrut}/DPD-APPSI/BA/{$bulanRomawi}/{$tahun}";
    }

    public function getVerificationUrlAttribute(): string
    {
        return url('/surat/verifikasi/' . ($this->hash_keabsahan ?? $this->id));
    }
}
