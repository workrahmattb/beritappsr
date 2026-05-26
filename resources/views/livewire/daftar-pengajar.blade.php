<div>
    @push('styles')
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Inter', sans-serif;
                background: #f9fafb;
                color: #1f2937;
                -webkit-font-smoothing: antialiased;
            }

            /* ── Navbar ── */
            .navbar {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 50;
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border-bottom: 1px solid rgba(22, 163, 74, 0.1);
                transition: box-shadow .3s;
            }

            .navbar.scrolled {
                box-shadow: 0 4px 24px rgba(22, 163, 74, 0.08);
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

            .nav-links a:hover {
                color: #16a34a;
            }

            .nav-links a:hover::after {
                transform: scaleX(1);
            }

            .nav-links a.active {
                color: #16a34a;
            }

            .nav-links a.active::after {
                transform: scaleX(1);
            }

            /* ── Dropdown ── */
            .nav-dropdown {
                position: relative;
            }

            .nav-dropdown-trigger {
                text-decoration: none;
                font-size: 0.88rem;
                font-weight: 500;
                color: #6b7280;
                cursor: pointer;
                transition: color .2s;
                display: flex;
                align-items: center;
                gap: 4px;
                position: relative;
                background: none;
                border: none;
                font-family: inherit;
                padding: 0;
            }

            .nav-dropdown-trigger::after {
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

            .nav-dropdown-trigger:hover {
                color: #16a34a;
            }

            .nav-dropdown-trigger:hover::after {
                transform: scaleX(1);
            }

            .nav-dropdown-trigger.active {
                color: #16a34a;
            }

            .nav-dropdown-trigger.active::after {
                transform: scaleX(1);
            }

            .nav-dropdown-arrow {
                transition: transform .2s;
            }

            .nav-dropdown:hover .nav-dropdown-arrow {
                transform: rotate(180deg);
            }

            .nav-dropdown-menu {
                position: absolute;
                top: 100%;
                left: 50%;
                transform: translateX(-50%) translateY(8px);
                background: white;
                border-radius: 12px;
                box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
                border: 1px solid rgba(22, 163, 74, 0.1);
                min-width: 200px;
                padding: 6px;
                opacity: 0;
                visibility: hidden;
                transition: all .2s;
                z-index: 100;
            }

            .nav-dropdown:hover .nav-dropdown-menu {
                opacity: 1;
                visibility: visible;
                transform: translateX(-50%) translateY(4px);
            }

            .nav-dropdown-menu a {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 10px 14px;
                border-radius: 8px;
                text-decoration: none;
                font-size: 0.85rem;
                font-weight: 500;
                color: #4b5563;
                transition: all .15s;
            }

            .nav-dropdown-menu a:hover {
                background: rgba(22, 163, 74, 0.08);
                color: #16a34a;
            }

            .nav-dropdown-menu a::after {
                display: none;
            }

            .nav-dropdown-menu a.active {
                background: rgba(22, 163, 74, 0.1);
                color: #16a34a;
            }

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
            .mobile-menu a.active {
                color: #16a34a;
            }

            .mobile-menu .mobile-sub-label {
                font-size: 0.8rem;
                font-weight: 600;
                color: #9ca3af;
                padding: 6px 0 2px 12px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .mobile-menu .mobile-sub-item {
                padding: 8px 0 8px 24px;
                font-size: 0.88rem;
            }

            @media (max-width: 768px) {
                .nav-links {
                    display: none;
                }

                .menu-toggle {
                    display: flex;
                }
            }

            /* ── Page Header ── */
            .page-header {
                background: linear-gradient(135deg, #059669, #16a34a, #22c55e);
                padding: 120px 24px 60px;
                text-align: center;
                position: relative;
                overflow: hidden;
            }

            .page-header::before {
                content: '';
                position: absolute;
                inset: 0;
                background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
                opacity: 0.5;
            }

            .page-header > * {
                position: relative;
                z-index: 1;
            }

            .page-header .section-label {
                display: inline-block;
                padding: 4px 14px;
                background: rgba(255, 255, 255, 0.15);
                border-radius: 50px;
                color: rgba(255, 255, 255, 0.9);
                font-size: 0.8rem;
                font-weight: 600;
                margin-bottom: 12px;
                backdrop-filter: blur(4px);
            }

            .page-header h1 {
                font-size: clamp(2rem, 5vw, 3rem);
                font-weight: 800;
                color: white;
                letter-spacing: -0.5px;
                margin-bottom: 12px;
            }

            .page-header p {
                color: rgba(255, 255, 255, 0.85);
                font-size: 1.05rem;
                max-width: 500px;
                margin: 0 auto;
                line-height: 1.6;
            }

            /* ── Teacher Grid ── */
            .section {
                padding: 60px 24px 80px;
                max-width: 1200px;
                margin: 0 auto;
            }

            .teacher-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 28px;
            }

            .teacher-card {
                background: white;
                border-radius: 16px;
                overflow: hidden;
                border: 1px solid rgba(22, 163, 74, 0.08);
                transition: all .3s;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
                text-align: center;
            }

            .teacher-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 12px 40px rgba(22, 163, 74, 0.12);
                border-color: rgba(22, 163, 74, 0.2);
            }

            .teacher-photo-wrap {
                width: 100%;
                aspect-ratio: 1;
                overflow: hidden;
                background: linear-gradient(135deg, #d1fae5, #a7f3d0);
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .teacher-photo {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
                transition: transform .4s;
            }

            .teacher-card:hover .teacher-photo {
                transform: scale(1.05);
            }

            .teacher-photo-placeholder {
                font-size: 3.5rem;
                font-weight: 700;
                color: #16a34a;
                opacity: 0.5;
            }

            .teacher-body {
                padding: 20px 20px 24px;
            }

            .teacher-name {
                font-size: 1.1rem;
                font-weight: 700;
                color: #111827;
                margin-bottom: 4px;
            }

            .teacher-card:hover .teacher-name {
                color: #16a34a;
            }

            .teacher-position {
                font-size: 0.85rem;
                color: #6b7280;
                font-weight: 500;
                margin-bottom: 12px;
            }

            .teacher-badge {
                display: inline-block;
                padding: 3px 12px;
                background: rgba(22, 163, 74, 0.1);
                border-radius: 50px;
                color: #16a34a;
                font-size: 0.75rem;
                font-weight: 600;
            }

            .teacher-badge.pimpinan {
                background: rgba(245, 158, 11, 0.12);
                color: #d97706;
            }

            .teacher-badge.pembina_asrama {
                background: rgba(59, 130, 246, 0.12);
                color: #2563eb;
            }

            .teacher-bio {
                font-size: 0.85rem;
                color: #6b7280;
                line-height: 1.6;
                margin-top: 12px;
                padding-top: 12px;
                border-top: 1px solid #f3f4f6;
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            /* ── Empty State ── */
            .empty-state {
                text-align: center;
                padding: 60px 0;
                color: #9ca3af;
            }

            .empty-state svg {
                margin: 0 auto 16px;
                opacity: 0.4;
            }

            .empty-state p {
                font-size: 1.1rem;
            }

            /* ── Footer ── */
            .footer {
                background: #111827;
                padding: 48px 24px 32px;
                color: rgba(255, 255, 255, 0.7);
            }

            .footer-inner {
                max-width: 1200px;
                margin: 0 auto;
                display: grid;
                grid-template-columns: 2fr 1fr 1fr 1fr;
                gap: 40px;
            }

            .footer-brand {
                font-size: 0.9rem;
                line-height: 1.7;
            }

            .footer-brand strong {
                color: white;
                font-size: 1.1rem;
            }

            .footer-col h4 {
                color: white;
                font-size: 0.9rem;
                font-weight: 600;
                margin-bottom: 16px;
            }

            .footer-col a {
                display: block;
                color: rgba(255, 255, 255, 0.6);
                text-decoration: none;
                font-size: 0.85rem;
                margin-bottom: 10px;
                transition: color .2s;
            }

            .footer-col a:hover {
                color: #4ade80;
            }

            .footer-bottom {
                max-width: 1200px;
                margin: 32px auto 0;
                padding-top: 24px;
                border-top: 1px solid rgba(255, 255, 255, 0.08);
                text-align: center;
                font-size: 0.82rem;
                color: rgba(255, 255, 255, 0.4);
            }

            @media (max-width: 768px) {
                .footer-inner {
                    grid-template-columns: 1fr 1fr;
                }

                .teacher-grid {
                    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
                }
            }

            @media (max-width: 480px) {
                .footer-inner {
                    grid-template-columns: 1fr;
                }

                .teacher-grid {
                    grid-template-columns: 1fr;
                }
            }
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
                <a href="/">Beranda</a>
                <div class="nav-dropdown">
                    <span class="nav-dropdown-trigger active">
                        Profile
                        <svg class="nav-dropdown-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </span>
                    <div class="nav-dropdown-menu">
                        <a href="{{ route('profile.pimpinan') }}" class="{{ request()->routeIs('profile.pimpinan') ? 'active' : '' }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                            Pimpinan Pondok
                        </a>
                        <a href="{{ route('profile.pengajar') }}" class="{{ request()->routeIs('profile.pengajar') ? 'active' : '' }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                            Pengajar
                        </a>
                    </div>
                </div>
                <a href="/berita">Berita</a>
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
            <a href="/">Beranda</a>
            <div class="mobile-sub-label">Profile</div>
            <a href="{{ route('profile.pimpinan') }}" class="mobile-sub-item">Pimpinan Pondok</a>
            <a href="{{ route('profile.pengajar') }}" class="mobile-sub-item">Pengajar</a>
            <a href="/berita">Berita</a>
            <a href="#">Tentang</a>
            <a href="#">Kontak</a>
        </div>
    </nav>

    <!-- ════════════════════════════════════════════ -->
    <!-- PAGE HEADER -->
    <!-- ════════════════════════════════════════════ -->
    <div class="page-header">
        <div class="section-label">
            {{ $category === 'pimpinan' ? 'Pimpinan' : 'Pengajar' }}
        </div>
        <h1>{{ $title }}</h1>
        <p>Mengenal lebih dekat para {{ strtolower($title) }} di Pondok Pesantren Syafa'aturrasul</p>
    </div>

    <!-- ════════════════════════════════════════════ -->
    <!-- TEACHER GRID -->
    <!-- ════════════════════════════════════════════ -->
    <div class="section">
        @if ($this->teachers->isNotEmpty())
            <div class="teacher-grid">
                @foreach ($this->teachers as $teacher)
                    <div class="teacher-card">
                        <div class="teacher-photo-wrap">
                            @if ($teacher->photo)
                                <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}" class="teacher-photo" loading="lazy">
                            @else
                                <div class="teacher-photo-placeholder">
                                    {{ strtoupper(substr($teacher->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div class="teacher-body">
                            <div class="teacher-name">{{ $teacher->name }}</div>
                            @if ($teacher->position)
                                <div class="teacher-position">{{ $teacher->position }}</div>
                            @endif
                            <span class="teacher-badge {{ $teacher->category }}">
                                {{ $teacher->categoryLabel() }}
                            </span>
                            @if ($teacher->bio)
                                <div class="teacher-bio">{{ $teacher->bio }}</div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                </svg>
                <p>Belum ada data {{ strtolower($title) }}.</p>
            </div>
        @endif
    </div>

    <!-- ════════════════════════════════════════════ -->
    <!-- FOOTER -->
    <!-- ════════════════════════════════════════════ -->
    <footer class="footer">
        <div class="footer-inner">
            <div class="footer-brand">
                <strong style="display:flex;align-items:center;gap:12px;margin-bottom:12px;">
                    <img src="{{ asset('gambar/ppsr logo.webp') }}" alt="PPSR Logo" style="height:40px;width:auto;">
                </strong>
                <p>Portal berita resmi dari Pondok Pesantren Syafa'aturrasul.</p>
            </div>
            <div class="footer-col">
                <h4>Menu</h4>
                <a href="/">Beranda</a>
                <a href="{{ route('profile.pimpinan') }}">Pimpinan Pondok</a>
                <a href="{{ route('profile.pengajar') }}">Pengajar</a>
                <a href="/berita">Berita</a>
            </div>
            <div class="footer-col">
                <h4>Lainnya</h4>
                <a href="#">Kebijakan Privasi</a>
                <a href="#">Syarat & Ketentuan</a>
                <a href="#">FAQ</a>
            </div>
            <div class="footer-col">
                <h4>Kontak</h4>
                <a href="#">+62 852 5987 5754</a>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; {{ date('Y') }} {{ config('app.name', 'Berita Apps') }}. All rights reserved.
        </div>
    </footer>

    @push('scripts')
        <script>
            // ── Navbar scroll effect ──
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

            // ── Mobile menu toggle ──
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
