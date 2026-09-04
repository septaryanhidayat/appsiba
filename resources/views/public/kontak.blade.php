@extends('layouts.public')

@section('title', 'Kontak & Sekretariat - DPD APPSI Kabupaten Banyuasin')
@section('meta_description', 'Hubungi Sekretariat DPD APPSI Kabupaten Banyuasin. Sampaikan aspirasi, aduan fasilitas pasar, atau permohonan advokasi perlindungan pedagang.')

@section('content')
<!-- Header Banner -->
<section class="relative bg-gradient-to-br from-emerald-900 via-emerald-800 to-slate-900 py-16 sm:py-20 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
    <div class="relative mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <span class="inline-flex items-center gap-2 rounded-full bg-emerald-500/20 px-4 py-1.5 text-xs font-bold uppercase tracking-wider text-emerald-300 ring-1 ring-emerald-400/30">
            <i class="fa-solid fa-headset text-xs"></i>
            LAYANAN ASPIRASI & SEKRETARIAT
        </span>
        <h1 class="mt-4 text-3xl font-extrabold sm:text-4xl lg:text-5xl">
            Hubungi <span class="text-emerald-400">Pengurus DPD APPSI</span>
        </h1>
        <p class="mt-4 mx-auto max-w-2xl text-sm sm:text-base text-emerald-100/90 leading-relaxed">
            Saluran resmi komunikasi, kemitraan instansi, konsultasi permodalan KUR, dan penyampaian aspirasi pedagang pasar se-Kabupaten Banyuasin.
        </p>
    </div>
</section>

