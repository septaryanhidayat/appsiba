@extends('layouts.public')

@section('title', 'Beranda - DPD APPSI Kabupaten Banyuasin')

@section('content')

<!-- 1. HERO SECTION (Ciri Khas DPD APPSI Kabupaten Banyuasin) -->
<section class="relative isolate overflow-hidden bg-white" id="hero">
    <div class="grid w-full lg:min-h-[640px] lg:grid-cols-[50%_50%] xl:min-h-[700px]">
        
        <!-- Left Hero Content (Desktop Left, Mobile Main Flow) -->
        <div class="relative z-20 flex items-center px-5 pb-12 pt-8 sm:px-8 sm:py-12 lg:min-h-[640px] lg:px-0 lg:py-12 lg:pl-[clamp(48px,5.5vw,84px)] lg:pr-8 xl:min-h-[700px]" data-aos="fade-up">
            <div class="w-full max-w-xl mx-auto lg:mx-0 flex flex-col items-center lg:items-start text-center lg:text-left">
                
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 rounded-full bg-emerald-100/70 px-4 py-1.5 text-xs font-extrabold uppercase tracking-wide text-emerald-900 ring-1 ring-emerald-300 mx-auto lg:mx-0">
                    <span class="flex h-2 w-2 rounded-full bg-emerald-600 animate-pulse"></span>
                    DPD APPSI KABUPATEN BANYUASIN
                </div>

                <!-- Headline -->
                <h1 class="mt-4 text-[2.2rem] font-extrabold leading-[1.15] tracking-tight text-slate-900 sm:text-[2.6rem] lg:text-[2.9rem] xl:text-[3.2rem] text-center lg:text-left">
                    Bergabung dan jadilah bagian dari <span class="text-emerald-700">Asosiasi Pedagang Pasar Seluruh Indonesia</span> sekarang!
                </h1>

                <!-- Subtitle -->
                <p class="mt-5 text-base leading-[1.7] text-slate-600 sm:text-lg text-center lg:text-left mx-auto lg:mx-0">
                    Bersama memajukan pedagang pasar tradisional demi masa depan mandiri, kuat berdaya saing untuk kesejahteraan pedagang dan masyarakat Kabupaten Banyuasin.
                </p>

                <!-- Mobile-Only Foto Ketua (Tampil tepat setelah kalimat header hero di mobile) -->
                <div class="block lg:hidden my-6 w-full max-w-[320px] sm:max-w-[360px] mx-auto">
                    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-tr from-emerald-50 via-slate-50 to-white border border-emerald-100/90 shadow-sm p-4 pt-6 flex flex-col items-center justify-end">
                        
                        <!-- Floating Tagline Badge Mobile -->
                        <div class="inline-flex items-center gap-2 rounded-full bg-white/95 px-3 py-1 text-[11px] font-bold text-slate-800 ring-1 ring-emerald-500/20 shadow-sm mb-3">
                            <span class="flex h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span>Kuatkan Suara Pedagang</span>
                        </div>

                        <!-- Halo background ring -->
                        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 w-[220px] h-[220px] rounded-full border-2 border-dashed border-emerald-500/25 bg-emerald-100/30 pointer-events-none"></div>

                        <!-- Foto Ketua Mobile -->
                        <img src="{{ asset('assets/images/ketua-hero.webp') }}" 
                             alt="{{ $ketua->nama ?? 'H. Gusra Yetri, SH' }} - Ketua DPD APPSI Banyuasin" 
                             class="relative z-10 h-auto max-h-[300px] sm:max-h-[340px] w-auto object-contain object-bottom drop-shadow-[0_14px_28px_rgba(4,120,87,0.20)]"
                             loading="eager">

                        <!-- Identity Card Mobile -->
                        <div class="relative z-20 -mt-5 inline-flex items-center gap-2.5 rounded-xl bg-white/95 px-3.5 py-2 shadow-md ring-1 ring-emerald-500/20 backdrop-blur-sm">
                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-gradient-to-br from-emerald-600 to-emerald-800 text-white text-xs shadow-sm">
                                <i class="fa-solid fa-user-tie"></i>
                            </div>
                            <div class="text-left">
                                <div class="flex items-center gap-1">
                                    <h4 class="text-xs font-extrabold text-slate-900 leading-tight">
                                        {{ $ketua->nama ?? 'H. Gusra Yetri, SH' }}
                                    </h4>
                                    <span class="text-emerald-600 text-[10px]"><i class="fa-solid fa-circle-check"></i></span>
                                </div>
                                <p class="text-[10px] font-bold text-emerald-700">
                                    Ketua DPD APPSI Kab. Banyuasin
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CTA Buttons (Centered on mobile) -->
                <div class="mt-2 lg:mt-7 flex flex-col sm:flex-row justify-center lg:justify-start items-center gap-3 w-full sm:w-auto">
                    <a href="{{ route('members.register') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-xl font-bold transition duration-200 bg-emerald-700 text-white shadow-[0_10px_24px_rgba(21,128,61,0.22)] hover:bg-emerald-800 h-12 px-6 text-sm">
                        <i class="fa-solid fa-id-card text-sm"></i>
                        Daftar KTA Online
                    </a>
                    <a href="{{ route('programs.public') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-xl font-bold transition duration-200 border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 h-12 px-6 text-sm">
                        5 Pilar Program Kerja
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>

                <!-- 3 Pillars of APPSI Banyuasin (Centered on mobile) -->
                <div class="mt-10 grid gap-4 sm:grid-cols-3 pt-6 border-t border-slate-100 w-full text-center sm:text-left">
                    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-3">
                        <div class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-700 mx-auto sm:mx-0">
                            <i class="fa-solid fa-people-roof text-lg"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-900 sm:text-sm">Komunitas Pasar</p>
                            <p class="mt-0.5 text-[11px] leading-relaxed text-slate-500">Wadah pemersatu pedagang se-Kabupaten Banyuasin</p>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-3">
                        <div class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-700 mx-auto sm:mx-0">
                            <i class="fa-solid fa-shield-halved text-lg"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-900 sm:text-sm">Advokasi & Hak</p>
                            <p class="mt-0.5 text-[11px] leading-relaxed text-slate-500">Pendampingan hukum & perlindungan pedagang kecil</p>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-3">
                        <div class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-700 mx-auto sm:mx-0">
                            <i class="fa-solid fa-chart-line text-lg"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-900 sm:text-sm">Kapasitas & Modal</p>
                            <p class="mt-0.5 text-[11px] leading-relaxed text-slate-500">Fasilitasi kemitraan perbankan & KUR</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Right Hero Visual (Desktop Only - Large & Proportional) -->
        <div class="hidden lg:flex relative lg:min-h-full overflow-hidden bg-gradient-to-tr from-emerald-50/90 via-slate-50 to-white flex-col justify-end items-center" data-aos="fade-up">
            
            <!-- Ambient Glow Effect -->
            <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[560px] xl:w-[620px] h-[560px] xl:h-[620px] rounded-full bg-gradient-to-tr from-emerald-400/25 via-emerald-200/30 to-amber-200/25 blur-3xl pointer-events-none"></div>

            <!-- Architectural Ring Halos -->
            <div class="absolute bottom-16 left-1/2 -translate-x-1/2 w-[500px] h-[500px] xl:w-[560px] xl:h-[560px] rounded-full border-2 border-dashed border-emerald-500/25 bg-gradient-to-b from-white/90 via-emerald-50/50 to-transparent shadow-inner pointer-events-none"></div>
            <div class="absolute bottom-24 left-1/2 -translate-x-1/2 w-[420px] h-[420px] xl:w-[470px] xl:h-[470px] rounded-full bg-gradient-to-b from-emerald-100/60 to-emerald-50/30 border border-emerald-200/60 pointer-events-none"></div>
            
            <!-- Decorative Accent Patterns -->
            <div class="hero-dot-pattern absolute top-8 right-8 z-10 h-32 w-32 opacity-40 pointer-events-none"></div>
            <div class="hero-dot-pattern absolute bottom-16 left-6 z-10 h-24 w-24 opacity-30 pointer-events-none"></div>

            <!-- Floating Badge: Tagline -->
            <div class="absolute top-6 left-8 z-30 inline-flex items-center gap-2 rounded-2xl bg-white/95 px-3.5 py-2 shadow-[0_8px_20px_rgba(15,23,42,0.08)] ring-1 ring-emerald-500/20 backdrop-blur-md transition hover:-translate-y-0.5 whitespace-nowrap">
                <span class="flex h-2.5 w-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-xs font-bold text-slate-800 tracking-tight">Kuatkan Suara Pedagang</span>
            </div>

            <!-- Floating Badge: Masa Bakti -->
            <div class="absolute top-6 right-8 z-30 inline-flex items-center gap-1.5 rounded-2xl bg-emerald-800 text-white px-3.5 py-2 shadow-[0_8px_20px_rgba(4,120,87,0.25)] text-xs font-bold tracking-wide transition hover:-translate-y-0.5">
                <i class="fa-solid fa-award text-amber-300"></i>
                <span>Masa Bakti 2024 - 2029</span>
            </div>

            <!-- Ketua Cutout Photo Container (Enlarged & Proportional) -->
            <div class="relative z-20 flex flex-col items-center justify-end w-full px-4 pt-14">
                <div class="relative group flex items-end justify-center w-full">
                    <img src="{{ asset('assets/images/ketua-hero.webp') }}" 
                         alt="{{ $ketua->nama ?? 'H. Gusra Yetri, SH' }} - Ketua DPD APPSI Banyuasin" 
                         class="relative z-20 h-auto max-h-[580px] xl:max-h-[640px] w-auto max-w-[540px] xl:max-w-[600px] object-contain object-bottom drop-shadow-[0_22px_40px_rgba(4,120,87,0.22)] transition-transform duration-500 ease-out group-hover:scale-[1.02]"
                         loading="eager">
                </div>

                <!-- Floating Identity Card Overlapping Base -->
                <div class="relative z-30 -mt-8 mb-6 mx-auto inline-flex items-center gap-3.5 rounded-2xl bg-white/95 px-5 py-3 shadow-[0_16px_36px_rgba(15,23,42,0.12)] ring-1 ring-emerald-500/25 backdrop-blur-md transition duration-300 hover:shadow-[0_20px_42px_rgba(15,23,42,0.16)] hover:-translate-y-0.5">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-600 to-emerald-800 text-white shadow-md shadow-emerald-700/25">
                        <i class="fa-solid fa-user-tie text-lg"></i>
                    </div>
                    <div class="text-left">
                        <div class="flex items-center gap-1.5">
                            <h3 class="text-sm sm:text-base font-extrabold text-slate-900 leading-tight">
                                {{ $ketua->nama ?? 'H. Gusra Yetri, SH' }}
                            </h3>
                            <span class="inline-flex items-center justify-center h-4 w-4 rounded-full bg-emerald-100 text-emerald-700 text-[10px]" title="Ketua Resmi">
                                <i class="fa-solid fa-check"></i>
                            </span>
                        </div>
                        <p class="text-xs font-bold text-emerald-700 mt-0.5">
                            Ketua DPD APPSI Kab. Banyuasin
                        </p>
                    </div>
                </div>
            </div>

            <!-- Bottom Gradient Overlay -->
            <div class="absolute bottom-0 inset-x-0 h-10 bg-gradient-to-t from-white via-white/50 to-transparent z-10 pointer-events-none"></div>
        </div>

    </div>
