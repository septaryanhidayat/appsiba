@extends('layouts.public')

@section('title', 'Pusat Unduhan Dokumen & Formulir - DPD APPSI Kabupaten Banyuasin')
@section('meta_description', 'Pusat unduhan dokumen resmi, formulir keanggotaan offline, pedoman advokasi, dan berkas persyaratan KUR DPD APPSI Kabupaten Banyuasin.')

@section('content')
<!-- Header Banner -->
<section class="relative bg-gradient-to-br from-emerald-950 via-emerald-900 to-slate-900 py-16 sm:py-20 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
    <div class="relative mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <span class="inline-flex items-center gap-2 rounded-full bg-emerald-500/20 px-4 py-1.5 text-xs font-bold uppercase tracking-wider text-emerald-300 ring-1 ring-emerald-400/30">
            <i class="fa-solid fa-file-arrow-down text-xs"></i>
            LAYANAN PUBLIK & ARSIP
        </span>
        <h1 class="mt-4 text-3xl font-extrabold sm:text-4xl lg:text-5xl">
            Pusat Unduhan <span class="text-emerald-400">Dokumen Resmi</span>
        </h1>
        <p class="mt-4 mx-auto max-w-2xl text-sm sm:text-base text-emerald-100/90 leading-relaxed">
            Akses dan unduh formulir pendaftaran anggota offline, pedoman advokasi hukum pedagang, berkas rekomendasi KUR, dan regulasi pasar daerah.
        </p>
    </div>
</section>

