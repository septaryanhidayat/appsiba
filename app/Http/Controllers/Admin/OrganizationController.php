<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrganizationStructure;
use App\Services\ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrganizationController extends Controller
{
    /**
     * Display listing of organization members & visual hierarchy chart.
     */
    public function index(Request $request): View
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

        $perPage = (int) $request->get('entries', 25);
        $structures = $query->orderBy('urutan', 'asc')->paginate($perPage)->withQueryString();
        $officials = $structures;
        $tree = OrganizationStructure::getHierarchyTree();

        return view('admin.organization.index', compact('structures', 'officials', 'tree'));
    }

    /**
     * Store new official in organization structure.
     */
    public function store(Request $request): RedirectResponse
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
            $validated['periode'] = '2026 - 2031';
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

    /**
     * Update existing official in organization structure.
     */
    public function update(Request $request, int|string $id): RedirectResponse
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
            if ($official->foto && ! str_starts_with($official->foto, 'assets/')) {
                ImageService::delete($official->foto);
            }
            $path = ImageService::uploadAndConvertToWebp($request->file('foto'), 'organization');
            $validated['foto'] = $path;
        }

        $official->update($validated);

        return redirect()->back()->with('success', 'Data pengurus DPD APPSI Banyuasin berhasil diperbarui.');
    }

    /**
     * Remove official from organization structure.
     */
    public function destroy(int|string $id): RedirectResponse
    {
        $official = OrganizationStructure::findOrFail($id);
        if ($official->foto && ! str_starts_with($official->foto, 'assets/')) {
            ImageService::delete($official->foto);
        }
        $official->delete();

        return redirect()->back()->with('success', 'Data pengurus berhasil dihapus.');
    }
}