</section>

<!-- QUICK ACTION BAR: LAYANAN CEPAT PEDAGANG -->
<section class="border-y border-slate-200/80 bg-slate-50 py-5" data-aos="fade-up">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3.5">
            <a href="{{ route('members.register') }}" class="flex flex-col sm:flex-row items-center sm:items-start text-center sm:text-left gap-2.5 sm:gap-3 p-3 rounded-xl bg-white border border-slate-200/80 hover:border-emerald-500 hover:shadow-sm transition group">
                <div class="h-10 w-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 group-hover:bg-emerald-700 group-hover:text-white transition mx-auto sm:mx-0">
                    <i class="fa-solid fa-address-card text-base"></i>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-slate-900 group-hover:text-emerald-700 transition">Daftar KTA Online</h4>
                    <p class="text-[10px] text-slate-500">Gratis untuk pedagang</p>
                </div>
            </a>

            <a href="{{ route('members.check') }}" class="flex flex-col sm:flex-row items-center sm:items-start text-center sm:text-left gap-2.5 sm:gap-3 p-3 rounded-xl bg-white border border-slate-200/80 hover:border-emerald-500 hover:shadow-sm transition group">
                <div class="h-10 w-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 group-hover:bg-emerald-700 group-hover:text-white transition mx-auto sm:mx-0">
                    <i class="fa-solid fa-id-badge text-base"></i>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-slate-900 group-hover:text-emerald-700 transition">Cek Validasi KTA</h4>
                    <p class="text-[10px] text-slate-500">Periksa status keanggotaan</p>
                </div>
            </a>

            <a href="{{ route('letter.verify.index') }}" class="flex flex-col sm:flex-row items-center sm:items-start text-center sm:text-left gap-2.5 sm:gap-3 p-3 rounded-xl bg-white border border-slate-200/80 hover:border-emerald-500 hover:shadow-sm transition group">
                <div class="h-10 w-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 group-hover:bg-emerald-700 group-hover:text-white transition mx-auto sm:mx-0">
                    <i class="fa-solid fa-qrcode text-base"></i>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-slate-900 group-hover:text-emerald-700 transition">Verifikasi Surat</h4>
                    <p class="text-[10px] text-slate-500">Keabsahan surat resmi DPD</p>
                </div>
            </a>

            <a href="#aspirasi" class="flex flex-col sm:flex-row items-center sm:items-start text-center sm:text-left gap-2.5 sm:gap-3 p-3 rounded-xl bg-white border border-slate-200/80 hover:border-emerald-500 hover:shadow-sm transition group">
                <div class="h-10 w-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 group-hover:bg-emerald-700 group-hover:text-white transition mx-auto sm:mx-0">
                    <i class="fa-solid fa-comments text-base"></i>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-slate-900 group-hover:text-emerald-700 transition">Aspirasi Pasar</h4>
                    <p class="text-[10px] text-slate-500">Sampaikan aduan & usulan</p>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- 2. BERITA TERKINI SECTION (6 Berita Langsung Ditampilkan) -->
