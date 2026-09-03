<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationStructure extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'jabatan',
        'divisi',
        'urutan',
        'periode',
        'foto',
        'no_hp',
        'email',
    ];

    public function getFotoUrlAttribute(): string
    {
        if ($this->foto && file_exists(public_path($this->foto))) {
            return asset($this->foto);
        }
        if ($this->foto && file_exists(storage_path('app/public/' . $this->foto))) {
            return asset('storage/' . $this->foto);
        }
        return asset('assets/images/default-avatar-gray.png');
    }
}
