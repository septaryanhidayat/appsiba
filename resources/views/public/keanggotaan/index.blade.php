@extends('layouts.public')

@section('title', 'Direktori Keanggotaan Pedagang - DPD APPSI Kabupaten Banyuasin')

@section('content')

<!-- Header Banner -->
<section class="bg-gradient-to-b from-emerald-50/70 via-white to-white py-12 sm:py-16 border-b border-slate-100">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <span class="inline-block rounded-full bg-emerald-100 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-emerald-800">
            DIREKTORI PASAR TRADISIONAL
        </span>
        <h1 class="mt-3 text-3xl font-extrabold text-slate-900 sm:text-4xl">
            Keanggotaan Pedagang <span class="text-emerald-700">APPSI Banyuasin</span>
        </h1>
        <p class="mt-3 text-sm text-slate-600 sm:text-base max-w-2xl mx-auto">
            Daftar resmi pelaku usaha dan pedagang pasar tradisional yang terdaftar dan terverifikasi dalam naungan DPD APPSI Kabupaten Banyuasin.
        </p>

        <!-- CTA Register & Check Buttons -->
        <div class="mt-6 flex flex-wrap justify-center gap-3">
            <a href="{{ route('members.register') }}" class="inline-flex items-center gap-2 rounded-xl bg-emerald-700 px-6 py-3 text-sm font-bold text-white shadow hover:bg-emerald-800 transition">
                <i class="fa-solid fa-user-plus text-xs"></i>
                Daftar Pedagang Baru
            </a>
            <a href="{{ route('members.check') }}" class="inline-flex items-center gap-2 rounded-xl border border-emerald-300 bg-white px-6 py-3 text-sm font-bold text-emerald-800 shadow-sm hover:bg-emerald-50 transition">
                <i class="fa-solid fa-id-card-clip text-xs text-emerald-600"></i>
                Cek Status KTA Anda
            </a>
        </div>
    </div>
</section>

