<?php

namespace Tests\Feature;

use App\Models\DownloadDocument;
use App\Models\Gallery;
use App\Models\Letter;
use App\Models\Member;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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

    public function test_navbar_auth_state_toggle(): void
    {
        // 1. Guest view: Should see Login link, and NOT see Admin link
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee(route('login'), false);
        $response->assertSee('Login', false);
        $response->assertDontSee(route('admin.dashboard'), false);

        // 2. Authenticated view: Should see Admin link, and NOT see Login link
        $admin = User::first();
        $authResponse = $this->actingAs($admin)->get('/');
        $authResponse->assertStatus(200);
        $authResponse->assertSee(route('admin.dashboard'), false);
        $authResponse->assertSee('Admin', false);
        $authResponse->assertDontSee(route('login'), false);
    }

    public function test_public_and_admin_download_documents(): void
    {
        $admin = User::first();
        $doc = DownloadDocument::first();
        $this->assertNotNull($doc);

        // 1. Public unduhan renders list
        $response = $this->get('/unduhan');
        $response->assertStatus(200);
        $response->assertSee($doc->judul, false);

        // 2. Public file download increments download counter
        $initialDownloads = $doc->jumlah_unduhan;
        $downloadResponse = $this->get(route('downloads.file', $doc->id));
        $downloadResponse->assertStatus(200);
        $this->assertEquals($initialDownloads + 1, $doc->fresh()->jumlah_unduhan);

        // 3. Admin download index
        $adminIndex = $this->actingAs($admin)->get(route('admin.downloads.index'));
        $adminIndex->assertStatus(200);
        $adminIndex->assertSee('Pusat Unduhan & Berkas Dokumen');
        $adminIndex->assertSee($doc->judul, false);

        // 4. Admin store new document with fake file
        Storage::fake('public');
        $file = UploadedFile::fake()->create('test-juknis.pdf', 150, 'application/pdf');

        $storeResponse = $this->actingAs($admin)->post(route('admin.downloads.store'), [
            'judul' => 'Petunjuk Teknis Pembinaan Pasar 2026',
            'kategori' => 'Pedoman',
            'deskripsi' => 'Pedoman teknis bagi pengurus komisariat pasar.',
            'berkas' => $file,
            'is_active' => '1',
        ]);

        $storeResponse->assertRedirect(route('admin.downloads.index'));
        $this->assertDatabaseHas('download_documents', [
            'judul' => 'Petunjuk Teknis Pembinaan Pasar 2026',
            'kategori' => 'Pedoman',
        ]);

        $newDoc = DownloadDocument::where('judul', 'Petunjuk Teknis Pembinaan Pasar 2026')->first();
        $this->assertNotNull($newDoc);
        Storage::disk('public')->assertExists($newDoc->file_path);

        // 5. Admin delete document
        $deleteResponse = $this->actingAs($admin)->delete(route('admin.downloads.destroy', $newDoc->id));
        $deleteResponse->assertRedirect(route('admin.downloads.index'));
        $this->assertDatabaseMissing('download_documents', ['id' => $newDoc->id]);
    }
}
