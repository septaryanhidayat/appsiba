<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MIS APPSI') - DPD APPSI Kabupaten Banyuasin</title>

    <!-- Favicon Resmi APPSI -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/appsi-logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/appsi-logo.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Tailwind CSS (Play CDN with APPSI Emerald Config) -->
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
                        sidebar: {
                            bg: '#064e3b',
                            dark: '#022c22',
                            hover: '#047857',
                            active: '#10b981',
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

    <!-- Quill.js 2.0 WYSIWYG Editor ala CMS WordPress -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
    <style>
        [x-cloak] { display: none !important; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #0f172a;
        }
        /* Custom Table Styling */
        table thead th {
            background-color: #064e3b !important;
            color: #ffffff !important;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        /* Custom Quill Styling ala WordPress / APPSI Modern */
        .ql-toolbar.ql-snow {
            border-top-left-radius: 0.75rem;
            border-top-right-radius: 0.75rem;
            border-color: #cbd5e1 !important;
            background-color: #f8fafc;
            padding: 8px 12px;
        }
        .ql-container.ql-snow {
            border-bottom-left-radius: 0.75rem;
            border-bottom-right-radius: 0.75rem;
            border-color: #cbd5e1 !important;
            background-color: #ffffff;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 13.5px;
            line-height: 1.6;
        }
        .ql-editor {
            min-height: 160px;
        }
        .ql-editor p {
            margin-bottom: 0.75em;
        }
        .ql-snow .ql-stroke {
            stroke: #334155 !important;
        }
        .ql-snow .ql-fill {
            fill: #334155 !important;
        }
        .ql-snow .ql-picker {
            color: #334155 !important;
            font-weight: 600;
            font-size: 12px;
        }
        .ql-snow .ql-picker.ql-expanded .ql-picker-options {
            border-radius: 0.5rem;
            border-color: #e2e8f0;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        .ql-snow.ql-toolbar button:hover, 
        .ql-snow .ql-toolbar button:hover,
        .ql-snow.ql-toolbar button.ql-active, 
        .ql-snow .ql-toolbar button.ql-active {
            color: #047857 !important;
        }
        .ql-snow.ql-toolbar button:hover .ql-stroke, 
        .ql-snow .ql-toolbar button:hover .ql-stroke,
        .ql-snow.ql-toolbar button.ql-active .ql-stroke, 
        .ql-snow .ql-toolbar button.ql-active .ql-stroke {
            stroke: #047857 !important;
        }
        .ql-snow.ql-toolbar button:hover .ql-fill, 
        .ql-snow .ql-toolbar button:hover .ql-fill,
        .ql-snow.ql-toolbar button.ql-active .ql-fill, 
        .ql-snow .ql-toolbar button.ql-active .ql-fill {
            fill: #047857 !important;
        }
    </style>

    @stack('styles')
</head>
<body class="min-h-screen flex antialiased" x-data="{ sidebarOpen: false }">

    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen" x-cloak class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-sm lg:hidden" @click="sidebarOpen = false"></div>

    <!-- Sidebar Navigation -->
    <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-sidebar-bg text-white transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 flex flex-col justify-between shadow-2xl"
           :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
        
        <div class="flex-1 overflow-y-auto">
            <!-- Brand Header -->
            <div class="h-18 flex items-center gap-3 px-5 py-4 border-b border-emerald-800/60 bg-sidebar-dark">
                <div class="h-10 w-10 rounded-full overflow-hidden flex items-center justify-center p-0.5 bg-white border border-emerald-400 shrink-0">
                    <img src="{{ asset('assets/images/appsi-logo.png') }}" alt="APPSI Logo" class="h-full w-full object-contain">
                </div>
                <div class="overflow-hidden">
                    <div class="flex items-center gap-1.5">
                        <span class="text-xl font-extrabold tracking-tight text-white">APPSI</span>
                        <span class="text-[10px] font-bold px-1.5 py-0.2 rounded bg-emerald-700 text-emerald-100">MIS</span>
                    </div>
                    <p class="text-[10px] font-semibold text-emerald-300/80 uppercase truncate">DPD Kab. Banyuasin</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="px-3 py-4 space-y-6">
                
                <!-- Menu Group 1: Ringkasan -->
                <div>
                    <span class="px-3 text-[10px] font-bold uppercase tracking-wider text-emerald-300/60 block mb-2">UTAMA</span>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-600 text-white font-bold shadow' : 'text-emerald-100/90 hover:bg-emerald-800/80 hover:text-white' }}">
                        <i class="fa-solid fa-gauge-high w-4 text-sm"></i>
                        <span>Dashboard Eksekutif</span>
                    </a>
                </div>

                <!-- Menu Group 2: Pasar & Anggota -->
                <div>
                    <span class="px-3 text-[10px] font-bold uppercase tracking-wider text-emerald-300/60 block mb-2">KEANGGOTAAN PASAR</span>
                    <div class="space-y-1">
                        <a href="{{ route('admin.members.index') }}" class="flex items-center justify-between px-3 py-2 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.members.*') ? 'bg-emerald-600 text-white font-bold shadow' : 'text-emerald-100/90 hover:bg-emerald-800/80 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-store w-4 text-sm"></i>
                                <span>Data Pedagang</span>
                            </div>
                        </a>
                        <a href="{{ route('admin.registrations.index') }}" class="flex items-center justify-between px-3 py-2 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.registrations.*') ? 'bg-emerald-600 text-white font-bold shadow' : 'text-emerald-100/90 hover:bg-emerald-800/80 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-user-clock w-4 text-sm"></i>
                                <span>Pendaftaran Online</span>
                            </div>
                            @php
                                $pendingCount = \App\Models\MemberRegistration::where('status', 'menunggu_verifikasi')->count();
                            @endphp
                            @if($pendingCount > 0)
                                <span class="px-1.5 py-0.5 rounded-full bg-amber-400 text-slate-950 text-[10px] font-bold">{{ $pendingCount }}</span>
                            @endif
                        </a>
                    </div>
                </div>

                <!-- Menu Group 3: Warta & Galeri -->
                <div>
                    <span class="px-3 text-[10px] font-bold uppercase tracking-wider text-emerald-300/60 block mb-2">WARTA & DOKUMENTASI</span>
                    <div class="space-y-1">
                        <a href="{{ route('admin.posts.publish') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.posts.publish') ? 'bg-emerald-600 text-white font-bold shadow' : 'text-emerald-100/90 hover:bg-emerald-800/80 hover:text-white' }}">
                            <i class="fa-solid fa-newspaper w-4 text-sm"></i>
                            <span>Berita Terbit</span>
                        </a>
                        <a href="{{ route('admin.posts.draft') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.posts.draft') ? 'bg-emerald-600 text-white font-bold shadow' : 'text-emerald-100/90 hover:bg-emerald-800/80 hover:text-white' }}">
                            <i class="fa-solid fa-file-pen w-4 text-sm"></i>
                            <span>Draf Berita</span>
                        </a>
                        <a href="{{ route('admin.gallery.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.gallery.*') ? 'bg-emerald-600 text-white font-bold shadow' : 'text-emerald-100/90 hover:bg-emerald-800/80 hover:text-white' }}">
                            <i class="fa-solid fa-images w-4 text-sm"></i>
                            <span>Galeri Kegiatan</span>
                        </a>
                    </div>
                </div>

                <!-- Menu Group 4: Persuratan Resmi -->
                <div>
                    <span class="px-3 text-[10px] font-bold uppercase tracking-wider text-emerald-300/60 block mb-2">ADMINISTRASI & PERSURATAN</span>
                    <div class="space-y-1">
                        <a href="{{ route('admin.letters.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.letters.*') ? 'bg-emerald-600 text-white font-bold shadow' : 'text-emerald-100/90 hover:bg-emerald-800/80 hover:text-white' }}">
                            <i class="fa-solid fa-envelope-open-text w-4 text-sm"></i>
                            <span>Surat Keluar & QR</span>
                        </a>
                        <a href="{{ route('admin.incoming-letters.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.incoming-letters.*') ? 'bg-emerald-600 text-white font-bold shadow' : 'text-emerald-100/90 hover:bg-emerald-800/80 hover:text-white' }}">
                            <i class="fa-solid fa-inbox w-4 text-sm"></i>
                            <span>Arsip Surat Masuk</span>
                        </a>
                        <a href="{{ route('admin.meetings.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.meetings.*') ? 'bg-emerald-600 text-white font-bold shadow' : 'text-emerald-100/90 hover:bg-emerald-800/80 hover:text-white' }}">
                            <i class="fa-solid fa-handshake w-4 text-sm"></i>
                            <span>Notulen Rapat Pasar</span>
                        </a>
                        <a href="{{ route('admin.inbox.index') }}" class="flex items-center justify-between px-3 py-2 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.inbox.*') ? 'bg-emerald-600 text-white font-bold shadow' : 'text-emerald-100/90 hover:bg-emerald-800/80 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-comments w-4 text-sm"></i>
                                <span>Aspirasi Pedagang</span>
                            </div>
                            @php
                                $newInboxCount = \App\Models\Inbox::where('status', 'baru')->count();
                            @endphp
                            @if($newInboxCount > 0)
                                <span class="px-1.5 py-0.5 rounded-full bg-emerald-400 text-emerald-950 text-[10px] font-bold">{{ $newInboxCount }}</span>
                            @endif
                        </a>
                    </div>
                </div>

                <!-- Menu Group 5: Organisasi & Pengaturan -->
                <div>
                    <span class="px-3 text-[10px] font-bold uppercase tracking-wider text-emerald-300/60 block mb-2">PENGATURAN</span>
                    <div class="space-y-1">
                        <a href="{{ route('admin.organization.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.organization.*') ? 'bg-emerald-600 text-white font-bold shadow' : 'text-emerald-100/90 hover:bg-emerald-800/80 hover:text-white' }}">
                            <i class="fa-solid fa-sitemap w-4 text-sm"></i>
                            <span>Struktur Pengurus</span>
                        </a>
                        <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.settings.index') ? 'bg-emerald-600 text-white font-bold shadow' : 'text-emerald-100/90 hover:bg-emerald-800/80 hover:text-white' }}">
                            <i class="fa-solid fa-gear w-4 text-sm"></i>
                            <span>Profil DPD & KOP</span>
                        </a>
                        <a href="{{ route('admin.settings.password') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.settings.password') ? 'bg-emerald-600 text-white font-bold shadow' : 'text-emerald-100/90 hover:bg-emerald-800/80 hover:text-white' }}">
                            <i class="fa-solid fa-key w-4 text-sm"></i>
                            <span>Ganti Password</span>
                        </a>
                    </div>
                </div>

            </nav>
        </div>

        <!-- Sidebar Footer -->
        <div class="p-3 border-t border-emerald-800/60 bg-sidebar-dark space-y-2">
            <a href="{{ route('home') }}" target="_blank" class="flex items-center justify-center gap-2 w-full py-2 rounded-xl bg-emerald-800 text-xs font-bold text-emerald-100 hover:bg-emerald-700 transition">
                <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
                <span>Lihat Website Publik</span>
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center justify-center gap-2 w-full py-2 rounded-xl bg-red-600/20 text-red-300 text-xs font-bold hover:bg-red-600 hover:text-white transition">
                    <i class="fa-solid fa-right-from-bracket text-[11px]"></i>
                    <span>Keluar Sistem</span>
                </button>
            </form>
            <div class="text-center pt-1">
                <a href="https://berandadigital.net" target="_blank" rel="noopener noreferrer" class="text-[10px] text-emerald-300/40 hover:text-emerald-300 transition" title="Beranda Teknologi Digital">
                    Beranda Teknologi Digital
                </a>
            </div>
        </div>
    </aside>

    <!-- Main Container -->
    <div class="flex-1 flex flex-col min-w-0">
        
        <!-- Top Navbar -->
        <header class="h-16 bg-white border-b border-slate-200 px-4 sm:px-6 flex items-center justify-between sticky top-0 z-30 shadow-sm">
            <div class="flex items-center gap-3 min-w-0">
                <button type="button" @click="sidebarOpen = !sidebarOpen" class="lg:hidden h-9 w-9 shrink-0 rounded-lg border border-slate-200 flex items-center justify-center text-slate-600 hover:bg-slate-50">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="flex items-center gap-2 min-w-0">
                    <span class="text-xs sm:text-sm font-extrabold text-slate-900 truncate">DPD APPSI Kabupaten Banyuasin</span>
                    <span class="hidden sm:inline-flex px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-[10px] font-bold border border-emerald-200 shrink-0">MIS 2.0</span>
                </div>
            </div>

            <div class="flex items-center gap-3 shrink-0">
                <div class="hidden md:flex items-center gap-1.5 text-xs font-semibold text-slate-500">
                    <i class="fa-regular fa-calendar-check text-emerald-700"></i>
                    <span>{{ now()->translatedFormat('l, d M Y') }}</span>
                </div>

                <!-- User Profile Pill -->
                <div class="flex items-center gap-2 pl-3 border-l border-slate-200">
                    <div class="h-8 w-8 rounded-full bg-emerald-700 text-white flex items-center justify-center font-bold text-xs shadow-sm">
                        {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                    </div>
                    <span class="text-xs font-bold text-slate-700 hidden sm:inline truncate max-w-[130px]">{{ auth()->user()->name ?? 'Administrator' }}</span>
                </div>
            </div>
        </header>

        <!-- Page Main Content -->
        <main class="flex-1 p-5 sm:p-7">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="py-4 px-7 border-t border-slate-200 bg-white text-xs text-slate-500 flex flex-col sm:flex-row items-center justify-between gap-2">
            <span>&copy; {{ date('Y') }} {{ $webSetting['singkatan'] ?? 'DPD APPSI Kabupaten Banyuasin' }}. Seluruh hak cipta dilindungi.</span>
            <div>
                <a href="https://berandadigital.net" target="_blank" rel="noopener noreferrer" class="text-[11px] text-slate-400 hover:text-emerald-700 transition" title="Beranda Teknologi Digital">Beranda Teknologi Digital</a>
            </div>
        </footer>

    </div>

    <!-- SweetAlert2 Flash Message Notifier -->
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
                    title: 'Terjadi Kesalahan',
                    text: "{{ session('error') }}",
                    confirmButtonColor: '#dc2626',
                    confirmButtonText: 'Tutup'
                });
            });
        </script>
    @endif

    <script>
        // Global Delete Confirmation using SweetAlert2
        function confirmDelete(form, message = 'Data yang dihapus tidak dapat dikembalikan!') {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
            return false;
        }
    </script>

    <!-- Quill.js Library & Auto-initialization for Rich Editors -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const richEditors = document.querySelectorAll('textarea.rich-editor');
            richEditors.forEach((textarea, idx) => {
                const editorId = 'quill-editor-' + (textarea.id || ('field-' + idx));
                
                // If container already created, skip
                if (document.getElementById(editorId)) return;

                const container = document.createElement('div');
                container.id = editorId;
                container.className = 'w-full bg-white';
                
                const rows = parseInt(textarea.getAttribute('rows')) || 6;
                const minHeight = Math.max(150, rows * 26);
                
                textarea.parentNode.insertBefore(container, textarea.nextSibling);
                textarea.style.display = 'none';

                // WordPress-style comprehensive toolbar
                const toolbarOptions = [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'align': '' }, { 'align': 'center' }, { 'align': 'right' }, { 'align': 'justify' }],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'indent': '-1'}, { 'indent': '+1' }],
                    ['blockquote'],
                    ['clean']
                ];

                const quill = new Quill('#' + editorId, {
                    modules: {
                        toolbar: toolbarOptions
                    },
                    placeholder: textarea.getAttribute('placeholder') || 'Tulis isi konten lengkap di sini...',
                    theme: 'snow'
                });

                if (textarea.value) {
                    quill.root.innerHTML = textarea.value;
                }

                quill.root.style.minHeight = minHeight + 'px';

                // Sync on content modification
                quill.on('text-change', function() {
                    const html = quill.root.innerHTML;
                    textarea.value = (html === '<p><br></p>' || html === '<p></p>') ? '' : html;
                });

                // Sync on parent form submission
                const form = textarea.closest('form');
                if (form) {
                    form.addEventListener('submit', function() {
                        const html = quill.root.innerHTML;
                        textarea.value = (html === '<p><br></p>' || html === '<p></p>') ? '' : html;
                    });
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
