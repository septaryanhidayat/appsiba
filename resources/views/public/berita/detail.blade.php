@extends('layouts.public')

@section('title', $post->judul . ' - DPD APPSI Kabupaten Banyuasin')

@section('content')

<!-- Breadcrumb Header -->
<div class="bg-slate-50 border-b border-slate-100 py-4">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8 text-xs text-slate-500 flex items-center gap-2">
        <a href="{{ route('home') }}" class="hover:text-emerald-700">Beranda</a>
        <i class="fa-solid fa-chevron-right text-[10px]"></i>
        <a href="{{ route('news.index') }}" class="hover:text-emerald-700">Berita</a>
        <i class="fa-solid fa-chevron-right text-[10px]"></i>
        <span class="text-slate-800 font-semibold line-clamp-1">{{ $post->judul }}</span>
    </div>
</div>

<!-- Article Detail Section -->
<section class="py-12 bg-white">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-[1fr_360px] gap-12 items-start">
            
            <!-- Article Body -->
            <article>
                <div class="mb-4 flex items-center gap-3">
                    <span class="rounded-md bg-emerald-700 px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-white">
                        {{ $post->kategori }}
                    </span>
                    <span class="text-xs text-slate-500">
                        <i class="fa-regular fa-calendar mr-1"></i> {{ $post->published_at ? $post->published_at->translatedFormat('d F Y') : date('d M Y') }}
                    </span>
                    <span class="text-xs text-slate-500">
                        <i class="fa-regular fa-user mr-1"></i> {{ $post->penulis }}
                    </span>
                </div>

                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 leading-tight">
                    {{ $post->judul }}
                </h1>

                @if($post->ringkasan)
                    <p class="mt-4 text-base font-semibold text-slate-600 italic border-l-4 border-emerald-600 pl-4 py-1">
                        {{ $post->ringkasan }}
                    </p>
                @endif

                <!-- Featured Image -->
                <div class="my-8 overflow-hidden rounded-2xl border border-slate-100 shadow-sm max-h-[460px] bg-slate-100">
                    <img src="{{ $post->gambar_url }}" alt="{{ $post->judul }}" class="w-full h-full object-cover">
                </div>

                <!-- Main Content HTML -->
                <div class="prose max-w-none text-slate-700 leading-relaxed text-base space-y-4">
                    {!! $post->konten !!}
                </div>

                <!-- Share Buttons -->
                <div class="mt-10 pt-6 border-t border-slate-100 flex flex-wrap items-center justify-between gap-4">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Bagikan Berita Ini:</span>
                    <div class="flex items-center gap-2">
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($post->judul . ' ' . url()->current()) }}" target="_blank" class="h-9 px-3 rounded-lg bg-emerald-600 text-white text-xs font-semibold flex items-center gap-1.5 hover:bg-emerald-700 transition">
                            <i class="fa-brands fa-whatsapp text-sm"></i> WhatsApp
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="h-9 px-3 rounded-lg bg-blue-600 text-white text-xs font-semibold flex items-center gap-1.5 hover:bg-blue-700 transition">
                            <i class="fa-brands fa-facebook text-sm"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->judul) }}&url={{ urlencode(url()->current()) }}" target="_blank" class="h-9 px-3 rounded-lg bg-slate-800 text-white text-xs font-semibold flex items-center gap-1.5 hover:bg-slate-900 transition">
                            <i class="fa-brands fa-x-twitter text-sm"></i> Twitter
                        </a>
                    </div>
                </div>
            </article>

            <!-- Sidebar -->
            <aside class="space-y-8">
                <!-- Related News -->
                <div class="bg-slate-50 rounded-2xl border border-slate-200/80 p-6 shadow-sm">
                    <h3 class="text-base font-extrabold text-slate-900 border-b border-slate-200 pb-3 flex items-center gap-2">
                        <i class="fa-solid fa-newspaper text-emerald-700"></i>
                        Berita Terkait
                    </h3>
                    <div class="mt-4 space-y-4">
                        @foreach($relatedPosts as $rel)
                            <div class="group flex gap-3 items-start">
                                <div class="w-16 h-16 rounded-xl overflow-hidden bg-slate-200 shrink-0">
                                    <img src="{{ $rel->gambar_url }}" alt="{{ $rel->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition">
                                </div>
                                <div class="flex-1">
                                    <span class="text-[10px] font-bold text-emerald-700 uppercase">{{ $rel->kategori }}</span>
                                    <h4 class="text-xs font-bold text-slate-900 group-hover:text-emerald-700 line-clamp-2 leading-snug">
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

                <!-- Registration CTA Card -->
                <div class="rounded-2xl bg-gradient-to-br from-emerald-800 to-emerald-950 p-6 text-white shadow-lg text-center">
                    <div class="h-12 w-12 mx-auto rounded-full bg-white/10 flex items-center justify-center text-emerald-300 text-xl mb-3">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                    <h4 class="text-base font-extrabold">Anda Pedagang Pasar?</h4>
                    <p class="mt-2 text-xs text-emerald-100/80 leading-relaxed">
                        Dapatkan perlindungan usaha dan nomor pokok anggota resmi APPSI Kabupaten Banyuasin.
                    </p>
                    <a href="{{ route('members.register') }}" class="mt-4 inline-block w-full rounded-xl bg-white py-2.5 text-xs font-bold text-emerald-900 hover:bg-emerald-50 transition shadow">
                        Daftar Keanggotaan Sekarang
                    </a>
                </div>
            </aside>

        </div>
    </div>
</section>

@endsection
