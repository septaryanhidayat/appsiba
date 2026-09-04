@extends('layouts.public')

@section('title', 'Verifikasi Keabsahan Surat Digital - DPD APPSI Kabupaten Banyuasin')
@section('meta_description', 'Layanan verifikasi keabsahan dokumen dan surat dinas resmi DPD APPSI Kabupaten Banyuasin berbasis pemindaian QR Code dan nomor surat.')

@section('content')

<!-- Header Banner -->
<section class="relative bg-gradient-to-br from-emerald-950 via-emerald-900 to-slate-900 py-14 sm:py-18 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
    <div class="relative mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <span class="inline-flex items-center gap-2 rounded-full bg-emerald-500/20 px-4 py-1.5 text-xs font-bold uppercase tracking-wider text-emerald-300 ring-1 ring-emerald-400/30">
            <i class="fa-solid fa-shield-check text-xs"></i>
            VALIDASI DOKUMEN DIGITAL RESMI
        </span>
        <h1 class="mt-4 text-3xl font-extrabold sm:text-4xl lg:text-5xl">
            Verifikasi Keabsahan <span class="text-emerald-400">Surat APPSI</span>
        </h1>
        <p class="mt-3 mx-auto max-w-xl text-xs sm:text-sm text-emerald-100/90 leading-relaxed">
            Periksa keaslian dokumen, keabsahan tanda tangan pengurus, dan nomor register surat resmi DPD APPSI Kabupaten Banyuasin.
        </p>
    </div>
</section>

