<div>
    @push('styles')
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #f9fafb;
            color: #1f2937;
            -webkit-font-smoothing: antialiased;
        }
        [x-cloak] { display: none !important; }

        /* ── Page Header ── */
        .page-header {
            background: linear-gradient(135deg, #064e3b, #047857, #16a34a);
            padding: 120px 24px 50px;
            position: relative; overflow: hidden;
        }
        .page-header::before {
            content: ''; position: absolute; inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.3;
        }
        .page-header > * { position: relative; z-index: 1; }
        .page-header-inner { max-width: 800px; margin: 0 auto; text-align: center; }
        .page-header .section-label {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 6px 16px; background: rgba(255,255,255,0.15);
            border-radius: 50px; color: white; font-size: 0.8rem; font-weight: 600;
            margin-bottom: 16px; backdrop-filter: blur(10px);
        }
        .page-header h1 {
            font-size: clamp(2rem, 5vw, 3rem); font-weight: 800; color: white;
            letter-spacing: -1px; line-height: 1.15; margin-bottom: 16px;
        }
        .page-header p {
            color: rgba(255,255,255,0.85); font-size: 1.05rem;
            max-width: 600px; margin: 0 auto; line-height: 1.7;
        }

        /* ── About Section ── */
        .about-section {
            max-width: 960px; margin: 0 auto;
            padding: 60px 24px 80px;
        }

        .about-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0,0,0,0.06);
        }

        .about-hero-img {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            background: #f3f4f6;
        }

        .about-body {
            padding: 40px;
        }

        .about-description {
            font-size: 1.05rem;
            line-height: 1.85;
            color: #374151;
            margin-bottom: 48px;
        }

        .about-description p {
            margin-bottom: 1em;
        }

        /* ── Visi Misi ── */
        .visi-misi-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 32px;
            margin-bottom: 48px;
        }

        .vm-card {
            background: linear-gradient(135deg, #f0fdf4, #dcfce7);
            border-radius: 20px;
            padding: 32px;
            border: 1px solid rgba(22, 163, 74, 0.1);
        }

        .vm-card .vm-icon {
            width: 44px; height: 44px;
            background: linear-gradient(135deg, #16a34a, #22c55e);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            color: white;
            margin-bottom: 16px;
        }

        .vm-card h3 {
            font-size: 1.15rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 12px;
        }

        .vm-card p {
            font-size: 0.95rem;
            line-height: 1.7;
            color: #4b5563;
        }

        /* ── Sejarah ── */
        .sejarah-section {
            background: #fafafa;
            border-radius: 20px;
            padding: 40px;
            border: 1px solid #f3f4f6;
        }

        .sejarah-section .sejarah-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .sejarah-section .sejarah-header svg {
            color: #16a34a;
            flex-shrink: 0;
        }

        .sejarah-section .sejarah-header h3 {
            font-size: 1.15rem;
            font-weight: 700;
            color: #111827;
        }

        .sejarah-section .sejarah-content {
            font-size: 1rem;
            line-height: 1.85;
            color: #4b5563;
        }

        .sejarah-section .sejarah-content p {
            margin-bottom: 1em;
        }

        /* ── Animations ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up { animation: fadeUp 0.6s ease-out forwards; }
        .animate-delay-1 { animation-delay: 0.1s; opacity: 0; }
        .animate-delay-2 { animation-delay: 0.2s; opacity: 0; }
        .animate-delay-3 { animation-delay: 0.3s; opacity: 0; }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .about-body { padding: 24px; }
            .visi-misi-grid { grid-template-columns: 1fr; }
            .sejarah-section { padding: 24px; }
        }
    </style>
    @endpush

    <x-public.navbar />

    <!-- ════════════════════════════════════════════ -->
    <!-- PAGE HEADER -->
    <!-- ════════════════════════════════════════════ -->
    <section class="page-header">
        <div class="page-header-inner">
            <div class="section-label animate-fade-up">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                Tentang Kami
            </div>
            <h1 class="animate-fade-up animate-delay-1">Tentang Pondok Pesantren</h1>
            <p class="animate-fade-up animate-delay-2">Mengenal lebih dekat Pondok Pesantren Syafa'aturrasul</p>
        </div>
    </section>

    @if ($about)
        <section class="about-section">
            <div class="about-card animate-fade-up">
                {{-- Hero Image --}}
                @if ($about->image)
                    <img src="{{ asset('storage/' . $about->image) }}" alt="Tentang Pondok Pesantren" class="about-hero-img">
                @endif

                <div class="about-body">
                    {{-- Description --}}
                    @if ($about->description)
                        <div class="about-description">
                            @php
                                $paragraphs = preg_split('/\n\s*\n/', trim($about->description));
                            @endphp
                            @foreach ($paragraphs as $para)
                                <p>{!! nl2br(e(trim($para))) !!}</p>
                            @endforeach
                        </div>
                    @endif

                    {{-- Visi & Misi --}}
                    @if ($about->visi || $about->misi)
                        <div class="visi-misi-grid animate-fade-up animate-delay-1">
                            @if ($about->visi)
                                <div class="vm-card">
                                    <div class="vm-icon">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                                    </div>
                                    <h3>Visi</h3>
                                    <p>{!! nl2br(e($about->visi)) !!}</p>
                                </div>
                            @endif

                            @if ($about->misi)
                                <div class="vm-card">
                                    <div class="vm-icon">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                                    </div>
                                    <h3>Misi</h3>
                                    <p>{!! nl2br(e($about->misi)) !!}</p>
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- Sejarah --}}
                    @if ($about->sejarah)
                        <div class="sejarah-section animate-fade-up animate-delay-2">
                            <div class="sejarah-header">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                <h3>Sejarah</h3>
                            </div>
                            <div class="sejarah-content">
                                @php
                                    $paragraphs = preg_split('/\n\s*\n/', trim($about->sejarah));
                                @endphp
                                @foreach ($paragraphs as $para)
                                    <p>{!! nl2br(e(trim($para))) !!}</p>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @else
        {{-- Empty State --}}
        <section class="about-section">
            <div style="text-align:center;padding:60px 24px;color:#9ca3af;">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" style="margin:0 auto 16px;opacity:0.4;">
                    <circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
                <p style="font-size:1.1rem;">Halaman Tentang belum tersedia.</p>
                <p style="font-size:0.9rem;margin-top:8px;">Silakan isi data di panel admin terlebih dahulu.</p>
            </div>
        </section>
    @endif

    <x-public.footer />

    @push('scripts')
    <script>
        // Page-specific scripts
    </script>
    @endpush
</div>
