<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Inbox;
use App\Models\IncomingLetter;
use App\Models\Letter;
use App\Models\Meeting;
use App\Models\Member;
use App\Models\MemberRegistration;
use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_anggota' => Member::count(),
            'anggota_aktif' => Member::where('status', 'aktif')->count(),
            'pendaftaran_baru' => MemberRegistration::where('status', 'menunggu_verifikasi')->count(),
            'total_pasar' => Member::distinct('lokasi_pasar')->count('lokasi_pasar') ?: 5,
            'total_komoditas' => Member::distinct('jenis_usaha')->count('jenis_usaha') ?: 7,
            'total_berita' => Post::count(),
            'total_galeri' => Gallery::count(),
            'total_surat_keluar' => Letter::count(),
            'total_surat_masuk' => IncomingLetter::count(),
            'total_rapat' => Meeting::count(),
            'pesan_baru' => Inbox::where('status', 'baru')->count(),
        ];

        $recentMembers = Member::latest()->take(5)->get();
        $recentRegistrations = MemberRegistration::latest()->take(5)->get();
        $recentLetters = Letter::latest('tanggal')->take(5)->get();
        $recentInboxes = Inbox::latest('tanggal')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentMembers', 'recentRegistrations', 'recentLetters', 'recentInboxes'));
    }
}
