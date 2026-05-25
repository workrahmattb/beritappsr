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
        .nav-auth {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .btn-login {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 8px;
            font-size: 0.88rem;
            font-weight: 600;
            text-decoration: none;
            background: #16a34a;
            color: white;
            transition: all .2s;
        }
        .btn-login:hover {
            background: #15803d;
            box-shadow: 0 4px 12px rgba(22,163,74,0.3);
        }
        .btn-login-outline {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 8px;
            font-size: 0.88rem;
            font-weight: 600;
            text-decoration: none;
            border: 1.5px solid #16a34a;
            color: #16a34a;
            transition: all .2s;
        }
        .btn-login-outline:hover {
            background: #16a34a;
            color: white;
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
        .mobile-menu a.active { color: #16a34a; }

        @media (max-width: 768px) {
            .nav-links { display: none; }
            .nav-auth { display: none; }
            .menu-toggle { display: flex; }
        }

        /* ── Page Header ── */
        .page-header {
            background: linear-gradient(135deg, #064e3b, #047857, #16a34a);
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
            opacity: 0.3;
        }
        .page-header > * { position: relative; z-index: 1; }
        .page-header h1 {
            font-size: clamp(1.75rem, 4vw, 2.5rem);
            font-weight: 800;
            color: white;
            letter-spacing: -0.5px;
            margin-bottom: 8px;
        }
        .page-header p {
            color: rgba(255,255,255,0.8);
            font-size: 1.05rem;
        }

        /* ── Search ── */
        .search-bar {
            max-width: 500px;
            margin: -28px auto 40px;
            position: relative;
            z-index: 10;
            padding: 0 24px;
        }
        .search-input {
            width: 100%;
            padding: 16px 20px 16px 48px;
            border: 1.5px solid rgba(22,163,74,0.15);
            border-radius: 14px;
            font-size: 0.95rem;
            background: white;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            transition: all .25s;
            outline: none;
            color: #1f2937;
        }
        .search-input:focus {
            border-color: #16a34a;
            box-shadow: 0 4px 24px rgba(22,163,74,0.15);
        }
        .search-input::placeholder {
            color: #9ca3af;
        }
        .search-icon {
            position: absolute;
            left: 42px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            pointer-events: none;
        }

        /* ── Section ── */
        .section {
            padding: 0 24px 80px;
            max-width: 1200px;
            margin: 0 auto;
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

        /* ── Pagination ── */
        .pagination-wrap {
            margin-top: 48px;
            display: flex;
            justify-content: center;
        }
        .pagination-wrap nav {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .pagination-wrap a,
        .pagination-wrap span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0 12px;
            border-radius: 10px;
            font-size: 0.88rem;
            font-weight: 500;
            text-decoration: none;
            color: #4b5563;
            background: white;
            border: 1px solid #e5e7eb;
            transition: all .2s;
        }
        .pagination-wrap a:hover {
            border-color: #16a34a;
            color: #16a34a;
        }
        .pagination-wrap span[aria-current="page"] {
            background: #16a34a;
            border-color: #16a34a;
            color: white;
        }
        .pagination-wrap .disabled span {
            opacity: 0.4;
            cursor: default;
        }

        /* ── Empty State ── */
        .empty-state {
            text-align: center;
            padding: 60px 0;
            color: #9ca3af;
        }

        /* ── Back Button ── */
        .back-home {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-size: 0.9rem;
            margin-bottom: 16px;
            transition: color .2s;
        }
        .back-home:hover { color: white; }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .berita-grid { grid-template-columns: 1fr; }
        }

        /* ── Animation ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up {
            animation: fadeUp 0.6s ease-out forwards;
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
                <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a>
                <a href="/berita" class="{{ request()->is('berita*') ? 'active' : '' }}">Berita</a>
                <a href="#">Tentang</a>
                <a href="#">Kontak</a>
            </div>

            <div class="nav-auth">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-login">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-login-outline">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-login">Daftar</a>
                        @endif
                    @endauth
                @endif
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
            @if (Route::has('login'))
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-login" style="text-align:center;margin-top:8px;">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-login-outline" style="text-align:center;margin-top:8px;">Masuk</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-login" style="text-align:center;">Daftar</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <!-- ════════════════════════════════════════════ -->
    <!-- PAGE HEADER -->
    <!-- ════════════════════════════════════════════ -->
    <section class="page-header">
        <div style="max-width:1200px;margin:0 auto;padding:0 24px;">
            <a href="/" class="back-home">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                Kembali ke Beranda
            </a>
            <h1>Semua Berita</h1>
            <p>Jelajahi seluruh artikel dan berita terkini</p>
        </div>
    </section>

    <!-- ════════════════════════════════════════════ -->
    <!-- SEARCH -->
    <!-- ════════════════════════════════════════════ -->
    <div class="search-bar">
        <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input
            type="text"
            class="search-input"
            placeholder="Cari berita..."
            wire:model.live.debounce.300ms="search"
        >
    </div>

    <!-- ════════════════════════════════════════════ -->
    <!-- BERITA GRID -->
    <!-- ════════════════════════════════════════════ -->
    <section class="section">
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

            <div class="pagination-wrap">
                {{ $this->articles->links() }}
            </div>
        @else
            <div class="empty-state">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" style="margin:0 auto 16px;opacity:0.4;">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/>
                </svg>
                <p style="font-size:1.1rem;">
                    @if($search)
                        Berita dengan kata kunci "{{ $search }}" tidak ditemukan.
                    @else
                        Belum ada berita yang dipublikasikan.
                    @endif
                </p>
                @if($search)
                    <a href="/berita" wire:navigate style="display:inline-block;margin-top:16px;color:#16a34a;font-weight:600;text-decoration:none;">
                        &larr; Tampilkan Semua
                    </a>
                @endif
            </div>
        @endif
    </section>

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
    </script>
    @endpush
</div>