<section class="bg-white py-14 sm:py-20 border-t border-slate-100" id="posts">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8">
        
        <div class="mb-10 flex flex-col items-center sm:items-start text-center sm:text-left gap-4 sm:flex-row sm:items-end sm:justify-between" data-aos="fade-up">
            <div>
                <span class="inline-block rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-bold uppercase tracking-widest text-emerald-800 border border-emerald-200 mx-auto sm:mx-0">
                    WARTA & PUBLIKASI RESMI
                </span>
                <h2 class="mt-2 text-2xl font-extrabold text-slate-900 sm:text-3xl lg:text-4xl tracking-tight">
                    Kabar Pasar & Berita <span class="text-emerald-700">Terkini</span>
                </h2>
                <p class="mt-1 text-sm text-slate-500 max-w-xl mx-auto sm:mx-0">Informasi seputar pergerakan harga komoditas, program kerja, dan advokasi pedagang se-Banyuasin.</p>
            </div>
            <a href="{{ route('news.index') }}" class="inline-flex items-center justify-center gap-2 text-sm font-bold text-emerald-800 hover:text-emerald-600 transition shrink-0 mx-auto sm:mx-0">
                <span>Lihat semua berita</span>
                <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>

        <!-- 6 News Cards Grid (2 Rows x 3 Columns) -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($posts as $post)
                <article class="group flex flex-col overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-md hover:border-emerald-300" data-aos="fade-up">
                    <div class="relative h-48 w-full overflow-hidden bg-slate-100">
                        <img src="{{ $post->gambar_url }}" alt="{{ $post->judul }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                        <span class="absolute left-3.5 top-3.5 rounded-lg bg-emerald-700/90 backdrop-blur-sm px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-white shadow">
                            {{ $post->kategori }}
                        </span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2 text-xs text-slate-500 font-medium">
                                <i class="fa-regular fa-calendar-check text-emerald-600"></i>
                                <span>{{ $post->published_at ? $post->published_at->translatedFormat('d F Y') : date('d M Y') }}</span>
                            </div>
                            <h3 class="mt-3 text-base font-bold leading-snug text-slate-900 line-clamp-2 group-hover:text-emerald-700 transition">
                                <a href="{{ route('news.show', $post->slug) }}">{{ $post->judul }}</a>
                            </h3>
                            <p class="mt-2 text-xs leading-relaxed text-slate-600 line-clamp-3">
                                {{ $post->ringkasan ?? Str::limit(strip_tags($post->konten), 110) }}
                            </p>
                        </div>
                        <div class="mt-5 pt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                            <span class="text-slate-400 font-medium"><i class="fa-regular fa-clock mr-1"></i> 3 mnt baca</span>
                            <a href="{{ route('news.show', $post->slug) }}" class="inline-flex items-center gap-1.5 font-bold text-emerald-700 group-hover:text-emerald-800 group-hover:gap-2.5 transition-all">
                                <span>Baca selengkapnya</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-3 text-center py-12 text-slate-400">
                    Belum ada berita terbit.
                </div>
            @endforelse
        </div>

    </div>
