@extends('layouts.public')

@section('title', 'Beranda - DPD APPSI Kabupaten Banyuasin')

@section('content')

<!-- 1. HERO SECTION (Adopsi Desain & Warna appsi.id) -->
<section class="relative isolate overflow-hidden bg-white" id="hero">
    <div class="grid w-full lg:min-h-[580px] lg:grid-cols-[52%_48%] xl:min-h-[620px]">
        
        <!-- Left Hero Content -->
        <div class="relative z-20 flex items-center px-5 pb-8 pt-8 sm:px-8 sm:pt-10 lg:min-h-[580px] lg:px-0 lg:py-12 lg:pl-[clamp(48px,5.5vw,84px)] lg:pr-8 xl:min-h-[620px]" data-aos="fade-up">
            <div class="w-full max-w-xl">
                
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-4 py-1.5 text-xs font-bold uppercase tracking-wide text-emerald-800 ring-1 ring-emerald-200">
                    <span class="flex h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    GABUNG APPSI, KUATKAN SUARA PEDAGANG PASAR!
                </div>

                <!-- Headline -->
                <h1 class="mt-4 text-[2.2rem] font-extrabold leading-[1.15] tracking-tight text-slate-900 sm:text-[2.6rem] lg:text-[2.9rem] xl:text-[3.2rem]">
                    Bergabung dan jadilah bagian dari <span class="text-emerald-700">Asosiasi Pedagang Pasar Seluruh Indonesia</span> sekarang!
                </h1>

                <!-- Subtitle -->
                <p class="mt-5 text-base leading-[1.7] text-slate-600 sm:text-lg">
                    Bersama membangun pasar tradisional yang kuat, mandiri, dan berdaya saing untuk kesejahteraan pedagang dan masyarakat Kabupaten Banyuasin.
                </p>

                <!-- CTA Buttons -->
                <div class="mt-7 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('members.register') }}" class="inline-flex items-center justify-center gap-2 rounded-xl font-bold transition duration-200 bg-emerald-700 text-white shadow-[0_10px_24px_rgba(21,128,61,0.22)] hover:bg-emerald-800 h-12 px-6 text-sm">
                        <i class="fa-solid fa-users text-sm"></i>
                        Daftar di sini
                    </a>
                    <a href="{{ route('about.public') }}" class="inline-flex items-center justify-center gap-2 rounded-xl font-bold transition duration-200 border border-emerald-300 bg-white text-emerald-800 hover:border-emerald-600 hover:bg-emerald-50 h-12 px-6 text-sm">
                        Pelajari Lebih Lanjut
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>

                <!-- 3 Pillars of APPSI -->
                <div class="mt-10 grid gap-4 sm:grid-cols-3 pt-6 border-t border-slate-100">
                    <div class="flex gap-3">
                        <div class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-700">
                            <i class="fa-solid fa-people-roof text-lg"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-900 sm:text-sm">Komunitas Pasar</p>
                            <p class="mt-0.5 text-[11px] leading-relaxed text-slate-500">Terhubung dengan pedagang pasar se-Banyuasin</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-700">
                            <i class="fa-solid fa-shield-halved text-lg"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-900 sm:text-sm">Advokasi & Hak</p>
                            <p class="mt-0.5 text-[11px] leading-relaxed text-slate-500">Memperjuangkan perlindungan pedagang kecil</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-700">
                            <i class="fa-solid fa-chart-line text-lg"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-900 sm:text-sm">Kapasitas & Modal</p>
                            <p class="mt-0.5 text-[11px] leading-relaxed text-slate-500">Akses KUR, pelatihan dan digitalisasi QRIS</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Right Hero Visual with Ketua H. Gusra Yetri, SH & Organic Motif -->
        <div class="relative min-h-[380px] overflow-hidden sm:min-h-[440px] lg:min-h-full bg-gradient-to-tr from-emerald-50 via-slate-50 to-white flex items-end justify-center" data-aos="fade-up">
            
            <!-- Circular Halo Motif -->
            <div class="absolute left-[5%] top-8 z-10 h-[80%] w-[80%] rounded-full border-[24px] border-emerald-600/15 pointer-events-none"></div>
            <div class="hero-dot-pattern absolute bottom-12 left-6 z-10 h-28 w-28 opacity-40 pointer-events-none"></div>
            
            <!-- Leaf / Organic Sprout Graphic -->
            <div class="absolute top-12 right-8 z-10 text-emerald-700/10 pointer-events-none">
                <i class="fa-solid fa-seedling text-8xl"></i>
            </div>

            <!-- Ketua Photo Container -->
            <div class="relative z-20 w-full max-w-sm px-6 flex flex-col items-center">
                <div class="relative group">
                    <div class="w-64 h-80 sm:w-72 sm:h-96 rounded-2xl overflow-hidden shadow-2xl border-4 border-white bg-slate-200">
                        <img src="{{ asset('assets/images/ketua-appsi-banyuasin.webp') }}" alt="H. Gusra Yetri, SH - Ketua APPSI Banyuasin" class="w-full h-full object-cover object-top transition duration-500 group-hover:scale-105">
                    </div>
                    <!-- Leader Label Pill -->
                    <div class="absolute -bottom-4 inset-x-2 bg-white/95 backdrop-blur rounded-xl p-3 border border-emerald-100 shadow-xl text-center">
                        <h4 class="text-sm font-bold text-slate-900">H. Gusra Yetri, SH</h4>
                        <p class="text-xs font-semibold text-emerald-700">Ketua DPD APPSI Kab. Banyuasin</p>
                    </div>
                </div>
            </div>

            <!-- Bottom Gradient Overlay -->
            <div class="absolute bottom-0 inset-x-0 h-16 bg-gradient-to-t from-white via-white/50 to-transparent z-10"></div>
        </div>

    </div>
