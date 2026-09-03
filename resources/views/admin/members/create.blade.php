@extends('layouts.admin')

@section('title', 'Tambah Pedagang Pasar Anggota')

@section('content')

<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900">Tambah Pedagang Anggota Baru</h1>
        <p class="text-xs text-slate-500 mt-1">Registrasi resmi pelaku usaha pasar binaan DPD APPSI Kabupaten Banyuasin</p>
    </div>
    <a href="{{ route('admin.members.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-emerald-700">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
    </a>
</div>

<div class="max-w-4xl bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 shadow-sm">
    <form action="{{ route('admin.members.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- 1. Identitas Anggota -->
        <div>
            <h3 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-2 flex items-center gap-2">
                <i class="fa-solid fa-id-card text-emerald-700"></i>
                1. Data Pribadi Pedagang
            </h3>

            <div class="grid sm:grid-cols-3 gap-4 mt-4">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Lengkap Pedagang *</label>
                    <input type="text" name="nama" required value="{{ old('nama') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none" placeholder="Nama sesuai KTP">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nomor Anggota (NPA) *</label>
                    <input type="text" name="nomor_anggota" required value="{{ old('nomor_anggota', $nextNpa) }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none font-mono font-bold text-emerald-800 bg-emerald-50/50">
                </div>
            </div>

            <div class="grid sm:grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">NIK (16 Digit)</label>
                    <input type="text" name="nik" value="{{ old('nik') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none" placeholder="1607xxxx">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nomor WhatsApp / HP</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none" placeholder="08xxxxxxxx">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none" placeholder="opsional">
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Alamat Domisili</label>
                <textarea name="alamat_domisili" rows="2" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none" placeholder="Alamat rumah tempat tinggal">{{ old('alamat_domisili') }}</textarea>
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
                    <input type="text" name="nama_usaha" required value="{{ old('nama_usaha') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none" placeholder="Contoh: Toko Sembako Jaya">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Jenis Usaha / Komoditas *</label>
                    <select name="jenis_usaha" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none bg-white">
                        <option value="Sembako & Kebutuhan Pokok">Sembako & Kebutuhan Pokok</option>
                        <option value="Sayur, Buah & Hasil Bumi">Sayur, Buah & Hasil Bumi</option>
                        <option value="Daging, Unggas & Ikan Segar">Daging, Unggas & Ikan Segar</option>
                        <option value="Pakaian, Konveksi & Tekstil">Pakaian, Konveksi & Tekstil</option>
                        <option value="Kuliner & Jajanan Tradisional">Kuliner & Jajanan Tradisional</option>
                        <option value="Kelontong & Aneka Plastik">Kelontong & Aneka Plastik</option>
                        <option value="Elektronik, Servis & Aneka Jasa">Elektronik, Servis & Aneka Jasa</option>
                        <option value="Lain-lain / Serba Usaha">Lain-lain / Serba Usaha</option>
                    </select>
                </div>
            </div>

            <div class="grid sm:grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Bentuk Usaha *</label>
                    <select name="bentuk_usaha" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none bg-white">
                        <option value="Kios">Kios</option>
                        <option value="Los">Los</option>
                        <option value="Lapak / Kaki Lima">Lapak / Kaki Lima</option>
                        <option value="Ruko Pasar">Ruko Pasar</option>
                        <option value="Distributor / Agen">Distributor / Agen</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Lokasi Pasar Tradisional *</label>
                    <select name="lokasi_pasar" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none bg-white">
                        <option value="Pasar Pangkalan Balai">Pasar Pangkalan Balai</option>
                        <option value="Pasar Betung">Pasar Betung</option>
                        <option value="Pasar Mariana">Pasar Mariana</option>
                        <option value="Pasar Sungsang">Pasar Sungsang</option>
                        <option value="Pasar Sukajadi (Talang Kelapa)">Pasar Sukajadi (Talang Kelapa)</option>
                        <option value="Pasar Makarti Jaya">Pasar Makarti Jaya</option>
                        <option value="Pasar Muara Telang">Pasar Muara Telang</option>
                        <option value="Pasar Tradisional Lainnya">Pasar Tradisional Lainnya</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Blok / Nomor Kios</label>
                    <input type="text" name="blok_nomor" value="{{ old('blok_nomor') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none" placeholder="Contoh: Blok A No. 04">
                </div>
            </div>
        </div>

        <!-- 3. Foto & Status -->
        <div class="pt-2">
            <h3 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-2 flex items-center gap-2">
                <i class="fa-solid fa-camera text-emerald-700"></i>
                3. Foto & Status Keanggotaan
            </h3>

            <div class="grid sm:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Foto Pedagang (Opsional)</label>
                    <input type="file" name="foto" accept="image/*" class="w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700">
                    <p class="text-[11px] text-slate-400 mt-1">Jika dikosongkan, sistem akan otomatis menggunakan avatar siluet abu-abu resmi.</p>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Status Keanggotaan *</label>
                    <select name="status" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none bg-white">
                        <option value="aktif">Aktif Terverifikasi</option>
                        <option value="verifikasi">Menunggu Verifikasi</option>
                        <option value="tidak_aktif">Tidak Aktif</option>
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Catatan Tambahan</label>
                <textarea name="catatan" rows="2" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none" placeholder="Catatan internal pengurus...">{{ old('catatan') }}</textarea>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.members.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 text-xs font-bold hover:bg-slate-50 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-700 text-white text-xs font-bold hover:bg-emerald-800 transition shadow">
                Simpan Data Pedagang
            </button>
        </div>

    </form>
</div>

@endsection
