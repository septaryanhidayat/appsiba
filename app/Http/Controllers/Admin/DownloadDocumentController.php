<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DownloadDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DownloadDocumentController extends Controller
{
    /**
     * Tampilkan Daftar Dokumen Unduhan
     */
    public function index(Request $request)
    {
        $query = DownloadDocument::query();

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $documents = $query->orderBy('urutan', 'asc')->latest()->paginate(15)->withQueryString();

        $stats = [
            'total_dokumen' => DownloadDocument::count(),
            'total_unduhan' => DownloadDocument::sum('jumlah_unduhan'),
            'total_aktif' => DownloadDocument::where('is_aktif', true)->count(),
        ];

        $categories = DownloadDocument::distinct('kategori')->pluck('kategori');

        return view('admin.downloads.index', compact('documents', 'stats', 'categories'));
    }

    /**
     * Simpan Dokumen Unduhan Baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'deskripsi' => 'nullable|string|max:1000',
            'berkas' => 'required|file|max:25600|mimes:pdf,docx,doc,xlsx,xls,zip,rar,png,jpg,jpeg',
            'urutan' => 'nullable|integer',
        ]);

        $file = $request->file('berkas');
        $originalName = $file->getClientOriginalName();
        $extension = strtolower($file->getClientOriginalExtension());
        $fileSizeBytes = $file->getSize();

        $ukuranFile = $fileSizeBytes >= 1048576
            ? round($fileSizeBytes / 1048576, 2).' MB'
            : max(1, round($fileSizeBytes / 1024)).' KB';

        $safeName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME)).'-'.time().'.'.$extension;
        $filePath = $file->storeAs('downloads', $safeName, 'public');

        DownloadDocument::create([
            'judul' => strip_tags($validated['judul']),
            'kategori' => strip_tags($validated['kategori']),
            'deskripsi' => $validated['deskripsi'] ? strip_tags($validated['deskripsi']) : null,
            'file_path' => $filePath,
            'nama_file' => $originalName,
            'tipe_file' => $extension,
            'ukuran_file' => $ukuranFile,
            'jumlah_unduhan' => 0,
            'is_aktif' => true,
            'urutan' => $validated['urutan'] ?? (DownloadDocument::max('urutan') + 1),
        ]);

        return back()->with('success', 'Dokumen unduhan resmi berhasil ditambahkan.');
    }

    /**
     * Perbarui Data Dokumen Unduhan
     */
    public function update(Request $request, $id)
    {
        $document = DownloadDocument::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'deskripsi' => 'nullable|string|max:1000',
            'berkas' => 'nullable|file|max:25600|mimes:pdf,docx,doc,xlsx,xls,zip,rar,png,jpg,jpeg',
            'is_aktif' => 'nullable|boolean',
            'urutan' => 'nullable|integer',
        ]);

        $updateData = [
            'judul' => strip_tags($validated['judul']),
            'kategori' => strip_tags($validated['kategori']),
            'deskripsi' => $validated['deskripsi'] ? strip_tags($validated['deskripsi']) : null,
            'is_aktif' => $request->has('is_aktif') ? (bool) $request->is_aktif : true,
            'urutan' => $validated['urutan'] ?? $document->urutan,
        ];

        if ($request->hasFile('berkas')) {
            // Hapus file lama jika ada
            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }

            $file = $request->file('berkas');
            $originalName = $file->getClientOriginalName();
            $extension = strtolower($file->getClientOriginalExtension());
            $fileSizeBytes = $file->getSize();

            $ukuranFile = $fileSizeBytes >= 1048576
                ? round($fileSizeBytes / 1048576, 2).' MB'
                : max(1, round($fileSizeBytes / 1024)).' KB';

            $safeName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME)).'-'.time().'.'.$extension;
            $filePath = $file->storeAs('downloads', $safeName, 'public');

            $updateData['file_path'] = $filePath;
            $updateData['nama_file'] = $originalName;
            $updateData['tipe_file'] = $extension;
            $updateData['ukuran_file'] = $ukuranFile;
        }

        $document->update($updateData);

        return back()->with('success', 'Dokumen unduhan berhasil diperbarui.');
    }

    /**
     * Hapus Dokumen Unduhan
     */
    public function destroy($id)
    {
        $document = DownloadDocument::findOrFail($id);

        if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return back()->with('success', 'Dokumen unduhan berhasil dihapus.');
    }

    /**
     * Download Berkas dari Sisi Admin
     */
    public function download($id)
    {
        $document = DownloadDocument::findOrFail($id);

        if (! Storage::disk('public')->exists($document->file_path)) {
            return back()->with('error', 'Berkas dokumen tidak ditemukan di server.');
        }

        return Storage::disk('public')->download($document->file_path, $document->nama_file);
    }
}
