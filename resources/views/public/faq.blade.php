@extends('layouts.public')

@section('title', 'Tanya Jawab (FAQ) - DPD APPSI Kabupaten Banyuasin')
@section('meta_description', 'Pertanyaan yang sering diajukan seputar keanggotaan pedagang pasar, manfaat KTA, bantuan advokasi hukum, dan fasilitasi permodalan KUR di APPSI Banyuasin.')

@section('content')
<!-- Header Banner -->
<section class="relative bg-gradient-to-br from-emerald-950 via-emerald-900 to-slate-900 py-16 sm:py-20 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
    <div class="relative mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <span class="inline-flex items-center gap-2 rounded-full bg-emerald-500/20 px-4 py-1.5 text-xs font-bold uppercase tracking-wider text-emerald-300 ring-1 ring-emerald-400/30">
            <i class="fa-solid fa-circle-question text-xs"></i>
            PUSAT BANTUAN & INFORMASI
        </span>
        <h1 class="mt-4 text-3xl font-extrabold sm:text-4xl lg:text-5xl">
            Tanya Jawab <span class="text-emerald-400">Seputar APPSI</span>
        </h1>
        <p class="mt-4 mx-auto max-w-2xl text-sm sm:text-base text-emerald-100/90 leading-relaxed">
            Temukan jawaban cepat atas pertanyaan umum seputar pendaftaran pedagang, fungsi Kartu Anggota, pendampingan hukum, dan fasilitasi KUR.
        </p>
    </div>
</section>

