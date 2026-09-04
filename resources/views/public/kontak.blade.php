@extends('layouts.public')

@section('title', 'Kontak & Sekretariat - DPD APPSI Kabupaten Banyuasin')
@section('meta_description', 'Hubungi Pengurus DPD APPSI Kabupaten Banyuasin. Sampaikan aspirasi, aduan sengketa lapak, permohonan advokasi, atau konsultasi permodalan pedagang pasar.')

@section('content')

<!-- 1. Header Banner Elegan -->
<section class="relative bg-gradient-to-br from-[#063327] via-[#04281f] to-slate-900 py-14 sm:py-20 text-white overflow-hidden">
    <!-- Ambient dot pattern -->
    <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#10b981_1px,transparent_1px)] [background-size:18px_18px] pointer-events-none"></div>
    <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-emerald-500/10 blur-3xl pointer-events-none"></div>

    <div class="relative mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <span class="inline-flex items-center gap-2 rounded-full bg-emerald-500/20 px-4 py-1.5 text-xs font-bold uppercase tracking-wider text-emerald-300 ring-1 ring-emerald-400/30">
            <i class="fa-solid fa-headset text-xs"></i>
            PUSAT LAYANAN & SEKRETARIAT DPD
        </span>
        <h1 class="mt-4 text-3xl font-black tracking-tight sm:text-4xl lg:text-5xl text-white">
            Hubungi <span class="text-emerald-400">Pengurus DPD APPSI</span>
        </h1>
        <p class="mt-4 mx-auto max-w-2xl text-sm sm:text-base text-emerald-100/90 leading-relaxed font-normal">
            Saluran resmi koordinasi organisasi, konsultasi permodalan usaha KUR, kemitraan instansi, serta penyampaian aspirasi dan advokasi pedagang pasar se-Kabupaten Banyuasin.
        </p>

        <!-- Trust Highlights -->
        <div class="mt-6 flex flex-wrap items-center justify-center gap-3 text-xs text-emerald-200">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 backdrop-blur-sm border border-white/10">
                <i class="fa-solid fa-bolt text-amber-400"></i> Respon Cepat 1x24 Jam Kerja
            </span>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 backdrop-blur-sm border border-white/10">
                <i class="fa-solid fa-shield-halved text-emerald-400"></i> Advokasi & Mediasi Gratis
            </span>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 backdrop-blur-sm border border-white/10">
                <i class="fa-solid fa-server text-blue-400"></i> Pangkalan Data Terpadu MIS
            </span>
        </div>
    </div>
</section>

