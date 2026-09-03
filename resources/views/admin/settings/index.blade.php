@extends('layouts.admin')

@section('title', 'Profil Organisasi & KOP APPSI')

@section('content')

<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900">Profil Organisasi & KOP Resmi APPSI</h1>
        <p class="text-xs text-slate-500 mt-1">Pengaturan identitas DPD, alamat sekretariat, nama pimpinan resmi, dan visi misi</p>
    </div>
</div>

<div class="max-w-4xl bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 shadow-sm">
    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Identitas DPD -->
        <div>
            <h3 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-2 flex items-center gap-2">
                <i class="fa-solid fa-building-flag text-emerald-700"></i>
                1. Identitas Lembaga & Organisasi
            </h3>

            <div class="grid sm:grid-cols-3 gap-4 mt-4">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Organisasi Lengkap *</label>
                    <input type="text" name="nama_organisasi" required value="{{ old('nama_organisasi', $settings['nama_organisasi'] ?? 'Dewan Pimpinan Daerah (DPD) Asosiasi Pedagang Pasar Seluruh Indonesia (APPSI) Kabupaten Banyuasin') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Singkatan / Sebutan *</label>
                    <input type="text" name="singkatan" required value="{{ old('singkatan', $settings['singkatan'] ?? 'DPD APPSI KABUPATEN BANYUASIN') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none">
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Alamat Sekretariat Resmi *</label>
                <textarea name="alamat" rows="2" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none">{{ old('alamat', $settings['alamat'] ?? 'Jalan Merdeka, Depan Pasar Baru Kelurahan Pangkalan Balai - Kecamatan Banyuasin III, Kabupaten Banyuasin, Sumatera Selatan') }}</textarea>
            </div>

            <div class="grid sm:grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">No. Telepon *</label>
                    <input type="text" name="telepon" required value="{{ old('telepon', $settings['telepon'] ?? '0811 618 808') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">WhatsApp Resmi</label>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp', $settings['whatsapp'] ?? '62811618808') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Email Resmi</label>
                    <input type="email" name="email" value="{{ old('email', $settings['email'] ?? 'appsi.banyuasin@gmail.com') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none">
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Website Resmi</label>
                    <input type="text" name="website" value="{{ old('website', $settings['website'] ?? 'https://appsiba.or.id') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Periode Kepengurusan</label>
                    <input type="text" name="periode" value="{{ old('periode', $settings['periode'] ?? '2024 - 2029') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none">
                </div>
            </div>
        </div>

        <!-- Pimpinan Resmi Organisasi -->
        <div class="pt-2">
            <h3 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-2 flex items-center gap-2">
                <i class="fa-solid fa-users text-emerald-700"></i>
                2. Nama Penandatangan Dokumen Surat & KTA
            </h3>

            <div class="grid sm:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Ketua DPD *</label>
                    <input type="text" name="nama_ketua" required value="{{ old('nama_ketua', $settings['nama_ketua'] ?? 'H. Gusra Yetri, SH') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm font-semibold focus:border-emerald-600 focus:outline-none">
                    <input type="hidden" name="jabatan_ketua" value="Ketua DPD APPSI Kabupaten Banyuasin">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Sekretaris Umum *</label>
                    <input type="text" name="nama_sekretaris" required value="{{ old('nama_sekretaris', $settings['nama_sekretaris'] ?? 'M. Rian Pratama, S.E.') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm font-semibold focus:border-emerald-600 focus:outline-none">
                    <input type="hidden" name="jabatan_sekretaris" value="Sekretaris DPD APPSI Kabupaten Banyuasin">
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Bendahara Umum</label>
                <input type="text" name="nama_bendahara" value="{{ old('nama_bendahara', $settings['nama_bendahara'] ?? 'Hj. Siti Aminah') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none">
            </div>
        </div>

        <!-- Visi, Misi & Sambutan -->
        <div class="pt-2">
            <h3 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-2 flex items-center gap-2">
                <i class="fa-solid fa-bullseye text-emerald-700"></i>
                3. Visi, Misi & Sambutan Ketua
            </h3>

            <div class="mt-4">
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Visi Organisasi</label>
                <textarea name="visi" rows="2" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none">{{ old('visi', $settings['visi'] ?? '') }}</textarea>
            </div>

            <div class="mt-4">
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Misi Organisasi</label>
                <textarea name="misi" rows="4" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none">{{ old('misi', $settings['misi'] ?? '') }}</textarea>
            </div>

            <div class="mt-4">
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Sambutan Ketua DPD</label>
                <textarea name="sambutan_ketua" rows="3" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none">{{ old('sambutan_ketua', $settings['sambutan_ketua'] ?? '') }}</textarea>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-end">
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-700 text-white text-xs font-bold hover:bg-emerald-800 transition shadow">
                Simpan Perubahan Profil & KOP
            </button>
        </div>

    </form>
</div>

@endsection
