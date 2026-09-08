@extends('layouts.admin')

@section('title', 'Edit Surat Keluar Resmi APPSI')
@section('page_title', 'Edit Surat Keluar')

@section('content')

<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-800 text-xs font-bold mb-1 border border-emerald-200">
            <i class="fa-solid fa-file-pen text-xs"></i>
            <span>MODUL PERSURATAN RESMI</span>
        </div>
        <h1 class="text-2xl font-extrabold text-slate-900">Edit Surat Keluar Resmi APPSI</h1>
        <p class="text-xs text-slate-500 mt-0.5 font-mono">{{ $letter->nomor_surat }} &bull; {{ $letter->jenis_surat }}</p>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.letters.print', $letter->id) }}" target="_blank" class="px-4 py-2.5 rounded-xl text-xs font-bold text-emerald-800 bg-emerald-50 border border-emerald-300 hover:bg-emerald-100 transition flex items-center gap-1.5 shadow-2xs">
            <i class="fa-solid fa-print"></i> Cetak / Pratinjau KOP
        </a>
        <a href="{{ route('admin.letters.index') }}" class="px-4 py-2.5 rounded-xl text-xs font-bold text-slate-700 bg-white border border-slate-300 hover:bg-slate-50 transition flex items-center gap-1.5 shadow-2xs">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>
</div>

