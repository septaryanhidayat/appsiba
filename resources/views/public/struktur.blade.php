@extends('layouts.public')

@section('title', 'Susunan Struktur Organisasi DPD APPSI Kabupaten Banyuasin')

@section('content')
<!-- Header Banner (Adopsi PWI Banyuasin dengan Branding Resmi APPSI) -->
<div class="relative overflow-hidden bg-gradient-to-r from-[#04281f] via-[#063b2e] to-[#021a13] text-white py-14 sm:py-18 border-b border-emerald-800/40">
    <div class="absolute inset-0 opacity-15 pointer-events-none hero-dot-pattern"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl flex flex-col items-center sm:items-start text-center sm:text-left">
            <div class="inline-flex items-center gap-2 rounded-full bg-emerald-500/20 border border-emerald-400/30 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-emerald-300 backdrop-blur-sm shadow-xs">
                <i class="fa-solid fa-sitemap text-emerald-400 text-[11px]"></i>
                <span>Struktur Kepengurusan Resmi</span>
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white mt-3.5 tracking-tight">
                Jajaran Pengurus DPD APPSI Kabupaten Banyuasin
            </h1>
            <p class="text-emerald-100/90 text-sm sm:text-base mt-2.5 leading-relaxed font-medium">
                Masa Bhakti 2026–2031 • Mengabdi untuk kemajuan, perlindungan, dan kesejahteraan pedagang pasar di Bumi Sedulang Setudung.
            </p>
            <div class="mt-4 inline-flex items-center gap-2 text-xs text-emerald-200/90 bg-black/25 px-3 py-1.5 rounded-lg border border-white/10">
                <i class="fa-solid fa-file-contract text-emerald-400"></i>
                <span>SK DPW APPSI Sumatera Selatan Nomor: <strong>012/SK/DPW-APPSI/VI/2026</strong></span>
            </div>
        </div>
    </div>
</div>

