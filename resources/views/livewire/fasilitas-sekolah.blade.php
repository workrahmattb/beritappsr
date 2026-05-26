<div>
    @push('styles')
    <style>
        /* ── Reset & Base ── */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #f9fafb;
            color: #1f2937;
            -webkit-font-smoothing: antialiased;
        }
        [x-cloak] { display: none !important; }

        /* ── Navbar ── */
        .navbar {
            position: fixed; top: 0; left: 0; right: 0; z-index: 50;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(22,163,74,0.1);
            transition: box-shadow .3s;
        }
        .navbar.scrolled { box-shadow: 0 4px 24px rgba(22,163,74,0.08); }
        .navbar-inner {
            max-width: 1200px; margin: 0 auto; padding: 0 24px;
            display: flex; align-items: center; justify-content: space-between; height: 72px;
        }
        .nav-logo {
            display: flex; align-items: center; gap: 10px; text-decoration: none;
            font-weight: 800; font-size: 1.25rem; color: #16a34a; letter-spacing: -0.5px;
        }
        .logo-img { height: 40px; width: auto; }
        .nav-links { display: flex; align-items: center; gap: 32px; }
        .nav-links a {
            text-decoration: none; font-size: 0.88rem; font-weight: 500;
            color: #6b7280; transition: color .2s; position: relative;
        }
        .nav-links a::after {
            content: ''; position: absolute; bottom: -4px; left: 0; right: 0;
            height: 2px; background: #16a34a; border-radius: 2px;
            transform: scaleX(0); transition: transform .2s;
        }
        .nav-links a:hover { color: #16a34a; }
        .nav-links a:hover::after { transform: scaleX(1); }
        .nav-links a.active { color: #16a34a; }
        .nav-links a.active::after { transform: scaleX(1); }

        /* ── Nav Dropdown ── */
        .nav-dropdown { position: relative; }
        .nav-dropdown-trigger {
            text-decoration: none; font-size: 0.88rem; font-weight: 500;
            color: #6b7280; transition: color .2s; cursor: pointer; display: flex; align-items: center; gap: 4px;
        }
        .nav-dropdown-trigger:hover { color: #16a34a; }
        .nav-dropdown-trigger.active { color: #16a34a; }
        .nav-dropdown-trigger svg { transition: transform .2s; }
        .nav-dropdown-trigger:hover svg,
        .nav-dropdown-trigger.active svg { transform: rotate(180deg); }
        .nav-dropdown-menu {
            position: absolute; top: calc(100% + 8px); left: 50%; transform: translateX(-50%);
            background: white; border-radius: 12px; box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            min-width: 200px; padding: 6px; opacity: 0; visibility: hidden;
            transition: all .2s; border: 1px solid rgba(22,163,74,0.08);
        }
        .nav-dropdown:hover .nav-dropdown-menu,
        .nav-dropdown-trigger.active + .nav-dropdown-menu { opacity: 1; visibility: visible; transform: translateX(-50%) translateY(0); }
        .nav-dropdown-menu a {
            display: flex; align-items: center; gap: 10px; padding: 10px 14px;
            border-radius: 8px; text-decoration: none; color: #4b5563;
            font-size: 0.85rem; font-weight: 500; transition: all .15s;
        }
        .nav-dropdown-menu a:hover { background: #f0fdf4; color: #16a34a; }
        .nav-dropdown-menu a svg { flex-shrink: 0; }

        .menu-toggle {
            display: none; flex-direction: column; gap: 5px; cursor: pointer;
            padding: 4px; background: transparent; border: none;
        }
        .menu-toggle span {
            display: block; width: 24px; height: 2.5px; background: #4b5563; border-radius: 4px;
            transition: all .3s;
        }
        .menu-toggle.active span:nth-child(1) { transform: rotate(45deg) translate(5px, 5px); }
        .menu-toggle.active span:nth-child(2) { opacity: 0; }
        .menu-toggle.active span:nth-child(3) { transform: rotate(-45deg) translate(5px, -5px); }
        .mobile-menu {
            display: none; flex-direction: column; gap: 4px; padding: 0 24px 20px;
            background: white; max-width: 1200px; margin: 0 auto;
        }
        .mobile-menu.open { display: flex; }
        .mobile-menu a {
            text-decoration: none; font-size: 0.9rem; font-weight: 500;
            color: #4b5563; padding: 10px 0; transition: color .2s;
        }
        .mobile-menu a:hover, .mobile-menu a.active { color: #16a34a; }
        .mobile-sub-label {
            font-size: 0.75rem; color: #9ca3af; padding: 4px 0 2px;
        }

        @media (max-width: 768px) { .nav-links { display: none; } .menu-toggle { display: flex; } }

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

        /* ── Facility Grid ── */
        .facility-section { max-width: 1200px; margin: 0 auto; padding: 60px 24px 80px; }

        .facility-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 32px;
        }

        .facility-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            border: 1px solid rgba(22,163,74,0.08);
            transition: all .3s;
        }
        .facility-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(22,163,74,0.12);
            border-color: rgba(22,163,74,0.2);
        }

        /* ── Facility Image Carousel ── */
        .facility-carousel {
            position: relative;
            width: 100%;
            height: 240px;
            overflow: hidden;
            background: #f3f4f6;
        }
        .facility-carousel .carousel-slide {
            position: absolute; inset: 0;
            opacity: 0;
            transition: opacity 0.6s ease;
        }
        .facility-carousel .carousel-slide.active {
            opacity: 1;
        }
        .facility-carousel .carousel-slide img {
            width: 100%; height: 100%; object-fit: cover;
        }
        .facility-carousel .carousel-btn {
            position: absolute; top: 50%; transform: translateY(-50%);
            z-index: 5; width: 36px; height: 36px; border: none; border-radius: 50%;
            background: rgba(255,255,255,0.9); cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            color: #374151; transition: all .2s;
            opacity: 0; pointer-events: none;
        }
        .facility-card:hover .carousel-btn {
            opacity: 1; pointer-events: auto;
        }
        .facility-carousel .carousel-btn:hover {
            background: #16a34a; color: white;
        }
        .facility-carousel .carousel-btn.prev { left: 10px; }
        .facility-carousel .carousel-btn.next { right: 10px; }

        .carousel-dots {
            position: absolute; bottom: 10px; left: 50%; transform: translateX(-50%);
            display: flex; gap: 6px; z-index: 5;
        }
        .carousel-dot {
            width: 8px; height: 8px; border-radius: 50%;
            background: rgba(255,255,255,0.5); border: none; cursor: pointer;
            transition: all .3s; padding: 0;
        }
        .carousel-dot.active {
            background: white; width: 24px; border-radius: 4px;
        }
        .carousel-dot:hover { background: rgba(255,255,255,0.8); }

        .facility-img-placeholder {
            width: 100%; height: 240px;
            background: linear-gradient(135deg, #e0f2e9, #d1fae5);
            display: flex; align-items: center; justify-content: center;
            color: #16a34a; font-size: 3rem;
        }
        .image-count-badge {
            position: absolute; top: 12px; right: 12px; z-index: 5;
            display: flex; align-items: center; gap: 4px;
            padding: 4px 10px; background: rgba(0,0,0,0.5);
            border-radius: 20px; color: white; font-size: 0.75rem; font-weight: 600;
            backdrop-filter: blur(4px);
        }

        .facility-body { padding: 24px; }
        .facility-name {
            font-size: 1.15rem; font-weight: 700; color: #111827;
            margin-bottom: 8px; line-height: 1.3;
        }
        .facility-card:hover .facility-name { color: #16a34a; }
        .facility-desc {
            font-size: 0.88rem; color: #6b7280; line-height: 1.65;
            display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
        }

        /* ── Empty State ── */
        .empty-state {
            text-align: center; padding: 80px 24px; color: #9ca3af;
        }
        .empty-state svg { margin: 0 auto 16px; }

        /* ── Animations ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up { animation: fadeUp 0.6s ease-out forwards; }
        .animate-delay-1 { animation-delay: 0.1s; opacity: 0; }
        .animate-delay-2 { animation-delay: 0.2s; opacity: 0; }

        /* ── Footer ── */
        .footer {
            background: #111827; padding: 48px 24px 32px; color: rgba(255,255,255,0.7);
        }
        .footer-inner {
            max-width: 1200px; margin: 0 auto;
            display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 40px;
        }
        .footer-brand { font-size: 0.9rem; line-height: 1.7; }
        .footer-brand strong { color: white; font-size: 1.1rem; }
        .footer-col h4 { color: white; font-size: 0.9rem; font-weight: 600; margin-bottom: 16px; }
        .footer-col a {
            display: block; color: rgba(255,255,255,0.6); text-decoration: none;
            font-size: 0.85rem; margin-bottom: 10px; transition: color .2s;
        }
        .footer-col a:hover { color: #4ade80; }
        .footer-bottom {
            max-width: 1200px; margin: 32px auto 0;
            padding-top: 24px; border-top: 1px solid rgba(255,255,255,0.08);
            text-align: center; font-size: 0.82rem; color: rgba(255,255,255,0.4);
        }

        @media (max-width: 768px) {
            .facility-grid { grid-template-columns: 1fr; }
            .footer-inner { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 480px) {
            .footer-inner { grid-template-columns: 1fr; }
            .facility-carousel { height: 200px; }
        }
    </style>
    @endpush

    <!-- ════════════════════════════════════════════ -->
    <!-- NAVBAR -->
    <!-- ════════════════════════════════════════════ -->
    <nav class="navbar" id="navbar">
        <div class="navbar-inner">
            <a href="/" class="nav-logo" wire:navigate>
                <img src="{{ asset('gambar/ppsr logo.webp') }}" alt="PPSR Logo" class="logo-img">
            </a>

            <div class="nav-links">
                <a href="/" wire:navigate class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a>
                <div class="nav-dropdown">
                    <span class="nav-dropdown-trigger {{ request()->is('profile*') ? 'active' : '' }}">
                        Profile
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </span>
                    <div class="nav-dropdown-menu">
                        <a href="{{ route('profile.pimpinan') }}" wire:navigate>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            Pimpinan Pondok
                        </a>
                        <a href="{{ route('profile.pengajar') }}" wire:navigate>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20"/></svg>
                            Pengajar
                        </a>
                    </div>
                </div>
                <a href="{{ route('fasilitas') }}" wire:navigate class="active">Fasilitas</a>
                <a href="/berita" wire:navigate class="{{ request()->is('berita*') && !request()->is('profile*') ? 'active' : '' }}">Berita</a>
            </div>

            <button class="menu-toggle" id="menuToggle" aria-label="Menu">
                <span></span><span></span><span></span>
            </button>
        </div>

        <div class="mobile-menu" id="mobileMenu">
            <a href="/" wire:navigate class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a>
            <div class="mobile-sub-label">Profile</div>
            <a href="{{ route('profile.pimpinan') }}" wire:navigate style="padding-left:16px;">Pimpinan Pondok</a>
            <a href="{{ route('profile.pengajar') }}" wire:navigate style="padding-left:16px;">Pengajar</a>
            <a href="{{ route('fasilitas') }}" wire:navigate class="active">Fasilitas</a>
            <a href="/berita" wire:navigate class="{{ request()->is('berita*') ? 'active' : '' }}">Berita</a>
        </div>
    </nav>

    <!-- ════════════════════════════════════════════ -->
    <!-- PAGE HEADER -->
    <!-- ════════════════════════════════════════════ -->
    <section class="page-header">
        <div class="page-header-inner">
            <div class="section-label animate-fade-up">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"/><line x1="9" y1="6" x2="15" y2="6"/><line x1="9" y1="10" x2="15" y2="10"/><line x1="9" y1="14" x2="13" y2="14"/></svg>
                Fasilitas Sekolah
            </div>
            <h1 class="animate-fade-up animate-delay-1">Sarana &amp; Prasarana</h1>
            <p class="animate-fade-up animate-delay-2">Berbagai fasilitas lengkap untuk menunjang kegiatan belajar mengajar dan pengembangan santri di Pondok Pesantren Syafa'aturrasul.</p>
        </div>
    </section>

    <!-- ════════════════════════════════════════════ -->
    <!-- FACILITY LIST -->
    <!-- ════════════════════════════════════════════ -->
    <section class="facility-section">
        @if($facilities->isNotEmpty())
            <div class="facility-grid">
                @foreach($facilities as $facility)
                    @php
                        $images = $facility->images ?? [];
                        $hasImages = count($images) > 0;
                    @endphp
                    <div class="facility-card animate-fade-up"
                         x-data="{ currentSlide: 0, images: {{ json_encode($images) }}, totalSlides: {{ count($images) > 0 ? count($images) : 1 }} }">
                        <div class="facility-carousel">
                            @if($hasImages)
                                <template x-for="(img, index) in images" :key="index">
                                    <div class="carousel-slide" :class="{ 'active': currentSlide === index }">
                                        <img :src="'/storage/' + img" :alt="'{{ $facility->name }} - ' + (index + 1)" loading="lazy">
                                    </div>
                                </template>

                                <button class="carousel-btn prev"
                                    x-show="totalSlides > 1"
                                    @click="currentSlide = currentSlide > 0 ? currentSlide - 1 : totalSlides - 1">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                                </button>
                                <button class="carousel-btn next"
                                    x-show="totalSlides > 1"
                                    @click="currentSlide = currentSlide < totalSlides - 1 ? currentSlide + 1 : 0">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                                </button>

                                <div class="carousel-dots" x-show="totalSlides > 1">
                                    <template x-for="(dot, index) in images" :key="index">
                                        <button class="carousel-dot" :class="{ 'active': currentSlide === index }"
                                            @click="currentSlide = index"></button>
                                    </template>
                                </div>

                                <div class="image-count-badge" x-show="totalSlides > 1">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                    <span x-text="(currentSlide + 1) + '/' + totalSlides"></span>
                                </div>
                            @else
                                <div class="facility-img-placeholder">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                </div>
                            @endif
                        </div>

                        <div class="facility-body">
                            <h3 class="facility-name">{{ $facility->name }}</h3>
                            @if($facility->description)
                                <p class="facility-desc">{{ $facility->description }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                <p style="margin-top:12px;font-size:1rem;">Belum ada data fasilitas.</p>
            </div>
        @endif
    </section>

    <!-- ════════════════════════════════════════════ -->
    <!-- FOOTER -->
    <!-- ════════════════════════════════════════════ -->
    <footer class="footer">
        <div class="footer-inner">
            <div class="footer-brand">
                <strong style="display:flex;align-items:center;gap:8px;margin-bottom:12px;">
                    <span style="width:28px;height:28px;background:#16a34a;border-radius:8px;display:flex;align-items:center;justify-content:center;color:white;font-size:14px;font-weight:800;">P</span>
                    {{ config('app.name', 'Berita Apps') }}
                </strong>
                <p>Platform informasi resmi Pondok Pesantren Syafa'aturrasul.</p>
            </div>
            <div class="footer-col">
                <h4>Menu</h4>
                <a href="/" wire:navigate>Beranda</a>
                <a href="{{ route('fasilitas') }}" wire:navigate>Fasilitas Sekolah</a>
                <a href="{{ route('profile.pimpinan') }}" wire:navigate>Pimpinan Pondok</a>
                <a href="{{ route('profile.pengajar') }}" wire:navigate>Pengajar</a>
                <a href="/berita" wire:navigate>Berita</a>
            </div>
            <div class="footer-col">
                <h4>Lainnya</h4>
                <a href="#">Kebijakan Privasi</a>
                <a href="#">Syarat & Ketentuan</a>
                <a href="#">FAQ</a>
            </div>
            <div class="footer-col">
                <h4>Kontak</h4>
                <a href="mailto:info@syafaturrasul.sch.id">info@syafaturrasul.sch.id</a>
                <a href="#">+62 123 4567 890</a>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; {{ date('Y') }} {{ config('app.name', 'Berita Apps') }}. All rights reserved.
        </div>
    </footer>

    @push('scripts')
    <script>
        // Navbar scroll
        const navbar = document.getElementById('navbar');
        if (navbar) {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 20) { navbar.classList.add('scrolled'); }
                else { navbar.classList.remove('scrolled'); }
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
    </script>
    @endpush
</div>