</section>

<!-- 3. AGENDA & ACARA PASAR -->
<section class="bg-slate-50/80 py-14 sm:py-18 border-t border-slate-200/60" id="agenda">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8">
        
        <div class="mb-8 flex flex-col items-center sm:items-start text-center sm:text-left gap-3 sm:flex-row sm:items-end sm:justify-between" data-aos="fade-up">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 mx-auto sm:mx-0">AGENDA KEGIATAN</span>
                <h2 class="mt-1 text-2xl font-extrabold text-slate-900 sm:text-3xl">
                    Acara yang Akan Datang
                </h2>
            </div>
            <span class="text-sm font-medium text-slate-500 text-center sm:text-right">Koordinasi & Musyawarah Pasar Daerah</span>
        </div>

        <div class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm" data-aos="fade-up">
            
            <!-- Event 1 -->
            <article class="grid gap-4 border-b border-slate-100 p-5 sm:grid-cols-[92px_1fr] lg:grid-cols-[92px_1fr_260px] hover:bg-slate-50/50 transition">
                <div class="flex h-full min-h-[96px] w-full sm:w-[92px] flex-col items-center justify-center rounded-xl bg-emerald-700 text-white mx-auto">
                    <span class="text-3xl font-extrabold leading-none">28</span>
                    <span class="mt-1 text-xs font-bold uppercase tracking-wider">JUN</span>
                    <span class="text-xs font-medium opacity-80">2026</span>
                </div>
                <div class="self-center py-1 sm:pr-6 text-center sm:text-left flex flex-col items-center sm:items-start">
                    <span class="inline-block rounded-full bg-emerald-50 px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-emerald-700 border border-emerald-100 mx-auto sm:mx-0">
                        PELAKSANAAN KEGIATAN
                    </span>
                    <h3 class="mt-2 text-base font-bold text-slate-900 sm:text-lg">
                        Rapat Koordinasi Penataan Kios & Distribusi Minyak Goreng Subsidi
                    </h3>
                    <p class="mt-1.5 text-sm text-slate-600 leading-relaxed">
                        Pertemuan pengurus DPD APPSI bersama perwakilan pedagang sembako dan Dinas Perdagangan Kab. Banyuasin.
                    </p>
                </div>
                <div class="flex flex-col items-center sm:items-start justify-center gap-2.5 border-slate-100 pt-3 lg:border-l lg:pl-7 lg:pt-0 text-center sm:text-left">
                    <div class="flex items-center gap-2 text-xs text-slate-600">
                        <i class="fa-solid fa-location-dot text-emerald-700"></i>
                        <span>Pasar Pangkalan Balai, Banyuasin III</span>
                    </div>
                    <div class="flex items-center gap-2 text-xs text-slate-600">
                        <i class="fa-regular fa-clock text-emerald-700"></i>
                        <span>09.00 WIB - Selesai</span>
                    </div>
                    <a href="#aspirasi" class="inline-flex items-center justify-center gap-2 rounded-xl font-semibold border border-emerald-200 bg-white text-emerald-800 hover:bg-emerald-50 h-9 px-3 text-xs w-full max-w-xs sm:max-w-none mx-auto sm:mx-0 transition">
                        Hubungi Panitia
                    </a>
                </div>
            </article>

            <!-- Event 2 -->
            <article class="grid gap-4 p-5 sm:grid-cols-[92px_1fr] lg:grid-cols-[92px_1fr_260px] hover:bg-slate-50/50 transition">
                <div class="flex h-full min-h-[96px] w-full sm:w-[92px] flex-col items-center justify-center rounded-xl bg-emerald-700 text-white mx-auto">
                    <span class="text-3xl font-extrabold leading-none">05</span>
                    <span class="mt-1 text-xs font-bold uppercase tracking-wider">JUL</span>
                    <span class="text-xs font-medium opacity-80">2026</span>
                </div>
                <div class="self-center py-1 sm:pr-6 text-center sm:text-left flex flex-col items-center sm:items-start">
                    <span class="inline-block rounded-full bg-emerald-50 px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-emerald-700 border border-emerald-100 mx-auto sm:mx-0">
                        PELATIHAN & UMKM
                    </span>
                    <h3 class="mt-2 text-base font-bold text-slate-900 sm:text-lg">
                        Sosialisasi Pembayaran Non-Tunai QRIS & Fasilitasi KUR Mikro
                    </h3>
                    <p class="mt-1.5 text-sm text-slate-600 leading-relaxed">
                        Pendampingan literasi keuangan dan standarisasi barcode perbankan bagi pedagang pasar binaan APPSI.
                    </p>
                </div>
                <div class="flex flex-col items-center sm:items-start justify-center gap-2.5 border-slate-100 pt-3 lg:border-l lg:pl-7 lg:pt-0 text-center sm:text-left">
                    <div class="flex items-center gap-2 text-xs text-slate-600">
                        <i class="fa-solid fa-location-dot text-emerald-700"></i>
                        <span>Pasar Betung, Kec. Betung</span>
                    </div>
                    <div class="flex items-center gap-2 text-xs text-slate-600">
                        <i class="fa-regular fa-clock text-emerald-700"></i>
                        <span>08.30 WIB - Selesai</span>
                    </div>
                    <a href="#aspirasi" class="inline-flex items-center justify-center gap-2 rounded-xl font-semibold border border-emerald-200 bg-white text-emerald-800 hover:bg-emerald-50 h-9 px-3 text-xs w-full max-w-xs sm:max-w-none mx-auto sm:mx-0 transition">
                        Hubungi Panitia
                    </a>
                </div>
            </article>

        </div>

    </div>
