@extends('layouts.admin')

@section('title', 'Tulis Berita Baru')

@section('content')

<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900">Tulis Berita & Publikasi Baru</h1>
        <p class="text-xs text-slate-500 mt-1">Publikasi warta kegiatan DPD APPSI Banyuasin ke portal publik</p>
    </div>
    <a href="{{ route('admin.posts.publish') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-emerald-700">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Berita
    </a>
</div>

<div class="max-w-4xl bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 shadow-sm">
    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Judul Artikel Berita *</label>
            <input type="text" name="judul" required value="{{ old('judul') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none" placeholder="Masukkan judul berita yang menarik...">
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Kategori Berita *</label>
                <select name="kategori" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none bg-white">
                    <option value="Kegiatan">Kegiatan Organisasi</option>
                    <option value="Pasar Daerah">Info Pasar Daerah</option>
                    <option value="Harga Komoditas">Harga Pangan & Komoditas</option>
                    <option value="Advokasi & Kebijakan">Advokasi & Kebijakan</option>
                    <option value="UMKM & Kemitraan">UMKM & Kemitraan</option>
                    <option value="Bakti Sosial">Bakti Sosial Pedagang</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Penulis / Jurnalis *</label>
                <input type="text" name="penulis" required value="{{ old('penulis', auth()->user()->name ?? 'Humas APPSI Banyuasin') }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Ringkasan Artikel (Lead / Excerpt)</label>
            <textarea name="ringkasan" rows="2" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none" placeholder="1-2 kalimat ringkasan yang muncul di kartu berita...">{{ old('ringkasan') }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1 flex items-center justify-between">
                <span>Isi Konten Berita Lengkap *</span>
                <span class="text-[11px] font-normal text-slate-400">Dukungan format paragraf, tebal, miring, perataan & poin</span>
            </label>
            <textarea name="konten" id="konten" rows="12" class="rich-editor w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none" placeholder="Tuliskan naskah berita lengkap di sini...">{{ old('konten') }}</textarea>
        </div>

        <div class="grid sm:grid-cols-2 gap-4 items-center">
            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Foto Utama Berita (Otomatis WebP)</label>
                <input type="file" name="gambar" accept="image/*" class="w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Status Terbit *</label>
                <select name="status" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none bg-white">
                    <option value="published">Langsung Terbitkan (Published)</option>
                    <option value="draft">Simpan Sebagai Draf</option>
                </select>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.posts.publish') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 text-xs font-bold hover:bg-slate-50 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-700 text-white text-xs font-bold hover:bg-emerald-800 transition shadow">
                Simpan & Publikasikan
            </button>
        </div>

    </form>
</div>

@endsection
