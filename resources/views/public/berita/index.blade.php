@extends('layouts.public')

@section('title', 'Warta & Kabar Pasar - DPD APPSI Kabupaten Banyuasin')

@section('content')

<!-- Header Banner (International Editorial Style) -->
<section class="relative isolate overflow-hidden bg-gradient-to-b from-emerald-50/40 via-white to-white py-14 sm:py-20 border-b border-slate-200/60">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[250px] bg-emerald-400/10 rounded-full blur-3xl pointer-events-none -z-10"></div>
    
    <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8 text-center reveal-fade-up">
        <span class="inline-block rounded-full bg-emerald-100/70 px-4 py-1.5 text-xs font-extrabold uppercase tracking-wider text-emerald-800 border border-emerald-200">
            WARTA & PUBLIKASI RESMI
        </span>
        <h1 class="mt-4 text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight">
            Berita & Kabar Pasar <span class="bg-gradient-to-r from-emerald-700 to-teal-800 bg-clip-text text-transparent">Banyuasin</span>
        </h1>
        <p class="mt-4 text-sm sm:text-base text-slate-600 max-w-2xl mx-auto leading-relaxed">
            Informasi terkini kegiatan DPD APPSI, operasi pasar murah, pembiayaan modal kerja pedagang, digitalisasi QRIS, dan advokasi hak pedagang tradisional.
        </p>

        <!-- Search & Filter Pill Box -->
        <div class="mt-10 max-w-3xl mx-auto bg-white rounded-3xl border border-slate-200/90 p-3 sm:p-4 shadow-lg shadow-slate-200/50">
            <form action="{{ route('news.index') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-3">
                <div class="relative flex-1 w-full">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari warta pasar, topik komoditas, atau kegiatan..." class="w-full rounded-2xl border-0 bg-slate-50 pl-11 pr-4 py-3 text-sm font-medium text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
                <div class="w-full sm:w-56">
                    <select name="kategori" class="w-full rounded-2xl border-0 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('kategori') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="w-full sm:w-auto rounded-2xl bg-gradient-to-r from-emerald-700 to-teal-800 px-7 py-3 text-xs font-black text-white hover:from-emerald-800 hover:to-teal-900 shadow-md shadow-emerald-700/25 transition">
                    Cari
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Content Grid Section -->
<section class="py-14 sm:py-20 bg-slate-50/50 min-h-[600px]">
    <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
        
        <!-- Category Filter Badges -->
        <div class="flex flex-wrap items-center gap-2 mb-10 reveal-fade-up">
            <a href="{{ route('news.index') }}" class="px-4 py-2 rounded-xl text-xs font-bold transition {{ !request('kategori') ? 'bg-emerald-700 text-white shadow-sm' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                Semua Topik
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('news.index', ['kategori' => $cat]) }}" class="px-4 py-2 rounded-xl text-xs font-bold transition {{ request('kategori') == $cat ? 'bg-emerald-700 text-white shadow-sm' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                    {{ $cat }}
                </a>
            @endforeach
        </div>

        <!-- News Grid -->
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse($posts as $index => $post)
                <article class="group flex flex-col overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm hover:shadow-xl hover:border-emerald-300 transition-all duration-300 hover:-translate-y-1.5 reveal-fade-up delay-{{ ($index % 3) * 100 }}">
                    <div class="relative h-52 w-full overflow-hidden bg-slate-100">
                        <img src="{{ $post->gambar_url }}" alt="{{ $post->judul }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <span class="absolute left-4 top-4 rounded-xl bg-slate-900/80 backdrop-blur-md px-3 py-1 text-[10px] font-extrabold uppercase tracking-wider text-white">
                            {{ $post->kategori }}
                        </span>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2 text-xs text-slate-500 font-medium">
                                <i class="fa-regular fa-calendar text-emerald-600"></i>
                                <span>{{ $post->published_at ? $post->published_at->translatedFormat('d F Y') : date('d M Y') }}</span>
                                <span>•</span>
                                <span><i class="fa-regular fa-eye text-slate-400 mr-1"></i>{{ $post->views_count }} tayang</span>
                            </div>
                            <h3 class="mt-3 text-lg font-black leading-snug text-slate-900 line-clamp-2 group-hover:text-emerald-700 transition">
                                <a href="{{ route('news.show', $post->slug) }}">{{ $post->judul }}</a>
                            </h3>
                            <p class="mt-2.5 text-xs text-slate-600 line-clamp-3 leading-relaxed">
                                {{ $post->ringkasan ?? Str::limit(strip_tags($post->konten), 120) }}
                            </p>
                        </div>
                        <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-[11px] font-bold text-slate-500">{{ $post->penulis }}</span>
                            <a href="{{ route('news.show', $post->slug) }}" class="inline-flex items-center gap-1.5 text-xs font-extrabold text-emerald-700 group-hover:gap-2 transition-all">
                                Baca <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-3 text-center py-20 bg-white rounded-3xl border border-slate-200 text-slate-400">
                    <i class="fa-regular fa-newspaper text-5xl mb-4 text-slate-300"></i>
                    <p class="text-base font-bold text-slate-700">Belum ada warta pasar yang cocok dengan kriteria pencarian.</p>
                    <p class="text-xs text-slate-500 mt-1">Coba gunakan kata kunci lain atau pilih Semua Kategori.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $posts->links() }}
        </div>

    </div>
</section>

@endsection
