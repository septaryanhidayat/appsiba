@extends('layouts.public')

@section('title', 'Beranda - Portal Resmi DPD APPSI Kabupaten Banyuasin')

@section('content')

<!-- 1. HERO SECTION (International Executive Split Hero with Ambient Glow Mesh) -->
<section class="relative isolate overflow-hidden bg-gradient-to-b from-white via-emerald-50/25 to-white pt-6 pb-16 sm:py-20 lg:py-24" id="hero">
    
    <!-- Ambient Blur Background Elements -->
    <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-[700px] h-[350px] bg-gradient-to-tr from-emerald-400/15 via-teal-300/10 to-amber-200/15 rounded-full blur-3xl pointer-events-none -z-10"></div>
    <div class="hero-pattern-dots absolute inset-0 opacity-[0.22] pointer-events-none -z-10"></div>

    <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid items-center gap-12 lg:grid-cols-12 lg:gap-8">
            
            <!-- Left Hero Content (7 Cols on Desktop) -->
            <div class="lg:col-span-7 reveal-fade-up">
                
                <!-- Live Pill Badge -->
                <div class="inline-flex items-center gap-2.5 rounded-full bg-white/90 px-4 py-1.5 text-xs font-extrabold text-emerald-900 shadow-[0_4px_14px_rgba(6,78,59,0.08)] ring-1 ring-emerald-600/20 backdrop-blur-md">
                    <span class="flex h-2.5 w-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>PORTAL RESMI DPD APPSI KABUPATEN BANYUASIN</span>
                </div>

                <!-- Headline -->
                <h1 class="mt-5 text-3xl font-black leading-[1.14] tracking-tight text-slate-900 sm:text-4xl lg:text-5xl xl:text-[3.25rem]">
                    Membangun Pasar Rakyat yang <span class="bg-gradient-to-r from-emerald-700 via-teal-700 to-emerald-900 bg-clip-text text-transparent">Kuat, Mandiri</span> & Berdaya Saing Global
                </h1>

                <!-- Subtitle -->
                <p class="mt-5 text-base leading-relaxed text-slate-600 sm:text-lg sm:leading-8 max-w-2xl">
                    Wadah terpadu perlindungan hukum, permodalan usaha tanpa jeratan rentenir, digitalisasi transaksi QRIS, dan revitalisasi fasilitas bagi ribuan pedagang pasar tradisional di 21 kecamatan Kabupaten Banyuasin.
                </p>

                <!-- Primary CTA Group -->
                <div class="mt-8 flex flex-wrap items-center gap-3.5 sm:gap-4">
                    <a href="{{ route('members.register') }}" class="inline-flex items-center justify-center gap-2.5 rounded-2xl font-extrabold transition-all duration-200 bg-gradient-to-r from-emerald-700 to-teal-800 text-white shadow-[0_12px_28px_rgba(4,120,87,0.30)] hover:from-emerald-800 hover:to-teal-900 hover:shadow-[0_16px_34px_rgba(4,120,87,0.40)] hover:-translate-y-0.5 h-13 px-7 text-sm tracking-wide">
                        <i class="fa-solid fa-user-plus text-sm"></i>
                        Daftar Anggota KTA (Gratis)
                    </a>
                    <a href="{{ route('programs.public') }}" class="inline-flex items-center justify-center gap-2.5 rounded-2xl font-bold transition-all duration-200 border border-slate-300 bg-white/90 text-slate-800 hover:border-emerald-600 hover:bg-emerald-50 hover:text-emerald-900 hover:-translate-y-0.5 h-13 px-6 text-sm backdrop-blur-sm shadow-sm">
                        Eksplorasi 5 Pilar Program
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>

                <!-- Key Value Metrics Strip -->
                <div class="mt-10 pt-8 border-t border-slate-200/80 grid grid-cols-3 gap-4 sm:gap-6">
                    <div>
                        <div class="text-2xl sm:text-3xl font-black text-emerald-800 tracking-tight">
                            {{ number_format($stats['total_anggota'] ?? 450) }}+
                        </div>
                        <p class="text-xs font-semibold text-slate-500 mt-1">Pedagang Terdata</p>
                    </div>
                    <div>
                        <div class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                            {{ $stats['total_pasar'] ?? 18 }}
                        </div>
                        <p class="text-xs font-semibold text-slate-500 mt-1">Pasar Tradisional</p>
                    </div>
                    <div>
                        <div class="text-2xl sm:text-3xl font-black text-emerald-700 tracking-tight">
                            100%
                        </div>
                        <p class="text-xs font-semibold text-slate-500 mt-1">Advokasi & Binaan</p>
                    </div>
                </div>

            </div>

            <!-- Right Hero Visual with Ketua & Luxury Glass Accents (5 Cols on Desktop) -->
            <div class="lg:col-span-5 relative flex justify-center items-end min-h-[440px] sm:min-h-[500px] lg:min-h-[580px] reveal-fade-up delay-200">
                
                <!-- Concentric Ambient Rings -->
                <div class="absolute bottom-6 left-1/2 -translate-x-1/2 w-[320px] sm:w-[420px] lg:w-[460px] h-[320px] sm:h-[420px] lg:h-[460px] rounded-full bg-gradient-to-tr from-emerald-100/70 via-teal-50/50 to-amber-100/40 border border-emerald-200/50 shadow-inner pointer-events-none"></div>
                <div class="absolute bottom-12 left-1/2 -translate-x-1/2 w-[260px] sm:w-[350px] lg:w-[380px] h-[260px] sm:h-[350px] lg:h-[380px] rounded-full border border-dashed border-emerald-400/40 pointer-events-none animate-spin" style="animation-duration: 60s;"></div>

                <!-- Floating Glass Card 1 (Top Left): Verified Leadership -->
                <div class="absolute top-8 -left-2 sm:left-2 z-20 flex items-center gap-3 rounded-2xl bg-white/90 px-4 py-3 shadow-[0_14px_30px_rgba(15,23,42,0.08)] ring-1 ring-emerald-500/20 backdrop-blur-xl animate-float">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-600 to-teal-700 text-white shadow-sm">
                        <i class="fa-solid fa-shield-check text-base"></i>
                    </div>
                    <div>
                        <p class="text-xs font-extrabold text-slate-900 leading-tight">Kepemimpinan Resmi</p>
                        <p class="text-[10px] font-bold text-emerald-700">DPD APPSI Kab. Banyuasin</p>
                    </div>
                </div>

                <!-- Floating Glass Card 2 (Right Mid): Masa Bakti -->
                <div class="absolute top-24 -right-2 sm:right-2 z-20 hidden sm:flex items-center gap-2.5 rounded-2xl bg-slate-900/90 px-4 py-2.5 text-white shadow-[0_14px_30px_rgba(15,23,42,0.18)] ring-1 ring-white/10 backdrop-blur-xl animate-float-delayed">
                    <i class="fa-solid fa-award text-amber-400 text-sm"></i>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Masa Khidmat</p>
                        <p class="text-xs font-black text-white">Periode 2024 - 2029</p>
                    </div>
                </div>

                <!-- Ketua Cutout Portrait -->
                <div class="relative z-10 flex flex-col items-center justify-end w-full">
                    <img src="{{ asset('assets/images/ketua-hero.webp') }}" 
                         alt="{{ $ketua->nama ?? 'H. Gusra Yetri, SH' }} - Ketua DPD APPSI Banyuasin" 
                         class="relative h-auto max-h-[420px] sm:max-h-[500px] lg:max-h-[540px] w-auto max-w-[90%] sm:max-w-[420px] object-contain object-bottom drop-shadow-[0_25px_40px_rgba(4,120,87,0.25)] transition duration-500 hover:scale-[1.02]"
                         loading="eager">
                    
                    <!-- Identification Bar at Base -->
                    <div class="relative z-20 -mt-8 mb-2 inline-flex items-center gap-3.5 rounded-2xl bg-white/95 px-5 py-3 shadow-[0_16px_36px_rgba(15,23,42,0.12)] ring-1 ring-emerald-500/25 backdrop-blur-md">
                        <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-emerald-700 to-emerald-900 text-white flex items-center justify-center font-bold text-sm shadow-sm">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                        <div class="text-left">
                            <div class="flex items-center gap-1.5">
                                <h3 class="text-sm sm:text-base font-black text-slate-900 leading-tight">
                                    {{ $ketua->nama ?? 'H. Gusra Yetri, SH' }}
                                </h3>
                                <i class="fa-solid fa-circle-check text-emerald-600 text-xs"></i>
                            </div>
                            <p class="text-[11px] font-extrabold text-emerald-700 mt-0.5 uppercase tracking-wider">
                                Ketua DPD APPSI Kabupaten Banyuasin
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

