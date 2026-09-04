<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadDocument extends Model
{
    protected $fillable = [
        'judul',
        'kategori',
        'deskripsi',
        'file_path',
        'nama_file',
        'tipe_file',
        'ukuran_file',
        'jumlah_unduhan',
        'is_aktif',
        'urutan',
    ];

    protected $casts = [
        'is_aktif' => 'boolean',
        'jumlah_unduhan' => 'integer',
        'urutan' => 'integer',
    ];

    /**
     * URL Download Publik
     */
    public function getDownloadUrlAttribute(): string
    {
        return route('downloads.file', $this->id);
    }
}
