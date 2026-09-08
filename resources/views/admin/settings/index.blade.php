@extends('layouts.admin')

@section('title', 'Pengaturan Website & Profil DPD')
@section('page_title', 'Pengaturan Website & Profil DPD')

@section('content')

<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-800 text-xs font-bold mb-1 border border-emerald-200">
            <i class="fa-solid fa-sliders text-xs"></i>
            <span>PUSAT KENDALI KONTEN WEBSITE</span>
        </div>
        <h1 class="text-2xl font-extrabold text-slate-900">Pengaturan Website & Profil DPD APPSI</h1>
        <p class="text-xs text-slate-500 mt-0.5">Kelola identitas resmi, aset logo/favicon, teks beranda, SEO, kontak, dan visi misi secara real-time</p>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('home') }}" target="_blank" class="px-4 py-2.5 rounded-xl text-xs font-bold text-emerald-800 bg-emerald-50 border border-emerald-300 hover:bg-emerald-100 transition flex items-center gap-1.5 shadow-2xs">
            <i class="fa-solid fa-arrow-up-right-from-square"></i> Pratinjau Website Publik
        </a>
    </div>
</div>

<div class="w-full bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 shadow-sm">
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <!-- SECTION 1: IDENTITAS & MEDIA BRANDING -->
        <div>
            <h2 class="text-sm font-black uppercase tracking-wider text-emerald-900 border-b-2 border-emerald-600 pb-2 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-palette text-emerald-700"></i>
                1. Identitas Brand, Logo, Favicon & Media Sosial
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-4 rounded-xl bg-slate-50/80 border border-slate-200 mb-6">
                <!-- 1. Logo Organisasi -->
                <div class="flex flex-col items-center text-center p-4 bg-white rounded-xl border border-slate-200 shadow-2xs">
                    <span class="text-xs font-bold uppercase text-slate-700 mb-2">Logo Resmi APPSI</span>
                    <div class="h-20 w-20 rounded-xl bg-slate-50 p-2 border border-slate-200 flex items-center justify-center mb-3 shadow-inner">
                        <img src="{{ $webSetting['logo_url'] ?? asset('assets/images/appsi-logo.png') }}" alt="Logo APPSI" class="h-full w-full object-contain">
                    </div>
                    <label class="w-full cursor-pointer">
                        <input type="file" name="logo" accept="image/*" class="text-xs text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-100 file:text-emerald-800 hover:file:bg-emerald-200 cursor-pointer">
                    </label>
                    <p class="text-[10px] text-slate-400 mt-1">PNG, WebP, JPG, SVG (Maks. 4MB)</p>
                </div>

                <!-- 2. Favicon Browser -->
                <div class="flex flex-col items-center text-center p-4 bg-white rounded-xl border border-slate-200 shadow-2xs">
                    <span class="text-xs font-bold uppercase text-slate-700 mb-2">Favicon Tab Browser</span>
                    <div class="h-20 w-20 rounded-xl bg-slate-50 p-2 border border-slate-200 flex items-center justify-center mb-3 shadow-inner">
                        <img src="{{ $webSetting['favicon_url'] ?? asset('assets/images/appsi-logo.png') }}" alt="Favicon" class="h-10 w-10 object-contain">
                    </div>
                    <label class="w-full cursor-pointer">
                        <input type="file" name="favicon" accept=".ico,.png,.webp,.svg" class="text-xs text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-100 file:text-emerald-800 hover:file:bg-emerald-200 cursor-pointer">
                    </label>
                    <p class="text-[10px] text-slate-400 mt-1">ICO, PNG, WebP (Ikon di tab browser)</p>
                </div>

                <!-- 3. Open Graph (OG) Image -->
                <div class="flex flex-col items-center text-center p-4 bg-white rounded-xl border border-slate-200 shadow-2xs">
                    <span class="text-xs font-bold uppercase text-slate-700 mb-2">Pratinjau Medsos (OG Image)</span>
                    <div class="h-20 w-32 rounded-xl bg-slate-50 p-1 border border-slate-200 flex items-center justify-center mb-3 shadow-inner overflow-hidden">
                        <img src="{{ $webSetting['og_image_url'] ?? asset('assets/images/appsi-logo.png') }}" alt="OG Preview" class="h-full w-full object-contain">
                    </div>
                    <label class="w-full cursor-pointer">
                        <input type="file" name="og_image" accept="image/*" class="text-xs text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-100 file:text-emerald-800 hover:file:bg-emerald-200 cursor-pointer">
                    </label>
                    <p class="text-[10px] text-slate-400 mt-1">Muncul saat link dibagikan di WhatsApp/FB</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Organisasi Lengkap *</label>
                    <input type="text" name="nama_organisasi" required value="{{ old('nama_organisasi', $settings['nama_organisasi'] ?? 'Dewan Pimpinan Daerah (DPD) Asosiasi Pedagang Pasar Seluruh Indonesia (APPSI) Kabupaten Banyuasin') }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm font-semibold focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Singkatan / Sebutan DPD *</label>
                    <input type="text" name="singkatan" required value="{{ old('singkatan', $settings['singkatan'] ?? 'DPD APPSI KABUPATEN BANYUASIN') }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm font-bold focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Periode Kepengurusan</label>
                    <input type="text" name="periode" value="{{ old('periode', $settings['periode'] ?? '2026 - 2031') }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm font-semibold focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none" placeholder="2026 - 2031">
                </div>
            </div>
        </div>

        <!-- SECTION 2: KONTAK & SEKRETARIAT RESMI -->
        <div class="pt-4">
            <h2 class="text-sm font-black uppercase tracking-wider text-emerald-900 border-b-2 border-emerald-600 pb-2 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-map-location-dot text-emerald-700"></i>
                2. Kontak Resmi & Alamat Kantor Sekretariat
            </h2>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Alamat Kantor Sekretariat Resmi *</label>
                <textarea name="alamat" rows="2" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2 text-sm text-slate-800 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none">{{ old('alamat', $settings['alamat'] ?? 'Jalan Merdeka, Kelurahan Pangkalan Balai - Kecamatan Banyuasin III, Kabupaten Banyuasin, Sumatera Selatan (30914)') }}</textarea>
                <p class="text-[11px] text-slate-400 mt-1">Tampil di footer website publik, halaman kontak, dan KOP persuratan dinas.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">No. Telepon Kantor *</label>
                    <input type="text" name="telepon" required value="{{ old('telepon', $settings['telepon'] ?? '0811 618 808') }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm font-mono text-slate-900 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">WhatsApp Hotline Resmi</label>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp', $settings['whatsapp'] ?? '62811618808') }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm font-mono text-slate-900 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none" placeholder="62811618808">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Email Resmi DPD</label>
                    <input type="email" name="email" value="{{ old('email', $settings['email'] ?? 'appsi.banyuasin@gmail.com') }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none" placeholder="appsi.banyuasin@gmail.com">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">URL Website Resmi</label>
                    <input type="text" name="website" value="{{ old('website', $settings['website'] ?? 'https://appsiba.or.id') }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none" placeholder="https://appsiba.or.id">
                </div>
            </div>
        </div>

        <!-- SECTION 3: SEO & METADATA MESIN PENCARI (GOOGLE) -->
        <div class="pt-4">
            <h2 class="text-sm font-black uppercase tracking-wider text-emerald-900 border-b-2 border-emerald-600 pb-2 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-magnifying-glass-chart text-emerald-700"></i>
                3. Optimasi SEO & Mesin Pencari Google
            </h2>

            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Judul Default Website (Meta Title SEO)</label>
                    <input type="text" name="seo_title" value="{{ old('seo_title', $settings['seo_title'] ?? 'DPD APPSI Kabupaten Banyuasin - Asosiasi Pedagang Pasar Seluruh Indonesia') }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm font-medium text-slate-900 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none" placeholder="Judul yang tampil pada tab browser & hasil pencarian Google">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Deskripsi Meta Google (Meta Description SEO)</label>
                    <textarea name="seo_description" rows="2" class="w-full rounded-xl border border-slate-300 px-3.5 py-2 text-sm text-slate-800 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none" placeholder="Ringkasan portal yang terbaca oleh mesin pencari Google">{{ old('seo_description', $settings['seo_description'] ?? 'Portal Resmi DPD Asosiasi Pedagang Pasar Seluruh Indonesia (APPSI) Kabupaten Banyuasin. Informasi berita pasar, direktori pedagang binaan, pendaftaran keanggotaan online, dan verifikasi surat digital.') }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Kata Kunci Pencarian (Meta Keywords SEO)</label>
                    <input type="text" name="seo_keywords" value="{{ old('seo_keywords', $settings['seo_keywords'] ?? 'appsi banyuasin, pasar banyuasin, pedagang banyuasin, asosiasi pedagang pasar seluruh indonesia, pasar pangkalan balai, pasar betung') }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none" placeholder="Pisahkan dengan koma">
                </div>
            </div>
        </div>

        <!-- SECTION 4: KUSTOMISASI TEKS & FOTO BERANDA (HOME) -->
        <div class="pt-4">
            <h2 class="text-sm font-black uppercase tracking-wider text-emerald-900 border-b-2 border-emerald-600 pb-2 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-house text-emerald-700"></i>
                4. Kustomisasi Teks & Foto Tampilan Beranda (Home)
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4 rounded-xl bg-slate-50/80 border border-slate-200 mb-6">
                <!-- Foto Cutout Ketua Hero Beranda -->
                <div class="p-4 bg-white rounded-xl border border-slate-200 shadow-2xs flex flex-col items-center text-center">
                    <span class="text-xs font-bold uppercase text-slate-700 mb-2">Foto Ketua Hero Beranda (Transparan Cutout)</span>
                    <div class="h-36 w-32 rounded-xl bg-gradient-to-tr from-emerald-100 to-white p-2 border border-slate-200 flex items-end justify-center mb-3 shadow-inner overflow-hidden">
                        <img src="{{ $webSetting['hero_image_url'] ?? asset('assets/images/ketua-hero.webp') }}" alt="Foto Hero Ketua" class="h-full w-auto object-contain">
                    </div>
                    <label class="w-full cursor-pointer">
                        <input type="file" name="hero_image" accept="image/*" class="text-xs text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-100 file:text-emerald-800 hover:file:bg-emerald-200 cursor-pointer">
                    </label>
                    <p class="text-[10px] text-slate-400 mt-1">Disarankan foto jas APPSI transparan PNG/WebP</p>
                </div>

                <!-- Foto Ketua Semangat (Bagian Keanggotaan) -->
                <div class="p-4 bg-white rounded-xl border border-slate-200 shadow-2xs flex flex-col items-center text-center">
                    <span class="text-xs font-bold uppercase text-slate-700 mb-2">Foto Ketua Semangat (Section Keanggotaan)</span>
                    <div class="h-36 w-32 rounded-xl bg-gradient-to-tr from-emerald-100 to-white p-2 border border-slate-200 flex items-end justify-center mb-3 shadow-inner overflow-hidden">
                        <img src="{{ $webSetting['foto_ketua_semangat_url'] ?? asset('assets/images/ketua-semangat.webp') }}" alt="Foto Ketua Semangat" class="h-full w-auto object-contain">
                    </div>
                    <label class="w-full cursor-pointer">
                        <input type="file" name="foto_ketua_semangat" accept="image/*" class="text-xs text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-100 file:text-emerald-800 hover:file:bg-emerald-200 cursor-pointer">
                    </label>
                    <p class="text-[10px] text-slate-400 mt-1">Foto pose semangat ketua di bagian ajakan KTA</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Teks Badge Atas Hero</label>
                    <input type="text" name="hero_badge" value="{{ old('hero_badge', $settings['hero_badge'] ?? 'DPD APPSI KABUPATEN BANYUASIN') }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm font-semibold text-slate-900 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Tagline Melayang Hero</label>
                    <input type="text" name="hero_tagline" value="{{ old('hero_tagline', $settings['hero_tagline'] ?? 'Kuatkan Suara Pedagang') }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm font-semibold text-slate-900 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Judul Utama Hero (Headline Beranda)</label>
                    <input type="text" name="hero_title" value="{{ old('hero_title', $settings['hero_title'] ?? 'Bergabung dan jadilah bagian dari Asosiasi Pedagang Pasar Seluruh Indonesia sekarang!') }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm font-bold text-slate-900 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Deskripsi Kalimat Hero Beranda</label>
                    <textarea name="hero_subtitle" rows="2" class="w-full rounded-xl border border-slate-300 px-3.5 py-2 text-sm text-slate-800 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none">{{ old('hero_subtitle', $settings['hero_subtitle'] ?? 'Bersama memajukan pedagang pasar tradisional demi masa depan mandiri, kuat berdaya saing untuk kesejahteraan pedagang dan masyarakat Kabupaten Banyuasin.') }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Judul Bagian Bersatu Keanggotaan</label>
                    <input type="text" name="home_bersatu_title" value="{{ old('home_bersatu_title', $settings['home_bersatu_title'] ?? 'Bersatu, Berdaya, Berkarya untuk Pasar Banyuasin') }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm font-bold text-slate-900 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Deskripsi Bagian Bersatu Keanggotaan</label>
                    <textarea name="home_bersatu_desc" rows="2" class="w-full rounded-xl border border-slate-300 px-3.5 py-2 text-sm text-slate-800 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none">{{ old('home_bersatu_desc', $settings['home_bersatu_desc'] ?? 'DPD APPSI hadir mengayomi para pedagang pasar tradisional di seluruh kecamatan Kabupaten Banyuasin melalui penguatan Komisariat Pasar, advokasi harga, perlindungan legalitas usaha, dan fasilitasi modal kerja tanpa jeratan rentenir.') }}</textarea>
                </div>
            </div>
        </div>

        <!-- SECTION 5: PIMPINAN, PROFIL & VISI MISI -->
        <div class="pt-4">
            <h2 class="text-sm font-black uppercase tracking-wider text-emerald-900 border-b-2 border-emerald-600 pb-2 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-users text-emerald-700"></i>
                5. Jajaran Pimpinan Resmi, Sambutan & Visi Misi
            </h2>

            <!-- Foto Profil Resmi Ketua untuk Tentang Kami -->
            <div class="p-4 rounded-xl bg-slate-50/80 border border-slate-200 mb-6 flex flex-col sm:flex-row items-center gap-6">
                <div class="h-24 w-20 rounded-xl bg-white p-1 border border-slate-300 shadow-sm flex items-center justify-center overflow-hidden shrink-0">
                    <img src="{{ $webSetting['foto_ketua_profil_url'] ?? asset('assets/images/ketua-appsi-banyuasin.webp') }}" alt="Foto Ketua Profil" class="h-full w-full object-cover">
                </div>
                <div class="flex-1 text-center sm:text-left">
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Foto Resmi Ketua DPD (Halaman Tentang Kami)</label>
                    <input type="file" name="foto_ketua_profil" accept="image/*" class="text-xs text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-100 file:text-emerald-800 hover:file:bg-emerald-200 cursor-pointer">
                    <p class="text-[10px] text-slate-400 mt-1">Foto resmi setengah badan untuk kartu sambutan di halaman /tentang-kami.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Ketua DPD APPSI *</label>
                    <input type="text" name="nama_ketua" required value="{{ old('nama_ketua', $settings['nama_ketua'] ?? 'H. Gusra Yetri, SH') }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm font-bold text-slate-900 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none">
                    <input type="hidden" name="jabatan_ketua" value="{{ $settings['jabatan_ketua'] ?? 'Ketua DPD APPSI Kabupaten Banyuasin' }}">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Sekretaris DPD APPSI *</label>
                    <input type="text" name="nama_sekretaris" required value="{{ old('nama_sekretaris', $settings['nama_sekretaris'] ?? 'H. Syamsir Sikumbang, S.Ag, M.Si.') }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm font-bold text-slate-900 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none">
                    <input type="hidden" name="jabatan_sekretaris" value="{{ $settings['jabatan_sekretaris'] ?? 'Sekretaris DPD APPSI Kabupaten Banyuasin' }}">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Bendahara DPD APPSI</label>
                    <input type="text" name="nama_bendahara" value="{{ old('nama_bendahara', $settings['nama_bendahara'] ?? 'H. Rahman, S.Kom') }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm font-bold text-slate-900 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none">
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Sambutan Singkat Ketua DPD</label>
                <textarea name="sambutan_ketua" rows="3" class="w-full rounded-xl border border-slate-300 px-3.5 py-2 text-sm text-slate-800 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none">{{ old('sambutan_ketua', $settings['sambutan_ketua'] ?? '') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Visi Organisasi</label>
                    <textarea name="visi" rows="3" class="w-full rounded-xl border border-slate-300 px-3.5 py-2 text-sm text-slate-800 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none">{{ old('visi', $settings['visi'] ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Misi Organisasi</label>
                    <textarea name="misi" rows="3" class="w-full rounded-xl border border-slate-300 px-3.5 py-2 text-sm text-slate-800 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none">{{ old('misi', $settings['misi'] ?? '') }}</textarea>
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Tentang Organisasi (Deskripsi Profil Lengkap)</label>
                <textarea name="tentang_organisasi" rows="3" class="w-full rounded-xl border border-slate-300 px-3.5 py-2 text-sm text-slate-800 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 focus:outline-none">{{ old('tentang_organisasi', $settings['tentang_organisasi'] ?? '') }}</textarea>
            </div>
        </div>

        <!-- SECTION 6: VISIBILITAS DIREKTORI ANGGOTA -->
        <div class="pt-4">
            <h2 class="text-sm font-black uppercase tracking-wider text-emerald-900 border-b-2 border-emerald-600 pb-2 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-eye text-emerald-700"></i>
                6. Visibilitas Direktori Anggota Pedagang di Website Publik
            </h2>
            <p class="text-xs text-slate-500 mb-4">
                Tentukan apakah daftar nama pedagang/anggota binaan dapat dicari dan dilihat publik di halaman <code>/keanggotaan</code>. Layanan pendaftaran KTA online & cek validasi KTA tetap aktif.
            </p>

            <div class="grid sm:grid-cols-2 gap-4">
                <label class="relative flex cursor-pointer rounded-xl border p-4 shadow-2xs focus:outline-none transition {{ old('tampilkan_daftar_anggota', $settings['tampilkan_daftar_anggota'] ?? '1') == '1' ? 'border-emerald-600 bg-emerald-50/60 ring-2 ring-emerald-600/30' : 'border-slate-200 bg-white' }}">
                    <input type="radio" name="tampilkan_daftar_anggota" value="1" class="sr-only" {{ old('tampilkan_daftar_anggota', $settings['tampilkan_daftar_anggota'] ?? '1') == '1' ? 'checked' : '' }}>
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center shrink-0 text-base">
                            <i class="fa-solid fa-users-viewfinder"></i>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-slate-900">Tampilkan List Pedagang (Publik)</span>
                            <span class="block text-[11px] text-slate-500 mt-0.5">Direktori pedagang aktif, toko, dan komoditas pasar dapat diakses publik.</span>
                        </div>
                    </div>
                </label>

                <label class="relative flex cursor-pointer rounded-xl border p-4 shadow-2xs focus:outline-none transition {{ old('tampilkan_daftar_anggota', $settings['tampilkan_daftar_anggota'] ?? '1') == '0' ? 'border-amber-600 bg-amber-50/60 ring-2 ring-amber-600/30' : 'border-slate-200 bg-white' }}">
                    <input type="radio" name="tampilkan_daftar_anggota" value="0" class="sr-only" {{ old('tampilkan_daftar_anggota', $settings['tampilkan_daftar_anggota'] ?? '1') == '0' ? 'checked' : '' }}>
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center shrink-0 text-base">
                            <i class="fa-solid fa-user-shield"></i>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-slate-900">Sembunyikan List Pedagang (Privat)</span>
                            <span class="block text-[11px] text-slate-500 mt-0.5">Daftar pedagang diproteksi. Layanan Daftar KTA & Cek Status KTA tetap aktif normal.</span>
                        </div>
                    </div>
                </label>
            </div>
        </div>

        <!-- TOMBOL SIMPAN -->
        <div class="pt-6 border-t border-slate-200 flex items-center justify-end gap-3">
            <button type="submit" class="px-8 py-3 rounded-xl bg-emerald-700 text-white text-xs font-bold hover:bg-emerald-800 transition shadow-md flex items-center gap-2">
                <i class="fa-solid fa-cloud-arrow-up text-sm"></i>
                <span>Simpan Seluruh Pengaturan Website</span>
            </button>
        </div>

    </form>
</div>

@endsection