<!-- 2. LIVE RUNNING TICKER (Komoditas & Pasar Tradisional Banyuasin) -->
<section class="bg-gradient-to-r from-emerald-900 via-slate-900 to-emerald-950 text-white py-3 border-y border-emerald-800/60 overflow-hidden relative" aria-label="Pantauan Pasar Banyuasin">
    <div class="ticker-track flex items-center gap-12 text-xs font-semibold text-slate-200">
        <div class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span> <strong class="text-white">Pasar Pangkalan Balai:</strong> Sentra Beras & Sembako Stabil</div>
        <div class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-emerald-400"></span> <strong class="text-white">Pasar Betung:</strong> Distribusi Minyak Goreng Bersubsidi Lancar</div>
        <div class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-emerald-400"></span> <strong class="text-white">Pasar Sukajadi:</strong> Program KUR UMKM Dibuka Tanpa Agunan</div>
        <div class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-emerald-400"></span> <strong class="text-white">Pasar Sungsang:</strong> Pasokan Ikan Segar & Udang Laut Normal</div>
        <div class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-emerald-400"></span> <strong class="text-white">Pasar Mariana:</strong> Edukasi Pembayaran Non-Tunai QRIS Terintegrasi</div>
        <div class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-amber-400"></span> <strong class="text-amber-300">Hotline Bantuan Pedagang:</strong> 0811 618 808</div>
        
        <!-- Duplicated for Infinite Loop -->
        <div class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span> <strong class="text-white">Pasar Pangkalan Balai:</strong> Sentra Beras & Sembako Stabil</div>
        <div class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-emerald-400"></span> <strong class="text-white">Pasar Betung:</strong> Distribusi Minyak Goreng Bersubsidi Lancar</div>
        <div class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-emerald-400"></span> <strong class="text-white">Pasar Sukajadi:</strong> Program KUR UMKM Dibuka Tanpa Agunan</div>
        <div class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-emerald-400"></span> <strong class="text-white">Pasar Sungsang:</strong> Pasokan Ikan Segar & Udang Laut Normal</div>
        <div class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-emerald-400"></span> <strong class="text-white">Pasar Mariana:</strong> Edukasi Pembayaran Non-Tunai QRIS Terintegrasi</div>
        <div class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-amber-400"></span> <strong class="text-amber-300">Hotline Bantuan Pedagang:</strong> 0811 618 808</div>
    </div>
</section>

