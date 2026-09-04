<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'penulis',
        'ringkasan',
        'konten',
        'gambar',
        'status',
        'views_count',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function getGambarUrlAttribute(): string
    {
        if ($this->gambar) {
            $webp = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $this->gambar);
            if ($webp !== $this->gambar) {
                if (file_exists(public_path($webp))) {
                    return asset($webp);
                }
                if (file_exists(storage_path('app/public/'.$webp))) {
                    return asset('storage/'.$webp);
                }
            }

            if (file_exists(public_path($this->gambar))) {
                return asset($this->gambar);
            }
            if (file_exists(storage_path('app/public/'.$this->gambar))) {
                return asset('storage/'.$this->gambar);
            }
        }

        return asset('assets/images/appsi-logo.png');
    }
}