</section>

<!-- 2. BERITA TERKINI SECTION (Mengadopsi appsi.id/news) -->
<section class="bg-white py-14 sm:py-18 border-t border-slate-100" id="posts">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8">
        
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between" data-aos="fade-up">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-700">WARTA & PUBLIKASI</span>
                <h2 class="mt-1 text-2xl font-extrabold text-slate-900 sm:text-3xl">
                    Berita <span class="text-emerald-700">Terkini</span>
                </h2>
            </div>
            <a href="{{ route('news.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-emerald-800 hover:text-emerald-600 transition">
                Lihat semua berita
                <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>

        <div class="grid gap-6 md:grid-cols-3">
            @forelse($posts as $post)
                <article class="group flex flex-col overflow-hidden rounded-[1.35rem] border border-slate-100 bg-white shadow-[0_14px_38px_rgba(15,23,42,0.06)] transition hover:-translate-y-1 hover:shadow-[0_20px_44px_rgba(15,23,42,0.10)]" data-aos="fade-up">
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
                <div class="col-span-3 text-center py-12 text-slate-400">
                    Belum ada berita terbit.
                </div>
            @endforelse
        </div>

    </div>
</section>

<!-- 3. AGENDA & ACARA PASAR (Adopsi Acara yang Akan Datang appsi.id) -->
<section class="bg-slate-50/60 py-14 sm:py-18 border-t border-slate-100" id="agenda">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8">
        
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between" data-aos="fade-up">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-700">AGENDA KEGIATAN</span>
                <h2 class="mt-1 text-2xl font-extrabold text-slate-900 sm:text-3xl">
                    Acara yang Akan Datang
                </h2>
            </div>
            <span class="text-sm font-medium text-slate-500">Koordinasi & Musyawarah Pasar</span>
        </div>

        <div class="overflow-hidden rounded-[1.35rem] border border-slate-200/80 bg-white shadow-sm" data-aos="fade-up">
            
            <!-- Event 1 -->
            <article class="grid gap-4 border-b border-slate-100 p-5 sm:grid-cols-[92px_1fr] lg:grid-cols-[92px_1fr_260px] hover:bg-slate-50/50 transition">
                <div class="flex h-full min-h-[96px] w-full sm:w-[92px] flex-col items-center justify-center rounded-xl bg-emerald-700 text-white">
                    <span class="text-3xl font-extrabold leading-none">28</span>
                    <span class="mt-1 text-xs font-bold uppercase tracking-wider">DES</span>
                    <span class="text-xs font-medium opacity-80">2026</span>
                </div>
                <div class="self-center py-1 sm:pr-6">
                    <span class="inline-block rounded-full bg-emerald-50 px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-emerald-700 border border-emerald-100">
                        MUSYAWARAH PASAR
                    </span>
                    <h3 class="mt-2 text-base font-bold text-slate-900 sm:text-lg">
                        Rapat Koordinasi Penataan Kios & Distribusi Minyak Goreng Subsidi
                    </h3>
                    <p class="mt-1.5 text-sm text-slate-600 leading-relaxed">
                        Pertemuan pengurus DPD APPSI bersama perwakilan pedagang sembako dan Dinas Perdagangan Kab. Banyuasin.
                    </p>
                </div>
                <div class="flex flex-col justify-center gap-2.5 border-slate-100 pt-3 lg:border-l lg:pl-7 lg:pt-0">
                    <div class="flex items-center gap-2 text-xs text-slate-600">
                        <i class="fa-solid fa-location-dot text-emerald-700"></i>
                        <span>Pasar Pangkalan Balai, Banyuasin III</span>
                    </div>
                    <div class="flex items-center gap-2 text-xs text-slate-600">
                        <i class="fa-regular fa-clock text-emerald-700"></i>
                        <span>09.00 WIB - Selesai</span>
                    </div>
                    <a href="#aspirasi" class="inline-flex items-center justify-center gap-2 rounded-xl font-semibold border border-emerald-200 bg-white text-emerald-800 hover:bg-emerald-50 h-9 px-3 text-xs w-full transition">
                        Hubungi Panitia
                    </a>
                </div>
            </article>

            <!-- Event 2 -->
            <article class="grid gap-4 p-5 sm:grid-cols-[92px_1fr] lg:grid-cols-[92px_1fr_260px] hover:bg-slate-50/50 transition">
                <div class="flex h-full min-h-[96px] w-full sm:w-[92px] flex-col items-center justify-center rounded-xl bg-emerald-700 text-white">
                    <span class="text-3xl font-extrabold leading-none">05</span>
                    <span class="mt-1 text-xs font-bold uppercase tracking-wider">JAN</span>
                    <span class="text-xs font-medium opacity-80">2027</span>
                </div>
                <div class="self-center py-1 sm:pr-6">
                    <span class="inline-block rounded-full bg-emerald-50 px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-emerald-700 border border-emerald-100">
                        PELATIHAN & UMKM
                    </span>
                    <h3 class="mt-2 text-base font-bold text-slate-900 sm:text-lg">
                        Sosialisasi Pembayaran Non-Tunai QRIS & Fasilitasi KUR Mikro
                    </h3>
                    <p class="mt-1.5 text-sm text-slate-600 leading-relaxed">
                        Pendampingan literasi keuangan dan kemudahan akses pembiayaan perbankan bagi pedagang pasar binaan APPSI.
                    </p>
                </div>
                <div class="flex flex-col justify-center gap-2.5 border-slate-100 pt-3 lg:border-l lg:pl-7 lg:pt-0">
                    <div class="flex items-center gap-2 text-xs text-slate-600">
                        <i class="fa-solid fa-location-dot text-emerald-700"></i>
                        <span>Pasar Betung, Kec. Betung</span>
                    </div>
                    <div class="flex items-center gap-2 text-xs text-slate-600">
                        <i class="fa-regular fa-clock text-emerald-700"></i>
                        <span>08.30 WIB - Selesai</span>
                    </div>
                    <a href="#aspirasi" class="inline-flex items-center justify-center gap-2 rounded-xl font-semibold border border-emerald-200 bg-white text-emerald-800 hover:bg-emerald-50 h-9 px-3 text-xs w-full transition">
                        Hubungi Panitia
                    </a>
                </div>
            </article>

        </div>

    </div>
