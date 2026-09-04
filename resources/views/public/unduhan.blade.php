@extends('layouts.public')

@section('title', 'Pusat Unduhan Dokumen & Formulir - DPD APPSI Kabupaten Banyuasin')
@section('meta_description', 'Pusat unduhan berkas resmi, formulir keanggotaan offline, panduan advokasi hukum pedagang, dan berkas rekomendasi KUR DPD APPSI Kabupaten Banyuasin.')

@section('content')

<!-- 1. Header Banner -->
<section class="relative bg-gradient-to-br from-[#063327] via-[#04281f] to-slate-900 py-16 sm:py-20 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#10b981_1px,transparent_1px)] [background-size:18px_18px] pointer-events-none"></div>
    <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-emerald-500/10 blur-3xl pointer-events-none"></div>

    <div class="relative mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <span class="inline-flex items-center gap-2 rounded-full bg-emerald-500/20 px-4 py-1.5 text-xs font-bold uppercase tracking-wider text-emerald-300 ring-1 ring-emerald-400/30">
            <i class="fa-solid fa-file-arrow-down text-xs"></i>
            LAYANAN PUBLIK & ARSIP RESMI
        </span>
        <h1 class="mt-4 text-3xl font-black tracking-tight sm:text-4xl lg:text-5xl text-white">
            Pusat Unduhan <span class="text-emerald-400">Dokumen Resmi</span>
        </h1>
        <p class="mt-4 mx-auto max-w-2xl text-sm sm:text-base text-emerald-100/90 leading-relaxed">
            Akses dan unduh berkas formulir pendaftaran anggota offline, pedoman advokasi hukum pedagang, syarat rekomendasi KUR mikro, dan legalitas AD/ART DPD APPSI Kabupaten Banyuasin.
        </p>

        <!-- Search Bar Publik -->
        <div class="mt-8 max-w-xl mx-auto">
            <form action="{{ route('downloads.public') }}" method="GET" class="relative flex items-center">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-emerald-300">
                    <i class="fa-solid fa-magnifying-glass text-sm"></i>
                </div>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul formulir, surat atau dokumen..." class="w-full pl-11 pr-28 py-3.5 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 text-white placeholder-emerald-200/60 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:bg-white/15 transition shadow-lg">
                <button type="submit" class="absolute right-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs transition shadow-sm">
                    Cari Berkas
                </button>
            </form>
            @if(request('q'))
                <div class="mt-2 text-xs text-emerald-200 flex items-center justify-center gap-2">
                    <span>Hasil pencarian: "<strong>{{ request('q') }}</strong>"</span>
                    <a href="{{ route('downloads.public') }}" class="underline hover:text-white">&times; Hapus Filter</a>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- 2. Content Section -->