<div class="w-full bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 shadow-sm">
    <form action="{{ route('admin.letters.update', $letter->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- 1. INFORMASI DOKUMEN & LEGALITAS -->
        <div>
            <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-800 border-b border-slate-100 pb-2 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-file-invoice text-emerald-700"></i>
                1. Nomor, Tanggal & Klasifikasi Dokumen
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nomor Surat Resmi *</label>
                    <input type="text" name="nomor_surat" value="{{ old('nomor_surat', $letter->nomor_surat) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm font-mono font-bold text-emerald-900 bg-emerald-50/40 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none">
                    @error('nomor_surat') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Tanggal Terbit Surat *</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $letter->tanggal ? $letter->tanggal->format('Y-m-d') : date('Y-m-d')) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm font-semibold text-slate-900 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none">
                    @error('tanggal') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Jenis Dokumen Surat *</label>
                    <select name="jenis_surat" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm font-semibold text-slate-900 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none bg-white">
                        <option value="SURAT BIASA" {{ old('jenis_surat', $letter->jenis_surat) === 'SURAT BIASA' ? 'selected' : '' }}>Surat Biasa / Pemberitahuan</option>
                        <option value="SURAT AUDIENSI" {{ old('jenis_surat', $letter->jenis_surat) === 'SURAT AUDIENSI' || old('jenis_surat', $letter->jenis_surat) === 'SURAT AUDENSI' ? 'selected' : '' }}>Surat Audiensi</option>
                        <option value="SURAT TUGAS" {{ old('jenis_surat', $letter->jenis_surat) === 'SURAT TUGAS' ? 'selected' : '' }}>Surat Tugas Pengurus</option>
                        <option value="PROPOSAL" {{ old('jenis_surat', $letter->jenis_surat) === 'PROPOSAL' ? 'selected' : '' }}>Proposal Kerjasama</option>
                        <option value="SURAT REKOMENDASI" {{ old('jenis_surat', $letter->jenis_surat) === 'SURAT REKOMENDASI' ? 'selected' : '' }}>Surat Rekomendasi</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Lampiran</label>
                    <input type="text" name="lampiran" value="{{ old('lampiran', $letter->lampiran ?? '-') }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none" placeholder="Contoh: 1 (Satu) Berkas Proposal / -">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Kota / Tempat Terbit</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi', $letter->lokasi ?? 'Pangkalan Balai') }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none" placeholder="Pangkalan Balai">
                </div>
            </div>
        </div>

        <!-- 2. TUJUAN, PERIHAL & RINGKASAN -->
        <div class="pt-2">
            <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-800 border-b border-slate-100 pb-2 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-paper-plane text-emerald-700"></i>
                2. Tujuan Surat & Pokok Permasalahan
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Tujuan / Kepada Yth. *</label>
                    <input type="text" name="tujuan" value="{{ old('tujuan', $letter->tujuan) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm font-semibold text-slate-900 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none" placeholder="Contoh: Kepala Dinas Koperindag Kab. Banyuasin">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Tempat / Alamat Tujuan</label>
                    <input type="text" name="tempat_tujuan" value="{{ old('tempat_tujuan', $letter->tempat_tujuan ?? 'Di Tempat') }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none" placeholder="Pangkalan Balai / Di Tempat">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Perihal / Hal Surat *</label>
                    <input type="text" name="perihal" value="{{ old('perihal', $letter->perihal) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm font-semibold text-slate-900 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none" placeholder="Contoh: Permohonan Audiensi Penataan Pasar Tradisional">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Keperluan / Ringkasan Singkat *</label>
                    <input type="text" name="keperluan" value="{{ old('keperluan', $letter->keperluan) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none" placeholder="Ringkasan keperluan dinas">
                </div>
            </div>
        </div>

        <!-- 3. ISI LENGKAP SURAT (QUILL.JS WYSIWYG ALA WORDPRESS) -->
        <div class="pt-2">
            <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-800 border-b border-slate-100 pb-2 mb-3 flex items-center justify-between">
                <span class="flex items-center gap-2">
                    <i class="fa-solid fa-align-left text-emerald-700"></i>
                    3. Isi Naskah Surat Lengkap
                </span>
                <span class="text-[11px] font-normal text-slate-400 normal-case">Dukungan cetak tebal, perataan rata penuh (justify), poin, dan paragraf dinas</span>
            </h3>

            <div>
                <textarea name="isi_surat" id="isi_surat" rows="12" class="rich-editor w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-emerald-600 focus:outline-none" placeholder="Tuliskan naskah surat resmi secara lengkap...">{{ old('isi_surat', $letter->isi_surat) }}</textarea>
            </div>
        </div>

        <!-- 4. PENANDATANGAN DOKUMEN & KOP -->
        <div class="pt-2">
            <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-800 border-b border-slate-100 pb-2 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-signature text-emerald-700"></i>
                4. Pejabat Penandatangan Resmi DPD APPSI
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-4 rounded-xl bg-slate-50/80 border border-slate-200">
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Ketua DPD *</label>
                    <input type="text" name="nama_penandatangan" value="{{ old('nama_penandatangan', $letter->nama_penandatangan ?: $defaultKetua) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2 text-sm font-bold text-slate-900 focus:border-emerald-600 focus:outline-none bg-white">
                    <input type="hidden" name="jabatan_penandatangan" value="{{ $letter->jabatan_penandatangan ?: 'Ketua DPD APPSI Banyuasin' }}">
                    <p class="text-[11px] text-slate-500 mt-1">Jabatan: {{ $letter->jabatan_penandatangan ?: 'Ketua DPD APPSI Banyuasin' }}</p>
                </div>

                <div class="p-4 rounded-xl bg-slate-50/80 border border-slate-200">
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Sekretaris DPD *</label>
                    <input type="text" name="nama_sekretaris" value="{{ old('nama_sekretaris', $letter->nama_sekretaris ?: $defaultSekretaris) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2 text-sm font-bold text-slate-900 focus:border-emerald-600 focus:outline-none bg-white">
                    <input type="hidden" name="jabatan_sekretaris" value="{{ $letter->jabatan_sekretaris ?: 'Sekretaris DPD APPSI Banyuasin' }}">
                    <p class="text-[11px] text-slate-500 mt-1">Jabatan: {{ $letter->jabatan_sekretaris ?: 'Sekretaris DPD APPSI Banyuasin' }}</p>
                </div>
            </div>
        </div>

        <!-- 5. TEMBUSAN SURAT -->
        <div class="pt-2">
            <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-800 border-b border-slate-100 pb-2 mb-3 flex items-center gap-2">
                <i class="fa-solid fa-copy text-emerald-700"></i>
                5. Tembusan Dokumen (Opsional)
            </h3>
            <textarea name="tembusan" rows="3" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-xs text-slate-800 focus:border-emerald-600 focus:outline-none" placeholder="1. Bupati Banyuasin&#10;2. Ketua Umum DPW APPSI Sumatera Selatan&#10;3. Arsip">{{ old('tembusan', $letter->tembusan) }}</textarea>
        </div>

        <!-- TOMBOL AKSI -->
        <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-200">
            <a href="{{ route('admin.letters.index') }}" class="px-6 py-2.5 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100 transition-colors">
                Batal
            </a>
            <button type="submit" class="px-8 py-2.5 rounded-xl text-xs font-bold text-white bg-emerald-700 hover:bg-emerald-800 shadow transition-all flex items-center gap-2">
                <i class="fa-solid fa-save"></i>
                <span>Simpan Perubahan Surat</span>
            </button>
        </div>

    </form>
</div>

@endsection
