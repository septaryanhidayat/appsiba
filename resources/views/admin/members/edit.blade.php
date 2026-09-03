@extends('layouts.admin')

@section('title', 'Edit Data Pedagang - ' . $member->nama)

@section('content')

<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900">Edit Data Pedagang Pasar</h1>
        <p class="text-xs text-slate-500 mt-1">Perbarui profil usaha dan status keanggotaan APPSI</p>
    </div>
    <a href="{{ route('admin.members.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-emerald-700">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
    </a>
</div>

<div class="max-w-4xl bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 shadow-sm">
    <form action="{{ route('admin.members.update', $member->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- 1. Identitas Anggota -->
        <div>
            <h3 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-2 flex items-center gap-2">
                <i class="fa-solid fa-id-card text-emerald-700"></i>
                1. Data Pribadi Pedagang
            </h3>

            <div class="grid sm:grid-cols-3 gap-4 mt-4">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Lengkap Pedagang *</label>
                    <input type="text" name="nama" required value="{{ old('nama', $member->nama) }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nomor Anggota (NPA) *</label>
                    <input type="text" name="nomor_anggota" required value="{{ old('nomor_anggota', $member->nomor_anggota) }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none font-mono font-bold text-emerald-800 bg-emerald-50/50">
                </div>
            </div>

            <div class="grid sm:grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">NIK (16 Digit)</label>
                    <input type="text" name="nik" value="{{ old('nik', $member->nik) }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nomor WhatsApp / HP</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $member->no_hp) }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $member->email) }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none">
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Alamat Domisili</label>
                <textarea name="alamat_domisili" rows="2" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none">{{ old('alamat_domisili', $member->alamat_domisili) }}</textarea>
            </div>
        </div>

        <!-- 2. Data Usaha & Lokasi Pasar -->
        <div class="pt-2">
            <h3 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-2 flex items-center gap-2">
                <i class="fa-solid fa-store text-emerald-700"></i>
                2. Data Usaha & Pasar Tradisional
            </h3>

            <div class="grid sm:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Toko / Kios / Usaha *</label>
                    <input type="text" name="nama_usaha" required value="{{ old('nama_usaha', $member->nama_usaha) }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Jenis Usaha / Komoditas *</label>
                    <select name="jenis_usaha" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none bg-white">
                        <option value="Sembako & Kebutuhan Pokok" {{ $member->jenis_usaha == 'Sembako & Kebutuhan Pokok' ? 'selected' : '' }}>Sembako & Kebutuhan Pokok</option>
                        <option value="Sayur, Buah & Hasil Bumi" {{ $member->jenis_usaha == 'Sayur, Buah & Hasil Bumi' ? 'selected' : '' }}>Sayur, Buah & Hasil Bumi</option>
                        <option value="Daging, Unggas & Ikan Segar" {{ $member->jenis_usaha == 'Daging, Unggas & Ikan Segar' ? 'selected' : '' }}>Daging, Unggas & Ikan Segar</option>
                        <option value="Pakaian, Konveksi & Tekstil" {{ $member->jenis_usaha == 'Pakaian, Konveksi & Tekstil' ? 'selected' : '' }}>Pakaian, Konveksi & Tekstil</option>
                        <option value="Kuliner & Jajanan Tradisional" {{ $member->jenis_usaha == 'Kuliner & Jajanan Tradisional' ? 'selected' : '' }}>Kuliner & Jajanan Tradisional</option>
                        <option value="Kelontong & Aneka Plastik" {{ $member->jenis_usaha == 'Kelontong & Aneka Plastik' ? 'selected' : '' }}>Kelontong & Aneka Plastik</option>
                        <option value="Elektronik, Servis & Aneka Jasa" {{ $member->jenis_usaha == 'Elektronik, Servis & Aneka Jasa' ? 'selected' : '' }}>Elektronik, Servis & Aneka Jasa</option>
                        <option value="Lain-lain / Serba Usaha" {{ $member->jenis_usaha == 'Lain-lain / Serba Usaha' ? 'selected' : '' }}>Lain-lain / Serba Usaha</option>
                    </select>
                </div>
            </div>

            <div class="grid sm:grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Bentuk Usaha *</label>
                    <select name="bentuk_usaha" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none bg-white">
                        <option value="Kios" {{ $member->bentuk_usaha == 'Kios' ? 'selected' : '' }}>Kios</option>
                        <option value="Los" {{ $member->bentuk_usaha == 'Los' ? 'selected' : '' }}>Los</option>
                        <option value="Lapak / Kaki Lima" {{ $member->bentuk_usaha == 'Lapak / Kaki Lima' ? 'selected' : '' }}>Lapak / Kaki Lima</option>
                        <option value="Ruko Pasar" {{ $member->bentuk_usaha == 'Ruko Pasar' ? 'selected' : '' }}>Ruko Pasar</option>
                        <option value="Distributor / Agen" {{ $member->bentuk_usaha == 'Distributor / Agen' ? 'selected' : '' }}>Distributor / Agen</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Lokasi Pasar Tradisional *</label>
                    <input type="text" name="lokasi_pasar" required value="{{ old('lokasi_pasar', $member->lokasi_pasar) }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Blok / Nomor Kios</label>
                    <input type="text" name="blok_nomor" value="{{ old('blok_nomor', $member->blok_nomor) }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none">
                </div>
            </div>
        </div>

        <!-- 3. Foto & Status -->
        <div class="pt-2">
            <h3 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-2 flex items-center gap-2">
                <i class="fa-solid fa-camera text-emerald-700"></i>
                3. Foto & Status Keanggotaan
            </h3>

            <div class="grid sm:grid-cols-2 gap-4 mt-4 items-center">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-full overflow-hidden bg-slate-100 border border-slate-200 shrink-0">
                        <img src="{{ $member->foto_url }}" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1">
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Ganti Foto Pedagang</label>
                        <input type="file" name="foto" accept="image/*" class="w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Status Keanggotaan *</label>
                    <select name="status" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none bg-white">
                        <option value="aktif" {{ $member->status == 'aktif' ? 'selected' : '' }}>Aktif Terverifikasi</option>
                        <option value="verifikasi" {{ $member->status == 'verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                        <option value="tidak_aktif" {{ $member->status == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Catatan Tambahan</label>
                <textarea name="catatan" rows="2" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none">{{ old('catatan', $member->catatan) }}</textarea>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.members.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 text-xs font-bold hover:bg-slate-50 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-700 text-white text-xs font-bold hover:bg-emerald-800 transition shadow">
                Perbarui Data Pedagang
            </button>
        </div>

    </form>
</div>

@endsection
