@extends('layouts.admin')

@section('title', 'Edit Notulen Rapat')

@section('content')

<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900">Edit Notulen Rapat</h1>
        <p class="text-xs text-slate-500 mt-1">Perbarui hasil musyawarah dan keputusan rapat</p>
    </div>
    <a href="{{ route('admin.meetings.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-emerald-700">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
    </a>
</div>

<div class="max-w-5xl bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 shadow-sm">
    <form action="{{ route('admin.meetings.update', $meeting->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Judul / Topik Rapat *</label>
            <input type="text" name="judul_rapat" required value="{{ old('judul_rapat', $meeting->judul_rapat) }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none">
        </div>

        <div class="grid sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Tanggal Rapat *</label>
                <input type="date" name="tanggal" required value="{{ old('tanggal', $meeting->tanggal ? $meeting->tanggal->format('Y-m-d') : '') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Waktu Mulai *</label>
                <input type="time" name="waktu_mulai" required value="{{ old('waktu_mulai', $meeting->waktu_mulai) }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Waktu Selesai</label>
                <input type="time" name="waktu_selesai" value="{{ old('waktu_selesai', $meeting->waktu_selesai) }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none">
            </div>
        </div>

        <div class="grid sm:grid-cols-3 gap-4">
            <div class="sm:col-span-2">
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Tempat Pelaksanaan *</label>
                <input type="text" name="tempat" required value="{{ old('tempat', $meeting->tempat) }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Status Rapat *</label>
                <select name="status" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none bg-white">
                    <option value="selesai" {{ $meeting->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="berlangsung" {{ $meeting->status == 'berlangsung' ? 'selected' : '' }}>Sedang Berlangsung</option>
                    <option value="terjadwal" {{ $meeting->status == 'terjadwal' ? 'selected' : '' }}>Terjadwal</option>
                </select>
            </div>
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Pimpinan Rapat *</label>
                <input type="text" name="pimpinan_rapat" required value="{{ old('pimpinan_rapat', $meeting->pimpinan_rapat) }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Notulis *</label>
                <input type="text" name="notulis" required value="{{ old('notulis', $meeting->notulis) }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1 flex items-center justify-between">
                <span>Agenda Pembahasan *</span>
                <span class="text-[11px] font-normal text-slate-400">Daftar agenda musyawarah yang dibahas</span>
            </label>
            <textarea name="agenda" id="agenda" rows="3" required class="rich-editor w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none">{{ old('agenda', $meeting->agenda) }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1 flex items-center justify-between">
                <span class="text-emerald-900 font-extrabold">Ringkasan Pembahasan & Dinamika Rapat</span>
                <span class="text-[11px] font-normal text-slate-400">Editor teks lengkap (paragraf, cetak tebal, miring, perataan)</span>
            </label>
            <textarea name="pembahasan" id="pembahasan" rows="8" class="rich-editor w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none">{{ old('pembahasan', $meeting->pembahasan) }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1 flex items-center justify-between">
                <span class="text-emerald-900 font-extrabold">Keputusan & Kesepakatan Bersama</span>
                <span class="text-[11px] font-normal text-slate-400">Poin kesepakatan final hasil musyawarah rapat</span>
            </label>
            <textarea name="keputusan" id="keputusan" rows="6" class="rich-editor w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none">{{ old('keputusan', $meeting->keputusan) }}</textarea>
        </div>

        <div class="grid sm:grid-cols-4 gap-4 items-end">
            <div class="sm:col-span-1">
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Jumlah Peserta Hadir</label>
                <div class="relative">
                    <input type="number" name="jumlah_hadir" value="{{ old('jumlah_hadir', $meeting->jumlah_hadir) }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm font-bold focus:border-emerald-600 focus:outline-none">
                    <span class="absolute right-3.5 top-2.5 text-xs text-slate-400 font-semibold">Orang</span>
                </div>
            </div>
            <div class="sm:col-span-3 text-xs text-slate-500 pb-2">
                <i class="fa-solid fa-circle-info text-emerald-700 mr-1"></i> Masukkan total peserta yang hadir dalam musyawarah lalu rincikan nama-nama pada kotak daftar hadir di bawah.
            </div>
        </div>

        <!-- Daftar Hadir dibuat Lebar Penuh (Full-Width) -->
        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1 flex items-center justify-between">
                <span class="text-slate-800 font-extrabold">Daftar Hadir / Peserta Rapat (Pengurus & Anggota Pedagang)</span>
                <span class="text-[11px] font-normal text-slate-400">Rincian nama peserta, jabatan/usaha, dan kehadiran</span>
            </label>
            <textarea name="daftar_hadir" rows="6" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm leading-relaxed focus:border-emerald-600 focus:outline-none font-sans bg-slate-50/50">{{ old('daftar_hadir', $meeting->daftar_hadir) }}</textarea>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.meetings.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 text-xs font-bold hover:bg-slate-50 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-700 text-white text-xs font-bold hover:bg-emerald-800 transition shadow">
                Perbarui Notulen Rapat
            </button>
        </div>

    </form>
</div>

@endsection