<!-- 3. STRATEGIC BENTO GRID (5 Pilar Program Kerja Unggulan APPSI) -->
<section class="py-16 sm:py-24 bg-white" id="program">
    <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12 reveal-fade-up">
            <div class="max-w-2xl">
                <span class="inline-block text-xs font-black uppercase tracking-widest text-emerald-700 bg-emerald-50 px-3.5 py-1 rounded-full border border-emerald-200">
                    FOKUS STRATEGIS ORGANISASI
                </span>
                <h2 class="mt-3 text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">
                    5 Pilar Transformasi <span class="text-emerald-700">Pasar Tradisional</span> Banyuasin
                </h2>
                <p class="mt-3 text-sm sm:text-base text-slate-600">
                    Fondasi kerja nyata DPD APPSI dalam melindungi, memberdayakan, dan memajukan para pedagang pasar.
                </p>
            </div>
            <a href="{{ route('programs.public') }}" class="inline-flex items-center gap-2 font-bold text-sm text-emerald-800 hover:text-emerald-600 transition group">
                Detail Lengkap Program
                <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        <!-- Bento Grid Layout -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            
            <!-- Pilar 1: Advokasi & Perlindungan -->
            <div class="group relative rounded-3xl border border-slate-200/90 bg-gradient-to-br from-white via-slate-50/50 to-emerald-50/30 p-7 shadow-sm transition-all duration-300 hover:shadow-xl hover:border-emerald-400 hover:-translate-y-1.5 reveal-fade-up">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-600 to-teal-800 text-white shadow-md shadow-emerald-700/20 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-shield-halved text-2xl"></i>
                </div>
                <h3 class="mt-6 text-xl font-black text-slate-900 group-hover:text-emerald-800 transition">
                    Advokasi & Perlindungan Hukum
                </h3>
                <p class="mt-3 text-sm leading-relaxed text-slate-600">
                    Memberikan pendampingan hukum pro-bono dan mediasi sengketa hak pakai kios, perlindungan dari pungutan liar, serta jaminan zonasi lapak bagi pedagang kaki lima tanpa penggusuran sepihak.
                </p>
                <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-emerald-700">
                    <span>Posko Konsultasi Aktif</span>
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </div>
            </div>

            <!-- Pilar 2: Permodalan KUR & Finansial -->
            <div class="group relative rounded-3xl border border-slate-200/90 bg-gradient-to-br from-white via-slate-50/50 to-amber-50/30 p-7 shadow-sm transition-all duration-300 hover:shadow-xl hover:border-amber-400 hover:-translate-y-1.5 reveal-fade-up delay-100">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-amber-500 to-orange-600 text-white shadow-md shadow-amber-600/20 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-sack-dollar text-2xl"></i>
                </div>
                <h3 class="mt-6 text-xl font-black text-slate-900 group-hover:text-amber-800 transition">
                    Akses KUR & Bebas Rentenir
                </h3>
                <p class="mt-3 text-sm leading-relaxed text-slate-600">
                    Memfasilitasi akses Kredit Usaha Rakyat (KUR) berbunga rendah tanpa agunan memberatkan dengan rekomendasi resmi KTA APPSI, melepaskan ketergantungan pedagang dari rentenir harian.
                </p>
                <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-amber-700">
                    <span>Kemitraan Bank BUMN</span>
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </div>
            </div>

            <!-- Pilar 3: Digitalisasi QRIS & Kas -->
            <div class="group relative rounded-3xl border border-slate-200/90 bg-gradient-to-br from-white via-slate-50/50 to-teal-50/30 p-7 shadow-sm transition-all duration-300 hover:shadow-xl hover:border-teal-400 hover:-translate-y-1.5 reveal-fade-up delay-200">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-teal-600 to-cyan-700 text-white shadow-md shadow-teal-700/20 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-qrcode text-2xl"></i>
                </div>
                <h3 class="mt-6 text-xl font-black text-slate-900 group-hover:text-teal-800 transition">
                    Digitalisasi QRIS & Modernisasi
                </h3>
                <p class="mt-3 text-sm leading-relaxed text-slate-600">
                    Penerapan metode transaksi non-tunai QRIS cepat di lapak basah maupun kering, pelatihan pembukuan kas via smartphone, dan akses marketplace sembako lokal Banyuasin.
                </p>
                <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-teal-700">
                    <span>Program Go Digital</span>
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </div>
            </div>

            <!-- Pilar 4: Revitalisasi & Fasilitas Pasar -->
            <div class="group relative rounded-3xl border border-slate-200/90 bg-gradient-to-br from-white via-slate-50/50 to-emerald-50/30 p-7 shadow-sm transition-all duration-300 hover:shadow-xl hover:border-emerald-400 hover:-translate-y-1.5 reveal-fade-up">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-700 to-slate-900 text-white shadow-md shadow-emerald-900/20 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-spray-can-sparkles text-2xl"></i>
                </div>
                <h3 class="mt-6 text-xl font-black text-slate-900 group-hover:text-emerald-800 transition">
                    Revitalisasi & Kebersihan Pasar
                </h3>
                <p class="mt-3 text-sm leading-relaxed text-slate-600">
                    Mendorong dinas terkait memperbaiki saluran drainase, sarana toilet bersih, penerangan malam, pengelolaan sampah terpadu, dan kenyamanan sirkulasi pembeli di dalam pasar.
                </p>
                <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-emerald-700">
                    <span>Pasar Bersih & Higienis</span>
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </div>
            </div>

            <!-- Pilar 5: Logistik Rantai Pasok Pangan -->
            <div class="lg:col-span-2 group relative rounded-3xl border border-slate-200/90 bg-gradient-to-br from-slate-900 via-emerald-950 to-slate-950 p-7 text-white shadow-sm transition-all duration-300 hover:shadow-2xl hover:border-emerald-500 hover:-translate-y-1.5 reveal-fade-up delay-100">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="max-w-xl">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-500 text-slate-950 font-black shadow-md shadow-emerald-500/30 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-truck-moving text-2xl"></i>
                        </div>
                        <h3 class="mt-6 text-xl sm:text-2xl font-black text-white">
                            Rantai Pasok Langsung Petani & Nelayan
                        </h3>
                        <p class="mt-3 text-sm leading-relaxed text-slate-300">
                            Memangkas rantai tengkulak dengan menghubungkan pedagang pasar langsung ke sentra gabungan kelompok tani padi Banyuasin, produsen sayur dataran, dan nelayan pesisir Sungsang untuk menjaga stabilitas margin pedagang.
                        </p>
                    </div>
                    <div class="shrink-0 flex flex-col gap-2.5">
                        <div class="p-4 rounded-2xl bg-white/10 border border-white/15 backdrop-blur-md">
                            <p class="text-[11px] font-bold text-emerald-400">Efisiensi Pasokan:</p>
                            <p class="text-sm font-extrabold text-white mt-0.5">Potong Rantai Distribusi</p>
                        </div>
                        <a href="{{ route('contact.public') }}" class="inline-flex items-center justify-center gap-2 rounded-xl font-bold bg-white text-slate-900 hover:bg-emerald-400 transition py-2.5 px-4 text-xs">
                            Hubungi Tim Logistik
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- 4. WARTA & BERITA TERKINI (Editorial International Magazine Layout) -->
<section class="py-16 sm:py-24 bg-slate-50/80 border-t border-slate-200/80" id="berita">
    <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12 reveal-fade-up">
            <div>
                <span class="inline-block text-xs font-black uppercase tracking-widest text-emerald-700 bg-emerald-100/60 px-3.5 py-1 rounded-full border border-emerald-200">
                    PUBLIKASI & WARTA PASAR
                </span>
                <h2 class="mt-3 text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">
                    Kabar Terkini <span class="text-emerald-700">APPSI Banyuasin</span>
                </h2>
                <p class="mt-2 text-sm sm:text-base text-slate-600">
                    Aktivitas lapangan, advokasi harga bahan pokok, dan kebijakan strategis pedagang pasar.
                </p>
            </div>
            <a href="{{ route('news.index') }}" class="inline-flex items-center gap-2 font-bold text-sm text-emerald-800 hover:text-emerald-600 transition group">
                Lihat Semua Warta Pasar ({{ $stats['total_berita'] ?? count($posts) }})
                <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        <!-- News Editorial Grid -->
        <div class="grid gap-8 lg:grid-cols-12">
            
            @if(isset($posts[0]))
                <!-- Major Featured Article (7 Cols) -->
                <article class="lg:col-span-7 flex flex-col overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm transition-all duration-300 hover:shadow-xl hover:border-emerald-300 hover:-translate-y-1 reveal-fade-up group">
                    <div class="relative h-64 sm:h-80 w-full overflow-hidden bg-slate-100">
                        <img src="{{ $posts[0]->gambar_url }}" alt="{{ $posts[0]->judul }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent"></div>
                        <div class="absolute top-4 left-4">
                            <span class="rounded-xl bg-emerald-600/90 backdrop-blur-md px-3.5 py-1.5 text-xs font-bold uppercase tracking-wider text-white shadow">
                                {{ $posts[0]->kategori }}
                            </span>
                        </div>
                        <div class="absolute bottom-4 left-4 right-4 text-white">
                            <div class="flex items-center gap-3 text-xs text-emerald-200">
                                <span class="flex items-center gap-1.5"><i class="fa-regular fa-calendar"></i> {{ $posts[0]->published_at ? $posts[0]->published_at->translatedFormat('d F Y') : date('d M Y') }}</span>
                                <span>•</span>
                                <span class="flex items-center gap-1.5"><i class="fa-regular fa-clock"></i> 3 menit baca</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 sm:p-8 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-xl sm:text-2xl font-black text-slate-900 group-hover:text-emerald-700 transition leading-snug">
                                <a href="{{ route('news.show', $posts[0]->slug) }}">{{ $posts[0]->judul }}</a>
                            </h3>
                            <p class="mt-4 text-sm leading-relaxed text-slate-600">
                                {{ $posts[0]->ringkasan ?? Str::limit(strip_tags($posts[0]->konten), 160) }}
                            </p>
                        </div>
                        <div class="mt-6 pt-6 border-t border-slate-100 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="h-9 w-9 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center font-bold text-xs">
                                    <i class="fa-solid fa-pen-nib"></i>
                                </div>
                                <span class="text-xs font-bold text-slate-700">{{ $posts[0]->penulis ?? 'Humas DPD Banyuasin' }}</span>
                            </div>
                            <a href="{{ route('news.show', $posts[0]->slug) }}" class="inline-flex items-center gap-2 text-xs font-extrabold text-emerald-700 group-hover:text-emerald-900 transition">
                                Baca Selengkapnya <i class="fa-solid fa-arrow-right text-[11px]"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @endif

            <!-- Secondary Article Column (5 Cols) -->
            <div class="lg:col-span-5 flex flex-col gap-6">
                @forelse($posts->slice(1, 2) as $index => $post)
                    <article class="flex flex-col sm:flex-row lg:flex-col xl:flex-row overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm transition-all duration-300 hover:shadow-lg hover:border-emerald-300 hover:-translate-y-1 reveal-fade-up delay-{{ ($index + 1) * 100 }} group">
                        <div class="relative h-44 sm:w-48 lg:w-full xl:w-48 shrink-0 overflow-hidden bg-slate-100">
                            <img src="{{ $post->gambar_url }}" alt="{{ $post->judul }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <span class="absolute top-3 left-3 rounded-lg bg-slate-900/80 backdrop-blur-md px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-white">
                                {{ $post->kategori }}
                            </span>
                        </div>
                        <div class="p-5 sm:p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-2 text-[11px] text-slate-500 font-semibold">
                                    <i class="fa-regular fa-calendar text-emerald-600"></i>
                                    {{ $post->published_at ? $post->published_at->translatedFormat('d M Y') : date('d M Y') }}
                                </div>
                                <h4 class="mt-2 text-base font-extrabold text-slate-900 group-hover:text-emerald-700 transition line-clamp-2 leading-snug">
                                    <a href="{{ route('news.show', $post->slug) }}">{{ $post->judul }}</a>
                                </h4>
                                <p class="mt-2 text-xs text-slate-600 line-clamp-2 leading-relaxed">
                                    {{ $post->ringkasan ?? Str::limit(strip_tags($post->konten), 90) }}
                                </p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                                <span class="text-[11px] font-bold text-slate-500">{{ $post->penulis }}</span>
                                <a href="{{ route('news.show', $post->slug) }}" class="text-xs font-extrabold text-emerald-700 hover:underline">
                                    Baca &rarr;
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="p-8 text-center text-slate-400 bg-white rounded-3xl border border-slate-200">
                        Belum ada warta pasar tambahan.
                    </div>
                @endforelse
            </div>

        </div>

    </div>
