<?php

namespace Tests\Feature;

use App\Models\DownloadDocument;
use App\Models\Gallery;
use App\Models\IncomingLetter;
use App\Models\Letter;
use App\Models\Meeting;
use App\Models\Member;
use App\Models\OrganizationStructure;
use App\Models\Post;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
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

    public function test_letter_print_has_single_qr_code(): void
    {
        $admin = User::first();
        $letter = Letter::first();
        $this->assertNotNull($letter);

        $response = $this->actingAs($admin)->get(route('admin.letters.print', $letter->id));
        $response->assertStatus(200);

        // Assert exactly 1 QR code is rendered in the letter
        $html = $response->getContent();
        $qrCodeCount = substr_count($html, 'api.qrserver.com/v1/create-qr-code');
        $this->assertEquals(1, $qrCodeCount, 'Letter must contain exactly 1 verifiable QR code');
    }

    public function test_member_directory_visibility_toggle_and_public_display(): void
    {
        $admin = User::first();
        $member = Member::first();
        $this->assertNotNull($member);

        // 1. Initial State: tampilkan_daftar_anggota = '1' (Tampil)
        Setting::set('tampilkan_daftar_anggota', '1');
        Cache::forget('web_settings_global');

        $publicResponse = $this->get(route('members.public'));
        $publicResponse->assertStatus(200);
        $publicResponse->assertSee($member->nama, false);
        $publicResponse->assertSee('Daftar Pedagang Baru');
        $publicResponse->assertSee('Cek Status KTA Anda');

        // 2. Toggle to Hidden: POST /admin/anggota/toggle-visibilitas
        $toggleResponse = $this->actingAs($admin)->post(route('admin.members.toggle-visibility'));
        $toggleResponse->assertSessionHas('success');
        $this->assertEquals('0', Setting::get('tampilkan_daftar_anggota'));

        // 3. Public view when hidden: Menu Keanggotaan still exists in navbar
        $homeResponse = $this->get('/');
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee(route('members.public'), false);
        $homeResponse->assertSee('Keanggotaan', false);

        // 4. Public /keanggotaan page shows protected notice and keeps Daftar & Cek KTA accessible
        $hiddenPublic = $this->get(route('members.public'));
        $hiddenPublic->assertStatus(200);
        $hiddenPublic->assertSee('Pangkalan Data Direktori Anggota Terproteksi', false);
        $hiddenPublic->assertSee('Daftar Pedagang Baru');
        $hiddenPublic->assertSee('Cek Status KTA Anda');
        $hiddenPublic->assertDontSee($member->nama, false);

        // 5. Toggle back to Visible via Settings Controller
        $settingsUpdate = $this->actingAs($admin)->put(route('admin.settings.update'), [
            'nama_organisasi' => Setting::get('nama_organisasi'),
            'singkatan' => Setting::get('singkatan'),
            'alamat' => Setting::get('alamat'),
            'telepon' => Setting::get('telepon'),
            'nama_ketua' => Setting::get('nama_ketua'),
            'jabatan_ketua' => Setting::get('jabatan_ketua'),
            'nama_sekretaris' => Setting::get('nama_sekretaris'),
            'jabatan_sekretaris' => Setting::get('jabatan_sekretaris'),
            'tampilkan_daftar_anggota' => '1',
        ]);
        $settingsUpdate->assertSessionHas('success');
        $this->assertEquals('1', Setting::get('tampilkan_daftar_anggota'));
    }

    public function test_all_modules_crud_operations(): void
    {
        $admin = User::first();

        // 1. Member CRUD
        $memberStore = $this->actingAs($admin)->post(route('admin.members.store'), [
            'nama' => 'H. Bambang Sugiarto',
            'nomor_anggota' => 'DPD-BA-01.9999',
            'nama_usaha' => 'Toko Kelontong Berkah Jaya',
            'jenis_usaha' => 'Sembako & Kebutuhan Pokok',
            'bentuk_usaha' => 'Kios Tetap',
            'lokasi_pasar' => 'Pasar Pangkalan Balai (Banyuasin III)',
            'status' => 'aktif',
        ]);
        $memberStore->assertRedirect(route('admin.members.index'));
        $createdMember = Member::where('nomor_anggota', 'DPD-BA-01.9999')->first();
        $this->assertNotNull($createdMember);

        // Member KTA Print
        $ktaResponse = $this->actingAs($admin)->get(route('admin.members.kta', $createdMember->id));
        $ktaResponse->assertStatus(200);
        $ktaResponse->assertSee($createdMember->nomor_anggota, false);

        // Member Delete
        $memberDelete = $this->actingAs($admin)->delete(route('admin.members.destroy', $createdMember->id));
        $memberDelete->assertRedirect(route('admin.members.index'));
        $this->assertDatabaseMissing('members', ['id' => $createdMember->id]);

        // 2. Post CRUD
        $postStore = $this->actingAs($admin)->post(route('admin.posts.store'), [
            'judul' => 'Uji Coba Berita Pelatihan Digital APPSI 2026',
            'kategori' => 'Kegiatan',
            'penulis' => 'Humas APPSI',
            'konten' => '<p>Konten berita pelatihan pasar tradisional.</p>',
            'status' => 'draft',
        ]);
        $postStore->assertRedirect(route('admin.posts.draft'));
        $createdPost = Post::where('judul', 'Uji Coba Berita Pelatihan Digital APPSI 2026')->first();
        $this->assertNotNull($createdPost);

        $postDelete = $this->actingAs($admin)->delete(route('admin.posts.destroy', $createdPost->id));
        $postDelete->assertRedirect();
        $this->assertDatabaseMissing('posts', ['id' => $createdPost->id]);

        // 3. Meeting CRUD
        $meetingStore = $this->actingAs($admin)->post(route('admin.meetings.store'), [
            'judul_rapat' => 'Rapat Evaluasi Penataan Lapak Pasar',
            'tanggal' => '2026-09-04',
            'waktu_mulai' => '09:00',
            'tempat' => 'Kantor DPD APPSI Banyuasin',
            'pimpinan_rapat' => 'H. Gusra Yetri, SH',
            'notulis' => 'M. Rian Pratama, S.E.',
            'agenda' => 'Evaluasi los dan blok pedagang sayur',
            'status' => 'selesai',
        ]);
        $meetingStore->assertRedirect(route('admin.meetings.index'));
        $createdMeeting = Meeting::where('judul_rapat', 'Rapat Evaluasi Penataan Lapak Pasar')->first();
        $this->assertNotNull($createdMeeting);

        $meetingDelete = $this->actingAs($admin)->delete(route('admin.meetings.destroy', $createdMeeting->id));
        $meetingDelete->assertRedirect(route('admin.meetings.index'));
        $this->assertDatabaseMissing('meetings', ['id' => $createdMeeting->id]);

        // 4. Incoming Letter CRUD
        $incomingStore = $this->actingAs($admin)->post(route('admin.incoming-letters.store'), [
            'nomor_surat' => '500/012/DISKOP/2026',
            'pengirim' => 'Dinas Koperasi dan UKM Kabupaten Banyuasin',
            'tanggal_surat' => '2026-09-04',
            'tanggal_terima' => '2026-09-04',
            'perihal' => 'Undangan Sosialisasi KUR Pedagang Pasar',
            'status_disposisi' => 'Belum',
        ]);
        $incomingStore->assertRedirect();
        $createdIncoming = IncomingLetter::where('nomor_surat', '500/012/DISKOP/2026')->first();
        $this->assertNotNull($createdIncoming);

        $incomingDelete = $this->actingAs($admin)->delete(route('admin.incoming-letters.destroy', $createdIncoming->id));
        $incomingDelete->assertRedirect();
        $this->assertDatabaseMissing('incoming_letters', ['id' => $createdIncoming->id]);

        // 5. Organization Structure CRUD
        $orgStore = $this->actingAs($admin)->post(route('admin.organization.store'), [
            'nama' => 'Dedi Kurniawan, S.Pd.',
            'jabatan' => 'Koordinator Wilayah Betung',
            'divisi' => 'Koordinator Lapangan & Wilayah Pasar',
            'urutan' => 99,
        ]);
        $orgStore->assertRedirect();
        $createdOrg = OrganizationStructure::where('nama', 'Dedi Kurniawan, S.Pd.')->first();
        $this->assertNotNull($createdOrg);

        $orgDelete = $this->actingAs($admin)->delete(route('admin.organization.destroy', $createdOrg->id));
        $orgDelete->assertRedirect();
        $this->assertDatabaseMissing('organization_structures', ['id' => $createdOrg->id]);
    }
}
