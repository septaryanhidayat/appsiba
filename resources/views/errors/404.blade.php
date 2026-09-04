@extends('layouts.public')

@section('title', '404 - Halaman Tidak Ditemukan | DPD APPSI Banyuasin')

@section('content')
<section class="min-h-[650px] flex items-center justify-center py-16 bg-slate-50">
    <div class="mx-auto w-full max-w-lg px-5 text-center">
        <div class="rounded-3xl bg-white p-8 sm:p-12 border border-slate-200/80 shadow-lg">
            
            <div class="w-20 h-20 rounded-3xl bg-emerald-100 text-emerald-700 text-4xl flex items-center justify-center mx-auto mb-6 shadow-inner">
                <i class="fa-solid fa-map-location-dot"></i>
            </div>

            <span class="text-xs font-extrabold uppercase tracking-widest text-emerald-700">KODE ERROR 404</span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">Halaman Tidak Ditemukan</h1>
            
            <p class="mt-3 text-xs sm:text-sm text-slate-500 leading-relaxed">
                Mohon maaf, halaman atau tautan yang Anda tuju tidak tersedia, telah dipindahkan, atau alamat URL yang Anda masukkan salah.
            </p>

            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ route('home') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-700 px-6 py-3 text-xs sm:text-sm font-bold text-white shadow-md shadow-emerald-700/20 hover:bg-emerald-800 transition">
                    <i class="fa-solid fa-house"></i>
                    Kembali ke Beranda
                </a>
                <a href="{{ route('contact.public') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-slate-50 px-6 py-3 text-xs sm:text-sm font-bold text-slate-700 hover:bg-slate-100 transition">
                    <i class="fa-solid fa-headset"></i>
                    Bantuan / Kontak
                </a>
            </div>

        </div>
    </div>
</section>
@endsection
