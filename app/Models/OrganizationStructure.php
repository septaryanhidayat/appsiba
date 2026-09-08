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

    /**
     * Get photo URL with local asset, storage, and fallback handling.
     */
    public function getFotoUrlAttribute(): string
    {
        if ($this->foto) {
            if (str_starts_with($this->foto, 'http://') || str_starts_with($this->foto, 'https://')) {
                return $this->foto;
            }
            if (str_starts_with($this->foto, 'assets/')) {
                return asset($this->foto);
            }
            if (file_exists(public_path($this->foto))) {
                return asset($this->foto);
            }
            if (file_exists(public_path('storage/'.$this->foto))) {
                return asset('storage/'.$this->foto);
            }
            if (file_exists(storage_path('app/public/'.$this->foto))) {
                return asset('storage/'.$this->foto);
            }
        }

        return 'https://ui-avatars.com/api/?name='.urlencode($this->nama).'&background=047857&color=ffffff&size=200&bold=true';
    }

    /**
     * Dynamic Hierarchy Tree builder for APPSI Banyuasin based on official SK.
     *
     * @return array<string, mixed>
     */
    public static function getHierarchyTree(): array
    {
        $structures = static::orderBy('urutan', 'asc')->get();

        // 1. Dewan Penasehat
        $dewanPenasehat = $structures->filter(function ($s) {
            $j = strtoupper((string) $s->jabatan);
            $d = strtoupper((string) $s->divisi);

            return str_contains($j, 'PENASEHAT') || str_contains($d, 'PENASEHAT');
        })->values();

        // 2. Dewan Pembina
        $dewanPembina = $structures->filter(function ($s) {
            $j = strtoupper((string) $s->jabatan);
            $d = strtoupper((string) $s->divisi);

            return str_contains($j, 'PEMBINA') || str_contains($d, 'PEMBINA');
        })->values();

        $advisoryIds = $dewanPenasehat->pluck('id')->merge($dewanPembina->pluck('id'))->all();

        // 3. Pimpinan Harian: Ketua
        $ketua = $structures->first(function ($s) use ($advisoryIds) {
            if (in_array($s->id, $advisoryIds)) {
                return false;
            }
            $j = strtoupper(trim((string) $s->jabatan));

            return $j === 'KETUA' || $j === 'KETUA DPD' || $j === 'KETUA UMUM';
        }) ?? $structures->first(function ($s) use ($advisoryIds) {
            if (in_array($s->id, $advisoryIds)) {
                return false;
            }

            return str_starts_with(strtoupper(trim((string) $s->jabatan)), 'KETUA')
                && ! str_contains(strtoupper((string) $s->jabatan), 'BIDANG')
                && ! str_contains(strtoupper((string) $s->jabatan), 'KOMISARIAT');
        });

        // 4. Wakil Ketua
        $wakilKetuaList = $structures->filter(function ($s) use ($advisoryIds, $ketua) {
            if (in_array($s->id, $advisoryIds) || ($ketua && $s->id === $ketua->id)) {
                return false;
            }
            $j = strtoupper(trim((string) $s->jabatan));

            return str_starts_with($j, 'WAKIL KETUA') || $j === 'WAKIL KETUA';
        })->values();

        // 5. Sekretariat (Utama & Wakil)
        $sekretaris = $structures->first(function ($s) use ($advisoryIds) {
            if (in_array($s->id, $advisoryIds)) {
                return false;
            }
            $j = strtoupper(trim((string) $s->jabatan));

            return $j === 'SEKRETARIS' || $j === 'SEKRETARIS UMUM' || $j === 'SEKRETARIS DPD';
        });

        $wakilSekretaris = $structures->first(function ($s) use ($advisoryIds, $sekretaris) {
            if (in_array($s->id, $advisoryIds) || ($sekretaris && $s->id === $sekretaris->id)) {
                return false;
            }
            $j = strtoupper(trim((string) $s->jabatan));

            return str_starts_with($j, 'WAKIL SEKRETARIS') || str_starts_with($j, 'WAKIL SEKRETARIAT');
        });

        // 6. Kebendaharaan (Utama & Wakil)
        $bendahara = $structures->first(function ($s) use ($advisoryIds) {
            if (in_array($s->id, $advisoryIds)) {
                return false;
            }
            $j = strtoupper(trim((string) $s->jabatan));

            return $j === 'BENDAHARA' || $j === 'BENDAHARA UMUM' || $j === 'BENDAHARA DPD';
        });

        $wakilBendahara = $structures->first(function ($s) use ($advisoryIds, $bendahara) {
            if (in_array($s->id, $advisoryIds) || ($bendahara && $s->id === $bendahara->id)) {
                return false;
            }
            $j = strtoupper(trim((string) $s->jabatan));

            return str_starts_with($j, 'WAKIL BENDAHARA');
        });

        $coreIds = collect([
            $ketua?->id,
            $sekretaris?->id,
            $wakilSekretaris?->id,
            $bendahara?->id,
            $wakilBendahara?->id,
        ])->merge($wakilKetuaList->pluck('id'))->merge($advisoryIds)->filter()->all();

        // 7. 7 Bidang Kerja DPD APPSI Banyuasin (Sesuai SK Resmi)
        $bidangDefs = [
            'organisasi' => [
                'code' => 'I',
                'title' => 'Organisasi & OKK',
                'icon' => 'fa-sitemap',
                'color' => 'blue',
                'gradient' => 'from-blue-700 to-indigo-700',
                'border' => 'border-blue-500',
                'matches' => ['ORGANISASI', 'OKK'],
            ],
            'ekonomi' => [
                'code' => 'II',
                'title' => 'Ekonomi & Usaha',
                'icon' => 'fa-chart-line',
                'color' => 'emerald',
                'gradient' => 'from-emerald-700 to-teal-700',
                'border' => 'border-emerald-500',
                'matches' => ['EKONOMI', 'USAHA'],
            ],
            'pemberdayaan' => [
                'code' => 'III',
                'title' => 'Pemberdayaan Masyarakat',
                'icon' => 'fa-handshake-angle',
                'color' => 'amber',
                'gradient' => 'from-amber-600 to-yellow-600',
                'border' => 'border-amber-500',
                'matches' => ['PEMBERDAYAAN', 'MASYARAKAT'],
            ],
            'audit' => [
                'code' => 'IV',
                'title' => 'Audit Internal',
                'icon' => 'fa-scale-balanced',
                'color' => 'violet',
                'gradient' => 'from-violet-700 to-purple-700',
                'border' => 'border-violet-500',
                'matches' => ['AUDIT', 'INTERNAL'],
            ],
            'wanita' => [
                'code' => 'V',
                'title' => 'Peranan Wanita',
                'icon' => 'fa-female',
                'color' => 'rose',
                'gradient' => 'from-rose-600 to-pink-600',
                'border' => 'border-rose-500',
                'matches' => ['PERANAN WANITA', 'WANITA', 'PEREMPUAN'],
            ],
            'lembaga' => [
                'code' => 'VI',
                'title' => 'Hubungan Antar Lembaga',
                'icon' => 'fa-building-columns',
                'color' => 'cyan',
                'gradient' => 'from-cyan-700 to-sky-700',
                'border' => 'border-cyan-500',
                'matches' => ['LEMBAGA', 'HUBUNGAN ANTAR LEMBAGA', 'KEMITRAAN'],
            ],
            'hukum_humas' => [
                'code' => 'VII',
                'title' => 'Hukum & Humas',
                'icon' => 'fa-gavel',
                'color' => 'slate',
                'gradient' => 'from-slate-700 to-slate-900',
                'border' => 'border-slate-500',
                'matches' => ['HUKUM', 'HUMAS', 'ADVOKASI'],
            ],
        ];

        $bidangs = [];
        $assignedBidangIds = [];

        foreach ($bidangDefs as $key => $b) {
            $membersInBidang = $structures->filter(function ($s) use ($b, $coreIds, $assignedBidangIds) {
                if (in_array($s->id, $coreIds) || in_array($s->id, $assignedBidangIds)) {
                    return false;
                }
                $txt = strtoupper(((string) $s->jabatan).' '.((string) $s->divisi));
                foreach ($b['matches'] as $kw) {
                    if (str_contains($txt, $kw)) {
                        return true;
                    }
                }

                return false;
            })->values();

            $kabid = $membersInBidang->first(fn ($s) => str_starts_with(strtoupper(trim((string) $s->jabatan)), 'KETUA')
                || str_starts_with(strtoupper(trim((string) $s->jabatan)), 'KABID')
                || str_starts_with(strtoupper(trim((string) $s->jabatan)), 'KOORDINATOR'))
                ?? $membersInBidang->first();

            $anggotaList = $membersInBidang->filter(fn ($s) => $s->id !== $kabid?->id)->values();

            foreach ($membersInBidang as $m) {
                $assignedBidangIds[] = $m->id;
            }

            $bidangs[$key] = [
                'info' => $b,
                'kabid' => $kabid,
                'anggota' => $anggotaList,
                'members' => $membersInBidang,
            ];
        }

        // 8. Anggota Tambahan / Komisariat Pasar lainnya
        $allAssignedIds = array_merge($coreIds, $assignedBidangIds);
        $anggotaUmum = $structures->reject(fn ($s) => in_array($s->id, $allAssignedIds))->values();

        return [
            'all' => $structures,
            'dewan_penasehat' => $dewanPenasehat,
            'dewan_pembina' => $dewanPembina,
            'ketua' => $ketua,
            'wakil_ketua' => $wakilKetuaList,
            'sekretariat' => [
                'utama' => $sekretaris,
                'wakil' => $wakilSekretaris,
            ],
            'kebendaharaan' => [
                'utama' => $bendahara,
                'wakil' => $wakilBendahara,
            ],
            'bidangs' => $bidangs,
            'anggota_umum' => $anggotaUmum,
        ];
    }
}
