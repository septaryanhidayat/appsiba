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
<body class="min-h-screen flex flex-col antialiased selection:bg-emerald-100 selection:text-emerald-800" x-data="{ mobileMenu: false }">

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
            <nav class="hidden items-center gap-6 lg:flex">
                <a href="{{ route('home') }}" class="relative py-2 text-sm font-semibold transition {{ request()->routeIs('home') ? 'text-emerald-800 font-bold' : 'text-slate-700 hover:text-emerald-700' }}">
                    Beranda
                    @if(request()->routeIs('home'))
                        <span class="absolute inset-x-1 -bottom-1 h-0.5 rounded-full bg-emerald-700"></span>
                    @endif
                </a>
                <a href="{{ route('organization.public') }}" class="relative py-2 text-sm font-semibold transition {{ request()->routeIs('organization.public') ? 'text-emerald-800 font-bold' : 'text-slate-700 hover:text-emerald-700' }}">
                    Struktur
                    @if(request()->routeIs('organization.public'))
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
                <a href="{{ route('members.public') }}" class="relative py-2 text-sm font-semibold transition {{ request()->routeIs('members.public') ? 'text-emerald-800 font-bold' : 'text-slate-700 hover:text-emerald-700' }}">
                    Keanggotaan
                    @if(request()->routeIs('members.public'))
                        <span class="absolute inset-x-1 -bottom-1 h-0.5 rounded-full bg-emerald-700"></span>
                    @endif
                </a>
                <a href="{{ route('about.public') }}" class="relative py-2 text-sm font-semibold transition {{ request()->routeIs('about.public') ? 'text-emerald-800 font-bold' : 'text-slate-700 hover:text-emerald-700' }}">
                    Tentang Kami
                    @if(request()->routeIs('about.public'))
                        <span class="absolute inset-x-1 -bottom-1 h-0.5 rounded-full bg-emerald-700"></span>
                    @endif
                </a>
            </nav>

            <!-- CTA Buttons Desktop -->
            <div class="hidden items-center gap-3 lg:flex">
                <a href="{{ route('members.register') }}" class="inline-flex items-center justify-center gap-2 rounded-xl font-semibold transition duration-200 border border-emerald-200 bg-white text-emerald-800 hover:border-emerald-500 hover:bg-emerald-50 h-10 px-4 text-xs tracking-wide shadow-sm">
                    <i class="fa-solid fa-user-plus text-xs text-emerald-600"></i>
                    Daftar Keanggotaan
                </a>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center justify-center gap-2 rounded-xl font-semibold transition duration-200 bg-emerald-700 text-white shadow-[0_10px_24px_rgba(21,128,61,0.18)] hover:bg-emerald-800 h-10 px-4 text-xs tracking-wide">
                        <i class="fa-solid fa-gauge-high text-xs"></i>
                        Dashboard
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
            <div class="flex flex-col gap-3">
                <a href="{{ route('home') }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('home') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fa-solid fa-house w-6 text-emerald-700"></i> Beranda
                </a>
                <a href="{{ route('organization.public') }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('organization.public') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fa-solid fa-sitemap w-6 text-emerald-700"></i> Struktur Organisasi
                </a>
                <a href="{{ route('news.index') }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('news.*') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fa-solid fa-newspaper w-6 text-emerald-700"></i> Berita & Kabar Pasar
                </a>
                <a href="{{ route('gallery.public') }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('gallery.public') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fa-solid fa-images w-6 text-emerald-700"></i> Galeri Dokumentasi
                </a>
                <a href="{{ route('members.public') }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('members.public') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fa-solid fa-store w-6 text-emerald-700"></i> Direktori Pedagang
                </a>
                <a href="{{ route('about.public') }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('about.public') ? 'bg-emerald-50 text-emerald-800' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fa-solid fa-circle-info w-6 text-emerald-700"></i> Tentang Kami
                </a>

                <div class="pt-3 border-t border-slate-100 flex flex-col gap-2">
                    <a href="{{ route('members.register') }}" class="flex items-center justify-center gap-2 rounded-xl py-2.5 text-sm font-semibold border border-emerald-200 bg-emerald-50 text-emerald-800">
                        <i class="fa-solid fa-user-plus text-xs"></i>
                        Daftar Keanggotaan
                    </a>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-center gap-2 rounded-xl py-2.5 text-sm font-semibold bg-emerald-700 text-white shadow">
                            <i class="fa-solid fa-gauge-high text-xs"></i>
                            Dashboard MIS
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 rounded-xl py-2.5 text-sm font-semibold bg-emerald-700 text-white shadow">
                            <i class="fa-solid fa-lock text-xs"></i>
                            Login Petugas
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

    <!-- Footer (Adopsi appsi.id) -->
    <footer class="border-t border-slate-100 bg-white" id="kontak">
        <div class="mx-auto w-full max-w-[1180px] px-5 sm:px-6 lg:px-8 relative grid gap-9 py-12 sm:grid-cols-2 lg:grid-cols-[1.2fr_0.8fr_0.9fr_1.25fr]">
            
            <!-- Brand Column -->
            <div>
                <div class="flex items-center gap-3">
                    <div class="h-12 w-12 rounded-full overflow-hidden flex items-center justify-center p-0.5 bg-white border border-emerald-100 shadow-sm">
                        <img src="{{ asset('assets/images/appsi-logo.png') }}" alt="Logo APPSI" class="h-full w-full object-contain">
                    </div>
                    <div>
                        <span class="text-3xl font-extrabold text-emerald-700">APPSI</span>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Kabupaten Banyuasin</p>
                    </div>
                </div>
                <p class="mt-4 max-w-[280px] text-sm leading-6 text-slate-600">
                    Dewan Pimpinan Daerah (DPD) Asosiasi Pedagang Pasar Seluruh Indonesia Kabupaten Banyuasin, Provinsi Sumatera Selatan.
                </p>
                <!-- Social Icons -->
                <div class="mt-5 flex gap-3">
                    <a href="https://wa.me/62811618808" target="_blank" class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-700 text-white transition hover:bg-emerald-800" aria-label="WhatsApp">
                        <i class="fa-brands fa-whatsapp text-sm"></i>
                    </a>
                    <a href="mailto:appsi.banyuasin@gmail.com" class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-700 text-white transition hover:bg-emerald-800" aria-label="Email">
                        <i class="fa-solid fa-envelope text-sm"></i>
                    </a>
                    <a href="https://appsi.id" target="_blank" class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-700 text-white transition hover:bg-emerald-800" aria-label="DPP APPSI">
                        <i class="fa-solid fa-globe text-sm"></i>
                    </a>
                    <a href="{{ route('login') }}" class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-700 text-white transition hover:bg-emerald-800" aria-label="Admin Login">
                        <i class="fa-solid fa-lock text-sm"></i>
                    </a>
                </div>
            </div>

            <!-- Navigation Links -->
            <div>
                <h3 class="text-sm font-bold text-slate-900">Navigasi</h3>
                <ul class="mt-4 space-y-2.5">
                    <li><a href="{{ route('home') }}" class="text-sm text-slate-600 transition hover:text-emerald-700">Beranda</a></li>
                    <li><a href="{{ route('organization.public') }}" class="text-sm text-slate-600 transition hover:text-emerald-700">Struktur Organisasi</a></li>
                    <li><a href="{{ route('news.index') }}" class="text-sm text-slate-600 transition hover:text-emerald-700">Berita Pasar</a></li>
                    <li><a href="{{ route('gallery.public') }}" class="text-sm text-slate-600 transition hover:text-emerald-700">Galeri Kegiatan</a></li>
                    <li><a href="{{ route('members.public') }}" class="text-sm text-slate-600 transition hover:text-emerald-700">Direktori Pedagang</a></li>
                    <li><a href="{{ route('about.public') }}" class="text-sm text-slate-600 transition hover:text-emerald-700">Tentang Kami</a></li>
                </ul>
            </div>

            <!-- Information Links -->
            <div>
                <h3 class="text-sm font-bold text-slate-900">Informasi & Layanan</h3>
                <ul class="mt-4 space-y-2.5 text-sm text-slate-600">
                    <li><a href="{{ route('members.register') }}" class="hover:text-emerald-700 transition">Pendaftaran Anggota</a></li>
                    <li><a href="{{ route('home') }}#aspirasi" class="hover:text-emerald-700 transition">Aspirasi & Pengaduan Pasar</a></li>
                    <li><a href="{{ route('letter.verify', ['hash' => 'sample']) }}" class="hover:text-emerald-700 transition">Cek Keabsahan Surat</a></li>
                    <li>Program Revitalisasi Pasar</li>
                    <li>Fasilitasi Permodalan KUR</li>
                    <li>Digitalisasi QRIS Pasar</li>
                </ul>
            </div>

            <!-- Secretariat Contact -->
            <div class="relative">
                <h3 class="text-sm font-bold text-slate-900">Sekretariat DPD</h3>
                <ul class="mt-4 space-y-4 text-sm text-slate-600">
                    <li class="flex gap-3">
                        <i class="fa-solid fa-map-location-dot mt-1 text-emerald-700 shrink-0"></i>
                        <span class="whitespace-pre-line leading-relaxed">
                            Jalan Merdeka, Depan Pasar Baru Kelurahan Pangkalan Balai - Kecamatan Banyuasin III, Kab. Banyuasin, Sumatera Selatan
                        </span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fa-solid fa-phone text-emerald-700 shrink-0"></i>
                        <a href="tel:0811618808" class="hover:text-emerald-700">0811 618 808</a>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fa-solid fa-envelope text-emerald-700 shrink-0"></i>
                        <a href="mailto:appsi.banyuasin@gmail.com" class="hover:text-emerald-700">appsi.banyuasin@gmail.com</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright Bar -->
        <div class="bg-emerald-800 py-4 text-center text-xs font-medium text-white/90">
            <div class="mx-auto max-w-[1180px] px-5 flex flex-col sm:flex-row items-center justify-between gap-2">
                <span>&copy; {{ date('Y') }} DPD APPSI Kabupaten Banyuasin. Hak Cipta Dilindungi.</span>
                <span class="text-emerald-200/80 text-[11px]">Asosiasi Pedagang Pasar Seluruh Indonesia (appsiba.or.id)</span>
            </div>
        </div>
    </footer>

    <!-- AOS Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 350,
                easing: 'ease-out',
                once: true,
                offset: 20
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

    @stack('scripts')
</body>
</html>
