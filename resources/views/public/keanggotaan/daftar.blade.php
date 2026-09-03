@extends('layouts.public')

@section('title', 'Pendaftaran Anggota Pedagang - DPD APPSI Kabupaten Banyuasin')

@section('content')

<!-- Header Banner -->
<section class="bg-gradient-to-b from-emerald-50/70 via-white to-white py-12 sm:py-16 border-b border-slate-100">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <span class="inline-block rounded-full bg-emerald-100 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-emerald-800">
            FORMULIR ONLINE
        </span>
        <h1 class="mt-3 text-3xl font-extrabold text-slate-900 sm:text-4xl">
            Pendaftaran Keanggotaan <span class="text-emerald-700">APPSI Banyuasin</span>
        </h1>
        <p class="mt-3 text-sm text-slate-600 sm:text-base max-w-2xl mx-auto">
            Khusus bagi pedagang pasar tradisional, UMKM, dan pelaku usaha di wilayah Kabupaten Banyuasin untuk mendapatkan Nomor Pokok Anggota (NPA), fasilitasi advokasi, dan akses kemitraan modal.
        </p>
    </div>
</section>

<!-- Form Content -->
<section class="py-12 bg-slate-50/60">
    <div class="mx-auto w-full max-w-3xl px-5 sm:px-6 lg:px-8">
        
        <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-10 shadow-sm" data-aos="fade-up">
            
            <form action="{{ route('members.register.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Bagian 1: Identitas Pribadi -->
                <div>
                    <h3 class="text-base font-extrabold text-slate-900 border-b border-slate-100 pb-2 flex items-center gap-2">
                        <i class="fa-solid fa-id-card text-emerald-700"></i>
                        1. Data Pribadi Pedagang
                    </h3>

                    <div class="grid sm:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Lengkap (Sesuai KTP) *</label>
                            <input type="text" name="nama" required value="{{ old('nama') }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600" placeholder="Contoh: H. Ahmad Basir">
                            @error('nama') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nomor Induk Kependudukan (NIK) *</label>
                            <input type="text" name="nik" required maxlength="20" value="{{ old('nik') }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600" placeholder="16 digit NIK KTP">
                            @error('nik') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nomor WhatsApp / HP *</label>
                            <input type="text" name="no_hp" required value="{{ old('no_hp') }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600" placeholder="Contoh: 081278901234">
                            @error('no_hp') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Alamat Email (Opsional)</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600" placeholder="email@anda.com">
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Alamat Domisili / Tempat Tinggal *</label>
                        <textarea name="alamat_domisili" rows="2" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600" placeholder="Alamat rumah lengkap (Desa/Kelurahan, RT/RW, Kecamatan)">{{ old('alamat_domisili') }}</textarea>
                    </div>
                </div>

                <!-- Bagian 2: Data Tempat Usaha di Pasar -->
                <div class="pt-4">
                    <h3 class="text-base font-extrabold text-slate-900 border-b border-slate-100 pb-2 flex items-center gap-2">
                        <i class="fa-solid fa-store text-emerald-700"></i>
                        2. Data Usaha di Pasar Tradisional
                    </h3>

                    <div class="grid sm:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Usaha / Toko / Dagangan *</label>
                            <input type="text" name="nama_usaha" required value="{{ old('nama_usaha') }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600" placeholder="Contoh: Toko Sembako Berkah">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Jenis Komoditas / Usaha *</label>
                            <select name="jenis_usaha" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600">
                                <option value="">-- Pilih Jenis Komoditas --</option>
                                @foreach($commodities as $c)
                                    <option value="{{ $c }}" {{ old('jenis_usaha') == $c ? 'selected' : '' }}>{{ $c }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-3 gap-4 mt-4">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Bentuk Usaha *</label>
                            <select name="bentuk_usaha" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600">
                                <option value="Kios">Kios</option>
                                <option value="Los">Los</option>
                                <option value="Lapak / Kaki Lima">Lapak / Kaki Lima</option>
                                <option value="Ruko Pasar">Ruko Pasar</option>
                                <option value="Agen / Distributor">Agen / Distributor</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Lokasi Pasar Tradisional *</label>
                            <select name="lokasi_pasar" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600">
                                <option value="">-- Pilih Pasar --</option>
                                @foreach($markets as $m)
                                    <option value="{{ $m }}" {{ old('lokasi_pasar') == $m ? 'selected' : '' }}>{{ $m }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Blok / No. Kios (Opsional)</label>
                            <input type="text" name="blok_nomor" value="{{ old('blok_nomor') }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600" placeholder="Contoh: Blok B No. 12">
                        </div>
                    </div>
                </div>

                <!-- Bagian 3: Dokumen Pendukung -->
                <div class="pt-4">
                    <h3 class="text-base font-extrabold text-slate-900 border-b border-slate-100 pb-2 flex items-center gap-2">
                        <i class="fa-solid fa-camera text-emerald-700"></i>
                        3. Foto Pendukung (Opsional)
                    </h3>

                    <div class="grid sm:grid-cols-2 gap-4 mt-4">
                        <div class="border border-dashed border-slate-300 rounded-xl p-4 text-center bg-slate-50">
                            <label class="block text-xs font-bold text-slate-700 mb-1">Foto KTP Pedagang</label>
                            <input type="file" name="foto_ktp" accept="image/*" class="text-xs text-slate-500 file:mr-2 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-100 file:text-emerald-800">
                        </div>

                        <div class="border border-dashed border-slate-300 rounded-xl p-4 text-center bg-slate-50">
                            <label class="block text-xs font-bold text-slate-700 mb-1">Foto Kios / Tempat Usaha</label>
                            <input type="file" name="foto_usaha" accept="image/*" class="text-xs text-slate-500 file:mr-2 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-100 file:text-emerald-800">
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-6 border-t border-slate-100">
                    <button type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-700 py-3.5 text-sm font-bold text-white shadow-[0_10px_24px_rgba(21,128,61,0.2)] hover:bg-emerald-800 transition">
                        <i class="fa-solid fa-paper-plane text-xs"></i>
                        Kirim Pendaftaran Keanggotaan APPSI
                    </button>
                    <p class="text-xs text-slate-400 text-center mt-3">
                        Data Anda akan diverifikasi oleh Pengurus DPD APPSI Kabupaten Banyuasin.
                    </p>
                </div>

            </form>

        </div>

    </div>
</section>

@endsection
