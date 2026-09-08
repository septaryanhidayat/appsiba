{{-- Component Bagan Struktur Organisasi DPD APPSI Kabupaten Banyuasin (SK 2026-2031) --}}
<div x-data="{
    zoomLevel: 100,
    isFullscreen: false,
    isExporting: false,
    zoomIn() { if (this.zoomLevel < 140) this.zoomLevel += 10; },
    zoomOut() { if (this.zoomLevel > 50) this.zoomLevel -= 10; },
    resetZoom() { this.zoomLevel = 100; },
    toggleFullscreen() {
        const el = document.getElementById('org-chart-wrapper');
        if (!document.fullscreenElement) {
            el.requestFullscreen().catch(err => alert(`Error: ${err.message}`));
            this.isFullscreen = true;
        } else {
            document.exitFullscreen();
            this.isFullscreen = false;
        }
    },
    exportChartImage() {
        this.isExporting = true;
        const target = document.getElementById('org-chart-canvas');
        const prevTransform = target.style.transform;
        target.style.transform = 'none';

        const doCapture = () => {
            const renderCanvas = () => {
                html2canvas(target, {
                    scale: 3,
                    useCORS: true,
                    allowTaint: true,
                    backgroundColor: '#ffffff',
                    logging: false,
                    windowWidth: 1180,
                    windowHeight: target.scrollHeight,
                    onclone: (clonedDoc) => {
                        const canvasEl = clonedDoc.getElementById('org-chart-canvas');
                        if (canvasEl) {
                            canvasEl.style.transform = 'none';
                            canvasEl.style.width = '1180px';
                            canvasEl.style.maxWidth = '1180px';
                            canvasEl.style.overflow = 'visible';
                            canvasEl.querySelectorAll('*').forEach(el => {
                                el.style.overflow = 'visible';
                            });
                        }
                    }
                }).then(canvas => {
                    target.style.transform = prevTransform;
                    this.isExporting = false;
                    const link = document.createElement('a');
                    link.download = 'bagan-struktur-dpd-appsi-banyuasin-2026-2031.png';
                    link.href = canvas.toDataURL('image/png');
                    link.click();
                }).catch(err => {
                    target.style.transform = prevTransform;
                    this.isExporting = false;
                    console.error(err);
                    alert('Gagal mengekspor gambar bagan.');
                });
            };

            if (document.fonts && document.fonts.ready) {
                document.fonts.ready.then(renderCanvas);
            } else {
                renderCanvas();
            }
        };

        if (typeof html2canvas === 'undefined') {
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js';
            script.onload = doCapture;
            document.head.appendChild(script);
        } else {
            doCapture();
        }
    }
}" class="space-y-3" id="org-chart-root">

    <style>
        #org-chart-canvas {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif !important;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
        }
        #org-chart-canvas * {
            box-sizing: border-box;
        }
        #org-chart-canvas h1,
        #org-chart-canvas h2,
        #org-chart-canvas h3,
        #org-chart-canvas h4,
        #org-chart-canvas h5,
        #org-chart-canvas h6,
        #org-chart-canvas p {
            margin: 0;
            padding: 0;
            line-height: 1.25;
            text-align: center;
        }
        #org-chart-canvas svg {
            display: block;
            overflow: visible;
            flex-shrink: 0;
            shape-rendering: geometricPrecision;
        }
        @media print {
            @page {
                size: landscape;
                margin: 5mm;
            }
            body {
                background: #ffffff !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .print\:hidden {
                display: none !important;
            }
            #org-chart-wrapper {
                background: transparent !important;
                border: none !important;
                padding: 0 !important;
                overflow: visible !important;
                box-shadow: none !important;
            }
            #org-chart-canvas {
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 !important;
                padding: 4mm !important;
                box-shadow: none !important;
                border: 1px solid #cbd5e1 !important;
                transform: none !important;
            }
        }
    </style>

    <!-- Top Action Bar & Controls -->
    <div class="flex flex-wrap items-center justify-between gap-2.5 p-3 sm:p-3.5 rounded-2xl bg-white border border-slate-200 shadow-sm print:hidden">
        
        <!-- Legend / Info -->
        <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-sm sm:text-base shadow-sm border border-emerald-200">
                <i class="fa-solid fa-sitemap"></i>
            </div>
            <div>
                <h4 class="text-xs sm:text-sm font-black text-slate-900 flex items-center gap-1.5">
                    <span>Bagan Alur & Hirarki Resmi DPD APPSI</span>
                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[9px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-300">
                        Periode 2026–2031
                    </span>
                </h4>
                <p class="text-[10px] text-slate-500 font-medium">Format simetris bergaris instruksi presisi sesuai SK DPW APPSI Sumsel No: 012/SK/DPW-APPSI/VI/2026</p>
            </div>
        </div>

        <!-- Interactive Tools (Zoom, Download, Print, Fullscreen) -->
        <div class="flex flex-wrap items-center gap-1.5">
            <!-- Zoom Controls -->
            <div class="flex items-center bg-slate-100 p-0.5 rounded-xl border border-slate-200">
                <button type="button" @click="zoomOut()" aria-label="Perkecil (-)" class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-700 hover:bg-white text-xs font-bold transition-all" title="Perkecil (-)">
                    <i class="fa-solid fa-minus"></i>
                </button>
                <span class="px-2 text-[10px] sm:text-xs font-bold text-slate-700 min-w-[2.8rem] text-center" x-text="zoomLevel + '%'">100%</span>
                <button type="button" @click="zoomIn()" aria-label="Perbesar (+)" class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-700 hover:bg-white text-xs font-bold transition-all" title="Perbesar (+)">
                    <i class="fa-solid fa-plus"></i>
                </button>
                <button type="button" @click="resetZoom()" aria-label="Reset Zoom" class="px-2 py-1 rounded-lg text-[10px] font-bold text-slate-600 hover:bg-white transition-all" title="Reset Ukuran (Pas di Layar)">
                    Reset
                </button>
            </div>

            <!-- Fullscreen Button -->
            <button type="button" @click="toggleFullscreen()" aria-label="Layar Penuh" class="h-8 px-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold flex items-center gap-1.5 transition-all" title="Layar Penuh">
                <i class="fa-solid fa-expand"></i>
                <span class="hidden md:inline">Layar Penuh</span>
            </button>

            <!-- Export Image Button -->
            <button type="button" @click="exportChartImage()" :disabled="isExporting" aria-label="Unduh Gambar PNG" class="h-8 px-3 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold flex items-center gap-1.5 shadow-sm transition-all cursor-pointer disabled:opacity-50">
                <i class="fa-solid fa-download" :class="isExporting ? 'fa-bounce' : ''"></i>
                <span x-text="isExporting ? 'Memproses...' : 'Unduh PNG'">Unduh PNG</span>
            </button>

            <!-- Print Button -->
            <button type="button" onclick="window.print()" aria-label="Cetak Bagan" class="h-8 px-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold flex items-center gap-1.5 transition-all">
                <i class="fa-solid fa-print"></i>
                <span class="hidden md:inline">Cetak</span>
            </button>
        </div>
    </div>

    <!-- Chart Canvas Container (Landscape Scroll Wrapper) -->
    <div id="org-chart-wrapper" class="relative w-full overflow-x-auto rounded-3xl bg-slate-100/70 border border-slate-200 shadow-inner p-2 sm:p-4 transition-all">
        
        <!-- The Printable & Exportable Canvas (Landscape Width ~1160px, Simetris & Anti-Clipping) -->
        <div id="org-chart-canvas" 
             :style="'transform: scale(' + (zoomLevel / 100) + '); transform-origin: top center; transition: transform 0.2s ease-out;'"
             class="w-[1160px] mx-auto p-6 rounded-2xl bg-white border border-slate-200 shadow-md space-y-4"
             style="background-image: radial-gradient(rgba(16, 185, 129, 0.08) 1px, transparent 1px); background-size: 16px 16px;">
            
            <!-- Bagan Header Title dengan Logo APPSI Resmi -->
            <div class="text-center pb-3 border-b border-slate-200">
                <div class="flex items-center justify-center mb-2">
                    <img src="{{ asset('assets/images/appsi-logo.png') }}" 
                         alt="Logo APPSI" 
                         class="h-16 w-auto object-contain drop-shadow-sm" 
                         loading="eager" 
                         crossorigin="anonymous">
                </div>

                <div class="text-[11px] font-black uppercase tracking-wider text-slate-700">
                    DEWAN PENGURUS DAERAH
                </div>
                <h2 class="text-base sm:text-lg font-black text-emerald-800 uppercase tracking-wide leading-snug text-center m-0">
                    ASOSIASI PEDAGANG PASAR SELURUH INDONESIA (APPSI)
                </h2>
                <div class="flex items-center justify-center gap-2 mt-1">
                    <span class="text-xs sm:text-sm font-extrabold text-slate-900">
                        KABUPATEN BANYUASIN
                    </span>
                    <span class="text-slate-300">•</span>
                    <span class="text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">
                        PERIODE TAHUN 2026–2031
                    </span>
                </div>
                <p class="text-[9px] text-slate-500 mt-1 font-medium">
                    Berdasarkan Surat Keputusan DPW APPSI Sumatera Selatan Nomor: 012/SK/DPW-APPSI/VI/2026
                </p>
            </div>

            <!-- ==================================================== -->
            <!-- LEVEL 0: DEWAN PENASEHAT & DEWAN PEMBINA            -->
            <!-- ==================================================== -->
            @if(count($tree['dewan_penasehat']) > 0 || count($tree['dewan_pembina']) > 0)
                <div class="relative flex flex-col items-center">
                    <div class="w-[960px] mx-auto grid grid-cols-2 gap-6">
                        
                        <!-- Dewan Penasehat Box -->
                        <div class="rounded-xl bg-amber-50/70 border border-amber-300 p-3 shadow-2xs">
                            <div class="flex items-center justify-center gap-1.5 pb-2 border-b border-amber-200/80 mb-2">
                                <i class="fa-solid fa-landmark text-amber-700 text-xs"></i>
                                <span class="text-[10px] font-black uppercase tracking-wider text-amber-900">
                                    DEWAN PENASEHAT
                                </span>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach($tree['dewan_penasehat'] as $pen)
                                    <div class="bg-white rounded-lg p-2 border border-amber-200 text-center shadow-2xs">
                                        <h5 class="text-[11px] font-extrabold text-slate-900 leading-tight">
                                            {{ $pen->nama }}
                                        </h5>
                                        <p class="text-[9px] font-bold text-amber-800 mt-0.5 leading-tight">
                                            {{ $pen->jabatan }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Dewan Pembina Box -->
                        <div class="rounded-xl bg-sky-50/70 border border-sky-300 p-3 shadow-2xs">
                            <div class="flex items-center justify-center gap-1.5 pb-2 border-b border-sky-200/80 mb-2">
                                <i class="fa-solid fa-graduation-cap text-sky-700 text-xs"></i>
                                <span class="text-[10px] font-black uppercase tracking-wider text-sky-900">
                                    DEWAN PEMBINA
                                </span>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach($tree['dewan_pembina'] as $pem)
                                    <div class="bg-white rounded-lg p-2 border border-sky-200 text-center shadow-2xs">
                                        <h5 class="text-[11px] font-extrabold text-slate-900 leading-tight">
                                            {{ $pem->nama }}
                                        </h5>
                                        <p class="text-[9px] font-bold text-sky-800 mt-0.5 leading-tight">
                                            {{ $pem->jabatan }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                    <!-- Direct Vertical Line Connector from Advisory to Ketua -->
                    <div class="w-[2px] h-4 bg-emerald-600"></div>
                </div>
            @endif

            <!-- ==================================================== -->
            <!-- LEVEL 1: PENGURUS HARIAN: KETUA & WAKIL KETUA       -->
            <!-- ==================================================== -->
            <div class="relative flex flex-col items-center">
                <div class="flex items-center justify-center gap-6">
                    
                    <!-- KETUA CARD -->
                    @if($tree['ketua'])
                        <div class="w-72 rounded-xl bg-white border-2 border-emerald-600 shadow-md">
                            <div class="h-8 bg-gradient-to-r from-emerald-800 via-emerald-700 to-teal-700 text-white rounded-t-lg px-3 flex items-center justify-center gap-1.5 text-center">
                                <i class="fa-solid fa-crown text-xs text-amber-300"></i>
                                <span class="text-xs font-black uppercase tracking-wider text-center">
                                    {{ $tree['ketua']->jabatan }}
                                </span>
                            </div>
                            <div class="px-3 py-2 text-center bg-white rounded-b-lg flex flex-col justify-center items-center">
                                <h3 class="text-xs sm:text-sm font-black text-slate-900 leading-tight text-center m-0">
                                    {{ $tree['ketua']->nama }}
                                </h3>
                                <p class="text-[10px] text-emerald-800 font-bold mt-1 leading-none text-center m-0">
                                    DPD APPSI KABUPATEN BANYUASIN
                                </p>
                            </div>
                        </div>
                    @endif

                    <!-- WAKIL KETUA CARD -->
                    @foreach($tree['wakil_ketua'] as $wk)
                        <div class="w-72 rounded-xl bg-white border-2 border-teal-600 shadow-md">
                            <div class="h-8 bg-gradient-to-r from-teal-700 to-emerald-700 text-white rounded-t-lg px-3 flex items-center justify-center gap-1.5 text-center">
                                <i class="fa-solid fa-award text-xs text-teal-200"></i>
                                <span class="text-xs font-black uppercase tracking-wider text-center">
                                    {{ $wk->jabatan }}
                                </span>
                            </div>
                            <div class="px-3 py-2 text-center bg-white rounded-b-lg flex flex-col justify-center items-center">
                                <h3 class="text-xs sm:text-sm font-black text-slate-900 leading-tight text-center m-0">
                                    {{ $wk->nama }}
                                </h3>
                                <p class="text-[10px] text-teal-800 font-bold mt-1 leading-none text-center m-0">
                                    DPD APPSI KABUPATEN BANYUASIN
                                </p>
                            </div>
                        </div>
                    @endforeach

                </div>

                <!-- Central Spine continuing down from Level 1 -->
                <div class="w-[2px] h-4 bg-emerald-600"></div>
            </div>

            <!-- ==================================================== -->
            <!-- LEVEL 2: SEKRETARIAT & KEBENDAHARAAN                 -->
            <!-- ==================================================== -->
            <div class="relative flex flex-col items-center">
                
                <!-- SVG Connector ke Sekretariat (Kiri) dan Kebendaharaan (Kanan) -->
                <svg class="w-[660px] h-7 text-emerald-600 mx-auto block" viewBox="0 0 660 28" fill="none">
                    <!-- Turun dari poros tengah (x=330) -->
                    <path d="M 330 0 V 14" stroke="currentColor" stroke-width="2"/>
                    <!-- Cabang horizontal ke pusat Sekretariat (x=130) dan Kebendaharaan (x=530) -->
                    <path d="M 130 14 H 530" stroke="currentColor" stroke-width="2"/>
                    <!-- Turun tepat ke kartu dan poros tengah -->
                    <path d="M 130 14 V 28 M 330 14 V 28 M 530 14 V 28" stroke="currentColor" stroke-width="2"/>
                </svg>

                <div class="w-[660px] mx-auto flex items-stretch">
                    
                    <!-- KIRI: SEKRETARIAT -->
                    <div class="w-[260px] flex flex-col items-center">
                        <!-- 1. SEKRETARIS -->
                        @if($tree['sekretariat']['utama'])
                            @php $sec = $tree['sekretariat']['utama']; @endphp
                            <div class="w-full rounded-xl bg-white border border-indigo-500 shadow-xs">
                                <div class="h-7 bg-gradient-to-r from-indigo-700 to-blue-700 text-white rounded-t-lg px-2 flex items-center justify-center gap-1.5 text-center">
                                    <i class="fa-solid fa-pen-nib text-[10px]"></i>
                                    <span class="text-[10px] font-black uppercase tracking-wide text-center">
                                        {{ $sec->jabatan }}
                                    </span>
                                </div>
                                <div class="h-14 px-2 py-1 text-center bg-white rounded-b-lg flex flex-col justify-center items-center">
                                    <h4 class="text-xs font-bold text-slate-900 leading-tight text-center m-0">
                                        {{ $sec->nama }}
                                    </h4>
                                    <p class="text-[9px] text-slate-500 mt-1 leading-none text-center m-0">
                                        {{ $sec->divisi ?? 'Sekretariat DPD' }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        <!-- Arrow to Wakil Sekretaris -->
                        @if($tree['sekretariat']['wakil'])
                            <svg class="w-4 h-4 text-indigo-600 block -my-[1px]" viewBox="0 0 16 16" fill="none">
                                <line x1="8" y1="0" x2="8" y2="10" stroke="currentColor" stroke-width="2"/>
                                <polygon points="4,9 8,15 12,9" fill="currentColor"/>
                            </svg>

                            <!-- 2. WAKIL SEKRETARIS -->
                            @php $wsec = $tree['sekretariat']['wakil']; @endphp
                            <div class="w-full rounded-xl bg-white border border-sky-500 shadow-xs">
                                <div class="h-7 bg-gradient-to-r from-sky-600 to-blue-600 text-white rounded-t-lg px-2 flex items-center justify-center gap-1.5 text-center">
                                    <i class="fa-solid fa-file-signature text-[10px]"></i>
                                    <span class="text-[10px] font-black uppercase tracking-wide text-center">
                                        {{ $wsec->jabatan }}
                                    </span>
                                </div>
                                <div class="h-14 px-2 py-1 text-center bg-white rounded-b-lg flex flex-col justify-center items-center">
                                    <h4 class="text-xs font-bold text-slate-900 leading-tight text-center m-0">
                                        {{ $wsec->nama }}
                                    </h4>
                                    <p class="text-[9px] text-slate-500 mt-1 leading-none text-center m-0">
                                        {{ $wsec->divisi ?? 'Sekretariat DPD' }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- TENGAH: CENTRAL SPINE -->
                    <div class="w-[140px] flex justify-center items-stretch">
                        <div class="w-[2px] h-full bg-emerald-600"></div>
                    </div>

                    <!-- KANAN: KEBENDAHARAAN -->
                    <div class="w-[260px] flex flex-col items-center">
                        <!-- 1. BENDAHARA -->
                        @if($tree['kebendaharaan']['utama'])
                            @php $ben = $tree['kebendaharaan']['utama']; @endphp
                            <div class="w-full rounded-xl bg-white border border-amber-500 shadow-xs">
                                <div class="h-7 bg-gradient-to-r from-amber-600 to-yellow-600 text-white rounded-t-lg px-2 flex items-center justify-center gap-1.5 text-center">
                                    <i class="fa-solid fa-coins text-[10px]"></i>
                                    <span class="text-[10px] font-black uppercase tracking-wide text-center">
                                        {{ $ben->jabatan }}
                                    </span>
                                </div>
                                <div class="h-14 px-2 py-1 text-center bg-white rounded-b-lg flex flex-col justify-center items-center">
                                    <h4 class="text-xs font-bold text-slate-900 leading-tight text-center m-0">
                                        {{ $ben->nama }}
                                    </h4>
                                    <p class="text-[9px] text-slate-500 mt-1 leading-none text-center m-0">
                                        {{ $ben->divisi ?? 'Kebendaharaan DPD' }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        <!-- Arrow to Wakil Bendahara -->
                        @if($tree['kebendaharaan']['wakil'])
                            <svg class="w-4 h-4 text-amber-600 block -my-[1px]" viewBox="0 0 16 16" fill="none">
                                <line x1="8" y1="0" x2="8" y2="10" stroke="currentColor" stroke-width="2"/>
                                <polygon points="4,9 8,15 12,9" fill="currentColor"/>
                            </svg>

                            <!-- 2. WAKIL BENDAHARA -->
                            @php $wben = $tree['kebendaharaan']['wakil']; @endphp
                            <div class="w-full rounded-xl bg-white border border-emerald-500 shadow-xs">
                                <div class="h-7 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-t-lg px-2 flex items-center justify-center gap-1.5 text-center">
                                    <i class="fa-solid fa-receipt text-[10px]"></i>
                                    <span class="text-[10px] font-black uppercase tracking-wide text-center">
                                        {{ $wben->jabatan }}
                                    </span>
                                </div>
                                <div class="h-14 px-2 py-1 text-center bg-white rounded-b-lg flex flex-col justify-center items-center">
                                    <h4 class="text-xs font-bold text-slate-900 leading-tight text-center m-0">
                                        {{ $wben->nama }}
                                    </h4>
                                    <p class="text-[9px] text-slate-500 mt-1 leading-none text-center m-0">
                                        {{ $wben->divisi ?? 'Kebendaharaan DPD' }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>

                <!-- Central Spine continuing down to Level 3 -->
                <div class="w-[2px] h-4 bg-emerald-600"></div>
            </div>

            <!-- ==================================================== -->
            <!-- LEVEL 3: 7 BIDANG RESMI APPSI (BERDERET HORIZONTAL)   -->
            <!-- ==================================================== -->
            <div class="relative space-y-0 pt-0">
                
                <!-- Bus SVG: 7 Kolom Persis dari x=76 ke x=1036 (Center=556) -->
                <svg class="w-[1112px] h-7 text-emerald-600 mx-auto block" viewBox="0 0 1112 28" fill="none">
                    <!-- Turun dari poros tengah atas (x=556) -->
                    <path d="M 556 0 V 14" stroke="currentColor" stroke-width="2"/>
                    <!-- Garis horizontal bus dari ujung kolom 1 ke ujung kolom 7 -->
                    <path d="M 76 14 H 1036" stroke="currentColor" stroke-width="2"/>
                    <!-- 7 Ticks vertikal tepat menuju ke masing-masing 7 kepala kolom -->
                    <path d="M 76 14 V 28 M 236 14 V 28 M 396 14 V 28 M 556 14 V 28 M 716 14 V 28 M 876 14 V 28 M 1036 14 V 28" stroke="currentColor" stroke-width="2"/>
                </svg>

                <!-- 7 Columns Side-by-Side (Width 1112px, each w-[152px], gap-2 = 8px) -->
                <div class="w-[1112px] mx-auto grid grid-cols-7 gap-2">
                    @foreach($tree['bidangs'] as $bKey => $b)
                        <div class="w-[152px] flex flex-col items-center">
                            
                            <!-- 1. Header Bidang Capsule -->
                            <div class="w-full h-14 rounded-lg bg-gradient-to-r {{ $b['info']['gradient'] }} text-white px-1.5 py-1 shadow-xs text-center flex flex-col justify-center items-center">
                                <span class="block text-[8px] font-extrabold uppercase tracking-widest text-white/90 leading-none text-center m-0">
                                    BIDANG {{ $b['info']['code'] ?? '' }}
                                </span>
                                <h5 class="text-[9.5px] font-black uppercase text-white leading-tight mt-1 text-center m-0 line-clamp-2" title="{{ $b['info']['title'] }}">
                                    {{ $b['info']['title'] }}
                                </h5>
                            </div>

                            <!-- Continuous SVG Arrow -->
                            <svg class="w-4 h-3.5 text-emerald-600 block -my-[1px]" viewBox="0 0 16 14" fill="none">
                                <line x1="8" y1="0" x2="8" y2="8" stroke="currentColor" stroke-width="2"/>
                                <polygon points="4,7 8,13 12,7" fill="currentColor"/>
                            </svg>

                            <!-- 2. KETUA BIDANG -->
                            <div class="w-full min-h-[58px] rounded-lg bg-white border {{ $b['info']['border'] }} px-1.5 py-1.5 text-center shadow-2xs flex flex-col justify-center items-center">
                                <span class="block text-[8px] font-black text-slate-400 uppercase tracking-wider leading-none text-center m-0">
                                    KETUA BIDANG
                                </span>
                                <h6 class="text-[10px] font-extrabold text-slate-900 leading-tight mt-1 text-center m-0 line-clamp-2" title="{{ $b['kabid']?->nama ?? '-' }}">
                                    {{ $b['kabid']?->nama ?? '-' }}
                                </h6>
                            </div>

                            <!-- 3. ANGGOTA BIDANG (Jika Ada) -->
                            @if(count($b['anggota']) > 0)
                                <svg class="w-4 h-3 text-emerald-500 block -my-[1px]" viewBox="0 0 16 12" fill="none">
                                    <line x1="8" y1="0" x2="8" y2="6" stroke="currentColor" stroke-width="1.5"/>
                                    <polygon points="5,5 8,11 11,5" fill="currentColor"/>
                                </svg>

                                <div class="w-full rounded-lg bg-emerald-50 border border-emerald-200 text-center shadow-2xs overflow-hidden mt-0.5">
                                    <div class="bg-emerald-700 text-white text-[7.5px] font-black uppercase py-0.5 tracking-wider leading-none text-center">
                                        ANGGOTA
                                    </div>
                                    <div class="px-1 py-1 space-y-1">
                                        @foreach($b['anggota'] as $ang)
                                            <p class="text-[8.5px] font-bold text-slate-800 leading-tight text-center m-0 truncate" title="{{ $ang->nama }}">
                                                {{ $ang->nama }}
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                        </div>
                    @endforeach
                </div>

                <!-- LEVEL 4: ANGGOTA UMUM / KOMISARIAT PASAR (JIKA ADA) -->
                @if(count($tree['anggota_umum']) > 0)
                    <div class="pt-4 flex flex-col items-center">
                        <div class="w-[2px] h-3.5 bg-emerald-600"></div>
                        <div class="w-full max-w-2xl rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-center shadow-2xs">
                            <span class="inline-block px-2.5 py-0.5 rounded text-[9px] font-black uppercase tracking-wider text-emerald-800 bg-emerald-100 mb-2 leading-normal text-center">
                                <i class="fa-solid fa-users text-emerald-700"></i> Pengurus Tambahan / Komisariat Pasar
                            </span>
                            <div class="grid grid-cols-3 gap-2">
                                @foreach($tree['anggota_umum'] as $au)
                                    <div class="h-9 px-2 rounded-lg bg-white border border-slate-200 text-center flex flex-col justify-center items-center shadow-2xs">
                                        <p class="text-[10px] font-bold text-slate-900 leading-tight text-center m-0">{{ $au->nama }}</p>
                                        <span class="text-[8px] text-slate-400 font-semibold leading-none">{{ $au->jabatan }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

            </div>

            <!-- Footer SK & Legalitas Resmi -->
            <div class="pt-3 border-t border-slate-200 flex items-center justify-between text-[9px] text-slate-500 font-medium">
                <span>Ditetapkan di Palembang, 24 Juni 2026 • SK DPW APPSI Sumatera Selatan No: 012/SK/DPW-APPSI/VI/2026</span>
                <span class="font-bold text-emerald-800">Portal Resmi: appsiba.or.id</span>
            </div>

        </div>

    </div>

</div>