<!-- Filter & Directory Content / Protected View -->
@if(($webSetting['tampilkan_daftar_anggota'] ?? '1') == '1')
<section class="py-12 bg-slate-50/50 min-h-[600px]">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8">
        
        <!-- Filter Card -->
        <div class="bg-white rounded-2xl border border-slate-200/80 p-5 sm:p-6 mb-10 shadow-sm" data-aos="fade-up">
            <form action="{{ route('members.public') }}" method="GET" class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                
                <!-- Filter Komoditas -->
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Jenis Usaha / Komoditas</label>
                    <select name="jenis_usaha" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600">
                        <option value="">-- Semua Komoditas --</option>
                        @foreach($commodities as $com)
                            <option value="{{ $com }}" {{ request('jenis_usaha') == $com ? 'selected' : '' }}>{{ $com }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Lokasi Pasar -->
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Lokasi Pasar</label>
                    <select name="lokasi_pasar" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600">
                        <option value="">-- Semua Pasar --</option>
                        @foreach($markets as $mkt)
                            <option value="{{ $mkt }}" {{ request('lokasi_pasar') == $mkt ? 'selected' : '' }}>{{ $mkt }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Pencarian Nama / Kios -->
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Cari Pedagang / Toko</label>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Nama pedagang, toko, NPA..." class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600">
                </div>

                <!-- Buttons -->
                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 rounded-xl bg-emerald-700 py-2.5 text-xs font-bold text-white hover:bg-emerald-800 transition">
                        <i class="fa-solid fa-filter mr-1"></i> Terapkan
                    </button>
                    <a href="{{ route('members.public') }}" class="rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2.5 text-xs font-bold text-slate-600 hover:bg-slate-100 transition">
                        Reset
                    </a>
                </div>

            </form>
        </div>

        <!-- Traders Grid -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($members as $trader)
                <div class="group bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm hover:shadow-md hover:border-emerald-400 transition flex flex-col justify-between" data-aos="fade-up">
                    <div>
                        <!-- Header with Gray Avatar & NPA -->
                        <div class="flex items-start justify-between gap-3 mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-14 h-14 rounded-full overflow-hidden bg-slate-100 shrink-0 border border-slate-200">
                                    <img src="{{ $trader->foto_url }}" alt="{{ $trader->nama }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h3 class="text-base font-bold text-slate-900 leading-snug">{{ $trader->nama }}</h3>
                                    <p class="text-xs font-medium text-slate-500">{{ $trader->nomor_anggota }}</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">
                                <i class="fa-solid fa-check-circle text-[9px]"></i> Aktif
                            </span>
                        </div>

                        <!-- Shop & Commodity Info -->
                        <div class="bg-slate-50 rounded-xl p-3.5 space-y-2 border border-slate-100">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-shop text-emerald-700 text-xs w-4"></i>
                                <span class="text-xs font-bold text-slate-800">{{ $trader->nama_usaha }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-tag text-emerald-700 text-xs w-4"></i>
                                <span class="text-xs text-slate-600">{{ $trader->jenis_usaha }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-location-dot text-emerald-700 text-xs w-4"></i>
                                <span class="text-xs text-slate-600">{{ $trader->lokasi_pasar }} ({{ $trader->blok_nomor ?? $trader->bentuk_usaha }})</span>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Details -->
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                        <span>Bentuk: <strong>{{ $trader->bentuk_usaha }}</strong></span>
                        <span>Sejak: <strong>{{ $trader->terdaftar_sejak ? $trader->terdaftar_sejak->format('Y') : '2022' }}</strong></span>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-16 bg-white rounded-2xl border border-slate-100 text-slate-400">
                    <i class="fa-solid fa-store-slash text-4xl mb-3 text-slate-300"></i>
                    <p class="text-base font-semibold text-slate-600">Tidak ada data pedagang yang sesuai filter.</p>
                    <p class="text-xs text-slate-400 mt-1">Silakan coba kata kunci lain atau reset filter.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-10">
            {{ $members->links() }}
        </div>

    </div>
</section>
@else
<section class="py-12 bg-slate-50/50 min-h-[500px]">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8">
        
        <!-- Protected Directory Notice -->
        <div class="max-w-3xl mx-auto bg-white rounded-3xl border border-slate-200/80 p-8 sm:p-10 shadow-sm text-center" data-aos="fade-up">
            <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-700 mx-auto flex items-center justify-center text-2xl shadow-inner mb-5">
                <i class="fa-solid fa-user-shield"></i>
            </div>
            
            <span class="inline-block rounded-full bg-slate-100 text-slate-700 text-[11px] font-bold px-3 py-1 uppercase tracking-wider mb-2">
                Privasi & Perlindungan Data Pedagang
            </span>
            <h2 class="text-xl sm:text-2xl font-bold text-slate-900">
                Pangkalan Data Direktori Anggota Terproteksi
            </h2>
            <p class="mt-3 text-sm text-slate-600 leading-relaxed max-w-xl mx-auto">
                Untuk menjaga keamanan informasi dan privasi data pelaku usaha pasar tradisional binaan DPD APPSI Kabupaten Banyuasin, daftar anggota lengkap tidak dipublikasikan secara terbuka kepada umum.
            </p>

            <div class="mt-8 grid sm:grid-cols-2 gap-4 text-left">
                <!-- Card 1: Daftar Baru -->
                <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 flex flex-col justify-between hover:border-emerald-300 transition">
                    <div>
                        <div class="flex items-center gap-2.5 mb-2">
                            <span class="h-8 w-8 rounded-lg bg-emerald-700 text-white flex items-center justify-center text-xs">
                                <i class="fa-solid fa-user-plus"></i>
                            </span>
                            <h3 class="text-sm font-bold text-slate-900">Pendaftaran KTA Baru</h3>
                        </div>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Bagi pedagang pasar tradisional di wilayah Kabupaten Banyuasin yang belum memiliki kartu anggota, silakan ajukan permohonan pendaftaran resmi online.
                        </p>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('members.register') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-700 hover:text-emerald-800">
                            Isi Formulir Pendaftaran <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>

                <!-- Card 2: Cek Mandiri -->
                <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 flex flex-col justify-between hover:border-emerald-300 transition">
                    <div>
                        <div class="flex items-center gap-2.5 mb-2">
                            <span class="h-8 w-8 rounded-lg bg-emerald-700 text-white flex items-center justify-center text-xs">
                                <i class="fa-solid fa-id-card-clip"></i>
                            </span>
                            <h3 class="text-sm font-bold text-slate-900">Validasi KTA Mandiri</h3>
                        </div>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Pedagang yang telah terdaftar dapat memeriksa status keaktifan dan keaslian kartu anggota secara mandiri menggunakan nomor KTA atau NIK KTP.
                        </p>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('members.check') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-700 hover:text-emerald-800">
                            Cek Status KTA Sekarang <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Posko Info -->
            <div class="mt-8 pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500">
                <span>Perlu informasi atau permohonan data keanggotaan resmi?</span>
                <a href="{{ route('contact.public') }}" class="font-bold text-emerald-700 hover:underline">
                    Hubungi Sekretariat DPD APPSI <i class="fa-solid fa-chevron-right text-[9px]"></i>
                </a>
            </div>
        </div>

    </div>
</section>
@endif

@endsection
