@extends('layouts.public')

@section('title', 'Berita & Kabar Pasar - DPD APPSI Kabupaten Banyuasin')

@section('content')

<!-- Header Banner -->
<section class="bg-gradient-to-b from-emerald-50/70 via-white to-white py-12 sm:py-16 border-b border-slate-100">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <span class="inline-block rounded-full bg-emerald-100 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-emerald-800">
            WARTA & PUBLIKASI
        </span>
        <h1 class="mt-3 text-3xl font-extrabold text-slate-900 sm:text-4xl">
            Berita & Kabar <span class="text-emerald-700">Pasar APPSI</span>
        </h1>
        <p class="mt-3 text-sm text-slate-600 sm:text-base max-w-2xl mx-auto">
            Informasi terkini mengenai perkembangan pasar tradisional, kegiatan organisasi, kebijakan harga komoditas, dan aspirasi pedagang.
        </p>
    </div>
</section>

<!-- Content Section -->
<section class="py-12 bg-white min-h-[600px]">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8">
        
        <!-- Search & Category Bar -->
        <div class="bg-slate-50 rounded-2xl border border-slate-200/80 p-5 mb-10 shadow-sm" data-aos="fade-up">
            <form action="{{ route('news.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <div class="flex-1">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari artikel berita pasar..." class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600 bg-white">
                </div>
                <div class="sm:w-52">
                    <select name="kategori" class="w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600 bg-white">
                        <option value="">-- Semua Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('kategori') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="rounded-xl bg-emerald-700 px-6 py-2.5 text-xs font-bold text-white hover:bg-emerald-800 transition">
                    <i class="fa-solid fa-magnifying-glass mr-1"></i> Cari
                </button>
            </form>
        </div>

        <!-- News Grid -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($posts as $post)
                <article class="group flex flex-col overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm hover:shadow-md hover:border-emerald-200 transition" data-aos="fade-up">
                    <div class="relative h-48 w-full overflow-hidden bg-slate-100">
                        <img src="{{ $post->gambar_url }}" alt="{{ $post->judul }}" class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                        <span class="absolute left-4 top-4 rounded-md bg-emerald-700 px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-white shadow">
                            {{ $post->kategori }}
                        </span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2 text-xs text-slate-500">
                                <i class="fa-regular fa-calendar text-emerald-600"></i>
                                {{ $post->published_at ? $post->published_at->translatedFormat('d F Y') : date('d M Y') }}
                                <span>&bull;</span>
                                <span><i class="fa-regular fa-eye mr-1"></i>{{ $post->views_count }} tayang</span>
                            </div>
                            <h3 class="mt-3 text-base font-bold leading-snug text-slate-900 line-clamp-2 group-hover:text-emerald-700 transition">
                                <a href="{{ route('news.show', $post->slug) }}">{{ $post->judul }}</a>
                            </h3>
                            <p class="mt-2 text-sm leading-relaxed text-slate-600 line-clamp-2">
                                {{ $post->ringkasan ?? Str::limit(strip_tags($post->konten), 90) }}
                            </p>
                        </div>
                        <div class="mt-5 pt-4 border-t border-slate-100">
                            <a href="{{ route('news.show', $post->slug) }}" class="inline-flex items-center gap-2 text-sm font-bold text-emerald-700 group-hover:gap-3 transition-all">
                                Baca selengkapnya
                                <i class="fa-solid fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-3 text-center py-16 bg-slate-50 rounded-2xl text-slate-400">
                    <i class="fa-regular fa-newspaper text-4xl mb-3 text-slate-300"></i>
                    <p class="text-base font-semibold text-slate-600">Belum ada artikel berita yang ditemukan.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-10">
            {{ $posts->links() }}
        </div>

    </div>
</section>

@endsection