<!-- FAQ Accordion Section -->
<section class="py-12 sm:py-18 bg-white" x-data="{ activeAccordion: 1 }">
    <div class="mx-auto w-full max-w-[860px] px-5 sm:px-6 lg:px-8">
        
        <div class="space-y-4">
            
            <!-- Item 1 -->
            <div class="rounded-2xl border border-slate-200/90 bg-white overflow-hidden shadow-sm transition" :class="activeAccordion === 1 ? 'ring-2 ring-emerald-600/30 border-emerald-600/40' : ''">
                <button type="button" @click="activeAccordion = (activeAccordion === 1 ? null : 1)" class="w-full flex items-center justify-between p-5 text-left font-bold text-slate-900 text-sm sm:text-base hover:text-emerald-700 transition">
                    <span class="flex items-center gap-3">
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-800 text-xs font-extrabold">1</span>
                        Apa itu APPSI dan siapa saja yang boleh bergabung?
                    </span>
                    <i class="fa-solid text-xs text-slate-400 transition-transform duration-200" :class="activeAccordion === 1 ? 'fa-chevron-up text-emerald-600' : 'fa-chevron-down'"></i>
                </button>
                <div x-show="activeAccordion === 1" x-cloak class="px-5 pb-5 pt-1 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100">
                    APPSI (Asosiasi Pedagang Pasar Seluruh Indonesia) adalah wadah resmi yang menghimpun dan memperjuangkan hak-hak pedagang pasar tradisional di Indonesia. Di Kabupaten Banyuasin, seluruh pedagang yang memiliki usaha di pasar rakyat (baik pemilik kios, los, pelataran, maupun pedagang kaki lima pasar) berhak mendaftarkan diri menjadi anggota resmi DPD APPSI Kabupaten Banyuasin.
                </div>
            </div>

            <!-- Item 2 -->
            <div class="rounded-2xl border border-slate-200/90 bg-white overflow-hidden shadow-sm transition" :class="activeAccordion === 2 ? 'ring-2 ring-emerald-600/30 border-emerald-600/40' : ''">
                <button type="button" @click="activeAccordion = (activeAccordion === 2 ? null : 2)" class="w-full flex items-center justify-between p-5 text-left font-bold text-slate-900 text-sm sm:text-base hover:text-emerald-700 transition">
                    <span class="flex items-center gap-3">
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-800 text-xs font-extrabold">2</span>
                        Apa keuntungan memiliki Kartu Tanda Anggota (KTA) APPSI?
                    </span>
                    <i class="fa-solid text-xs text-slate-400 transition-transform duration-200" :class="activeAccordion === 2 ? 'fa-chevron-up text-emerald-600' : 'fa-chevron-down'"></i>
                </button>
                <div x-show="activeAccordion === 2" x-cloak class="px-5 pb-5 pt-1 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100">
                    Dengan memiliki KTA resmi yang dilengkapi Nomor Pokok Anggota (NPA) dan QR Code keabsahan, pedagang berhak memperoleh:
                    <ul class="list-disc pl-5 mt-2 space-y-1">
                        <li>Bantuan advokasi dan pendampingan hukum gratis dari DPD APPSI jika terjadi sengketa lapak atau kebijakan sepihak.</li>
                        <li>Surat rekomendasi resmi permohonan pembiayaan KUR Mikro berbunga rendah dari perbankan mitra.</li>
                        <li>Fasilitasi pembuatan QRIS gratis dan pelatihan digitalisasi usaha pasar.</li>
                        <li>Kepastian pendataan resmi dalam program bantuan revitalisasi pasar dari dinas terkait.</li>
                    </ul>
                </div>
            </div>

            <!-- Item 3 -->
            <div class="rounded-2xl border border-slate-200/90 bg-white overflow-hidden shadow-sm transition" :class="activeAccordion === 3 ? 'ring-2 ring-emerald-600/30 border-emerald-600/40' : ''">
                <button type="button" @click="activeAccordion = (activeAccordion === 3 ? null : 3)" class="w-full flex items-center justify-between p-5 text-left font-bold text-slate-900 text-sm sm:text-base hover:text-emerald-700 transition">
                    <span class="flex items-center gap-3">
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-800 text-xs font-extrabold">3</span>
                        Bagaimana cara mendaftar sebagai anggota baru secara online?
                    </span>
                    <i class="fa-solid text-xs text-slate-400 transition-transform duration-200" :class="activeAccordion === 3 ? 'fa-chevron-up text-emerald-600' : 'fa-chevron-down'"></i>
                </button>
                <div x-show="activeAccordion === 3" x-cloak class="px-5 pb-5 pt-1 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100">
                    Pendaftaran sangat mudah dan dapat dilakukan langsung melalui smartphone:
                    <ol class="list-decimal pl-5 mt-2 space-y-1">
                        <li>Buka menu <strong>Daftar Keanggotaan</strong> di website ini.</li>
                        <li>Isi data diri, NIK, nama toko/lapak, jenis komoditas, dan lokasi pasar tempat Anda berjualan.</li>
                        <li>Unggah foto KTP dan foto kios/lapak Anda (jika ada).</li>
                        <li>Kirim formulir. Tim verifikator DPD APPSI akan meninjau berkas Anda dalam 1x24 jam kerja dan menerbitkan KTA resmi Anda.</li>
                    </ol>
                </div>
            </div>

            <!-- Item 4 -->
            <div class="rounded-2xl border border-slate-200/90 bg-white overflow-hidden shadow-sm transition" :class="activeAccordion === 4 ? 'ring-2 ring-emerald-600/30 border-emerald-600/40' : ''">
                <button type="button" @click="activeAccordion = (activeAccordion === 4 ? null : 4)" class="w-full flex items-center justify-between p-5 text-left font-bold text-slate-900 text-sm sm:text-base hover:text-emerald-700 transition">
                    <span class="flex items-center gap-3">
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-800 text-xs font-extrabold">4</span>
                        Bagaimana jika pedagang menghadapi sengketa sewa lapak atau pungli?
                    </span>
                    <i class="fa-solid text-xs text-slate-400 transition-transform duration-200" :class="activeAccordion === 4 ? 'fa-chevron-up text-emerald-600' : 'fa-chevron-down'"></i>
                </button>
                <div x-show="activeAccordion === 4" x-cloak class="px-5 pb-5 pt-1 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100">
                    Pedagang dapat segera melapor ke Komisariat Pasar setempat atau mengisi formulir di menu <strong>Kontak & Aspirasi</strong> pada website ini, atau mengirim pesan langsung ke WhatsApp Hotline Pengurus (0811 618 808). Bidang Advokasi & Hukum DPD APPSI Banyuasin akan segera turun ke lokasi untuk melakukan mediasi dengan pihak pengelola pasar atau dinas terkait demi melindungi kepastian usaha pedagang.
                </div>
            </div>

            <!-- Item 5 -->
            <div class="rounded-2xl border border-slate-200/90 bg-white overflow-hidden shadow-sm transition" :class="activeAccordion === 5 ? 'ring-2 ring-emerald-600/30 border-emerald-600/40' : ''">
                <button type="button" @click="activeAccordion = (activeAccordion === 5 ? null : 5)" class="w-full flex items-center justify-between p-5 text-left font-bold text-slate-900 text-sm sm:text-base hover:text-emerald-700 transition">
                    <span class="flex items-center gap-3">
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-800 text-xs font-extrabold">5</span>
                        Bagaimana cara mengecek keabsahan surat resmi yang dikeluarkan APPSI?
                    </span>
                    <i class="fa-solid text-xs text-slate-400 transition-transform duration-200" :class="activeAccordion === 5 ? 'fa-chevron-up text-emerald-600' : 'fa-chevron-down'"></i>
                </button>
                <div x-show="activeAccordion === 5" x-cloak class="px-5 pb-5 pt-1 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100">
                    Setiap surat resmi yang diterbitkan oleh DPD APPSI Kabupaten Banyuasin (Surat Tugas, Undangan, Rekomendasi, Audiensi) dilengkapi dengan QR Code Keabsahan unik. Anda dapat memindai QR Code tersebut menggunakan kamera HP atau mengetikkan Nomor Surat pada menu <strong>Cek Keabsahan Surat</strong> di website ini untuk memverifikasi tanda tangan digital Ketua dan Sekretaris.
                </div>
            </div>

        </div>

        <!-- Still have questions? -->
        <div class="mt-12 rounded-3xl bg-slate-50 border border-slate-200/80 p-8 text-center" data-aos="fade-up">
            <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 text-2xl flex items-center justify-center mx-auto mb-3">
                <i class="fa-solid fa-comments"></i>
            </div>
            <h3 class="text-base font-extrabold text-slate-900">Masih Memiliki Pertanyaan Lain?</h3>
            <p class="mt-1.5 text-xs sm:text-sm text-slate-500 max-w-md mx-auto">
                Pengurus DPD APPSI Kabupaten Banyuasin siap membantu dan melayani kebutuhan seluruh pedagang pasar.
            </p>
            <div class="mt-5 flex flex-wrap items-center justify-center gap-3">
                <a href="{{ route('contact.public') }}" class="inline-flex items-center gap-2 rounded-xl bg-emerald-700 px-5 py-2.5 text-xs sm:text-sm font-bold text-white hover:bg-emerald-800 transition shadow-sm">
                    <i class="fa-solid fa-envelope"></i>
                    Kirim Pesan ke Pengurus
                </a>
                <a href="https://wa.me/62811618808" target="_blank" class="inline-flex items-center gap-2 rounded-xl border border-emerald-300 bg-white px-5 py-2.5 text-xs sm:text-sm font-bold text-emerald-800 hover:bg-emerald-50 transition">
                    <i class="fa-brands fa-whatsapp text-emerald-600"></i>
                    Chat WhatsApp
                </a>
            </div>
        </div>

    </div>
</section>
@endsection
