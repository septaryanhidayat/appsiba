@extends('layouts.public')

@section('title', 'Cek Status KTA Pedagang - DPD APPSI Kabupaten Banyuasin')
@section('meta_description', 'Layanan mandiri pengecekan keabsahan Kartu Tanda Anggota (KTA) dan status kepesertaan pedagang pasar DPD APPSI Kabupaten Banyuasin.')

@section('content')
<!-- Header Banner -->
<section class="relative bg-gradient-to-br from-emerald-950 via-emerald-900 to-slate-900 py-16 sm:py-20 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
    <div class="relative mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <span class="inline-flex items-center gap-2 rounded-full bg-emerald-500/20 px-4 py-1.5 text-xs font-bold uppercase tracking-wider text-emerald-300 ring-1 ring-emerald-400/30">
            <i class="fa-solid fa-id-card-clip text-xs"></i>
            VALIDASI ANGGOTA RESMI
        </span>
        <h1 class="mt-4 text-3xl font-extrabold sm:text-4xl lg:text-5xl">
            Cek Keabsahan <span class="text-emerald-400">KTA Pedagang</span>
        </h1>
        <p class="mt-4 mx-auto max-w-2xl text-sm sm:text-base text-emerald-100/90 leading-relaxed">
            Periksa keaktifan status keanggotaan pedagang pasar DPD APPSI Kabupaten Banyuasin menggunakan Nomor Pokok Anggota (NPA) atau Nomor Induk Kependudukan (NIK).
        </p>
    </div>
</section>

