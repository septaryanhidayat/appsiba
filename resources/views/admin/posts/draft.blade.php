@extends('layouts.admin')

@section('title', 'Draf Berita')

@section('content')

<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900">Draf Berita & Publikasi</h1>
        <p class="text-xs text-slate-500 mt-1">Daftar artikel yang belum diterbitkan ke portal publik</p>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.posts.publish') }}" class="px-4 py-2.5 rounded-xl text-xs font-bold text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 shadow-sm transition">
            Lihat Berita Terbit
        </a>
        <a href="{{ route('admin.posts.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold text-white bg-emerald-700 hover:bg-emerald-800 shadow-sm transition">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Tulis Berita Baru</span>
        </a>
    </div>
</div>

<div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
            <thead>
                <tr>
                    <th class="p-3.5">Gambar & Judul Artikel</th>
                    <th class="p-3.5">Kategori</th>
                    <th class="p-3.5">Penulis</th>
                    <th class="p-3.5">Terakhir Diubah</th>
                    <th class="p-3.5 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($posts as $p)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-3.5">
                            <span class="font-bold text-slate-900 block text-xs">{{ $p->judul }}</span>
                        </td>
                        <td class="p-3.5">
                            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-slate-100 text-slate-700">
                                {{ $p->kategori }}
                            </span>
                        </td>
                        <td class="p-3.5 text-slate-700 font-medium">{{ $p->penulis }}</td>
                        <td class="p-3.5 text-slate-500 whitespace-nowrap">{{ $p->updated_at ? $p->updated_at->format('d/m/Y H:i') : '-' }}</td>
                        <td class="p-3.5 text-center">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('admin.posts.edit', $p->id) }}" class="px-3 py-1.5 rounded-lg bg-emerald-700 text-white font-bold text-[11px] hover:bg-emerald-800 transition">
                                    Lanjutkan Tulis &rarr;
                                </a>
                                <form action="{{ route('admin.posts.destroy', $p->id) }}" method="POST" onsubmit="return confirmDelete(this, 'Hapus draf artikel berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="h-8 w-8 rounded-lg bg-slate-100 text-slate-500 hover:bg-red-50 hover:text-red-600 flex items-center justify-center transition" title="Hapus">
                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-slate-400">
                            Tidak ada draf artikel tersimpan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-4 border-t border-slate-100">
        {{ $posts->links() }}
    </div>
</div>

@endsection