<!-- Content Section -->
<section class="py-12 sm:py-16 bg-slate-50">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8">
        
        <div class="grid gap-8 lg:grid-cols-3">
            
            <!-- Category 1: Formulir Keanggotaan -->
            <div class="rounded-3xl bg-white p-6 sm:p-7 border border-slate-200/80 shadow-sm flex flex-col justify-between" data-aos="fade-up">
                <div>
                    <div class="flex items-center gap-3 mb-5">
                        <div class="h-10 w-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-lg">
                            <i class="fa-solid fa-id-card"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900">Formulir Keanggotaan</h3>
                            <p class="text-[11px] text-slate-500">Berkas pendaftaran pedagang</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/60 hover:border-emerald-300 transition">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <h4 class="text-xs font-bold text-slate-900">Formulir Pendaftaran Anggota (Offline)</h4>
                                    <p class="text-[10px] text-slate-500 mt-0.5">Format PDF &bull; 2 Halaman &bull; 145 KB</p>
                                </div>
                                <a href="javascript:void(0)" onclick="Swal.fire('Informasi Unduhan', 'Formulir PDF siap dicetak melalui Sekretariat DPD atau Anda dapat langsung mendaftar secara online di menu Pendaftaran.', 'info')" class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-emerald-700 text-white hover:bg-emerald-800 transition shadow-sm">
                                    <i class="fa-solid fa-download text-xs"></i>
                                </a>
                            </div>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/60 hover:border-emerald-300 transition">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <h4 class="text-xs font-bold text-slate-900">Formulir Permohonan Pembaruan KTA</h4>
                                    <p class="text-[10px] text-slate-500 mt-0.5">Format PDF &bull; 1 Halaman &bull; 95 KB</p>
                                </div>
                                <a href="javascript:void(0)" onclick="Swal.fire('Informasi Unduhan', 'Hubungi Sekretariat untuk pembaruan KTA atau cek status di menu Cek KTA.', 'info')" class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-emerald-700 text-white hover:bg-emerald-800 transition shadow-sm">
                                    <i class="fa-solid fa-download text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-slate-100">
                    <a href="{{ route('members.register') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-700 hover:text-emerald-800">
                        <span>Daftar secara Online saja</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
            </div>

            <!-- Category 2: Advokasi & Permodalan -->
            <div class="rounded-3xl bg-white p-6 sm:p-7 border border-slate-200/80 shadow-sm flex flex-col justify-between" data-aos="fade-up" data-aos-delay="100">
                <div>
                    <div class="flex items-center gap-3 mb-5">
                        <div class="h-10 w-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-lg">
                            <i class="fa-solid fa-file-contract"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900">Advokasi & Permodalan</h3>
                            <p class="text-[11px] text-slate-500">Berkas pengaduan & KUR</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/60 hover:border-amber-300 transition">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <h4 class="text-xs font-bold text-slate-900">Formulir Pengaduan Sengketa Lapak / Pasar</h4>
                                    <p class="text-[10px] text-slate-500 mt-0.5">Format PDF &bull; 2 Halaman &bull; 160 KB</p>
                                </div>
                                <a href="javascript:void(0)" onclick="Swal.fire('Posko Advokasi', 'Silakan sampaikan pengaduan melalui form online Kontak & Aspirasi untuk penanganan lebih cepat.', 'info')" class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-amber-600 text-white hover:bg-amber-700 transition shadow-sm">
                                    <i class="fa-solid fa-download text-xs"></i>
                                </a>
                            </div>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/60 hover:border-amber-300 transition">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <h4 class="text-xs font-bold text-slate-900">Persyaratan Rekomendasi KUR Mikro Pedagang</h4>
                                    <p class="text-[10px] text-slate-500 mt-0.5">Format PDF &bull; 1 Halaman &bull; 110 KB</p>
                                </div>
                                <a href="javascript:void(0)" onclick="Swal.fire('Fasilitasi KUR', 'Syarat utama: KTA APPSI aktif, surat keterangan usaha lapak pasar, dan e-KTP. Hubungi pengurus DPD untuk rekomendasi.', 'info')" class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-amber-600 text-white hover:bg-amber-700 transition shadow-sm">
                                    <i class="fa-solid fa-download text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-slate-100">
                    <a href="{{ route('contact.public') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-700 hover:text-amber-800">
                        <span>Konsultasi dengan Pengurus</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
            </div>

            <!-- Category 3: AD/ART & Profil Lembaga -->
            <div class="rounded-3xl bg-white p-6 sm:p-7 border border-slate-200/80 shadow-sm flex flex-col justify-between" data-aos="fade-up" data-aos-delay="200">
                <div>
                    <div class="flex items-center gap-3 mb-5">
                        <div class="h-10 w-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-lg">
                            <i class="fa-solid fa-landmark"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900">Legalitas & Organisasi</h3>
                            <p class="text-[11px] text-slate-500">Anggaran Dasar & Profil DPD</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/60 hover:border-blue-300 transition">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <h4 class="text-xs font-bold text-slate-900">Ringkasan AD/ART APPSI Nasional</h4>
                                    <p class="text-[10px] text-slate-500 mt-0.5">Format PDF &bull; 8 Halaman &bull; 320 KB</p>
                                </div>
                                <a href="javascript:void(0)" onclick="Swal.fire('AD/ART APPSI', 'Dokumen AD/ART mengacu pada ketetapan MUNAS DPP APPSI. Tersedia salinan fisik di Kantor Sekretariat.', 'info')" class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition shadow-sm">
                                    <i class="fa-solid fa-download text-xs"></i>
                                </a>
                            </div>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/60 hover:border-blue-300 transition">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <h4 class="text-xs font-bold text-slate-900">Profil DPD APPSI Kab. Banyuasin 2024-2029</h4>
                                    <p class="text-[10px] text-slate-500 mt-0.5">Format PDF &bull; 4 Halaman &bull; 210 KB</p>
                                </div>
                                <a href="javascript:void(0)" onclick="Swal.fire('Profil DPD', 'Profil kepengurusan lengkap dapat dilihat pada menu Struktur Organisasi dan Tentang Kami.', 'info')" class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition shadow-sm">
                                    <i class="fa-solid fa-download text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-slate-100">
                    <a href="{{ route('organization.public') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-700 hover:text-blue-800">
                        <span>Lihat Struktur Pengurus</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
            </div>

        </div>

    </div>
</section>
@endsection