</section>

<!-- 5. PETA JARINGAN PASAR TRADISIONAL BANYUASIN (Interactive Market Showcase) -->
<section class="py-16 sm:py-24 bg-white" id="pasar">
    <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-14 reveal-fade-up">
            <span class="inline-block text-xs font-black uppercase tracking-widest text-emerald-700 bg-emerald-50 px-4 py-1.5 rounded-full border border-emerald-200">
                DISTRIBUSI PERDAGANGAN RAKYAT
            </span>
            <h2 class="mt-3 text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">
                Jaringan Pasar Tradisional <span class="text-emerald-700">Banyuasin</span>
            </h2>
            <p class="mt-3 text-sm sm:text-base text-slate-600">
                DPD APPSI membina pengurus komisariat di pasar-pasar induk dan kecamatan untuk menjaga arus pasokan kebutuhan bahan pokok masyarakat.
            </p>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            
            <!-- Pasar 1: Pangkalan Balai -->
            <div class="rounded-3xl border border-slate-200/90 bg-white p-6 shadow-sm hover:shadow-xl hover:border-emerald-300 transition-all duration-300 hover:-translate-y-1.5 reveal-fade-up">
                <div class="flex items-center justify-between">
                    <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold">Pasar Induk Ibukota</span>
                    <span class="text-xs font-extrabold text-slate-400">Kec. Banyuasin III</span>
                </div>
                <h3 class="mt-4 text-xl font-black text-slate-900">Pasar Pangkalan Balai</h3>
                <p class="mt-2 text-xs leading-relaxed text-slate-600">
                    Pusat perdagangan sentral komoditas sembako, sayur mayur dataran, pakaian, dan pusat administrasi sekretariat DPD APPSI Banyuasin.
                </p>
                <div class="mt-5 pt-4 border-t border-slate-100 space-y-2 text-xs text-slate-600">
                    <div class="flex items-center justify-between font-semibold">
                        <span><i class="fa-solid fa-users text-emerald-600 mr-2"></i> Pedagang Terdata:</span>
                        <strong class="text-slate-900">180+ Kios</strong>
                    </div>
                    <div class="flex items-center justify-between font-semibold">
                        <span><i class="fa-solid fa-qrcode text-emerald-600 mr-2"></i> Status Digital:</span>
                        <span class="text-emerald-700 font-bold">QRIS Terintegrasi</span>
                    </div>
                </div>
            </div>

            <!-- Pasar 2: Betung -->
            <div class="rounded-3xl border border-slate-200/90 bg-white p-6 shadow-sm hover:shadow-xl hover:border-emerald-300 transition-all duration-300 hover:-translate-y-1.5 reveal-fade-up delay-100">
                <div class="flex items-center justify-between">
                    <span class="px-3 py-1 rounded-full bg-amber-100 text-amber-800 text-xs font-bold">Sentra Jalur Lintas</span>
                    <span class="text-xs font-extrabold text-slate-400">Kec. Betung</span>
                </div>
                <h3 class="mt-4 text-xl font-black text-slate-900">Pasar Betung</h3>
                <p class="mt-2 text-xs leading-relaxed text-slate-600">
                    Pusat distribusi grosir beras, minyak goreng, dan daging sapi/kambing yang menghubungkan arus perdagangan Palembang-Jambi.
                </p>
                <div class="mt-5 pt-4 border-t border-slate-100 space-y-2 text-xs text-slate-600">
                    <div class="flex items-center justify-between font-semibold">
                        <span><i class="fa-solid fa-users text-emerald-600 mr-2"></i> Pedagang Terdata:</span>
                        <strong class="text-slate-900">140+ Kios</strong>
                    </div>
                    <div class="flex items-center justify-between font-semibold">
                        <span><i class="fa-solid fa-truck-ramp-box text-amber-600 mr-2"></i> Logistik:</span>
                        <span class="text-amber-700 font-bold">Pangkalan Pangan</span>
                    </div>
                </div>
            </div>

            <!-- Pasar 3: Sukajadi Talang Kelapa -->
            <div class="rounded-3xl border border-slate-200/90 bg-white p-6 shadow-sm hover:shadow-xl hover:border-emerald-300 transition-all duration-300 hover:-translate-y-1.5 reveal-fade-up delay-200">
                <div class="flex items-center justify-between">
                    <span class="px-3 py-1 rounded-full bg-teal-100 text-teal-800 text-xs font-bold">Kawasan Aglomerasi</span>
                    <span class="text-xs font-extrabold text-slate-400">Kec. Talang Kelapa</span>
                </div>
                <h3 class="mt-4 text-xl font-black text-slate-900">Pasar Sukajadi</h3>
                <p class="mt-2 text-xs leading-relaxed text-slate-600">
                    Pasar penyangga dengan perputaran transaksi tertinggi di wilayah perbatasan, fokus pada aneka sembako, busana, dan aneka jasa.
                </p>
                <div class="mt-5 pt-4 border-t border-slate-100 space-y-2 text-xs text-slate-600">
                    <div class="flex items-center justify-between font-semibold">
                        <span><i class="fa-solid fa-users text-emerald-600 mr-2"></i> Pedagang Terdata:</span>
                        <strong class="text-slate-900">120+ Kios</strong>
                    </div>
                    <div class="flex items-center justify-between font-semibold">
                        <span><i class="fa-solid fa-hand-holding-dollar text-teal-600 mr-2"></i> Akses Modal:</span>
                        <span class="text-teal-700 font-bold">Sentra KUR UMKM</span>
                    </div>
                </div>
            </div>

            <!-- Pasar 4: Sungsang -->
            <div class="rounded-3xl border border-slate-200/90 bg-white p-6 shadow-sm hover:shadow-xl hover:border-emerald-300 transition-all duration-300 hover:-translate-y-1.5 reveal-fade-up">
                <div class="flex items-center justify-between">
                    <span class="px-3 py-1 rounded-full bg-cyan-100 text-cyan-800 text-xs font-bold">Sentra Pesisir Nelayan</span>
                    <span class="text-xs font-extrabold text-slate-400">Kec. Banyuasin II</span>
                </div>
                <h3 class="mt-4 text-xl font-black text-slate-900">Pasar Sungsang</h3>
                <p class="mt-2 text-xs leading-relaxed text-slate-600">
                    Pusat pelelangan dan penjualan aneka hasil tangkapan laut, udang segar, terasi khas Banyuasin, dan ikan sungai muara.
                </p>
                <div class="mt-5 pt-4 border-t border-slate-100 space-y-2 text-xs text-slate-600">
                    <div class="flex items-center justify-between font-semibold">
                        <span><i class="fa-solid fa-users text-emerald-600 mr-2"></i> Pedagang Terdata:</span>
                        <strong class="text-slate-900">95+ Los Basah</strong>
                    </div>
                    <div class="flex items-center justify-between font-semibold">
                        <span><i class="fa-solid fa-water text-cyan-600 mr-2"></i> Fasilitas:</span>
                        <span class="text-cyan-700 font-bold">Dermaga Sandar</span>
                    </div>
                </div>
            </div>

            <!-- Pasar 5: Mariana -->
            <div class="rounded-3xl border border-slate-200/90 bg-white p-6 shadow-sm hover:shadow-xl hover:border-emerald-300 transition-all duration-300 hover:-translate-y-1.5 reveal-fade-up delay-100">
                <div class="flex items-center justify-between">
                    <span class="px-3 py-1 rounded-full bg-indigo-100 text-indigo-800 text-xs font-bold">Kawasan Perairan Musi</span>
                    <span class="text-xs font-extrabold text-slate-400">Kec. Banyuasin I</span>
                </div>
                <h3 class="mt-4 text-xl font-black text-slate-900">Pasar Mariana</h3>
                <p class="mt-2 text-xs leading-relaxed text-slate-600">
                    Pusat komoditas harian pekerja industri dan permukiman tepian Sungai Musi dengan aktivitas pagi yang padat dan teratur.
                </p>
                <div class="mt-5 pt-4 border-t border-slate-100 space-y-2 text-xs text-slate-600">
                    <div class="flex items-center justify-between font-semibold">
                        <span><i class="fa-solid fa-users text-emerald-600 mr-2"></i> Pedagang Terdata:</span>
                        <strong class="text-slate-900">80+ Lapak</strong>
                    </div>
                    <div class="flex items-center justify-between font-semibold">
                        <span><i class="fa-solid fa-scale-balanced text-indigo-600 mr-2"></i> Advokasi:</span>
                        <span class="text-indigo-700 font-bold">Penataan Los</span>
                    </div>
                </div>
            </div>

            <!-- Card 6: Hubungi Komisariat Pasar -->
            <div class="rounded-3xl border-2 border-dashed border-emerald-300 bg-emerald-50/50 p-6 flex flex-col justify-between reveal-fade-up delay-200">
                <div>
                    <span class="px-3 py-1 rounded-full bg-emerald-200 text-emerald-900 text-xs font-bold">Layanan Komisariat</span>
                    <h3 class="mt-4 text-xl font-black text-emerald-950">Pasar Anda Belum Terdaftar?</h3>
                    <p class="mt-2 text-xs leading-relaxed text-emerald-800">
                        Bentuk pengurus Komisariat Pasar (PKP) APPSI di wilayah Anda untuk mendapatkan hak advokasi, permodalan, dan legalitas pedagang resmi.
                    </p>
                </div>
                <div class="mt-6">
                    <a href="{{ route('contact.public') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl font-extrabold bg-emerald-700 text-white hover:bg-emerald-800 transition py-3 px-5 text-xs w-full shadow-sm">
                        Konsultasi Pembentukan PKP
                        <i class="fa-solid fa-arrow-right text-[11px]"></i>
                    </a>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- 6. AGENDA KEGIATAN & NOTULEN RAPAT (Interactive Timeline) -->
