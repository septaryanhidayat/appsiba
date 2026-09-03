@extends('layouts.admin')

@section('title', 'Periksa Pendaftaran Pedagang - ' . $registration->nama)

@section('content')

<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900">Verifikasi Permohonan Keanggotaan</h1>
        <p class="text-xs text-slate-500 mt-1">Tinjau data pedagang pasar dan terbitkan Nomor Pokok Anggota (NPA)</p>
    </div>
    <a href="{{ route('admin.registrations.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-emerald-700">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Antrean
    </a>
</div>

<div class="grid lg:grid-cols-3 gap-6 max-w-5xl">
    
    <!-- Detail Pedagang & Usaha -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-4">
                <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                    <i class="fa-solid fa-id-card text-emerald-700"></i>
                    Data Calon Anggota Pedagang
                </h3>
                <span class="text-xs text-slate-400">Daftar pada: {{ $registration->created_at ? $registration->created_at->translatedFormat('d F Y H:i') : '-' }}</span>
            </div>

            <div class="grid sm:grid-cols-2 gap-4 text-xs">
                <div>
                    <span class="text-[10px] font-bold uppercase text-slate-400 block">Nama Lengkap</span>
                    <span class="text-sm font-extrabold text-slate-900 mt-0.5 block">{{ $registration->nama }}</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold uppercase text-slate-400 block">NIK KTP</span>
                    <span class="text-sm font-mono font-bold text-slate-800 mt-0.5 block">{{ $registration->nik }}</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold uppercase text-slate-400 block">Nomor WhatsApp / HP</span>
                    <span class="text-sm font-mono font-bold text-slate-800 mt-0.5 block">{{ $registration->no_hp }}</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold uppercase text-slate-400 block">Alamat Email</span>
                    <span class="text-sm text-slate-700 mt-0.5 block">{{ $registration->email ?? '-' }}</span>
                </div>
                <div class="sm:col-span-2">
                    <span class="text-[10px] font-bold uppercase text-slate-400 block">Alamat Domisili Tempat Tinggal</span>
                    <span class="text-xs text-slate-700 mt-0.5 block leading-relaxed">{{ $registration->alamat_domisili }}</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm">
            <h3 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-store text-emerald-700"></i>
                Data Usaha di Pasar
            </h3>

            <div class="grid sm:grid-cols-2 gap-4 text-xs">
                <div>
                    <span class="text-[10px] font-bold uppercase text-slate-400 block">Nama Usaha / Toko</span>
                    <span class="text-sm font-extrabold text-emerald-900 mt-0.5 block">{{ $registration->nama_usaha }}</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold uppercase text-slate-400 block">Bentuk Usaha</span>
                    <span class="text-sm font-bold text-slate-800 mt-0.5 block">{{ $registration->bentuk_usaha }}</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold uppercase text-slate-400 block">Komoditas Barang Dagangan</span>
                    <span class="text-xs font-semibold text-slate-700 mt-0.5 block">{{ $registration->jenis_usaha }}</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold uppercase text-slate-400 block">Lokasi Pasar Tradisional</span>
                    <span class="text-xs font-semibold text-slate-700 mt-0.5 block">{{ $registration->lokasi_pasar }}</span>
                </div>
                <div class="sm:col-span-2">
                    <span class="text-[10px] font-bold uppercase text-slate-400 block">Blok / Nomor Kios</span>
                    <span class="text-xs text-slate-700 mt-0.5 block">{{ $registration->blok_nomor ?? 'Tidak disebutkan' }}</span>
                </div>
            </div>
        </div>

        <!-- Lampiran Foto -->
        <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm">
            <h3 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-camera text-emerald-700"></i>
                Dokumen Foto Lampiran
            </h3>

            <div class="grid sm:grid-cols-2 gap-4">
                <div class="border border-slate-200 rounded-xl p-3 text-center bg-slate-50">
                    <span class="text-[11px] font-bold uppercase text-slate-500 block mb-2">Foto KTP</span>
                    @if($registration->foto_ktp)
                        <img src="{{ asset('storage/' . $registration->foto_ktp) }}" alt="KTP" class="max-h-44 mx-auto rounded-lg object-contain shadow-sm">
                    @else
                        <div class="py-10 text-slate-400 text-xs italic">Tidak ada foto KTP yang dilampirkan.</div>
                    @endif
                </div>

                <div class="border border-slate-200 rounded-xl p-3 text-center bg-slate-50">
                    <span class="text-[11px] font-bold uppercase text-slate-500 block mb-2">Foto Usaha / Kios</span>
                    @if($registration->foto_usaha)
                        <img src="{{ asset('storage/' . $registration->foto_usaha) }}" alt="Kios" class="max-h-44 mx-auto rounded-lg object-contain shadow-sm">
                    @else
                        <div class="py-10 text-slate-400 text-xs italic">Tidak ada foto kios yang dilampirkan.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Action & Status Sidebar -->
    <div class="space-y-6">
        
        <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm">
            <h3 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-3 mb-4">
                Status Verifikasi
            </h3>

            <div class="mb-4">
                @if($registration->status === 'menunggu_verifikasi')
                    <div class="p-3.5 bg-amber-50 rounded-xl border border-amber-200 text-amber-900 text-xs">
                        <i class="fa-solid fa-clock mr-1"></i> Permohonan ini <strong>belum diverifikasi</strong>.
                    </div>
                @elseif($registration->status === 'disetujui')
                    <div class="p-3.5 bg-emerald-50 rounded-xl border border-emerald-200 text-emerald-900 text-xs">
                        <i class="fa-solid fa-check mr-1"></i> Permohonan ini <strong>telah disetujui</strong>. Data telah masuk ke daftar pedagang aktif.
                    </div>
                @else
                    <div class="p-3.5 bg-red-50 rounded-xl border border-red-200 text-red-900 text-xs">
                        <i class="fa-solid fa-xmark mr-1"></i> Permohonan ini <strong>ditolak</strong>.
                    </div>
                @endif
            </div>

            @if($registration->catatan_admin)
                <div class="text-xs text-slate-600 bg-slate-50 p-3 rounded-xl mb-4 border border-slate-200">
                    <span class="font-bold text-slate-700 block mb-1">Catatan Admin:</span>
                    {{ $registration->catatan_admin }}
                </div>
            @endif

            @if($registration->status === 'menunggu_verifikasi')
                <!-- Approve Form -->
                <form action="{{ route('admin.registrations.approve', $registration->id) }}" method="POST" class="space-y-3 mb-3">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Catatan Persetujuan (Opsional)</label>
                        <input type="text" name="catatan_admin" value="Disetujui sebagai Anggota APPSI Banyuasin" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs focus:outline-none">
                    </div>
                    <button type="submit" class="w-full py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs transition shadow flex items-center justify-center gap-2">
                        <i class="fa-solid fa-check"></i> Setujui & Terbitkan NPA
                    </button>
                </form>

                <!-- Reject Form -->
                <form action="{{ route('admin.registrations.reject', $registration->id) }}" method="POST" class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Alasan Penolakan</label>
                        <input type="text" name="catatan_admin" placeholder="Contoh: Domisili di luar Banyuasin..." class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs focus:outline-none">
                    </div>
                    <button type="submit" class="w-full py-2.5 rounded-xl bg-red-100 hover:bg-red-200 text-red-700 font-bold text-xs transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-ban"></i> Tolak Permohonan
                    </button>
                </form>
            @endif
        </div>

    </div>

</div>

@endsection
