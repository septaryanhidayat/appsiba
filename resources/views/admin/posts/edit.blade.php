@extends('layouts.admin')

@section('title', 'Edit Berita - ' . $post->judul)

@section('content')

<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900">Edit Artikel Berita</h1>
        <p class="text-xs text-slate-500 mt-1">Perbarui isi warta atau ganti gambar publikasi</p>
    </div>
    <a href="{{ route('admin.posts.publish') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-emerald-700">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Berita
    </a>
</div>

<div class="max-w-4xl bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 shadow-sm">
    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Judul Artikel Berita *</label>
            <input type="text" name="judul" required value="{{ old('judul', $post->judul) }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none">
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Kategori Berita *</label>
                <select name="kategori" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none bg-white">
                    <option value="Kegiatan" {{ $post->kategori == 'Kegiatan' ? 'selected' : '' }}>Kegiatan Organisasi</option>
                    <option value="Pasar Daerah" {{ $post->kategori == 'Pasar Daerah' ? 'selected' : '' }}>Info Pasar Daerah</option>
                    <option value="Harga Komoditas" {{ $post->kategori == 'Harga Komoditas' ? 'selected' : '' }}>Harga Pangan & Komoditas</option>
                    <option value="Advokasi & Kebijakan" {{ $post->kategori == 'Advokasi & Kebijakan' ? 'selected' : '' }}>Advokasi & Kebijakan</option>
                    <option value="UMKM & Kemitraan" {{ $post->kategori == 'UMKM & Kemitraan' ? 'selected' : '' }}>UMKM & Kemitraan</option>
                    <option value="Bakti Sosial" {{ $post->kategori == 'Bakti Sosial' ? 'selected' : '' }}>Bakti Sosial Pedagang</option>
                    <option value="Deklarasi" {{ $post->kategori == 'Deklarasi' ? 'selected' : '' }}>Deklarasi & Pelantikan</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Penulis / Jurnalis *</label>
                <input type="text" name="penulis" required value="{{ old('penulis', $post->penulis) }}" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Ringkasan Artikel</label>
            <textarea name="ringkasan" rows="2" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-emerald-600 focus:outline-none">{{ old('ringkasan', $post->ringkasan) }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1 flex items-center justify-between">
                <span>Isi Konten Berita Lengkap *</span>
                <span class="text-[11px] font-normal text-slate-400">Dukungan format paragraf, tebal, miring, perataan & poin</span>
            </label>
            <textarea name="konten" id="konten" rows="12" class="rich-editor w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none">{{ old('konten', $post->konten) }}</textarea>
        </div>

        <div class="grid sm:grid-cols-2 gap-4 items-center">
            <div class="flex items-center gap-3">
                <div class="w-14 h-14 rounded-xl overflow-hidden bg-slate-100 shrink-0 border border-slate-200">
                    <img src="{{ $post->gambar_url }}" alt="" class="w-full h-full object-cover">
                </div>
                <div class="flex-1">
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Ganti Foto Berita</label>
                    <input type="file" name="gambar" accept="image/*" class="w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Status Terbit *</label>
                <select name="status" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-emerald-600 focus:outline-none bg-white">
                    <option value="published" {{ $post->status == 'published' ? 'selected' : '' }}>Diterbitkan (Published)</option>
                    <option value="draft" {{ $post->status == 'draft' ? 'selected' : '' }}>Draf</option>
                </select>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.posts.publish') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 text-xs font-bold hover:bg-slate-50 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-700 text-white text-xs font-bold hover:bg-emerald-800 transition shadow">
                Perbarui Berita
            </button>
        </div>

    </form>
</div>

@endsection
