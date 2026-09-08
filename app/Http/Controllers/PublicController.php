<?php

namespace App\Http\Controllers;

use App\Models\DownloadDocument;
use App\Models\Gallery;
use App\Models\Inbox;
use App\Models\Letter;
use App\Models\Meeting;
use App\Models\Member;
use App\Models\MemberRegistration;
use App\Models\OrganizationStructure;
use App\Models\Post;
use App\Models\Setting;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;

class PublicController extends Controller
{
    /**
     * Halaman Utama / Beranda APPSI Banyuasin
     */
    public function index()
    {
        $posts = Post::where('status', 'published')
            ->latest('published_at')
            ->take(6)
            ->get();

        $meetings = Meeting::latest('tanggal')
            ->take(2)
            ->get();

        $galleries = Gallery::latest('tanggal_kegiatan')
            ->take(8)
            ->get();

        $gallerySlides = $galleries->isNotEmpty()
            ? $galleries->map(function ($g) {
                return [
                    'title' => $g->judul,
                    'category' => $g->kategori ?? 'Dokumentasi Pasar',
                    'image' => $g->foto_url,
                    'desc' => $g->deskripsi ?? 'Dokumentasi kegiatan resmi pendampingan dan kemitraan pasar APPSI Banyuasin.',
                ];
            })->values()->all()
            : [
                [
                    'title' => 'Sosialisasi Digitalisasi QRIS di Pasar Pangkalan Balai',
                    'category' => 'Digitalisasi Pasar',
                    'image' => asset('assets/images/berita/berita-qris-digital.webp'),
                    'desc' => 'Edukasi dan pendampingan transaksi non-tunai bersama perbankan daerah bagi pedagang sayur dan sembako.',
                ],
                [
                    'title' => 'Operasi Pasar Pangan Murah Sembako di Betung',
                    'category' => 'Stabilisasi Harga',
                    'image' => asset('assets/images/berita/berita-operasi-pasar.webp'),
                    'desc' => 'Distribusi beras medium dan minyak goreng terjangkau untuk menekan laju inflasi bahan pokok masyarakat.',
                ],
                [
                    'title' => 'Pengawasan Tera Ulang Timbangan Pasar Pangkalan Balai',
                    'category' => 'Tera Timbangan',
                    'image' => asset('assets/images/berita/kegiatan-timbangan-tera.webp'),
                    'desc' => 'Kerjasama DPD APPSI dan Dinas Perindagkop memastikan keakuratan timbangan pedagang demi jual beli yang jujur.',
                ],
                [
                    'title' => 'Pelatihan Pembukuan & Literasi Keuangan Pedagang Wanita',
                    'category' => 'Pemberdayaan UMKM',
                    'image' => asset('assets/images/berita/kegiatan-pelatihan-wanita.webp'),
                    'desc' => 'Peningkatan kapasitas pengelolaan arus kas dan literasi perbankan formal bagi pedagang pasar perempuan.',
                ],
            ];

        $stats = [
            'total_anggota' => Member::where('status', 'aktif')->count(),
            'total_pasar' => Member::distinct('lokasi_pasar')->count('lokasi_pasar') ?: 5,
            'total_komoditas' => Member::distinct('jenis_usaha')->count('jenis_usaha') ?: 7,
            'total_berita' => Post::where('status', 'published')->count(),
        ];

        $ketua = OrganizationStructure::where('jabatan', 'like', '%Ketua%')->first();

        return view('public.home', compact('posts', 'meetings', 'galleries', 'gallerySlides', 'stats', 'ketua'));
    }

    /**
     * Struktur Organisasi DPD APPSI Banyuasin (SK DPW APPSI No: 012/SK/DPW-APPSI/VI/2026)
     */
    public function struktur()
    {
        $structures = OrganizationStructure::orderBy('urutan', 'asc')->get();
        $tree = OrganizationStructure::getHierarchyTree();

        return view('public.struktur', compact('structures', 'tree'));
    }

