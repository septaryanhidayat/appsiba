<?php

namespace Database\Seeders;

use App\Models\DownloadDocument;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DownloadDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dir = storage_path('app/public/downloads');
        if (! File::exists($dir)) {
            File::makeDirectory($dir, 0755, true, true);
        }

        $docs = [
            [
                'judul' => 'Formulir Pendaftaran Anggota (Offline)',
                'kategori' => 'Formulir Keanggotaan',
                'deskripsi' => 'Formulir cetak offline untuk pendaftaran pedagang pasar binaan DPD APPSI Banyuasin lengkap dengan data usaha dan komoditas.',
                'filename' => 'formulir-pendaftaran-anggota-appsi.pdf',
                'tipe_file' => 'pdf',
                'urutan' => 1,
                'content_sections' => [
                    'BAGIAN I : DATA PRIBADI PEDAGANG',
                    '1. Nama Lengkap (Sesuai KTP) : _________________________________________',
                    '2. Nomor Induk Kependudukan (NIK) : _____________________________________',
                    '3. Nomor WhatsApp / Telepon Aktif : _____________________________________',
                    '4. Alamat Domisili Tetap : _____________________________________________',
                    ' ',
                    'BAGIAN II : DATA USAHA & LOKASI LAPAK PASAR',
                    '1. Nama Usaha / Merek Dagang : ________________________________________',
                    '2. Nama Pasar Rakyat : [ ] Pangkalan Balai  [ ] Betung  [ ] Sukajadi',
                    '                      [ ] Mariana          [ ] Sungsang [ ] Lainnya',
                    '3. Jenis Komoditas : [ ] Sembako  [ ] Sayur & Buah  [ ] Daging & Ikan',
                    '                     [ ] Pakaian  [ ] Kuliner       [ ] Aneka Jasa',
                    '4. Status Lapak : [ ] Hak Milik / Kios  [ ] Sewa Los  [ ] Pedagang Kaki Lima',
                    ' ',
                    'BAGIAN III : PERNYATAAN KETAATAN & LEGALITAS',
                    'Dengan ini menyatakan bersedia mematuhi AD/ART dan tata tertib DPD APPSI Banyuasin.',
                    'Tertanda Pemohon,                                Mengetahui Pengurus DPD,',
                    '( _____________________ )                        ( H. Gusra Yetri, SH )',
                ],
            ],
            [
                'judul' => 'Formulir Permohonan Pembaruan KTA',
                'kategori' => 'Formulir Keanggotaan',
                'deskripsi' => 'Formulir resmi permohonan perpanjangan masa berlaku dan pembaruan data Kartu Tanda Anggota (KTA) digital.',
                'filename' => 'formulir-pembaruan-kta-appsi.pdf',
                'tipe_file' => 'pdf',
                'urutan' => 2,
                'content_sections' => [
                    'BAGIAN I : IDENTITAS ANGGOTA AKTIF',
                    '1. Nomor KTA APPSI Lama : ___________________________________________',
                    '2. Nama Lengkap Anggota : ___________________________________________',
                    '3. Pasar Asal Lapak : _________________________________________________',
                    ' ',
                    'BAGIAN II : ALASAN PERMOHONAN PEMBARUAN',
                    '[ ] Masa Berlaku KTA Telah Habis (Perpanjangan Rutin Periode 2024-2029)',
                    '[ ] Penggantian Kartu Hilang / Rusak Fisik',
                    '[ ] Pembaruan Alamat Domisili / Lokasi Kios Usaha',
                    ' ',
                    'BAGIAN III : VERIFIKASI PENGURUS KOMISARIAT PASAR',
                    'Telah diverifikasi aktif berdagang di pasar binaan DPD APPSI Kabupaten Banyuasin.',
                    'Tanggal Verifikasi : ________________________',
                    'Petugas Verifikator,                            Sekretaris DPD,',
                    '( _____________________ )                       ( M. Rian Pratama, S.E. )',
                ],
            ],
            [
                'judul' => 'Formulir Pengaduan Sengketa Lapak / Pasar',
                'kategori' => 'Advokasi & Permodalan',
                'deskripsi' => 'Berkas aduan resmi perlindungan hukum, sengketa hak sewa los, dugaan intimidasi, dan permohonan mediasi DPD APPSI.',
                'filename' => 'formulir-pengaduan-sengketa-lapak.pdf',
                'tipe_file' => 'pdf',
                'urutan' => 3,
                'content_sections' => [
                    'BAGIAN I : IDENTITAS PELAPOR & TERLAPOR',
                    '1. Nama Lengkap Pelapor : ___________________________________________',
                    '2. Nomor KTA APPSI / NIK : __________________________________________',
                    '3. Lokasi Lapak / Pasar Sengketa : ____________________________________',
                    '4. Pihak Terlapor / Pihak Terkait : ___________________________________',
                    ' ',
                    'BAGIAN II : KRONOLOGI & POKOK PERMASALAHAN',
                    'Uraian Singkat Kejadian :',
                    '_________________________________________________________________________',
                    '_________________________________________________________________________',
                    '_________________________________________________________________________',
                    ' ',
                    'BAGIAN III : PERMOHONAN TINDAK LANJUT ADVOKASI',
                    '[ ] Mediasi Damai Antar Pedagang di Kantor Sekretariat DPD',
                    '[ ] Pendampingan Musyawarah dengan Pengelola / Dinas Perdagangan',
                    '[ ] Bantuan Hukum & Advokasi Hak Pedagang oleh Tim Advokasi DPD',
                ],
            ],
            [
                'judul' => 'Persyaratan Rekomendasi KUR Mikro Pedagang',
                'kategori' => 'Advokasi & Permodalan',
                'deskripsi' => 'Brosur dan ceklis kelengkapan berkas fasilitas pinjaman permodalan KUR bunga rendah perbankan mitra DPD APPSI Banyuasin.',
                'filename' => 'persyaratan-rekomendasi-kur-pedagang.pdf',
                'tipe_file' => 'pdf',
                'urutan' => 4,
                'content_sections' => [
                    'PROGRAM FASILITASI PERMODALAN KUR MIKRO PEDAGANG PASAR',
                    'Kerjasama DPD APPSI Kabupaten Banyuasin bersama Bank Mitra Penyalur KUR.',
                    ' ',
                    'SYARAT & KELENGKAPAN BERKAS ADMINISTRASI :',
                    '1. Fotokopi Kartu Tanda Penduduk (e-KTP) Suami & Istri (jika menikah)',
                    '2. Fotokopi Kartu Keluarga (KK) yang masih berlaku',
                    '3. Kartu Tanda Anggota (KTA) APPSI Kabupaten Banyuasin yang aktif',
                    '4. Surat Keterangan Usaha (SKU) dari Pengurus DPD / Komisariat Pasar',
                    '5. Rekening Listrik / Bukti Retribusi Retribusi Lapak Pasar',
                    '6. Pasfoto Berwarna Pemohon Ukuran 4x6 (2 Lembar)',
                    ' ',
                    'KEUNGGULAN FASILITASI DPD APPSI :',
                    '- Pendampingan pengisian berkas dan survei kelayakan tanpa calo',
                    '- Bunga subsidi pemerintah 6% efektif per tahun',
                    '- Tanpa agunan tambahan untuk plafon mikro hingga Rp 100.000.000',
                ],
            ],
            [
                'judul' => 'Ringkasan AD/ART APPSI Nasional',
                'kategori' => 'Legalitas & Organisasi',
                'deskripsi' => 'Salinan ringkasan Anggaran Dasar dan Anggaran Rumah Tangga Asosiasi Pedagang Pasar Seluruh Indonesia (APPSI).',
                'filename' => 'ringkasan-ad-art-appsi-nasional.pdf',
                'tipe_file' => 'pdf',
                'urutan' => 5,
                'content_sections' => [
                    'RINGKASAN ANGGARAN DASAR & ANGGARAN RUMAH TANGGA',
                    'ASOSIASI PEDAGANG PASAR SELURUH INDONESIA (APPSI)',
                    ' ',
                    'BAB I : NAMA, WAKTU & KEDUDUKAN',
                    'Organisasi ini bernama Asosiasi Pedagang Pasar Seluruh Indonesia disingkat APPSI,',
                    'didirikan untuk jangka waktu yang tidak ditentukan dan berpusat di Ibukota Negara.',
                    ' ',
                    'BAB II : ASAS & TUJUAN',
                    'APPSI berasaskan Pancasila dan UUD 1945. Bertujuan memperjuangkan perlindungan,',
                    'keberdayaan ekonomi, dan kepastian hak berusaha para pedagang pasar tradisional.',
                    ' ',
                    'BAB III : HAK & KEWAJIBAN ANGGOTA',
                    '1. Setiap anggota berhak mendapat perlindungan hukum dan advokasi organisasi.',
                    '2. Setiap anggota berhak memanfaatkan program kemitraan permodalan dan pelatihan.',
                    '3. Setiap anggota wajib menjaga ketertiban, kebersihan, dan solidaritas pasar.',
                ],
            ],
            [
                'judul' => 'Profil DPD APPSI Kab. Banyuasin 2024–2029',
                'kategori' => 'Legalitas & Organisasi',
                'deskripsi' => 'Buku saku pengenalan DPD APPSI Kabupaten Banyuasin, struktur pimpinan dewan pengurus, dan 5 pilar program unggulan.',
                'filename' => 'profil-dpd-appsi-banyuasin-2024-2029.pdf',
                'tipe_file' => 'pdf',
                'urutan' => 6,
                'content_sections' => [
                    'PROFIL LEMBAGA DPD APPSI KABUPATEN BANYUASIN',
                    'Periode Kepengurusan : 2024 - 2029',
                    'Sekretariat : Jl. Merdeka Depan Pasar Baru Pangkalan Balai, Banyuasin',
                    ' ',
                    'PIMPINAN DEWAN PENGURUS DAERAH :',
                    '- Ketua DPD          : H. Gusra Yetri, SH',
                    '- Wakil Ketua I      : H. Ahmad Basir, S.E.',
                    '- Wakil Ketua II     : Drs. Zulkarnain',
                    '- Wakil Ketua III    : Ir. H. Syamsudin',
                    '- Sekretaris Umum    : M. Rian Pratama, S.E.',
                    '- Bendahara Umum     : Hj. Siti Aminah',
                    ' ',
                    '5 PILAR PROGRAM UNGGULAN :',
                    '1. Advokasi & Perlindungan Hukum Pedagang Pasar Tradisional',
                    '2. Kemudahan Akses Permodalan KUR Mikro Tanpa Beban Calo',
                    '3. Digitalisasi Pembayaran QRIS & Pangkalan Data Pedagang MIS',
                    '4. Penataan Sanitasi, Kenyamanan & Kelayakan Sarana Kios Pasar',
                    '5. Pelatihan Kewirausahaan & Pemberdayaan Pedagang Pasar Wanita',
                ],
            ],
        ];

        foreach ($docs as $doc) {
            $filePath = 'downloads/'.$doc['filename'];
            $fullPath = storage_path('app/public/'.$filePath);

            // Generate actual valid PDF-1.4 file
            $pdfData = $this->createPdfDocument(
                $doc['judul'],
                'DPD APPSI KABUPATEN BANYUASIN - DOKUMEN RESMI',
                $doc['content_sections']
            );

            file_put_contents($fullPath, $pdfData);

            $fileSizeBytes = file_exists($fullPath) ? filesize($fullPath) : 0;
            $ukuranFile = $fileSizeBytes >= 1048576
                ? round($fileSizeBytes / 1048576, 2).' MB'
                : max(1, round($fileSizeBytes / 1024)).' KB';

            DownloadDocument::updateOrCreate(
                ['nama_file' => $doc['filename']],
                [
                    'judul' => $doc['judul'],
                    'kategori' => $doc['kategori'],
                    'deskripsi' => $doc['deskripsi'],
                    'file_path' => $filePath,
                    'tipe_file' => $doc['tipe_file'],
                    'ukuran_file' => $ukuranFile,
                    'jumlah_unduhan' => rand(12, 85),
                    'is_aktif' => true,
                    'urutan' => $doc['urutan'],
                ]
            );
        }
    }

    /**
     * Membangun file PDF standar valid PDF-1.4
     */
    private function createPdfDocument(string $title, string $subtitle, array $lines): string
    {
        $stream = 'BT /F1 15 Tf 50 780 Td ('.addcslashes($title, '()\\').") Tj ET\n";
        $stream .= 'BT /F1 9 Tf 50 762 Td ('.addcslashes($subtitle, '()\\').") Tj ET\n";
        $stream .= "0.75 w 0.04 0.47 0.35 RG 50 752 m 545 752 l S 0.0 0.0 0.0 rg\n";

        $y = 728;
        foreach ($lines as $line) {
            if ($y < 70) {
                break;
            }
            if (trim($line) === '') {
                $y -= 10;

                continue;
            }
            $isHeading = str_starts_with($line, 'BAGIAN') || str_starts_with($line, 'PROGRAM') || str_starts_with($line, 'RINGKASAN') || str_starts_with($line, 'PROFIL');
            $fontSize = $isHeading ? '11' : '9.5';
            $stream .= "BT /F1 {$fontSize} Tf 50 {$y} Td (".addcslashes($line, '()\\').") Tj ET\n";
            $y -= ($isHeading ? 18 : 15);
        }

        // Footer in PDF
        $stream .= "0.5 w 0.8 0.8 0.8 RG 50 50 m 545 50 l S 0.4 0.4 0.4 rg\n";
        $footerText = 'Dokumen Resmi Sekretariat DPD APPSI Banyuasin - www.appsiba.or.id - Diunduh Secara Sah';
        $stream .= 'BT /F1 8 Tf 50 38 Td ('.addcslashes($footerText, '()\\').") Tj ET\n";

        $len = strlen($stream);

        $out = "%PDF-1.4\n";
        $out .= "1 0 obj << /Type /Catalog /Pages 2 0 R >> endobj\n";
        $out .= "2 0 obj << /Type /Pages /Kids [3 0 R] /Count 1 >> endobj\n";
        $out .= "3 0 obj << /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Contents 4 0 R /Resources << /Font << /F1 5 0 R >> >> >> endobj\n";
        $out .= "4 0 obj << /Length {$len} >> stream\n{$stream}\nendstream endobj\n";
        $out .= "5 0 obj << /Type /Font /Subtype /Type1 /BaseFont /Helvetica >> endobj\n";

        $xrefPos = strlen($out);
        $out .= "xref\n0 6\n0000000000 65535 f \n";

        $pos1 = strpos($out, '1 0 obj');
        $pos2 = strpos($out, '2 0 obj');
        $pos3 = strpos($out, '3 0 obj');
        $pos4 = strpos($out, '4 0 obj');
        $pos5 = strpos($out, '5 0 obj');

        $out .= sprintf("%010d 00000 n \n", $pos1);
        $out .= sprintf("%010d 00000 n \n", $pos2);
        $out .= sprintf("%010d 00000 n \n", $pos3);
        $out .= sprintf("%010d 00000 n \n", $pos4);
        $out .= sprintf("%010d 00000 n \n", $pos5);

        $out .= "trailer << /Size 6 /Root 1 0 R >>\nstartxref\n{$xrefPos}\n%%EOF";

        return $out;
    }
}
