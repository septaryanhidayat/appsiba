@extends('layouts.public')

@section('title', $post->judul . ' - DPD APPSI Kabupaten Banyuasin')

@section('content')

<!-- Breadcrumb Navigation -->
<div class="bg-slate-50/80 border-b border-slate-200/60 py-4">
    <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8 text-xs text-slate-500 flex items-center gap-2">
        <a href="{{ route('home') }}" class="hover:text-emerald-700 font-semibold">Beranda</a>
        <i class="fa-solid fa-angle-right text-[10px] text-slate-400"></i>
        <a href="{{ route('news.index') }}" class="hover:text-emerald-700 font-semibold">Warta Pasar</a>
        <i class="fa-solid fa-angle-right text-[10px] text-slate-400"></i>
        <span class="text-slate-800 font-bold line-clamp-1">{{ $post->judul }}</span>
    </div>
</div>

<!-- Article Detail Section (Editorial International Standard) -->
<section class="py-12 sm:py-16 bg-white min-h-[700px]">
    <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12 items-start">
            
            <!-- Article Body (8 Cols) -->
            <article class="lg:col-span-8 reveal-fade-up">
                
                <!-- Category & Meta -->
                <div class="mb-5 flex flex-wrap items-center gap-3">
                    <span class="rounded-xl bg-gradient-to-r from-emerald-700 to-teal-800 px-3.5 py-1 text-xs font-black uppercase tracking-wider text-white shadow-sm">
                        {{ $post->kategori }}
                    </span>
                    <span class="text-xs text-slate-500 font-semibold flex items-center gap-1.5">
                        <i class="fa-regular fa-calendar text-emerald-600"></i>
                        {{ $post->published_at ? $post->published_at->translatedFormat('l, d F Y') : date('d F Y') }}
                    </span>
                    <span class="text-xs text-slate-400">•</span>
                    <span class="text-xs text-slate-500 font-semibold flex items-center gap-1.5">
                        <i class="fa-regular fa-user text-emerald-600"></i>
                        {{ $post->penulis }}
                    </span>
                </div>

                <!-- Headline -->
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 leading-tight tracking-tight">
                    {{ $post->judul }}
                </h1>

                @if($post->ringkasan)
                    <div class="mt-6 text-base sm:text-lg font-semibold text-slate-700 leading-relaxed border-l-4 border-emerald-600 bg-emerald-50/50 p-4 rounded-r-2xl">
                        {{ $post->ringkasan }}
                    </div>
                @endif

                <!-- Featured Image -->
                <div class="my-8 overflow-hidden rounded-3xl border border-slate-200/80 shadow-md max-h-[500px] bg-slate-100">
                    <img src="{{ $post->gambar_url }}" alt="{{ $post->judul }}" class="w-full h-full object-cover">
                </div>

                <!-- Main Content HTML -->
                <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed text-base sm:text-lg space-y-5">
                    {!! $post->konten !!}
                </div>

                <!-- Share Buttons Group -->
                <div class="mt-12 pt-8 border-t border-slate-200 flex flex-wrap items-center justify-between gap-4">
                    <span class="text-xs font-black uppercase tracking-wider text-slate-500">Bagikan Informasi Ini:</span>
                    <div class="flex items-center gap-2.5">
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($post->judul . ' - Baca di: ' . url()->current()) }}" target="_blank" class="h-10 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold flex items-center gap-2 shadow-sm transition">
                            <i class="fa-brands fa-whatsapp text-sm"></i> WhatsApp
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="h-10 px-4 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold flex items-center gap-2 shadow-sm transition">
                            <i class="fa-brands fa-facebook text-sm"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->judul) }}&url={{ urlencode(url()->current()) }}" target="_blank" class="h-10 px-4 rounded-xl bg-slate-900 hover:bg-black text-white text-xs font-bold flex items-center gap-2 shadow-sm transition">
                            <i class="fa-brands fa-x-twitter text-sm"></i> Twitter
                        </a>
                    </div>
                </div>

            </article>

            <!-- Sidebar (4 Cols) -->
            <aside class="lg:col-span-4 space-y-8 reveal-fade-up delay-200">
                
                <!-- Related News -->
                <div class="bg-slate-50 rounded-3xl border border-slate-200/80 p-6 shadow-sm">
                    <h3 class="text-base font-black text-slate-900 border-b border-slate-200 pb-3 flex items-center gap-2">
                        <i class="fa-solid fa-newspaper text-emerald-700"></i>
                        Warta Terkait Lainnya
                    </h3>
                    <div class="mt-5 space-y-5">
                        @foreach($relatedPosts as $rel)
                            <div class="group flex gap-3.5 items-start">
                                <div class="w-20 h-20 rounded-2xl overflow-hidden bg-slate-200 shrink-0">
                                    <img src="{{ $rel->gambar_url }}" alt="{{ $rel->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                </div>
                                <div class="flex-1">
                                    <span class="text-[10px] font-extrabold text-emerald-700 uppercase tracking-wider">{{ $rel->kategori }}</span>
                                    <h4 class="text-xs font-bold text-slate-900 group-hover:text-emerald-700 line-clamp-2 leading-snug mt-0.5">
                                        <a href="{{ route('news.show', $rel->slug) }}">{{ $rel->judul }}</a>
                                    </h4>
                                    <span class="text-[10px] text-slate-400 mt-1 block">
                                        {{ $rel->published_at ? $rel->published_at->format('d M Y') : '' }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Quick Assistance Widget -->
                <div class="rounded-3xl bg-gradient-to-br from-emerald-900 to-slate-950 p-6 text-white shadow-lg">
                    <span class="text-[10px] font-extrabold text-emerald-400 uppercase tracking-wider">LAYANAN PEDAGANG</span>
                    <h4 class="mt-2 text-base font-black text-white">Butuh Bantuan atau Advokasi Lapak?</h4>
                    <p class="mt-2 text-xs text-slate-300 leading-relaxed">
                        Sampaikan keluhan fasilitas pasar, zonasi lapak, atau permodalan langsung ke pengurus DPD APPSI Banyuasin.
                    </p>
                    <a href="https://wa.me/62811618808?text=Halo%20Pengurus%20DPD%20APPSI%20Banyuasin,%20saya%20pedagang..." target="_blank" class="mt-5 inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-black py-2.5 px-4 text-xs w-full transition shadow">
                        <i class="fa-brands fa-whatsapp text-sm"></i>
                        Hubungi WhatsApp DPD
                    </a>
                </div>

            </aside>

        </div>
    </div>
</section>

@endsection
