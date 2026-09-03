<?php

namespace Tests\Feature;

use App\Models\Gallery;
use App\Models\Letter;
use App\Models\Meeting;
use App\Models\Member;
use App\Models\OrganizationStructure;
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
}
