<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IncomingLetter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IncomingLetterController extends Controller
{
    public function index(Request $request)
    {
        $query = IncomingLetter::query();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('nomor_surat', 'like', "%{$s}%")
                    ->orWhere('pengirim', 'like', "%{$s}%")
                    ->orWhere('perihal', 'like', "%{$s}%");
            });
        }

        $entries = (int) $request->get('entries', 10);
        $letters = $query->latest('tanggal_terima')->latest('id')->paginate($entries);

        return view('admin.incoming-letters.index', compact('letters'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:100',
            'tanggal_surat' => 'required|date',
            'tanggal_terima' => 'nullable|date',
            'tanggal_diterima' => 'nullable|date',
            'pengirim' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'isi_ringkas' => 'nullable|string',
            'disposisi' => 'nullable|string|max:100',
            'status_disposisi' => 'nullable|string|max:100',
            'status' => 'nullable|string|in:baru,diproses,selesai',
            'file_lampiran' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png,webp|max:10240',
        ]);

        $data = [
            'nomor_surat' => $validated['nomor_surat'],
            'tanggal_surat' => $validated['tanggal_surat'],
            'tanggal_terima' => $validated['tanggal_terima'] ?? $validated['tanggal_diterima'] ?? now()->toDateString(),
            'pengirim' => $validated['pengirim'],
            'perihal' => $validated['perihal'],
            'keterangan' => $validated['keterangan'] ?? $validated['isi_ringkas'] ?? null,
            'disposisi' => $validated['disposisi'] ?? $validated['status_disposisi'] ?? 'Diteruskan ke Ketua DPD',
            'status' => $validated['status'] ?? 'baru',
        ];

        if ($request->hasFile('file_lampiran')) {
            $data['file_lampiran'] = $request->file('file_lampiran')->store('incoming_letters', 'public');
        }

        IncomingLetter::create($data);

        return redirect()->route('admin.incoming-letters.index')->with('success', 'Surat masuk berhasil dicatat ke dalam sistem.');
    }

    public function update(Request $request, $id)
    {
        $letter = IncomingLetter::findOrFail($id);

        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:100',
            'tanggal_surat' => 'required|date',
            'tanggal_terima' => 'nullable|date',
            'tanggal_diterima' => 'nullable|date',
            'pengirim' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'isi_ringkas' => 'nullable|string',
            'disposisi' => 'nullable|string|max:100',
            'status_disposisi' => 'nullable|string|max:100',
            'status' => 'nullable|string|in:baru,diproses,selesai',
            'file_lampiran' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png,webp|max:10240',
        ]);

        $data = [
            'nomor_surat' => $validated['nomor_surat'],
            'tanggal_surat' => $validated['tanggal_surat'],
            'tanggal_terima' => $validated['tanggal_terima'] ?? $validated['tanggal_diterima'] ?? $letter->tanggal_terima,
            'pengirim' => $validated['pengirim'],
            'perihal' => $validated['perihal'],
            'keterangan' => $validated['keterangan'] ?? $validated['isi_ringkas'] ?? $letter->keterangan,
            'disposisi' => $validated['disposisi'] ?? $validated['status_disposisi'] ?? $letter->disposisi,
            'status' => $validated['status'] ?? $letter->status,
        ];

        if ($request->hasFile('file_lampiran')) {
            if ($letter->file_lampiran && Storage::disk('public')->exists($letter->file_lampiran)) {
                Storage::disk('public')->delete($letter->file_lampiran);
            }
            $data['file_lampiran'] = $request->file('file_lampiran')->store('incoming_letters', 'public');
        }

        $letter->update($data);

        return redirect()->route('admin.incoming-letters.index')->with('success', 'Data surat masuk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $letter = IncomingLetter::findOrFail($id);
        if ($letter->file_lampiran && Storage::disk('public')->exists($letter->file_lampiran)) {
            Storage::disk('public')->delete($letter->file_lampiran);
        }
        $letter->delete();

        return redirect()->route('admin.incoming-letters.index')->with('success', 'Surat masuk berhasil dihapus.');
    }
}
