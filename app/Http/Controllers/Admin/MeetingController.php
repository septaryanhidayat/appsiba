<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use App\Models\Member;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function index(Request $request)
    {
        $query = Meeting::query();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('judul_rapat', 'like', "%{$s}%")
                    ->orWhere('tempat', 'like', "%{$s}%")
                    ->orWhere('pimpinan_rapat', 'like', "%{$s}%")
                    ->orWhere('agenda', 'like', "%{$s}%");
            });
        }

        $meetings = $query->latest('tanggal')->paginate(15)->withQueryString();

        return view('admin.meetings.index', compact('meetings'));
    }

    public function create()
    {
        $members = Member::where('status', 'aktif')->orderBy('nama')->get();
        return view('admin.meetings.create', compact('members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_rapat' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'nullable',
            'tempat' => 'required|string|max:255',
            'pimpinan_rapat' => 'required|string|max:255',
            'notulis' => 'required|string|max:255',
            'agenda' => 'required|string',
            'pembahasan' => 'nullable|string',
            'keputusan' => 'nullable|string',
            'jumlah_hadir' => 'nullable|integer',
            'daftar_hadir' => 'nullable|string',
            'status' => 'required|in:terjadwal,berlangsung,selesai',
        ]);

        Meeting::create($validated);

        return redirect()->route('admin.meetings.index')->with('success', 'Agenda dan notulen rapat berhasil dicatat.');
    }

    public function show(Meeting $meeting)
    {
        return view('admin.meetings.show', compact('meeting'));
    }

    public function edit(Meeting $meeting)
    {
        $members = Member::where('status', 'aktif')->orderBy('nama')->get();
        return view('admin.meetings.edit', compact('meeting', 'members'));
    }

    public function update(Request $request, Meeting $meeting)
    {
        $validated = $request->validate([
            'judul_rapat' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'nullable',
            'tempat' => 'required|string|max:255',
            'pimpinan_rapat' => 'required|string|max:255',
            'notulis' => 'required|string|max:255',
            'agenda' => 'required|string',
            'pembahasan' => 'nullable|string',
            'keputusan' => 'nullable|string',
            'jumlah_hadir' => 'nullable|integer',
            'daftar_hadir' => 'nullable|string',
            'status' => 'required|in:terjadwal,berlangsung,selesai',
        ]);

        $meeting->update($validated);

        return redirect()->route('admin.meetings.index')->with('success', 'Agenda dan notulen rapat berhasil diperbarui.');
    }

    public function destroy(Meeting $meeting)
    {
        $meeting->delete();
        return redirect()->route('admin.meetings.index')->with('success', 'Catatan notulen rapat berhasil dihapus.');
    }
}