<section class="py-16 sm:py-24 bg-slate-50/80 border-t border-slate-200/80" id="agenda">
    <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12 reveal-fade-up">
            <div>
                <span class="inline-block text-xs font-black uppercase tracking-widest text-emerald-700 bg-emerald-100/60 px-3.5 py-1 rounded-full border border-emerald-200">
                    AGENDA KERJA NYATA
                </span>
                <h2 class="mt-3 text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">
                    Musyawarah & <span class="text-emerald-700">Rapat Koordinasi</span>
                </h2>
                <p class="mt-2 text-sm sm:text-base text-slate-600">
                    Jadwal koordinasi berkala pengurus DPD bersama dinas terkait dan perwakilan pedagang.
                </p>
            </div>
            <span class="text-xs font-extrabold text-slate-500 bg-white px-4 py-2 rounded-xl border border-slate-200">
                Transparan & Akuntabel
            </span>
        </div>

        <div class="space-y-4">
            @forelse($meetings as $meeting)
                <div class="rounded-3xl border border-slate-200/90 bg-white p-6 shadow-sm hover:shadow-md transition-all duration-300 reveal-fade-up">
                    <div class="grid gap-6 md:grid-cols-12 items-center">
                        
                        <!-- Date Badge (2 Cols) -->
                        <div class="md:col-span-2 flex md:flex-col items-center justify-center p-3 rounded-2xl bg-gradient-to-br from-emerald-700 to-teal-900 text-white text-center shadow-sm">
                            <span class="text-3xl font-black leading-none">{{ $meeting->tanggal ? $meeting->tanggal->format('d') : '25' }}</span>
                            <span class="text-xs font-extrabold uppercase tracking-wider mt-1">{{ $meeting->tanggal ? $meeting->tanggal->translatedFormat('M Y') : 'AGT 2026' }}</span>
                        </div>

                        <!-- Info Column (7 Cols) -->
                        <div class="md:col-span-7">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 text-[10px] font-bold uppercase tracking-wider">
                                    {{ $meeting->status == 'selesai' ? 'SELESAI DILAKSANAKAN' : 'AGENDA MENDATANG' }}
                                </span>
                                <span class="text-xs text-slate-400">•</span>
                                <span class="text-xs text-slate-500 font-semibold">
                                    <i class="fa-regular fa-clock text-emerald-600 mr-1"></i>
                                    {{ substr($meeting->waktu_mulai, 0, 5) }} - {{ substr($meeting->waktu_selesai, 0, 5) }} WIB
                                </span>
                            </div>
                            <h3 class="mt-2 text-base sm:text-lg font-black text-slate-900 leading-snug">
                                {{ $meeting->judul_rapat }}
                            </h3>
                            <p class="mt-1.5 text-xs sm:text-sm text-slate-600 flex items-center gap-1.5">
                                <i class="fa-solid fa-location-dot text-emerald-600"></i>
                                {{ $meeting->tempat }}
                            </p>
                        </div>

                        <!-- Action Column (3 Cols) -->
                        <div class="md:col-span-3 flex flex-col justify-center gap-2 md:border-l md:border-slate-100 md:pl-6">
                            <div class="text-xs text-slate-500">
                                <strong>Pimpinan:</strong> {{ $meeting->pimpinan_rapat }}
                            </div>
                            <a href="https://wa.me/62811618808?text=Halo%20Admin%20APPSI,%20saya%20ingin%20mengetahui%20hasil%20rapat:%20{{ urlencode($meeting->judul_rapat) }}" target="_blank" class="inline-flex items-center justify-center gap-2 rounded-xl font-bold border border-emerald-300 bg-white text-emerald-800 hover:bg-emerald-50 py-2.5 px-4 text-xs transition">
                                <i class="fa-brands fa-whatsapp text-emerald-600"></i>
                                Konfirmasi Notulen
                            </a>
                        </div>

                    </div>
                </div>
            @empty
                <!-- Fallback Event -->
                <div class="rounded-3xl border border-slate-200/90 bg-white p-6 shadow-sm reveal-fade-up">
                    <p class="text-center text-slate-400 text-sm">Belum ada jadwal rapat terkini.</p>
                </div>
            @endforelse
        </div>

    </div>
