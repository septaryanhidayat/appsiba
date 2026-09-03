@extends('layouts.public')

@section('title', 'Galeri Dokumentasi Kegiatan - DPD APPSI Kabupaten Banyuasin')

@section('content')

<!-- Header Banner -->
<section class="bg-gradient-to-b from-emerald-50/70 via-white to-white py-12 sm:py-16 border-b border-slate-100">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <span class="inline-block rounded-full bg-emerald-100 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-emerald-800">
            DOKUMENTASI FOTO
        </span>
        <h1 class="mt-3 text-3xl font-extrabold text-slate-900 sm:text-4xl">
            Galeri Kegiatan <span class="text-emerald-700">APPSI</span>
        </h1>
        <p class="mt-3 text-sm text-slate-600 sm:text-base max-w-2xl mx-auto">
            Dokumentasi musyawarah pasar, peninjauan stabilitas harga, bakti sosial, dan aksi advokasi pedagang pasar tradisional.
        </p>
    </div>
</section>

<!-- Gallery Grid -->
<section class="py-12 bg-white min-h-[600px]" x-data="{ previewModal: false, activeImg: '', activeTitle: '', activeDesc: '' }">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8">
        
        <!-- Filter Bar -->
        <div class="flex flex-wrap items-center justify-between gap-4 mb-8" data-aos="fade-up">
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('gallery.public') }}" class="rounded-xl px-4 py-2 text-xs font-bold transition {{ !request('kategori') ? 'bg-emerald-700 text-white shadow' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    Semua Foto
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('gallery.public', ['kategori' => $cat]) }}" class="rounded-xl px-4 py-2 text-xs font-bold transition {{ request('kategori') == $cat ? 'bg-emerald-700 text-white shadow' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>
            <span class="text-xs text-slate-400 font-medium">Klik foto untuk melihat ukuran penuh</span>
        </div>

        <!-- Grid Cards -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse($galleries as $gal)
                <div class="group relative overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm hover:shadow-md cursor-pointer transition"
                     @click="previewModal = true; activeImg = '{{ $gal->foto_url }}'; activeTitle = '{{ addslashes($gal->judul) }}'; activeDesc = '{{ addslashes($gal->deskripsi ?? '') }}'"
                     data-aos="fade-up">
                    <div class="h-56 w-full overflow-hidden bg-slate-100">
                        <img src="{{ $gal->foto_url }}" alt="{{ $gal->judul }}" class="h-full w-full object-cover group-hover:scale-105 transition duration-300">
                    </div>
                    <div class="p-4">
                        <span class="text-[10px] font-bold text-emerald-700 uppercase">{{ $gal->kategori ?? 'Kegiatan' }}</span>
                        <h3 class="text-sm font-bold text-slate-900 line-clamp-2 mt-1">{{ $gal->judul }}</h3>
                        <p class="text-xs text-slate-500 mt-1">
                            <i class="fa-regular fa-calendar text-emerald-600 mr-1"></i>
                            {{ $gal->tanggal_kegiatan ? $gal->tanggal_kegiatan->format('d M Y') : date('d M Y') }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center py-16 text-slate-400">
                    Belum ada foto kegiatan di galeri.
                </div>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $galleries->links() }}
        </div>

    </div>

    <!-- Lightbox Modal -->
    <div x-show="previewModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/80 p-4 backdrop-blur-sm" @click.self="previewModal = false">
        <div class="relative max-w-3xl w-full bg-white rounded-2xl overflow-hidden shadow-2xl">
            <button type="button" @click="previewModal = false" class="absolute top-4 right-4 z-10 h-9 w-9 rounded-full bg-slate-900/60 text-white flex items-center justify-center hover:bg-slate-900 transition">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="max-h-[70vh] bg-slate-950 flex items-center justify-center overflow-hidden">
                <img :src="activeImg" :alt="activeTitle" class="max-h-[70vh] w-auto object-contain">
            </div>
            <div class="p-5">
                <h3 class="text-lg font-bold text-slate-900" x-text="activeTitle"></h3>
                <p class="text-sm text-slate-600 mt-1" x-text="activeDesc"></p>
            </div>
        </div>
    </div>
</section>

@endsection