</section>

<!-- 4. KEANGGOTAAN APPSI (Foto 1 diganti dengan Ketua APPSI Banyuasin Angkat Tangan) -->
<section class="relative overflow-hidden bg-white py-14 sm:py-20 border-t border-slate-100" id="keanggotaan">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8 grid items-center gap-10 lg:grid-cols-[1fr_0.96fr]">
        
        <!-- Left Visual: Foto Ketua APPSI Banyuasin Semangat -->
        <div class="relative" data-aos="fade-up">
            <div class="relative overflow-hidden h-[340px] sm:h-[420px] rounded-3xl bg-gradient-to-tr from-emerald-100 via-emerald-50 to-white border border-emerald-200/80 shadow-[0_16px_40px_rgba(4,120,87,0.12)] flex items-end justify-center">
                
                <!-- Ambient circles & dots -->
                <div class="hero-dot-pattern absolute top-4 left-4 h-24 w-24 opacity-40 pointer-events-none"></div>
                <div class="absolute -top-12 -right-12 w-48 h-48 rounded-full bg-emerald-300/20 blur-2xl pointer-events-none"></div>
                
                <!-- Foto Ketua APPSI Banyuasin -->
                <img src="{{ asset('assets/images/ketua-semangat.png') }}" 
                     alt="H. Gusra Yetri, SH - Ketua DPD APPSI Kabupaten Banyuasin" 
                     class="relative z-10 h-full w-auto max-h-[340px] sm:max-h-[420px] object-contain object-bottom transition duration-500 hover:scale-105">

                <!-- Floating leadership caption bar -->
                <div class="absolute bottom-4 inset-x-4 z-20 rounded-2xl bg-white/95 p-3 shadow-lg border border-emerald-100 backdrop-blur-md flex items-center gap-3">
                    <div class="h-10 w-10 rounded-xl bg-emerald-700 text-white flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-hand-fist text-lg"></i>
                    </div>
                    <div>
                        <p class="text-xs font-extrabold text-slate-900 leading-tight">H. Gusra Yetri, SH</p>
                        <p class="text-[11px] font-semibold text-emerald-700">Ketua DPD APPSI Kabupaten Banyuasin</p>
                    </div>
                </div>
            </div>

            <div class="hero-dot-pattern absolute -bottom-6 -left-4 h-24 w-24 opacity-60 pointer-events-none"></div>
            <div class="absolute -bottom-3 left-4 h-20 w-20 rounded-full bg-emerald-700/80 pointer-events-none"></div>
        </div>

        <!-- Right Content -->
        <div class="relative flex flex-col items-center lg:items-start text-center lg:text-left" data-aos="fade-up">
            <span class="inline-block rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-bold uppercase tracking-widest text-emerald-800 border border-emerald-200 mx-auto lg:mx-0">
                DPD APPSI KABUPATEN BANYUASIN
            </span>
            <h2 class="mt-3 max-w-xl text-3xl font-extrabold leading-tight text-slate-900 sm:text-4xl text-center lg:text-left">
                Bersatu, Berdaya, Berkarya untuk Pasar Banyuasin
            </h2>
            <p class="mt-4 max-w-xl text-sm leading-7 text-slate-600 text-center lg:text-left mx-auto lg:mx-0">
                DPD APPSI hadir mengayomi para pedagang pasar tradisional di seluruh kecamatan Kabupaten Banyuasin melalui penguatan Komisariat Pasar, advokasi harga, perlindungan legalitas usaha, dan fasilitasi modal kerja tanpa jeratan rentenir.
            </p>

            <!-- Metrics -->
            <div class="mt-7 grid gap-4 sm:grid-cols-2 w-full">
                <div class="flex flex-col sm:flex-row items-center sm:items-start text-center sm:text-left gap-4 rounded-2xl border border-slate-100 bg-white p-5 shadow-[0_10px_28px_rgba(15,23,42,0.05)]">
                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-emerald-50 text-emerald-700 mx-auto sm:mx-0">
                        <i class="fa-solid fa-users-viewfinder text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-extrabold text-emerald-800">{{ $stats['total_anggota'] ?: 10 }}</p>
                        <p class="text-sm font-semibold text-slate-800">Pedagang Anggota</p>
                        <p class="mt-0.5 text-xs text-slate-500">Terdaftar aktif di sistem DPD</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center sm:items-start text-center sm:text-left gap-4 rounded-2xl border border-slate-100 bg-white p-5 shadow-[0_10px_28px_rgba(15,23,42,0.05)]">
                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-emerald-50 text-emerald-700 mx-auto sm:mx-0">
                        <i class="fa-solid fa-store text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-extrabold text-emerald-800">{{ $stats['total_pasar'] ?: 5 }}</p>
                        <p class="text-sm font-semibold text-slate-800">Pasar Tradisional</p>
                        <p class="mt-0.5 text-xs text-slate-500">Ruang binaan DPD di Banyuasin</p>
                    </div>
                </div>
            </div>

            <!-- Action Button -->
            <div class="mt-7 flex flex-col sm:flex-row justify-center lg:justify-start items-center gap-3 w-full sm:w-auto">
                <a href="{{ route('members.register') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-xl font-bold transition duration-200 bg-emerald-700 text-white shadow-[0_10px_24px_rgba(21,128,61,0.2)] hover:bg-emerald-800 h-11 px-6 text-sm">
                    Daftar Keanggotaan
                    <i class="fa-solid fa-user-plus text-xs"></i>
                </a>
                <a href="{{ route('members.public') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-xl font-bold transition duration-200 border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 h-11 px-5 text-sm">
                    Lihat Direktori Pedagang
                </a>
            </div>
        </div>

    </div>
