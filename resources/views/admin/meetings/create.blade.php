@extends('layouts.admin')

@section('title', 'Catat Notulen Rapat Baru')

@section('content')

<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900">Catat Agenda & Notulen Rapat</h1>
        <p class="text-xs text-slate-500 mt-1">Dokumentasi resmi hasil pembahasan rapat kerja DPD APPSI Banyuasin</p>
    </div>
    <a href="{{ route('admin.meetings.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-emerald-700">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
    </a>
</div>

<div class="max-w-4xl bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 shadow-sm">
    <form action="{{ route('admin.meetings.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Judul / Topik Rapat *</label>
            <input type="text" name="judul_rapat" required value="{{ old('judul_rapat') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none" placeholder="Contoh: Rapat Koordinasi Penataan Zonasi Kios Pasar Pangkalan Balai">
        </div>

        <div class="grid sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Tanggal Rapat *</label>
                <input type="date" name="tanggal" required value="{{ old('tanggal', date('Y-m-d')) }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Waktu Mulai *</label>
                <input type="time" name="waktu_mulai" required value="{{ old('waktu_mulai', '09:00') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Waktu Selesai</label>
                <input type="time" name="waktu_selesai" value="{{ old('waktu_selesai', '12:00') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none">
            </div>
        </div>

        <div class="grid sm:grid-cols-3 gap-4">
            <div class="sm:col-span-2">
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Tempat Pelaksanaan *</label>
                <input type="text" name="tempat" required value="{{ old('tempat', 'Sekretariat DPD APPSI Kab. Banyuasin, Jl. Merdeka Pangkalan Balai') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Status Rapat *</label>
                <select name="status" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none bg-white">
                    <option value="selesai">Selesai</option>
                    <option value="berlangsung">Sedang Berlangsung</option>
                    <option value="terjadwal">Terjadwal</option>
                </select>
            </div>
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Pimpinan Rapat *</label>
                <input type="text" name="pimpinan_rapat" required value="{{ old('pimpinan_rapat', 'H. Gusra Yetri, SH') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Notulis *</label>
                <input type="text" name="notulis" required value="{{ old('notulis', 'M. Rian Pratama, S.E.') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Agenda Pembahasan *</label>
            <textarea name="agenda" rows="3" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none" placeholder="Poin-poin agenda yang dibahas...">{{ old('agenda') }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Ringkasan Pembahasan & Dinamika Rapat</label>
            <textarea name="pembahasan" rows="4" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none" placeholder="Uraian jalannya musyawarah...">{{ old('pembahasan') }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Keputusan & Kesepakatan Bersama</label>
            <textarea name="keputusan" rows="3" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none" placeholder="Keputusan yang disepakati...">{{ old('keputusan') }}</textarea>
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Jumlah Peserta Hadir</label>
                <input type="number" name="jumlah_hadir" value="{{ old('jumlah_hadir', 10) }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Daftar Hadir / Peserta Rapat</label>
                <textarea name="daftar_hadir" rows="2" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-xs focus:border-emerald-600 focus:outline-none" placeholder="Nama-nama pengurus yang hadir...">{{ old('daftar_hadir') }}</textarea>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.meetings.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 text-xs font-bold hover:bg-slate-50 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-700 text-white text-xs font-bold hover:bg-emerald-800 transition shadow">
                Simpan Notulen Rapat
            </button>
        </div>

    </form>
</div>

@endsection
