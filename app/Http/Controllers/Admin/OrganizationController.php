<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrganizationStructure;
use App\Services\ImageService;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index(Request $request)
    {
        $query = OrganizationStructure::query();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('nama', 'like', "%{$s}%")
                    ->orWhere('jabatan', 'like', "%{$s}%")
                    ->orWhere('divisi', 'like', "%{$s}%");
            });
        }

        $officials = $query->orderBy('urutan', 'asc')->paginate(15)->withQueryString();

        return view('admin.organization.index', compact('officials'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:100',
            'divisi' => 'nullable|string|max:100',
            'urutan' => 'nullable|integer',
            'periode' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'no_hp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
        ]);

        if (empty($validated['periode'])) {
            $validated['periode'] = '2024 - 2029';
        }

        if (empty($validated['urutan'])) {
            $maxUrutan = OrganizationStructure::max('urutan') ?? 0;
            $validated['urutan'] = $maxUrutan + 1;
        }

        if ($request->hasFile('foto')) {
            $path = ImageService::uploadAndConvertToWebp($request->file('foto'), 'organization');
            $validated['foto'] = $path;
        } else {
            $validated['foto'] = 'assets/images/default-avatar-gray.png';
        }

        OrganizationStructure::create($validated);

        return redirect()->back()->with('success', 'Data pengurus DPD APPSI Banyuasin berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $official = OrganizationStructure::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:100',
            'divisi' => 'nullable|string|max:100',
            'urutan' => 'nullable|integer',
            'periode' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'no_hp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
        ]);

        if ($request->hasFile('foto')) {
            $path = ImageService::uploadAndConvertToWebp($request->file('foto'), 'organization');
            $validated['foto'] = $path;
        }

        $official->update($validated);

        return redirect()->back()->with('success', 'Data pengurus DPD APPSI Banyuasin berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $official = OrganizationStructure::findOrFail($id);
        $official->delete();

        return redirect()->back()->with('success', 'Data pengurus berhasil dihapus.');
    }
}
