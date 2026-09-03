@extends('layouts.public')

@section('title', 'Verifikasi Keabsahan Surat Digital - DPD APPSI Kabupaten Banyuasin')

@section('content')

<section class="py-14 sm:py-20 bg-slate-50 min-h-[700px] flex items-center justify-center">
    <div class="mx-auto w-full max-w-2xl px-5 sm:px-6">
        
        <div class="bg-white rounded-3xl border border-slate-200/90 shadow-xl overflow-hidden" data-aos="fade-up">
            
            @if($letter)
                <!-- Header Sah -->
                <div class="bg-gradient-to-r from-emerald-800 to-emerald-950 p-8 text-white text-center">
                    <div class="w-16 h-16 rounded-full bg-emerald-500/20 text-emerald-300 flex items-center justify-center text-3xl mx-auto mb-3 ring-4 ring-emerald-500/30">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <span class="inline-block px-3 py-1 bg-emerald-500/30 rounded-full text-xs font-bold uppercase tracking-widest text-emerald-200 border border-emerald-400/40">
                        DOKUMEN RESMI TERVERIFIKASI
                    </span>
                    <h2 class="text-xl sm:text-2xl font-extrabold mt-2">Surat Sah & Terdaftar</h2>
                    <p class="text-xs text-emerald-100/80 mt-1">Sistem Informasi Manajemen Persuratan Digital DPD APPSI Kabupaten Banyuasin</p>
                </div>

                <!-- Letter Metadata -->
                <div class="p-6 sm:p-8 space-y-4">
                    <div class="border-b border-slate-100 pb-3">
                        <span class="text-xs font-bold uppercase text-slate-400">Nomor Surat</span>
                        <p class="text-base font-extrabold text-emerald-900 mt-0.5">{{ $letter->nomor_surat }}</p>
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
                            <p class="text-xs text-slate-500">{{ $letter->tempat_tujuan }}</p>
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
                        <i class="fa-solid fa-qrcode text-3xl text-slate-400"></i>
                    </div>

                    <div class="text-center pt-2">
                        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xs font-bold text-emerald-700 hover:text-emerald-800">
                            <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda APPSI
                        </a>
                    </div>
                </div>
            @else
                <!-- Header Tidak Ditemukan -->
                <div class="bg-gradient-to-r from-red-700 to-red-900 p-8 text-white text-center">
                    <div class="w-16 h-16 rounded-full bg-red-500/20 text-red-200 flex items-center justify-center text-3xl mx-auto mb-3 ring-4 ring-red-500/30">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <span class="inline-block px-3 py-1 bg-red-500/30 rounded-full text-xs font-bold uppercase tracking-widest text-red-100 border border-red-400/40">
                        VERIFIKASI GAGAL
                    </span>
                    <h2 class="text-xl sm:text-2xl font-extrabold mt-2">Surat Tidak Ditemukan</h2>
                    <p class="text-xs text-red-100/80 mt-1">Kode verifikasi tidak terdaftar pada pangkalan data resmi DPD APPSI Banyuasin</p>
                </div>

                <div class="p-8 text-center space-y-4">
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Dokumen dengan kode verifikasi <code class="bg-slate-100 px-2 py-1 rounded text-red-600 font-mono text-xs">{{ $hash }}</code> tidak valid atau belum terdaftar dalam sistem resmi kami.
                    </p>
                    <p class="text-xs text-slate-500">
                        Harap pastikan Anda memindai QR Code resmi yang tercetak pada dokumen surat APPSI Banyuasin.
                    </p>
                    <div class="pt-4">
                        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-5 py-2.5 text-xs font-bold text-white hover:bg-slate-800">
                            Kembali ke Portal
                        </a>
                    </div>
                </div>
            @endif

        </div>

    </div>
</section>

@endsection
