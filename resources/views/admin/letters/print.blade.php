<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Resmi - {{ $letter->nomor_surat }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Dynamic Paper Size Style (Updated via JS) -->
    <style id="dynamic-paper-style">
        @page {
            size: 210mm 297mm;
            margin: 15mm 20mm 15mm 20mm;
        }
    </style>

    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: "Times New Roman", Times, serif;
            color: #000;
            background: #e2e8f0;
            margin: 0;
            padding: 0;
            font-size: 11pt;
            line-height: 1.5;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        .page-sheet {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto 30px auto;
            background: #fff;
            padding: 15mm 20mm 20mm 20mm;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            position: relative;
            transition: width 0.2s ease, min-height 0.2s ease;
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
        .letter-body {
            font-size: 11pt;
            line-height: 1.6;
        }
        .letter-body p {
            margin-bottom: 0.75rem;
        }
        .letter-body ul, .letter-body ol {
            padding-left: 1.5rem;
            margin-bottom: 0.75rem;
        }
        .qr-signature-box {
            display: inline-block;
            padding: 4px;
            background: #ffffff;
            border: 1px dashed #059669;
            border-radius: 6px;
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

    <!-- Floating Top Print Action & Paper Selector Bar -->
    <div class="no-print sticky-top py-3 mb-4 shadow-sm" style="background: rgba(15, 23, 42, 0.96); backdrop-filter: blur(8px); border-bottom: 2px solid #10b981; z-index: 9999;">
        <div class="container d-flex flex-wrap align-items-center justify-content-between gap-3 text-white">
            
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('admin.letters.index') }}" class="btn btn-sm btn-outline-light px-3 py-1.5" style="border-radius: 8px;">
                    <i class="fa-solid fa-arrow-left me-1"></i> Kembali
                </a>
                <span class="d-none d-md-inline text-secondary">|</span>
                <span class="fw-bold d-none d-sm-inline" style="font-size: 13px;">
                    <i class="fa-solid fa-file-invoice text-success me-1" style="color: #34d399 !important;"></i> Cetak Dokumen Resmi
                </span>
            </div>

            <!-- Paper Size Selector (A4, Letter, F4/Legal) -->
            <div class="d-flex align-items-center gap-2">
                <span class="text-white-50 small d-none d-lg-inline">Ukuran Kertas:</span>
                <div class="btn-group btn-group-sm" role="group" id="paper-selector">
                    <button type="button" class="btn btn-sm btn-success fw-bold" onclick="setPaperSize('a4', this)">
                        A4 (210×297)
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-light" onclick="setPaperSize('letter', this)">
                        Letter (216×279)
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-light" onclick="setPaperSize('f4', this)">
                        F4 / Folio (215×330)
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-light" onclick="setPaperSize('legal', this)">
                        Legal (216×356)
                    </button>
                </div>
            </div>

            <!-- Print Action Buttons -->
            <div class="d-flex align-items-center gap-2">
                <button onclick="window.print()" class="btn btn-sm btn-success fw-bold px-3.5 py-1.5 shadow" style="background-color: #10b981; border-color: #059669; border-radius: 8px;">
                    <i class="fa-solid fa-print me-1"></i> Cetak Dokumen
                </button>
                <button onclick="window.close()" class="btn btn-sm btn-outline-secondary text-white-50 px-3 py-1.5" style="border-radius: 8px;">
                    Tutup
                </button>
            </div>

        </div>
    </div>

    <!-- Page Sheet -->
    <div class="page-sheet">
        
        <!-- Official KOP APPSI BANYUASIN -->
        <div class="kop-container">
            @if(!empty($settings['logo']))
                <img src="{{ asset('storage/' . $settings['logo']) }}" alt="Logo APPSI" class="kop-logo">
            @else
                <img src="{{ asset('assets/images/appsi-logo.png') }}" alt="Logo APPSI" class="kop-logo">
            @endif
            <div class="kop-text">
                <h1 class="kop-title-1">ASOSIASI PEDAGANG PASAR SELURUH INDONESIA</h1>
                <h2 class="kop-title-2">{{ $settings['singkatan'] ?? 'DEWAN PIMPINAN DAERAH (DPD) KABUPATEN BANYUASIN' }}</h2>
                <h3 class="kop-title-3">PROVINSI SUMATERA SELATAN</h3>
                <div class="kop-address">
                    Sekretariat: {{ $settings['alamat'] ?? 'Jalan Merdeka, Depan Pasar Baru Kelurahan Pangkalan Balai - Kecamatan Banyuasin III, Kabupaten Banyuasin, Sumatera Selatan' }}<br>
                    Hotline: {{ $settings['telepon'] ?? '0811 618 808' }} &bull; Email: {{ $settings['email'] ?? 'appsi.banyuasin@gmail.com' }} &bull; Website: {{ $settings['website'] ?? 'appsiba.or.id' }}
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
        <div class="letter-body text-justify mb-5">
            <p>Dengan hormat,</p>
            
            @if($letter->isi_surat)
                @if(strip_tags($letter->isi_surat) !== $letter->isi_surat)
                    {!! $letter->isi_surat !!}
                @else
                    {!! nl2br(e($letter->isi_surat)) !!}
                @endif
            @else
                <p>
                    Sehubungan dengan program kerja Dewan Pimpinan Daerah Asosiasi Pedagang Pasar Seluruh Indonesia (DPD APPSI) Kabupaten Banyuasin Periode 2024–2029 dalam rangka pembinaan dan penguatan pedagang pasar tradisional, bersama surat ini kami sampaikan {{ $letter->keperluan }}.
                </p>
                <p>
                    Demikian surat ini kami sampaikan, atas perhatian, dukungan, dan kerja sama yang baik kami ucapkan terima kasih.
                </p>
            @endif
        </div>

        <!-- Signatures and Digital QR Code Verification: QR Code di Tengah-Tengah Nama -->
        <div class="mt-5 pt-3">
            <div class="text-center mb-3">
                <p class="mb-0 fw-bold text-uppercase" style="font-size: 10pt; letter-spacing: 0.5px;">
                    DEWAN PIMPINAN DAERAH<br>
                    ASOSIASI PEDAGANG PASAR SELURUH INDONESIA<br>
                    KABUPATEN BANYUASIN
                </p>
            </div>

            @if(!empty($letter->nama_sekretaris))
            <div class="row text-center mt-3 align-items-center">
                <!-- Ketua DPD -->
                <div class="col-4">
                    <span style="font-size: 10pt; font-weight: 600; display: block; margin-bottom: 75px;">Ketua DPD,</span>
                    <strong style="text-decoration: underline; font-size: 11pt; display: block; text-transform: uppercase;">{{ $letter->nama_penandatangan ?? 'H. Gusra Yetri, SH' }}</strong>
                    <span style="font-size: 9pt; color: #334155;">{{ $letter->jabatan_penandatangan ?? 'Ketua DPD APPSI Banyuasin' }}</span>
                </div>

                <!-- 1 QR Code Tunggal Keabsahan Dokumen di Tengah-Tengah -->
                <div class="col-4">
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="qr-signature-box">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode($letter->verification_url) }}" alt="QR Keabsahan Digital Surat Resmi" style="width: 82px; height: 82px; display: block;">
                        </div>
                        <span style="font-size: 7.5pt; color: #047857; font-weight: 700; margin-top: 4px; letter-spacing: 0.2px;">
                            <i class="fa-solid fa-circle-check"></i> Ditandatangani Secara Elektronik
                        </span>
                        <span style="font-size: 7pt; color: #64748b; margin-top: 1px;">
                            Pindai untuk Cek Keabsahan
                        </span>
                    </div>
                </div>

                <!-- Sekretaris DPD -->
                <div class="col-4">
                    <span style="font-size: 10pt; font-weight: 600; display: block; margin-bottom: 75px;">Sekretaris DPD,</span>
                    <strong style="text-decoration: underline; font-size: 11pt; display: block; text-transform: uppercase;">{{ $letter->nama_sekretaris }}</strong>
                    <span style="font-size: 9pt; color: #334155;">{{ $letter->jabatan_sekretaris ?? 'Sekretaris DPD APPSI Banyuasin' }}</span>
                </div>
            </div>
            @else
            <div class="row text-center mt-3 justify-content-end">
                <div class="col-6">
                    <span style="font-size: 10pt; font-weight: 600;">{{ $letter->jabatan_penandatangan ?? 'Ketua DPD APPSI Banyuasin' }},</span>
                    <div class="my-2 d-flex flex-column align-items-center justify-content-center" style="min-height: 105px;">
                        <div class="qr-signature-box">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode($letter->verification_url) }}" alt="QR Keabsahan Digital" style="width: 80px; height: 80px; display: block;">
                        </div>
                        <span style="font-size: 7.5pt; color: #047857; font-weight: 700; margin-top: 3px; letter-spacing: 0.2px;">
                            <i class="fa-solid fa-circle-check"></i> Ditandatangani Secara Elektronik
                        </span>
                        <span style="font-size: 7pt; color: #64748b; margin-top: 1px;">
                            Pindai untuk Cek Keabsahan
                        </span>
                    </div>
                    <strong style="text-decoration: underline; font-size: 11pt; display: block; text-transform: uppercase;">{{ $letter->nama_penandatangan ?? 'H. Gusra Yetri, SH' }}</strong>
                    <span style="font-size: 9pt; color: #334155;">{{ $letter->jabatan_penandatangan ?? 'Ketua DPD APPSI Banyuasin' }}</span>
                </div>
            </div>
            @endif
        </div>

        <!-- Tembusan -->
        @if($letter->tembusan)
            <div class="mt-4 pt-3" style="font-size: 9pt; color: #334155;">
                <strong>Tembusan:</strong><br>
                {!! nl2br(e($letter->tembusan)) !!}
            </div>
        @endif

        <!-- Footer Keabsahan Digital -->
        <div class="mt-4 pt-2 border-top text-muted text-center" style="font-size: 7.5pt; color: #64748b;">
            Dokumen resmi digital ini sah dan berkekuatan hukum sesuai regulasi DPD APPSI Kabupaten Banyuasin. Keaslian surat dapat diverifikasi publik dengan memindai kode QR di atas atau mengunjungi tautan verifikasi resmi sistem.
        </div>

    </div>

    <!-- Paper Size Switching Logic -->
    <script>
        const paperDimensions = {
            'a4': { width: '210mm', height: '297mm', name: 'A4' },
            'letter': { width: '215.9mm', height: '279.4mm', name: 'Letter' },
            'f4': { width: '215mm', height: '330mm', name: 'F4 / Folio' },
            'legal': { width: '215.9mm', height: '355.6mm', name: 'Legal' }
        };

        function setPaperSize(sizeKey, btnElement) {
            const spec = paperDimensions[sizeKey] || paperDimensions['a4'];
            
            // Update active button state
            const buttons = document.querySelectorAll('#paper-selector button');
            buttons.forEach(b => {
                b.classList.remove('btn-success', 'fw-bold');
                b.classList.add('btn-outline-light');
            });
            if (btnElement) {
                btnElement.classList.remove('btn-outline-light');
                btnElement.classList.add('btn-success', 'fw-bold');
            }

            // Update sheet on screen
            const sheet = document.querySelector('.page-sheet');
            if (sheet) {
                sheet.style.width = spec.width;
                sheet.style.minHeight = spec.height;
            }

            // Update @page CSS rule for browser printer
            let styleTag = document.getElementById('dynamic-paper-style');
            if (!styleTag) {
                styleTag = document.createElement('style');
                styleTag.id = 'dynamic-paper-style';
                document.head.appendChild(styleTag);
            }
            styleTag.innerHTML = `
                @page {
                    size: ${spec.width} ${spec.height} !important;
                    margin: 15mm 20mm 15mm 20mm !important;
                }
            `;
        }
    </script>

</body>
</html>
