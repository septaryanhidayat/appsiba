@extends('layouts.public')

@section('title', 'Program Kerja & 5 Pilar Unggulan - DPD APPSI Kabupaten Banyuasin')
@section('meta_description', 'Program kerja dan 5 pilar perjuangan DPD APPSI Kabupaten Banyuasin dalam memajukan pasar tradisional dan kesejahteraan pedagang.')

@section('content')
<!-- Header Banner -->
<section class="relative bg-gradient-to-br from-emerald-950 via-emerald-900 to-slate-900 py-16 sm:py-20 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
    <div class="relative mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <span class="inline-flex items-center gap-2 rounded-full bg-emerald-500/20 px-4 py-1.5 text-xs font-bold uppercase tracking-wider text-emerald-300 ring-1 ring-emerald-400/30">
            <i class="fa-solid fa-layer-group text-xs"></i>
            PROGRAM STRATEGIS 2024 - 2029
        </span>
        <h1 class="mt-4 text-3xl font-extrabold sm:text-4xl lg:text-5xl">
            5 Pilar Perjuangan <span class="text-emerald-400">Pedagang Pasar</span>
        </h1>
        <p class="mt-4 mx-auto max-w-2xl text-sm sm:text-base text-emerald-100/90 leading-relaxed">
            Komitmen nyata DPD APPSI Kabupaten Banyuasin dalam melindungi eksistensi pasar tradisional, mengadvokasi hak pedagang, dan mendorong kemandirian ekonomi rakyat.
        </p>
    </div>
</section>

