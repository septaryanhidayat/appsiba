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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- AOS Animation CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    
    <!-- Tailwind CSS (Play CDN with Enhanced Emerald Theme) -->
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
                            forest: '#042018',
                            dark: '#0B1713',
                            accent: '#10B981',
                            gold: '#F59E0B',
                            goldHover: '#D97706',
                            surface: '#F8FAFC',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    animation: {
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'float': 'float 6s ease-in-out infinite',
                        'float-delayed': 'float 6s ease-in-out 3s infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' },
                        }
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
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            overflow-x: hidden !important;
            max-width: 100vw;
            background-color: #FAFAFC;
            color: #0F172A;
            letter-spacing: -0.01em;
        }

        /* Subtle modern mesh pattern */
        .ambient-mesh {
            background-image: 
                radial-gradient(at 15% 20%, rgba(16, 185, 129, 0.08) 0px, transparent 50%),
                radial-gradient(at 85% 10%, rgba(245, 158, 11, 0.06) 0px, transparent 40%),
                radial-gradient(at 50% 80%, rgba(6, 78, 59, 0.07) 0px, transparent 60%);
        }

        .hero-pattern-dots {
            background-image: radial-gradient(rgba(16, 185, 129, 0.25) 1.2px, transparent 1.2px);
            background-size: 20px 20px;
        }

        /* Smooth Hardware Accelerated Fade Up */
        .reveal-fade-up {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.75s cubic-bezier(0.16, 1, 0.3, 1), transform 0.75s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }
        .reveal-fade-up.is-revealed {
            opacity: 1;
            transform: translateY(0);
        }

        /* Stagger Delays */
        .delay-100 { transition-delay: 100ms; }
        .delay-200 { transition-delay: 200ms; }
        .delay-300 { transition-delay: 300ms; }
        .delay-400 { transition-delay: 400ms; }

        /* Ticker Animation */
        @keyframes tickerSlide {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .ticker-track {
            display: flex;
            width: max-content;
            animation: tickerSlide 40s linear infinite;
        }
        .ticker-track:hover {
            animation-play-state: paused;
        }

        /* Glassmorphism Card Hover */
        .glass-card-hover {
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .glass-card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px -15px rgba(6, 78, 59, 0.12);
        }
    </style>

    @stack('styles')
</head>
<body class="min-h-screen flex flex-col antialiased selection:bg-emerald-500 selection:text-white" x-data="{ mobileMenu: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">

    <!-- Top Announcement & Quick Contact Bar (International Organization Standard) -->
    <div class="bg-gradient-to-r from-emerald-950 via-emerald-900 to-slate-900 text-white/90 text-xs py-2 px-4 sm:px-6 border-b border-emerald-800/40 relative z-50">
        <div class="mx-auto w-full max-w-7xl flex flex-wrap items-center justify-between gap-3">
            <div class="flex items-center gap-2.5">
                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-400/30 text-[10px] font-bold tracking-wide uppercase">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    Portal Resmi
                </span>
                <span class="hidden md:inline text-slate-300 text-[11px]">
                    Dewan Pimpinan Daerah APPSI Kabupaten Banyuasin • Penggerak Pasar Rakyat
                </span>
            </div>
            <div class="flex items-center gap-4 text-[11px] font-medium text-slate-300">
                <a href="https://wa.me/62811618808" target="_blank" class="hover:text-amber-300 transition flex items-center gap-1.5">
                    <i class="fa-brands fa-whatsapp text-emerald-400"></i>
                    <span class="hidden sm:inline">Hotline:</span> 0811-618-808
                </a>
                <span class="text-white/20">|</span>
                <a href="{{ route('members.check') }}" class="hover:text-amber-300 transition flex items-center gap-1.5">
                    <i class="fa-solid fa-id-card text-amber-400"></i>
                    <span>Cek KTA</span>
                </a>
                <span class="text-white/20">|</span>
                <a href="{{ route('letter.verify.index') }}" class="hover:text-amber-300 transition flex items-center gap-1.5">
                    <i class="fa-solid fa-qrcode text-emerald-400"></i>
                    <span>Verifikasi Surat</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Sticky Glassmorphic Navbar -->
    <header class="sticky top-0 z-40 transition-all duration-300" :class="scrolled ? 'bg-white/90 backdrop-blur-xl shadow-[0_10px_30px_rgba(15,23,42,0.06)] border-b border-slate-200/80 py-2.5' : 'bg-white/95 backdrop-blur-md border-b border-slate-200/60 py-3.5'">
        <div class="mx-auto flex w-full max-w-7xl items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
            
            <!-- Brand Logo & Identity -->
            <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-3.5 group">
                <div class="h-12 w-12 rounded-2xl overflow-hidden flex items-center justify-center p-1 bg-gradient-to-br from-white to-emerald-50 border border-emerald-200 shadow-sm transition duration-300 group-hover:scale-105 group-hover:shadow-md group-hover:border-emerald-400">
                    <img src="{{ asset('assets/images/appsi-logo.png') }}" alt="Logo APPSI" class="h-full w-full object-contain">
                </div>
                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <span class="text-2xl font-black tracking-tight text-slate-900 group-hover:text-emerald-700 transition">APPSI</span>
                        <span class="text-[10px] font-extrabold px-2 py-0.5 rounded-md bg-gradient-to-r from-emerald-600 to-teal-700 text-white shadow-sm tracking-wider uppercase">DPD</span>
                    </div>
                    <span class="text-[10px] font-bold text-slate-500 tracking-wider uppercase -mt-0.5">Kabupaten Banyuasin</span>
                </div>
            </a>

            <!-- Desktop Navigation Links -->
            <nav class="hidden items-center gap-1 xl:gap-2 lg:flex">
                <a href="{{ route('home') }}" class="px-3.5 py-2 text-xs font-bold rounded-xl transition duration-200 {{ request()->routeIs('home') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:text-emerald-700 hover:bg-slate-50' }}">
                    Beranda
                </a>
                <a href="{{ route('programs.public') }}" class="px-3.5 py-2 text-xs font-bold rounded-xl transition duration-200 {{ request()->routeIs('programs.*') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:text-emerald-700 hover:bg-slate-50' }}">
                    5 Pilar Program
                </a>
                <a href="{{ route('members.public') }}" class="px-3.5 py-2 text-xs font-bold rounded-xl transition duration-200 {{ request()->routeIs('members.*') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:text-emerald-700 hover:bg-slate-50' }}">
                    Keanggotaan
                </a>
                <a href="{{ route('news.index') }}" class="px-3.5 py-2 text-xs font-bold rounded-xl transition duration-200 {{ request()->routeIs('news.*') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:text-emerald-700 hover:bg-slate-50' }}">
                    Warta Pasar
                </a>
                <a href="{{ route('gallery.public') }}" class="px-3.5 py-2 text-xs font-bold rounded-xl transition duration-200 {{ request()->routeIs('gallery.*') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:text-emerald-700 hover:bg-slate-50' }}">
                    Galeri
                </a>
                <a href="{{ route('downloads.public') }}" class="px-3.5 py-2 text-xs font-bold rounded-xl transition duration-200 {{ request()->routeIs('downloads.*') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:text-emerald-700 hover:bg-slate-50' }}">
                    Unduhan
                </a>
                <a href="{{ route('about.public') }}" class="px-3.5 py-2 text-xs font-bold rounded-xl transition duration-200 {{ request()->routeIs('about.*') || request()->routeIs('organization.*') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:text-emerald-700 hover:bg-slate-50' }}">
                    Tentang Kami
                </a>
                <a href="{{ route('contact.public') }}" class="px-3.5 py-2 text-xs font-bold rounded-xl transition duration-200 {{ request()->routeIs('contact.*') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:text-emerald-700 hover:bg-slate-50' }}">
                    Kontak
                </a>
            </nav>

            <!-- Desktop Action Buttons -->
            <div class="hidden items-center gap-3 lg:flex">
                <a href="{{ route('members.register') }}" class="inline-flex items-center justify-center gap-2 rounded-xl font-bold transition duration-200 border border-emerald-300 bg-white text-emerald-800 hover:bg-emerald-50 hover:border-emerald-600 h-10 px-4 text-xs shadow-sm">
                    <i class="fa-solid fa-user-plus text-xs text-emerald-600"></i>
                    Daftar KTA
                </a>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center justify-center gap-2 rounded-xl font-bold transition duration-200 bg-gradient-to-r from-emerald-700 to-teal-800 text-white shadow-[0_8px_20px_rgba(4,120,87,0.25)] hover:from-emerald-800 hover:to-teal-900 h-10 px-4 text-xs">
                        <i class="fa-solid fa-gauge-high text-xs"></i>
                        MIS Admin
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 rounded-xl font-bold transition duration-200 bg-gradient-to-r from-slate-900 to-emerald-950 text-white shadow-sm hover:bg-slate-800 h-10 px-4 text-xs">
                        <i class="fa-solid fa-lock text-xs text-emerald-400"></i>
                        Login
                    </a>
                @endauth
            </div>

            <!-- Mobile Hamburger Button -->
            <button type="button" @click="mobileMenu = !mobileMenu" class="inline-flex h-11 w-11 items-center justify-center rounded-xl border border-slate-200 text-slate-800 lg:hidden hover:bg-slate-50 transition" aria-label="Buka Menu">
                <i class="fa-solid text-lg" :class="mobileMenu ? 'fa-xmark' : 'fa-bars'"></i>
            </button>
        </div>

        <!-- Mobile Drawer Navigation -->
        <div x-show="mobileMenu" x-cloak class="border-t border-slate-200/80 bg-white/95 backdrop-blur-xl px-5 py-5 lg:hidden shadow-2xl max-h-[85vh] overflow-y-auto" @click.away="mobileMenu = false">
            <div class="flex flex-col gap-1.5">
                <a href="{{ route('home') }}" class="px-3.5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-3 {{ request()->routeIs('home') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fa-solid fa-house w-5 text-emerald-700"></i> Beranda
                </a>
                <a href="{{ route('programs.public') }}" class="px-3.5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-3 {{ request()->routeIs('programs.*') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fa-solid fa-layer-group w-5 text-emerald-700"></i> 5 Pilar Program
                </a>
                <a href="{{ route('members.public') }}" class="px-3.5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-3 {{ request()->routeIs('members.public') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fa-solid fa-store w-5 text-emerald-700"></i> Direktori Pedagang
                </a>
                <a href="{{ route('members.check') }}" class="px-3.5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-3 {{ request()->routeIs('members.check') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fa-solid fa-id-card-clip w-5 text-emerald-700"></i> Cek Status KTA
                </a>
                <a href="{{ route('news.index') }}" class="px-3.5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-3 {{ request()->routeIs('news.*') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fa-solid fa-newspaper w-5 text-emerald-700"></i> Warta & Kabar Pasar
                </a>
                <a href="{{ route('gallery.public') }}" class="px-3.5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-3 {{ request()->routeIs('gallery.public') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fa-solid fa-images w-5 text-emerald-700"></i> Galeri Dokumentasi
                </a>
                <a href="{{ route('downloads.public') }}" class="px-3.5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-3 {{ request()->routeIs('downloads.*') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fa-solid fa-file-arrow-down w-5 text-emerald-700"></i> Pusat Unduhan
                </a>
                <a href="{{ route('organization.public') }}" class="px-3.5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-3 {{ request()->routeIs('organization.*') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fa-solid fa-sitemap w-5 text-emerald-700"></i> Struktur Organisasi
                </a>
                <a href="{{ route('about.public') }}" class="px-3.5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-3 {{ request()->routeIs('about.public') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fa-solid fa-circle-info w-5 text-emerald-700"></i> Tentang Kami
                </a>
                <a href="{{ route('contact.public') }}" class="px-3.5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-3 {{ request()->routeIs('contact.*') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fa-solid fa-headset w-5 text-emerald-700"></i> Kontak & Aspirasi
                </a>

                <div class="pt-4 mt-2 border-t border-slate-100 flex flex-col gap-2.5">
                    <a href="{{ route('members.register') }}" class="flex items-center justify-center gap-2 rounded-xl py-3 text-sm font-bold border border-emerald-200 bg-emerald-50 text-emerald-800">
                        <i class="fa-solid fa-user-plus text-xs"></i>
                        Daftar Anggota KTA (Gratis)
                    </a>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-center gap-2 rounded-xl py-3 text-sm font-bold bg-emerald-700 text-white shadow">
                            <i class="fa-solid fa-gauge-high text-xs"></i>
                            Dashboard MIS Admin
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 rounded-xl py-3 text-sm font-bold bg-slate-900 text-white shadow">
                            <i class="fa-solid fa-lock text-xs text-emerald-400"></i>
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

    <!-- International Luxury Footer (High-Contrast Slate/Dark Emerald) -->
    <footer class="bg-gradient-to-b from-slate-900 via-slate-950 to-black text-slate-300 relative border-t border-slate-800 overflow-hidden" id="kontak">
        
        <!-- Subtle Glow Mesh at Footer Top -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-3/4 h-32 bg-emerald-500/10 blur-3xl pointer-events-none"></div>

        <div class="mx-auto w-full max-w-7xl px-5 sm:px-6 lg:px-8 py-16 sm:py-20 relative z-10 grid gap-10 md:grid-cols-2 lg:grid-cols-12">
            
            <!-- Col 1: Organization Identity & Mission (5 cols) -->
            <div class="lg:col-span-4 flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-3.5">
                        <div class="h-14 w-14 rounded-2xl overflow-hidden flex items-center justify-center p-1.5 bg-white/10 border border-white/15 backdrop-blur-md shadow-inner">
                            <img src="{{ asset('assets/images/appsi-logo.png') }}" alt="Logo APPSI" class="h-full w-full object-contain">
                        </div>
                        <div>
                            <span class="text-3xl font-black tracking-tight text-white">APPSI</span>
                            <p class="text-xs font-extrabold text-emerald-400 uppercase tracking-wider">DPD Kab. Banyuasin</p>
                        </div>
                    </div>
                    
                    <p class="mt-5 text-sm leading-relaxed text-slate-400">
                        Wadah resmi pengayom dan pemberdayaan pedagang pasar tradisional di Kabupaten Banyuasin, berkomitmen mewujudkan kemandirian, digitalisasi berkeadilan, dan perlindungan usaha kerakyatan.
                    </p>

                    <!-- Accreditations & Key Info Badges -->
                    <div class="mt-6 flex flex-wrap gap-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-emerald-950/80 border border-emerald-700/50 text-[11px] font-semibold text-emerald-300">
                            <i class="fa-solid fa-shield-halved text-emerald-400 text-xs"></i>
                            Mitra Resmi Pasar
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-slate-800/80 border border-slate-700 text-[11px] font-semibold text-slate-300">
                            <i class="fa-solid fa-award text-amber-400 text-xs"></i>
                            Masa Bakti 2024 - 2029
                        </span>
                    </div>
                </div>

                <!-- Social & Communication Links -->
                <div class="mt-8 flex items-center gap-3">
                    <a href="https://wa.me/62811618808" target="_blank" class="h-10 w-10 rounded-xl bg-slate-800/90 border border-slate-700 text-emerald-400 flex items-center justify-center hover:bg-emerald-600 hover:text-white hover:border-emerald-500 transition duration-200" aria-label="WhatsApp Center">
                        <i class="fa-brands fa-whatsapp text-lg"></i>
                    </a>
                    <a href="mailto:appsi.banyuasin@gmail.com" class="h-10 w-10 rounded-xl bg-slate-800/90 border border-slate-700 text-slate-300 flex items-center justify-center hover:bg-emerald-600 hover:text-white hover:border-emerald-500 transition duration-200" aria-label="Email DPD">
                        <i class="fa-solid fa-envelope text-sm"></i>
                    </a>
                    <a href="https://appsi.id" target="_blank" class="h-10 w-10 rounded-xl bg-slate-800/90 border border-slate-700 text-slate-300 flex items-center justify-center hover:bg-emerald-600 hover:text-white hover:border-emerald-500 transition duration-200" aria-label="DPP APPSI">
                        <i class="fa-solid fa-globe text-sm"></i>
                    </a>
                    <a href="{{ route('login') }}" class="h-10 w-10 rounded-xl bg-slate-800/90 border border-slate-700 text-slate-300 flex items-center justify-center hover:bg-emerald-600 hover:text-white hover:border-emerald-500 transition duration-200" aria-label="Admin Portal">
                        <i class="fa-solid fa-lock text-sm"></i>
                    </a>
                </div>
            </div>

            <!-- Col 2: Strategic Pages (2.5 cols) -->
            <div class="lg:col-span-3">
                <h3 class="text-sm font-bold text-white uppercase tracking-wider">Navigasi Utama</h3>
                <ul class="mt-5 space-y-3 text-sm text-slate-400">
                    <li><a href="{{ route('home') }}" class="hover:text-emerald-400 transition flex items-center gap-2"><i class="fa-solid fa-angle-right text-xs text-emerald-500"></i> Beranda Portal</a></li>
                    <li><a href="{{ route('programs.public') }}" class="hover:text-emerald-400 transition flex items-center gap-2"><i class="fa-solid fa-angle-right text-xs text-emerald-500"></i> 5 Pilar Program Kerja</a></li>
                    <li><a href="{{ route('organization.public') }}" class="hover:text-emerald-400 transition flex items-center gap-2"><i class="fa-solid fa-angle-right text-xs text-emerald-500"></i> Struktur Pengurus DPD</a></li>
                    <li><a href="{{ route('news.index') }}" class="hover:text-emerald-400 transition flex items-center gap-2"><i class="fa-solid fa-angle-right text-xs text-emerald-500"></i> Warta & Liputan Pasar</a></li>
                    <li><a href="{{ route('gallery.public') }}" class="hover:text-emerald-400 transition flex items-center gap-2"><i class="fa-solid fa-angle-right text-xs text-emerald-500"></i> Dokumentasi Lapangan</a></li>
                    <li><a href="{{ route('members.public') }}" class="hover:text-emerald-400 transition flex items-center gap-2"><i class="fa-solid fa-angle-right text-xs text-emerald-500"></i> Direktori Pedagang Binaan</a></li>
                    <li><a href="{{ route('about.public') }}" class="hover:text-emerald-400 transition flex items-center gap-2"><i class="fa-solid fa-angle-right text-xs text-emerald-500"></i> Visi, Misi & Sejarah</a></li>
                </ul>
            </div>

            <!-- Col 3: Public Services (2.5 cols) -->
            <div class="lg:col-span-2">
                <h3 class="text-sm font-bold text-white uppercase tracking-wider">Layanan Terpadu</h3>
                <ul class="mt-5 space-y-3 text-sm text-slate-400">
                    <li><a href="{{ route('members.register') }}" class="hover:text-emerald-400 transition">Pendaftaran KTA Pedagang</a></li>
                    <li><a href="{{ route('members.check') }}" class="hover:text-emerald-400 transition">Validasi Kartu KTA</a></li>
                    <li><a href="{{ route('letter.verify.index') }}" class="hover:text-emerald-400 transition">Verifikasi Surat Keabsahan</a></li>
                    <li><a href="{{ route('downloads.public') }}" class="hover:text-emerald-400 transition">Pusat Unduhan AD/ART</a></li>
                    <li><a href="{{ route('faq.public') }}" class="hover:text-emerald-400 transition">Tanya Jawab (FAQ)</a></li>
                    <li><a href="{{ route('contact.public') }}" class="hover:text-emerald-400 transition">Saluran Pengaduan Pedagang</a></li>
                </ul>
            </div>

            <!-- Col 4: Secretariat & Location (3 cols) -->
            <div class="lg:col-span-3">
                <h3 class="text-sm font-bold text-white uppercase tracking-wider">Sekretariat DPD</h3>
                <div class="mt-5 space-y-4 text-sm text-slate-400">
                    <div class="flex gap-3">
                        <div class="h-8 w-8 rounded-lg bg-emerald-950/90 border border-emerald-700/50 flex items-center justify-center text-emerald-400 shrink-0 mt-0.5">
                            <i class="fa-solid fa-map-pin text-xs"></i>
                        </div>
                        <p class="leading-relaxed">
                            Jalan Merdeka, Depan Pasar Baru Pangkalan Balai, Banyuasin III, Sumatera Selatan
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="h-8 w-8 rounded-lg bg-emerald-950/90 border border-emerald-700/50 flex items-center justify-center text-emerald-400 shrink-0">
                            <i class="fa-solid fa-phone text-xs"></i>
                        </div>
                        <a href="tel:0811618808" class="hover:text-emerald-400 transition font-mono">0811 618 808</a>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="h-8 w-8 rounded-lg bg-emerald-950/90 border border-emerald-700/50 flex items-center justify-center text-emerald-400 shrink-0">
                            <i class="fa-solid fa-envelope text-xs"></i>
                        </div>
                        <a href="mailto:appsi.banyuasin@gmail.com" class="hover:text-emerald-400 transition text-xs break-all">appsi.banyuasin@gmail.com</a>
                    </div>
                </div>

                <!-- Emergency Contact Badge -->
                <div class="mt-6 p-3.5 rounded-xl bg-slate-800/60 border border-slate-700/80">
                    <p class="text-[11px] font-bold text-slate-300">Posko Advokasi Pedagang:</p>
                    <p class="text-xs text-amber-400 font-semibold mt-0.5 flex items-center gap-1.5">
                        <i class="fa-solid fa-clock"></i> Layanan Aktif Setiap Hari Kerja
                    </p>
                </div>
            </div>

        </div>

        <!-- Bottom Copyright & Accreditation Strip -->
        <div class="border-t border-slate-800/80 bg-black/40 py-5 text-xs text-slate-500">
            <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left">
                <div>
                    <span class="text-slate-400">&copy; {{ date('Y') }} DPD APPSI Kabupaten Banyuasin.</span>
                    <span class="text-slate-500"> Hak Cipta Dilindungi Undang-Undang.</span>
                </div>
                <div class="flex items-center gap-4 text-[11px] text-slate-500">
                    <span>Portal Resmi appsiba.or.id</span>
                    <span>•</span>
                    <a href="{{ route('about.public') }}" class="hover:text-slate-300">Privasi & Legalitas</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- AOS Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS with modern timing
            AOS.init({
                duration: 650,
                easing: 'cubic-bezier(0.16, 1, 0.3, 1)',
                once: true,
                offset: 40
            });

            // Native Smooth Fade-Up with IntersectionObserver
            const revealElements = document.querySelectorAll('.reveal-fade-up');
            if ('IntersectionObserver' in window && revealElements.length > 0) {
                const revealObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-revealed');
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    root: null,
                    threshold: 0.12,
                    rootMargin: '0px 0px -40px 0px'
                });

                revealElements.forEach(el => revealObserver.observe(el));
            } else {
                // Fallback
                revealElements.forEach(el => el.classList.add('is-revealed'));
            }
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

    <!-- Floating WhatsApp Assistance Button (Hotline APPSI Banyuasin) -->
    <aside class="fixed bottom-6 right-6 z-40" aria-label="Hotline WhatsApp APPSI">
        <a href="https://wa.me/62811618808?text=Halo%20Pengurus%20DPD%20APPSI%20Banyuasin,%20saya%20ingin%20berkonsultasi..." target="_blank" class="group flex items-center gap-2.5 rounded-full bg-emerald-600 hover:bg-emerald-500 pl-4 pr-4 py-3 text-white shadow-[0_16px_36px_rgba(5,150,105,0.45)] transition-all duration-300 hover:scale-105 active:scale-95 border border-emerald-400/40" title="Hotline WhatsApp APPSI Banyuasin">
            <span class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-300 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-200"></span>
            </span>
            <i class="fa-brands fa-whatsapp text-2xl text-emerald-100 group-hover:scale-110 transition"></i>
            <span class="hidden sm:inline-block text-xs font-bold tracking-wide">
                Hotline Bantuan APPSI
            </span>
        </a>
    </aside>

    @stack('scripts')
</body>
</html>