</section>

<!-- 4. KEANGGOTAAN APPSI (Banner & Metrik Mengadopsi appsi.id) -->
<section class="relative overflow-hidden bg-white py-14 sm:py-20 border-t border-slate-100" id="keanggotaan">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8 grid items-center gap-10 lg:grid-cols-[1fr_0.96fr]">
        
        <!-- Left Visual -->
        <div class="relative" data-aos="fade-up">
            <div class="overflow-hidden h-[320px] rounded-[1.35rem] shadow-[0_14px_42px_rgba(15,23,42,0.12)] sm:h-[390px] bg-slate-100">
                <img src="{{ asset('assets/images/keanggotaan-banner.png') }}" alt="Kegiatan keanggotaan APPSI" class="h-full w-full object-cover">
            </div>
            <div class="hero-dot-pattern absolute -bottom-6 -left-4 h-24 w-24 opacity-60 pointer-events-none"></div>
            <div class="absolute -bottom-3 left-4 h-20 w-20 rounded-full bg-emerald-700/80 pointer-events-none"></div>
        </div>

        <!-- Right Content -->
        <div class="relative" data-aos="fade-up">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-emerald-700">KEANGGOTAAN APPSI BANYUASIN</p>
            <h2 class="mt-3 max-w-xl text-3xl font-extrabold leading-tight text-emerald-900 sm:text-4xl">
                Bersatu, Berdaya, Berkarya untuk Pasar Banyuasin
            </h2>
            <p class="mt-4 max-w-xl text-sm leading-7 text-slate-600">
                Saat ini DPD APPSI hadir merangkul para pedagang pasar tradisional di seluruh kecamatan Kabupaten Banyuasin melalui jejaring Komisariat Pasar, advokasi harga, serta perlindungan izin usaha dan pembinaan UMKM.
            </p>

            <!-- Metrics -->
            <div class="mt-7 grid gap-4 sm:grid-cols-2">
                <div class="flex items-center gap-4 rounded-2xl border border-slate-100 bg-white p-5 shadow-[0_10px_28px_rgba(15,23,42,0.05)]">
                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-emerald-50 text-emerald-700">
                        <i class="fa-solid fa-users-viewfinder text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-extrabold text-emerald-800">{{ $stats['total_anggota'] ?: '1.500+' }}</p>
                        <p class="text-sm font-semibold text-slate-800">Pedagang Anggota</p>
                        <p class="mt-0.5 text-xs text-slate-500">Terdaftar aktif di sistem DPD</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-2xl border border-slate-100 bg-white p-5 shadow-[0_10px_28px_rgba(15,23,42,0.05)]">
                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-emerald-50 text-emerald-700">
                        <i class="fa-solid fa-store text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-extrabold text-emerald-800">{{ $stats['total_pasar'] ?: '10+' }}</p>
                        <p class="text-sm font-semibold text-slate-800">Pasar Tradisional</p>
                        <p class="mt-0.5 text-xs text-slate-500">Jejaring komisariat pasar daerah</p>
                    </div>
                </div>
            </div>

            <!-- Action Button -->
            <div class="mt-7 flex flex-wrap gap-3">
                <a href="{{ route('members.register') }}" class="inline-flex items-center justify-center gap-2 rounded-xl font-bold transition duration-200 bg-emerald-700 text-white shadow-[0_10px_24px_rgba(21,128,61,0.2)] hover:bg-emerald-800 h-11 px-6 text-sm">
                    Daftar Keanggotaan
                    <i class="fa-solid fa-user-plus text-xs"></i>
                </a>
                <a href="{{ route('members.public') }}" class="inline-flex items-center justify-center gap-2 rounded-xl font-bold transition duration-200 border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 h-11 px-5 text-sm">
                    Lihat Direktori Pedagang
                </a>
            </div>
        </div>

    </div>