<!-- 5 Pillars Section -->
<section class="py-14 sm:py-20 bg-white">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-xl mx-auto mb-14" data-aos="fade-up">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-700">FOKUS UTAMA</span>
            <h2 class="mt-1 text-2xl sm:text-3xl font-extrabold text-slate-900">
                Pilar Transformasi Pasar Rakyat Banyuasin
            </h2>
            <p class="mt-2 text-xs sm:text-sm text-slate-500">
                Langkah konkret DPD APPSI dalam menjawab tantangan era modernisasi tanpa mematikan denyut nadi pasar rakyat.
            </p>
        </div>

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            
            <!-- Pilar 1 -->
            <div class="rounded-3xl border border-slate-200/90 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:shadow-md flex flex-col justify-between" data-aos="fade-up">
                <div>
                    <div class="h-14 w-14 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-2xl shadow-sm mb-6">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                    <span class="text-[11px] font-extrabold uppercase tracking-wider text-emerald-700">PILAR 1</span>
                    <h3 class="mt-1 text-lg font-bold text-slate-900">Advokasi & Perlindungan Hukum Pedagang</h3>
                    <p class="mt-3 text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Memberikan pendampingan hukum dan mediasi gratis bagi pedagang anggota yang menghadapi sengketa sewa lapak, penggusuran sepihak, pungutan liar, atau regulasi yang merugikan pedagang kecil.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100 text-xs font-bold text-emerald-700 flex items-center gap-1.5">
                    <i class="fa-solid fa-shield-halved"></i>
                    Posko Bantuan Hukum DPD
                </div>
            </div>

            <!-- Pilar 2 -->
            <div class="rounded-3xl border border-slate-200/90 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:shadow-md flex flex-col justify-between" data-aos="fade-up" data-aos-delay="100">
                <div>
                    <div class="h-14 w-14 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center text-2xl shadow-sm mb-6">
                        <i class="fa-solid fa-coins"></i>
                    </div>
                    <span class="text-[11px] font-extrabold uppercase tracking-wider text-amber-700">PILAR 2</span>
                    <h3 class="mt-1 text-lg font-bold text-slate-900">Fasilitasi KUR & Modal Tanpa Rentenir</h3>
                    <p class="mt-3 text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Menjembatani akses permodalan Kredit Usaha Rakyat (KUR) berbunga rendah melalui kemitraan dengan Bank Sumsel Babel, Bank BRI, dan BSI guna membebaskan pedagang dari jeratan pinjaman rentenir pasar.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100 text-xs font-bold text-amber-700 flex items-center gap-1.5">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                    Rekomendasi KUR Resmi
                </div>
            </div>

            <!-- Pilar 3 -->
            <div class="rounded-3xl border border-slate-200/90 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:shadow-md flex flex-col justify-between" data-aos="fade-up" data-aos-delay="200">
                <div>
                    <div class="h-14 w-14 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center text-2xl shadow-sm mb-6">
                        <i class="fa-solid fa-qrcode"></i>
                    </div>
                    <span class="text-[11px] font-extrabold uppercase tracking-wider text-blue-700">PILAR 3</span>
                    <h3 class="mt-1 text-lg font-bold text-slate-900">Digitalisasi Pasar & QRIS Bank Indonesia</h3>
                    <p class="mt-3 text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Pelatihan pencatatan keuangan sederhana, fasilitasi pembuatan QRIS gratis bagi pedagang pasar rakyat, serta perintisan katalog digital pedagang agar produk pasar tradisional dapat dipesan online.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100 text-xs font-bold text-blue-700 flex items-center gap-1.5">
                    <i class="fa-solid fa-mobile-screen-button"></i>
                    Pasar Siap QRIS
                </div>
            </div>

            <!-- Pilar 4 -->
            <div class="rounded-3xl border border-slate-200/90 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:shadow-md flex flex-col justify-between" data-aos="fade-up">
                <div>
                    <div class="h-14 w-14 rounded-2xl bg-teal-100 text-teal-700 flex items-center justify-center text-2xl shadow-sm mb-6">
                        <i class="fa-solid fa-broom"></i>
                    </div>
                    <span class="text-[11px] font-extrabold uppercase tracking-wider text-teal-700">PILAR 4</span>
                    <h3 class="mt-1 text-lg font-bold text-slate-900">Revitalisasi & Higienitas Sarana Pasar</h3>
                    <p class="mt-3 text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Mendorong pemerintah daerah melakukan perbaikan drainase, pengelolaan sampah pasar, ketersediaan air bersih, serta penataan zonasi basah/kering demi menciptakan pasar yang bersih, nyaman, dan ramah pembeli.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100 text-xs font-bold text-teal-700 flex items-center gap-1.5">
                    <i class="fa-solid fa-sparkles"></i>
                    Gerakan Pasar Bersih
                </div>
            </div>

            <!-- Pilar 5 -->
            <div class="rounded-3xl border border-slate-200/90 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:shadow-md flex flex-col justify-between" data-aos="fade-up" data-aos-delay="100">
                <div>
                    <div class="h-14 w-14 rounded-2xl bg-indigo-100 text-indigo-700 flex items-center justify-center text-2xl shadow-sm mb-6">
                        <i class="fa-solid fa-weight-scale"></i>
                    </div>
                    <span class="text-[11px] font-extrabold uppercase tracking-wider text-indigo-700">PILAR 5</span>
                    <h3 class="mt-1 text-lg font-bold text-slate-900">Tera Ulang & Kepastian Timbangan</h3>
                    <p class="mt-3 text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Bersinergi dengan Unit Metrologi Legal Disperindag Kabupaten Banyuasin untuk menyelenggarakan tera ulang timbangan berkala, menjaga akurasi takaran dan membangun kepercayaan konsumen pasar.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100 text-xs font-bold text-indigo-700 flex items-center gap-1.5">
                    <i class="fa-solid fa-certificate"></i>
                    Pasar Tertib Ukur
                </div>
            </div>

            <!-- Kartu Gabung Komunitas -->
            <div class="rounded-3xl bg-gradient-to-br from-emerald-800 to-emerald-950 p-7 text-white shadow-xl flex flex-col justify-between" data-aos="fade-up" data-aos-delay="200">
                <div>
                    <span class="inline-block px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 text-[10px] font-extrabold tracking-wider uppercase ring-1 ring-emerald-400/30">
                        MARI BERGABUNG
                    </span>
                    <h3 class="mt-4 text-xl font-extrabold text-white">Ingin Lapak Anda Mendapatkan Manfaat Ini?</h3>
                    <p class="mt-3 text-xs sm:text-sm text-emerald-100/90 leading-relaxed">
                        Daftarkan diri Anda sebagai anggota resmi DPD APPSI Kabupaten Banyuasin dan miliki KTA resmi ber-barcode untuk kemudahan akses fasilitas organisasi.
                    </p>
                </div>
                <div class="mt-8">
                    <a href="{{ route('members.register') }}" class="inline-flex items-center justify-center gap-2 w-full rounded-2xl bg-white py-3 px-5 text-xs sm:text-sm font-extrabold text-emerald-900 shadow hover:bg-emerald-50 transition">
                        <i class="fa-solid fa-user-plus"></i>
                        Daftar Anggota Online Sekarang
                    </a>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- Flow Section: Cara Mendapatkan Bantuan -->
