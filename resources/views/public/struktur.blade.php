@extends('layouts.public')

@section('title', 'Struktur Organisasi - DPD APPSI Kabupaten Banyuasin')

@section('content')

<!-- Header Banner -->
<section class="bg-gradient-to-b from-emerald-50/70 via-white to-white py-12 sm:py-16 border-b border-slate-100">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <span class="inline-block rounded-full bg-emerald-100 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-emerald-800">
            KEPENGURUSAN DAERAH
        </span>
        <h1 class="mt-3 text-3xl font-extrabold text-slate-900 sm:text-4xl lg:text-5xl">
            Struktur <span class="text-emerald-700">Organisasi</span>
        </h1>
        <p class="mt-3 text-sm text-slate-600 sm:text-base max-w-2xl mx-auto">
            Dewan Pimpinan Daerah (DPD) Asosiasi Pedagang Pasar Seluruh Indonesia Kabupaten Banyuasin Periode 2024 - 2029
        </p>
    </div>
</section>

<!-- Organization Tree / Cards (Adopsi appsi.id/struktur-organisasi) -->
<section class="py-14 sm:py-20 bg-white">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8">
        
        <!-- Pimpinan Inti / Dewan Pengurus -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-2 max-w-4xl mx-auto mb-16" data-aos="fade-up">
            
            <!-- Ketua DPD APPSI Banyuasin -->
            <div class="col-span-1 md:col-span-2 bg-gradient-to-br from-emerald-50 to-white rounded-2xl border-2 border-emerald-300 p-6 sm:p-8 flex flex-col sm:flex-row items-center gap-6 shadow-sm">
                <div class="w-28 h-36 rounded-xl overflow-hidden border-2 border-emerald-500 bg-gradient-to-b from-white to-emerald-50 shrink-0 shadow">
                    <img src="{{ asset('assets/images/ketua-appsi-banyuasin.webp') }}" alt="H. Gusra Yetri, SH" class="w-full h-full object-cover object-top">
                </div>
                <div class="text-center sm:text-left flex-1">
                    <span class="inline-block rounded-md bg-emerald-700 px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-white">
                        KETUA DPD
                    </span>
                    <h3 class="mt-2 text-2xl font-extrabold text-slate-900">H. Gusra Yetri, SH</h3>
                    <p class="text-sm font-semibold text-emerald-800 mt-0.5">Ketua DPD APPSI Kabupaten Banyuasin</p>
                    <p class="mt-2 text-xs text-slate-600 leading-relaxed">
                        Memimpin koordinasi dan arah kebijakan organisasi pedagang pasar seluruh Indonesia di wilayah Kabupaten Banyuasin.
                    </p>
                </div>
            </div>

            @foreach($pimpinanHarian as $official)
                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 flex items-center gap-4 shadow-sm hover:border-emerald-300 transition">
                    <div class="w-16 h-16 rounded-full overflow-hidden bg-slate-100 shrink-0 border border-slate-200">
                        <img src="{{ $official->foto_url }}" alt="{{ $official->nama }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded">
                            {{ $official->jabatan }}
                        </span>
                        <h4 class="mt-1 text-base font-bold text-slate-900">{{ $official->nama }}</h4>
                        <p class="text-xs text-slate-500">{{ $official->divisi }}</p>
                    </div>
                </div>
            @endforeach

            @foreach($sekretariat as $official)
                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 flex items-center gap-4 shadow-sm hover:border-emerald-300 transition">
                    <div class="w-16 h-16 rounded-full overflow-hidden bg-slate-100 shrink-0 border border-slate-200">
                        <img src="{{ $official->foto_url }}" alt="{{ $official->nama }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded">
                            {{ $official->jabatan }}
                        </span>
                        <h4 class="mt-1 text-base font-bold text-slate-900">{{ $official->nama }}</h4>
                        <p class="text-xs text-slate-500">{{ $official->divisi }}</p>
                    </div>
                </div>
            @endforeach

            @foreach($kebendaharaan as $official)
                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 flex items-center gap-4 shadow-sm hover:border-emerald-300 transition">
                    <div class="w-16 h-16 rounded-full overflow-hidden bg-slate-100 shrink-0 border border-slate-200">
                        <img src="{{ $official->foto_url }}" alt="{{ $official->nama }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded">
                            {{ $official->jabatan }}
                        </span>
                        <h4 class="mt-1 text-base font-bold text-slate-900">{{ $official->nama }}</h4>
                        <p class="text-xs text-slate-500">{{ $official->divisi }}</p>
                    </div>
                </div>
            @endforeach

        </div>

        <!-- Section Title Bidang & Komisariat -->
        <div class="text-center my-12" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 text-sm font-bold uppercase tracking-widest text-emerald-700">
                <span>&bull;&bull;&bull;</span>
                <span>STRUKTUR BIDANG & KOMISARIAT PASAR</span>
                <span>&bull;&bull;&bull;</span>
            </div>
        </div>

        <!-- Bidang-Bidang dan Komisariat -->
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3 max-w-5xl mx-auto" data-aos="fade-up">
            @foreach($bidang as $item)
                <div class="rounded-2xl border border-slate-100 bg-slate-50/50 p-5 flex items-center gap-4 shadow-sm hover:bg-white hover:border-emerald-200 transition">
                    <div class="w-14 h-14 rounded-full overflow-hidden bg-slate-200 shrink-0">
                        <img src="{{ $item->foto_url }}" alt="{{ $item->nama }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <span class="text-[10px] font-bold uppercase text-emerald-800 bg-emerald-100/70 px-2 py-0.5 rounded">
                            {{ $item->divisi ?? 'Bidang Kerja' }}
                        </span>
                        <h5 class="text-sm font-bold text-slate-900 mt-1">{{ $item->nama }}</h5>
                        <p class="text-xs text-slate-500">{{ $item->jabatan }}</p>
                    </div>
                </div>
            @endforeach

            @foreach($komisariat as $item)
                <div class="rounded-2xl border border-emerald-100 bg-emerald-50/30 p-5 flex items-center gap-4 shadow-sm hover:bg-white hover:border-emerald-300 transition">
                    <div class="w-14 h-14 rounded-full overflow-hidden bg-slate-200 shrink-0">
                        <img src="{{ $item->foto_url }}" alt="{{ $item->nama }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <span class="text-[10px] font-bold uppercase text-emerald-800 bg-emerald-100 px-2 py-0.5 rounded">
                            KOMISARIAT PASAR
                        </span>
                        <h5 class="text-sm font-bold text-slate-900 mt-1">{{ $item->nama }}</h5>
                        <p class="text-xs text-slate-600">{{ $item->jabatan }}</p>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>

@endsection
