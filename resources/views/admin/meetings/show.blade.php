@extends('layouts.admin')

@section('title', 'Notulen Rapat - ' . $meeting->judul_rapat)

@section('content')

<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900">Risalah & Notulen Rapat</h1>
        <p class="text-xs text-slate-500 mt-1">{{ $meeting->judul_rapat }}</p>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.meetings.index') }}" class="px-4 py-2 rounded-xl border border-slate-200 bg-white text-slate-700 text-xs font-bold hover:bg-slate-50">
            <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
        </a>
        <button onclick="window.print()" class="px-4 py-2 rounded-xl border border-slate-200 bg-white text-slate-700 text-xs font-bold hover:bg-slate-50 shadow-sm">
            <i class="fa-solid fa-print mr-1 text-emerald-700"></i> Cetak Risalah
        </button>
        <a href="{{ route('admin.meetings.edit', $meeting->id) }}" class="px-4 py-2 rounded-xl bg-emerald-700 text-white text-xs font-bold hover:bg-emerald-800 shadow">
            <i class="fa-solid fa-pen-to-square mr-1"></i> Edit Notulen
        </a>
    </div>
</div>

<div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 max-w-5xl shadow-sm space-y-6">
    
    <div class="border-b border-slate-100 pb-4">
        <span class="inline-block px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $meeting->status === 'selesai' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
            STATUS: {{ strtoupper($meeting->status) }}
        </span>
        <h2 class="text-xl font-extrabold text-slate-900 mt-2">{{ $meeting->judul_rapat }}</h2>
        <div class="flex flex-wrap gap-4 mt-3 text-xs text-slate-600">
            <span><i class="fa-regular fa-calendar text-emerald-700 mr-1"></i> {{ $meeting->tanggal ? $meeting->tanggal->translatedFormat('l, d F Y') : '-' }}</span>
            <span><i class="fa-regular fa-clock text-emerald-700 mr-1"></i> {{ $meeting->waktu_mulai }} - {{ $meeting->waktu_selesai ?? 'Selesai' }}</span>
            <span><i class="fa-solid fa-location-dot text-emerald-700 mr-1"></i> {{ $meeting->tempat }}</span>
        </div>
    </div>

    <div class="grid sm:grid-cols-3 gap-4 text-xs bg-slate-50 p-4 rounded-xl border border-slate-100">
        <div>
            <span class="text-[10px] font-bold uppercase text-slate-400 block">Pimpinan Rapat</span>
            <span class="text-sm font-bold text-slate-800 mt-0.5 block">{{ $meeting->pimpinan_rapat }}</span>
        </div>
        <div>
            <span class="text-[10px] font-bold uppercase text-slate-400 block">Notulis</span>
            <span class="text-sm font-bold text-slate-800 mt-0.5 block">{{ $meeting->notulis }}</span>
        </div>
        <div>
            <span class="text-[10px] font-bold uppercase text-slate-400 block">Total Kehadiran</span>
            <span class="text-sm font-bold text-emerald-800 mt-0.5 block">{{ $meeting->jumlah_hadir ?? 0 }} Orang Peserta</span>
        </div>
    </div>

    <div>
        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-1.5">Agenda Pembahasan</h3>
        <div class="text-xs text-slate-800 leading-relaxed bg-white p-4 rounded-xl border border-slate-200">
            {!! strip_tags($meeting->agenda) !== $meeting->agenda ? $meeting->agenda : nl2br(e($meeting->agenda)) !!}
        </div>
    </div>

    @if($meeting->pembahasan)
        <div>
            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-1.5">Uraian Pembahasan & Dinamika Musyawarah</h3>
            <div class="text-xs text-slate-800 leading-relaxed bg-white p-5 rounded-xl border border-slate-200">
                {!! strip_tags($meeting->pembahasan) !== $meeting->pembahasan ? $meeting->pembahasan : nl2br(e($meeting->pembahasan)) !!}
            </div>
        </div>
    @endif

    @if($meeting->keputusan)
        <div>
            <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-800 mb-1.5">Keputusan & Kesepakatan Bersama</h3>
            <div class="text-xs text-emerald-950 font-medium leading-relaxed bg-emerald-50/70 p-5 rounded-xl border border-emerald-200">
                {!! strip_tags($meeting->keputusan) !== $meeting->keputusan ? $meeting->keputusan : nl2br(e($meeting->keputusan)) !!}
            </div>
        </div>
    @endif

    @if($meeting->daftar_hadir)
        <div>
            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-1.5">Daftar Kehadiran Peserta & Anggota Rapat</h3>
            <div class="text-xs text-slate-700 leading-relaxed bg-slate-50 p-4.5 rounded-xl border border-slate-200 whitespace-pre-line font-mono">
                {{ $meeting->daftar_hadir }}
            </div>
        </div>
    @endif

</div>

@endsection