<!-- Content Section -->
<section class="py-12 sm:py-16 bg-slate-50">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8">
        
        <!-- Flash Message -->
        @if(session('success'))
            <div class="mb-8 rounded-2xl bg-emerald-50 border border-emerald-200 p-5 text-emerald-800 shadow-sm flex items-start gap-3.5" data-aos="fade-up">
                <div class="w-8 h-8 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 mt-0.5">
                    <i class="fa-solid fa-check text-sm"></i>
                </div>
                <div>
                    <h4 class="text-sm font-bold">Terima Kasih!</h4>
                    <p class="text-xs sm:text-sm mt-0.5">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="grid gap-8 lg:grid-cols-12 items-start">
            
            <!-- Left Column: Sekretariat Info & Map -->
            <div class="lg:col-span-5 space-y-6" data-aos="fade-up">
                
                <!-- Office Info Card -->
                <div class="rounded-3xl bg-white p-6 sm:p-8 border border-slate-200/80 shadow-sm">
                    <h2 class="text-lg font-extrabold text-slate-900 flex items-center gap-2.5">
                        <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                            <i class="fa-solid fa-building text-sm"></i>
                        </span>
                        Kantor Sekretariat DPD
                    </h2>
                    <p class="mt-2 text-xs text-slate-500 leading-relaxed">
                        Pusat koordinasi, administrasi keanggotaan, dan pelayanan advokasi pedagang pasar.
                    </p>

                    <div class="mt-6 space-y-4 text-xs sm:text-sm text-slate-600">
                        <div class="flex items-start gap-3.5">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-emerald-700 mt-0.5">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <strong class="block text-slate-900 font-bold">Alamat Lengkap</strong>
                                <span class="leading-relaxed text-slate-600">
                                    {{ $settings['alamat'] ?? 'Jalan Merdeka, Depan Pasar Baru Kelurahan Pangkalan Balai - Kecamatan Banyuasin III, Kab. Banyuasin, Sumatera Selatan' }}
                                </span>
                            </div>
                        </div>

                        <div class="flex items-start gap-3.5">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-emerald-700 mt-0.5">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <div>
                                <strong class="block text-slate-900 font-bold">Jam Pelayanan Kantor</strong>
                                <span class="leading-relaxed text-slate-600">
                                    Senin – Jumat: 08.00 – 16.00 WIB<br>
                                    Sabtu: 08.00 – 12.00 WIB (Piket Khusus)<br>
                                    Minggu & Hari Libur Nasional: Tutup
                                </span>
                            </div>
                        </div>

                        <div class="flex items-start gap-3.5">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-emerald-700 mt-0.5">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div>
                                <strong class="block text-slate-900 font-bold">Telepon / Hotline</strong>
                                <a href="tel:{{ $settings['telepon'] ?? '0811618808' }}" class="text-emerald-700 font-bold hover:underline">
                                    {{ $settings['telepon'] ?? '0811 618 808' }}
                                </a>
                            </div>
                        </div>

                        <div class="flex items-start gap-3.5">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-emerald-700 mt-0.5">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div>
                                <strong class="block text-slate-900 font-bold">Email Resmi</strong>
                                <a href="mailto:{{ $settings['email'] ?? 'appsi.banyuasin@gmail.com' }}" class="text-emerald-700 font-bold hover:underline">
                                    {{ $settings['email'] ?? 'appsi.banyuasin@gmail.com' }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- WhatsApp CTA -->
                    <div class="mt-7 pt-6 border-t border-slate-100">
                        <a href="https://wa.me/{{ $settings['whatsapp'] ?? '62811618808' }}?text=Halo%20Pengurus%20DPD%20APPSI%20Banyuasin,%20saya%20ingin%20berkonsultasi..." target="_blank" class="w-full flex items-center justify-center gap-2.5 rounded-2xl bg-emerald-600 py-3 text-xs sm:text-sm font-bold text-white shadow-lg shadow-emerald-700/20 hover:bg-emerald-700 transition">
                            <i class="fa-brands fa-whatsapp text-base"></i>
                            Chat WhatsApp Sekretariat
                        </a>
                    </div>
                </div>

                <!-- Emergency Banner -->
                <div class="rounded-3xl bg-gradient-to-br from-amber-500 to-amber-600 p-6 text-white shadow-md">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-triangle-exclamation text-2xl text-amber-100"></i>
                        <div>
                            <h4 class="text-sm font-extrabold">Posko Pengaduan Pedagang</h4>
                            <p class="text-xs text-amber-100">Mengalami sengketa lapak, intimidasi, atau masalah permodalan?</p>
                        </div>
                    </div>
                    <p class="mt-3 text-xs leading-relaxed text-amber-50">
                        DPD APPSI Banyuasin siap memberikan pendampingan dan mediasi hukum gratis bagi pedagang pasar anggota resmi.
                    </p>
                </div>

            </div>

            <!-- Right Column: Aspirasi Form -->
            <div class="lg:col-span-7" data-aos="fade-up" data-aos-delay="100">
                <div class="rounded-3xl bg-white p-6 sm:p-10 border border-slate-200/80 shadow-sm">
                    <div class="border-b border-slate-100 pb-5 mb-6">
                        <span class="text-xs font-bold uppercase tracking-widest text-emerald-700">FORMULIR ELEKTRONIK</span>
                        <h2 class="mt-1 text-2xl font-extrabold text-slate-900">Sampaikan Aspirasi & Pesan</h2>
                        <p class="mt-1.5 text-xs sm:text-sm text-slate-500">
                            Pesan Anda akan langsung tercatat di sistem informasi pengurus DPD APPSI Kabupaten Banyuasin.
                        </p>
                    </div>

                    <form action="{{ route('inbox.store') }}" method="POST" class="space-y-5">
                        @csrf
                        
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Nama Lengkap *</label>
                                <input type="text" name="nama" required value="{{ old('nama') }}" placeholder="Contoh: Budi Santoso" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-xs sm:text-sm focus:border-emerald-600 focus:outline-none bg-slate-50/50">
                                @error('nama') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5">No. WhatsApp / HP *</label>
                                <input type="tel" name="telepon" required value="{{ old('telepon') }}" placeholder="08xxxxxxxxxx" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-xs sm:text-sm focus:border-emerald-600 focus:outline-none bg-slate-50/50">
                                @error('telepon') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Email (Opsional)</label>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-xs sm:text-sm focus:border-emerald-600 focus:outline-none bg-slate-50/50">
                                @error('email') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Asal Pasar / Instansi *</label>
                                <input type="text" name="instansi" required value="{{ old('instansi') }}" placeholder="Contoh: Pasar Pangkalan Balai / Pedagang" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-xs sm:text-sm focus:border-emerald-600 focus:outline-none bg-slate-50/50">
                                @error('instansi') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Tujuan Surat / Pesan *</label>
                                <select name="tujuan" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-xs sm:text-sm focus:border-emerald-600 focus:outline-none bg-slate-50/50">
                                    <option value="Ketua DPD APPSI Kabupaten Banyuasin">Ketua DPD APPSI Banyuasin</option>
                                    <option value="Sekretariat DPD APPSI Banyuasin">Sekretariat DPD APPSI Banyuasin</option>
                                    <option value="Bidang Advokasi & Hukum Pedagang">Bidang Advokasi & Hukum Pedagang</option>
                                    <option value="Bidang Permodalan & KUR UMKM">Bidang Permodalan & KUR UMKM</option>
                                    <option value="Komisariat Pasar Daerah">Komisariat Pasar Daerah</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Kategori Keperluan *</label>
                                <select name="keperluan" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-xs sm:text-sm focus:border-emerald-600 focus:outline-none bg-slate-50/50">
                                    <option value="Aspirasi & Masukan Pasar">Aspirasi & Masukan Pasar</option>
                                    <option value="Pengaduan Fasilitas / Ketertiban Lapak">Pengaduan Fasilitas / Ketertiban Lapak</option>
                                    <option value="Permohonan Bantuan Hukum & Advokasi">Permohonan Bantuan Hukum & Advokasi</option>
                                    <option value="Konsultasi Permodalan KUR & Usaha">Konsultasi Permodalan KUR & Usaha</option>
                                    <option value="Undangan / Kerjasama Instansi">Undangan / Kerjasama Instansi</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Isi Pesan / Keterangan Lengkap *</label>
                            <textarea name="pesan" rows="5" required placeholder="Tuliskan pesan, kronologi kejadian, atau aspirasi Anda secara jelas..." class="w-full rounded-xl border border-slate-200 p-4 text-xs sm:text-sm focus:border-emerald-600 focus:outline-none bg-slate-50/50">{{ old('pesan') }}</textarea>
                            @error('pesan') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-2xl bg-emerald-700 px-8 py-3.5 text-sm font-bold text-white shadow-lg shadow-emerald-700/20 hover:bg-emerald-800 transition">
                                <i class="fa-solid fa-paper-plane text-xs"></i>
                                Kirim Pesan Aspirasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
</section>
@endsection
