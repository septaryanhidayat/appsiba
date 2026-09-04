<?php

namespace Tests\Feature;

use App\Models\Gallery;
use App\Models\Letter;
use App\Models\Member;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppsiWebTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_public_homepage_renders_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Asosiasi Pedagang Pasar Seluruh Indonesia');
        $response->assertSee('Kabupaten Banyuasin');
    }

    public function test_public_news_page_and_detail_render(): void
    {
        $response = $this->get('/berita');
        $response->assertStatus(200);
        $response->assertSee('Berita & Kabar', false);

        $post = Post::where('status', 'published')->first();
        $this->assertNotNull($post);

        $detailResponse = $this->get('/berita/'.$post->slug);
        $detailResponse->assertStatus(200);
        $detailResponse->assertSee($post->judul, false);
    }

    public function test_public_members_and_organization_and_gallery_render(): void
    {
        $orgResponse = $this->get('/struktur');
        $orgResponse->assertStatus(200);
        $orgResponse->assertSee('H. Gusra Yetri, SH', false);

        $membersResponse = $this->get('/keanggotaan');
        $membersResponse->assertStatus(200);
        $membersResponse->assertSee('Keanggotaan Pedagang', false);

        $regResponse = $this->get('/keanggotaan/daftar');
        $regResponse->assertStatus(200);
        $regResponse->assertSee('Pendaftaran Anggota Pedagang');

        $galleryResponse = $this->get('/galeri');
        $galleryResponse->assertStatus(200);
        $galleryResponse->assertSee('Galeri Dokumentasi', false);
    }

    public function test_letter_verification_works(): void
    {
        $letter = Letter::first();
        $this->assertNotNull($letter);

        $verifyResponse = $this->get('/surat/verifikasi/'.$letter->hash_keabsahan);
        $verifyResponse->assertStatus(200);
        $verifyResponse->assertSee('TERVERIFIKASI', false);
        $verifyResponse->assertSee($letter->nomor_surat, false);
    }

    public function test_admin_dashboard_requires_auth_and_loads(): void
    {
        $guestResponse = $this->get('/admin');
        $guestResponse->assertRedirect('/login');

        $admin = User::first();
        $authResponse = $this->actingAs($admin)->get('/admin');
        $authResponse->assertStatus(200);
        $authResponse->assertSee('Dashboard Eksekutif MIS');
    }

    public function test_new_public_and_admin_pages_render_successfully(): void
    {
        $this->get('/kontak')
            ->assertStatus(200)
            ->assertSee('Hubungi', false)
            ->assertSee('Pengurus DPD APPSI', false);

        $this->get('/program-kerja')
            ->assertStatus(200)
            ->assertSee('5 Pilar Perjuangan', false);

        $this->get('/unduhan')
            ->assertStatus(200)
            ->assertSee('Pusat Unduhan', false);

        $this->get('/faq')
            ->assertStatus(200)
            ->assertSee('Tanya Jawab', false);

        $this->get('/keanggotaan/cek')
            ->assertStatus(200)
            ->assertSee('Cek Keabsahan', false);

        $member = Member::first();
        if ($member) {
            $this->get('/keanggotaan/cek?q='.$member->nomor_anggota)
                ->assertStatus(200)
                ->assertSee('Terverifikasi Resmi', false)
                ->assertSee($member->nama, false);
        }

        $this->get('/verifikasi-surat')
            ->assertStatus(200)
            ->assertSee('Verifikasi Keabsahan', false);

        $admin = User::first();
        $this->actingAs($admin)
            ->get('/admin/anggota/rekap-cetak')
            ->assertStatus(200)
            ->assertSee('REKAPITULASI DATA PEDAGANG PASAR', false);
    }

    public function test_admin_dashboard_has_watermark_and_security_headers(): void
    {
        $admin = User::first();
        $response = $this->actingAs($admin)->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('Beranda Teknologi Digital', false);
        $response->assertSee('https://berandadigital.net', false);

        // Verify HTTP Security Headers
        $response->assertHeader('X-Frame-Options', 'SAMEORIGIN');
        $response->assertHeader('X-Content-Type-Options', 'nosniff');
        $response->assertHeader('X-XSS-Protection', '1; mode=block');
    }

    public function test_gallery_and_letter_crud_operations(): void
    {
        $admin = User::first();

        // 1. Test Letters Edit & Update
        $letter = Letter::first();
        $this->actingAs($admin)
            ->get("/admin/surat-keluar/{$letter->id}/edit")
            ->assertStatus(200)
            ->assertSee($letter->nomor_surat, false);

        $this->actingAs($admin)
            ->put("/admin/surat-keluar/{$letter->id}", [
                'nomor_surat' => $letter->nomor_surat,
                'tanggal' => '2026-09-04',
                'jenis_surat' => $letter->jenis_surat,
                'tujuan' => 'Dinas Perdagangan Kab. Banyuasin',
                'keperluan' => 'Koordinasi Tera Pasar',
                'nama_penandatangan' => 'H. Gusra Yetri, SH',
                'jabatan_penandatangan' => 'Ketua DPD APPSI Banyuasin',
            ])
            ->assertRedirect('/admin/surat-keluar');

        // 2. Test Galleries Index & Update
        $gallery = Gallery::first();
        if ($gallery) {
            $this->actingAs($admin)
                ->put("/admin/galeri/{$gallery->id}", [
                    'judul' => 'Peninjauan Pasar Pangkalan Balai Update',
                    'kategori' => 'Kegiatan',
                    'tanggal_kegiatan' => '2026-09-04',
                    'deskripsi' => 'Deskripsi kegiatan terbaru',
                ])
                ->assertRedirect();
        }
    }

    public function test_contact_page_structure_and_login_button_text(): void
    {
        $response = $this->get('/kontak');
        $response->assertStatus(200);
        $response->assertSee('Hotline WhatsApp', false);
        $response->assertSee('Kantor Sekretariat DPD', false);
        $response->assertSee('Sampaikan Aspirasi & Pesan', false);
        $response->assertSee('Login', false);
        $response->assertDontSee('MIS Admin', false);

        // Test submission of inbox form
        $postResponse = $this->post('/buku-tamu', [
            'nama' => 'Hendra Saputra',
            'telepon' => '081234567890',
            'email' => 'hendra@example.com',
            'instansi' => 'Pedagang Pasar Pangkalan Balai',
            'tujuan' => 'Ketua DPD APPSI Kabupaten Banyuasin',
            'keperluan' => 'Aspirasi & Masukan Pasar',
            'pesan' => 'Mohon penataan lapak pedagang sayur di blok timur agar lebih tertib dan nyaman.',
        ]);

        $postResponse->assertSessionHas('success');
        $this->assertDatabaseHas('inboxes', [
            'nama' => 'Hendra Saputra',
            'telepon' => '081234567890',
        ]);
    }
}