<section class="py-12 sm:py-16 bg-slate-50">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8">
        
        @if($groupedDocuments->isEmpty())
            <div class="rounded-3xl bg-white p-12 text-center border border-slate-200/80 shadow-sm max-w-lg mx-auto">
                <div class="h-16 w-16 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto text-2xl mb-4">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
                <h3 class="text-base font-extrabold text-slate-800">Tidak Ditemukan Dokumen</h3>
                <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                    Berkas dokumen yang Anda cari tidak ditemukan atau belum dipublikasikan.
                </p>
                <div class="mt-5">
                    <a href="{{ route('downloads.public') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-700 text-white text-xs font-bold hover:bg-emerald-800 transition">
                        <span>Lihat Semua Berkas Unduhan</span>
                    </a>
                </div>
            </div>
        @else
            <div class="grid gap-8 lg:grid-cols-3 items-start">
                
                @foreach($groupedDocuments as $kategori => $docs)
                    @php
                        // Color styling berdasarkan kategori
                        $isKeanggotaan = str_contains(strtolower($kategori), 'keanggotaan') || str_contains(strtolower($kategori), 'formulir');
                        $isAdvokasi = str_contains(strtolower($kategori), 'advokasi') || str_contains(strtolower($kategori), 'modal') || str_contains(strtolower($kategori), 'kur');
                        $isLegalitas = str_contains(strtolower($kategori), 'legalitas') || str_contains(strtolower($kategori), 'organisasi') || str_contains(strtolower($kategori), 'ad/art');

                        if ($isKeanggotaan) {
                            $icon = 'fa-id-card';
                            $iconBg = 'bg-emerald-100 text-emerald-700';
                            $btnBg = 'bg-emerald-700 hover:bg-emerald-800';
                            $linkRoute = route('members.register');
                            $linkText = 'Daftar secara Online saja';
                        } elseif ($isAdvokasi) {
                            $icon = 'fa-file-contract';
                            $iconBg = 'bg-amber-100 text-amber-700';
                            $btnBg = 'bg-amber-600 hover:bg-amber-700';
                            $linkRoute = route('contact.public');
                            $linkText = 'Konsultasi dengan Pengurus';
                        } elseif ($isLegalitas) {
                            $icon = 'fa-landmark';
                            $iconBg = 'bg-blue-100 text-blue-700';
                            $btnBg = 'bg-blue-600 hover:bg-blue-700';
                            $linkRoute = route('organization.public');
                            $linkText = 'Lihat Struktur Pengurus';
                        } else {
                            $icon = 'fa-folder-open';
                            $iconBg = 'bg-violet-100 text-violet-700';
                            $btnBg = 'bg-violet-600 hover:bg-violet-700';
                            $linkRoute = route('contact.public');
                            $linkText = 'Hubungi Sekretariat DPD';
                        }
                    @endphp

                    <div class="rounded-3xl bg-white p-6 sm:p-7 border border-slate-200/80 shadow-sm flex flex-col justify-between h-full" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div>
                            <!-- Header Kategori -->
                            <div class="flex items-center gap-3 mb-5">
                                <div class="h-10 w-10 rounded-xl {{ $iconBg }} flex items-center justify-center text-lg shrink-0 shadow-sm">
                                    <i class="fa-solid {{ $icon }}"></i>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h3 class="text-base font-bold text-slate-900 truncate">{{ $kategori }}</h3>
                                    <p class="text-[11px] text-slate-500">{{ $docs->count() }} Berkas Tersedia</p>
                                </div>
                            </div>

                            <!-- List Dokumen -->
                            <div class="space-y-3">
                                @foreach($docs as $doc)
                                    <div class="p-3.5 rounded-2xl bg-slate-50/80 border border-slate-200/70 hover:border-emerald-300 hover:bg-white hover:shadow-sm transition-all duration-200">
                                        <div class="flex items-start justify-between gap-3">
                                            <div class="min-w-0 flex-1">
                                                <h4 class="text-xs font-bold text-slate-900 leading-snug">{{ $doc->judul }}</h4>
                                                @if($doc->deskripsi)
                                                    <p class="text-[11px] text-slate-500 mt-1 line-clamp-2 leading-relaxed">{{ $doc->deskripsi }}</p>
                                                @endif
                                                <div class="flex items-center gap-2 mt-2 text-[10px] text-slate-400 font-medium">
                                                    <span class="px-1.5 py-0.5 rounded bg-slate-200/80 text-slate-700 font-bold uppercase text-[9px]">{{ $doc->tipe_file }}</span>
                                                    <span>&bull;</span>
                                                    <span>{{ $doc->ukuran_file }}</span>
                                                    <span>&bull;</span>
                                                    <span class="text-emerald-700 font-semibold"><i class="fa-solid fa-download text-[8px]"></i> {{ number_format($doc->jumlah_unduhan) }}x diunduh</span>
                                                </div>
                                            </div>

                                            <!-- Tombol Unduh Nyata (Bukan Demo) -->
                                            <a href="{{ route('downloads.file', $doc->id) }}" 
                                               class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl {{ $btnBg }} text-white transition-all shadow-sm hover:scale-105 active:scale-95 group" 
                                               title="Unduh Berkas Resmi: {{ $doc->nama_file }}">
                                                <i class="fa-solid fa-download text-xs group-hover:-translate-y-0.5 transition-transform"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Footer Link Kategori -->
                        <div class="mt-6 pt-4 border-t border-slate-100">
                            <a href="{{ $linkRoute }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-700 hover:text-emerald-800 transition">
                                <span>{{ $linkText }}</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>

                @endforeach

            </div>
        @endif

        <!-- Card Bantuan & Permohonan Berkas Khusus -->
        <div class="mt-12 rounded-3xl bg-gradient-to-br from-emerald-900 via-emerald-800 to-[#04281f] p-7 sm:p-9 text-white shadow-md flex flex-col md:flex-row items-center justify-between gap-6" data-aos="fade-up">
            <div class="max-w-xl text-center md:text-left">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-700/60 text-emerald-200 text-[11px] font-bold mb-2 border border-emerald-500/30">
                    <i class="fa-solid fa-circle-info text-xs"></i> BUTUH BERKAS ATAU REGULASI LAIN?
                </span>
                <h3 class="text-lg sm:text-xl font-black">Layanan Permintaan Dokumen & Salinan Fisik</h3>
                <p class="mt-1.5 text-xs sm:text-sm text-emerald-100/80 leading-relaxed">
                    Sekretariat DPD APPSI Banyuasin melayani permohonan berkas cetak bertanda tangan basah dan cap resmi untuk keperluan administrasi perbankan, perizinan dinas, atau audiensi.
                </p>
            </div>
            <div class="shrink-0 flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                <a href="{{ route('contact.public') }}" class="px-5 py-3 rounded-xl bg-white text-emerald-900 font-bold text-xs hover:bg-emerald-50 transition text-center shadow-sm">
                    Hubungi Sekretariat DPD
                </a>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $webSetting['whatsapp'] ?? '62811618808') }}?text=Halo%20Pengurus%20DPD%20APPSI%20Banyuasin,%20saya%20ingin%20meminta%20salinan%20dokumen..." target="_blank" class="px-5 py-3 rounded-xl bg-emerald-700/80 hover:bg-emerald-600 text-white font-bold text-xs transition text-center border border-emerald-500/40">
                    <i class="fa-brands fa-whatsapp mr-1.5"></i> Chat WhatsApp
                </a>
            </div>
        </div>

    </div>
</section>

@endsection
