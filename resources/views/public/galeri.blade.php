@extends('layouts.public')

@section('title', 'Galeri Dokumentasi Kegiatan - DPD APPSI Kabupaten Banyuasin')

@section('content')

<!-- Header Banner -->
<section class="relative isolate overflow-hidden bg-gradient-to-b from-emerald-50/40 via-white to-white py-14 sm:py-20 border-b border-slate-200/60">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[250px] bg-emerald-400/10 rounded-full blur-3xl pointer-events-none -z-10"></div>

    <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8 text-center reveal-fade-up">
        <span class="inline-block rounded-full bg-emerald-100/70 px-4 py-1.5 text-xs font-extrabold uppercase tracking-wider text-emerald-800 border border-emerald-200">
            DOKUMENTASI AKSI LAPANGAN
        </span>
        <h1 class="mt-4 text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight">
            Galeri Dokumentasi <span class="bg-gradient-to-r from-emerald-700 to-teal-800 bg-clip-text text-transparent">APPSI Banyuasin</span>
        </h1>
        <p class="mt-4 text-sm sm:text-base text-slate-600 max-w-2xl mx-auto leading-relaxed">
            Rekam jejak kunjungan pasar tradisional, fasilitasi permodalan KUR, operasi pasar pangan murah, dan konsolidasi pengurus komisariat se-Kabupaten Banyuasin.
        </p>
    </div>
</section>

<!-- Gallery Grid Section -->
<section class="py-14 sm:py-20 bg-slate-50/50 min-h-[600px]" x-data="{ previewModal: false, activeImg: '', activeTitle: '', activeDesc: '' }">
    <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
        
        <!-- Filter Bar -->
        <div class="flex flex-wrap items-center justify-between gap-4 mb-10 reveal-fade-up">
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('gallery.public') }}" class="rounded-xl px-4 py-2 text-xs font-bold transition {{ !request('kategori') ? 'bg-emerald-700 text-white shadow-sm' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }}">
                    Semua Foto
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('gallery.public', ['kategori' => $cat]) }}" class="rounded-xl px-4 py-2 text-xs font-bold transition {{ request('kategori') == $cat ? 'bg-emerald-700 text-white shadow-sm' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>
            <span class="text-xs text-slate-400 font-semibold hidden sm:inline"><i class="fa-solid fa-expand text-emerald-600 mr-1.5"></i> Klik foto untuk melihat tampilan penuh</span>
        </div>

        <!-- Grid Cards -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse($galleries as $index => $gal)
                <div class="group relative overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm hover:shadow-xl hover:border-emerald-300 cursor-pointer transition-all duration-300 hover:-translate-y-1.5 reveal-fade-up delay-{{ ($index % 4) * 100 }}"
                     @click="previewModal = true; activeImg = '{{ $gal->foto_url }}'; activeTitle = '{{ addslashes($gal->judul) }}'; activeDesc = '{{ addslashes($gal->deskripsi ?? '') }}'">
                    <div class="h-60 w-full overflow-hidden bg-slate-100 relative">
                        <img src="{{ $gal->foto_url }}" alt="{{ $gal->judul }}" class="h-full w-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-slate-900/20 group-hover:bg-slate-900/0 transition-colors"></div>
                        <span class="absolute top-3 left-3 rounded-xl bg-slate-900/80 backdrop-blur-md px-2.5 py-1 text-[10px] font-extrabold uppercase tracking-wider text-white">
                            {{ $gal->kategori ?? 'Kegiatan' }}
                        </span>
                    </div>
                    <div class="p-5">
                        <h3 class="text-sm font-black text-slate-900 line-clamp-2 group-hover:text-emerald-700 transition leading-snug">{{ $gal->judul }}</h3>
                        <p class="text-xs text-slate-500 mt-2 flex items-center gap-1.5 font-medium">
                            <i class="fa-regular fa-calendar text-emerald-600"></i>
                            {{ $gal->tanggal_kegiatan ? $gal->tanggal_kegiatan->translatedFormat('d F Y') : date('d M Y') }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center py-20 bg-white rounded-3xl border border-slate-200 text-slate-400">
                    <i class="fa-regular fa-images text-5xl mb-4 text-slate-300"></i>
                    <p class="text-base font-bold text-slate-700">Belum ada foto dalam kategori ini.</p>
                </div>
            @endforelse
        </div>

        <!-- Lightbox Modal -->
        <div x-show="previewModal" x-cloak 
             class="fixed inset-0 z-50 flex items-center justify-center bg-black/85 p-4 backdrop-blur-md"
             @keydown.escape.window="previewModal = false">
            <div class="relative max-h-[90vh] max-w-4xl w-full overflow-hidden rounded-3xl bg-slate-900 text-white shadow-2xl border border-white/10"
                 @click.away="previewModal = false">
                <button type="button" @click="previewModal = false" class="absolute top-4 right-4 z-10 h-10 w-10 rounded-full bg-white/20 text-white hover:bg-white/40 flex items-center justify-center transition">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
                <div class="max-h-[68vh] w-full overflow-hidden bg-black flex items-center justify-center">
                    <img :src="activeImg" :alt="activeTitle" class="max-h-[68vh] w-auto object-contain">
                </div>
                <div class="p-6 bg-slate-900">
                    <h3 class="text-base sm:text-lg font-black text-white" x-text="activeTitle"></h3>
                    <p class="mt-1 text-xs sm:text-sm text-slate-400" x-text="activeDesc"></p>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