    /**
     * Berita & Kabar Pasar
     */
    public function berita(Request $request)
    {
        $query = Post::where('status', 'published');

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('ringkasan', 'like', "%{$search}%")
                    ->orWhere('konten', 'like', "%{$search}%");
            });
        }

        $posts = $query->latest('published_at')->paginate(9)->withQueryString();
        $categories = Post::where('status', 'published')->distinct()->pluck('kategori');

        return view('public.berita.index', compact('posts', 'categories'));
    }

    /**
     * Detail Berita Pasar
     */
    public function beritaDetail($slug)
    {
        $post = Post::where('slug', $slug)->where('status', 'published')->firstOrFail();
        $post->increment('views_count');

        $relatedPosts = Post::where('status', 'published')
            ->where('id', '!=', $post->id)
            ->where('kategori', $post->kategori)
            ->latest('published_at')
            ->take(3)
            ->get();

        if ($relatedPosts->isEmpty()) {
            $relatedPosts = Post::where('status', 'published')
                ->where('id', '!=', $post->id)
                ->latest('published_at')
                ->take(3)
                ->get();
        }

        return view('public.berita.detail', compact('post', 'relatedPosts'));
    }

    /**
     * Galeri Kegiatan Pasar
     */
    public function galeri(Request $request)
    {
        $query = Gallery::query();

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where('judul', 'like', "%{$search}%")
                ->orWhere('deskripsi', 'like', "%{$search}%");
        }

        $galleries = $query->latest('tanggal_kegiatan')->paginate(12)->withQueryString();
        $categories = Gallery::distinct()->pluck('kategori');

        return view('public.galeri', compact('galleries', 'categories'));
    }

    /**
     * Direktori Keanggotaan Pedagang Pasar APPSI Banyuasin
     */
    public function keanggotaan(Request $request)
    {
        $query = Member::where('status', 'aktif');

        if ($request->filled('jenis_usaha')) {
            $query->where('jenis_usaha', $request->jenis_usaha);
        }

        if ($request->filled('lokasi_pasar')) {
            $query->where('lokasi_pasar', $request->lokasi_pasar);
        }

        if ($request->filled('bentuk_usaha')) {
            $query->where('bentuk_usaha', $request->bentuk_usaha);
        }

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nama_usaha', 'like', "%{$search}%")
                    ->orWhere('nomor_anggota', 'like', "%{$search}%");
            });
        }

        $members = $query->orderBy('nama', 'asc')->paginate(12)->withQueryString();

        $commodities = Member::distinct()->pluck('jenis_usaha');
        $markets = Member::distinct()->pluck('lokasi_pasar');

        return view('public.keanggotaan.index', compact('members', 'commodities', 'markets'));
    }

    /**
     * Formulir Pendaftaran Anggota Pedagang Baru Online
     */
    public function daftarKeanggotaan()
    {
        $markets = [
            'Pasar Pangkalan Balai (Banyuasin III)',
            'Pasar Betung',
            'Pasar Mariana (Banyuasin I)',
            'Pasar Sungsang (Banyuasin II)',
            'Pasar Sukajadi (Talang Kelapa)',
            'Pasar Makarti Jaya',
            'Pasar Muara Telang',
            'Pasar Sungai Lilin / Banyuasin',
            'Pasar Rambutan',
            'Pasar Tradisional Lainnya di Kab. Banyuasin',
        ];

        $commodities = [
            'Sembako & Kebutuhan Pokok',
            'Sayur, Buah & Hasil Bumi',
            'Daging, Unggas & Ikan Segar',
            'Pakaian, Konveksi & Tekstil',
            'Kuliner & Jajanan Tradisional',
            'Kelontong & Aneka Plastik',
            'Elektronik, Servis & Aneka Jasa',
            'Perhiasan, Emas & Aksesoris',
            'Lain-lain / Serba Usaha',
        ];

        return view('public.keanggotaan.daftar', compact('markets', 'commodities'));
    }

    /**
     * Simpan Pendaftaran Anggota Pedagang Baru
     */
    public function storeDaftarKeanggotaan(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'no_hp' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'nama_usaha' => 'required|string|max:255',
            'jenis_usaha' => 'required|string|max:255',
            'bentuk_usaha' => 'required|string|max:100',
            'lokasi_pasar' => 'required|string|max:255',
            'blok_nomor' => 'nullable|string|max:100',
            'alamat_domisili' => 'required|string',
            'foto_ktp' => 'nullable|image|max:3072',
            'foto_usaha' => 'nullable|image|max:3072',
        ]);

        $fotoKtpPath = null;
        if ($request->hasFile('foto_ktp')) {
            $fotoKtpPath = ImageService::uploadAndConvertToWebp($request->file('foto_ktp'), 'registrations/ktp', 'public', 82, 1200);
        }

        $fotoUsahaPath = null;
        if ($request->hasFile('foto_usaha')) {
            $fotoUsahaPath = ImageService::uploadAndConvertToWebp($request->file('foto_usaha'), 'registrations/usaha', 'public', 82, 1200);
        }

        MemberRegistration::create([
            'nama' => strip_tags($validated['nama']),
            'nik' => strip_tags($validated['nik']),
            'no_hp' => strip_tags($validated['no_hp']),
            'email' => $validated['email'] ? strip_tags($validated['email']) : null,
            'nama_usaha' => strip_tags($validated['nama_usaha']),
            'jenis_usaha' => strip_tags($validated['jenis_usaha']),
            'bentuk_usaha' => strip_tags($validated['bentuk_usaha']),
            'lokasi_pasar' => strip_tags($validated['lokasi_pasar']),
            'blok_nomor' => $validated['blok_nomor'] ? strip_tags($validated['blok_nomor']) : null,
            'alamat_domisili' => strip_tags($validated['alamat_domisili']),
            'foto_ktp' => $fotoKtpPath,
            'foto_usaha' => $fotoUsahaPath,
            'status' => 'menunggu_verifikasi',
        ]);

        return back()->with('success', 'Terima kasih! Formulir pendaftaran keanggotaan APPSI Kabupaten Banyuasin berhasil terkirim. Pengurus DPD akan memverifikasi data Anda.');
    }

    /**
     * Tentang Kami / Profil APPSI Banyuasin
     */
    public function tentangKami()
    {
        $settings = Setting::pluck('value', 'key');
        $ketua = OrganizationStructure::where('jabatan', 'like', '%Ketua%')->first();

        return view('public.tentang-kami', compact('settings', 'ketua'));
    }

    /**
     * Buku Tamu & Aspirasi Publik / Pedagang
     */
    public function storeBukuTamu(Request $request)
    {
        $key = 'inbox-submit:'.$request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            return back()->with('error', "Terlalu banyak pesan terkirim. Silakan tunggu {$seconds} detik lagi.")->withInput();
        }
        RateLimiter::hit($key, 120);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'instansi' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:255',
            'tujuan' => 'required|string|max:255',
            'keperluan' => 'required|string|max:255',
            'pesan' => 'required|string|max:2000',
        ]);

        Inbox::create([
            'tanggal' => now(),
            'nama' => strip_tags($validated['nama']),
            'instansi' => $validated['instansi'] ? strip_tags($validated['instansi']) : 'Pedagang / Masyarakat',
            'email' => $validated['email'] ? strip_tags($validated['email']) : null,
            'telepon' => $validated['telepon'] ? strip_tags($validated['telepon']) : null,
            'tujuan' => strip_tags($validated['tujuan']),
            'keperluan' => strip_tags($validated['keperluan']),
            'pesan' => strip_tags($validated['pesan']),
            'status' => 'baru',
        ]);

        return back()->with('success', 'Pesan aspirasi Anda telah berhasil terkirim kepada Pengurus DPD APPSI Kabupaten Banyuasin.');
    }

    /**
     * Halaman Kontak & Layanan Sekretariat
     */
    public function kontak()
    {
        $settings = Setting::pluck('value', 'key');
        $ketua = OrganizationStructure::where('jabatan', 'like', '%Ketua%')->first();

        return view('public.kontak', compact('settings', 'ketua'));
    }

    /**
     * Halaman Program Kerja & 5 Pilar Unggulan APPSI Banyuasin
     */
    public function programKerja()
    {
        return view('public.program-kerja');
    }

    /**
     * Halaman Pusat Unduhan Dokumen & Formulir Publik
     */
    public function unduhan(Request $request)
    {
        $query = DownloadDocument::where('is_aktif', true);

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $allDocuments = $query->orderBy('urutan', 'asc')->get();
        $groupedDocuments = $allDocuments->groupBy('kategori');

        return view('public.unduhan', compact('groupedDocuments', 'allDocuments'));
    }

    /**
     * Unduh Berkas Dokumen Publik Nyata (Bukan Demo)
     */
    public function downloadDocument($id)
    {
        $document = DownloadDocument::where('is_aktif', true)->findOrFail($id);

        if (! Storage::disk('public')->exists($document->file_path)) {
            return back()->with('error', 'Berkas dokumen belum tersedia di server.');
        }

        $document->increment('jumlah_unduhan');

        return Storage::disk('public')->download($document->file_path, $document->nama_file);
    }

    /**
     * Halaman Tanya Jawab / FAQ Seputar APPSI
     */
    public function faq()
    {
        return view('public.faq');
    }

    /**
     * Cek Status Keabsahan KTA Pedagang Mandiri
     */
    public function cekKta(Request $request)
    {
        $member = null;
        $searched = false;

        if ($request->filled('q')) {
            $searched = true;
            $query = trim($request->q);
            $member = Member::where('nomor_anggota', $query)
                ->orWhere('nik', $query)
                ->first();
        }

        return view('public.keanggotaan.cek', compact('member', 'searched'));
    }

    /**
     * Verifikasi Surat / Dokumen Resmi via QR Code atau Nomor Surat
     */
    public function verifikasiSurat(Request $request, ?string $hash = null)
    {
        $searchKey = $hash ?: $request->input('q');
        $letter = null;

        if ($searchKey) {
            $cleanKey = trim($searchKey);
            $letter = Letter::where('hash_keabsahan', $cleanKey)
                ->orWhere('uuid', $cleanKey)
                ->orWhere('nomor_surat', $cleanKey)
                ->orWhere('nomor_surat', 'like', "%{$cleanKey}%")
                ->orWhere('id', $cleanKey)
                ->first();
        }

        return view('public.surat.verifikasi', [
            'letter' => $letter,
            'hash' => $searchKey,
        ]);
    }
}