<section class="py-14 sm:py-20 bg-slate-50 border-t border-slate-200/80">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-xl mx-auto mb-14" data-aos="fade-up">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-700">ALUR PELAYANAN</span>
            <h2 class="mt-1 text-2xl sm:text-3xl font-extrabold text-slate-900">
                Cara Mengajukan Bantuan / Advokasi
            </h2>
            <p class="mt-2 text-xs sm:text-sm text-slate-500">
                Prosedur sederhana bagi pedagang yang membutuhkan bantuan atau rekomendasi organisasi.
            </p>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            
            <!-- Step 1 -->
            <div class="rounded-3xl bg-white p-6 border border-slate-200/80 shadow-sm text-center relative" data-aos="fade-up">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 font-extrabold text-lg flex items-center justify-center mx-auto mb-4 border border-emerald-200">
                    1
                </div>
                <h4 class="text-sm font-bold text-slate-900">Terdaftar Sebagai Anggota</h4>
                <p class="mt-2 text-xs text-slate-500 leading-relaxed">
                    Pedagang memiliki Nomor Pokok Anggota (NPA) resmi DPD APPSI Banyuasin.
                </p>
            </div>

            <!-- Step 2 -->
            <div class="rounded-3xl bg-white p-6 border border-slate-200/80 shadow-sm text-center relative" data-aos="fade-up" data-aos-delay="100">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 font-extrabold text-lg flex items-center justify-center mx-auto mb-4 border border-emerald-200">
                    2
                </div>
                <h4 class="text-sm font-bold text-slate-900">Sampaikan Permasalahan</h4>
                <p class="mt-2 text-xs text-slate-500 leading-relaxed">
                    Mengisi formulir pengaduan online atau melapor langsung ke kantor sekretariat.
                </p>
            </div>

            <!-- Step 3 -->
            <div class="rounded-3xl bg-white p-6 border border-slate-200/80 shadow-sm text-center relative" data-aos="fade-up" data-aos-delay="200">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 font-extrabold text-lg flex items-center justify-center mx-auto mb-4 border border-emerald-200">
                    3
                </div>
                <h4 class="text-sm font-bold text-slate-900">Verifikasi & Mediasi</h4>
                <p class="mt-2 text-xs text-slate-500 leading-relaxed">
                    Tim advokasi DPD APPSI meninjau ke lapangan dan berkoordinasi dengan pengelola pasar.
                </p>
            </div>

            <!-- Step 4 -->
            <div class="rounded-3xl bg-white p-6 border border-slate-200/80 shadow-sm text-center relative" data-aos="fade-up" data-aos-delay="300">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 font-extrabold text-lg flex items-center justify-center mx-auto mb-4 border border-emerald-200">
                    4
                </div>
                <h4 class="text-sm font-bold text-slate-900">Penyelesaian Bersama</h4>
                <p class="mt-2 text-xs text-slate-500 leading-relaxed">
                    Pendampingan hingga tuntas menghasilkan solusi adil yang melindungi hak pedagang.
                </p>
            </div>

        </div>

    </div>
</section>
@endsection