</section>

<!-- 5. SLIDER FOTO KEGIATAN APPSI BANYUASIN (Interactive Modern Carousel) -->
<section class="bg-gradient-to-b from-slate-50 to-emerald-50/40 py-14 sm:py-20 border-t border-slate-200/70" id="galeri-slider"
         x-data="{
            active: 0,
            slides: [
                {
                    title: 'Sosialisasi Digitalisasi QRIS di Pasar Pangkalan Balai',
                    category: 'Digitalisasi Pasar',
                    image: '{{ asset('assets/images/berita/berita-qris-digital.jpg') }}',
                    desc: 'Edukasi dan pendampingan transaksi non-tunai bersama perbankan daerah bagi pedagang sayur dan sembako.'
                },
                {
                    title: 'Operasi Pasar Pangan Murah Sembako di Betung',
                    category: 'Stabilisasi Harga',
                    image: '{{ asset('assets/images/berita/berita-operasi-pasar.jpg') }}',
                    desc: 'Distribusi beras medium dan minyak goreng terjangkau untuk menekan laju inflasi bahan pokok masyarakat.'
                },
                {
                    title: 'Pengawasan Tera Ulang Timbangan Pasar Pangkalan Balai',
                    category: 'Tera Timbangan',
                    image: '{{ asset('assets/images/berita/kegiatan-timbangan-tera.jpg') }}',
                    desc: 'Kerjasama DPD APPSI dan Dinas Perindagkop memastikan keakuratan timbangan pedagang demi jual beli yang jujur.'
                },
                {
                    title: 'Pelatihan Pembukuan & Literasi Keuangan Pedagang Wanita',
                    category: 'Pemberdayaan UMKM',
                    image: '{{ asset('assets/images/berita/kegiatan-pelatihan-wanita.jpg') }}',
                    desc: 'Peningkatan kapasitas pengelolaan arus kas dan literasi perbankan formal bagi pedagang pasar perempuan.'
                },
                {
                    title: 'Fasilitasi Akses KUR & Permodalan Usaha di Sukajadi',
                    category: 'Permodalan KUR',
                    image: '{{ asset('assets/images/berita/berita-permodalan-kur.jpg') }}',
                    desc: 'Dialog kemitraan bank demi membebaskan pedagang pasar dari jeratan rentenir dengan suku bunga rendah.'
                },
                {
                    title: 'Advokasi Sanitasi & Drainase Los Basah Pasar Sungsang',
                    category: 'Advokasi Sarana',
                    image: '{{ asset('assets/images/berita/berita-pasar-sungsang.jpg') }}',
                    desc: 'Peninjauan langsung sarana pembuangan air dan dermaga sandar pasokan ikan nelayan muara pesisir.'
                },
                {
                    title: 'Rembug Akbar Pengurus Komisariat Pasar se-Kabupaten Banyuasin',
                    category: 'Konsolidasi',
                    image: '{{ asset('assets/images/berita/berita-musyawarah-appsi.jpg') }}',
                    desc: 'Konsolidasi pimpinan komisariat dari 21 kecamatan merumuskan kebijakan penataan lapak yang harmonis.'
                },
                {
                    title: 'Konsolidasi Nasional & Musyawarah Akbar APPSI',
                    category: 'Kongres Nasional',
                    image: '{{ asset('assets/images/berita/munas-appsi.jpg') }}',
                    desc: 'Penguatan jaringan pedagang pasar tradisional di tingkat provinsi dan nasional demi ekonomi kerakyatan.'
                }
            ],
            timer: null,
            startAuto() {
                this.timer = setInterval(() => {
                    this.next();
                }, 4500);
            },
            stopAuto() {
                if (this.timer) clearInterval(this.timer);
            },
            next() {
                this.active = (this.active + 1) % this.slides.length;
            },
            prev() {
                this.active = (this.active - 1 + this.slides.length) % this.slides.length;
            }
         }"
         x-init="startAuto()"
         @mouseenter="stopAuto()"
         @mouseleave="startAuto()">
    
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8">
        
        <!-- Header Slider -->
        <div class="mb-8 flex flex-col items-center sm:items-start text-center sm:text-left sm:flex-row sm:items-end sm:justify-between gap-4" data-aos="fade-up">
            <div>
                <span class="inline-block rounded-md bg-emerald-100 px-2.5 py-1 text-xs font-bold uppercase tracking-widest text-emerald-900 mx-auto sm:mx-0">
                    DOKUMENTASI LAPANGAN
                </span>
                <h2 class="mt-2 text-2xl font-extrabold text-slate-900 sm:text-3xl text-center sm:text-left">
                    Galeri Kegiatan & Aksi Nyata <span class="text-emerald-700">APPSI Banyuasin</span>
                </h2>
                <p class="mt-1 text-sm text-slate-500 max-w-xl mx-auto sm:mx-0">Dokumentasi kegiatan resmi pendampingan, permodalan, dan advokasi pedagang di lapangan.</p>
            </div>

            <!-- Controls (Next/Prev) -->
            <div class="flex items-center justify-center sm:justify-end gap-2 mx-auto sm:mx-0">
                <button @click="prev()" type="button" class="h-10 w-10 rounded-full border border-slate-300 bg-white text-slate-700 hover:bg-emerald-700 hover:text-white hover:border-emerald-700 shadow-sm flex items-center justify-center transition" aria-label="Sebelumnya">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                </button>
                <button @click="next()" type="button" class="h-10 w-10 rounded-full border border-slate-300 bg-white text-slate-700 hover:bg-emerald-700 hover:text-white hover:border-emerald-700 shadow-sm flex items-center justify-center transition" aria-label="Berikutnya">
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </button>
            </div>
        </div>

        <!-- Slider Main Showcase -->
        <div class="relative overflow-hidden rounded-3xl bg-slate-900 shadow-xl" data-aos="fade-up">
            <div class="relative h-[340px] sm:h-[440px] lg:h-[500px] w-full">
                
                <template x-for="(slide, index) in slides" :key="index">
                    <div x-show="active === index" 
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 scale-98"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-98"
                         class="absolute inset-0">
                        
                        <!-- Slide Image -->
                        <img :src="slide.image" :alt="slide.title" class="h-full w-full object-cover">
                        
                        <!-- Dark Gradient Overlay for text readability -->
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/40 to-transparent"></div>

                        <!-- Slide Content -->
                        <div class="absolute bottom-0 inset-x-0 p-6 sm:p-8 lg:p-10 text-white flex flex-col items-center sm:items-start text-center sm:text-left">
                            <span class="inline-block rounded-md bg-emerald-600 px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-white shadow-sm mx-auto sm:mx-0" x-text="slide.category"></span>
                            <h3 class="mt-2.5 text-xl sm:text-2xl lg:text-3xl font-extrabold max-w-2xl leading-snug" x-text="slide.title"></h3>
                            <p class="mt-2 text-xs sm:text-sm text-slate-300 max-w-xl leading-relaxed" x-text="slide.desc"></p>
                        </div>
                    </div>
                </template>

            </div>

            <!-- Slide Dot Indicators -->
            <div class="absolute top-4 right-4 sm:top-6 sm:right-6 z-20 flex items-center gap-1.5 bg-black/40 backdrop-blur-md px-3 py-1.5 rounded-full border border-white/10">
                <template x-for="(slide, index) in slides" :key="index">
                    <button @click="active = index" 
                            type="button"
                            :class="active === index ? 'w-6 bg-emerald-400' : 'w-2 bg-white/40 hover:bg-white/70'"
                            class="h-2 rounded-full transition-all duration-300" 
                            :aria-label="'Buka slide ' + (index + 1)">
                    </button>
                </template>
            </div>
        </div>

        <!-- Bottom Link to Gallery -->
        <div class="mt-6 text-center">
            <a href="{{ route('gallery.public') }}" class="inline-flex items-center gap-2 text-xs sm:text-sm font-bold text-emerald-800 hover:text-emerald-600 transition">
                <span>Lihat Semua Dokumentasi Foto & Kegiatan</span>
                <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>

    </div>
