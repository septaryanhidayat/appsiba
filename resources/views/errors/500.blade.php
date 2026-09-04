@extends('layouts.public')

@section('title', '500 - Terjadi Kesalahan Server | DPD APPSI Banyuasin')

@section('content')
<section class="min-h-[650px] flex items-center justify-center py-16 bg-slate-50">
    <div class="mx-auto w-full max-w-lg px-5 text-center">
        <div class="rounded-3xl bg-white p-8 sm:p-12 border border-slate-200/80 shadow-lg">
            
            <div class="w-20 h-20 rounded-3xl bg-red-100 text-red-600 text-4xl flex items-center justify-center mx-auto mb-6 shadow-inner">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>

            <span class="text-xs font-extrabold uppercase tracking-widest text-red-600">KODE ERROR 500</span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">Terjadi Gangguan Server</h1>
            
            <p class="mt-3 text-xs sm:text-sm text-slate-500 leading-relaxed">
                Sistem sedang mengalami kendala teknis sementara. Tim pengelola DPD APPSI Kabupaten Banyuasin telah menerima laporan ini untuk segera diperbaiki.
            </p>

            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ route('home') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-700 px-6 py-3 text-xs sm:text-sm font-bold text-white shadow-md shadow-emerald-700/20 hover:bg-emerald-800 transition">
                    <i class="fa-solid fa-house"></i>
                    Kembali ke Beranda
                </a>
                <a href="{{ route('contact.public') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-slate-50 px-6 py-3 text-xs sm:text-sm font-bold text-slate-700 hover:bg-slate-100 transition">
                    <i class="fa-solid fa-headset"></i>
                    Lapor ke Admin
                </a>
            </div>

        </div>
    </div>
</section>
@endsection
