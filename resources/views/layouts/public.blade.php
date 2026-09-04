<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DPD APPSI Kabupaten Banyuasin') - Asosiasi Pedagang Pasar Seluruh Indonesia</title>
    
    <!-- Favicon Resmi APPSI -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/appsi-logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/appsi-logo.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Open Graph / Social Meta -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'DPD APPSI Kabupaten Banyuasin') - Asosiasi Pedagang Pasar Seluruh Indonesia">
    <meta property="og:description" content="@yield('meta_description', 'Portal Resmi DPD Asosiasi Pedagang Pasar Seluruh Indonesia (APPSI) Kabupaten Banyuasin. Informasi berita pasar, direktori pedagang binaan, pendaftaran keanggotaan online, dan verifikasi surat digital.')">
    <meta property="og:image" content="{{ asset('assets/images/appsi-logo.png') }}">
    <meta property="og:site_name" content="APPSI Kabupaten Banyuasin">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'DPD APPSI Kabupaten Banyuasin')">
    <meta name="twitter:description" content="@yield('meta_description', 'Portal Resmi DPD Asosiasi Pedagang Pasar Seluruh Indonesia Kabupaten Banyuasin.')">
    <meta name="twitter:image" content="{{ asset('assets/images/appsi-logo.png') }}">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- AOS Animation CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    
    <!-- Tailwind CSS (Play CDN with APPSI emerald theme) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        emerald: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            200: '#a7f3d0',
                            300: '#6ee7b7',
                            400: '#34d399',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                            950: '#022c22',
                        },
                        appsi: {
                            green: '#007042',
                            dark: '#0B1B15',
                            accent: '#10B981',
                            gold: '#F59E0B',
                            light: '#F8FAFC',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        [x-cloak] { display: none !important; }
        html, body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden !important;
            max-width: 100vw;
            background-color: #ffffff;
            color: #0f172a;
        }
        .hero-dot-pattern {
            background-image: radial-gradient(#10b981 1.5px, transparent 1.5px);
            background-size: 16px 16px;
        }
        [data-aos] {
            transition-duration: 350ms !important;
            transition-timing-function: ease-out !important;
        }
    </style>

    @stack('styles')
</head>
<body class="min-h-screen flex flex-col antialiased selection:bg-emerald-100 selection:text-emerald-800" x-data="{ mobileMenu: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 250)">

    <!-- Sticky Header Navbar (Adopsi appsi.id) -->
    <header class="sticky top-0 z-50 border-b border-slate-100 bg-white/95 backdrop-blur shadow-[0_4px_18px_rgba(15,23,42,0.04)]">
        <div class="mx-auto flex h-[72px] w-full max-w-[1180px] items-center justify-between gap-4 px-5 sm:px-6 lg:px-8">
            
            <!-- Logo & Brand Name -->
            <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-3 group">
                <div class="h-11 w-11 rounded-full overflow-hidden flex items-center justify-center p-0.5 bg-white border border-emerald-100 shadow-sm transition group-hover:scale-105">
                    <img src="{{ asset('assets/images/appsi-logo.png') }}" alt="Logo APPSI" class="h-full w-full object-contain">
                </div>
                <div class="flex flex-col">
                    <div class="flex items-center gap-1.5">
                        <span class="text-2xl font-extrabold tracking-tight text-emerald-800">APPSI</span>
                        <span class="text-xs font-bold px-1.5 py-0.5 rounded bg-emerald-50 text-emerald-700 border border-emerald-200">DPD</span>
                    </div>
                    <span class="text-[10px] font-bold text-slate-500 tracking-wider uppercase -mt-0.5">Kab. Banyuasin</span>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden items-center gap-5 xl:gap-6 lg:flex">
                <a href="{{ route('home') }}" class="relative py-2 text-sm font-semibold transition {{ request()->routeIs('home') ? 'text-emerald-800 font-bold' : 'text-slate-700 hover:text-emerald-700' }}">
                    Beranda
                    @if(request()->routeIs('home'))
                        <span class="absolute inset-x-1 -bottom-1 h-0.5 rounded-full bg-emerald-700"></span>
                    @endif
                </a>
                <a href="{{ route('programs.public') }}" class="relative py-2 text-sm font-semibold transition {{ request()->routeIs('programs.*') ? 'text-emerald-800 font-bold' : 'text-slate-700 hover:text-emerald-700' }}">
                    Program
                    @if(request()->routeIs('programs.*'))
                        <span class="absolute inset-x-1 -bottom-1 h-0.5 rounded-full bg-emerald-700"></span>
                    @endif
                </a>
                <a href="{{ route('members.public') }}" class="relative py-2 text-sm font-semibold transition {{ request()->routeIs('members.*') ? 'text-emerald-800 font-bold' : 'text-slate-700 hover:text-emerald-700' }}">
                    Keanggotaan
                    @if(request()->routeIs('members.*'))
                        <span class="absolute inset-x-1 -bottom-1 h-0.5 rounded-full bg-emerald-700"></span>
                    @endif
                </a>
                <a href="{{ route('news.index') }}" class="relative py-2 text-sm font-semibold transition {{ request()->routeIs('news.*') ? 'text-emerald-800 font-bold' : 'text-slate-700 hover:text-emerald-700' }}">
                    Berita
                    @if(request()->routeIs('news.*'))
                        <span class="absolute inset-x-1 -bottom-1 h-0.5 rounded-full bg-emerald-700"></span>
                    @endif
                </a>
                <a href="{{ route('gallery.public') }}" class="relative py-2 text-sm font-semibold transition {{ request()->routeIs('gallery.public') ? 'text-emerald-800 font-bold' : 'text-slate-700 hover:text-emerald-700' }}">
                    Galeri
                    @if(request()->routeIs('gallery.public'))
                        <span class="absolute inset-x-1 -bottom-1 h-0.5 rounded-full bg-emerald-700"></span>
                    @endif
                </a>
                <a href="{{ route('downloads.public') }}" class="relative py-2 text-sm font-semibold transition {{ request()->routeIs('downloads.*') ? 'text-emerald-800 font-bold' : 'text-slate-700 hover:text-emerald-700' }}">
                    Unduhan
                    @if(request()->routeIs('downloads.*'))
                        <span class="absolute inset-x-1 -bottom-1 h-0.5 rounded-full bg-emerald-700"></span>
                    @endif
                </a>
                <a href="{{ route('about.public') }}" class="relative py-2 text-sm font-semibold transition {{ request()->routeIs('about.public') || request()->routeIs('organization.public') ? 'text-emerald-800 font-bold' : 'text-slate-700 hover:text-emerald-700' }}">
                    Tentang Kami
                    @if(request()->routeIs('about.public') || request()->routeIs('organization.public'))
                        <span class="absolute inset-x-1 -bottom-1 h-0.5 rounded-full bg-emerald-700"></span>
                    @endif
                </a>
                <a href="{{ route('contact.public') }}" class="relative py-2 text-sm font-semibold transition {{ request()->routeIs('contact.*') ? 'text-emerald-800 font-bold' : 'text-slate-700 hover:text-emerald-700' }}">
                    Kontak
                    @if(request()->routeIs('contact.*'))
                        <span class="absolute inset-x-1 -bottom-1 h-0.5 rounded-full bg-emerald-700"></span>
                    @endif
                </a>
            </nav>

            <!-- CTA Buttons Desktop -->
            <div class="hidden items-center gap-2.5 lg:flex">
                <a href="{{ route('members.register') }}" class="inline-flex items-center justify-center gap-1.5 rounded-xl font-semibold transition duration-200 border border-emerald-200 bg-white text-emerald-800 hover:border-emerald-500 hover:bg-emerald-50 h-10 px-3.5 text-xs tracking-wide shadow-sm">
                    <i class="fa-solid fa-user-plus text-xs text-emerald-600"></i>
                    Daftar KTA
                </a>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center justify-center gap-2 rounded-xl font-semibold transition duration-200 bg-emerald-700 text-white shadow-[0_10px_24px_rgba(21,128,61,0.18)] hover:bg-emerald-800 h-10 px-4 text-xs tracking-wide">
                        <i class="fa-solid fa-gauge-high text-xs"></i>
                        MIS Admin
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 rounded-xl font-semibold transition duration-200 bg-emerald-700 text-white shadow-[0_10px_24px_rgba(21,128,61,0.18)] hover:bg-emerald-800 h-10 px-4 text-xs tracking-wide">
                        <i class="fa-solid fa-lock text-xs"></i>
                        Login
                    </a>
                @endauth
            </div>

            <!-- Mobile Hamburger Button -->
            <button type="button" @click="mobileMenu = !mobileMenu" class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 text-slate-700 lg:hidden hover:bg-slate-50 transition" aria-label="Menu">
                <i class="fa-solid text-lg" :class="mobileMenu ? 'fa-xmark' : 'fa-bars'"></i>
            </button>
        </div>

        <!-- Mobile Navigation Dropdown -->
        <div x-show="mobileMenu" x-cloak class="border-t border-slate-100 bg-white px-5 py-4 lg:hidden shadow-xl" @click.away="mobileMenu = false">
            <div class="flex flex-col gap-2.5">
                <a href="{{ route('home') }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('home') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fa-solid fa-house w-6 text-emerald-700"></i> Beranda
                </a>
                <a href="{{ route('programs.public') }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('programs.*') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fa-solid fa-layer-group w-6 text-emerald-700"></i> 5 Pilar Program Kerja
                </a>
                <a href="{{ route('members.public') }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('members.public') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fa-solid fa-store w-6 text-emerald-700"></i> Direktori Pedagang
                </a>
                <a href="{{ route('members.check') }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('members.check') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fa-solid fa-id-card-clip w-6 text-emerald-700"></i> Cek Status KTA Pedagang
                </a>
                <a href="{{ route('news.index') }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('news.*') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fa-solid fa-newspaper w-6 text-emerald-700"></i> Berita & Kabar Pasar
                </a>
                <a href="{{ route('gallery.public') }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('gallery.public') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fa-solid fa-images w-6 text-emerald-700"></i> Galeri Dokumentasi
                </a>
                <a href="{{ route('downloads.public') }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('downloads.*') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fa-solid fa-file-arrow-down w-6 text-emerald-700"></i> Pusat Unduhan
                </a>
                <a href="{{ route('about.public') }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('about.public') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fa-solid fa-circle-info w-6 text-emerald-700"></i> Tentang Kami
                </a>
                <a href="{{ route('organization.public') }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('organization.public') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fa-solid fa-sitemap w-6 text-emerald-700"></i> Struktur Organisasi
                </a>
                <a href="{{ route('contact.public') }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('contact.*') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fa-solid fa-headset w-6 text-emerald-700"></i> Kontak & Aspirasi
                </a>
                <a href="{{ route('faq.public') }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('faq.*') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fa-solid fa-circle-question w-6 text-emerald-700"></i> Tanya Jawab (FAQ)
                </a>

                <div class="pt-3 border-t border-slate-100 flex flex-col gap-2">
                    <a href="{{ route('members.register') }}" class="flex items-center justify-center gap-2 rounded-xl py-2.5 text-sm font-semibold border border-emerald-200 bg-emerald-50 text-emerald-800">
                        <i class="fa-solid fa-user-plus text-xs"></i>
                        Daftar Keanggotaan KTA
                    </a>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-center gap-2 rounded-xl py-2.5 text-sm font-semibold bg-emerald-700 text-white shadow">
                            <i class="fa-solid fa-gauge-high text-xs"></i>
                            Dashboard MIS Admin
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 rounded-xl py-2.5 text-sm font-semibold bg-emerald-700 text-white shadow">
                            <i class="fa-solid fa-lock text-xs"></i>
                            Login Petugas MIS
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Main Body Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer Modern & Rapi APPSI Banyuasin -->
    <footer class="bg-gradient-to-b from-[#063327] via-[#04281f] to-[#021812] text-slate-300 relative border-t-2 border-emerald-600/50" id="kontak">
        
        <!-- Top Contact Highlight Strip -->
        <div class="border-b border-emerald-900/60 bg-black/20">
            <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8 py-6 grid gap-4 sm:grid-cols-3">
                <div class="flex items-center gap-3.5 p-3 rounded-xl bg-white/[0.04] border border-white/[0.08]">
                    <div class="h-10 w-10 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-phone-volume text-base"></i>
                    </div>
                    <div>
                        <p class="text-[11px] font-semibold text-emerald-300 uppercase tracking-wider">Hotline Aspirasi</p>
                        <a href="https://wa.me/62811618808" target="_blank" class="text-sm font-bold text-white hover:text-emerald-300 transition">0811 618 808</a>
                    </div>
                </div>

                <div class="flex items-center gap-3.5 p-3 rounded-xl bg-white/[0.04] border border-white/[0.08]">
                    <div class="h-10 w-10 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-map-location-dot text-base"></i>
                    </div>
                    <div>
                        <p class="text-[11px] font-semibold text-emerald-300 uppercase tracking-wider">Kantor Sekretariat</p>
                        <p class="text-xs font-bold text-white truncate max-w-[200px]" title="Jalan Merdeka, Depan Pasar Baru Pangkalan Balai">Depan Pasar Baru Pangkalan Balai</p>
                    </div>
                </div>

                <div class="flex items-center gap-3.5 p-3 rounded-xl bg-white/[0.04] border border-white/[0.08]">
                    <div class="h-10 w-10 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-envelope-circle-check text-base"></i>
                    </div>
                    <div>
                        <p class="text-[11px] font-semibold text-emerald-300 uppercase tracking-wider">Email Korespondensi</p>
                        <a href="mailto:appsi.banyuasin@gmail.com" class="text-xs font-bold text-white hover:text-emerald-300 transition">appsi.banyuasin@gmail.com</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Footer Links Grid -->
        <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8 py-12 sm:py-16 grid gap-10 sm:grid-cols-2 lg:grid-cols-12">
            
            <!-- Brand Column (4 cols) -->
            <div class="lg:col-span-4 flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-3.5">
                        <div class="h-13 w-13 rounded-2xl overflow-hidden flex items-center justify-center p-1.5 bg-white shadow-sm shrink-0">
                            <img src="{{ asset('assets/images/appsi-logo.png') }}" alt="Logo APPSI" class="h-10 w-10 object-contain">
                        </div>
                        <div>
                            <div class="flex items-center gap-1.5">
                                <span class="text-2xl font-black text-white tracking-tight">APPSI</span>
                                <span class="text-[10px] font-extrabold px-1.5 py-0.5 rounded bg-emerald-500/20 text-emerald-300 border border-emerald-400/30 uppercase">DPD</span>
                            </div>
                            <p class="text-xs font-bold text-emerald-300/80 uppercase tracking-wider">Kabupaten Banyuasin</p>
                        </div>
                    </div>
                    <p class="mt-4 text-xs leading-relaxed text-slate-300 max-w-sm">
                        Dewan Pimpinan Daerah Asosiasi Pedagang Pasar Seluruh Indonesia (APPSI) Kabupaten Banyuasin. Berdiri sebagai pengayom, advokasi legalitas, dan akselerator kemandirian ekonomi ribuan pedagang pasar tradisional di 21 kecamatan se-Banyuasin.
                    </p>
                    <div class="mt-4 inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-emerald-950/80 border border-emerald-700/50 text-[11px] font-medium text-emerald-200">
                        <i class="fa-solid fa-award text-amber-400 text-xs"></i>
                        <span>Periode Kepengurusan 2024 - 2029</span>
                    </div>
                </div>

                <!-- Social Icons -->
                <div class="mt-6 flex items-center gap-2.5">
                    <a href="https://wa.me/62811618808" target="_blank" class="h-9 w-9 rounded-xl bg-emerald-900/60 border border-emerald-700/50 text-emerald-300 flex items-center justify-center hover:bg-emerald-600 hover:text-white transition" aria-label="WhatsApp Hotline" title="WhatsApp Hotline">
                        <i class="fa-brands fa-whatsapp text-sm"></i>
                    </a>
                    <a href="mailto:appsi.banyuasin@gmail.com" class="h-9 w-9 rounded-xl bg-emerald-900/60 border border-emerald-700/50 text-emerald-300 flex items-center justify-center hover:bg-emerald-600 hover:text-white transition" aria-label="Email Resmi" title="Email Resmi">
                        <i class="fa-solid fa-envelope text-xs"></i>
                    </a>
                    <a href="https://appsi.id" target="_blank" class="h-9 w-9 rounded-xl bg-emerald-900/60 border border-emerald-700/50 text-emerald-300 flex items-center justify-center hover:bg-emerald-600 hover:text-white transition" aria-label="Website DPP APPSI" title="Website DPP APPSI">
                        <i class="fa-solid fa-globe text-xs"></i>
                    </a>
                    <a href="{{ route('login') }}" class="h-9 w-9 rounded-xl bg-emerald-900/60 border border-emerald-700/50 text-emerald-300 flex items-center justify-center hover:bg-emerald-600 hover:text-white transition" aria-label="Portal Petugas MIS" title="Portal Login MIS">
                        <i class="fa-solid fa-shield-halved text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- Navigation Links (2.5 cols) -->
            <div class="lg:col-span-3">
                <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-300">Navigasi Utama</h3>
                <ul class="mt-4 space-y-2.5 text-xs text-slate-300">
                    <li><a href="{{ route('home') }}" class="hover:text-emerald-300 transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[9px] text-emerald-500"></i> Beranda Portal</a></li>
                    <li><a href="{{ route('programs.public') }}" class="hover:text-emerald-300 transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[9px] text-emerald-500"></i> 5 Pilar Program Kerja</a></li>
                    <li><a href="{{ route('organization.public') }}" class="hover:text-emerald-300 transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[9px] text-emerald-500"></i> Struktur Pengurus DPD</a></li>
                    <li><a href="{{ route('news.index') }}" class="hover:text-emerald-300 transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[9px] text-emerald-500"></i> Berita & Warta Pasar</a></li>
                    <li><a href="{{ route('gallery.public') }}" class="hover:text-emerald-300 transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[9px] text-emerald-500"></i> Galeri Dokumentasi</a></li>
                    <li><a href="{{ route('members.public') }}" class="hover:text-emerald-300 transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[9px] text-emerald-500"></i> Direktori Pedagang Binaan</a></li>
                    <li><a href="{{ route('about.public') }}" class="hover:text-emerald-300 transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[9px] text-emerald-500"></i> Visi, Misi & Sejarah</a></li>
                </ul>
            </div>

            <!-- Layanan & Bantuan (2.5 cols) -->
            <div class="lg:col-span-3">
                <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-300">Layanan Pedagang</h3>
                <ul class="mt-4 space-y-2.5 text-xs text-slate-300">
                    <li><a href="{{ route('members.register') }}" class="hover:text-emerald-300 transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[9px] text-emerald-500"></i> Pendaftaran KTA Online (Gratis)</a></li>
                    <li><a href="{{ route('members.check') }}" class="hover:text-emerald-300 transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[9px] text-emerald-500"></i> Cek & Validasi Kartu KTA</a></li>
                    <li><a href="{{ route('letter.verify.index') }}" class="hover:text-emerald-300 transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[9px] text-emerald-500"></i> Verifikasi Keabsahan Surat</a></li>
                    <li><a href="{{ route('downloads.public') }}" class="hover:text-emerald-300 transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[9px] text-emerald-500"></i> Unduhan AD/ART & Formulir</a></li>
                    <li><a href="{{ route('faq.public') }}" class="hover:text-emerald-300 transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[9px] text-emerald-500"></i> Tanya Jawab (FAQ) Pedagang</a></li>
                    <li><a href="{{ route('contact.public') }}" class="hover:text-emerald-300 transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[9px] text-emerald-500"></i> Posko Aspirasi & Pengaduan</a></li>
                </ul>
            </div>

            <!-- Pasar Binaan Utama (2 cols) -->
            <div class="lg:col-span-2">
                <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-300">Pasar Binaan</h3>
                <ul class="mt-4 space-y-2 text-xs text-slate-300">
                    <li class="flex items-center gap-1.5"><i class="fa-solid fa-location-dot text-emerald-400 text-[10px]"></i> Pasar Pangkalan Balai</li>
                    <li class="flex items-center gap-1.5"><i class="fa-solid fa-location-dot text-emerald-400 text-[10px]"></i> Pasar Betung</li>
                    <li class="flex items-center gap-1.5"><i class="fa-solid fa-location-dot text-emerald-400 text-[10px]"></i> Pasar Sukajadi</li>
                    <li class="flex items-center gap-1.5"><i class="fa-solid fa-location-dot text-emerald-400 text-[10px]"></i> Pasar Mariana</li>
                    <li class="flex items-center gap-1.5"><i class="fa-solid fa-location-dot text-emerald-400 text-[10px]"></i> Pasar Sungsang</li>
                </ul>
                <div class="mt-5 p-2.5 rounded-xl bg-emerald-950/60 border border-emerald-800/40 text-[11px] text-slate-300">
                    <p class="font-bold text-amber-300">Jejaring Pasar:</p>
                    <p class="text-[10px] text-slate-400 mt-0.5">Mencakup 21 Kecamatan Kabupaten Banyuasin</p>
                </div>
            </div>

        </div>

        <!-- Copyright Bar & Watermark Beranda Teknologi Digital -->
        <div class="border-t border-emerald-900/80 bg-black/40 py-4 text-xs">
            <div class="mx-auto max-w-[1180px] px-5 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left">
                <div class="text-slate-400 text-[11px]">
                    &copy; {{ date('Y') }} DPD APPSI Kabupaten Banyuasin. Seluruh Hak Cipta Dilindungi.
                </div>
                <!-- Watermark Beranda Teknologi Digital -->
                <div class="text-[11px] text-slate-400">
                    Didukung oleh <a href="https://berandadigital.net" target="_blank" rel="noopener" class="text-emerald-300/80 hover:text-emerald-200 transition underline underline-offset-2 decoration-emerald-500/30 hover:decoration-emerald-400 font-medium">Beranda Teknologi Digital</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- AOS Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 450,
                easing: 'ease-out',
                once: true,
                offset: 25
            });
        });
    </script>

    <!-- SweetAlert2 Flash Message Handler -->
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    confirmButtonColor: '#047857',
                    confirmButtonText: 'Selesai'
                });
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Perhatian!',
                    text: "{{ session('error') }}",
                    confirmButtonColor: '#dc2626',
                    confirmButtonText: 'Tutup'
                });
            });
        </script>
    @endif

    <!-- Floating Action Controls: Scroll-to-Top & Simple WhatsApp Button -->
    <aside class="fixed bottom-6 right-6 z-40 flex flex-col items-end gap-2.5" aria-label="Aksi Cepat Layanan">
        
        <!-- Scroll To Top Button -->
        <button type="button" 
                x-show="scrolled" 
                x-cloak 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-3"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-3"
                @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                class="h-10 w-10 rounded-full bg-white text-emerald-800 hover:bg-emerald-700 hover:text-white shadow-lg border border-slate-200/80 flex items-center justify-center transition-all duration-200 hover:scale-110 active:scale-95 group"
                title="Kembali ke Atas">
            <i class="fa-solid fa-arrow-up text-xs group-hover:-translate-y-0.5 transition-transform duration-200"></i>
        </button>

        <!-- Simple Minimalist WhatsApp Button -->
        <a href="https://wa.me/62811618808?text=Halo%20Pengurus%20DPD%20APPSI%20Banyuasin,%20saya%20ingin%20berkonsultasi..." 
           target="_blank" 
           class="relative flex h-12 w-12 sm:h-13 sm:w-13 items-center justify-center rounded-full bg-[#25D366] text-white shadow-[0_8px_20px_rgba(37,211,102,0.4)] hover:bg-[#20bd5a] transition-all duration-200 hover:scale-110 active:scale-95 group" 
           title="Hubungi WhatsApp DPD APPSI Banyuasin">
            <span class="absolute -top-0.5 -right-0.5 flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-300 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-400"></span>
            </span>
            <i class="fa-brands fa-whatsapp text-2xl group-hover:rotate-6 transition-transform duration-200"></i>
        </a>
    </aside>

    @stack('scripts')
</body>
</html>