<!-- Main Verification Section -->
<section class="py-12 sm:py-16 bg-slate-50 min-h-[600px] flex items-center justify-center">
    <div class="mx-auto w-full max-w-2xl px-5 sm:px-6">
        
        <!-- Search Box Card (Always available at the top) -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-5 sm:p-6 shadow-sm mb-8" data-aos="fade-up">
            <form action="{{ route('letter.verify.index') }}" method="GET">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                    Masukkan Nomor Surat atau Kode Keabsahan
                </label>
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="relative flex-1">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-magnifying-glass text-sm"></i>
                        </span>
                        <input type="text" name="q" value="{{ request('q', $hash) }}" required placeholder="Contoh: 001/DPD-APPSI/BA/IX/2026 atau kode hash..." class="w-full pl-10 pr-4 py-3 rounded-2xl border border-slate-200 text-xs sm:text-sm font-semibold focus:border-emerald-600 focus:outline-none bg-slate-50/50">
                    </div>
                    <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-emerald-700 px-6 py-3 text-xs sm:text-sm font-bold text-white shadow-md shadow-emerald-700/20 hover:bg-emerald-800 transition">
                        <i class="fa-solid fa-qrcode text-sm"></i>
                        <span>Verifikasi</span>
                    </button>
                </div>
            </form>
        </div>

        @if($letter)
            <!-- HASIL VERIFIKASI: DOKUMEN SAH -->
            <div class="bg-white rounded-3xl border border-emerald-300 shadow-xl overflow-hidden relative" data-aos="fade-up">
                
                <!-- Header Sah -->
                <div class="bg-gradient-to-r from-emerald-800 via-emerald-700 to-emerald-900 p-8 text-white text-center relative overflow-hidden">
                    <div class="w-16 h-16 rounded-full bg-emerald-500/20 text-emerald-300 flex items-center justify-center text-3xl mx-auto mb-3 ring-4 ring-emerald-500/30">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <span class="inline-block px-3.5 py-1 bg-emerald-500/30 rounded-full text-xs font-extrabold uppercase tracking-widest text-emerald-200 border border-emerald-400/40 shadow-sm">
                        DOKUMEN RESMI TERVERIFIKASI
                    </span>
                    <h2 class="text-xl sm:text-2xl font-extrabold mt-2">Surat Sah & Terdaftar</h2>
                    <p class="text-xs text-emerald-100/80 mt-1">Sistem Informasi Manajemen Persuratan DPD APPSI Kabupaten Banyuasin</p>
                </div>

                <!-- Letter Metadata -->
                <div class="p-6 sm:p-8 space-y-4">
                    <div class="border-b border-slate-100 pb-3">
                        <span class="text-xs font-bold uppercase text-slate-400">Nomor Surat Resmi</span>
                        <p class="text-base font-extrabold text-emerald-900 mt-0.5 font-mono">{{ $letter->nomor_surat }}</p>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4 border-b border-slate-100 pb-3">
                        <div>
                            <span class="text-xs font-bold uppercase text-slate-400">Tanggal Terbit</span>
                            <p class="text-sm font-semibold text-slate-800 mt-0.5">{{ $letter->tanggal ? $letter->tanggal->translatedFormat('d F Y') : '-' }}</p>
                        </div>
                        <div>
                            <span class="text-xs font-bold uppercase text-slate-400">Jenis Dokumen</span>
                            <p class="text-sm font-semibold text-slate-800 mt-0.5">{{ $letter->jenis_surat }}</p>
                        </div>
                    </div>

                    <div class="border-b border-slate-100 pb-3">
                        <span class="text-xs font-bold uppercase text-slate-400">Tujuan / Penerima</span>
                        <p class="text-sm font-semibold text-slate-800 mt-0.5">{{ $letter->tujuan }}</p>
                        @if($letter->tempat_tujuan)
                            <p class="text-xs text-slate-500 mt-0.5">{{ $letter->tempat_tujuan }}</p>
                        @endif
                    </div>

                    <div class="border-b border-slate-100 pb-3">
                        <span class="text-xs font-bold uppercase text-slate-400">Perihal / Keperluan</span>
                        <p class="text-sm font-semibold text-slate-800 mt-0.5">{{ $letter->perihal ?? $letter->keperluan }}</p>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4 border-b border-slate-100 pb-3">
                        <div>
                            <span class="text-xs font-bold uppercase text-slate-400">Penandatangan Utama</span>
                            <p class="text-sm font-bold text-slate-900 mt-0.5">{{ $letter->nama_penandatangan }}</p>
                            <p class="text-xs text-slate-500">{{ $letter->jabatan_penandatangan }}</p>
                        </div>
                        <div>
                            <span class="text-xs font-bold uppercase text-slate-400">Sekretaris</span>
                            <p class="text-sm font-bold text-slate-900 mt-0.5">{{ $letter->nama_sekretaris ?? 'M. Rian Pratama, S.E.' }}</p>
                            <p class="text-xs text-slate-500">{{ $letter->jabatan_sekretaris ?? 'Sekretaris DPD APPSI Banyuasin' }}</p>
                        </div>
                    </div>

                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] font-bold uppercase text-slate-400 block">Kode Keabsahan Digital</span>
                            <code class="text-xs font-mono font-bold text-emerald-800">{{ $letter->hash_keabsahan }}</code>
                        </div>
                        <i class="fa-solid fa-qrcode text-3xl text-emerald-700/60"></i>
                    </div>

                    <div class="text-center pt-3 flex items-center justify-center gap-4">
                        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xs font-bold text-emerald-700 hover:text-emerald-800">
                            <i class="fa-solid fa-house"></i> Beranda
                        </a>
                        <a href="{{ route('contact.public') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-slate-800">
                            <i class="fa-solid fa-headset"></i> Konfirmasi Sekretariat
                        </a>
                    </div>
                </div>
            </div>

        @elseif($hash)
            <!-- HASIL VERIFIKASI: TIDAK DITEMUKAN -->
            <div class="bg-white rounded-3xl border border-red-200 shadow-lg overflow-hidden" data-aos="fade-up">
                
                <div class="bg-gradient-to-r from-red-700 to-red-900 p-8 text-white text-center">
                    <div class="w-16 h-16 rounded-full bg-red-500/20 text-red-200 flex items-center justify-center text-3xl mx-auto mb-3 ring-4 ring-red-500/30">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <span class="inline-block px-3.5 py-1 bg-red-500/30 rounded-full text-xs font-bold uppercase tracking-widest text-red-100 border border-red-400/40">
                        DOKUMEN TIDAK TERDAFTAR
                    </span>
                    <h2 class="text-xl sm:text-2xl font-extrabold mt-2">Surat Tidak Ditemukan</h2>
                    <p class="text-xs text-red-100/80 mt-1">Nomor atau kode verifikasi tidak tercatat pada pangkalan data resmi</p>
                </div>

                <div class="p-8 text-center space-y-4">
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed max-w-md mx-auto">
                        Kode atau Nomor Surat <code class="bg-slate-100 px-2 py-1 rounded text-red-600 font-mono text-xs font-bold">"{{ $hash }}"</code> tidak ditemukan dalam sistem persuratan DPD APPSI Kabupaten Banyuasin.
                    </p>
                    <p class="text-xs text-slate-500">
                        Pastikan Nomor Surat yang Anda masukkan sesuai persis dengan fisik surat yang diterima, atau hubungi Sekretariat DPD APPSI Banyuasin untuk konfirmasi manual.
                    </p>
                    <div class="pt-2 flex flex-wrap items-center justify-center gap-3">
                        <a href="{{ route('contact.public') }}" class="inline-flex items-center gap-2 rounded-xl bg-emerald-700 px-5 py-2.5 text-xs font-bold text-white hover:bg-emerald-800 transition">
                            <i class="fa-solid fa-headset"></i>
                            Hubungi Sekretariat
                        </a>
                        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-slate-50 px-5 py-2.5 text-xs font-bold text-slate-700 hover:bg-slate-100 transition">
                            <i class="fa-solid fa-house"></i>
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>

        @else
            <!-- PANDUAN AWAL VERIFIKASI (Ketika belum mencari) -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-sm" data-aos="fade-up">
                <h3 class="text-base font-extrabold text-slate-900 flex items-center gap-2.5 mb-3">
                    <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700 text-sm">
                        <i class="fa-solid fa-info"></i>
                    </span>
                    Panduan Verifikasi Dokumen Resmi
                </h3>
                <p class="text-xs text-slate-500 leading-relaxed mb-6">
                    Setiap dokumen resmi yang diterbitkan DPD APPSI Kabupaten Banyuasin telah dilengkapi tanda tangan digital dan QR Code unik demi mencegah pemalsuan surat.
                </p>

                <div class="grid sm:grid-cols-2 gap-4 text-xs text-slate-600">
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                        <div class="h-8 w-8 rounded-lg bg-emerald-700 text-white flex items-center justify-center font-bold mb-2">1</div>
                        <h4 class="font-bold text-slate-900 mb-1">Via Kamera HP / QR Scanner</h4>
                        <p class="text-slate-500 leading-relaxed">
                            Arahkan kamera smartphone Anda ke QR Code yang tercetak di sudut kanan bawah surat resmi untuk membuka halaman sertifikat keabsahan secara otomatis.
                        </p>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                        <div class="h-8 w-8 rounded-lg bg-emerald-700 text-white flex items-center justify-center font-bold mb-2">2</div>
                        <h4 class="font-bold text-slate-900 mb-1">Via Input Manual</h4>
                        <p class="text-slate-500 leading-relaxed">
                            Ketikkan Nomor Surat lengkap (contoh: <span class="font-mono text-emerald-700">001/DPD-APPSI/BA/IX/2026</span>) pada kolom pencarian di atas lalu klik tombol Verifikasi.
                        </p>
                    </div>
                </div>
            </div>
        @endif

    </div>
</section>

@endsection
