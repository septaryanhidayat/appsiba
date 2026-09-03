@extends('layouts.admin')

@section('title', 'Ganti Kata Sandi Admin')

@section('content')

<div class="max-w-xl mx-auto space-y-6" x-data="{ showPass: false }">
    
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Ganti Kata Sandi Petugas</h1>
            <p class="text-xs text-slate-500 mt-1">Perbarui password akun untuk menjaga keamanan akses ke dashboard MIS APPSI</p>
        </div>
    </div>

    <form action="{{ route('admin.settings.password.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="p-8 rounded-2xl bg-white border border-slate-200/80 shadow-sm space-y-6">
            
            @if($errors->any())
                <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs font-semibold">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kata Sandi Saat Ini *</label>
                    <input :type="showPass ? 'text' : 'password'" name="current_password" required class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-900 focus:border-emerald-600 focus:bg-white outline-none shadow-sm" placeholder="Masukkan kata sandi lama Anda">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kata Sandi Baru *</label>
                    <input :type="showPass ? 'text' : 'password'" name="password" required class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-900 focus:border-emerald-600 focus:bg-white outline-none shadow-sm" placeholder="Minimal 8 karakter">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Ulangi Kata Sandi Baru *</label>
                    <input :type="showPass ? 'text' : 'password'" name="password_confirmation" required class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-900 focus:border-emerald-600 focus:bg-white outline-none shadow-sm" placeholder="Ketik ulang kata sandi">
                </div>

                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" id="togglePass" @click="showPass = !showPass" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500 cursor-pointer">
                    <label for="togglePass" class="text-xs text-slate-600 cursor-pointer select-none font-medium">Tampilkan Kata Sandi</label>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="{{ route('admin.dashboard') }}" class="px-5 py-2.5 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-white bg-emerald-700 hover:bg-emerald-800 shadow transition">
                    Simpan Kata Sandi Baru
                </button>
            </div>
        </div>
    </form>
</div>

@endsection