<!-- Main Checking Content -->
<section class="py-12 sm:py-16 bg-slate-50">
    <div class="mx-auto w-full max-w-[760px] px-5 sm:px-6 lg:px-8">
        
        <!-- Search Card -->
        <div class="rounded-3xl bg-white p-6 sm:p-8 border border-slate-200/80 shadow-sm mb-8" data-aos="fade-up">
            <form action="{{ route('members.check') }}" method="GET">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                    Masukkan Nomor NPA atau NIK Pedagang
                </label>
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="relative flex-1">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-magnifying-glass text-sm"></i>
                        </span>
                        <input type="text" name="q" value="{{ request('q') }}" required placeholder="Contoh: DPD-BA-01.0001 atau 1607..." class="w-full pl-10 pr-4 py-3 rounded-2xl border border-slate-200 text-xs sm:text-sm font-semibold focus:border-emerald-600 focus:outline-none bg-slate-50/50">
                    </div>
                    <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-emerald-700 px-6 py-3 text-xs sm:text-sm font-bold text-white shadow-md shadow-emerald-700/20 hover:bg-emerald-800 transition">
                        <i class="fa-solid fa-check"></i>
                        <span>Cek Status</span>
                    </button>
                </div>
                <p class="mt-2 text-[11px] text-slate-400">
                    * Format NPA: <span class="font-mono font-bold text-slate-600">DPD-BA-01.XXXX</span> atau ketikkan 16 digit NIK yang terdaftar.
                </p>
            </form>
        </div>

        <!-- Result Area -->
        @if($searched)
            @if($member)
                <!-- Found Result Card -->
                <div class="rounded-3xl bg-white p-6 sm:p-8 border border-emerald-200 shadow-md relative overflow-hidden" data-aos="fade-up">
                    <div class="absolute top-0 right-0 bg-emerald-600 text-white text-[11px] font-extrabold uppercase tracking-wider py-1 px-4 rounded-bl-2xl">
                        <i class="fa-solid fa-circle-check mr-1"></i> Terverifikasi Resmi
                    </div>

                    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6 pt-3">
                        <div class="w-24 h-32 rounded-2xl overflow-hidden bg-slate-100 border-2 border-emerald-300 shadow-sm shrink-0">
                            <img src="{{ $member->foto_url }}" alt="{{ $member->nama }}" class="w-full h-full object-cover">
                        </div>

                        <div class="flex-1 text-center sm:text-left">
                            <span class="inline-block px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-[11px] font-bold border border-emerald-200 font-mono">
                                NPA: {{ $member->nomor_anggota }}
                            </span>
                            <h2 class="mt-2 text-xl font-extrabold text-slate-900">{{ $member->nama }}</h2>
                            <p class="text-xs font-bold text-emerald-700">{{ $member->nama_usaha }} &bull; {{ $member->bentuk_usaha }}</p>

                            <div class="mt-5 grid grid-cols-2 gap-3 p-4 rounded-2xl bg-slate-50 text-left text-xs border border-slate-100">
                                <div>
                                    <span class="block text-[10px] uppercase font-bold text-slate-400">Lokasi Pasar</span>
                                    <span class="font-bold text-slate-800">{{ $member->lokasi_pasar }}</span>
                                </div>
                                <div>
                                    <span class="block text-[10px] uppercase font-bold text-slate-400">Komoditas Usaha</span>
                                    <span class="font-bold text-slate-800">{{ $member->jenis_usaha }}</span>
                                </div>
                                <div>
                                    <span class="block text-[10px] uppercase font-bold text-slate-400">Blok / Nomor Kios</span>
                                    <span class="font-bold text-slate-800">{{ $member->blok_nomor ?? 'Los / Lapak Pasar' }}</span>
                                </div>
                                <div>
                                    <span class="block text-[10px] uppercase font-bold text-slate-400">Status Keanggotaan</span>
                                    <span class="inline-flex items-center gap-1 font-bold text-emerald-700">
                                        <i class="fa-solid fa-circle text-[8px]"></i>
                                        {{ ucfirst($member->status) }}
                                    </span>
                                </div>
                            </div>

                            <div class="mt-5 flex flex-wrap gap-2 justify-center sm:justify-start">
                                <a href="{{ route('members.public') }}?q={{ urlencode($member->nomor_anggota) }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-emerald-700 text-white text-xs font-bold hover:bg-emerald-800 transition">
                                    <i class="fa-solid fa-address-card"></i>
                                    Lihat di Direktori Pedagang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Not Found Card -->
                <div class="rounded-3xl bg-white p-8 border border-red-200 shadow-sm text-center" data-aos="fade-up">
                    <div class="w-14 h-14 rounded-2xl bg-red-100 text-red-600 text-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <h3 class="text-base font-extrabold text-slate-900">Data Pedagang Tidak Ditemukan</h3>
                    <p class="mt-2 text-xs sm:text-sm text-slate-500 max-w-md mx-auto leading-relaxed">
                        Nomor NPA atau NIK <strong class="text-slate-800 font-mono">"{{ request('q') }}"</strong> belum terdaftar dalam pangkalan data resmi DPD APPSI Kabupaten Banyuasin.
                    </p>
                    <div class="mt-6 flex flex-wrap items-center justify-center gap-3">
                        <a href="{{ route('members.register') }}" class="inline-flex items-center gap-2 rounded-xl bg-emerald-700 px-5 py-2.5 text-xs sm:text-sm font-bold text-white hover:bg-emerald-800 transition shadow-sm">
                            <i class="fa-solid fa-user-plus"></i>
                            Daftar Anggota Baru Online
                        </a>
                        <a href="{{ route('contact.public') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-slate-50 px-5 py-2.5 text-xs sm:text-sm font-bold text-slate-700 hover:bg-slate-100 transition">
                            <i class="fa-solid fa-headset"></i>
                            Hubungi Pengurus
                        </a>
                    </div>
                </div>
            @endif
        @else
            <!-- Helper Information Card when not yet searched -->
            <div class="rounded-3xl bg-white p-6 sm:p-7 border border-slate-200/80 shadow-sm" data-aos="fade-up">
                <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2 mb-3">
                    <i class="fa-solid fa-circle-info text-emerald-600"></i>
                    Informasi Pengecekan KTA
                </h3>
                <ul class="text-xs text-slate-600 space-y-2 leading-relaxed">
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-check text-emerald-600 mt-0.5 text-[10px]"></i>
                        <span>Pastikan Nomor Pokok Anggota (NPA) yang Anda masukkan sesuai dengan yang tercantum pada fisik KTA atau bukti pendaftaran online.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-check text-emerald-600 mt-0.5 text-[10px]"></i>
                        <span>Jika Anda baru saja mendaftar online, status data akan aktif setelah diverifikasi oleh verifikator DPD APPSI dalam 1x24 jam kerja.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-check text-emerald-600 mt-0.5 text-[10px]"></i>
                        <span>KTA yang sah dapat digunakan untuk verifikasi pengajuan program permodalan KUR dan bantuan hukum organisasi.</span>
                    </li>
                </ul>
            </div>
        @endif

    </div>
</section>
@endsection
