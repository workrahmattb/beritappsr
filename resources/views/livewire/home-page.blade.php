<div>
    @push('styles')
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: #ffffff;
            color: #1f2937;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Alpine x-cloak ── */
        [x-cloak] { display: none !important; }

        /* ── Navbar ── */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 50;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(22,163,74,0.1);
            transition: box-shadow .3s;
        }
        .navbar.scrolled {
            box-shadow: 0 4px 24px rgba(22,163,74,0.08);
        }
        .navbar-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 72px;
        }
        .nav-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            font-weight: 800;
            font-size: 1.25rem;
            color: #16a34a;
            letter-spacing: -0.5px;
        }
        .logo-img {
            height: 40px;
            width: auto;
        }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 32px;
        }
        .nav-links a {
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 500;
            color: #6b7280;
            transition: color .2s;
            position: relative;
        }
        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            right: 0;
            height: 2px;
            background: #16a34a;
            border-radius: 2px;
            transform: scaleX(0);
            transition: transform .2s;
        }
        .nav-links a:hover { color: #16a34a; }
        .nav-links a:hover::after { transform: scaleX(1); }
        .nav-links a.active { color: #16a34a; }
        .nav-links a.active::after { transform: scaleX(1); }

        .menu-toggle {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 4px;
            background: transparent;
            border: none;
        }
        .menu-toggle span {
            display: block;
            width: 24px;
            height: 2.5px;
            background: #4b5563;
            border-radius: 4px;
            transition: all .3s;
        }
        .menu-toggle.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }
        .menu-toggle.active span:nth-child(2) {
            opacity: 0;
        }
        .menu-toggle.active span:nth-child(3) {
            transform: rotate(-45deg) translate(5px, -5px);
        }
        .mobile-menu {
            display: none;
            flex-direction: column;
            gap: 4px;
            padding: 0 24px 20px;
            background: white;
            max-width: 1200px;
            margin: 0 auto;
        }
        .mobile-menu.open {
            display: flex;
        }
        .mobile-menu a {
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            color: #4b5563;
            padding: 10px 0;
            transition: color .2s;
        }
        .mobile-menu a:hover,
        .mobile-menu a.active { color: #16a34a; }

        @media (max-width: 768px) {
            .nav-links { display: none; }
            .menu-toggle { display: flex; }
        }

        /* ── Hero ── */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding-top: 72px;
        }
        .hero-bg {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            z-index: 0;
        }
        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0,0,0,0.7), rgba(0,0,0,0.4));
            z-index: 1;
        }
        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            width: 100%;
        }
        .hero-text {
            max-width: 680px;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 16px;
            background: rgba(22, 163, 74, 0.15);
            border: 1px solid rgba(22, 163, 74, 0.3);
            border-radius: 50px;
            color: #16a34a;
            font-size: 0.8rem;
            font-weight: 600;
            backdrop-filter: blur(4px);
            margin-bottom: 20px;
        }
        .hero-title {
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            font-weight: 800;
            line-height: 1.1;
            color: white;
            margin-bottom: 16px;
            letter-spacing: -1px;
        }
        .hero-title span { color: #4ade80; }
        .hero-subtitle {
            font-size: clamp(1rem, 2vw, 1.25rem);
            color: rgba(255,255,255,0.85);
            line-height: 1.7;
            margin-bottom: 32px;
            max-width: 560px;
        }
        .hero-actions {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 32px;
            background: #16a34a;
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            transition: all .25s;
            border: none;
            cursor: pointer;
        }
        .btn-primary:hover {
            background: #15803d;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(22,163,74,0.35);
        }
        .btn-outline-light {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 32px;
            background: transparent;
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            border: 1.5px solid rgba(255,255,255,0.3);
            transition: all .25s;
        }
        .btn-outline-light:hover {
            border-color: white;
            background: rgba(255,255,255,0.1);
        }

        /* ── Wave separator ── */
        .wave-divider {
            position: relative;
            z-index: 2;
            margin-top: -2px;
        }
        .wave-divider svg {
            display: block;
            width: 100%;
            height: auto;
        }

        /* ── Berita Section ── */
        .section {
            padding: 80px 24px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .section-header {
            text-align: center;
            margin-bottom: 48px;
        }
        .section-label {
            display: inline-block;
            padding: 4px 14px;
            background: rgba(22,163,74,0.1);
            border-radius: 50px;
            color: #16a34a;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 12px;
        }
        .section-title {
            font-size: clamp(1.75rem, 4vw, 2.5rem);
            font-weight: 800;
            color: #111827;
            letter-spacing: -0.5px;
            margin-bottom: 12px;
        }
        .section-desc {
            color: #6b7280;
            font-size: 1.05rem;
            max-width: 500px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* ── Grid Berita ── */
        .berita-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 28px;
        }
        .berita-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(22,163,74,0.08);
            transition: all .3s;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }
        .berita-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(22,163,74,0.12);
            border-color: rgba(22,163,74,0.2);
        }
        .berita-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: #f3f4f6;
        }
        .berita-img-placeholder {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #e0f2e9, #d1fae5);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #16a34a;
            font-size: 2.5rem;
            font-weight: 700;
        }
        .berita-body {
            padding: 20px 24px 24px;
        }
        .berita-date {
            font-size: 0.8rem;
            color: #9ca3af;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 8px;
        }
        .berita-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #111827;
            line-height: 1.4;
            margin-bottom: 8px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .berita-card:hover .berita-title { color: #16a34a; }
        .berita-summary {
            font-size: 0.88rem;
            color: #6b7280;
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .berita-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 24px;
            border-top: 1px solid #f3f4f6;
        }
        .berita-readmore {
            color: #16a34a;
            font-weight: 600;
            font-size: 0.88rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: gap .2s;
        }
        .berita-readmore:hover { gap: 8px; }

        /* ── CTA Section ── */
        .cta-section {
            background: linear-gradient(135deg, #059669, #16a34a, #22c55e);
            padding: 80px 24px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .cta-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.5;
        }
        .cta-section > * { position: relative; z-index: 1; }
        .cta-section .section-title { color: white; }
        .cta-section .section-desc { color: rgba(255,255,255,0.85); }

        /* ── Footer ── */
        .footer {
            background: #111827;
            padding: 48px 24px 32px;
            color: rgba(255,255,255,0.7);
        }
        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
        }
        .footer-brand { font-size: 0.9rem; line-height: 1.7; }
        .footer-brand strong { color: white; font-size: 1.1rem; }
        .footer-col h4 {
            color: white;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 16px;
        }
        .footer-col a {
            display: block;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 0.85rem;
            margin-bottom: 10px;
            transition: color .2s;
        }
        .footer-col a:hover { color: #4ade80; }
        .footer-bottom {
            max-width: 1200px;
            margin: 32px auto 0;
            padding-top: 24px;
            border-top: 1px solid rgba(255,255,255,0.08);
            text-align: center;
            font-size: 0.82rem;
            color: rgba(255,255,255,0.4);
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .footer-inner { grid-template-columns: 1fr 1fr; }
            .berita-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 480px) {
            .footer-inner { grid-template-columns: 1fr; }
        }

        /* ── Animation ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up {
            animation: fadeUp 0.6s ease-out forwards;
        }
        .animate-delay-1 { animation-delay: 0.1s; opacity: 0; }
        .animate-delay-2 { animation-delay: 0.2s; opacity: 0; }
        .animate-delay-3 { animation-delay: 0.3s; opacity: 0; }
    </style>
    @endpush

    <!-- ════════════════════════════════════════════ -->
    <!-- NAVBAR -->
    <!-- ════════════════════════════════════════════ -->
    <nav class="navbar" id="navbar">
        <div class="navbar-inner">
            <a href="/" class="nav-logo">
                <img src="{{ asset('gambar/ppsr logo.webp') }}" alt="PPSR Logo" class="logo-img">
            </a>

            <div class="nav-links">
                <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a>
                <a href="/berita" class="{{ request()->is('berita*') ? 'active' : '' }}">Berita</a>
                <a href="#">Tentang</a>
                <a href="#">Kontak</a>
            </div>



            <button class="menu-toggle" id="menuToggle" aria-label="Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <div class="mobile-menu" id="mobileMenu">
            <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a>
            <a href="/berita" class="{{ request()->is('berita*') ? 'active' : '' }}">Berita</a>
            <a href="#">Tentang</a>
            <a href="#">Kontak</a>

        </div>
    </nav>

    <!-- ════════════════════════════════════════════ -->
    <!-- HERO SECTION -->
    <!-- ════════════════════════════════════════════ -->
    @php
        $hero = $this->heroSections->first();
    @endphp

    <section class="hero" id="hero">
        @if ($hero && $hero->image)
            <div class="hero-bg" style="background-image: url('{{ asset('storage/' . $hero->image) }}');"></div>
            <div class="hero-overlay" style="background: linear-gradient(135deg, rgba(0,0,0,{{ $hero->overlay_opacity / 100 }}), rgba(0,0,0,{{ ($hero->overlay_opacity - 10) / 100 }}));"></div>
        @else
            <div class="hero-bg" style="background: linear-gradient(135deg, #064e3b, #065f46, #047857);"></div>
            <div class="hero-overlay" style="opacity: 0;"></div>
        @endif

        <div class="hero-content">
            <div class="hero-text">
                @if ($hero && $hero->badge_text)
                    <div class="hero-badge animate-fade-up">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        {{ $hero->badge_text }}
                    </div>
                @else
                    <div class="hero-badge animate-fade-up">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        Portal Berita Terpercaya
                    </div>
                @endif

                <h1 class="hero-title animate-fade-up animate-delay-1">
                    {{ $hero->title ?? 'Selamat Datang di ' }}<span>{{ $hero->subtitle ?? config('app.name', 'Berita Apps') }}</span>
                </h1>

                <p class="hero-subtitle animate-fade-up animate-delay-2">
                    {{ $hero->description ?? 'Temukan informasi terkini, artikel menarik, dan berita terpercaya dalam satu platform. Kami menyajikan berita dengan akurat dan cepat.' }}
                </p>

                <div class="hero-actions animate-fade-up animate-delay-3">
                    <a href="#berita" class="btn-primary">
                        Lihat Berita
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                    <a href="#" class="btn-outline-light">
                        Tentang Kami
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 16 16 12 12 8"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════════════════ -->
    <!-- WAVE DIVIDER -->
    <!-- ════════════════════════════════════════════ -->
    <div class="wave-divider">
        <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0 40C240 0 360 80 720 40C1080 0 1200 80 1440 40V80H0V40Z" fill="white"/>
        </svg>
    </div>

    <!-- ════════════════════════════════════════════ -->
    <!-- BERITA SECTION -->
    <!-- ════════════════════════════════════════════ -->
    <section class="section" id="berita">
        <div class="section-header">
            <div class="section-label">Berita Terkini</div>
            <h2 class="section-title">Berita Terbaru</h2>
            <p class="section-desc">Ikuti perkembangan berita terbaru dan informasi menarik lainnya</p>
        </div>

        @if($this->articles->isNotEmpty())
            <div class="berita-grid">
                @foreach($this->articles as $article)
                    <article class="berita-card animate-fade-up">
                        @if($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="berita-img" loading="lazy">
                        @else
                            <div class="berita-img-placeholder">B</div>
                        @endif
                        <div class="berita-body">
                            <div class="berita-date">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                {{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}
                            </div>
                            <h3 class="berita-title">{{ $article->title }}</h3>
                            <p class="berita-summary">{{ $article->summary ?? Str::limit(strip_tags($article->content), 120) }}</p>
                        </div>
                        <div class="berita-footer">
                            <span style="font-size:0.8rem;color:#9ca3af;">{{ $article->author->name ?? 'Admin' }}</span>
                            <a href="{{ route('berita.detail', $article->slug) }}" class="berita-readmore">
                                Baca Selengkapnya
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div style="text-align:center;margin-top:40px;">
                <a href="/berita" class="btn-primary">
                    Lihat Semua Berita
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>
        @else
            <div style="text-align:center;padding:60px 0;color:#9ca3af;">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" style="margin:0 auto 16px;opacity:0.4;">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/>
                </svg>
                <p style="font-size:1.1rem;">Belum ada berita yang dipublikasikan.</p>
            </div>
        @endif
    </section>

    <!-- ════════════════════════════════════════════ -->
    <!-- CTA SECTION -->
    <!-- ════════════════════════════════════════════ -->
    <section class="cta-section">
        <div class="section-header">
            <h2 class="section-title">Ikuti Perkembangan Berita Terbaru</h2>
            <p class="section-desc" style="max-width:600px;">Dapatkan notifikasi setiap ada berita terbaru dengan mendaftar menjadi anggota</p>
        </div>
        <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
            <a href="{{ route('register') }}" class="btn-primary" style="background:white;color:#16a34a;">
                Daftar Sekarang
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
            <a href="#berita" class="btn-outline-light">Jelajahi Berita</a>
        </div>
    </section>

    <!-- ════════════════════════════════════════════ -->
    <!-- FOOTER -->
    <!-- ════════════════════════════════════════════ -->
    <footer class="footer">
        <div class="footer-inner">
            <div class="footer-brand">
                <strong style="display:flex;align-items:center;gap:8px;margin-bottom:12px;">
                    <span style="width:28px;height:28px;background:#16a34a;border-radius:8px;display:flex;align-items:center;justify-content:center;color:white;font-size:14px;font-weight:800;">B</span>
                    {{ config('app.name', 'Berita Apps') }}
                </strong>
                <p>{{ config('app.name', 'Berita Apps') }} adalah platform berita terpercaya yang menyajikan informasi terkini dan akurat untuk Anda.</p>
            </div>
            <div class="footer-col">
                <h4>Menu</h4>
                <a href="/">Beranda</a>
                <a href="/berita">Berita</a>
                <a href="#">Tentang</a>
                <a href="#">Kontak</a>
            </div>
            <div class="footer-col">
                <h4>Lainnya</h4>
                <a href="#">Kebijakan Privasi</a>
                <a href="#">Syarat & Ketentuan</a>
                <a href="#">FAQ</a>
            </div>
            <div class="footer-col">
                <h4>Kontak</h4>
                <a href="mailto:info@beritapps.com">info@beritapps.com</a>
                <a href="#">+62 123 4567 890</a>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; {{ date('Y') }} {{ config('app.name', 'Berita Apps') }}. All rights reserved.
        </div>
    </footer>

    @push('scripts')
    <script>
        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        if (navbar) {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 20) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });
        }

        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        if (menuToggle && mobileMenu) {
            menuToggle.addEventListener('click', function() {
                this.classList.toggle('active');
                mobileMenu.classList.toggle('open');
            });
        }

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>
    @endpush
</div>
