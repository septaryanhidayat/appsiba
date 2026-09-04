@extends('layouts.public')

@section('title', 'Tentang Kami - DPD APPSI Kabupaten Banyuasin')

@section('content')

<!-- Header Banner -->
<section class="bg-gradient-to-b from-emerald-50/70 via-white to-white py-12 sm:py-16 border-b border-slate-100">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <span class="inline-block rounded-full bg-emerald-100 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-emerald-800">
            PROFIL ORGANISASI
        </span>
        <h1 class="mt-3 text-3xl font-extrabold text-slate-900 sm:text-4xl">
            Tentang <span class="text-emerald-700">APPSI Kabupaten Banyuasin</span>
        </h1>
        <p class="mt-3 text-sm text-slate-600 sm:text-base max-w-2xl mx-auto">
            Wadah perjuangan, aspirasi, dan pemberdayaan para pedagang pasar tradisional demi mewujudkan kemandirian ekonomi kerakyatan.
        </p>
    </div>
</section>

<!-- Section Content -->
<section class="py-14 sm:py-20 bg-white">
    <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8">
        
        <!-- Sambutan Ketua DPD -->
        <div class="bg-gradient-to-br from-emerald-50 via-white to-white rounded-3xl border border-emerald-200 p-8 sm:p-12 mb-16 shadow-sm" data-aos="fade-up">
            <div class="grid lg:grid-cols-[280px_1fr] gap-8 items-center">
                <div class="flex flex-col items-center text-center">
                    <div class="w-48 h-60 rounded-2xl overflow-hidden shadow-md border-2 border-emerald-500 bg-gradient-to-b from-white to-emerald-50">
                        <img src="{{ asset('assets/images/ketua-appsi-banyuasin.webp') }}" alt="H. Gusra Yetri, SH" class="w-full h-full object-cover object-top">
                    </div>
                    <h3 class="mt-4 text-lg font-bold text-slate-900">H. Gusra Yetri, SH</h3>
                    <p class="text-xs font-semibold text-emerald-700">Ketua DPD APPSI Kab. Banyuasin</p>
                </div>
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-emerald-800">SAMBUTAN KETUA</span>
                    <h2 class="mt-1 text-2xl sm:text-3xl font-extrabold text-slate-900 leading-tight">
                        "Kuatkan Sinergi, Bela Pedagang Kecil, Majukan Pasar Banyuasin"
                    </h2>
                    <p class="mt-4 text-sm sm:text-base text-slate-600 leading-relaxed">
                        Pasar tradisional adalah denyut nadi kehidupan masyarakat Kabupaten Banyuasin. Dari pasar inilah hasil bumi para petani dan tangkapan nelayan mengalir memenuhi kebutuhan pangan keluarga. 
                    </p>
                    <p class="mt-3 text-sm sm:text-base text-slate-600 leading-relaxed">
                        Keberadaan APPSI di Kabupaten Banyuasin hadir untuk memastikan para pedagang memiliki wadah perlindungan yang sah, kemudahan akses ke pembiayaan KUR yang ramah, serta pendampingan menghadapi era digitalisasi perdagangan tanpa meninggalkan kearifan lokal pasar rakyat.
                    </p>
                </div>
            </div>
        </div>

        <!-- Visi & Misi -->
        <div class="grid md:grid-cols-2 gap-8 mb-16" data-aos="fade-up">
            <!-- Visi -->
            <div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-700 text-2xl mb-5">
                    <i class="fa-solid fa-bullseye"></i>
                </div>
                <h3 class="text-xl font-extrabold text-slate-900">Visi Organisasi</h3>
                <p class="mt-3 text-sm text-slate-600 leading-relaxed">
                    {{ $settings['visi'] ?? 'Mewujudkan Pasar Tradisional yang Kuat, Mandiri, dan Berdaya Saing untuk Kesejahteraan Pedagang dan Masyarakat Indonesia.' }}
                </p>
            </div>

            <!-- Misi -->
            <div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-700 text-2xl mb-5">
                    <i class="fa-solid fa-list-check"></i>
                </div>
                <h3 class="text-xl font-extrabold text-slate-900">Misi Organisasi</h3>
                <div class="mt-3 text-sm text-slate-600 leading-relaxed whitespace-pre-line">
                    {{ $settings['misi'] ?? "1. Terhubung dengan pedagang pasar di seluruh Kabupaten Banyuasin.\n2. Advokasi & Perlindungan kepentingan pedagang pasar.\n3. Peningkatan kapasitas pedagang dan digitalisasi pasar.\n4. Kemitraan strategis dengan pemerintah daerah dan perbankan." }}
                </div>
            </div>
        </div>

        <!-- Alamat Sekretariat & Kontak -->
        <div class="bg-slate-50 rounded-3xl border border-slate-200 p-8 sm:p-10" data-aos="fade-up">
            <h3 class="text-xl font-extrabold text-slate-900 mb-6 flex items-center gap-2">
                <i class="fa-solid fa-building-flag text-emerald-700"></i>
                Sekretariat Resmi DPD APPSI Kabupaten Banyuasin
            </h3>
            <div class="grid sm:grid-cols-3 gap-6">
                <div class="flex gap-4">
                    <i class="fa-solid fa-location-dot text-emerald-700 text-xl shrink-0 mt-1"></i>
                    <div>
                        <h4 class="text-xs font-bold uppercase text-slate-500">Alamat Kantor</h4>
                        <p class="mt-1 text-sm font-semibold text-slate-800 leading-relaxed">
                            Jalan Merdeka, Depan Pasar Baru Kelurahan Pangkalan Balai - Kecamatan Banyuasin III, Kab. Banyuasin, Sumatera Selatan
                        </p>
                    </div>
                </div>

                <div class="flex gap-4">
                    <i class="fa-solid fa-phone text-emerald-700 text-xl shrink-0 mt-1"></i>
                    <div>
                        <h4 class="text-xs font-bold uppercase text-slate-500">Hotline / Kontak</h4>
                        <p class="mt-1 text-sm font-semibold text-slate-800">
                            WhatsApp: 0811 618 808<br>
                            Telp: 0811 618 808
                        </p>
                    </div>
                </div>

                <div class="flex gap-4">
                    <i class="fa-solid fa-envelope text-emerald-700 text-xl shrink-0 mt-1"></i>
                    <div>
                        <h4 class="text-xs font-bold uppercase text-slate-500">Email & Web</h4>
                        <p class="mt-1 text-sm font-semibold text-slate-800">
                            appsi.banyuasin@gmail.com<br>
                            https://appsiba.or.id
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
