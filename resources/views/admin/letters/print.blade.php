<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Resmi - {{ $letter->nomor_surat }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @page {
            size: A4 portrait;
            margin: 15mm 20mm 15mm 20mm;
        }
        * {
            box-sizing: border-box;
        }
        body {
            font-family: "Times New Roman", Times, serif;
            color: #000;
            background: #f1f5f9;
            margin: 0;
            padding: 20px 0;
            font-size: 11pt;
            line-height: 1.5;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        .page-sheet {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            background: #fff;
            padding: 15mm 20mm 20mm 20mm;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            position: relative;
        }
        .kop-container {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding-bottom: 8px;
        }
        .kop-logo {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 80px;
            height: 80px;
        }
        .kop-text {
            text-align: center;
            width: 100%;
            padding: 0 85px;
        }
        .kop-title-1 {
            font-size: 14pt;
            font-weight: 800;
            letter-spacing: 0.5px;
            margin: 0;
            line-height: 1.2;
            text-transform: uppercase;
            color: #065f46;
        }
        .kop-title-2 {
            font-size: 12.5pt;
            font-weight: 800;
            margin: 2px 0 0 0;
            line-height: 1.2;
            text-transform: uppercase;
            color: #047857;
        }
        .kop-title-3 {
            font-size: 11pt;
            font-weight: 700;
            margin: 1px 0 0 0;
            text-transform: uppercase;
            color: #0f172a;
        }
        .kop-address {
            font-size: 8.5pt;
            text-align: center;
            font-style: italic;
            margin-top: 4px;
            color: #334155;
            line-height: 1.3;
        }
        .kop-divider {
            border-top: 3px solid #064e3b;
            border-bottom: 1px solid #064e3b;
            height: 5px;
            margin-top: 6px;
            margin-bottom: 24px;
        }
        .letter-table td {
            padding: 2px 0;
            vertical-align: top;
        }
        @media print {
            body {
                background: white !important;
                padding: 0 !important;
            }
            .no-print {
                display: none !important;
            }
            .page-sheet {
                box-shadow: none !important;
                margin: 0 !important;
                width: 100% !important;
                padding: 0 !important;
            }
        }
    </style>
</head>
<body>

    <!-- Action Bar -->
    <div class="no-print text-center mb-4">
        <button onclick="window.print()" class="btn btn-success fw-bold px-4 py-2 me-2 shadow-sm" style="background-color: #047857; border-color: #047857;">
            <i class="fa-solid fa-print me-1"></i> Cetak Dokumen Surat
        </button>
        <button onclick="window.close()" class="btn btn-outline-secondary px-4 py-2">
            Tutup
        </button>
    </div>

    <!-- Page Sheet -->
    <div class="page-sheet">
        
        <!-- Official KOP APPSI BANYUASIN -->
        <div class="kop-container">
            <img src="{{ asset('assets/images/appsi-logo.png') }}" alt="Logo APPSI" class="kop-logo">
            <div class="kop-text">
                <h1 class="kop-title-1">ASOSIASI PEDAGANG PASAR SELURUH INDONESIA</h1>
                <h2 class="kop-title-2">DEWAN PIMPINAN DAERAH (DPD) KABUPATEN BANYUASIN</h2>
                <h3 class="kop-title-3">PROVINSI SUMATERA SELATAN</h3>
                <div class="kop-address">
                    Sekretariat: Jalan Merdeka, Depan Pasar Baru Kelurahan Pangkalan Balai - Kecamatan Banyuasin III<br>
                    Kabupaten Banyuasin, Sumatera Selatan &bull; Hotline: 0811 618 808 &bull; Website: appsiba.or.id
                </div>
            </div>
        </div>

        <div class="kop-divider"></div>

        <!-- Date & Location -->
        <div class="text-end mb-4">
            {{ $letter->lokasi ?? 'Pangkalan Balai' }}, {{ $letter->tanggal ? $letter->tanggal->translatedFormat('d F Y') : date('d F Y') }}
        </div>

        <!-- Letter Meta -->
        <table class="letter-table mb-4" style="width: 100%;">
            <tr>
                <td style="width: 100px;">Nomor</td>
                <td style="width: 15px;">:</td>
                <td class="fw-bold">{{ $letter->nomor_surat }}</td>
            </tr>
            <tr>
                <td>Lampiran</td>
                <td>:</td>
                <td>{{ $letter->lampiran ?? '-' }}</td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td>:</td>
                <td class="fw-bold">{{ $letter->perihal ?? $letter->keperluan }}</td>
            </tr>
        </table>

        <!-- Receiver -->
        <div class="mb-4">
            Kepada Yth.<br>
            <strong>{{ $letter->nama_pejabat ?? $letter->tujuan }}</strong><br>
            @if($letter->jabatan_pejabat)
                <span>{{ $letter->jabatan_pejabat }}</span><br>
            @endif
            @if($letter->alamat_tujuan)
                <span>Di - {{ $letter->alamat_tujuan }}</span>
            @else
                <span>Di - Tempat</span>
            @endif
        </div>

        <!-- Letter Body Content -->
        <div class="letter-body text-justify mb-5" style="line-height: 1.6;">
            <p>Dengan hormat,</p>
            
            @if($letter->isi_surat)
                {!! nl2br(e($letter->isi_surat)) !!}
            @else
                <p>
                    Sehubungan dengan program kerja Dewan Pimpinan Daerah Asosiasi Pedagang Pasar Seluruh Indonesia (DPD APPSI) Kabupaten Banyuasin Periode 2024–2029 dalam rangka pembinaan dan penguatan pedagang pasar tradisional, bersama surat ini kami sampaikan {{ $letter->keperluan }}.
                </p>
                <p>
                    Demikian surat ini kami sampaikan, atas perhatian, dukungan, dan kerja sama yang baik kami ucapkan terima kasih.
                </p>
            @endif
        </div>

        <!-- Signatures and QR Code Verification -->
        <div class="row align-items-end mt-5 pt-3">
            
            <!-- QR Code Verification Section -->
            <div class="col-4">
                <div class="p-2 border rounded text-center" style="width: 130px; background-color: #fafafa;">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode($letter->verification_url) }}" alt="QR Keabsahan" class="img-fluid mb-1">
                    <span style="font-size: 7.5pt; display: block; color: #475569; line-height: 1.1;">
                        Pindai untuk validasi surat resmi digital APPSI
                    </span>
                </div>
            </div>

            <!-- Signer Columns -->
            <div class="col-8">
                <div class="text-center">
                    <p class="mb-1 fw-bold text-uppercase" style="font-size: 10pt;">
                        DEWAN PIMPINAN DAERAH<br>
                        ASOSIASI PEDAGANG PASAR SELURUH INDONESIA<br>
                        KABUPATEN BANYUASIN
                    </p>

                    <div class="row mt-4 pt-4">
                        <!-- Ketua -->
                        <div class="col-6">
                            <span style="font-size: 10pt;">Ketua DPD,</span>
                            <div style="height: 65px;"></div>
                            <strong style="text-decoration: underline; font-size: 11pt; display: block;">{{ $letter->nama_penandatangan ?? 'H. Gusra Yetri, SH' }}</strong>
                            <span style="font-size: 9.5pt;">{{ $letter->jabatan_penandatangan ?? 'Ketua DPD APPSI Banyuasin' }}</span>
                        </div>

                        <!-- Sekretaris -->
                        <div class="col-6">
                            <span style="font-size: 10pt;">Sekretaris,</span>
                            <div style="height: 65px;"></div>
                            <strong style="text-decoration: underline; font-size: 11pt; display: block;">{{ $letter->nama_sekretaris ?? 'M. Rian Pratama, S.E.' }}</strong>
                            <span style="font-size: 9.5pt;">{{ $letter->jabatan_sekretaris ?? 'Sekretaris DPD APPSI Banyuasin' }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Tembusan -->
        @if($letter->tembusan)
            <div class="mt-5 pt-3" style="font-size: 9pt; color: #334155;">
                <strong>Tembusan:</strong><br>
                {!! nl2br(e($letter->tembusan)) !!}
            </div>
        @endif

    </div>

</body>
</html>