</section>

<!-- 6. BANNER DUKUNG PERJUANGAN & FORMULIR BUKU TAMU / ASPIRASI -->
<section class="bg-white py-14 sm:py-20 border-t border-slate-100" id="aspirasi">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8">
        
        <!-- Support Banner -->
        <div class="flex flex-col items-center text-center md:flex-row md:items-center md:justify-between md:text-left gap-6 rounded-[1.35rem] bg-emerald-50/90 p-6 ring-1 ring-emerald-200 sm:p-8 mb-12 shadow-sm" data-aos="fade-up">
            <div class="flex flex-col items-center text-center sm:flex-row sm:items-center sm:text-left gap-5">
                <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-white text-emerald-700 shadow-sm mx-auto sm:mx-0">
                    <i class="fa-solid fa-handshake-angle text-3xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-emerald-900 sm:text-2xl">Dukung Perjuangan Pedagang Pasar</h3>
                    <p class="mt-1 text-sm text-slate-600 max-w-xl mx-auto sm:mx-0">
                        Aspirasi, saran, dan dukungan Anda adalah energi bagi kami untuk terus memperkuat pedagang pasar tradisional demi kemajuan ekonomi kerakyatan Banyuasin.
                    </p>
                </div>
            </div>
            <a href="#form-aspirasi" class="inline-flex items-center justify-center gap-2 rounded-xl font-bold transition bg-emerald-700 text-white hover:bg-emerald-800 h-11 px-5 text-xs uppercase tracking-wider shrink-0 shadow mx-auto md:mx-0">
                Kirim Aspirasi Sekarang
                <i class="fa-solid fa-paper-plane text-xs"></i>
            </a>
        </div>

        <!-- Guestbook / Aspirasi Form -->
        <div class="grid lg:grid-cols-12 gap-8 items-start" id="form-aspirasi" data-aos="fade-up">
            
            <div class="lg:col-span-5 flex flex-col items-center lg:items-start text-center lg:text-left">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 mx-auto lg:mx-0">SUARA PEDAGANG</span>
                <h3 class="mt-1 text-2xl font-extrabold text-slate-900 text-center lg:text-left">
                    Buku Tamu & Aspirasi Pasar
                </h3>
                <p class="mt-3 text-sm text-slate-600 leading-relaxed text-center lg:text-left mx-auto lg:mx-0">
                    Sampaikan keluhan fasilitas pasar, kestabilan harga barang, usulan penataan lapak, atau kemitraan usaha langsung kepada jajaran Pengurus DPD APPSI Kabupaten Banyuasin.
                </p>

                <div class="mt-6 space-y-3.5">
                    <div class="flex items-center gap-3 text-sm text-slate-700 bg-slate-50 p-3.5 rounded-xl border border-slate-200/70 shadow-sm">
                        <i class="fa-solid fa-envelope-circle-check text-emerald-700 text-lg"></i>
                        <span>Respon cepat dari tim sekretariat DPD</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm text-slate-700 bg-slate-50 p-3.5 rounded-xl border border-slate-200/70 shadow-sm">
                        <i class="fa-solid fa-scale-balanced text-emerald-700 text-lg"></i>
                        <span>Penyaluran aspirasi resmi ke dinas & pemkab</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm text-slate-700 bg-slate-50 p-3.5 rounded-xl border border-slate-200/70 shadow-sm">
                        <i class="fa-brands fa-whatsapp text-emerald-700 text-lg"></i>
                        <span>Layanan Hotline WA: <strong>0811 618 808</strong></span>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7">
                <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 shadow-sm">
                    <form action="{{ route('inbox.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Lengkap *</label>
                                <input type="text" name="nama" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600" placeholder="Nama Anda">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">No. WhatsApp / HP</label>
                                <input type="text" name="telepon" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600" placeholder="Contoh: 08123456789">
                            </div>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Usaha / Pasar</label>
                                <input type="text" name="instansi" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600" placeholder="Contoh: Pedagang Pasar Pangkalan Balai">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Tujuan Pesan</label>
                                <select name="tujuan" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600">
                                    <option value="Ketua DPD APPSI Kabupaten Banyuasin">Ketua DPD APPSI Banyuasin</option>
                                    <option value="Bidang Advokasi & Perlindungan Pedagang">Bidang Advokasi & Hukum</option>
                                    <option value="Bidang Sarana & Penataan Pasar">Bidang Sarana Pasar</option>
                                    <option value="Sekretariat DPD APPSI">Sekretariat Umum</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Keperluan / Topik *</label>
                            <input type="text" name="keperluan" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600" placeholder="Contoh: Pengaduan Fasilitas Air / Permohonan Kemitraan">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Isi Aspirasi / Pesan *</label>
                            <textarea name="pesan" rows="4" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600" placeholder="Tuliskan aspirasi, masukan, atau kendala yang dihadapi di pasar..."></textarea>
                        </div>

                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-700 py-3 text-sm font-bold text-white shadow hover:bg-emerald-800 transition">
                            <i class="fa-solid fa-paper-plane text-xs"></i>
                            Kirim Aspirasi Sekarang
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </div>
</section>

@endsection
