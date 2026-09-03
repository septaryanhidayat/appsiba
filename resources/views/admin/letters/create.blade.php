@extends('layouts.admin')

@section('title', 'Buat Surat Keluar Resmi APPSI')

@section('content')

<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900">Buat Surat Keluar Resmi APPSI</h1>
        <p class="text-xs text-slate-500 mt-1">Penerbitan surat resmi ber-KOP dan QR Code keabsahan digital</p>
    </div>
    <a href="{{ route('admin.letters.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-emerald-700">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Surat
    </a>
</div>

<div class="max-w-4xl bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 shadow-sm">
    <form action="{{ route('admin.letters.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nomor Surat Resmi *</label>
                <input type="text" name="nomor_surat" required value="{{ old('nomor_surat', $nomorSurat) }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm font-mono font-bold text-emerald-800 bg-emerald-50/40 focus:border-emerald-600 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Tanggal Surat *</label>
                <input type="date" name="tanggal" required value="{{ old('tanggal', date('Y-m-d')) }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none">
            </div>
        </div>

        <div class="grid sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Jenis Dokumen *</label>
                <select name="jenis_surat" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none bg-white">
                    <option value="SURAT BIASA">Surat Biasa / Pemberitahuan</option>
                    <option value="SURAT AUDIENSI">Surat Audiensi</option>
                    <option value="SURAT TUGAS">Surat Tugas Pengurus</option>
                    <option value="PROPOSAL">Surat Proposal Kerjasama</option>
                    <option value="SURAT REKOMENDASI">Surat Rekomendasi</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Lampiran</label>
                <input type="text" name="lampiran" value="{{ old('lampiran', '-') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Kota / Tempat Terbit</label>
                <input type="text" name="lokasi" value="{{ old('lokasi', 'Pangkalan Balai') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none">
            </div>
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Tujuan / Kepada Yth. *</label>
                <input type="text" name="tujuan" required value="{{ old('tujuan') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none" placeholder="Contoh: Kepala Dinas Koperindag Kab. Banyuasin">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Tempat / Alamat Tujuan</label>
                <input type="text" name="tempat_tujuan" value="{{ old('tempat_tujuan', 'Di Tempat') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none" placeholder="Pangkalan Balai / Di Tempat">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Perihal / Hal Surat *</label>
            <input type="text" name="perihal" required value="{{ old('perihal') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none" placeholder="Contoh: Permohonan Audiensi Penataan Pasar Tradisional">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Keperluan / Ringkasan *</label>
            <input type="text" name="keperluan" required value="{{ old('keperluan') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none" placeholder="Ringkasan isi surat">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Isi Surat Lengkap (Paragraf)</label>
            <textarea name="isi_surat" rows="6" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none" placeholder="Tuliskan isi surat resmi secara lengkap...">{{ old('isi_surat') }}</textarea>
        </div>

        <!-- Penandatangan -->
        <div class="pt-2 border-t border-slate-100">
            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-3">Penandatangan Dokumen</h4>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Ketua DPD *</label>
                    <input type="text" name="nama_penandatangan" required value="{{ old('nama_penandatangan', $defaultKetua) }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm font-semibold focus:border-emerald-600 focus:outline-none">
                    <input type="hidden" name="jabatan_penandatangan" value="Ketua DPD APPSI Banyuasin">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Sekretaris *</label>
                    <input type="text" name="nama_sekretaris" required value="{{ old('nama_sekretaris', $defaultSekretaris) }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm font-semibold focus:border-emerald-600 focus:outline-none">
                    <input type="hidden" name="jabatan_sekretaris" value="Sekretaris DPD APPSI Banyuasin">
                </div>
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Tembusan (Opsional)</label>
            <textarea name="tembusan" rows="2" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-xs focus:border-emerald-600 focus:outline-none" placeholder="1. Bupati Banyuasin&#10;2. Arsip">{{ old('tembusan') }}</textarea>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.letters.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 text-xs font-bold hover:bg-slate-50 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-700 text-white text-xs font-bold hover:bg-emerald-800 transition shadow">
                Terbitkan Surat & Generate QR
            </button>
        </div>

    </form>
</div>

@endsection