</section>

<!-- 5. BANNER DUKUNG PERJUANGAN & FORMULIR BUKU TAMU / ASPIRASI -->
<section class="bg-slate-50/70 py-14 sm:py-20 border-t border-slate-100" id="aspirasi">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8">
        
        <!-- Support Banner (Adopsi appsi.id) -->
        <div class="flex flex-col gap-6 rounded-[1.35rem] bg-emerald-50/90 p-6 ring-1 ring-emerald-200 sm:p-8 md:flex-row md:items-center md:justify-between mb-12 shadow-sm" data-aos="fade-up">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-center">
                <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-white text-emerald-700 shadow-sm">
                    <i class="fa-solid fa-handshake-angle text-3xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-emerald-900 sm:text-2xl">Dukung Perjuangan Pedagang Pasar</h3>
                    <p class="mt-1 text-sm text-slate-600 max-w-xl">
                        Aspirasi, saran, dan dukungan Anda adalah energi bagi kami untuk terus memperkuat pedagang pasar tradisional demi kemajuan ekonomi kerakyatan Banyuasin.
                    </p>
                </div>
            </div>
            <a href="#form-aspirasi" class="inline-flex items-center justify-center gap-2 rounded-xl font-bold transition bg-emerald-700 text-white hover:bg-emerald-800 h-11 px-5 text-xs uppercase tracking-wider shrink-0 shadow">
                Kirim Aspirasi Sekarang
                <i class="fa-solid fa-paper-plane text-xs"></i>
            </a>
        </div>

        <!-- Guestbook / Aspirasi Form -->
        <div class="grid lg:grid-cols-12 gap-8 items-start" id="form-aspirasi" data-aos="fade-up">
            
            <div class="lg:col-span-5">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-700">SUARA PEDAGANG</span>
                <h3 class="mt-1 text-2xl font-extrabold text-slate-900">
                    Buku Tamu & Aspirasi Pasar
                </h3>
                <p class="mt-3 text-sm text-slate-600 leading-relaxed">
                    Sampaikan keluhan fasilitas pasar, kestabilan harga barang, usulan penataan lapak, atau kemitraan usaha langsung kepada jajaran Pengurus DPD APPSI Kabupaten Banyuasin.
                </p>

                <div class="mt-6 space-y-3.5">
                    <div class="flex items-center gap-3 text-sm text-slate-700 bg-white p-3.5 rounded-xl border border-slate-200/70 shadow-sm">
                        <i class="fa-solid fa-envelope-circle-check text-emerald-700 text-lg"></i>
                        <span>Respon cepat dari tim sekretariat DPD</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm text-slate-700 bg-white p-3.5 rounded-xl border border-slate-200/70 shadow-sm">
                        <i class="fa-solid fa-scale-balanced text-emerald-700 text-lg"></i>
                        <span>Penyaluran aspirasi resmi ke dinas & pemkab</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm text-slate-700 bg-white p-3.5 rounded-xl border border-slate-200/70 shadow-sm">
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
