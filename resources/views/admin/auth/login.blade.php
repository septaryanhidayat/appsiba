<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator - DPD APPSI Kabupaten Banyuasin</title>

    <!-- Favicon Resmi APPSI -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/appsi-logo.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Tailwind CSS CDN -->
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
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #022c22;
            background-image: 
                radial-gradient(at 0% 0%, hsla(160,84%,12%,1) 0, transparent 50%), 
                radial-gradient(at 100% 0%, hsla(158,64%,18%,0.5) 0, transparent 45%), 
                radial-gradient(at 50% 50%, hsla(160,100%,10%,0.8) 0, transparent 60%),
                radial-gradient(at 100% 100%, hsla(160,84%,15%,0.7) 0, transparent 50%);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 antialiased" x-data="{ showPass: false }">

    <div class="w-full max-w-md">
        
        <!-- Logo & Title -->
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center p-2 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 shadow-2xl mb-4 hover:scale-105 transition">
                <img src="{{ asset('assets/images/appsi-logo.png') }}" alt="Logo APPSI" class="h-16 w-16 object-contain">
            </a>
            <h1 class="text-2xl font-extrabold text-white tracking-tight">DPD APPSI BANYUASIN</h1>
            <p class="text-xs font-semibold text-emerald-300 mt-1 uppercase tracking-wider">Sistem Informasi Manajemen (MIS)</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-3xl p-8 shadow-2xl border border-emerald-800/30 relative">
            
            <div class="mb-6">
                <h2 class="text-xl font-bold text-slate-900">Masuk Petugas</h2>
                <p class="text-xs text-slate-500 mt-1">Akses dashboard pengurus DPD APPSI Kabupaten Banyuasin</p>
            </div>

            <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Email Input with Neutral Label -->
                <div>
                    <label for="email" class="block text-xs font-bold uppercase text-slate-700 mb-1.5">
                        Isikan Email Anda
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-regular fa-envelope text-sm"></i>
                        </div>
                        <input type="email" id="email" name="email" required value="{{ old('email') }}" autofocus
                               class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/20 focus:outline-none transition"
                               placeholder="nama@email.com">
                    </div>
                    @error('email')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div>
                    <label for="password" class="block text-xs font-bold uppercase text-slate-700 mb-1.5">
                        Kata Sandi
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-lock text-sm"></i>
                        </div>
                        <input :type="showPass ? 'text' : 'password'" id="password" name="password" required
                               class="w-full pl-10 pr-10 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/20 focus:outline-none transition"
                               placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
                        <button type="button" @click="showPass = !showPass" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600">
                            <i class="fa-regular" :class="showPass ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-emerald-600 rounded border-slate-300 focus:ring-emerald-500">
                        <span class="text-xs font-medium text-slate-600">Ingat sesi saya</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" class="w-full py-3 px-4 bg-emerald-700 hover:bg-emerald-800 text-white rounded-xl font-bold text-sm shadow-[0_10px_24px_rgba(21,128,61,0.25)] hover:shadow-none transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i>
                        <span>Masuk ke Dashboard MIS</span>
                    </button>
                </div>

            </form>

            <div class="mt-6 pt-5 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <a href="{{ route('home') }}" class="hover:text-emerald-700 flex items-center gap-1 font-semibold">
                    <i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali ke Website
                </a>
                <span class="text-slate-400">APPSI Banyuasin</span>
            </div>

        </div>

        <p class="text-center text-xs text-emerald-300/70 mt-6 font-medium">
            &copy; {{ date('Y') }} DPD Asosiasi Pedagang Pasar Seluruh Indonesia Kab. Banyuasin
        </p>

    </div>

    <!-- SweetAlert2 Flash Message -->
    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Akses Ditolak',
                    text: "{{ session('error') }}",
                    confirmButtonColor: '#047857'
                });
            });
        </script>
    @endif

    @if(session('status'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'info',
                    title: 'Informasi',
                    text: "{{ session('status') }}",
                    confirmButtonColor: '#047857'
                });
            });
        </script>
    @endif

</body>
</html>