<!-- 2. Main Content Area -->
<section class="py-12 sm:py-16 bg-slate-50">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8">
        
        <!-- Flash Alert Message -->
        @if(session('success'))
            <div class="mb-8 rounded-2xl bg-emerald-50 border border-emerald-200 p-5 text-emerald-800 shadow-sm flex items-start gap-3.5" data-aos="fade-up">
                <div class="w-8 h-8 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 mt-0.5 shadow-sm">
                    <i class="fa-solid fa-check text-sm"></i>
                </div>
                <div>
                    <h4 class="text-sm font-bold">Pesan Terkirim!</h4>
                    <p class="text-xs sm:text-sm mt-0.5 text-emerald-700 leading-relaxed">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-8 rounded-2xl bg-red-50 border border-red-200 p-5 text-red-800 shadow-sm flex items-start gap-3.5" data-aos="fade-up">
                <div class="w-8 h-8 rounded-xl bg-red-600 text-white flex items-center justify-center shrink-0 mt-0.5 shadow-sm">
                    <i class="fa-solid fa-triangle-exclamation text-sm"></i>
                </div>
                <div>
                    <h4 class="text-sm font-bold">Perhatian</h4>
                    <p class="text-xs sm:text-sm mt-0.5 text-red-700 leading-relaxed">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <!-- Quick Contact Channels (3 Cards Row) -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-10" data-aos="fade-up">
            
            <!-- Channel 1: WhatsApp Hotline -->
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp'] ?? '62811618808') }}?text=Halo%20Pengurus%20DPD%20APPSI%20Banyuasin,%20saya%20ingin%20berkonsultasi..." target="_blank" rel="noopener noreferrer" class="group bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm hover:border-emerald-500 hover:shadow-md transition-all flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between gap-3 mb-3">
                        <div class="h-11 w-11 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-lg shrink-0 group-hover:bg-emerald-700 group-hover:text-white transition-colors shadow-sm">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                            Fast Response
                        </span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900 group-hover:text-emerald-700 transition-colors">Hotline WhatsApp</h3>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        Layanan konsultasi cepat seputar pasar, perizinan lapak, dan pengurusan kartu tanda anggota.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-emerald-700">
                    <span>{{ $settings['telepon'] ?? '0811 618 808' }}</span>
                    <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                </div>
            </a>

            <!-- Channel 2: Email Korespondensi -->
            <a href="mailto:{{ $settings['email'] ?? 'appsi.banyuasin@gmail.com' }}" class="group bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm hover:border-blue-500 hover:shadow-md transition-all flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between gap-3 mb-3">
                        <div class="h-11 w-11 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center text-lg shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-colors shadow-sm">
                            <i class="fa-regular fa-envelope"></i>
                        </div>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">
                            Persuratan Resmi
                        </span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900 group-hover:text-blue-700 transition-colors">Email & Surat Masuk</h3>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        Pengiriman berkas permohonan, undangan audiensi, kerjasama dinas instansi, dan kemitraan perbankan.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-blue-700">
                    <span class="truncate">{{ $settings['email'] ?? 'appsi.banyuasin@gmail.com' }}</span>
                    <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                </div>
            </a>

            <!-- Channel 3: Posko Bantuan Hukum -->
            <div class="group bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm hover:border-amber-500 hover:shadow-md transition-all flex flex-col justify-between sm:col-span-2 lg:col-span-1">
                <div>
                    <div class="flex items-center justify-between gap-3 mb-3">
                        <div class="h-11 w-11 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center text-lg shrink-0 group-hover:bg-amber-600 group-hover:text-white transition-colors shadow-sm">
                            <i class="fa-solid fa-scale-balanced"></i>
                        </div>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">
                            Mediasi Gratis
                        </span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900 group-hover:text-amber-700 transition-colors">Advokasi Pedagang</h3>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        Pendampingan hukum bagi anggota resmi yang mengalami sengketa lapak, intimidasi, atau masalah sewa pasar.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-amber-700">
                    <span>Bidang Hukum & Advokasi DPD</span>
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
            </div>

        </div>

        <!-- Main Grid: Info Sekretariat & Form Aspirasi -->
        <div class="grid gap-8 lg:grid-cols-12 items-start">
            
            <!-- Left Column: Info Sekretariat & Profil Ketua (5 Kolom) -->
            <div class="lg:col-span-5 space-y-6" data-aos="fade-up">
                
                <!-- Card 1: Kantor Sekretariat DPD -->
                <div class="rounded-3xl bg-white p-6 sm:p-7 border border-slate-200/80 shadow-sm">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                        <div class="h-10 w-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 text-base shadow-sm">
                            <i class="fa-solid fa-building"></i>
                        </div>
                        <div>
                            <h2 class="text-base font-extrabold text-slate-900">Kantor Sekretariat DPD</h2>
                            <p class="text-[11px] text-slate-500">Pusat Administrasi & Tata Kelola APPSI</p>
                        </div>
                    </div>

                    <div class="mt-5 space-y-4 text-xs sm:text-sm text-slate-600">
                        <!-- Alamat -->
                        <div class="flex items-start gap-3.5">
                            <div class="h-8 w-8 rounded-lg bg-slate-100 text-emerald-700 flex items-center justify-center shrink-0 mt-0.5">
                                <i class="fa-solid fa-location-dot text-xs"></i>
                            </div>
                            <div>
                                <strong class="block text-slate-900 font-bold text-xs uppercase tracking-wider mb-0.5">Alamat Kantor</strong>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    {{ $settings['alamat'] ?? 'Jalan Merdeka, Depan Pasar Baru Kelurahan Pangkalan Balai - Kecamatan Banyuasin III, Kabupaten Banyuasin, Sumatera Selatan' }}
                                </p>
                            </div>
                        </div>

                        <!-- Jam Layanan -->
                        <div class="flex items-start gap-3.5">
                            <div class="h-8 w-8 rounded-lg bg-slate-100 text-emerald-700 flex items-center justify-center shrink-0 mt-0.5">
                                <i class="fa-solid fa-clock text-xs"></i>
                            </div>
                            <div>
                                <strong class="block text-slate-900 font-bold text-xs uppercase tracking-wider mb-0.5">Jam Operasional</strong>
                                <div class="text-xs text-slate-600 space-y-0.5">
                                    <p><span class="font-semibold text-slate-800">Senin – Jumat:</span> 08.00 – 16.00 WIB</p>
                                    <p><span class="font-semibold text-slate-800">Sabtu:</span> 08.00 – 12.00 WIB (Piket Khusus)</p>
                                    <p class="text-slate-400">Minggu & Hari Libur Nasional: Tutup</p>
                                </div>
                            </div>
                        </div>

                        <!-- Telepon -->
                        <div class="flex items-start gap-3.5">
                            <div class="h-8 w-8 rounded-lg bg-slate-100 text-emerald-700 flex items-center justify-center shrink-0 mt-0.5">
                                <i class="fa-solid fa-phone text-xs"></i>
                            </div>
                            <div>
                                <strong class="block text-slate-900 font-bold text-xs uppercase tracking-wider mb-0.5">Telepon / WhatsApp</strong>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp'] ?? '62811618808') }}" target="_blank" class="text-xs text-emerald-700 font-bold hover:underline">
                                    {{ $settings['telepon'] ?? '0811 618 808' }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Navigasi Google Maps -->
                    <div class="mt-6 pt-5 border-t border-slate-100 flex flex-col sm:flex-row gap-2.5">
                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($settings['alamat'] ?? 'Pasar Baru Pangkalan Balai Banyuasin') }}" target="_blank" rel="noopener noreferrer" class="flex-1 flex items-center justify-center gap-2 py-2.5 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition">
                            <i class="fa-solid fa-map-pin text-emerald-700"></i>
                            <span>Buka di Google Maps</span>
                        </a>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp'] ?? '62811618808') }}" target="_blank" class="flex-1 flex items-center justify-center gap-2 py-2.5 px-3 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold transition shadow-sm">
                            <i class="fa-brands fa-whatsapp"></i>
                            <span>Chat WhatsApp</span>
                        </a>
                    </div>
                </div>

                <!-- Card 2: Profil & Sambutan Ketua DPD (Dengan Foto 4 Resmi!) -->
                <div class="rounded-3xl bg-gradient-to-br from-white via-emerald-50/40 to-emerald-50/70 p-6 sm:p-7 border border-emerald-200/80 shadow-sm relative overflow-hidden">
                    <div class="flex items-start gap-4">
                        <!-- Frame Foto Ketua Baru (Foto 4 Resmi) -->
                        <div class="w-20 h-24 sm:w-24 sm:h-28 rounded-2xl overflow-hidden border-2 border-emerald-500 bg-gradient-to-b from-white to-emerald-100 shrink-0 shadow-sm flex items-end justify-center">
                            <img src="{{ asset('assets/images/ketua-appsi-banyuasin.webp') }}" 
                                 alt="{{ $ketua->nama ?? 'H. Gusra Yetri, SH' }} - Ketua DPD APPSI Banyuasin" 
                                 class="w-full h-full object-contain object-top pt-1">
                        </div>

                        <div class="min-w-0 flex-1">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-emerald-100 text-emerald-800 text-[10px] font-extrabold uppercase tracking-wider mb-1">
                                <i class="fa-solid fa-user-tie text-[9px]"></i> Pimpinan DPD
                            </span>
                            <h3 class="text-sm sm:text-base font-extrabold text-slate-900 leading-tight">
                                {{ $ketua->nama ?? 'H. Gusra Yetri, SH' }}
                            </h3>
                            <p class="text-xs font-semibold text-emerald-700 mt-0.5">
                                {{ $ketua->jabatan ?? 'Ketua DPD APPSI Kabupaten Banyuasin' }}
                            </p>
                            <p class="text-[11px] text-slate-500 mt-2 leading-relaxed italic line-clamp-3">
                                "Pintu sekretariat DPD selalu terbuka bagi setiap pedagang pasar. Bersama kita jaga kerukunan, stabilitas, dan kemandirian usaha rakyat."
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Komitmen & Standar Layanan Aspirasi -->
                <div class="rounded-3xl bg-white p-5 sm:p-6 border border-slate-200/80 shadow-sm">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-900 mb-3 flex items-center gap-2">
                        <i class="fa-solid fa-certificate text-emerald-600"></i>
                        Komitmen Pelayanan Sekretariat
                    </h4>
                    <ul class="space-y-2.5 text-xs text-slate-600">
                        <li class="flex items-start gap-2.5">
                            <i class="fa-solid fa-circle-check text-emerald-600 mt-0.5 shrink-0 text-xs"></i>
                            <span><strong>Kerahasiaan Identitas:</strong> Setiap aduan pedagang dijamin kerahasiaannya dan terlindungi secara organisasi.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <i class="fa-solid fa-circle-check text-emerald-600 mt-0.5 shrink-0 text-xs"></i>
                            <span><strong>Penerusan Cepat:</strong> Aspirasi yang masuk ke MIS diverifikasi dan diteruskan ke bidang terkait maksimal 1x24 jam kerja.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <i class="fa-solid fa-circle-check text-emerald-600 mt-0.5 shrink-0 text-xs"></i>
                            <span><strong>Tanpa Biaya (Gratis):</strong> Konsultasi dan mediasi hukum sengketa lapak pasar diberikan bebas pungutan.</span>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Right Column: Formulir Elektronik Aspirasi & Pesan (7 Kolom) -->
            <div class="lg:col-span-7" data-aos="fade-up" data-aos-delay="100">
                <div class="rounded-3xl bg-white p-6 sm:p-8 lg:p-9 border border-slate-200/80 shadow-sm">
                    
                    <!-- Header Form -->
                    <div class="border-b border-slate-100 pb-5 mb-6">
                        <div class="flex items-center gap-2 mb-1.5">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-extrabold uppercase tracking-wider bg-emerald-50 text-emerald-800 border border-emerald-200">
                                FORMULIR ASPIRASI ONLINE
                            </span>
                        </div>
                        <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Sampaikan Aspirasi & Pesan</h2>
                        <p class="mt-1 text-xs sm:text-sm text-slate-500 leading-relaxed">
                            Pesan Anda akan langsung masuk ke Dashboard MIS pengurus DPD APPSI Banyuasin dan ditindaklanjuti secara resmi.
                        </p>
                    </div>

                    <!-- Form Action -->
                    <form action="{{ route('inbox.store') }}" method="POST" class="space-y-4 sm:space-y-5">
                        @csrf
                        
                        <!-- Row 1: Nama & Telepon -->
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wide text-slate-700 mb-1.5">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                        <i class="fa-solid fa-user text-xs"></i>
                                    </div>
                                    <input type="text" name="nama" required value="{{ old('nama') }}" placeholder="Contoh: Budi Santoso" class="w-full rounded-xl border border-slate-200 pl-9 pr-4 py-2.5 text-xs sm:text-sm focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 focus:outline-none bg-slate-50/60 font-medium">
                                </div>
                                @error('nama') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wide text-slate-700 mb-1.5">
                                    No. WhatsApp / HP <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                        <i class="fa-brands fa-whatsapp text-xs"></i>
                                    </div>
                                    <input type="tel" name="telepon" required value="{{ old('telepon') }}" placeholder="08xxxxxxxxxx" class="w-full rounded-xl border border-slate-200 pl-9 pr-4 py-2.5 text-xs sm:text-sm focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 focus:outline-none bg-slate-50/60 font-medium">
                                </div>
                                @error('telepon') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Row 2: Email & Asal Pasar -->
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wide text-slate-700 mb-1.5">
                                    Email <span class="text-slate-400 font-normal">(Opsional)</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                        <i class="fa-regular fa-envelope text-xs"></i>
                                    </div>
                                    <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" class="w-full rounded-xl border border-slate-200 pl-9 pr-4 py-2.5 text-xs sm:text-sm focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 focus:outline-none bg-slate-50/60 font-medium">
                                </div>
                                @error('email') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wide text-slate-700 mb-1.5">
                                    Asal Pasar / Instansi <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                        <i class="fa-solid fa-store text-xs"></i>
                                    </div>
                                    <input type="text" name="instansi" required value="{{ old('instansi') }}" placeholder="Contoh: Pasar Pangkalan Balai / Pedagang Sayur" class="w-full rounded-xl border border-slate-200 pl-9 pr-4 py-2.5 text-xs sm:text-sm focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 focus:outline-none bg-slate-50/60 font-medium">
                                </div>
                                @error('instansi') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Row 3: Tujuan Pesan & Kategori Keperluan -->
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wide text-slate-700 mb-1.5">
                                    Tujuan Surat / Pesan <span class="text-red-500">*</span>
                                </label>
                                <select name="tujuan" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-xs sm:text-sm focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 focus:outline-none bg-slate-50/60 font-medium text-slate-800">
                                    <option value="Ketua DPD APPSI Kabupaten Banyuasin">Ketua DPD APPSI Kabupaten Banyuasin</option>
                                    <option value="Sekretariat DPD APPSI Banyuasin">Sekretariat DPD APPSI Banyuasin</option>
                                    <option value="Bidang Advokasi & Hukum Pedagang">Bidang Advokasi & Hukum Pedagang</option>
                                    <option value="Bidang Permodalan & KUR UMKM">Bidang Permodalan & KUR UMKM</option>
                                    <option value="Komisariat Pasar Daerah">Komisariat Pasar Daerah</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wide text-slate-700 mb-1.5">
                                    Kategori Keperluan <span class="text-red-500">*</span>
                                </label>
                                <select name="keperluan" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-xs sm:text-sm focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 focus:outline-none bg-slate-50/60 font-medium text-slate-800">
                                    <option value="Aspirasi & Masukan Pasar">Aspirasi & Masukan Pasar</option>
                                    <option value="Pengaduan Fasilitas / Ketertiban Lapak">Pengaduan Fasilitas / Ketertiban Lapak</option>
                                    <option value="Permohonan Bantuan Hukum & Advokasi">Permohonan Bantuan Hukum & Advokasi</option>
                                    <option value="Konsultasi Permodalan KUR & Usaha">Konsultasi Permodalan KUR & Usaha</option>
                                    <option value="Undangan / Kerjasama Instansi">Undangan / Kerjasama Instansi</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>

                        <!-- Row 4: Pesan / Keterangan -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wide text-slate-700 mb-1.5">
                                Isi Pesan / Uraian Masalah <span class="text-red-500">*</span>
                            </label>
                            <textarea name="pesan" rows="5" required placeholder="Tuliskan pesan, kronologi kejadian, aduan fasilitas pasar, atau saran kemitraan Anda secara jelas..." class="w-full rounded-xl border border-slate-200 p-4 text-xs sm:text-sm focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 focus:outline-none bg-slate-50/60 font-medium text-slate-800 leading-relaxed">{{ old('pesan') }}</textarea>
                            @error('pesan') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Submit Button & Privacy Note -->
                        <div class="pt-3 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                            <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 rounded-xl bg-emerald-700 px-8 py-3.5 text-xs sm:text-sm font-bold text-white shadow-lg shadow-emerald-700/20 hover:bg-emerald-800 hover:shadow-xl transition-all duration-200">
                                <i class="fa-solid fa-paper-plane text-xs"></i>
                                <span>Kirim Pesan Aspirasi Sekarang</span>
                            </button>

                            <div class="flex items-center gap-2 text-[11px] text-slate-400">
                                <i class="fa-solid fa-lock text-emerald-600 text-xs"></i>
                                <span>Data terlindungi dan terenkripsi sistem MIS.</span>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>
</section>

@endsection
