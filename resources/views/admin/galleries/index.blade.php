@extends('layouts.admin')

@section('title', 'Galeri Kegiatan APPSI')

@section('content')

<div class="space-y-6" x-data="{ modalTambah: false, editModal: false, editData: {} }">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Galeri Foto & Dokumentasi Pasar</h1>
            <p class="text-xs text-slate-500 mt-1">Dokumentasi kegiatan, aksi sosial, dan peninjauan pasar oleh DPD APPSI Banyuasin</p>
        </div>
        <button @click="modalTambah = true" class="inline-flex items-center gap-2 rounded-xl bg-emerald-700 px-4 py-2.5 text-xs font-bold text-white shadow-sm hover:bg-emerald-800 transition">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Upload Foto Baru</span>
        </button>
    </div>

    <!-- Gallery Grid -->
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
        @forelse($galleries as $gal)
            <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm flex flex-col justify-between">
                <div>
                    <div class="h-44 w-full overflow-hidden bg-slate-100">
                        <img src="{{ $gal->foto_url }}" alt="{{ $gal->judul }}" class="h-full w-full object-cover">
                    </div>
                    <div class="p-4">
                        <span class="text-[10px] font-bold text-emerald-700 uppercase bg-emerald-50 px-2 py-0.5 rounded">
                            {{ $gal->kategori ?? 'Kegiatan' }}
                        </span>
                        <h3 class="text-xs font-bold text-slate-900 line-clamp-2 mt-1">{{ $gal->judul }}</h3>
                        <p class="text-[11px] text-slate-400 mt-1">
                            <i class="fa-regular fa-calendar mr-1"></i>
                            {{ $gal->tanggal_kegiatan ? $gal->tanggal_kegiatan->format('d/m/Y') : '-' }}
                        </p>
                    </div>
                </div>
                <div class="p-3 bg-slate-50 border-t border-slate-100 flex items-center justify-between">
                    <span class="text-[10px] text-slate-400">APPSI Media</span>
                    <div class="flex items-center gap-1.5">
                        <button type="button" @click="editData = {{ json_encode($gal) }}; editModal = true" class="h-7 w-7 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 flex items-center justify-center text-xs transition" title="Edit Foto">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <form action="{{ route('admin.gallery.destroy', $gal->id) }}" method="POST" onsubmit="return confirmDelete(this, 'Hapus foto galeri ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="h-7 w-7 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 flex items-center justify-center text-xs transition" title="Hapus Foto">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-4 text-center py-16 bg-white rounded-2xl border border-slate-100 text-slate-400">
                Belum ada foto dokumentasi di galeri.
            </div>
        @endforelse
    </div>

    <div class="p-4 border-t border-slate-100 bg-white rounded-2xl shadow-sm">
        {{ $galleries->links() }}
    </div>

    <!-- Modal Upload Foto -->
    <div x-show="modalTambah" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/60 p-4 backdrop-blur-sm" @click.self="modalTambah = false">
        <div class="w-full max-w-lg bg-white rounded-2xl p-6 shadow-2xl space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="text-base font-bold text-slate-900">Upload Foto Galeri</h3>
                <button type="button" @click="modalTambah = false" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Judul Foto / Kegiatan *</label>
                    <input type="text" name="judul" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Kategori</label>
                        <input type="text" name="kategori" value="Kegiatan" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Tanggal Kegiatan</label>
                        <input type="date" name="tanggal_kegiatan" value="{{ date('Y-m-d') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Deskripsi Ringkas</label>
                    <textarea name="deskripsi" rows="2" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">File Foto (Otomatis WebP) *</label>
                    <input type="file" name="foto" required accept="image/*" class="w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700">
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2">
                    <button type="button" @click="modalTambah = false" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-50">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-700 text-white text-xs font-bold hover:bg-emerald-800 shadow">
                        Upload Foto
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Foto -->
    <div x-show="editModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/60 p-4 backdrop-blur-sm" @click.self="editModal = false">
        <div class="w-full max-w-lg bg-white rounded-2xl p-6 shadow-2xl space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="text-base font-bold text-slate-900">Edit Data Galeri Foto</h3>
                <button type="button" @click="editModal = false" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form :action="'{{ url('admin/galeri') }}/' + editData.id" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Judul Foto / Kegiatan *</label>
                    <input type="text" name="judul" x-model="editData.judul" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Kategori</label>
                        <input type="text" name="kategori" x-model="editData.kategori" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Tanggal Kegiatan</label>
                        <input type="date" name="tanggal_kegiatan" :value="editData.tanggal_kegiatan ? editData.tanggal_kegiatan.substring(0,10) : ''" @input="editData.tanggal_kegiatan = $event.target.value" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Deskripsi Ringkas</label>
                    <textarea name="deskripsi" x-model="editData.deskripsi" rows="2" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:border-emerald-600"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Ganti File Foto (Opsional, Otomatis WebP)</label>
                    <input type="file" name="foto" accept="image/*" class="w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700">
                    <p class="text-[10px] text-slate-400 mt-1">Kosongkan bila tidak ingin mengganti file foto yang sudah ada.</p>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2">
                    <button type="button" @click="editModal = false" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-50">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-700 text-white text-xs font-bold hover:bg-emerald-800 shadow">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