<div class="py-12 bg-slate-50 min-h-screen transition-colors duration-200" x-data="{ viewMode: 'chart', filterCategory: 'all' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- View Mode Switcher Header (Identik dengan PWI Banyuasin) -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pb-2 border-b border-slate-200">
            <div>
                <h3 class="text-lg font-black text-slate-900">
                    Susunan {{ $structures->count() }} Pejabat Pengurus DPD APPSI Banyuasin
                </h3>
                <p class="text-xs text-slate-500 mt-0.5 font-medium">
                    Pilih model tampilan bagan visual bergaris instruksi atau daftar kartu profil
                </p>
            </div>

            <!-- Switcher Tabs -->
            <div class="inline-flex items-center p-1.5 rounded-2xl bg-white border border-slate-200 shadow-xs">
                <button type="button" 
                        @click="viewMode = 'chart'"
                        :class="viewMode === 'chart' ? 'bg-emerald-700 text-white shadow-md' : 'text-slate-600 hover:text-slate-900'"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold transition-all cursor-pointer">
                    <i class="fa-solid fa-sitemap"></i>
                    <span>Bagan Hirarki (Org Chart)</span>
                </button>
                <button type="button" 
                        @click="viewMode = 'grid'"
                        :class="viewMode === 'grid' ? 'bg-emerald-700 text-white shadow-md' : 'text-slate-600 hover:text-slate-900'"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold transition-all cursor-pointer">
                    <i class="fa-solid fa-table-cells-large"></i>
                    <span>Daftar Kartu (Grid)</span>
                </button>
            </div>
        </div>

        <!-- TAMPILAN 1: BAGAN STRUKTUR HIRARKI VISUAL BERGARIS INSTRUKSI -->
        <div x-show="viewMode === 'chart'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
            @include('partials.organization-chart', ['tree' => $tree])
        </div>

        <!-- TAMPILAN 2: DAFTAR KARTU GRID TRADISIONAL (IDENTIK DENGAN PWIBA) -->
        <div x-show="viewMode === 'grid'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">
            
            <!-- Quick Category Filter Tabs -->
            <div class="flex flex-wrap items-center gap-2">
                <button type="button" 
                        @click="filterCategory = 'all'"
                        :class="filterCategory === 'all' ? 'bg-emerald-700 text-white shadow-xs' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'"
                        class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition-colors cursor-pointer">
                    Semua Pengurus ({{ $structures->count() }})
                </button>
                <button type="button" 
                        @click="filterCategory = 'pimpinan'"
                        :class="filterCategory === 'pimpinan' ? 'bg-emerald-700 text-white shadow-xs' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'"
                        class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition-colors cursor-pointer">
                    Pimpinan Harian
                </button>
                <button type="button" 
                        @click="filterCategory = 'dewan'"
                        :class="filterCategory === 'dewan' ? 'bg-emerald-700 text-white shadow-xs' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'"
                        class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition-colors cursor-pointer">
                    Dewan Penasehat & Pembina
                </button>
                <button type="button" 
                        @click="filterCategory = 'bidang'"
                        :class="filterCategory === 'bidang' ? 'bg-emerald-700 text-white shadow-xs' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'"
                        class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition-colors cursor-pointer">
                    7 Bidang Kerja
                </button>
            </div>

            <!-- 4-Column Responsive Grid of Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($structures as $s)
                    @php
                        $jUpper = strtoupper((string)$s->jabatan);
                        $dUpper = strtoupper((string)$s->divisi);
                        $isKetua = str_contains(strtolower($s->nama), 'gusra yetri') || $jUpper === 'KETUA' || $jUpper === 'KETUA DPD';
                        $isDewan = str_contains($jUpper, 'PENASEHAT') || str_contains($dUpper, 'PENASEHAT') || str_contains($jUpper, 'PEMBINA') || str_contains($dUpper, 'PEMBINA');
                        $isPimpinan = $isKetua || str_starts_with($jUpper, 'WAKIL KETUA') || str_starts_with($jUpper, 'SEKRETARIS') || str_starts_with($jUpper, 'BENDAHARA');
                        $isBidang = !$isDewan && !$isPimpinan;
                        
                        $catKey = $isDewan ? 'dewan' : ($isPimpinan ? 'pimpinan' : 'bidang');
                    @endphp

                    <div x-show="filterCategory === 'all' || filterCategory === '{{ $catKey }}'"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="bg-white rounded-2xl p-6 border border-slate-200/90 shadow-xs hover:shadow-xl transition-all duration-300 group hover:-translate-y-1 flex flex-col justify-between">
                        
                        <div>
                            <!-- Header Info & Avatar -->
                            <div class="flex items-center gap-4 mb-4">
                                @if($isKetua)
                                    <div class="w-14 h-14 rounded-2xl bg-emerald-500/20 text-slate-700 flex items-center justify-center font-bold text-lg shadow-sm ring-2 ring-emerald-500 overflow-hidden flex-shrink-0 aspect-square hover:scale-105 transition-transform" title="Ketua DPD APPSI Banyuasin">
                                        <img src="{{ $s->foto_url }}" alt="{{ $s->nama }}" width="56" height="56" loading="lazy" decoding="async" class="w-full h-full object-cover">
                                    </div>
                                @elseif($isDewan)
                                    <div class="w-14 h-14 rounded-2xl bg-amber-500/10 text-slate-700 flex items-center justify-center font-bold text-lg shadow-sm ring-1 ring-amber-400 overflow-hidden flex-shrink-0 aspect-square">
                                        <img src="{{ $s->foto_url }}" alt="{{ $s->nama }}" width="56" height="56" loading="lazy" decoding="async" class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div class="w-14 h-14 rounded-2xl bg-slate-100 text-slate-700 flex items-center justify-center font-bold text-lg shadow-sm ring-1 ring-slate-200 overflow-hidden flex-shrink-0 aspect-square">
                                        <img src="{{ $s->foto_url }}" alt="{{ $s->nama }}" width="56" height="56" loading="lazy" decoding="async" class="w-full h-full object-cover">
                                    </div>
                                @endif

                                <div class="min-w-0 flex-grow">
                                    @if($isKetua)
                                        <h4 class="text-sm font-black text-emerald-950 truncate group-hover:text-emerald-700 transition-colors" title="{{ $s->nama }}">
                                            {{ $s->nama }}
                                        </h4>
                                    @else
                                        <h4 class="text-sm font-bold text-slate-900 truncate group-hover:text-emerald-700 transition-colors" title="{{ $s->nama }}">
                                            {{ $s->nama }}
                                        </h4>
                                    @endif
                                    <span class="block text-[10px] font-semibold text-slate-400 uppercase truncate">
                                        {{ $s->divisi ?: 'DPD APPSI BANYUASIN' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Jabatan Box -->
                            <div class="p-3 rounded-xl {{ $isKetua ? 'bg-emerald-100/70 border border-emerald-300' : ($isDewan ? 'bg-amber-50 border border-amber-200' : 'bg-slate-50 border border-slate-100') }} mb-4">
                                <div class="text-[10px] uppercase font-bold {{ $isKetua ? 'text-emerald-800' : ($isDewan ? 'text-amber-800' : 'text-slate-400') }}">
                                    Jabatan Kepengurusan
                                </div>
                                <div class="text-xs font-extrabold {{ $isKetua ? 'text-emerald-950' : ($isDewan ? 'text-amber-950' : 'text-slate-800') }} leading-snug">
                                    {{ $s->jabatan }}
                                </div>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                            <div class="flex items-center gap-1.5">
                                @if($s->no_hp)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $s->no_hp) }}" 
                                       target="_blank" 
                                       rel="noopener noreferrer" 
                                       class="w-6 h-6 rounded-md bg-emerald-50 hover:bg-emerald-600 hover:text-white text-emerald-700 flex items-center justify-center text-[10px] transition-colors" 
                                       title="WhatsApp: {{ $s->no_hp }}">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </a>
                                @endif
                                @if($s->email)
                                    <a href="mailto:{{ $s->email }}" 
                                       class="w-6 h-6 rounded-md bg-slate-100 hover:bg-emerald-600 hover:text-white text-slate-600 flex items-center justify-center text-[10px] transition-colors" 
                                       title="Email: {{ $s->email }}">
                                        <i class="fa-solid fa-envelope"></i>
                                    </a>
                                @endif
                                <span class="text-[9px] font-extrabold text-emerald-800 bg-emerald-50 px-1.5 py-0.5 rounded border border-emerald-200">
                                    KTA APPSI
                                </span>
                            </div>
                            <span class="text-slate-400 text-[10px] font-bold">{{ $s->periode ?: '2026 - 2031' }}</span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-4 text-center py-12 text-slate-400">
                        Data kepengurusan belum tersedia.
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection
