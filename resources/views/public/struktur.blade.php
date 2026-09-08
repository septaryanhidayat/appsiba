@extends('layouts.public')

@section('title', 'Struktur Organisasi - DPD APPSI Kabupaten Banyuasin Periode 2026-2031')

@section('content')

<!-- Header Banner -->
<section class="bg-gradient-to-b from-emerald-50/80 via-white to-white py-12 sm:py-16 border-b border-slate-100">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <span class="inline-block rounded-full bg-emerald-100 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-emerald-800 border border-emerald-200">
            KEPENGURUSAN RESMI DPD APPSI
        </span>
        <h1 class="mt-3 text-3xl font-extrabold text-slate-900 sm:text-4xl lg:text-5xl">
            Struktur <span class="text-emerald-700">Organisasi</span>
        </h1>
        <p class="mt-3 text-sm text-slate-600 sm:text-base max-w-2xl mx-auto font-medium">
            Dewan Pimpinan Daerah Asosiasi Pedagang Pasar Seluruh Indonesia (APPSI) Kabupaten Banyuasin Masa Bhakti 2026–2031
        </p>
        <div class="mt-2 text-xs text-slate-400">
            SK DPW APPSI Sumatera Selatan Nomor: 012/SK/DPW-APPSI/VI/2026
        </div>
    </div>
</section>

<!-- Content Area with View Mode Switcher -->
<section class="py-10 sm:py-16 bg-slate-50/60" x-data="{ viewMode: 'chart' }">
    <div class="mx-auto w-full max-w-[1240px] px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- View Mode Switcher Header -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pb-4 border-b border-slate-200" data-aos="fade-up">
            <div>
                <h3 class="text-lg font-black text-slate-900">
                    Susunan Pengurus Resmi DPD APPSI Banyuasin
                </h3>
                <p class="text-xs text-slate-500 mt-0.5 font-medium">
                    Pilih model tampilan visual bagan alur hirarki atau daftar kartu profil
                </p>
            </div>

            <!-- Switcher Tabs -->
            <div class="inline-flex items-center p-1.5 rounded-2xl bg-white border border-slate-200 shadow-sm">
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

        <!-- TAMPILAN 2: DAFTAR KARTU GRID PROFIL PENGURUS -->
        <div x-show="viewMode === 'grid'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-10">
            
            <!-- Pimpinan Utama Card (Ketua & Wakil Ketua) -->
            <div class="grid gap-6 md:grid-cols-2 max-w-4xl mx-auto">
                @if($tree['ketua'])
                    <div class="bg-gradient-to-br from-emerald-50 to-white rounded-3xl border-2 border-emerald-300 p-6 sm:p-7 flex flex-col sm:flex-row items-center gap-5 shadow-sm hover:shadow-md transition">
                        <div class="w-24 h-32 rounded-2xl overflow-hidden border-2 border-emerald-500 bg-white shrink-0 shadow-sm">
                            <img src="{{ $tree['ketua']->foto_url }}" alt="{{ $tree['ketua']->nama }}" class="w-full h-full object-cover object-top">
                        </div>
                        <div class="text-center sm:text-left flex-1">
                            <span class="inline-block rounded-md bg-emerald-700 px-3 py-0.5 text-[10px] font-bold uppercase tracking-wider text-white">
                                {{ $tree['ketua']->jabatan }}
                            </span>
                            <h3 class="mt-2 text-xl font-extrabold text-slate-900">{{ $tree['ketua']->nama }}</h3>
                            <p class="text-xs font-semibold text-emerald-800 mt-0.5">DPD APPSI Kabupaten Banyuasin</p>
                            <p class="mt-2 text-xs text-slate-500 leading-relaxed">
                                Periode 2026–2031 • Memimpin koordinasi dan arah kebijakan organisasi pedagang pasar seluruh Indonesia di wilayah Kabupaten Banyuasin.
                            </p>
                        </div>
                    </div>
                @endif

                @foreach($tree['wakil_ketua'] as $wk)
                    <div class="bg-gradient-to-br from-teal-50 to-white rounded-3xl border-2 border-teal-300 p-6 sm:p-7 flex flex-col sm:flex-row items-center gap-5 shadow-sm hover:shadow-md transition">
                        <div class="w-24 h-32 rounded-2xl overflow-hidden border-2 border-teal-500 bg-white shrink-0 shadow-sm">
                            <img src="{{ $wk->foto_url }}" alt="{{ $wk->nama }}" class="w-full h-full object-cover object-top">
                        </div>
                        <div class="text-center sm:text-left flex-1">
                            <span class="inline-block rounded-md bg-teal-700 px-3 py-0.5 text-[10px] font-bold uppercase tracking-wider text-white">
                                {{ $wk->jabatan }}
                            </span>
                            <h3 class="mt-2 text-xl font-extrabold text-slate-900">{{ $wk->nama }}</h3>
                            <p class="text-xs font-semibold text-teal-800 mt-0.5">DPD APPSI Kabupaten Banyuasin</p>
                            <p class="mt-2 text-xs text-slate-500 leading-relaxed">
                                Periode 2026–2031 • Membantu pelaksanaan tugas ketua dalam koordinasi dan penguatan kepengurusan daerah.
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Semua Pejabat Pengurus Grid -->
            <div>
                <div class="text-center mb-6">
                    <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-3 py-1 rounded-full">
                        DAFTAR SELURUH PENGURUS ORGANISASI
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    @foreach($structures as $s)
                        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:shadow-md transition-all flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-3.5 mb-3.5">
                                    <div class="w-12 h-12 rounded-xl bg-slate-100 overflow-hidden ring-1 ring-slate-200 shrink-0">
                                        <img src="{{ $s->foto_url }}" alt="{{ $s->nama }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <h4 class="text-xs sm:text-sm font-bold text-slate-900 truncate" title="{{ $s->nama }}">
                                            {{ $s->nama }}
                                        </h4>
                                        <span class="text-[10px] text-slate-400 font-semibold block mt-0.5">
                                            {{ $s->periode ?? '2026 - 2031' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                                    <span class="text-[9px] uppercase font-bold text-slate-400 block">Jabatan</span>
                                    <span class="text-xs font-bold text-emerald-900 block mt-0.5">{{ $s->jabatan }}</span>
                                </div>
                            </div>

                            @if($s->divisi)
                                <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between text-[10px] text-slate-500 font-semibold">
                                    <span>Divisi:</span>
                                    <span class="text-slate-800 font-bold">{{ $s->divisi }}</span>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

    </div>
</section>

@endsection