</section>

<!-- 7. GALERI DOKUMENTASI AKSI NYATA (Visual Activity Showcase) -->
<section class="py-16 sm:py-24 bg-white" id="galeri">
    <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12 reveal-fade-up">
            <div>
                <span class="inline-block text-xs font-black uppercase tracking-widest text-emerald-700 bg-emerald-50 px-3.5 py-1 rounded-full border border-emerald-200">
                    DOKUMENTASI AKSI LAPANGAN
                </span>
                <h2 class="mt-3 text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">
                    Galeri Kegiatan <span class="text-emerald-700">DPD APPSI</span>
                </h2>
                <p class="mt-2 text-sm sm:text-base text-slate-600">
                    Rekam jejak kunjungan pasar, pembagian bantuan, dan dialog langsung bersama pedagang.
                </p>
            </div>
            <a href="{{ route('gallery.public') }}" class="inline-flex items-center gap-2 font-bold text-sm text-emerald-800 hover:text-emerald-600 transition group">
                Buka Semua Galeri
                <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        <!-- Gallery Grid -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @forelse($galleries as $gallery)
                <div class="group relative overflow-hidden rounded-3xl border border-slate-200/80 bg-slate-100 shadow-sm aspect-[4/3] reveal-fade-up">
                    <img src="{{ asset($gallery->foto) }}" alt="{{ $gallery->judul }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                    
                    <!-- Gradient Overlay on Hover -->
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/40 to-transparent opacity-85 sm:opacity-0 sm:group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-5 text-white">
                        <span class="text-[10px] font-extrabold uppercase tracking-wider text-emerald-400">
                            {{ $gallery->kategori }}
                        </span>
                        <h4 class="mt-1 text-sm font-bold text-white line-clamp-2 leading-snug">
                            {{ $gallery->judul }}
                        </h4>
                        <p class="mt-1 text-[11px] text-slate-300 line-clamp-1">
                            {{ $gallery->deskripsi }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="col-span-4 p-8 text-center text-slate-400 bg-slate-50 rounded-3xl">
                    Belum ada foto kegiatan tersimpan.
                </div>
            @endforelse
        </div>

    </div>
</section>

<!-- 8. KATA SAMBUTAN KETUA DPD (Executive Quote Showcase) -->
<section class="py-16 sm:py-24 bg-gradient-to-b from-slate-900 via-slate-950 to-emerald-950 text-white relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-8 sm:p-12 lg:p-16 reveal-fade-up">
            <div class="grid items-center gap-8 lg:grid-cols-12">
                
                <div class="lg:col-span-4 flex flex-col items-center text-center">
                    <div class="relative h-40 w-40 sm:h-48 sm:w-48 rounded-full overflow-hidden border-4 border-emerald-500/40 shadow-2xl p-1 bg-gradient-to-br from-emerald-600 to-teal-800">
                        <img src="{{ asset('assets/images/ketua-appsi-banyuasin.webp') }}" alt="H. Gusra Yetri, SH" class="h-full w-full object-cover rounded-full">
                    </div>
                    <h3 class="mt-4 text-xl font-black text-white">H. Gusra Yetri, SH</h3>
                    <p class="text-xs font-bold text-emerald-400 uppercase tracking-widest mt-0.5">Ketua DPD APPSI Kab. Banyuasin</p>
                </div>

                <div class="lg:col-span-8">
                    <i class="fa-solid fa-quote-left text-4xl sm:text-5xl text-emerald-500/30"></i>
                    <blockquote class="mt-4 text-lg sm:text-2xl font-bold leading-relaxed text-slate-100 tracking-tight">
                        "Pasar tradisional bukan sekadar tempat bertemunya penjual dan pembeli. Pasar adalah jantung perekonomian kerakyatan dan ruang silaturahmi sosial yang tak tergantikan. DPD APPSI Banyuasin hadir untuk memastikan para pedagang tidak berjalan sendirian menghadapi tantangan zaman."
                    </blockquote>
                    <p class="mt-6 text-sm text-slate-400 leading-relaxed">
                        Kami mengajak seluruh pemangku kepentingan, pemerintah daerah, perbankan, dan paguyuban pedagang untuk bersatu padu menciptakan pasar tradisional yang bersih, tertib, berdaya saing, dan membawa kesejahteraan nyata bagi keluarga pedagang.
                    </p>
                    <div class="mt-8 flex items-center gap-4">
                        <a href="{{ route('about.public') }}" class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-2.5 px-5 text-xs transition shadow-md">
                            Visi & Misi Selengkapnya
                            <i class="fa-solid fa-arrow-right text-[11px]"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- 9. CALL TO ACTION & CEK KEANGGOTAAN CEPAT (High-Conversion Banner) -->
<section class="py-16 sm:py-20 bg-white" id="aspirasi">
    <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="rounded-3xl bg-gradient-to-br from-emerald-800 via-teal-900 to-slate-950 p-8 sm:p-14 text-white shadow-2xl relative overflow-hidden reveal-fade-up">
            
            <!-- Ambient Pattern -->
            <div class="absolute inset-0 hero-pattern-dots opacity-15 pointer-events-none"></div>

            <div class="grid items-center gap-8 lg:grid-cols-12 relative z-10">
                
                <div class="lg:col-span-7">
                    <span class="inline-block rounded-full bg-emerald-500/20 px-4 py-1 text-xs font-extrabold uppercase tracking-wider text-emerald-300 border border-emerald-400/30">
                        LAYANAN KEANGGOTAAN DIGITAL
                    </span>
                    <h2 class="mt-4 text-2xl sm:text-3xl lg:text-4xl font-black text-white leading-tight">
                        Sudahkah Anda Terdaftar Sebagai Pedagang Resmi APPSI Banyuasin?
                    </h2>
                    <p class="mt-4 text-sm sm:text-base leading-relaxed text-slate-300 max-w-xl">
                        Dapatkan Kartu Tanda Anggota (KTA) digital ber-barcode resmi untuk kepastian izin penempatan kios, akses pinjaman modal usaha KUR, dan perlindungan hukum gratis.
                    </p>
                </div>

                <div class="lg:col-span-5 flex flex-col gap-4">
                    <div class="p-6 rounded-2xl bg-white/10 border border-white/15 backdrop-blur-md">
                        <p class="text-xs font-bold text-slate-200">Cek Status KTA Anda Cepat:</p>
                        <form action="{{ route('members.check') }}" method="GET" class="mt-3 flex gap-2">
                            <input type="text" name="keyword" placeholder="Masukkan NIK atau No. KTA..." class="w-full rounded-xl bg-white px-3.5 py-2.5 text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-400" required>
                            <button type="submit" class="rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 px-4 py-2.5 text-xs font-black shrink-0 transition">
                                Cek
                            </button>
                        </form>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('members.register') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-white text-emerald-950 font-black py-3 px-5 text-xs hover:bg-emerald-100 transition flex-1 text-center shadow">
                            <i class="fa-solid fa-user-plus text-xs text-emerald-700"></i>
                            Daftar KTA Baru
                        </a>
                        <a href="https://wa.me/62811618808?text=Halo%20Pengurus%20DPD%20APPSI%20Banyuasin,%20saya%20pedagang%20ingin%20menyampaikan%20aspirasi..." target="_blank" class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600/80 hover:bg-emerald-600 border border-emerald-400/40 text-white font-bold py-3 px-5 text-xs transition flex-1 text-center backdrop-blur-md">
                            <i class="fa-brands fa-whatsapp text-sm"></i>
                            Aspirasi & Pengaduan
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
